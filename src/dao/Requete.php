<?php  

class Requete{

    const REQ_NOM_ADMIN = "SELECT id_admin, nom, mdp FROM administrateur WHERE nom = :nom";
    const REQ_MODIF_TITRE = "UPDATE page SET titre = :titre WHERE id_page = 1";
    const REQ_MODIF_BACKGROUND = "UPDATE page SET bkgd_color = :background WHERE id_page = 1";
    const REQ_TITRE = "SELECT titre FROM page";
    const REQ_COULEUR = "SELECT bkgd_color FROM page";
}