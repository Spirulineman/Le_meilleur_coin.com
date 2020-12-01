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
        var_dump($stmt);
    //return $stmt->$this->Db_connect->lastInsertId();


    }
    
}