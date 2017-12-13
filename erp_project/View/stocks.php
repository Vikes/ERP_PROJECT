<?php
/**
 * Created by PhpStorm.
 * User: Afaeld
 * Date: 25/11/2017
 * Time: 16:12
 */

include_once "View/header.php";

?>
<div class="container">
    <div class="row">
        <div class="col s12">
            <h2 class="header">Stocks</h2>
        </div>
        <div class="col s12">
            <table>
                <thead>
                <tr>
                    <th>Id produit</th>
                    <th>Nom produit</th>
                    <th>Quantite Produit</th>
                </tr>
                </thead>

                <tbody>
                <?php
                foreach ($listOfProducts as $product)
                {
                    echo("<tr><td>".$product['idproduit']."</td><td>".$product['nom_produit']."</td><td>".$product['quantite']."</td></tr>");
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <h2 class="header">Modifier stock</h2>
        </div>
    </div>
    <div class="row">
        <form method="post" action="Controller/stocks.php">
            <div class="input-field col s4">
                <select name="idProduit">
                    <?php
                    echo("<option value='' disabled selected>Choose product</option>");
                    foreach ($listOfProducts as $product)
                    {
                        echo("<option value='".$product['idproduit']."'>".$product['nom_produit']."</option>")    ;
                    }

                    ?>
                </select>
                <label>Materialize Select</label>
            </div>
            <div class="col s4">
                <label for="icon_prefix">Nouvelle quantité</label>
                <input name="nouvelleQuantite" id="icon_prefix" type="number" class="validate">

            </div>
            <div class="col s4">
                <button class="btn waves-effect waves-light" type="submit" name="action">Nouvelle quantité
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>
</div>

<?php
include_once "View/footer.php";
?>