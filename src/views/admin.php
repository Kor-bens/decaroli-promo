<?php require_once "common/head_admin.php";

// var_dump($_SESSION['nom']);
// var_dump($_SESSION);

// L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion(retour navigateur)
if (!isset($_SESSION['nom'])) {
  header("Location: /login/admin");
  exit;
}
 ?>
<link rel="stylesheet" href="../../assets/css/admin.css">
<title>DECAROLI - ADMIN</title>
</head>
<body>
<div id="navbar">
    <ul>
        <li><a href="/" target="_blank">Page promo</a></li>
        <?php
        if (isset($_SESSION['nom'])) {
          $nom = $_SESSION['nom'] ?? "";
            echo "<li><a href='/deconnexion'>Se Déconnexion</a></li>";
            echo "<li>Bienvenue " . strtoupper($nom) . "</li>";;
        } else {
          echo 'Les variables de session ont été supprimées.';
         }
        ?>  
    </ul>
</div>

<div id="container-form">
    <form id="form" action="/traitement-titre" method="POST">
      <label for="titre">Modifier le titre</label><br>
      <input id="input-titre" type="text" name="titre" value="<?= $donneesOrigine['titre'] ?>"><br>
      <button type="submit">Modifier</button>
    </form>


    <button id="bouton-clone-form">Ajouter des images</button>
<div id="conteneur-formulaire">
    <form class="formulaire-image" action="/traitement-image" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*">
        <input type="submit" value="Ajouter">
        <button class="supprimer-formulaire">Supprimer</button>
    </form>
</div>
    

    <form action="/traitement-background" method="POST">
     <label for="background">Modifier le body</label><br>
     <input type="text" name="background" value="<?= $donneesOrigine['bkgd_color'] ?>"><br>
     <button type ="submit">Modifier</button>
    </form>
</div>



<script src="../../assets/composantJs/admin.js"></script>
</body>
</html>