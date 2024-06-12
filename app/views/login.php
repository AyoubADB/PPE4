<!doctype html>
<html lang="en">

<head>
    <?php require_once (ROOT . "./app/views/component/head.php") ?>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/style/login.css">
</head>

<body>

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>


    <div>
        <div>

            <form action="index.php?action=login" class="form" method="post" id="login">
                <h2>Login</h2>
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Addresse e-mail">

                <label for="password">Mot de passe</label>
                <input type="password" name="password" placeholder="Mot de passe">

                <button type="submit" value="connexion">Connexion</button>
            </form>
        </div>
    </div>

</body>

</html>