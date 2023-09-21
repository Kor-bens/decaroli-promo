<?php 


class Db {
    private PDO $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=decaroli;charset=utf8', 'root', '');
            echo 'Connexion réussie à la base de données.';
        } catch(PDOException $e) {
            echo 'Erreur de connexion PDO : ' . $e->getMessage();
        }
    }   

    public function getDb(){
        return $this->db;
    }
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


// }


// public function getDb(){
//       return $this->db;


//     }
    