<?php

/* ************************************************************************** */
/*                                 CONNEXION BDD                              */
/* ************************************************************************** */

require_once "../../config/class-singleton.php";

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

$Db_connect = new Db_connect();
$Db_connect = $Db_connect->db_connect();

$user = new User();
$user = ($_SESSION['userconnecte']);

$AnnonceEnCours="";
$AnnonceTerminées="";
$CA = "";

//pre_var_dump($user->getId());

function AnnonceEnCours($Db_connect, $id_user)
{ // les paramètres ici sont "les portes" pour appeler les variable dans la fonction

    $requete_AnnonceEnCours = "select count(article.id) from article where disponible =1 and id_user = :id_user";
    $stmt = $Db_connect->prepare($requete_AnnonceEnCours);
    $stmt->execute(array(
        ':id_user' => $id_user,
    ));
    return $stmt->fetch();
}
//pre_var_dump(AnnonceEnCours($Db_connect, $user->getId()));


function AnnonceTerminées($Db_connect, $id_user)
{ // les paramètres ici sont "les portes" pour appeler les variable dans la fonction

    $requete_AnnonceTerminées = "select count(article.id) from article where disponible =0 and id_user = :id_user";
    $stmt = $Db_connect->prepare($requete_AnnonceTerminées);
    $stmt->execute(array(
        ':id_user' => $id_user,
    ));
    return $stmt->fetch();
}

//pre_var_dump(AnnonceTerminées($Db_connect, $user->getId()));

function ChiffreAff($Db_connect, $id_user)
{ // les paramètres ici sont "les portes" pour appeler les variable dans la fonction

    $requete_ChiffreAff = "select sum(a.prix)as ca from article a inner join commande c on c.id_article = a.id and  a.id_user != c.id_user and a.disponible=0 and a.id_user = :id_user  where c.date_commande < NOW() AND c.date_commande > DATE_ADD(NOW(), INTERVAL -30 DAY)";
    $stmt = $Db_connect->prepare($requete_ChiffreAff);
    $stmt->execute(array(
        ':id_user' => $id_user,
    ));
    return $stmt->fetch();
}
//pre_var_dump(ChiffreAff($Db_connect, $user->getId()));

$AnnonceEnCours= AnnonceEnCours($Db_connect, $user->getId());
$AnnonceTerminées= AnnonceTerminées($Db_connect, $user->getId());
$CA= ChiffreAff($Db_connect, $user->getId());

/* ************************************************************************** */
/*                                    RENDU                                   */
/* ************************************************************************** */


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tableau de Bord</title>
</head>

<body>
    <h1>Tableau de Bord</h1>
    <table>
        <thead>
            <tr>
                <th>Annonce En Cours</th>
                <th>Annonce Terminées</th>
                <th>Chiffre Affaire sur 30 jours</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $AnnonceEnCours["count(article.id)"] ?></td>
                <td><?= $AnnonceTerminées["count(article.id)"] ?></td>
                <td><?= $CA["ca"] ?> €</td>
            </tr>
        </tbody>
    </table>
</body>

</html>