<?php


include_once "View/header.php";



?>

<div class="row">
    <div class="col s12">
        <h2 class="header">Liste des commandes</h2>
        <div class="col s12">
            <table>
                <thead>
                <tr>
                    <th>Id Commande</th>
                    <th>Date de la commande</th>
                    <th>Echéance de la livraison</th>
                    <th>Produit commandé</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Prix margé</th>
                    <th>Client</th>
                    <th>Valide</th>
                    <th>Message</th>
                </tr>
                </thead>

                <tbody>
                <?php
                foreach ($listOfOrders as  $commande)
                {
                echo("<tr><td>".$commande['id']."</td><td>".$commande['dateCommande']."</td><td>".$commande['dateLivraisonEst']."</td><td>".$commande['idProduit']."</td><td>".$commande['quantite']."</td><td>".$commande['prixCommande']."</td><td>".$commande['prixCommande_avec_marge']."</td><td>".$commande['Client']."</td>");
                    if($commande['isValid'])
                    {
                        echo ("<td><i class=\"material-icons\">check</i></td><td>".$commande['message']."</td></tr>");
                    }
                    else
                    {
                        echo ("<td><i class=\"material-icons\">clear</i></td><td>".$commande['message']."</td></tr>");
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <h2 class="header">Ajouter une commande</h2>
</div>
<form method="post" action="Controller/commande.php">
    <div class="row">

            <div class="col s3">
                <div class="input-field">
                    <input type="text" class="datepicker" name="dateCommande">
                    <label for="datepicker">Date de commande</label>
                </div>
            </div>
            <div class="col s3">
                <div class="input-field">
                    <input type="text" class="datepicker" name="dateLivraison">
                    <label for="datepicker">Date de livraison</label>
                </div>
            </div>
            <div class="col s2">
                <div class="input-field">
                    <select name="idProduit">
                        <?php
                        echo("<option value='' disabled selected>Choose product</option>");
                        foreach ($listOfProducts as $product)
                        {
                            echo("<option value='".$product['idproduit']."'>".$product['nom_produit']."</option>")    ;
                        }

                        ?>
                    </select>
                </div>
            </div>
            <div class="col s2">
                <div class="input-field">
                    <label for="icon_prefix">Quantité</label>
                    <input name="quantite" id="icon_prefix" type="number" class="validate">
                </div>
            </div>
            <div class="col s2">
                <div class="input-field">
                    <label for="icon_prefix">Nom Client</label>
                    <input name="nomClient" id="icon_prefix" type="text" class="validate">
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col s3">
            <button class="btn waves-effect waves-light" type="submit" name="action">Valider commande
            <i class="material-icons right">send</i>
        </div>
    </div>
</form>


<?php
include_once "View/footer.php";
?>
