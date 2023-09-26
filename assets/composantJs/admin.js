const boutonClone = document.querySelector("#bouton-clone-form");
const conteneurFormulaire = document.querySelector("#conteneur-formulaire");

boutonClone.addEventListener("click", () => {
    const formulaireClone = document.querySelector(".formulaire-image").cloneNode(true);
    conteneurFormulaire.appendChild(formulaireClone);
    
    const boutonsSupprimerFormulaire = document.querySelectorAll(".supprimer-formulaire");
    
    boutonsSupprimerFormulaire.forEach((bouton) => {
        bouton.addEventListener('click', () => {
            const formulaireASupprimer = bouton.closest(".formulaire-image");
            formulaireASupprimer.remove();
        });
    });
});


  