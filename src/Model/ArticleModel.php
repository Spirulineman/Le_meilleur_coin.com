<?php
require_once "Model.php";

class ArticleModel extends Model{

    public function selectAllArticle(){

        $requete = "SELECT * FROM article WHERE disponible= 1";
        $stmt= $this->Db_connect->prepare($requete);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Article::class);
        $stmt->execute(); 
        $articles = $stmt->fetchAll();

        return $articles; 
    }

    public function selectAllArticleAdmin(){

        $requete = "SELECT * FROM article order by date_creation desc";
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




    public function createArticle( $titre, $description /*, $id_categorie*/, $prix, $photo, $id_user){

        $requete = "INSERT INTO article( titre, description, prix, photo, id_user) 
            VALUE (:titre, :description, :prix, :photo, :id_user)";
        

        $stmt = $this->Db_connect->prepare($requete);
        $stmt->execute([

                ':titre' => $titre,
                ':description' => $description,
                ':prix' =>  $prix,
                ':photo' =>  $photo,
                ':id_user' =>  $id_user        
            ]
        );
    }

    public function deleteArticle($id)
    {
        $requete = "DELETE FROM article WHERE id = :id";
        $stmt = $this->Db_connect->prepare($requete);
        return $stmt->execute([ ':id' => $id ]);
    }

    public function selectArticlePanier($ids_articles){
        $requete = 'SELECT * FROM article WHERE id IN ('.implode(',',$ids_articles).')';
        $stmt = $this->Db_connect->prepare($requete);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Article::class);
        $stmt->execute(); 
        $articles = $stmt->fetchAll();

        return $articles; 
    }

    public function finCommande($id_user,$id_article){

            $requete= "INSERT INTO commande(id_user, id_article) VALUES (:id_user,:id_article)";
            $stmt = $this->Db_connect->prepare($requete);
            return $stmt->execute([
                
                ':id_user' => $id_user,
                ':id_article' => $id_article
                
                ]);

    }

    public function desactiveArticles_Vendus($id_article){

        $requete= "UPDATE article SET disponible= 0 WHERE id = :id ";
        $stmt = $this->Db_connect->prepare($requete);
        return $stmt->execute([':id' => $id_article]);
    }


}