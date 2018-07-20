<?php
//si le fichier est appele directement dans le navigateur, on redirige vers index.php 
if (stristr($_SERVER['REQUEST_URI'], ".view.php"))
    header("location:../index.php");

print "<h2>Nouvel Article</h2>";
?>


<h2>Ajouter un nouvel Article</h2>
<div class="easyui-panel" title="New Article" style="width:100%;max-width:400px;padding:30px 60px;">
    <form id="ff" method="POST" action="index.php?action=new">
        <div style="margin-bottom:20px">
            <select class="easyui-combobox" name="type" label="Type " style="width:100%"><option value="CD">CD</option><option value="DVD">DVD</option><option value="LIVRE">LIVRE</option></select>
        </div>
        <div style="margin-bottom:20px">
            
            <select class="easyui-combobox" name="idCategorie" style="width:100%"><option value="1">Policier</option><option value="2">Aventure</option><option value="3">Comédie</option><option value="4">Fiction</option><option value="5">Classique</option><option value="6">Rock</option><option value="7">Jazz</option><option value="8">Reggae</option><option value="9">Pop</option></select>
        </div>
        <div style="margin-bottom:20px">
            <label>Titre :</label>
            <input name="titre" placeholder="titre" style="width:100%" data-options="label:'Titre',required:true">
        </div>
        <div style="margin-bottom:20px"> 
            <label>Auteur :</label>
            <input name="auteur" placeholder="auteur" style="width:100%" data-options="label:'Auteur',required:true">
        </div>
        <div style="margin-bottom:20px">
            <label>Editeur :</label>
            <input name="editeur" placeholder="editeur" style="width:100%" data-options="label:'Editeur'">
        </div>
        <div style="margin-bottom:20px">
            <label>Prix de vente HT :</label>
            <input style="width: 20%" name="prixUnitaire" placeholder="en euros" style="width:100%;height:60px" data-options="label:'Prix de vente HT'">
        </div>
        <div style="margin-bottom:20px">
            <button  style="width: 100%" type="submit">Envoyer</button>
        </div>
    </form>
</div>

