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
    
}