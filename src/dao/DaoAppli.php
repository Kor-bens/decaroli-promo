<?php 
require_once 'src/controllers/Message.php';
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
            $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
            $stmt->execute();
            // echo($requete);
            // Vérifiez si la requête a renvoyé un résultat
            if ($stmt->rowCount() > 0) {
                $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
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
    public function connexionUser() {
        // Réinitialisez la variable d'erreur à chaque nouvelle tentative de connexion
       
        $errorMessage = [];
        //si il existe et Nettoyez le nom d'utilisateur en supprimant les espaces inutiles et en évitant les caractères spéciaux
        if (isset($_POST['nom']) && isset($_POST['mdp'])) {
            $nom = trim(htmlspecialchars($_POST['nom']));
            $mdp = trim(htmlspecialchars($_POST['mdp']));
            $mdp = hash('sha512', $mdp);
    
            try {
                $admin = $this->getAdminByNom($nom);
    
                if ($admin && $admin['mdp'] === $mdp) {
                    // Les informations de connexion sont correctes
                    // Stockez le nom d'utilisateur dans la session
                    $_SESSION['nom'] = $nom;
                    header('Location: /admin');
                    exit; // Assurez-vous de quitter le script après la redirection
                } else {
                    $errorMessage[] = Message::ERR_LOGIN;

                }
            } catch (PDOException $e) {
                echo "Erreur PDO : " . $e->getMessage();
                
            }
        }
        
        
        return $errorMessage;
        
        
    }

    public function modifTitre($nouveauTitre){
    $requete = Requete::REQ_MODIF_TITRE;
    $stmt = $this->db->prepare($requete);
    $stmt ->bindParam(':titre', $nouveauTitre);
    $stmt->execute();
    $titre = $this->getTitre();
    return $titre;
    }

    public function modifBackground($nouveauBackground){
        $requete = Requete::REQ_MODIF_BACKGROUND;
        $stmt = $this->db->prepare($requete);
        $stmt ->bindParam(':background', $nouveauBackground);
        $stmt ->execute();
        $background = $this->getTitre();
        echo $nouveauBackground,$background;
        return $background;
    }

    public function getTitre() {
        $requete = Requete::REQ_TITRE;
        $stmt = $this->db->query($requete);
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultat['titre'];
    }

    public function getCouleur(){
        $requete = Requete::REQ_COULEUR; 
        $stmt = $this->db->query($requete);
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultat['bkgd_color'];
    }

   
}

    
