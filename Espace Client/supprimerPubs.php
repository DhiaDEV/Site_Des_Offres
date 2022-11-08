<?php
session_start();
$bdd= new PDO('mysql:host=localhost; dbname=Innovupoffres;','root','');
//Sécurité... 
if(!$_SESSION['auth']){
    header('Location: pageConnexion.php');

}

if(isset( $_GET['id_produits']) AND !empty($_GET['id_produits'])){
    // En recuperer l'id qui envoyer a modifier
    $getId=$_GET['id_produits'];
    $req=$bdd->prepare('DELETE FROM publications WHERE id_produits= ?');
    $req->execute(array($getId));
    header('Location: profil.php?id_client='. $_SESSION['id_client']);


}
?>