<?php
include_once ("database.php");
$database = new Database();

if (isset ($_GET["id"])) {
    $id = $_GET["id"];
    $query = $database->dbHandler->prepare("SELECT * FROM stock WHERE id_sto = :id_sto");
    $query->execute(array("id_sto" => $id));
    $stock = $query->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: stock.php");
    exit;
}

if (isset ($_POST["validModif"])) {
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $quantite = $_POST["quantite"];
    $type = $_POST["type"];

    $update_query = $database->dbHandler->prepare("UPDATE stock SET nom_sto = :nom_sto, description_sto = :description_sto, quantite_sto = :quantite_sto, type_sto = :type_sto WHERE id_sto = :id_sto");
    $update_query->execute(array("nom_sto" => $nom, "description_sto" => $description, "quantite_sto" => $quantite, "type_sto" => $type, "id_sto" => $id));
    header("Location: stock.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Le Stock</title>
</head>

<body>
    <h1>Modifier le Stock</h1>

    <form action="" method="POST">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom" value="<?php echo $stock["nom_sto"]; ?>">

        <label for="description">Descripton:</label>
        <input type="text" name="description" id="description" value="<?php echo $stock["description_sto"]; ?>">

        <label for="quantite">Quantité:</label>
        <input type="text" name="quantite" id="quantite" value="<?php echo $stock["quantite_sto"]; ?>">

        <label for="type">Type:</label>
        <input type="text" name="type" id="type" value="<?php echo $stock["type_sto"]; ?>">

        <input type="submit" name="validModif" value="Valider">
    </form>
    <br>
    <br>
    <br>
    <a href="stock.php">Annuler</a>

</body>

</html>