<?php
/* ************************************************************************** */
/*                                 CONNEXION BDD                              */
/* ************************************************************************** */

require_once "config/class-singleton.php";

/* ************************************ . *********************************** */

require_once "Model/UserModel.php";
require_once "Entity/User.php";
require_once "inc/outils__perso__jonas__.php";

require_once "Model/ArticleModel.php";
require_once "Entity/Article.php";
require_once 'template/panier/panier.php';
/* ************************************************************************** */


session_start();

//$_SESSION['panier']= array();
$panier = new Panier();
$articleModel = new ArticleModel();
$id_article = 0;
$total = 0;
$elements = 0;
if (!empty($_GET['id_article_panier'])) {
    $id_article = intval($_GET['id_article_panier']);
    $panier->ajouterArticleId($id_article);
}
$articles_panier = $articleModel->selectArticlePanier($_SESSION['panier']);
//$_SESSION['panier']= array();
//var_dump(implode(',',$_SESSION['panier']));
if (isset($_SESSION['userconnecte'])) {


    $user = new User();
    $user = ($_SESSION['userconnecte']);
}
if (isset($_POST['deco'])) {
    unset($_SESSION['userconnecte']);
    //session_destroy();
}
//}
//pre_var_dump($_SESSION, NULL, true);

$articleModel = new ArticleModel();
$articles = $articleModel->selectAllArticle();
// pre_var_dump($_SESSION['userconnecte']);
?>


<!-- /* *******************************  RENDU  *********************************** */ -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>

    <!-- /* ******************************** LESSTOCSS ******************************* */ -->

    <link rel="stylesheet/less" type="text/css" href="test.less" />
    <script src="less.js" type="text/javascript"></script>
    <script src="JsDelivr.js"></script>
</head>
<!-- *****************************************************************    -->

<body>
    <div>
        <h1> Gestion des Articles </h1><br>
        <h3>Liste des Articles</h3>
    </div>
    <div>
        <?php
        if (isset($_GET['success'])) {
        ?>
            <div><?= "|**************************************************************************************************|" ?></div>
            <div><?= "|-------------------------------------- =!=>>| Votre commande à bien été validée |<<=!= -----------------------------------------------|" ?></div>
            <div><?= "|**************************************************************************************************|" ?></div>
        <?php
        }
        ?>
        <br>
    </div>
    <table id="tb_back">

        <thead id="thead_table">
            <tr>
                <th id="th_titre">Titre</th>
                <th id="th_descript">Description</th>
                <th id="th_dateCrea">Date de création</th>
                <th id="th_prix">Prix €</th>
                <th id="th_photo">Nom de photo</th>
                <th id="th_dispo">Disponibilité</th>
                <th id="th_modif">Modifier</th>
                <th id="th_suppr">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($articles); $i++) : ?>
                <tr>
                    <td id="titre"><b><?= $articles[$i]->getTitre() ?></b></td>
                    <td id="descript"><?= $articles[$i]->getDescription() ?></td>
                    <td id="date_crea"><?= $articles[$i]->getDate_creation()->format('d/m/Y') ?></td>
                    <td id="prix"><?= $articles[$i]->getPrix() ?> €</td>
                    <td id="photo"><?= $articles[$i]->getPhoto() ?></td>
                    <td id="dispo">
                        <?php if ($articles[$i]->getDisponible() == '1') : ?>
                            Disponible
                        <?php else : ?>
                            Indisponible
                        <?php endif ?>
                    </td>
                    <?php

                    if (!empty($_SESSION['userconnecte'])) {
                        if ($articles[$i]->getId_user() == $user->getId()) {

                    ?>
                            <td id="modif"><a href="template/user/article/update_article.php?id=<?= $articles[$i]->getId() ?>">Modifier</a></td>

                            <td id="supp"><a href="template/user/article/delete_article.php?id=<?= $articles[$i]->getId() ?>">supprimer</a></td>

                    <?php
                        }
                    }
                    ?>

                </tr>
            <?php endfor ?>

        <tfoot id="thead_table">
            <tr>
                <th id="th_titre">Titre</th>
                <th id="th_descript">Description</th>
                <th id="th_dateCrea">Date de création</th>
                <th id="th_prix">Prix €</th>
                <th id="th_photo">Nom de photo</th>
                <th id="th_dispo">Disponibilité</th>
                <th id="th_modif">Modifier</th>
                <th id="th_suppr">Supprimer</th>
            </tr>
        </tfoot>
        </tbody>

    </table>
    <div id="panier">
        <?php if (!empty($articles_panier)) : ?>
            <?php for ($i = 0; $i < count($articles_panier); $i++) : $total += $articles_panier[$i]->getPrix();
                $elements = count($articles_panier) ?>
            <?php endfor ?>
        <?php endif ?>
        <label>Vous avez : </label><span>
            <h3><?= $elements ?></h3>
        </span>
        <a id="link_panier" href="template/panier/addpanier.php"> produit(s) dans votre panier</a>
        <div>
            <label id="total">Pour un <b>TOTAL</b> de : </label><span>
                <h3 id="prix_total"><?= $total ?> €</h3>
            </span>
        </div>


    </div>
    <div id="article">
        <?php for ($i = 0; $i < count($articles); $i++) : ?>
            <div>
                <table id="tab_left"">
                    <tr>
                        <div><b><label id="titre">Titre : </label><span><?= $articles[$i]->getTitre() ?></span></b></div>
                    </tr>
                    <tr>
                        <div><b><label id="descript">Description : </label></b><span><?= $articles[$i]->getDescription() ?></span></div>
                    </tr>
                    <tr>
                        <div><b><label id="dateCrea">Date de création : </label></b><span><?= $articles[$i]->getDate_creation()->format('d/m/Y') ?></span></div>
                    </tr>

                </table>
            
                <div>
                    <h4><label id="prix">Prix : </label></h4>
                    <h2><span id="span_prix"><?= $articles[$i]->getPrix() ?>€</span></h2>
                </div>
                <div><b><label id="nom">Nom de photo : </label></b><span><?= $articles[$i]->getPhoto() ?></span></div>
                <div><b><label id="dispo">Disponibilité :</label></b><span>

                        <?php if ($articles[$i]->getDisponible() == '1') : ?>
                            Disponible
                        <?php else : ?>
                            Indisponible
                        <?php endif ?>
                    </span>
                </div>
                <div>
                    <?php
                    if (!empty($_SESSION['userconnecte'])) {
                        if ($articles[$i]->getId_user() == $user->getId()) {  ?>
                            <td><a href="update_article.php?id=<?= $articles[$i]->getId() ?>">Modifier</a></td>
                            <td><a href="delete_article.php?id=<?= $articles[$i]->getId() ?>">supprimer</a></td>
                        <?php
                        } else {
                        ?>
                            <a class="add" href="index.php?id_article_panier=<?= $articles[$i]->getId() ?>">Ajouter au panier</a>
                        <?php
                        }
                    } else {
                        ?>
                        <a class="add" href="index.php?id_article_panier=<?= $articles[$i]->getId() ?>">Ajouter au panier</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php endfor ?>
    </div>



    <div>
        <?php
        if (!empty($_SESSION['userconnecte'])) {
        ?>
            <form method="post">
                <input type="submit" value="déconnexion" id="deco" name="deco">
            </form>
        <?php
        } else {
        ?>
            <a href="template/user/User_connect.php">Se connecter</a>

        <?php
        }
        ?>

    </div>
</body>

</html>