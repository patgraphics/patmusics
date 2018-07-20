<?php
//si le fichier est appele directement dans le navigateur, on redirige vers index.php 
if (stristr($_SERVER['REQUEST_URI'], ".view.php")) header("location:index.php");


?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset = "utf-8">
    </head>
    <body>
      <div id="Bloc">
                <form action="mail.php" method="POST" enctype="text/plain">

                <?php
                    if(isset($_SESSION['pseudo'])){
                        echo'<h4>Bonjour '. $_SESSION['pseudo'].' nous sommes à votre écoute</h4>'  ;
                    }
                    else {
                ?>          <label>Votre Nom</label>
                            <input type="text" placeholder="Nom (souhaité)" name="txt_nom"><br><br>
                            <label>Votre Mail</label>
                            <input type="mail" placeholder="mail (souhaité)" name="txt_mail"><br><br>
                <?php
                    }
                ?>
                    
                    
                    <label>Votre demande concerne</label>
                    <select>
                        <option value="produits">Produits</option>
                        <option value="produits">Prix</option>
                        <option value="produits">Livraison</option>
                        <option value="produits">Service après vente</option>
                    </select><br><br>
                    <label>Votre Tel</label>
                    <input type="tel" placeholder="tel (souhaitable)" name="txt_tel"><br><br>
                    <textarea cols="30" rows="10" placeholder="Commentaires" name="txt_com"></textarea><br><br>	
                    <br><button type="submit">Envoyer</button><br>
                     <p align="center">
                         Nous vous répondrons dans les meilleurs délais
                     </p>
                      
                </form>
        </div>
      </body>
</html>