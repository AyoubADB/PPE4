<?php
include_once ROOT . 'app/controllers/JWT.php';
$jwt = new \ppe4\controllers\JWT();
$payload = $jwt->get_payload($_COOKIE['JWT']);
$role = $payload['user_role'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>
    <link rel="stylesheet" href="public/style/navbar1.css">
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
</head>

<body>
    <header>
        <div id="nav" class="nav">
            <div class="icon">
                <ul>

                    <li>
                        <a title="dashboard" href="index.php?page=dashboard">
                            <lord-icon src="https://cdn.lordicon.com/laqlvddb.json" trigger="hover" stroke="bold"
                                colors="primary:#ffffff,secondary:#ffffff" style="width:45px;height:45px">
                            </lord-icon>
                        </a>
                    </li>

                    <?php if ($role == 'admin'): ?>
                        <li>
                            <a title="geston-utilisateur" href="index.php?page=liste_utilisateur">
                                <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M4 21C4 17.134 7.13401 14 11 14C11.3395 14 11.6734 14.0242 12 14.0709M15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7ZM12.5898 21L14.6148 20.595C14.7914 20.5597 14.8797 20.542 14.962 20.5097C15.0351 20.4811 15.1045 20.4439 15.1689 20.399C15.2414 20.3484 15.3051 20.2848 15.4324 20.1574L19.5898 16C20.1421 15.4477 20.1421 14.5523 19.5898 14C19.0376 13.4477 18.1421 13.4477 17.5898 14L13.4324 18.1574C13.3051 18.2848 13.2414 18.3484 13.1908 18.421C13.1459 18.4853 13.1088 18.5548 13.0801 18.6279C13.0478 18.7102 13.0302 18.7985 12.9948 18.975L12.5898 21Z"
                                            stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ($role == 'admin'): ?>
                        <li>
                            <a title="creer_utilisateur" href="index.php?page=creation_utilisateur">
                                <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M20 18L14 18M17 15V21M4 21C4 17.134 7.13401 14 11 14C11.695 14 12.3663 14.1013 13 14.2899M15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z"
                                            stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($role == ('validateur')): ?>
                        <li>
                            <a title="valid-commande" href="index.php?page=commande_a_valider">
                                <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M16.0303 10.0303C16.3232 9.73744 16.3232 9.26256 16.0303 8.96967C15.7374 8.67678 15.2626 8.67678 14.9697 8.96967L10.5 13.4393L9.03033 11.9697C8.73744 11.6768 8.26256 11.6768 7.96967 11.9697C7.67678 12.2626 7.67678 12.7374 7.96967 13.0303L9.96967 15.0303C10.2626 15.3232 10.7374 15.3232 11.0303 15.0303L16.0303 10.0303Z"
                                            fill="#ffffff"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25ZM2.75 12C2.75 6.89137 6.89137 2.75 12 2.75C17.1086 2.75 21.25 6.89137 21.25 12C21.25 17.1086 17.1086 21.25 12 21.25C6.89137 21.25 2.75 17.1086 2.75 12Z"
                                            fill="#ffffff"></path>
                                    </g>
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (in_array($role, ['utilisateur', 'Gestionnaire_de_stock'])): ?>
                        <li>
                            <a title="commande-medicament" href="index.php?page=medicaments">
                                <svg class="icone" version="1.1" id="Uploaded to svgrepo.com"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="40px" height="40px" viewBox="0 0 32.00 32.00" xml:space="preserve" fill=""
                                    stroke="" stroke-width="3.2" transform="rotate(0)matrix(1, 0, 0, 1, 0, 0)">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                        stroke="#CCCCCC" stroke-width="0.384"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <style type="text/css">
                                            .bentblocks_een {
                                                fill: #ffffff;
                                            }

                                            .st0 {
                                                fill: #ffffff;
                                            }
                                        </style>
                                        <path class="bentblocks_een"
                                            d="M26,19v2h-6v6h-2v-6h-6v-2h6v-6h2v6H26z M29,20c0,5.523-4.477,10-10,10 c-2.566,0-4.906-0.967-6.676-2.556C11.334,28.406,9.986,29,8.5,29C5.467,29,3,26.533,3,23.5v-15C3,5.467,5.467,3,8.5,3 S14,5.467,14,8.5v2.838C15.471,10.487,17.178,10,19,10C24.523,10,29,14.477,29,20z M5,15h5.338c0.456-0.788,1.016-1.507,1.662-2.141 V8.5C12,6.57,10.43,5,8.5,5S5,6.57,5,8.5V15z M8.5,27c0.968,0,1.842-0.396,2.474-1.034C9.734,24.3,9,22.236,9,20 c0-1.045,0.161-2.053,0.458-3H5v6.5C5,25.43,6.57,27,8.5,27z M27,20c0-4.411-3.589-8-8-8s-8,3.589-8,8c0,4.411,3.589,8,8,8 S27,24.411,27,20z">
                                        </path>
                                    </g>
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (in_array($role, ['utilisateur', 'Gestionnaire_de_stock'])): ?>
                        <li>
                            <a title="commande-materiels" href="index.php?page=materiels">
                                <svg width="40px" height="40px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                    fill="#ffffff">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <defs>
                                            <style>
                                                .cls-1 {
                                                    fill: none;
                                                    stroke: #ffffff;
                                                    stroke-linecap: round;
                                                    stroke-linejoin: round;
                                                    stroke-width: 1.5px;
                                                }
                                            </style>
                                        </defs>
                                        <g id="ic-medicine-heart-hear">
                                            <path class="cls-1" d="M13,3h3V7a6,6,0,0,1-6,6h0A6,6,0,0,1,4,7V3H7"></path>
                                            <path class="cls-1"
                                                d="M10,13v4.5A4.49,4.49,0,0,0,14.5,22h0A4.49,4.49,0,0,0,19,17.5V15"></path>
                                            <circle class="cls-1" cx="19" cy="13" r="2"></circle>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (in_array($role, ['utilisateur', 'Gestionnaire_de_stock'])): ?>
                        <li>
                            <a title="panier" href="index.php?page=materiels">
                                <svg width="37px" height="37px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M1 3C1 2.44772 1.44772 2 2 2C3.62481 2 5.06733 3.03971 5.58114 4.58114L5.72076 5L18.03 5C18.6859 4.99998 19.2437 4.99996 19.6951 5.04029C20.165 5.08226 20.6347 5.17512 21.064 5.43584C21.6667 5.80183 22.1211 6.36838 22.3477 7.03605C22.5091 7.51168 22.4978 7.99036 22.4369 8.45816C22.3783 8.90755 22.2573 9.45209 22.115 10.0924L21.8088 11.4704C21.664 12.1218 21.5435 12.6641 21.4106 13.1043C21.2716 13.5649 21.1006 13.9803 20.8231 14.36C20.4058 14.931 19.8446 15.3812 19.1967 15.6646C18.7658 15.8532 18.3232 15.93 17.8434 15.9658C17.3849 16 16.8295 16 16.1621 16H10.8379C10.1705 16 9.61512 16 9.15656 15.9658C8.67678 15.93 8.23421 15.8532 7.80328 15.6646C7.15536 15.3812 6.59418 14.931 6.17692 14.36C5.89941 13.9803 5.72844 13.5649 5.58939 13.1043C5.45649 12.6641 5.33602 12.1219 5.19125 11.4704L4.035 6.26729L3.68377 5.21359C3.44219 4.48885 2.76395 4 2 4C1.44772 4 1 3.55228 1 3ZM6.24662 7L7.13569 11.0008C7.29042 11.6971 7.39528 12.166 7.50404 12.5263C7.60908 12.8742 7.69899 13.0531 7.79172 13.18C8.00035 13.4655 8.28094 13.6906 8.6049 13.8323C8.74888 13.8953 8.94301 13.9443 9.30546 13.9713C9.68076 13.9994 10.1612 14 10.8745 14H16.1255C16.8388 14 17.3192 13.9994 17.6945 13.9713C18.057 13.9443 18.2511 13.8953 18.3951 13.8323C18.7191 13.6906 18.9997 13.4655 19.2083 13.18C19.301 13.0531 19.3909 12.8742 19.496 12.5263C19.6047 12.166 19.7096 11.6971 19.8643 11.0008L20.153 9.70159C20.3075 9.00651 20.408 8.54985 20.4536 8.19974C20.4982 7.858 20.4722 7.73312 20.4537 7.67868C20.3782 7.45613 20.2267 7.26728 20.0259 7.14528C19.9767 7.11544 19.8605 7.06302 19.5172 7.03235C19.1655 7.00094 18.6979 7 17.9859 7H6.24662Z"
                                            fill="#ffffff"></path>
                                        <path
                                            d="M11 19C11 20.1046 10.1046 21 9 21C7.89543 21 7 20.1046 7 19C7 17.8954 7.89543 17 9 17C10.1046 17 11 17.8954 11 19Z"
                                            fill="#ffffff"></path>
                                        <path
                                            d="M18 21C19.1046 21 20 20.1046 20 19C20 17.8954 19.1046 17 18 17C16.8954 17 16 17.8954 16 19C16 20.1046 16.8954 21 18 21Z"
                                            fill="#ffffff"></path>
                                    </g>
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a title="compte">
                            <svg width="37px" height="37px" viewBox="0 0 48.00 48.00" xmlns="http://www.w3.org/2000/svg"
                                fill="#ffffff" stroke="#ffffff" stroke-width="0.00048000000000000007"
                                transform="rotate(0)">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                    stroke="#CCCCCC" stroke-width="0.672"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M0 0h48v48H0z" fill="none"></path>
                                    <g id="Shopicon">
                                        <path
                                            d="M31.278,25.525C34.144,23.332,36,19.887,36,16c0-6.627-5.373-12-12-12c-6.627,0-12,5.373-12,12 c0,3.887,1.856,7.332,4.722,9.525C9.84,28.531,5,35.665,5,44h38C43,35.665,38.16,28.531,31.278,25.525z M16,16c0-4.411,3.589-8,8-8 s8,3.589,8,8c0,4.411-3.589,8-8,8S16,20.411,16,16z M24,28c6.977,0,12.856,5.107,14.525,12H9.475C11.144,33.107,17.023,28,24,28z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="text">
                <ul>
                    <li><a title="dashboard" href="index.php?page=dashboard">dashboard</a></li>

                    <?php if (in_array($role, ['utilisateur', 'Gestionnaire_de_stock'])): ?>
                        <li><a title="commande-medicament" href="index.php?page=medicaments">Commande Medicaments</a>
                        </li>
                    <?php endif; ?>
                    <?php if (in_array($role, ['utilisateur', 'Gestionnaire_de_stock'])): ?>
                        <li><a title="commande-materiel" href="index.php?page=materiels">Commande Matèriels</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($role == ('validateur')): ?>
                        <li><a title="valid-commande" href="index.php?page=commande_a_valider">Valider une commande</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($role == 'admin'): ?>
                        <li><a href="index.php?page=liste_utilisateur">Gestion des utilisateurs</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($role == 'admin'): ?>
                        <li><a href="index.php?page=creation_utilisateur">Créer un utilisateur</a></li>
                    <?php endif; ?>
                    <?php if (in_array($role, ['utilisateur', 'Gestionnaire_de_stock'])): ?>
                        <li><a href="index.php?page=panier">Panier</a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a href="#">Compte</a>
                        <div class="menu_deroulant">
                            <ul>
                                <?php if (in_array($role, ['utilisateur', 'Gestionnaire_de_stock'])): ?>
                                    <li>
                                        <a href="index.php?page=liste_commande">Vos commandes</a>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <a href="index.php?page=login" onclick="return deconnecter()">Deconnexion</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="info">
                <div class="logo">
                    <img class="logo-stock" src="public/img/logo.svg" alt="">
                </div>
            </div>
        </div>
        <script>
            function deconnecter() {
                document.cookie = "JWT=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
                return true;
            }
        </script>
        </nav>
    </header>
</body>

</html>