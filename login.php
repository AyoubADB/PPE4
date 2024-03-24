<?php
include ("database.php");
include ("config.php");
$database = new Database();

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["emailLog"];
    $password = $_POST["passLog"];
    if ($email != "" && $password != "") {
        $requete = $database->dbHandler->prepare("SELECT * FROM utilisateur WHERE email_u = :email_u AND password_u = :password_u");
        $requete->execute(
            array(
                "email_u" => $email,
                "password_u" => $password,
            )
        );

        $user = $requete->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: ' . BASE_URL . HOME_PAGE);
            exit();
        } else {
            $error_msg = "E-mail ou Mot de passe incorrecte";
        }
    } else {
        $error_msg = "Veuillez fournir un e-mail et un mot de passe";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>
    <h1>Login</h1>
    <br>
    <br>

    <form method="POST" action="">
        <label for="emailLog">E-mail</label>
        <input type="email" id="emailLog" name="emailLog" placeholder="Entrez votre e-mail">
        <br>
        <br>
        <label for="passLog">Mot de passe</label>
        <input type="password" id="passLog" name="passLog" placeholder="Entrez votre mot de passe">
        <br>
        <br>
        <br>
        <br>
        <input type="submit" name="login" id="login" value="Connexion">
    </form>

    <?php
    if (!empty ($error_msg)): ?>
        <p>
            <?php echo $error_msg; ?>
        </p>

    <?php endif; ?>

    <button onclick="redirectToInscription()">Inscription</button>

    <script>
        function redirectToInscription() {
            window.location.href = 'inscription.php';
        }
    </script>

</body>

</html>