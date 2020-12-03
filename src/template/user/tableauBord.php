<?php

/* ************************************************************************** */
/*                                 CONNEXION BDD                              */
/* ************************************************************************** */

require_once "config/class-singleton.php";

/* ************************************ . *********************************** */

require_once "../../Model/UserModel.php";
require_once "../../Entity/User.php";
require_once "../../inc/outils__perso__jonas__.php";

require_once "../../Model/ArticleModel.php";
require_once "../../Entity/Article.php";
require_once '../panier/panier.php';
/* ************************************************************************** */


session_start();


$articleModel = new ArticleModel();





