<?php 


class Db {
    private PDO $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=decaroli;charset=utf8', 'korbens', 'Toto1234.');
            // echo 'Connexion réussie à la base de données.';
        } catch(PDOException $e) {
            echo 'Erreur de connexion PDO : ' . $e->getMessage();
        }
    }   

    public function getDb(){
        return $this->db;
    }
}

    