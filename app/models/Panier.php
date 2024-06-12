<?php

namespace ppe4\models;

require_once "Model.php";

use ppe4\models\Model;
use ppe4\models\Medicament;
use ppe4\models\Materiel;

class Panier extends Model
{
    private int $id_pro;
    private int $id_uti;
    private int $qte;

    public function __construct()
    {
        $this->table = "panier";
        $this->get_connection();
        require_once "Medicament.php";
        require_once "Materiel.php";
    }

    public function set_panier(
        int $id_utilisateur,
        int $id_produit,
        int $qte,
    ): void {
        $this->id_pro = $id_produit;
        $this->id_uti = $id_utilisateur;
        $this->qte = $qte;
    }

    public function getIdPro(): int
    {
        return $this->id_pro;
    }

    public function getIdUti(): int
    {
        return $this->id_uti;
    }

    public function getQte(): int
    {
        return $this->qte;
    }


    public function selectionner_elements_du_panier(int $id_utilisateur): array
    {
        $query = "SELECT * FROM panier WHERE id_uti = :id_utilisateur";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue("id_utilisateur", $id_utilisateur, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "\ppe4\models\Panier");
    }


    public function ajouter_au_panier(
        int $id_utilisateur,
        int $id_produit,
        int $qte,
    ): void {
        $query =
            "INSERT INTO panier (id_uti, id_pro, qte) VALUES (:id_utilisateur, :id_produit, :quantite)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue("id_utilisateur", $id_utilisateur, \PDO::PARAM_INT);
        $stmt->bindValue("id_produit", $id_produit, \PDO::PARAM_INT);
        $stmt->bindValue("quantite", $qte, \PDO::PARAM_INT);
        $stmt->execute();
    }


    public function supprimer_du_panier(
        int $id_utilisateur,
        int $id_produit,
    ): void {
        $query =
            "DELETE FROM panier WHERE id_uti = :id_utilisateur AND id_pro = :id_produit";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue("id_utilisateur", $id_utilisateur, \PDO::PARAM_INT);
        $stmt->bindValue("id_produit", $id_produit, \PDO::PARAM_INT);
        $stmt->execute();
    }


    public function modifier_quantite_du_panier(
        int $id_utilisateur,
        int $id_produit,
        int $qte,
    ): void {
        $query =
            "UPDATE panier SET qte = :qte WHERE id_uti = :id_utilisateur AND id_pro = :id_produit";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue("id_utilisateur", $id_utilisateur, \PDO::PARAM_INT);
        $stmt->bindValue("id_produit", $id_produit, \PDO::PARAM_INT);
        $stmt->bindValue("qte", $qte, \PDO::PARAM_INT);
        $stmt->execute();
    }


    public function vider_le_panier(int $id_utilisateur): void
    {
        $query = "DELETE FROM panier WHERE id_uti = :id_utilisateur";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue("id_utilisateur", $id_utilisateur, \PDO::PARAM_INT);
        $stmt->execute();
    }


    public function selectionner_medicaments_du_panier(
        int $id_utilisateur,
    ): array {
        $query =
            "SELECT produits.id_pro AS id, produits.libelle_pro AS libelle, produits.description_pro AS description, produits.qte_stock_pro AS quantite_stock, medicaments.forme_med AS forme, medicaments.cis_med AS cis FROM panier INNER JOIN medicaments on panier.id_pro = medicaments.id_pro INNER JOIN produits on medicaments.id_pro = produits.id_pro WHERE id_uti = :id_utilisateur";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue("id_utilisateur", $id_utilisateur, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "\ppe4\models\Medicament");
    }


    public function selectionner_materiels_du_panier(int $id_utilisateur): array
    {
        require_once "Materiel.php";

        $query =
            "SELECT materiels.id_pro AS id, produits.libelle_pro AS libelle, produits.description_pro AS description, produits.qte_stock_pro AS quantite_stock FROM panier INNER JOIN materiels on panier.id_pro = materiels.id_pro INNER JOIN stock_labs.produits on panier.id_pro = produits.id_pro WHERE id_uti = :id_utilisateur";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue("id_utilisateur", $id_utilisateur, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "\ppe4\models\Materiel");
    }


    public function selectionner_quantite_produits_du_panier(
        int $id_utilisateur,
        int $id_produit,
    ): int {
        $query =
            "SELECT qte FROM panier WHERE id_uti = :id_utilisateur AND id_pro = :id_produit";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue("id_utilisateur", $id_utilisateur, \PDO::PARAM_INT);
        $stmt->bindValue("id_produit", $id_produit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_COLUMN);
    }


    public function ajouter_quantite_produit_panier(
        int $id_utilisateur,
        int $id_produit,
        int $qte,
    ): void {
        $query =
            "UPDATE panier SET qte = qte + :qte WHERE id_uti = :id_utilisateur AND id_pro = :id_produit";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue("id_utilisateur", $id_utilisateur, \PDO::PARAM_INT);
        $stmt->bindValue("id_produit", $id_produit, \PDO::PARAM_INT);
        $stmt->bindValue("qte", $qte, \PDO::PARAM_INT);
        $stmt->execute();
    }


    public function verifier_produit_dans_panier(
        int $id_produit,
        int $id_utilisateur,
    ): bool {
        $query =
            "SELECT * FROM panier WHERE id_uti = :id_utilisateur AND id_pro = :id_produit";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue("id_utilisateur", $id_utilisateur, \PDO::PARAM_INT);
        $stmt->bindValue("id_produit", $id_produit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch() !== false;
    }

    public function modifier_quantite_produit_panier(
        int $id_utilisateur,
        int $id_produit,
        int $qte,
    ): void {
        $query =
            "UPDATE panier SET qte = :qte WHERE id_uti = :id_utilisateur AND id_pro = :id_produit";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue("id_utilisateur", $id_utilisateur, \PDO::PARAM_INT);
        $stmt->bindValue("id_produit", $id_produit, \PDO::PARAM_INT);
        $stmt->bindValue("qte", $qte, \PDO::PARAM_INT);
        $stmt->execute();
    }
}
