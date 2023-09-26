<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DECAROLI</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
 <style>
        body {
            background: <?= $donneesOrigine['bkgd_color'] ?>;
        }
    </style>  
<body>
    

<h1><?= $donneesOrigine['titre'] ?></h1>
     <!-- <?php echo $donneesOrigine['titre'];
    var_dump($infoImages);?> -->

    <div id="contain-images">
    <?php foreach ($infoImages as $image) : ?>
        <div class="image"><img src="../../assets/ressources/images/<?=$image['url'] ?>" alt="<?= $image['nom_image'] ?>"></div>
    <?php endforeach; ?>
   
    
    
        <!-- <div class="image"><img src="../../assets/ressources/images/bbKlorane.png" alt="bebe-laboratoire"></div>
        <div class="image"><img src="../../assets/ressources/images/abcDerm.png" alt="abcDerm"></div>
        <div class="image"><img src="../../assets/ressources/images/weledabb.png" alt="weleda-bebe"></div>
        <div class="image"><img src="../../assets/ressources/images/poupina.png" alt="poupina"></div>
        <div class="image"><img src="../../assets/ressources/images/alphaNovabb.png" alt="alphaNovabb"></div> -->
    </div>

    <div id="div-fleche">
      
        </div>

    <div id="footer">
        <img id="logo-decaroli" src="../../assets/ressources/images/logoDecaroli.png" alt="logoDecaroli">
    </div>
    
    
    <script src="../../assets/composantJs/app.js"></script>
</body>
</html>