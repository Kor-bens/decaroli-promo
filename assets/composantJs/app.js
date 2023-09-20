document.addEventListener("DOMContentLoaded", function () {
    // Sélectionnez toutes les images par leur classe CSS
    const images = document.querySelectorAll(".image");

    // Fonction pour faire apparaître une image avec une animation
    function fadeInImage(image) {
        setTimeout(function () {
            image.style.display = "flex";
            image.classList.add("circular"); 
        }, 1000); // Ajustez la valeur 1000 (en millisecondes) pour ajuster le délai d'apparition
    }

    // Faites apparaître chaque image avec un délai
    images.forEach(function (image) {
        fadeInImage(image);
    });
});