<?php
/* ************************************************************************** */
/*                                 CONNEXION BDD                              */
/* ************************************************************************** */

require_once "config/class-singleton.php";

/* ************************************ . *********************************** */

require_once "Model/UserModel.php";
require_once "Entity/User.php";
require_once "inc/outils__perso__jonas__.php";
/* ************************************************************************** */


session_start();


$user = new User();
$user = ($_SESSION['userconnecte']);
//var_dump($user);

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
    <div>
        <h1> Gestion des Articles </h1><br>
        <h3>Liste des Articles</h3>
    </div>

    <table>


    </table>
</body>

</html>