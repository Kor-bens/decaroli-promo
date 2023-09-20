<?php 


class Db {
    private PDO $db;

    public function __construct(){
        try{
            $this->db = new PDO('mysql:host=localhost;dbname=decaroli;charset=utf8','root', '');
        }catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }
    }
    public function getDb(){
        return $this->db;
    }
}