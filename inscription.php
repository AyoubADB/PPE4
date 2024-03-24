<?php
include ("database.php");
include_once ("config.php");
$database = new Database();

if (isset ($_POST["ok"])) {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $password = $_POST["pass"];

    $requete = $database->dbHandler->prepare("INSERT INTO utilisateur (nom_u, prenom_u, email_u, password_u, id_r) VALUES (:nom_u, :prenom_u, :email_u, :password_u, 1)");
    $requete->execute(
        array(
            "nom_u" => $nom,
            "prenom_u" => $prenom,
            "email_u" => $email,
            "password_u" => $password,
        )
    );

    header("Location: " . BASE_URL . LOGIN_PAGE);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription</title>
</head>

<body>
    <h1>Inscription</h1>
    <form action="" method="POST">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" placeholder="Entrez votre nom">
        <br>
        <br>
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" placeholder="Entrez votre prénom">
        <br>
        <br>
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" placeholder="Entrez votre e-mail">
        <br>
        <br>
        <label for="password">Mot de passe</label>
        <input type="password" name="pass" id="pass" placeholder="Entrez votre mot de passe">
        <br>
        <br>
        <br>
        <input type="submit" name="ok" value="Inscription">
    </form>

    <a href="login.php">J'ai deja un compte ?</a>

</body>

</html>