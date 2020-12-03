<?php
require_once "Model.php";

class ArticleModel extends Model{

    public function selectAllArticle(){

        $requete = "SELECT * FROM article";
        $stmt= $this->Db_connect->prepare($requete);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Article::class);
        $stmt->execute(); 
        $articles = $stmt->fetchAll();

        return $articles; 
    }

    public function selectArticleById ($id){

        $requete= "SELECT * FROM article WHERE id = :id";
        $stmt= $this->Db_connect->prepare($requete);
        $stmt->execute([':id'=> $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Article::class);
        $articles = $stmt->fetch();

        return $articles;
    }

    public function updateArticle($id, $titre, $description /*,  $id_categorie */ , $prix, $photo, $disponible, $id_user){

        $requete = "UPDATE article 
            SET titre = :titre, 
                description = :description, 
                prix = :prix,  
                photo = :photo,
                disponible = :disponible,
                id_user = :id_user
            WHERE id = :id";

        $stmt = $this->Db_connect->prepare($requete);
        $stmt->execute([
                ':id' => $id,
                ':titre' => $titre,
                ':description' => $description,
                ':prix' =>  $prix,
                ':photo' =>  $photo,
                ':disponible' => $disponible,
                ':id_user' => $id_user  
                ]
            );
    }




    public function createArticle( $titre, $description /*, $id_categorie*/, $prix, $photo){

        $requete = "INSERT INTO article( titre, description, prix, photo) 
            VALUE (:titre, :description, :prix, :photo)";
        

        $stmt = $this->Db_connect->prepare($requete);
        $stmt->execute([

                ':titre' => $titre,
                ':description' => $description,
                ':prix' =>  $prix,
                ':photo' =>  $photo        
            ]
        );
    }

    public function DeleteArticle($id)
    {
        $requete = "DELETE FROM `article` WHERE id = :id";
        $stmt = $this->Db_connect->prepare($requete);
        $stmt->execute([ ':id' => $id ]);
    }

    public function selectArticlePanier($ids_articles){
        $requete = 'SELECT * FROM article WHERE id IN ('.implode(',',$ids_articles).')';
        $stmt = $this->Db_connect->prepare($requete);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Article::class);
        $stmt->execute(); 
        $articles = $stmt->fetchAll();

        return $articles; 
    }
}