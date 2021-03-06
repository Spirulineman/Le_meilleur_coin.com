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
        header_location('get_all_article.php');
    }
    /* else{
        pre_var_dump('create_article.php l 69', $errors);
    } */
}

// pre_var_dump($user);
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

        
            $('#create_article_user').validate({

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

                     
                        required: true
                    },

                    disponible: {

                        required: true,
                        
                    },
                   

                }

            });

        });
    </script>
    <title>Creer un Article</title>
</head>

<body>
    <h1> Créer des Articles </h1>
    <form method="post" enctype="multipart/form-data" id="create_article_user">

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
  
</body>

</html>

<!-- fermer la tamporisation de sortie et le mettre dans une variable -->
<?php $content = ob_get_clean(); ?>
<?php require_once '../../../view_template.php'; ?>