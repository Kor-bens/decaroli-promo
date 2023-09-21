<?php require_once "common/head_admin.php" ?>
<link rel="stylesheet" href="../../assets/css/login.css?v=<?php echo time(); ?>">
<title>login-admin-decaroli</title>
</head>
<body>

<div id="container-form">        
<h1>Connexion</h1>

<?php if (!empty($messageErr)): ?>
    <div id="error-messages">
        <?php foreach ($messageErr as $err): ?>
            <div class="messagealert" ><?= $err ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php
// Récupérez le message d'erreur depuis la session
$errorMessage = $_SESSION['errorMessage'] ?? "";
$nom = $_SESSION['nom'] ?? "";
$mdp = $_SESSION['mdp'] ?? "";

if (!empty($errorMessage)) {
?>
    <div class="alert alert-danger" role="alert"><?= $errorMessage ?></div>
    <!-- <div class="alert alert-danger" role="alert"><?= $nom ?></div>
    <div class="alert alert-danger" role="alert"><?= $mdp ?></div> -->
<?php
}
?>


    <form id="loginForm" action="/connexion" method="post">
        <label for="nom">Nom d'utilisateur :</label>
        <br>
        <input type="text" id="nom" name="nom" >
        <br><br>
        <label for="mdp">Mot de passe :</label>
        <br>
        <input type="password" id="mdp" name="mdp" >
        <br><br>
        <input type="submit" id="button" value="Se connecter">
    </form>
</div>
    
</body>
</html>