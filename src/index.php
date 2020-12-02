<?php
/* ************************************************************************** */
/*                                 CONNEXION BDD                              */
/* ************************************************************************** */

require_once "config/class-singleton.php";

/* ************************************ . *********************************** */

require_once "Model/UserModel.php";
require_once "Entity/User.php";
require_once "inc/outils__perso__jonas__.php";

require_once "Model/ArticleModel.php";
require_once "Entity/Article.php";
/* ************************************************************************** */


session_start();
if (isset($_SESSION['userconnecte'])) {


    $user = new User();
    $user = ($_SESSION['userconnecte']);
    //var_dump($user);
}
if (isset($_POST['deco'])) {
    unset($_SESSION);
    session_destroy();
}
//}
//pre_var_dump($_SESSION, NULL, true);

$articleModel = new ArticleModel();
$articles = $articleModel->selectAllArticle();
       // pre_var_dump($_SESSION['userconnecte']);
?>


<!-- /* *******************************  RENDU  *********************************** */ -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>

<body>
    <div>
        <h1> Gestion des Articles </h1><br>
        <h3>Liste des Articles</h3>
    </div>

    <table>

        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Date de création</th>
                <th>Prix €</th>
                <th>Nom de photo</th>
                <th>Disponible</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($articles); $i++) : ?>
                <tr>
                    <td><?= $articles[$i]->getTitre() ?></td>
                    <td><?= $articles[$i]->getDescription() ?></td>
                    <td><?= $articles[$i]->getDate_creation()->format('d/m/Y') ?></td>
                    <td><?= $articles[$i]->getPrix() ?> €</td>
                    <td><?= $articles[$i]->getPhoto() ?></td>
                    <td>
                        <?php if ($articles[$i]->getDisponible() == '1') : ?>
                            Disponible
                        <?php else : ?>
                            Indisponible
                        <?php endif ?>
                    </td>
                    <?php
                    
                        if(isset($_SESSION) ){
                            if
                        ($articles[$i]->getId_user() == $user->getId()){
                               
                            ?>
                            <td><a href="update_article.php?id=<?= $articles[$i]->getId() ?>">Modifier</a></td>
                    <td><a href="delete_article.php?id=<?= $articles[$i]->getId() ?>">supprimer</a></td>

                        <?php
                        }
                        }
                    ?>
                    
                </tr>
            <?php endfor ?>
        </tbody>

    </table>

       
    <!-- <a href="../../../index.php">Retour à l'Accueil</a> -->


    <div>
        <?php
        if (!empty($_SESSION['userconnecte'])) {
        ?>
            <form method="post">
                <input type="submit" value="déconnexion" id="deco" name="deco">
            </form>
        <?php
        }
        ?>
        <a href="template/user/User_connect.php">Se connecter</a>
    </div>
</body>

</html>