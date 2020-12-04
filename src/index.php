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
var_dump($user->getAdmin());
?>


<!-- /* *******************************  RENDU  *********************************** */ -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>

    <!-- /* ******************************** LESSTOCSS ******************************* */ -->

    <link rel="lib/LessToCss/stylesheet/less" type="text/css" href="test.less" />
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
    <table>

        <thead id="thead_table">
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Date de création</th>
                <th>Prix €</th>
                <th>Nom de photo</th>
                <th>Disponibilité</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($articles); $i++) : ?>
                <tr>
                    <td><?= $articles[$i]->getTitre() ?></td>
                    <td><?= $articles[$i]->getDescription() ?></td>
                    <td><?= $articles[$i]->getDate_creation()->format('d/m/Y') ?></td>
                    <td><?= $articles[$i]->getPrix() ?> €</td>
                    <td><?= $articles[$i]->getPhoto() ?></td>
                    <td>
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
                            <td><a href="template/user/article/update_article.php?id=<?= $articles[$i]->getId() ?>">Modifier</a></td>
                            <td><a href="template/user/article/delete_article.php?id=<?= $articles[$i]->getId() ?>">supprimer</a></td>

                    <?php
                        }
                    }
                    ?>

                </tr>
            <?php endfor ?>
        </tbody>

    </table>
    <div>
        <?php if (!empty($articles_panier)) : ?>
            <?php for ($i = 0; $i < count($articles_panier); $i++) : $total += $articles_panier[$i]->getPrix();
                $elements = count($articles_panier) ?>
            <?php endfor ?>
        <?php endif ?>
        <label>Total : </label><span><?= $total ?>€</span>
        <label>Elément(s) : </label><span><?= $elements ?></span>
        <a href="template/panier/addpanier.php">Panier</a>
    </div>
    <div>

        <?php for ($i = 0; $i < count($articles); $i++) : ?>
            <div>
                <div><label>Titre : </label><span><?= $articles[$i]->getTitre() ?></span></div>
                <div><label>Description : </label><span><?= $articles[$i]->getDescription() ?></span></div>
                <div><label>Date de création : </label><span><?= $articles[$i]->getDate_creation()->format('d/m/Y') ?></span></div>
                <div><label>Prix € : </label><span><?= $articles[$i]->getPrix() ?>€</span></div>
                <div><label>Nom de photo : </label><span><?= $articles[$i]->getPhoto() ?></span></div>
                <div>
                    <label>Disponibilité :</label>
                    <span>
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
    <a href="template/user/article/create_article.php">Créer Article </a>
    <a href="template/user/tableauBord.php">Tableau de bord </a>
    <?php if(isset($user) && $user->getAdmin() ==1 ){?>
        <a href="template/admin/user/Get_users.php">Gestion des utilisateur</a>
    <?php }?>
</body>

</html>