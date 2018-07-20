<?php

$products = Requete::selectFrom('Article', '*');
echo "<table><th>support</th><th>photo</th><th>titre</th><th>auteur</th><th>prix</th>";
foreach ($products as $products){
    echo "<tr>"
            . "<td>".$products->type."</td>"
            . "<td><img src='img/".$products->refArticle.".png' width='50px'></td>"
            . "<td>".$products->titre."</td><td>".$products->auteur."</td><td style='text-align:right'>".number_format($products->prixUnitaire,2)."</td>"
            . "<td><a href='addpanier.php?refArticle=".$products->refArticle."'><img src='img/buy.png'></a></td>"
        . "</tr>";
}
echo "</table>";
