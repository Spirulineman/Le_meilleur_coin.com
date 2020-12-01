<?php

/* ************************************************************************** */
/*                                 CONNEXION BDD                              */
/* ************************************************************************** */

require_once "../../config/class-singleton.php";

/* ************************************ . *********************************** */

require_once "../../Model/UserModel.php";
require_once "../../Entity/User.php";

/* ************************************************************************** */

$errors  = array();

$status = ["0", "1"];

$user = new User();

$id = 0;

if (isset($_GET['id'])) {

    $id = intval($_GET['id']);
    $user->setId($id);
}
$userModel = new UserModel();
$user = $userModel->selectUserId($id);

//var_dump($user);

if (isset($_POST['update'])) {

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

    if (!empty($_POST['status'])) {
        $user->setActive(strip_tags(htmlspecialchars(trim(intval($_POST['status'])))));
    } else {
        $errors[] =  "veuillez rentrer le statut dans le champ qui va bien ;-P ";
    }

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

    if (!empty($_POST['admin'])) {
        $user->setAdmin(intval($_POST['admin']));
    } else {
        $errors[] =  "veuillez rentrer une valeur valide dans le champ qui va bien ;-P ";
    }

    if (empty($errors)) {

        $userModel->updateUser($user);
    }
}

?>

<!-- /* *******************************  RENDU  *********************************** */ -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Utilisateur</title>
</head>

<body>
    <form method="post">

        <div><input type="text" name="nom" value="<?= $user->getNom() ?>"></div>
        <!--ne pas oublier de modifier le "name" ==>> valeur des champs de la table-->
        <div><input type="text" name="prenom" value="<?= $user->getPrenom() ?>"></div>
        <div><input type="text" name="adresse" value="<?= $user->getAdresse() ?>"></div>
        <div><select name="status"><?php
                                    for ($i = 0; $i < count($status); $i++) {
                                        if ($status[$i] == $user->getActive()) {
                                    ?>
                        <option value="<?= $status[$i] ?>" selected><?= $status[$i] ?></option>
                    <?php
                                        } else {
                    ?>
                        <option value="<?= $status[$i] ?>"><?= $status[$i] ?></option>
                <?php
                                        }
                                    }
                ?>
            </select></div>

        <!-- <div>
            <select name="">
                <?php // if ($user->getActive() == "0") : 
                ?>
                    <option value="0" selected >0</option>
                    <option value="1">1</option>
                <?php // else : 
                ?>
                    <option value="1" selected >1</option>
                    <option value="0">0</option>
                <?php // endif 
                ?>
            </select>
        </div> -->

        <div><input type="text" name="mail" value="<?= $user->getMail() ?>"></div>
        <div><input type="text" name="telephone" value="<?= $user->getTelephone() ?>"></div>
        <div><select name="admin"><?php
                                    for ($i = 0; $i < count($status); $i++) {
                                        if ($status[$i] == $user->getAdmin()) {
                                    ?>
                        <option value="<?= $status[$i] ?>" selected><?= $status[$i] ?></option>
                    <?php
                                        } else {
                    ?>
                        <option value="<?= $status[$i] ?>"><?= $status[$i] ?></option>
                <?php
                                        }
                                    }
                ?>
            </select></div>
        <div><input type="submit" value="Modifier" name="update"></div>

    </form>
</body>

</html>