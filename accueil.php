<?php
//si le fichier est appele directement dans le navigateur, on redirige vers index.php 
if (stristr($_SERVER['REQUEST_URI'], ".view.php")) header("location:../index.php");


?>

<html>
<head>
<title>accueil</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/slidesho.js"></script>
</head>

<body>
   
<div id="Accueil">	
    <div id="slideshow">
        <img src="img/led.png" width="150px" height="150px"><img src="img/bob.png"><img src="img/acdc.png"><img src="img/nina.png"><img src="img/bobinefilm.png"><img src="img/chaplin.png"><img src="img/scotland.png"><img src="img/superman.png"><img src="img/asterix.png"><img src="img/simson.png">
    </div>
</div>	
   
</body>
</html>