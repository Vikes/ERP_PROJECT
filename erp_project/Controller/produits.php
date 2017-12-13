<?php
/**
 * Created by PhpStorm.
 * User: Afaeld
 * Date: 25/11/2017
 * Time: 16:14
 */






if(isset($_POST['nomProduit']))
{
    include_once "../Model/pdo.php";
    include_once "../Model/produits.php";
    $newProduct = $_POST['nomProduit'];

    addProduct($db,$newProduct);
    header("Location: ../produits.php");
}
else
{
    include_once "Model/pdo.php";
    include_once "Model/produits.php";
    $listOfProducts = getProduits($db);
}