<?php

namespace ppe4\models;

use PDO;

require_once ROOT . "app/models/Produit.php";
class Materiel extends Produit
{
    public function set_materiel(
        int $id,
        string $libelle,
        string $description,
        int $qte,
    ): void {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->description = $description;
        $this->quantite_stock = $qte;
    }

    public function __construct()
    {
        $this->table = "materiels";
        $this->get_connection();
    }


    public function selectionner_materiels(int $offset): array
    {
        $query =
            "SELECT produits.id_pro AS id, libelle_pro AS libelle, description_pro AS description, qte_stock_pro AS quantite_stock FROM materiels INNER JOIN produits on materiels.id_pro = produits.id_pro LIMIT :no_page, 25";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam("no_page", $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "\ppe4\models\Materiel");
    }


    public function selectionner_materiels_par_recherche(
        string $recherche,
        int $offset,
    ): array {
        $query =
            "SELECT produits.id_pro AS id, libelle_pro AS libelle, description_pro AS description, qte_stock_pro AS quantite_stock FROM materiels INNER JOIN produits on materiels.id_pro = produits.id_pro WHERE produits.libelle_pro LIKE :recherche LIMIT :offset, 25";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam("offset", $offset, PDO::PARAM_INT);
        $recherche = "%" . $recherche . "%";
        $stmt->bindParam("recherche", $recherche);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, "\ppe4\models\Materiel");
    }


    public function selectionner_materiel(int $id_materiel): Materiel|null
    {
        $query =
            "SELECT produits.id_pro AS id, libelle_pro AS libelle, description_pro AS description, qte_stock_pro AS quantite_stock FROM materiels INNER JOIN produits on materiels.id_pro = produits.id_pro WHERE produits.id_pro = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue("id", $id_materiel, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "ppe4\models\Materiel");
        $result = $stmt->fetch();

        if ($result) {
            return $result;
        }
        return null;
    }


    public function compter_nombre_materiels(): int
    {
        $query = "SELECT COUNT(*) FROM materiels";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }


    public function compter_nombre_materiels_par_recherche(
        string $recherche,
    ): int {
        $query =
            "SELECT COUNT(*) FROM materiels INNER JOIN produits p on materiels.id_pro = p.id_pro WHERE libelle_pro LIKE :recherche";
        $stmt = $this->pdo->prepare($query);
        $recherche = "%" . $recherche . "%";
        $stmt->bindParam("recherche", $recherche, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}
