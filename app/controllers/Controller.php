<?php

namespace ppe4\controllers;

use JetBrains\PhpStorm\NoReturn;

abstract class Controller
{
    public function charger_model(string $model): object
    {
        require_once ROOT . "app/models/" . $model . ".php";
        $this->$model = new $model();
        return $this->$model;
    }

    #[NoReturn]
    public function rediriger(string $page): void
    {
        header("Location: index.php?page=" . $page);
        exit();
    }


    public function status_a_afficher(int $nombre_en_stock): string
    {
        if ($nombre_en_stock >= 50) {
            return "En stock";
        } elseif ($nombre_en_stock == 0) {
            return "Hors stock";
        } else {
            return $nombre_en_stock . " en stock";
        }
    }


    public function role_et_jwt_valide(array $roles_autorise): void
    {
        if (isset($_COOKIE["JWT"])) {
            require_once ROOT . "app/controllers/JWT.php";
            $jwt = new JWT();
            $token = $_COOKIE["JWT"];

            if (
                !$jwt->est_valide($token) ||
                $jwt->est_expire($token) ||
                !$jwt->verifier_validite($token) ||
                !in_array($jwt->get_role($token), $roles_autorise)
            ) {
                $this->rediriger("login");
            }
        } else {
            $this->rediriger("login");
        }
    }
}
