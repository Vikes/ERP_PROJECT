<?php
/**
 * Created by PhpStorm.
 * User: Afaeld
 * Date: 25/11/2017
 * Time: 16:13
 */


function getProduits($db)
{
    $sql = "SELECT * FROM Produitfini";
    $query = $db->prepare($sql);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();
    $produits = $query->fetchAll();
    return $produits;

}

function addProduct($db,$productName)
{
    $quantity = 0;
    $query = $db->prepare("INSERT INTO Produitfini (nom_produit,quantite) VALUES (:name,:quantity)");
    $query->bindParam(':name',$productName);
    $query->bindParam(':quantity',$quantity);
    $query->execute();
    var_dump($query);
}

function modifyStock($db,$productId,$newQuantity)
{
    $query = $db->prepare("UPDATE Produitfini set quantite = :quantite WHERE idproduit = :idproduit");
    $query->bindParam(':quantite',$newQuantity);
    $query->bindParam(':idproduit',$productId);
    $query->execute();

}

function getQuantityByProductId($db,$productId)
{
    $sql = "SELECT quantite FROM Produitfini WHERE idproduit = :idproduit";
    $query = $db->prepare($sql);
    $query->bindParam(':idproduit',$productId);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();
    $stock = $query->fetch();
    return $stock['quantite'];

}
function getAllQuantity($db)
{
    $sql = "SELECT SUM(quantite) FROM Produitfini";
    $query = $db->prepare($sql);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();
    $stock = $query->fetchAll();
    return $stock;

}