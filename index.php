<?php 
session_start(); 
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'src/dao/DaoAppli.php';
require_once 'src/controllers/CntrlAppli.php';
require_once 'src/controllers/Message.php';
require_once "src/dao/Requete.php";

$route = htmlspecialchars(explode("?", $_SERVER['REQUEST_URI'])[0]);
$method = $_SERVER['REQUEST_METHOD'];

$cntrlAppli = new CntrlAppli();

if      ($method == 'GET'   && $route == '/index')                  $cntrlAppli->afficherPagePromo();
else if ($method == 'GET'   && $route == '/')                       $cntrlAppli->afficherPagePromo();
else if ($method == 'GET'   && $route == '/login/admin')            $cntrlAppli->afficherPageLogin(); 
else if ($method == 'GET'   && $route == '/admin')                  $cntrlAppli->afficherPageAdmin(); 
else if ($method == 'POST'  && $route == '/connexion')              $cntrlAppli->connexion(); 


else{
    header("Location: /index");
    exit;
}