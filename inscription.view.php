<?php
//si le fichier est appele directement dans le navigateur, on redirige vers index.php 
if (stristr($_SERVER['REQUEST_URI'], ".view.php")) header("location:../index.php");

print "<h2>inscription</h2>";
?>
<div id="Bloc">
    <form action="index.php?action=ins" method="post" >
        <div class="box">
                <label for="nom"><b>Nom (1 à 30 caractères)</b></label><br>
                <input name="nom" type="text" placeholder="votre nom"><br>
                <label for="prenom"><b>Prénom (1 à 30 caractères)</b></label><br>
                <input name="prenom" type="text" placeholder="votre prénom"><br>
                <label for="pseudo"><b>Pseudo (2 à 20 caractères)</b></label><br>
                <input name="pseudo" type="text" placeholder="choisissez un pseudo"><br>
                <label for="email"><b>Mail</b></label><br>
                <input name="email" type="email" placeholder="votre adresse email"><br>
                <label for="numero"><b>Numéro</b></label><br>
                <input name="numero" type="text" placeholder="numéro complet"><br>
                <label for="adresse"><b>Adresse</b></label><br>
                <input name="adresse" type="text" placeholder="type et nom de rue"><br>
                <label for="codePostal"><b>Code Postal</b></label><br>
                <input name="codePostal" type="text" placeholder="votre code postal"><br>
                <label for="ville"><b>Ville</b></label><br>
                <input name="ville" type="text" placeholder="votre ville"><br>
                <label for="motPass1"><b>Mot de passe (minimum 8 caractères)</b></label><br>
                <input name="motPass1" type="password" placeholder="mot de passe"><br>
                <label for="motPass2"><b>Mot de passe</b></label><br>
                <input name="motPass2"type="password" placeholder="retapez le mot de passe svp"><br>
                <button class="bt2" type="submit">insciption</button> <br>
         </div>
    </form>
</div>
