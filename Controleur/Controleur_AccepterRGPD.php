<?php

use App\Vue\Vue_Connexion_Formulaire_client;
use App\Vue\Vue_ConsentementRGPD;
use App\Vue\Vue_Menu_Administration;
use App\Vue\Vue_Structure_Entete;

switch ($action) {
    case "accepte_RGPD":
        $utilisateur["aAccepterRGPD"] = 1;
        $utilisateur["DateAcceptationRGPD"] = date("Y-m-d");
        $utilisateur["IP"] = $_SERVER['REMOTE_ADDR'];
        //Appel à une nouvelle fonction du modèle  $_SESSION["idUtilisateur"]
        switch ($_SESSION["typeConnexionBack"]) {
            case "administrateurLogiciel":
                $_SESSION["typeConnexionBack"] = "administrateurLogiciel"; //Champ inutile, mais bien pour voir ce qu'il se passe avec des étudiants !
                    $Vue->setMenu(new Vue_Menu_Administration());
                break;
            case "utilisateurCafe":

                $Vue->setMenu(new Vue_Menu_Administration());
                break;
            case "entrepriseCliente":
                     include "./Controleur/Controleur_Gerer_Entreprise.php";
                break;
            case "salarieEntrepriseCliente":
                  include "./Controleur/Controleur_Catalogue_client.php";
                break;
        }
    break;
    case "refuser_RGPD":
        session_destroy();
        unset($_SESSION);
        $Vue->setEntete(new Vue_Structure_Entete());
        $Vue->addToCorps(new Vue_Connexion_Formulaire_client());
        break;
    default:
            $Vue->addToCorps(new Vue_ConsentementRGPD());
            break;


}
