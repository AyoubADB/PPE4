<?php

use ppe4\controllers\Medicaments;
use ppe4\models\Medicament;

$numero_page = $_GET['no_page'];
$nombre_page = 0;
if (isset($_GET['recherche'])) {
    $recherche = $_GET['recherche'];
}
?>
<!doctype html>
<html lang="fr">

<head>
    <?php require_once ROOT . "app/views/component/head.php" ?>
</head>

<body>
    <?php include_once ROOT . "app/views/component/header.php"; ?>
    <main>

        <div>
            <form class="search" action="index.php?action=recherche_medicament" method="post">
                <label>
                    <input type="text" name="recherche" class="searchTextBox" placeholder="Recherche" <?php if (isset($_GET['recherche']))
                        echo 'value="' . $_GET['recherche'] . '"' ?>>
                    </label>
                    <button type="submit" class="searchButton">
                        <img src="public/img/loupe.svg" alt="rechercher" style="width: 3em">
                    </button>
                </form>
            </div>
            <br>
            <br>
            <br>
            <br>

            <?php
                    require_once ROOT . 'app/controllers/Medicaments.php';
                    $medicaments = new Medicaments();
                    if (isset($recherche)) {
                        $nombre_page = $medicaments->afficher_medicaments_card($numero_page, $recherche);
                    } else {
                        $nombre_page = $medicaments->afficher_medicaments_card($numero_page, null);
                    }
                    ?>

        <?php
        include_once ROOT . 'app/views/component/choix_de_page.php';
        choix_de_page($numero_page, $nombre_page, 'medicaments');
        ?>

    </main>
    <?php include_once ROOT . 'app/views/component/footer.php' ?>
</body>

</html>