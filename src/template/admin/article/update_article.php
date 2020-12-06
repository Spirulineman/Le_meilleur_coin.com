<?php

session_start();

/* ************************************************************************** */
/*                                 CONNEXION BDD                              */
/* ************************************************************************** */

require_once "../../../config/class-singleton.php";

/* ************************************ . *********************************** */

require_once "../../../Model/ArticleModel.php";
require_once "../../../Entity/Article.php";
require_once "../../../outil/outil.php";

/* ************************************************************************** */

$errors  = array();
$id = 0;

if (isset($_GET['id'])) {

    $id = intval($_GET['id']);
}

$articleModel = new ArticleModel();
$article = $articleModel->selectArticleById($id);


if (isset($_POST['update'])) {

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

    if (!empty($_POST['id_user'])) {
        $id_user = (int) $_POST['id_user'];
    } else {
        $errors[] =  "veuillez rentrer le user dans le champ qui va bien ;-P ";
    }

    

    if (isset($_POST['disponible'])) {
        $disponible = (int) $_POST['disponible'];
    } else {
        $errors[] =  "veuillez rentrer le disponible dans le champ qui va bien ;-P ";
    }

    if (!empty($_FILES['photo']["name"]) && isset($_FILES['photo']["name"])) {

        $photo = $_FILES['photo']["name"];
        $photo = upload_file($photo, '../../../images/', 'photo');
        //var_dump($photo);
        //die;

    } else {
        $photo = $article->getPhoto();
    }

    //pre_var_dump('update_article.php l 66', $photo );

    if (empty($errors)) {

        $articleModel->updateArticle($id, $titre, $description, $prix, $photo, $disponible, $id_user);
        header_location('get_article.php');
    }
    else{
       // pre_var_dump('update_article.php l 69', $errors);
    }
}

//pre_var_dump($article);
?>

<!-- /* *******************************  RENDU  *********************************** */ -->
<!-- demarre une tamporisation de sortie -->
<?php ob_start(); ?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../../lib/jquery-3.5.1.min.js"></script>
    <script src="../../../lib/jquery.validate.min.js"></script>
    <script src="../../../lib/messages_fr.js"></script>
    <script>
        $(function() {

        
            $('#modfier_article_admin').validate({

                rules: {
                    titre: {
                        minlength: 2,
                        required: true
                    },

                    description: {

                        minlength: 2,
                        required: true
                    },

                    prix: {

                        digits: true,
                        required: true
                    },

                    disponible: {

                        required: true,
                        
                    },
                   

                }

            });

        });
    </script>
    <title>Modifier un Article</title>
</head>

<body>
    <h1> Modifier un Article </h1>
    <form method="post" enctype="multipart/form-data" id="modfier_article_admin">

        <div>
            <label for="titre">Titre</label>
            <input type="text" name="titre" value="<?= $article->getTitre() ?>">
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="" cols="30" rows="10"><?= $article->getDescription() ?></textarea>
        </div>

        <div>
            <label for="prix">Prix</label>
            <input type="text" name="prix" value="<?= $article->getPrix() ?>">
        </div>

         <div>
             <label for="disponible">Disponible</label>
            <select name="disponible">

                <?php if ($article->getDisponible() == "0") : ?>

                    <option value="0" selected >0</option>
                    <option value="1">1</option>

                <?php  else : ?>

                    <option value="1" selected >1</option>
                    <option value="0">0</option>

                <?php  endif ?>

            </select>
        </div> 

        <div>
            <div>
                <label for="photo">Photo <?= $article->getPhoto() ?></label>
            </div>
            <input type="file" name="photo" >
        </div>

        <div>
            <input type="hidden" name="id_user" value="<?= $article->getId_user() ?>"> 
        </div>


        <div>
            <input type="submit" value="Modifier" name="update">
        </div>
                    
    </form>
</body>
<!-- fermer la tamporisation de sortie et le mettre dans une variable -->
<?php $content = ob_get_clean(); ?>
<?php require_once '../../../view_template.php'; ?>

</html>