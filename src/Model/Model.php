<?php
abstract class Model{ // abstract permet de ne pas pouvoir instancier la class de connexion à la bdd Model.php dans un soucis de protection !!!

public $Db_connect;

public function __construct()
{
$this->Db_connect = new Db_connect;
$this->Db_connect = $this->Db_connect->db_connect();
}
}