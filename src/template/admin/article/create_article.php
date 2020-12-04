<?php

/* ************************************************************************** */
/*                                 CONNEXION BDD                              */
/* ************************************************************************** */

require_once "../../../config/class-singleton.php";

/* ************************************ . *********************************** */

require_once "../../../Model/ArticleModel.php";
require_once "../../../Entity/Article.php";
require_once "../../../outil/outil.php";
require_once "../../../Entity/User.php";

/* ************************************************************************** */
session_start();



$user= new User();

$errors  = array();
$id = 0;

if (isset($_GET['id'])) {

    $id = intval($_GET['id']);
}

if(isset($_SESSION['userconnecte'])){

    $user = $_SESSION['userconnecte'];
}

$articleModel = new ArticleModel();

if (isset($_POST['add'])) {

    if (!empty($_POST['titre'])) {
        $titre = strip_tags(htmlspecialchars(trim(($_POST['titre']))));
    } else {
        $errors[] =  "veuillez rentrer un titre dans le champ qui va bien ;-P ";
    }

    if (!empty($_POST['description'])) {
        $description = strip_tags(htmlspecialchars(trim(($_POST['description']))));
    } else {
        $errors[] =  "veuillez rentrer un description dans le champ qui va bien ;-P ";
    }

    if (!empty($_POST['prix'])) {
        $prix = strip_tags(htmlspecialchars(trim(($_POST['prix']))));
    } else {
        $errors[] =  "veuillez rentrer une prix dans le champ qui va bien ;-P ";
    }


    if (isset($_FILES['photo']["name"]) && !empty($_FILES['photo']["name"])) { // on appelle dans $_FILES photo & name qui permettent de peupler le type et le nom dans le tableau associatif $_FILES 
        //pre_var_dump($_FILES,NULL,true);
        $photo = $_FILES['photo']["name"];
        $photo = upload_file($photo, '../../../images/', 'photo');
    } else {
        $photo = null;
    }

    if (empty($errors)) {

        $articleModel->createArticle($titre, $description, $prix, $photo, $user->getId());
        header_location('get_article.php');
    }
    /* else{
        pre_var_dump('create_article.php l 69', $errors);
    } */
}

pre_var_dump($user);
?>

<!-- /* *******************************  RENDU  *********************************** */ -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creer un Article</title>
</head>

<body>
    <h1> Créer des Articles </h1>
    <form method="post" enctype="multipart/form-data">

        <div>
            <label for="titre">Titre</label>
            <input type="text" name="titre">
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="" cols="30" rows="10"></textarea>
        </div>

        <div>
            <label for="prix">Prix</label>
            <input type="text" name="prix">
        </div>

        <div>
            <div>
                <label for="photo">Photo </label>
            </div>
            <input type="file" name="photo">
        </div>

        <div>
            <input type="hidden" name="id_user" value="<?= $user->getId() ?>">
        </div>

        <div>
            <input type="submit" value="Ajouter" name="add">
        </div>

    </form>
    <a href="../../../index.php">Retour à l'Accueil</a>
</body>

</html>