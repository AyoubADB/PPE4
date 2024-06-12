<?php

namespace ppe4\models;

use PDO;
use PDOException;

abstract class Model
{
    protected int $id;

    private string $host = "localhost"; // Hôte de la base de données
    private string $db_name = "stock_labs"; // Nom de la base de données
    private string $username = "GSB"; // Nom d'utilisateur de la base de données
    private string $password = "*~D7vn2qvE@?33PY"; // Mot de passe de la base de données

    protected $pdo;

    protected string $table;


    public function get_connection(): void
    {
        $this->pdo = null;

        try {
            $this->pdo = new PDO(
                "mysql:host=" .
                $this->host .
                ";dbname=" .
                $this->db_name .
                ";charset=utf8",
                $this->username,
                $this->password,
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }
    public function get_one()
    {
        $sql = "GET * FROM :table WHERE :id_table = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute(
            ["table" => $this->table],
            ["id_table" => "id_" . $this->table[0 - 2]],
            ["id" => $this->id],
        );
    }

    public function get_all()
    {
        $sql = "GET * FROM :table";
        $query = $this->pdo->prepare($sql);
        $query->execute(["table" => $this->table]);
    }

    public function getId(): string
    {
        return $this->id;
    }
}
