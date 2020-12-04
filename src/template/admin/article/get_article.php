<?php


/* ************************************************************************** */
/*                                 CONNEXION BDD                              */
/* ************************************************************************** */

require_once "../../../config/class-singleton.php";

/* ************************************ . *********************************** */

require_once "../../../Model/ArticleModel.php";
require_once "../../../Entity/Article.php";

/* ************************************************************************** */

$articleModel = new ArticleModel();
$articles = $articleModel->selectAllArticle();

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
    <a href="create_article.php">Ajouter un article</a>
    <div>
        <h1> Gestion des Articles </h1>
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
                    <td><a href="update_article.php?id=<?= $articles[$i]->getId() ?>">Modifier</a></td>
                    <td><a href="delete_article.php?id=<?= $articles[$i]->getId() ?>">suprimer</a></td>
                </tr>
            <?php endfor ?>
        </tbody>

    </table>
    <a href="../user/Get_users.php">Gestion des utilisateur</a>
</body>

</html>