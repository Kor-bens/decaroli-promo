<?php
require_once 'src/controllers/Message.php';
require_once 'src/dao/DaoAppli.php';
require_once 'src/controllers/Message.php';
require_once 'src/dao/Requete.php';
class CntrlAppli {

            public function afficherPagePromo()
        {
            $dao = new DaoAppli();
            $donneesOrigine = [
                'titre' => $dao->getTitre(),
                'bkgd_color' => $dao->getCouleur()
            ];
            require_once 'src/views/index.php';
        }

        public function afficherPageLogin()
        {
            require_once 'src/views/login.php';
        }
        public function afficherPageAdmin()
        {
            $donneesOrigine = $this->getDonneestable();
            require_once 'src/views/admin.php';
        }

        public function connexion()
        {
            require_once 'src/dao/DaoAppli.php';
            
            $nom = htmlspecialchars($_POST['nom']);
            $mdp = htmlspecialchars($_POST['mdp']);

            // Réinitialisez les messages d'erreur à chaque nouvelle tentative de connexion
            Message::setErrorMessage([]);

            // Tableau pour stocker les messages d'erreur
            $errorMessage = [];

            if(empty($nom) || empty($mdp)){
                $errorMessageVide = Message::INP_ERR_CHAMP_VIDE;
            }
            
            // Vérifiez la longueur minimale du nom d'utilisateur
            if (empty($nom) || strlen($nom) < 4) {
                // $errorMessage[] = Message::INP_ERR_NOM_CHAR;
            }
            
            // Vérifiez la complexité du mot de passe
            if (empty($mdp) || strlen($mdp) < 8) {
                // $errorMessage[] = Message::INP_ERR_MDP_CHAR;
            } else {
                // Exigez au moins une lettre majuscule, une lettre minuscule et un chiffre
                // if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/', $mdp)) {
                //     $errorMessage[] = Message::INP_ERR_MDP_CHAR_SPE;
                // }
            }
            
            // Récupérez les messages d'erreur du DaoAppli
            
            $dao = new DaoAppli();
            $errorMessageFromDao = $dao->connexionUser();

            // Ajoutez les messages d'erreur du DaoAppli aux messages d'erreur existants
            $errorMessage = array_merge($errorMessage, $errorMessageFromDao);
            Message::setErrorMessage($errorMessage);
            
            if (!empty($errorMessage)) {
               
                require_once 'src/views/login.php';
            } else {
                $dao = new DaoAppli();
                $dao->connexionUser(); 
                // Redirigez l'utilisateur après une connexion réussie
                header('Location: /admin');
                exit;
            }
        }

        public function deconnexion(){
            session_start();
            session_destroy(); 

            // Redirige l'utilisateur vers une page appropriée
            header("Location: /login");
            exit();
        }

        public function modifTitre(){
           
                // Récupere la nouvelle valeur du titre à partir du formulaire
                $nouveauTitre = $_POST['titre'];
        
                // Met à jour le titre de la page dans DaoAppli
                $dao = new DaoAppli();
                $dao->modifTitre($nouveauTitre);
                // Recupere les valeurs stocké en db
                $donneesOrigine = [
                    'titre' => $dao->getTitre(),
                    'bkgd_color' => $dao->getCouleur()
                ];
                // Charge la vue index.php en passant la variable $nouveauTitre
                require_once 'src/views/admin.php';
            
        }

        public function modifBackground(){
            $nouveauBackground = $_POST['background'];
        
            // Mettez à jour le fond d'écran de la page dans DaoAppli
            $dao = new DaoAppli();
            $dao->modifBackground($nouveauBackground);
        
           
            $donneesOrigine = [
                'titre' => $dao->getTitre(),
                'bkgd_color' => $dao->getCouleur()
            ];
           
        
            // Chargez la vue index.php en passant les variables $nouveauBackground et $donneesOrigine
            require_once 'src/views/admin.php';
        }

        public function getDonneestable() {
            $dao = new DaoAppli();
            $donneesOrigine = [
                'titre' => $dao->getTitre(),
                'bkgd_color' => $dao->getCouleur()
            ];
        
            return $donneesOrigine;
        }

        public function traitementImage(){
            $dao = new DaoAppli();
            $donneesOrigine = [
                'titre' => $dao->getTitre(),
                'bkgd_color' => $dao->getCouleur()
            ];
            require_once 'src/views/admin.php';
           }
}