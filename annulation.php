<?php

echo"<h4>Attention ".$_SESSION['pseudo']." voulez vous vraiment annuler la commande ".$_SESSION['cde']." ? </h4>";

die("<div class='box'><br><a href='delete.php'><button class='bt2'>Oui</button></a> ou <a href='index.php?action=pay'><button class='bt2'>Non</button></a><div>");