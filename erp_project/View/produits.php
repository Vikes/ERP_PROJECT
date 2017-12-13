<?php
/**
 * Created by PhpStorm.
 * User: Afaeld
 * Date: 25/11/2017
 * Time: 15:50
 */
include_once "View/header.php";


?>
<div class="container">
    <div class="row">
        <div class="col s12">
            <h2 class="header">Liste des produits</h2>
        </div>
        <div class="col s12">
            <table>
                <thead>
                <tr>
                    <th>Id produit</th>
                    <th>Nom produit</th>
                </tr>
                </thead>

                <tbody>
                <?php
                foreach ($listOfProducts as $product)
                {
                    echo("<tr><td>".$product['idproduit']."</td><td>".$product['nom_produit']."</td></tr>");
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <h2 class="header">Ajouter produit</h2>
        </div>
    </div>
    <div class="row">
        <form method="post" action="Controller/produits.php">
            <div class="input-field col s6">
                <i class="material-icons prefix">add_box</i>
                <input name="nomProduit" id="icon_prefix" type="text" class="validate">
                <label for="icon_prefix">Nom Produit</label>
            </div>
            <div class="col s6">
                <button class="btn waves-effect waves-light" type="submit" name="action">Ajouter Produit
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>
</div>

<?php
include_once "View/footer.php";
?>