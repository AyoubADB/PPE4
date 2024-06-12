<?php
include_once ROOT . 'app/controllers/JWT.php';
$jwt = new \ppe4\controllers\JWT();
$payload = $jwt->get_payload($_COOKIE['JWT']);
$role = $payload['user_role'];
?>
<!doctype html>
<html lang="en">

<head>
    <?php require_once ROOT . "app/views/component/head.php" ?>
    <link rel="stylesheet" href="public/style/dashboard.css">
</head>

<body>
    <?php include_once ROOT . "app/views/component/header.php"; ?>
    <main>

        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>

        <div class="dashboard">
            <?php if (in_array($role, ['utilisateur', 'Gestionnaire_de_stock'])): ?>
                <div class="card2">
                    <a class="h33" href="index.php?page=medicaments">
                        <img src="public/img/med.svg" alt="">
                        <h3>Commander des médicaments</h3>
                    </a>
                </div>

            <?php endif; ?>

            <?php if (in_array($role, ['utilisateur', 'Gestionnaire_de_stock'])): ?>
                <div class="card2">
                    <a class="h33" href="index.php?page=materiels">
                        <img src="public/img/mat.svg" alt="">
                        <h3>Commander des matériels</h3>

                    </a>
                </div>
            <?php endif; ?>


            <?php if ($role == ('validateur')): ?>
                <div class="card2">
                    <a class="h33" href="index.php?page=commande_a_valider">
                        <img src="public/img/ok.svg" alt="img-check">
                        <h3>Valider une commande</h3>
                    </a>
                </div>
            <?php endif; ?>
            <?php if ($role == 'admin'): ?>
                <div class="card">
                    <a class="h33" href="index.php?page=liste_utilisateur">
                        <img src="public/img/gest_u.svg" alt="">
                        <h3>Gestion des utilisateurs</h3>
                    </a>
                </div>
            <?php endif; ?>
            <?php if ($role == 'admin'): ?>
                <div class="card2">
                    <a class="h33" href="index.php?page=creation_utilisateur">
                        <img src="public/img/ajout_u.svg" alt="">
                        <h3>Créer un utilisateur</h3>
                    </a>
                </div>
            <?php endif; ?>
        </div>

    </main>
    <?php include_once ROOT . 'app/views/component/footer.php' ?>
</body>

</html>