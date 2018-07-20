<?php



die("<div class='box'><h1>Bienvenue sur votre site sécurisé de paiement</h1>"
        . "commande ".$_SESSION['cde']." Montant".$_SESSION['montant']
        . "<a href='index.php?action=acc'><button class='bt2'>Régler</button></a><div>");
