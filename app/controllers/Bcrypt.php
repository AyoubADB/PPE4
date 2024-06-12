<?php

namespace ppe4\controllers;

use ppe4\models\Utilisateur;

class Bcrypt
{
    public function crypter_mot_de_passe(string $mot_de_passe): string
    {
        return password_hash($mot_de_passe, PASSWORD_BCRYPT, ["cost" => 13]);
    }

    public function verifier_mot_de_passe(
        string $email,
        string $mot_de_passe
    ): bool {
        require_once ROOT . "app/models/Utilisateur.php";
        $utilisateur = new Utilisateur();

        $mot_de_passe_importe = $utilisateur->selectionner_mot_de_passe($email);

        return password_verify($mot_de_passe, $mot_de_passe_importe);
    }
}
