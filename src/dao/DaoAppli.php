<?php 

require_once 'src/dao/Db.php';
require_once 'src/dao/Requete.php';
require_once 'src/models/Admin.php';

class DaoAppli{

    private PDO $db;
    public function __construct() {
        $dbObjet = new Db();
        $this->db = $dbObjet->getDb();
        // Activez le mode d'erreur PDO
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    private function getAdminByNom($nom): array {
        try {
            $requete = Requete::REQ_NOM_ADMIN;
            $stmt = $this->db->prepare($requete);
            $stmt->bindValue(':nom', $nom);
            $stmt->execute();
            echo($requete);
            // Vérifiez si la requête a renvoyé un résultat
            if ($stmt->rowCount() > 0) {
                $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
                print_r($resultat);
                return $resultat; // Retourne le résultat sous forme de tableau associatif
            } else {
                // Aucun résultat trouvé, vous pouvez retourner un tableau vide ou générer une exception personnalisée
                return [];
            }
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
            // Gérez l'erreur PDO comme vous le souhaitez, par exemple, en enregistrant un message d'erreur.
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }
    public function connexion(){
        $errorMessage = ""; // Initialisez la variable du message d'erreur en dehors de la condition
    
        if(isset($_POST['nom']) && isset($_POST['mdp'])){
            $nom = trim(htmlspecialchars($_POST['nom']));
            $mdp = trim(htmlspecialchars($_POST['mdp']));
            $mdp = hash('sha512', $mdp);

    
            try {
                $admin = $this->getAdminByNom($nom); 
    
                if ($admin && $admin['mdp'] === $mdp) {
                    // Les informations de connexion sont correctes
                    // Redirigez l'utilisateur vers une autre page
                    header('Location: /admin');
                    exit; // Assurez-vous de quitter le script après la redirection
                } else {
                    $errorMessage = "Nom d'utilisateur ou mot de passe incorrect."; 
                }
            } catch (PDOException $e) {
                echo "Erreur PDO : " . $e->getMessage();
                // Gérez l'erreur PDO comme vous le souhaitez, par exemple, en enregistrant un message d'erreur.
            }
        }
    
        // Stockez $errorMessage dans une variable de session pour le transmettre à la vue
        $_SESSION['errorMessage'] = $errorMessage;
        $_SESSION['nom'] = $nom;
        $_SESSION['mdp'] = $mdp;
        
        // Redirigez l'utilisateur vers la page de connexion (login.php)
        header('Location: /login/admin'); // Assurez-vous de modifier l'URL en fonction de votre structure de fichiers
        exit;
    }

    
}