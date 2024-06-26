<?php

namespace ppe4\controllers;

use ppe4\controllers\Controller;
use ppe4\models\Log_connexion;
use ppe4\models\Role;
use ppe4\models\Utilisateur;

require_once ROOT . "app/controllers/Controller.php";

class Profile_vue_admin extends Controller
{
    public function __construct()
    {
        $this->role_et_jwt_valide(['admin']);
    }

    public function afficher(): void
    {
        require_once ROOT . "app/views/profile_vue_admin.php";
    }


    public function selectionner_utilisateur(
        int $id_utilisateur,
    ): Utilisateur|null {
        require_once ROOT . "app/models/Utilisateur.php";
        $utilisateur_model = new Utilisateur();
        return $utilisateur_model->selectionner_utilisateur_par_id(
            $id_utilisateur,
        );
    }


    public function afficher_option_role(string $role_utilisateur): string
    {
        require_once ROOT . "app/models/Role.php";
        $role_model = new Role();
        $roles = $role_model->selectionner_roles();

        ob_start();
        foreach ($roles as $role) {
            // echo '<option>'.$role->getLibelle().'</option>';
            $selected =
                $role->getLibelle() === $role_utilisateur ? " selected" : "";
            echo "<option" .
                $selected .
                ">" .
                $role->getLibelle() .
                "</option>";
        }
        return ob_get_clean();
    }
    public function modifier_utilisateur(
        int $id_utilisateur,
        string $email,
        string $prenom,
        string $nom,
        string $libelle_role,
    ): bool {
        require_once ROOT . "app/models/Utilisateur.php";
        $utilisateur_model = new Utilisateur();
        return $utilisateur_model->modifier_utilisateur(
            $id_utilisateur,
            $email,
            $prenom,
            $nom,
            $libelle_role,
        );
    }

    public function archiver_utilisateur($id_utilisateur): void
    {
        require_once ROOT . "app/models/Utilisateur.php";
        $utilisateur_model = new Utilisateur();
        $result = $utilisateur_model->archiver_utilisateur($id_utilisateur);
        if (
            !$result
        ) {
            echo '<script>alert("Impossible d\'archiver l\'utilisateur")</script>';
        }
    }

    public function desactiver_utilisateur($id_utilisateur): void
    {
        require_once ROOT . "app/models/Utilisateur.php";
        $utilisateur_model = new Utilisateur();
        $utilisateur_model->desactiver_utilisateur($id_utilisateur);
    }

    public function activer_utilisateur($id_utilisateur): void
    {
        require_once ROOT . "app/models/Utilisateur.php";
        $utilisateur_model = new Utilisateur();
        $utilisateur_model->activer_utilisateur($id_utilisateur);

        require_once ROOT . 'app/models/Log_connexion.php';
        $log_connexion = new Log_connexion();
        $log_connexion->inserer_log_connexion_par_id($id_utilisateur, false);
    }

    public function reinitialiser_mot_de_passe(
        $id_utilisateur,
        $mot_de_passe,
    ): void {
        require_once ROOT . "app/controllers/Bcrypt.php";
        $bcrypt = new Bcrypt();
        $nouveau_mdp_crypte = $bcrypt->crypter_mot_de_passe($mot_de_passe);

        require_once ROOT . "app/models/Utilisateur.php";
        $utilisateur_model = new Utilisateur();
        $utilisateur_model->reinitialiser_mot_de_passe(
            $id_utilisateur,
            $nouveau_mdp_crypte,
        );
    }
}
