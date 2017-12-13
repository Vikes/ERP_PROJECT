<?php
/**
 * Created by PhpStorm.
 * User: victo
 * Date: 18/10/2017
 * Time: 10:45
 */


if (isset($_POST['dateLivraison'], $_POST['dateCommande'], $_POST['quantite'], $_POST['nomClient'], $_POST['idProduit'])) {
    include_once("../Model/pdo.php");
    include_once("../Model/commande.php");
    include_once("../Model/produits.php");
    include_once("../Model/data.php");
    $isOrderValid = true;
    $isClient1 = true;
    $validationMessage = '';
    $prixCommande = 0;
    $prixCommandeMarge = 0;
    $dureeFabricationCalculee = 0;
    $stock = getQuantityByProductId($db, $_POST['idProduit']);
    if (strcmp($_POST['nomClient'], "Client1") == 0) {
        $isClient1 = true;
    } else {
        $isClient1 = false;
    }
    try {
        $debitOpti = calculDebitOptimal($_POST['quantite'], $_POST['dateCommande'], $_POST['dateLivraison'], $stock, $isClient1);
        if ($debitOpti > intval(DEBIT_MAX) ) {
            $isOrderValid = false;
            $validationMessage = "Le débit optimal est supérieur au débit maximum";
        }
        else {
            $dureeFabricationCalculee = calculDureeFabrication($_POST['quantite'], $debitOpti);
            $jourOuvre = get_nb_open_days(strtotime($_POST['dateCommande']), strtotime($_POST['dateLivraison']));

            if ($jourOuvre < $dureeFabricationCalculee) {
                $isOrderValid = false;
                $validationMessage = "Il n'y a pas assez de jour ouvré disponible pour pouvoir livrer à temps la commande : ".number_format($dureeFabricationCalculee,0)."(fab) < ".$jourOuvre."(jour ouvré)";
            }
        }
    } catch (Exception $e) {
        $isOrderValid = false;
        $validationMessage = $e->getMessage();
    }


    $prixCommande = (get_nb_bobines($_POST['quantite']) * (10000 + get_augmentation_prix( $_POST['dateCommande'])));
    $prixCommandeMarge = $prixCommande + ($prixCommande *100 / 30);
    addCommande($db, $_POST['dateLivraison'], $_POST['dateCommande'], $prixCommande,$prixCommandeMarge, $_POST['quantite'], $_POST['nomClient'], $_POST['idProduit'], $isOrderValid, $validationMessage);
    if ($isOrderValid) {
        $stockModifie = $stock - $_POST['quantite'];
        modifyStock($db, $_POST['idProduit'], $stockModifie);
    }
    header("Location: ../commande.php");
} else {
    include_once("Model/pdo.php");
    include_once("Model/commande.php");
    include_once("Model/produits.php");
    $listOfProducts = getProduits($db);
    $listOfOrders = getCommandes($db);
}


?>