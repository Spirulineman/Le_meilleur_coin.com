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

$pwd = "";
$pwdVerified = "";

$errors  = array();

$status = ["0", "1"];

$user = new User();

$id = 0;


$userModel = new UserModel();
//pre_var_dump($userModel);

//var_dump($user);

if (isset($_POST['create'])) {

    if (!empty($_POST['nom'])) {
        $user->setNom(strip_tags(htmlspecialchars(trim(($_POST['nom'])))));
    } else {
        $errors[] =  "veuillez rentrer un nom dans le champ qui va bien ;-P ";
    }

    if (!empty($_POST['prenom'])) {
        $user->setPrenom(strip_tags(htmlspecialchars(trim(($_POST['prenom'])))));
    } else {
        $errors[] =  "veuillez rentrer un prénom dans le champ qui va bien ;-P ";
    }

    if (!empty($_POST['adresse'])) {
        $user->setAdresse(strip_tags(htmlspecialchars(trim(($_POST['adresse'])))));
    } else {
        $errors[] =  "veuillez rentrer une adresse dans le champ qui va bien ;-P ";
    }

    /* if (!empty($_POST['status'])) {
        $user->setActive(strip_tags(htmlspecialchars(trim(intval($_POST['status'])))));
    } else {
        $errors[] =  "veuillez rentrer le statut dans le champ qui va bien ;-P ";
    } */

    if (!empty($_POST['mail'])) {
        $user->setMail(strip_tags(htmlspecialchars(trim(($_POST['mail'])))));
    } else {
        $errors[] =  "veuillez rentrer une adresse mail valide dans le champ qui va bien ;-P ";
    }

    if (!empty($_POST['telephone'])) {
        $user->setTelephone(strip_tags(htmlspecialchars(trim(($_POST['telephone'])))));
    } else {
        $errors[] =  "veuillez rentrer un numéro de téléphone valide dans le champ qui va bien ;-P ";
    }

    if (!empty($_POST['pwd']) && !empty($_POST['Confirme_Password'])) {

        $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
        $pwdVerified = $_POST['Confirme_Password'];
        if (password_verify($pwdVerified, $pwd)) {
            $user->setPwd($pwd);
        } else {

            $errors[] = "Mot de passe non vérifié ...";
        }
    } else {
        $errors[] =  "veuillez rentrer un mot de passe et le confirmer dans les champs qui vont bien ;-P ";
    }

    if (empty($errors)) {

        $userModel->createUser($user);
    }

    header('Location: GEt_users.php');
    die;
}



?>

<!-- /* ************************************************************************** */
     /*                                    RENDU                                   */
     /* ************************************************************************** */ -->

<!-- demarre une tamporisation de sortie -->
<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../lib/jquery-3.5.1.min.js"></script>
    <script src="../../lib/jquery.validate.min.js"></script>
    <script src="../../lib/messages_fr.js"></script>
    <script>
        $(function() {



            $('#crea').validate({

                rules: {
                    nom: {
                        minlength: 2,
                        required: true
                    },

                    prenom: {

                        minlength: 2,
                        required: true
                    },

                    adresse: {

                        minlength: 2,
                        required: true
                    },


                    mail: {

                        required: true,
                        email: true
                    },

                    telephone: {
                        required: true,
                        minlength: 10,
                        number: true

                    },
                    pwd: {
                        required: true,
                        minlength: 5,
                    },
                    Confirme_Password:{
                        required:true,
                        minlength:5,
                        equalTo: '#pwd'
                    }
                }

            });

        });
    </script>
    <title>Créer un Utilisateur</title>
</head>

<body>

    <h1>Créer un Utilisateur</h1>
    <form method="post" id="crea">

        <div><input type="text" name="nom" placeholder="Nom"></div>
        <!--ne pas oublier de modifier le "name" ==>> valeur des champs de la table-->
        <div><input type="text" name="prenom" placeholder="Prénom"></div>
        <div><input type="text" name="adresse" placeholder="Adresse"></div>
        <div></div>
        <div><input type="text" name="mail" placeholder="Mail"></div>
        <div><input type="number" name="telephone" placeholder="Téléphone"></div>
        <div><input type="text" name="pwd" placeholder="Mot de Passe" id="pwd"></div>
        <div><input type="text" name="Confirme_Password" placeholder="Confirmation Mot de Passe"></div>
        <div><input type="submit" value="Créer" name="create"></div>

    </form>

    <a href="Get_users.php">Retour à l'accueil</a>
</body>

</html>

<!-- fermer la tamporisation de sortie et le mettre dans une variable -->
<?php $content = ob_get_clean(); ?>
<?php require_once '../../../view_template.php'; ?>