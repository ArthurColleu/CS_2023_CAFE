<?php
namespace App\Modele;
use App\Utilitaire\Singleton_ConnexionPDO;
use DateTime;
use PDO;
use function App\Fonctions\tokenMotDePasse;

class Modele_tokens
{
    function Tokens_Select_By_id($idTokens)
    {
        $connexionPDO = Singleton_ConnexionPDO::getInstance();
        $requetePreparee = $connexionPDO->prepare('
        select *
        from token
        where id = :idTokens');
        $requetePreparee->bindValue('idTokens', $idTokens);
        $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
        $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
        if (count($tableauReponse) == 1)
            return $tableauReponse[0];
        return false;
    }

    function Tokens_Select_Token($Tokens)
    {
        $connexionPDO = Singleton_ConnexionPDO::getInstance();
        $requetePreparee = $connexionPDO->prepare('
        select *
        from token
        where valeur = :paramvalue');
        $requetePreparee->bindParam('paramvalue', $Tokens);
        $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
        return $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    }

    function Tokens_Creer($codeAction, $idUtilisateur,$dateFin)
    {
        $dateFin= new \DateTime($dateFin);
        $dateFin=$dateFin->format('Y-m-d H:i:s');

        $jeton = tokenMotDePasse(30);

        $connexionPDO = Singleton_ConnexionPDO::getInstance();
        $requetePreparee = $connexionPDO->prepare(
            'INSERT INTO `token`
         VALUES (NULL,:paramValeur, :paramCodeAction, :paramIdUtilisateur, :paramDateFin);');
        $requetePreparee->bindParam('paramValeur', $jeton);
        $requetePreparee->bindParam('paramCodeAction', $codeAction);
        $requetePreparee->bindParam('paramIdUtilisateur', $idUtilisateur);
        $requetePreparee->bindParam('paramDateFin', $dateFin);
        $requetePreparee->execute();
    }

    function Tokens_Update_date($id, $dateFin)
    {
        $dateFin = new \DateTime($dateFin);
        $dateFin = $dateFin->format('Y-m-d H:i:s');
        $connexionPDO = Singleton_ConnexionPDO::getInstance();
        $requetePreparee = $connexionPDO->prepare(
            'UPDATE `token`
            SET dateFin = :paramDateFin
            WHERE id = :id;');
        $requetePreparee->bindParam('id', $id);
        $requetePreparee->bindParam('paramDateFin', $dateFin);
        $requetePreparee->execute();
    }
}