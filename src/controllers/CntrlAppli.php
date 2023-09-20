<?php
require_once 'src/controllers/Message.php';
require_once 'src/dao/DaoAppli.php';
require_once 'src/controllers/Message.php';
require_once 'src/dao/Requete.php';
class CntrlAppli {

            public function afficherPagePromo()
        {
            require_once 'src/views/index.php';
        }

        public function afficherPageLogin()
        {
            require_once 'src/views/login.php';
        }
        public function afficherPageAdmin()
        {
            require_once 'src/views/admin.php';
        }

        public function connexion()
        {
            require_once 'src/dao/DaoAppli.php';
           
            $messageErr = [];

            $nom = htmlspecialchars($_POST['nom']);
            $mdp = htmlspecialchars($_POST['mdp']);

            if (empty($nom)) {
                $messageErr[] = Message::INP_ERR_NOM;
            }
            if (empty($mdp)) {
                $messageErr[] = Message::INP_ERR_MDP;
            }
        
            var_dump($messageErr);


            $dao = new DaoAppli();
            $dao->connexion(); 
            require_once 'src/views/login.php';
        }
}