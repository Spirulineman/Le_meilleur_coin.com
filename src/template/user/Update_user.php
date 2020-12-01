<?php

/* ************************************************************************** */
/*                                 CONNEXION BDD                              */
/* ************************************************************************** */

require_once "../../config/class-singleton.php";

/* ************************************ . *********************************** */

require_once "../../Model/UserModel.php";
require_once "../../Entity/User.php";

/* ************************************************************************** */

$id=0;

if (isset( $_GET['id'])){

    $id = intval($_GET['id']);
    
}
$userModel = new UserModel();
$user = $userModel->selectUserId($id);
//var_dump($user);

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
    
</body>

</html>