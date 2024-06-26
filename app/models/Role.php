<?php

namespace ppe4\models;

require_once "Model.php";

use PDO;

class Role extends Model
{
    private string $libelle;
    private string $description;

    public function setRole(int $id, string $libelle, string $description): void
    {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->description = $libelle;
    }

    public function __construct()
    {
        $this->table = "role";
        $this->get_connection();
    }


    public function selectionner_role(string $email): Role
    {
        $query =
            "SELECT role.id_rol, libelle_rol, description_rol FROM utilisateur INNER JOIN role ON role.id_rol = utilisateur.id_rol WHERE email_uti = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(["email" => $email]);
        $role = $stmt->fetch(PDO::FETCH_ASSOC);

        $result = new Role();
        $result->setRole(
            $role["id_rol"],
            $role["libelle_rol"],
            $role["description_rol"],
        );

        return $result;
    }

    public function selectionner_role_par_id(int $id_role): Role
    {
        $query =
            "SELECT id_rol as id, libelle_rol as libelle, description_rol as description FROM role WHERE id_rol = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue("id", $id_role, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "ppe4\models\Role");
        return $stmt->fetch();
    }

    public function selectionner_role_par_libelle(string $libelle_role): Role
    {
        $query =
            "SELECT id_rol as id, libelle_rol as libelle, description_rol as description FROM role WHERE libelle_rol = :libelle";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue("libelle", $libelle_role, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "ppe4\models\Role");
        return $stmt->fetch();
    }

    public function selectionner_roles(): array
    {
        $query =
            "SELECT id_rol as id, libelle_rol as libelle, description_rol as description FROM role";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "ppe4\models\Role");
        return $stmt->fetchAll();
    }

    public function selectionner_id_role(Role $role): int
    {
        $query =
            "SELECT id_rol as id FROM role WHERE libelle_rol = :libelle_role";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue("libelle_role", $role->getLibelle(), PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        return $result["id"];
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
