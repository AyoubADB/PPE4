<?php
include_once ("database.php");
$database = new Database();

if (isset ($_POST["validAjout"])) {
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $quantite = $_POST["quantite"];
    $type = $_POST["type"];

    $ajout_query = $database->dbHandler->prepare("INSERT INTO stock (nom_sto, description_sto, quantite_sto, type_sto) VALUES (:nom_sto, :description_sto, :quantite_sto, :type_sto)");
    $ajout_query->execute(array("nom_sto" => $nom, "description_sto" => $description, "quantite_sto" => $quantite, "type_sto" => $type));

    header("Location: stock.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Ajouter du Stock</h1>

    <form action="" method="post">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom" placeholder="Entrez le nom">

        <label for="description">Descripton:</label>
        <input type="text" name="description" id="description" placeholder="Entrez la description">

        <label for="quantite">Quantité:</label>
        <input type="text" name="quantite" id="quantite" placeholder="Entre la quantité">

        <label for="type">Type:</label>
        <select name="type" id="type">
            <?php
            // Options de la combobox
            $types = array("médicament", "matériel");

            // Génération des options avec une boucle foreach
            foreach ($types as $type) {
                echo "<option value='$type'>$type</option>";
            }
            ?>
        </select>

        <input type="submit" name="validAjout" value="Valider">
    </form>
    <br>
    <br>
    <br>
    <a href="stock.php">Annuler</a>

</body>

</html>