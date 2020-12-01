<?php


//Singleton
class Db_connect
{

    public $login;
    public $pwd;
    public $dsn; //$dsn = 'mysql:dbname=testdb;host=127.0.0.1'  ==>> $dsn contient donc le nom de la BDD + le host
    public $connexion;
    private static $objet = NULL; // $objet : permet de créer un objet avec la connexion dedans au cas où il n'existe pas, s'il existe c'est toujours le même $objet : PRINCIPE du SINGLETON

    function __construct()
    {
        $this->login = 'root';
        $this->pwd = '';
        $this->dsn = 'mysql:dbname=lemeilleurcoin;host=127.0.0.1';
        
    }

    public function db_connect()
    {
        if (isset(self::$objet)) {
            //La connexion existe déjà
            return self::$objet;
        } else {
            //Il n'y a pas de connexion à la BDD
            self::$objet = $this->connexion = new PDO($this->dsn, $this->login, $this->pwd, [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']);
            return self::$objet;
        }
    }
}
