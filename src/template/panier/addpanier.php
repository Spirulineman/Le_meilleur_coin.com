<?php
    require_once "../../config/class-singleton.php";
    require_once 'panier.php';
    require_once '../../Model/ArticleModel.php';
    require_once '../../Entity/Article.php';
    $panier = new Panier();
    $articleModel = new ArticleModel();
    $total = 0;
    $id_article =0;
    if(isset($_GET['del'])){
      $panier->del($_GET['del']);
      //$cle = array_search($_GET['del'],$_SESSION["panier"]);
      //echo $cle;
    }
    //var_dump($_SESSION['panier']);
    $id_article =0;
    //var_dump($_GET);
    if(!empty($_GET['id_article_panier'])){
        $id_article = intval($_GET['id_article_panier']);
        $panier->ajouterArticleId($id_article); 
        
        //var_dump($articles);
       // die('le produit a bien été ajouté à votre panier <a href="javascript:history.back()">retour acceuil</a>');
        //var_dump($_SESSION['panier']);
    }
    $articles = $articleModel->selectArticlePanier($_SESSION['panier']);
    ?>
     <table>

<thead>
    <tr>
        <th>Titre</th>
        <th>Prix €</th>
        <th>Nom de photo</th>
    </tr>
</thead>
<tbody>
    <?php if (!empty($articles)):?>
    <?php for ($i = 0; $i < count($articles); $i++) : $total+=$articles[$i]->getPrix()  ?>
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
<label>Prix Total : </label><span><?php echo$total ?>€</span>
<a href="../../index.php">Retour </a>
    
   