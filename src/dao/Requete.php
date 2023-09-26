<?php  

class Requete{

    const REQ_NOM_ADMIN = "SELECT id_admin, nom, mdp FROM administrateur WHERE nom = :nom";
    const REQ_MODIF_TITRE = "UPDATE page SET titre = :titre WHERE id_page = 1";
    const REQ_MODIF_BACKGROUND = "UPDATE page SET bkgd_color = :background WHERE id_page = 1";
    const REQ_TITRE = "SELECT titre FROM page";
    const REQ_COULEUR = "SELECT bkgd_color FROM page";
    const REQ_AJOUT_IMAGE = "INSERT INTO image (url, nom_image, id_page) VALUES (:url, :nom_image, :id_page)";
    const REQ_URL_NOM_IMAGE = "SELECT nom_image, url FROM image WHERE id_page = 1";
}