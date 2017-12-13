<?php
/**
 * Created by PhpStorm.
 * User: Afaeld
 * Date: 25/11/2017
 * Time: 16:12
 */

if(isset($_POST['nouvelleQuantite'],$_POST['idProduit']))
{
    include_once "../Model/pdo.php";
    include_once "../Model/produits.php";
    $newQuantity = $_POST['nouvelleQuantite'];
    $id = $_POST['idProduit'];
    modifyStock($db,$id,$newQuantity);
    header("Location: ../stocks.php");
}
else
{
    include_once "Model/pdo.php";
    include_once "Model/produits.php";
    $listOfProducts = getProduits($db);
}