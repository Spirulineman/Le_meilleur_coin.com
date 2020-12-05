<?php

session_start();

/* ************************************************************************** */
/*                                 CONNEXION BDD                              */
/* ************************************************************************** */

require_once "../../../config/class-singleton.php";

/* ************************************ . *********************************** */

require_once "../../../Model/UserModel.php";
require_once "../../../Entity/User.php";
// require_once "../../../inc/outils__perso__jonas__.php";

/* ************************************************************************** */

$user = new User();
$userModel = new UserModel();




$errors  = array();

$mail = "";
$pwd = "";

if (isset($_POST["connecter"])) {

    if (!empty($_POST['mail'])) {

        $mail = strip_tags(htmlspecialchars(trim(($_POST['mail']))));
    } else {
        $errors[] =  "veuillez rentrer un mail dans le champ qui va bien ;-P ";
    }

    if (!empty($_POST['pwd'])) {

        $pwd = $_POST['pwd'];
    } else {
        $errors[] =  "veuillez rentrer un mot de passe dans le champ qui va bien ;-P ";
    }

    if (empty($errors)) {

        $user = $userModel->Connect($mail);
        
        

        if (!empty($user)) {
            if (password_verify($pwd, $user->getPwd())) {

                if ($user->getAdmin() == 0) {

                    // pre_var_dump($_SESSION,null,true);
                    $_SESSION['userconnecte'] = $user;
                    header('Location: ../article/get_all_article.php');
                    die;
                } else {
                    $_SESSION['userconnecte'] = $user;
                    header('Location: ../../admin/article/get_article.php');
                    die;
                }
            } else {

                $errors[] =  "Votre compte n'existe pas ou vos logins ne sont pas corrects ;-P ";
            }
        } else {

            $errors[] =  "Votre compte n'existe pas ou vos logins ne sont pas corrects ou votre compte n'est pas actif ;-P ";
        }
    }
}


/* ************************************************************************** */
/*                                    RENDU                                   */
/* ************************************************************************** */



?>
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

            $('#conn').validate({

                rules: {
                    mail: {

                        required: true,
                        email: true
                    },

                    pwd: {
                        required: true,
                        minlength: 5,
                    },

                }

            });

        });
    </script>
    <title>Connexion Utilisateur</title>
</head>

<body>
    <?php if (!empty($errors)) {
    ?>
        <ul>

            <?php


            for ($i = 0; $i < count($errors); $i++) {
            ?>
                <li><?= $errors[$i] ?></li>
            <?php
            }
            ?></ul>
    <?php
    }
    ?>

<?php if(isset($_GET['success_inscriptoin'])) : ?>
    <p>Super !!! vous êtes inscrit sur le site, vous pouvez vous connectez maintenant</p>
<?php endif ?>

    <h1>Connexion</h1>

    <form method="post" id="conn">

        <input type="text" name="mail" id="mail">
        <input type="password" name="pwd" id="pwd">
        <input type="submit" value="Se connecter" name="connecter">

    </form>
    
    <a href="../../../index.php">Retour à l'Accueil</a>
<!-- </body>

</html> -->
<!-- fermer la tamporisation de sortie et le mettre dans une variable -->
<?php $content = ob_get_clean(); ?>
<?php require_once '../../../view_template.php'; ?>