<?php
namespace ppe4\controllers;

use JetBrains\PhpStorm\NoReturn;
use ppe4\models\Log_connexion;
use ppe4\models\Utilisateur;

require_once "Controller.php";

class Login
{
    #[NoReturn]
    public function __construct()
    {
        require_once ROOT . "app/models/Utilisateur.php";
        require_once ROOT . "app/controllers/JWT.php";

        if (isset($_COOKIE["JWT"])) {
            $this->verifier_validite_JWT();
        }
    }

    public function afficher(): void
    {
        if (isset($_GET['echec']) && $_GET['echec'] == 'true') {
            echo '
            <script>alert("Email ou mot de passe incorrect")</script>
            ';
        }
        require_once ROOT . "./app/views/login.php";
    }

    #[NoReturn]
    public function connecter(string $email, string $mot_de_passe): bool
    {
        require_once ROOT . "app/models/Log_connexion.php";
        $log_connexion = new Log_connexion();
        $utilisateur = new Utilisateur();
        $jwt = new JWT();

        require_once ROOT . "app/controllers/Bcrypt.php";
        $bcrypt = new Bcrypt();

        $utilisateur_existe = $utilisateur->selectionner_utilisateur_par_email(
            $email,
        );

        if (
            $utilisateur_existe &&
            $this->compte_non_bloque($utilisateur_existe) &&
            $bcrypt->verifier_mot_de_passe($email, $mot_de_passe)
        ) {
            if ($this->mot_de_passe_a_changer($email)) {
                $_SESSION["user_email"] = $email;
                header(
                    "Location: index.php?page=nouveau_mdp",
                );
                exit();
            }

            $id = $utilisateur_existe->getId();
            $role = $utilisateur_existe->getRole();

            $payload = $jwt->generer_payload($id, $email, $role);
            setcookie("JWT", $jwt->generer_jwt($payload), time() + 14400);

            $log_connexion->inserer_log_connexion($email, false);

            return true;
        } else {
            $log_connexion->inserer_log_connexion($email, true);
            return false;
        }
    }

    public function verifier_validite_JWT(): void
    {
        $jwt = new JWT();
        $token = $_COOKIE["JWT"];

        if (
            $jwt->est_valide($token) &&
            !$jwt->est_expire($token) &&
            $jwt->verifier_validite($token)
        ) {
            header("Location: index.php?page=dashboard");
            exit();
        }

        $this->afficher();
    }

    public function nombre_echec_connexion_d_affile(string $email): int
    {
        require_once ROOT . "app/models/Log_connexion.php";

        $log_connexion = new Log_connexion();
        $logs = $log_connexion->selectionner_logs_utilisateur($email);

        $i = 0;
        foreach ($logs as $log) {
            if (!$log->getEchec()) {
                return $i;
            }
            $i++;
        }
        return $i;
    }

    public function compte_non_bloque(Utilisateur $utilisateur): bool
    {
        if (
            !$utilisateur->selectionner_statut_activation_utilisateur(
                $utilisateur->getId(),
            )
        ) {
            $nombre_echec_connexion = $this->nombre_echec_connexion_d_affile(
                $utilisateur->getEmail(),
            );

            if ($nombre_echec_connexion >= 4) {
                $utilisateur->desactiver_utilisateur($utilisateur->getId());
                return false;
            }
            return true;
        }
        return false;
    }

    public function mot_de_passe_a_changer(string $email): bool
    {
        $utilisateur = new Utilisateur();
        return $utilisateur->selectionner_mdp_a_changer($email);
    }
}
