<?php
require_once ROOT . 'app/models/Utilisateur.php';
require_once ROOT . 'app/controllers/Creation_utilisateur.php';


?>
<!doctype html>
<html lang="fr">

<head>
    <?php require_once ROOT . "app/views/component/head.php" ?>
    <link rel="stylesheet" href="public/style/creation_utilisateur.css">
</head>

<body>
    <?php include_once ROOT . "app/views/component/header.php"; ?>
    <main>
        <form method="post" action="index.php?action=creer_utilisateur">
            <div>
                <p>Nom</p>
                <label>
                    <input type="text" name="nom" placeholder="Entrez nom">
                </label>
            </div>
            <div>
                <p>Prenom</p>
                <label>
                    <input type="text" name="prenom" placeholder="Entrez prenom">
                </label>
            </div>
            <div>
                <input type="number" name="id_utilisateur" style="display: none">
                <p>Email</p>
                <label>
                    <input type="email" name="email" placeholder="Entrez e-mail">
                </label>
            </div>
            <div>
                <p>Mot de passe </p>
                <label>
                    <input type="password" name="motdepasse" placeholder="Entrez mot de passe">
                </label>
            </div>
            <div>
                <p>Role</p>
                <label>
                    <select name="libelle_role">
                        <?php
                        $creation_utilisateur = new \ppe4\controllers\Creation_utilisateur();
                        echo $creation_utilisateur->afficher_option_role()
                            ?>
                    </select>
                </label>
            </div>
            <button type="submit">Créer utilisateur</button>
        </form>
    </main>
    <?php include_once ROOT . 'app/views/component/footer.php' ?>
</body>

</html>