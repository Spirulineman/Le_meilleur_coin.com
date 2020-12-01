<?php

/* ************************************************************************** */
/*                                 CONNEXION BDD                              */
/* ************************************************************************** */

require_once "../../../config/class-singleton.php";

/* ************************************ . *********************************** */

require_once "../../../Model/ArticleModel.php";
require_once "../../../Entity/Article.php";
require_once "../../../outil/outil.php";

/* ************************************************************************** */


if (isset($_GET['id'])) {
    
    $articleModel = new ArticleModel();
    $articleModel->deleteArticle($_GET['id']);
    header_location('get_article.php');
}