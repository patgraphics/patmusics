<?php
//si le fichier est appele directement dans le navigateur, on redirige vers index.php 
if (stristr($_SERVER['REQUEST_URI'], ".view.php")) header("location:../index.php");

print "<h2>connexion</h2>";

$title = "connection"; 

?>

<div id="Bloc">
    <form action="<?php echo htmlspecialchars('index.php?action=cnx');?>" method="POST" >
        <label for="pseudo"><b>Pseudo</b></label><br>
        <input name="pseudo" type="text" placeholder="ton pseudo"><br> 
        <label for="motdepasse"><b>Mot de passe</b></label><br>
        <input name="motdepasse" type="password" placeholder="ton mot de passe"><br>
        <button class="bt2" type="submit">Connection</button><br>
        <?php
        if (isset($error)) {
            echo $error;
        }
        ?>
    </form>

</div>

