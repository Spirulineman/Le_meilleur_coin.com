<?php 


require_once "../../../Entity/User.php";
// require_once "../../../outil/outil.php";

if(isset($_SESSION['userconnecte'])){
    $session = serialize($_SESSION['userconnecte']);
    $session = unserialize($session);
}

// pre_var_dump($session->getAdmin()  == "1",null);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/normalize.css">
    <link rel="stylesheet" href="../../../css/style.css">
    <script src="../../../lib/less.js" async></script>
    <title>Index</title>

    <!-- /* ******************************** LESSTOCSS ******************************* */ -->

    <link rel="lib/LessToCss/stylesheet/less" type="text/css" href="test.less" />
    <script src="JsDelivr.js"></script>
</head>

<body class="body">
    <div class="headersticky">
    <header>
        <h1>
            Le Meilleur coin 
        </h1>


        <nav>
            <ul>
                


                <?php if (!empty($session)) : ?>

                    <?php if ($session->getAdmin() == "1") : ?>

                        <li><a href="../../admin/article/get_article.php">Gestion des articles</a></li>
                        <li><a href="../../admin/article/create_article.php">Ajouter un article </a></li>
                        <li><a href="../../admin/user/Get_users.php">Gestion des utilisateurs </a></li>
                        <li><a href="../../admin/user/Create_user.php">Ajouter un utilisateur </a></li>

                    <?php else : ?>

                        <li><a href="../../user/article/get_all_article.php">Accueil</a></li>
                        <li><a href="../../user/panier/addpanier.php">Panier</a></li>
                        <li><a href="../../user/article/create_article.php">Créer un article </a></li>
                        <li><a href="../../user/tableauBord/tableauBord.php">Tableau de bord </a></li>

                    <?php endif ?>

                    <li><a href="../../user/article/get_all_article.php?deco=1">Déconnexion</a></li>

                <?php else : ?>

                    <li><a href="../../user/article/get_all_article.php">Accueil</a></li>
                    <li><a href="../../user/panier/addpanier.php">Panier</a></li>
                    <li><a href="../../user/user/User_connect.php">Connexion</a></li>
                    <li><a href="../../user/user/create_user.php">Inscription</a></li>

                <?php endif ?>
            </ul>
        </nav>

    </header>
    