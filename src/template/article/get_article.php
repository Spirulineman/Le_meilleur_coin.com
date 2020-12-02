<?php

/* ************************************************************************** */
/*                                 CONNEXION BDD                              */
/* ************************************************************************** */

require_once "../../config/class-singleton.php";

/* ************************************ . *********************************** */

require_once "../../Model/ArticleModel.php";
require_once "../../Entity/Article.php";
require_once "../../outil/outil.php";

/* ************************************************************************** */

$articleModel = new ArticleModel();
$articles = $articleModel->selectAllArticle();

?>

<!-- /* *******************************  RENDU  *********************************** */ -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="create_article.php">Ajouter un article</a>
    <div>
        
        <h1>Liste des Articles</h1>
    </div>
    
            <?php for ($i = 0; $i < count($articles); $i++) : ?>
                
            <?php endfor ?>
</body>

</html>