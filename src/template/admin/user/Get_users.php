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

$userModel = new UserModel();
$users = $userModel->selectAllUser();

?>

<!-- /* *******************************  RENDU  *********************************** */ -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<!-- demarre une tamporisation de sortie -->
<?php ob_start(); ?>

<body>
    <div>
        <h1> Gestion des Utilisateurs </h1>
        <h3>Liste des Utilisateurs</h3>
    </div>
    <table class="table">
        <thead>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Adresse</th>
            <th>Status</th>
            <th>mail</th>
            <th>Admin</th>
            <th>Téléphone</th>
        </thead>
        <tbody>
            <?php
            //var_dump(count($users));

            for ($i = 0; $i < count($users); $i++) {
            ?>
                <tr>
                    <td><?= $users[$i]->getNom() ?></td>
                    <td><?= $users[$i]->getPrenom() ?></td>
                    <td><?= $users[$i]->getAdresse() ?></td>
                    <td><?php
                        if ($users[$i]->getActive() == '0') {
                            echo "inactif !";
                        } else {
                            echo "ACTIF";
                        } ?></td>
                    <td><?= $users[$i]->getMail() ?></td>
                    <td><?php
                        if ($users[$i]->getAdmin() == '0') {
                            echo "Normal";
                        } else {
                            echo "Admin";
                        } ?></td>
                    <td><?= $users[$i]->getTelephone() ?></td>
                    <td><a href="Update_user.php?id=<?= $users[$i]->getId() ?>">Modifier</a></td>
                    <td></td>
                </tr>
            <?php
            }

            ?>
        </tbody>

    </table>
  
</body>

</html>

<!-- fermer la tamporisation de sortie et le mettre dans une variable -->
<?php $content = ob_get_clean(); ?>
<?php require_once '../../../view_template.php'; ?>