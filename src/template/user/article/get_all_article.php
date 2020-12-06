<?php
/* ************************************************************************** */
/*                                 CONNEXION BDD                              */
/* ************************************************************************** */

require_once "../../../config/class-singleton.php";

/* ************************************ . *********************************** */

require_once "../../../Model/UserModel.php";
require_once "../../../Entity/User.php";
// require_once "../../../inc/outils__perso__jonas__.php";

require_once "../../../Model/ArticleModel.php";
require_once "../../../Entity/Article.php";
require_once '../../../template/user/panier/panier.php';
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
if (isset($_GET['deco'])) {
    unset($_SESSION['userconnecte']);
    //session_destroy();
}
//}
//pre_var_dump($_SESSION, NULL, true);

$articleModel = new ArticleModel();
$articles = $articleModel->selectAllArticle();
// var_dump($_SESSION);

?>


<!-- /* *******************************  RENDU  *********************************** */ -->
<!-- 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>

    <! -- /* ******************************** LESSTOCSS ******************************* */ -- >

    <link rel="lib/LessToCss/stylesheet/less" type="text/css" href="test.less" />
    <script src="JsDelivr.js"></script>
</head>
<! -- *****************************************************************    -->

<body>
<?php $title = 'Tarifs'; ?>

<!-- demarre une tamporisation de sortie -->
<?php ob_start(); ?>

    <div>
        <h1> Gestion des Articles </h1><br>
        <h3>Liste des Articles</h3>
    </div>
    <div>
        <?php
        if (isset($_GET['success'])) {
            echo "Votre commande à bien été validée";
        }
        ?>
        <br>
    </div>
   
    <div class="total">
        <?php if (!empty($articles_panier)) : ?>
            <?php for ($i = 0; $i < count($articles_panier); $i++) : ?>
                <?php 
                    $total += (int) $articles_panier[$i]->getPrix();
                    $elements = count($articles_panier) 
                ?>
                    <?php // pre_var_dump( $articles_panier[$i]->getPrix() , null, true) ?>
            <?php endfor ?>
        <?php endif ?>

        <label>Total : </label><span><?= $total ?>€</span>
        <label>Elément(s) : </label><span><?= $elements ?></span>
        <a href="../../../template/user/panier/addpanier.php">Panier</a>
    </div>
    <div>

        <?php for ($i = 0; $i < count($articles); $i++) : ?>
            <div class="article">
                <?php if($articles[$i]->getTitre() != null): ?>
                    <img src="../../../images/<?= $articles[$i]->getPhoto() ?>" alt="" srcset="">
                <?php endif ?>
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
                            <a href="update_article.php?id=<?= $articles[$i]->getId() ?>">Modifier</a>
                            <a  class="supp" href="delete_article.php?id=<?= $articles[$i]->getId() ?>">supprimer</a>
                        <?php
                        } else {
                        ?>
                            <a class="add" href="get_all_article.php?id_article_panier=<?= $articles[$i]->getId() ?>">Ajouter au panier</a>
                        <?php
                        }
                    } else {
                        ?>
                        <a class="add" href="get_all_article.php?id_article_panier=<?= $articles[$i]->getId() ?>">Ajouter au panier</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php endfor ?>
    </div>



    
   
</body>

<!-- </html> -->
<!-- fermer la tamporisation de sortie et le mettre dans une variable -->
<?php $content = ob_get_clean(); ?>
<?php require_once '../../../view_template.php'; ?>