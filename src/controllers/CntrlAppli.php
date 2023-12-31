<?php
require_once 'src/controllers/Message.php';
require_once 'src/dao/DaoAppli.php';
require_once 'src/controllers/Message.php';
require_once 'src/dao/Requete.php';
class CntrlAppli {

            public function afficherPagePromo()
        {
            $dao = new DaoAppli();
            $infoImages = $dao->getImages();
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

            
            
            $nom = isset($_POST['nom']) ? trim(addcslashes(strip_tags($nom), '\x00..\x1F')) : '';
            $mdp = isset($_POST['mdp']) ? trim(addcslashes(strip_tags($mdp), '\x00..\x1F')) : '';

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

            
            $dao = new DaoAppli();
            $errorMessageFromDao = $dao->connexionUser($nom, $mdp); 

            // Ajoutez les messages d'erreur du DaoAppli aux messages d'erreur existants
            $errorMessage = array_merge($errorMessage, $errorMessageFromDao);
            Message::setErrorMessage($errorMessage);
            
            if (!empty($errorMessage)) {
                require_once 'src/views/login.php';
            } else { 
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
                'titre'      => $dao->getTitre(),
                'bkgd_color' => $dao->getCouleur()
            ]; 
        
            // Initialisez le tableau des informations sur les images
            $infoImages = $dao->getImages();
            
            if (isset($_FILES['image'])) {
                // Informations sur le fichier téléchargé
                $nomFichier = $_FILES['image']['name']; // Nom du fichier image
                $typeFichier = $_FILES['image']['type'];
                $tailleFichier = $_FILES['image']['size'];
                $fichierTemporaire = $_FILES['image']['tmp_name'];
        
                // Vérifier que le fichier est une image ex: le type
                $extensionsAutorisées = array('image/jpeg', 'image/png', 'image/gif');
                if (!in_array($typeFichier, $extensionsAutorisées)) {
                    echo "Seules les images au format JPEG, PNG ou GIF sont autorisées."; 
                    require_once 'src/views/admin.php';
                }
        
                // Générez un nom unique pour le fichier pour éviter l'écrasement d'image
                $nomUnique = uniqid() . '_' . $nomFichier;  
                $cheminStockage = 'assets/ressources/images/' . $nomUnique;
        
                // Déplacez le fichier téléchargé vers le répertoire de stockage des images
                if (move_uploaded_file($fichierTemporaire, $cheminStockage)) {
                    // Le téléchargement a réussi, vous pouvez maintenant insérer le nom du fichier dans la base de données
                    $idPage = 1; // Remplacez par l'ID de la page appropriée
                    $dao->traitementImage($nomUnique, $nomFichier, $idPage); 
                    echo $nomFichier;
        
                    // Ajoutez également les informations sur l'image téléchargée à la liste des images
                    $infoImages[] = [
                        'nom_image' => $nomUnique, // Utilisez le nom unique du fichier
                        'url' => $cheminStockage // Utilisez le chemin de stockage complet
                    ];
                }
            }
            
            // Maintenant, vous pouvez continuer à afficher la page admin
            require_once 'src/views/admin.php';
        }

       
}