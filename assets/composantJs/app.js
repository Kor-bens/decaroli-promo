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

let divFleche = document.querySelector("#div-fleche");


let cercle = document.createElement("div");
cercle.id="cercle";
divFleche.appendChild(cercle);

cercle.addEventListener("click", scrollTop);

let fleche = document.createElement("img");
fleche.src = "../../assets/ressources/images/fleche.png";
fleche.id ="fleche";
cercle.appendChild(fleche);

fleche.addEventListener("click", scrollTop);

window.addEventListener('scroll', toggleScrollTop);
console.log(window.scrollY);
// Fonction pour faire défiler vers le haut de la page
function scrollTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

function toggleScrollTop() {
    // Ne pas activer sur les écrans de largeur <= 768 pixels
    if (window.innerWidth > 768) { 
        if (window.scrollY > 600) {
            cercle.classList.add('active');
            cercle.style.display = "flex";
            cercle.style.alignItems = "center";
            cercle.style.justifyContent = "center";
            console.log("cercle visible");
        } else {
            cercle.style.display = "none";
            console.log("cercle disparait");
        }

        if (window.scrollY > 600) {
            fleche.classList.add('active');
            fleche.style.display = "block";
            console.log("fleche visible");
        } else {
            fleche.style.display = "none";
            console.log("fleche disparait");
        }
    }
}



window.addEventListener('scroll', function() {
    console.log(window.scrollY);
});