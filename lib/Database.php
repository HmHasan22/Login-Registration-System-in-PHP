<?php

class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbName = "adminpanel";
    public $pdo;
    public function __construct()
    {
        if(!isset($this->pdo)){
            try{
                $link = new PDO("mysql:host=".$this->host.";dbname=".$this->dbName,$this->user,$this->password);
                $link->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $this->pdo = $link;
            }catch(PDOException $e){
                echo 'Connection failed: '.$e->getMessage();
            }
        }
    }
}