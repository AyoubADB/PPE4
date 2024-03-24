<?php
include_once ("database.php");
$database = new Database();

if (isset ($_GET["delete_id"])) {
    $delete_id = $_GET["delete_id"];
    $delete_query = $database->dbHandler->prepare("DELETE FROM stock WHERE id_sto = :id_sto ");
    $delete_query->execute(array("id_sto" => $delete_id));
    header("Location: stock.php");
    exit;
}

$requete = $database->dbHandler->query("SELECT * FROM stock");
$stocks = $requete->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
</head>

<body>
    <h1>Stock</h1>
    <br>


    <a href="home.php">Home</a>

    <br>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Qantité</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stocks as $stock): ?>
                <tr>
                    <td>
                        <?php echo $stock["nom_sto"]; ?>
                    </td>
                    <td>
                        <?php echo $stock["description_sto"]; ?>
                    </td>
                    <td>
                        <?php echo $stock["quantite_sto"]; ?>
                    </td>
                    <td>
                        <?php echo $stock["type_sto"]; ?>
                    </td>
                    <td><a href="modifStock.php?id=<?php echo $stock['id_sto']; ?>">Modifier</a>
                        <a href="stock.php?delete_id=<?php echo $stock["id_sto"]; ?>"
                            onclick="return confirm('Êtes-vous sur de vouloir le supprimer')"> Supprimer </a>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <br>
    <br>

    <a href="ajouterStock.php"> Ajouter </a>


</body>

</html>