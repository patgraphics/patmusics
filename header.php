<?php


?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" type="image/png" href="img/logo.png" >
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="js/slidesho.js"></script>
    </head>
    <body>
        <div class="flex-container">
            <div class="navbar">
                <a href="index.php?action=acc">Accueil</a>
                <a href="index.php?action=pan">Catalogue</a>
                <a href="index.php?action=cde">Panier</a>
                <a href="index.php?action=cnt">Contact</a>

            </div> 

            <div class="navcnx">
                <?php if (!isset($_SESSION['pseudo'])) { ?>           
                    <a href="index.php?action=ins">Inscription</a>
                    <a href="index.php?action=cnx">Connexion</a>
                    <a href="index.php?action=new">Admin</a>
                <?php } else { print "<p>  ".($_SESSION['pseudo']."  </p>"); ?>    
                    <a href="index.php?action=dcx">Déconnexion</a>
                <?php } ?>
            </div> 
       </div> 
    </body>
</html>

