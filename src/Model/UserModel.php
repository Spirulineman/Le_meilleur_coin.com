<?php
require_once "Model.php";

class UserModel extends Model{

    public function selectAllUser(){

        $requete = "SELECT * FROM user";
        $stmt= $this->Db_connect->prepare($requete);
        $stmt->setFetchMode(PDO::FETCH_CLASS,User::class);// autre manière de faire :: (PDO::FETCH_CLASS,"User")
        $stmt->execute(); // comme il n'y a pas de paramètres dans la fonction : on passe à l'execute ici
        $users=$stmt->fetchAll();

        return $users;
    }

    public function selectUserId ($id){

        $requete= "SELECT * FROM user WHERE id= :id";
        $stmt= $this->Db_connect->prepare($requete);
        $stmt->execute(array(
            ':id'=>$id,
        ));// comme il y a de paramètres dans la fonction : on passe à l'execute ici
        $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
        $user = $stmt->fetch();

        return $user;
    }

    public function updateUser($user){

        $requete = "UPDATE user SET nom= :nom, prenom= :prenom, adresse= :adresse, admin= :admin, telephone= :telephone, active= :active, mail= :mail, pwd= :pwd WHERE id = :id";
        $stmt=$this->Db_connect->prepare($requete);
        return $stmt->execute(array(

                ':id' => $user->getId(),
                ':nom' => $user->getNom(),
                ':prenom' =>  $user->getPrenom(),
                ':adresse' =>  $user->getAdresse(),
                ':admin' =>  $user->getAdmin(),
                ':telephone' =>  $user->getTelephone(),
                ':active' =>  $user->getActive(),
                ':mail' =>  $user->getMail(),
                ':pwd' =>  $user->getPwd(),            
            )
        );

    }

        public function createUser($user){

            $requete= "INSERT INTO user (nom, prenom, adresse, telephone, mail, pwd) VALUES (:nom, :prenom, :adresse, :telephone, :mail, :pwd)";
            $stmt=$this->Db_connect->prepare($requete);
            $stmt->execute(array(

                ':nom' => $user->getNom(),
                ':prenom' =>  $user->getPrenom(),
                ':adresse' =>  $user->getAdresse(),
                //':admin' =>  $user->getAdmin(),
                ':telephone' =>  $user->getTelephone(),
                //':active' =>  $user->getActive(),
                ':mail' =>  $user->getMail(),
                ':pwd' =>  $user->getPwd(),
            )

        );
        //var_dump($stmt);
    //return $stmt->$this->Db_connect->lastInsertId();


    }

    public function Connect($mail){

        $requete= "SELECT * FROM user WHERE mail LIKE :mail AND active= :active";
        $stmt=$this->Db_connect->prepare($requete);
        $stmt->execute(array(
            ':mail' => $mail,
            ':active' => 1,
        )); // comme il y a de paramètres dans la fonction : on passe à l'execute ici
        $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
        $user = $stmt->fetch();

        return $user;

    }
    
    public function tableauBord(){

        $requete= "SELECT count(article1.id) AS AnnoncesEnCours, count(article2.id) AS NombreTermines, SUM(article2.prix) AS ChiffreAffMois, c.dateCommande AS dateCommande FROM article AS article1 JOIN article AS article2 ON article1.id = article2.id INNER JOIN commande c ON article2.id = c.id_article WHERE c.dateCommande between NOW() AND DATE_ADD(NOW(), INTERVAL -30 DAY) AND article2.id_user";


    }

    

}

// select count(a1.id) as annonces_encours, count(a2.id) as annonces_termine from article as a1 , article as a2 where a1.id_user = a2.id_user and a1.disponible = 1 and a2.disponible = 0 and a1.id_user = 1 ==>> annonces en cours

//select count(article.id) from article where disponible =0 and id_user = 7 ==>> annonces terminées

//select sum(a.prix)as ca from article a inner join commande c on c.id_article = a.id and  a.id_user != c.id_user and a.disponible=0 and a.id_user = 7  where c.date_commande < NOW() AND c.date_commande > DATE_ADD(NOW(), INTERVAL -30 DAY)   ==>>  CA

//select sum(article.prix), commande.date_commande from article inner join commande on article.id = commande.id_article where article.id_user = 3 and commande.date_commande between now() and DATE_ADD(now(),INTERVAL - 30 DAY)

