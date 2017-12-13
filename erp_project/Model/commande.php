<?php
/**
 * Created by PhpStorm.
 * User: Afaeld
 * Date: 25/11/2017
 * Time: 16:13
 */


function getCommandes($db)
{
    $sql = "SELECT * FROM Commandes";
    $query = $db->prepare($sql);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();
    $commandes = $query->fetchAll();
    return $commandes;

}

function addCommande($db,$dateLivraisonEst,$dateCommande,$prixcommande,$prixCommandeMarge,$quantite,$client,$idProduit,$isValid,$validationMessage)
{
    $dateEnvoi = "0000-00-00";
    $query = $db->prepare("INSERT INTO Commandes(dateLivraisonEst,dateCommande,prixCommande,prixCommande_avec_marge,quantite,date_envoi,Client,idProduit,isValid,message) VALUES (:dateLivraisonEst,:dateCommande,:prixCommande,:prixCommande_avec_marge, :quantite,:date_envoi,:Client,:idProduit,:isvalid,:message)");
    $query->bindParam(':dateLivraisonEst',$dateLivraisonEst);
    $query->bindParam(':dateCommande',$dateCommande);
    $query->bindParam(':prixCommande',$prixcommande);
    $query->bindParam(':prixCommande_avec_marge',$prixCommandeMarge);
    $query ->bindParam(':date_envoi',$dateEnvoi);
    $query->bindParam(':quantite',$quantite);
    $query->bindParam(':Client',$client);
    $query->bindParam(':idProduit',$idProduit);
    $query->bindParam(':isvalid',$isValid);
    $query->bindParam(':message',$validationMessage);
    $query->execute();
    //var_dump($query);
}
