<?php
/**
 * Created by PhpStorm.
 * User: lhote
 * Date: 26/11/2017
 * Time: 14:04
 */

define('HEURES_PAR_JOURS', '7');
define('JOURS_TRAVAILLES', '5');
define('DATE_PREMIER_JOUR', (new DateTime('1969-10-01 08:00:00'))->format('Y-m-d H:i:s'));
define('DUREE_LIVRAISON_FOURNISSEUR', '10');
define('DUREE_LIVRAISON_CLIENT_CONTRAT1', '2');
define('DUREE_LIVRAISON_CLIENT_CONTRAT2', '3');
define('SEUIL_STOCK_SECURITE', '15000');
define('DEBIT_MAX', '3000');
define('PRIX_INITIAL', '10000');


function calculFrequenceCommande($debitMax, $debitOptimal)
{
    return $debitMax / $debitOptimal;
}


function calculDebitOptimal($qteCommandeEcheance, $date_choisie, $date_echeance_production, $stock, $isClient1)
{
    $date_choisieFormat = strtotime($date_choisie);
    $date_echeance_productionFormat = strtotime($date_echeance_production);

    $dateUtile = get_nb_open_days($date_choisieFormat, $date_echeance_productionFormat) - ($isClient1 ? intval(DUREE_LIVRAISON_CLIENT_CONTRAT1) : intval(DUREE_LIVRAISON_CLIENT_CONTRAT2)) + 2;
    $stock = intval($stock);
    $stockProduitFini = ($stock < intval(SEUIL_STOCK_SECURITE) ? 0 : $stock - intval(SEUIL_STOCK_SECURITE));
    $stockSecurite = ($stock > intval(SEUIL_STOCK_SECURITE) ? intval(SEUIL_STOCK_SECURITE) : $stock);
    if ($dateUtile <= 0)
        throw new Exception('L\'interval donnée entre la date de commande et la date de livraison est trop courte.');
    else
        return (($qteCommandeEcheance - $stockProduitFini) + (intval(SEUIL_STOCK_SECURITE) - $stockSecurite)) / ($dateUtile);
}

function calculDureeFabrication($qteCommandeEcheance, $debitOptimal)
{
    return (intval($qteCommandeEcheance) / intval($debitOptimal));
}

function calculDebitProdMini($qteCommandeEcheance, $stock, $dateEcheance, $date)
{
    $stockProduitFini = ($stock < intval(SEUIL_STOCK_SECURITE) ? 0 : $stock - intval(SEUIL_STOCK_SECURITE));
    $tmpCalcul = $qteCommandeEcheance - $stockProduitFini;
    $tmpCalcul2 = get_nb_open_days($dateEcheance, $date);
    $tmpCalcul2 = intval($tmpCalcul2->format("%d"));
    return $tmpCalcul / $tmpCalcul2;
}

/**
 * Retourne le nombre de jour ouvré entre les deux dates
 * @param $date_start
 * @param $date_stop
 * @return int
 */
function get_nb_open_days($date_start ,$date_stop  )
{
    $arr_bank_holidays = array(); // Tableau des jours feriés

    //print_r($arr_bank_holidays);
    $nb_days_open = 0;
    // Mettre <= si on souhaite prendre en compte le dernier jour dans le décompte
    while ($date_start < $date_stop) {
        // Si le jour suivant n'est ni un dimanche (0) ou un samedi (6), ni un jour férié, on incrémente les jours ouvrés
        if (!in_array(date('w', $date_start), array(0, 6))
            && !in_array(date('j_n_'.date('Y', $date_start), $date_start), $arr_bank_holidays)) {
            $nb_days_open++;
        }
        $date_start = mktime(date('H', $date_start), date('i', $date_start), date('s', $date_start), date('m', $date_start), date('d', $date_start) + 1, date('Y', $date_start));
    }
    var_dump($nb_days_open);
    return $nb_days_open;
}

function get_nb_month($date_start, $date_stop)
{
    $date_stopFormate = new DateTime($date_stop);
    $date_startFormate = new DateTime($date_start);
    $res = $date_startFormate->diff($date_stopFormate)->m + ($date_startFormate->diff($date_stopFormate)->y * 12); // int(8)
    return $res;
}

function get_augmentation_prix($date_stop)
{
    $res = intval(PRIX_INITIAL);

    for ($i = 1; $i <= get_nb_month(DATE_PREMIER_JOUR, $date_stop); $i++) {
        $res = $res * 1.02;
    }
    return $res;
}

function get_nb_bobines($nb_boulons)
{
    $res = $nb_boulons / 1000;
    return $res;
}

function changeDate($db, $newDate)
{
    $query = $db->prepare("UPDATE Settings set date_choisie = :date WHERE ");
    $query->bindParam(':date', $newDate);
    $query->execute();
}
