<?php
/* ************************************************************************** */

require_once "../../config/class-singleton.php";
require_once 'panier.php';
require_once '../../Model/ArticleModel.php';
require_once '../../Entity/Article.php';

require_once "../../Entity/User.php";

require_once "../../outil/outil.php";

/* ************************************************************************** */

session_start();

$compteur = 0;


$user= new User();
//pre_var_dump($_SESSION['userconnecte']);
if(!empty(($_SESSION['userconnecte']))){

    $user= ($_SESSION['userconnecte']);
    
}

$panier = new Panier();
$articleModel = new ArticleModel();
$total = 0;
$id_article = 0;
if (isset($_GET['del'])) {
    $panier->del($_GET['del']);
    //$cle = array_search($_GET['del'],$_SESSION["panier"]);
    //echo $cle;
}
//var_dump($_SESSION['panier']);
$id_article = 0;
//var_dump($_GET);
if (!empty($_GET['id_article_panier'])) {
    $id_article = intval($_GET['id_article_panier']);
    $panier->ajouterArticleId($id_article);

    //var_dump($articles);
    // die('le produit a bien été ajouté à votre panier <a href="javascript:history.back()">retour accueil</a>');
    //var_dump($_SESSION['panier']);
}

//pre_var_dump($_SESSION['panier'],null,true);
if(isset($_POST['commande'])){
    if(!empty($_SESSION['panier'])){

        for ($i = 0; $i < count($_SESSION['panier']); $i++) {
            //pre_var_dump(intval($_SESSION['panier'][$i]));
            pre_var_dump($_SESSION['panier']);
        

            if($articleModel->finCommande($user->getId(), intval($_SESSION['panier'][$i]))){

                $articleModel->desactiveArticles_Vendus(intval($_SESSION['panier'][$i]));
                $compteur++;
                
                
            }

            //pre_var_dump($_SESSION['panier'][$i],NULL,true);
        }
        $_SESSION['panier'] = array();
        if ($compteur != 0){

            $_SESSION['panier'] = array();
        }

        header('Location: ../../index.php?success=true');
        die;
    }

    
}



$articles = $articleModel->selectArticlePanier($_SESSION['panier']);
?>

<!-- demarre une tamporisation de sortie -->
<?php ob_start(); ?>
<table>

    <thead>
        <tr>
            <th>Titre</th>
            <th>Prix €</th>
            <th>Nom de photo</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($articles)) : ?>
            <?php for ($i = 0; $i < count($articles); $i++) : $total += $articles[$i]->getPrix()  ?>
                <tr>
                    <td><?= $articles[$i]->getTitre() ?></td>
                    <td><?= $articles[$i]->getPrix() ?> €</td>
                    <td><?= $articles[$i]->getPhoto() ?></td>
                    <td><a href="addpanier.php?del=<?= $articles[$i]->getId() ?>">supprimer</a></td>
                </tr>
            <?php endfor ?>
        <?php endif ?>
    </tbody>

</table>

<label>Prix Total : </label><span><?php echo $total ?>€</span>
<a href="../../index.php">Retour </a>

<br>
<form method="post" id="commande">
    <input type="submit" value="payer la commande" id="commande" name="commande">
</form>

<?php $content = ob_get_clean(); ?>
<?php require_once '../../view_template.php'; ?>