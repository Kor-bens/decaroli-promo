<?php 


class Db {
    private PDO $db;

    
       
    
        public function __construct() {
            try {
                $this->db = new PDO('mysql:host=localhost;dbname=decaroli;charset=utf8', 'root', '');
                // Active les exceptions PDO pour la gestion des erreurs.
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                // En cas d'erreur de connexion, affichez un message d'erreur.
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }
    
        public function getDb() {
            return $this->db;
        }
    
    

//     public function __construct(){
        
// $serveur = "localhost"; // Remplacez par le nom du serveur MySQL.
// $utilisateur = "root"; // Remplacez par votre nom d'utilisateur MySQL.
// $motDePasse = ""; // Remplacez par votre mot de passe MySQL.
// $baseDeDonnees = "decaroli"; // Remplacez par le nom de votre base de données MySQL.

// // Établir la connexion à la base de données
// $connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

// // Vérifier la connexion
// if (!$connexion) {
//     die("La connexion à la base de données a échoué : " . mysqli_connect_error());
// } else {
//     echo "Connexion réussie à la base de données.";
//     // Vous pouvez maintenant exécuter des requêtes SQL ici.
    
//     // Fermez la connexion lorsque vous avez terminé.
//     mysqli_close($connexion);
// }

// public function getDb(){
//       return $this->db;


//     }
}

