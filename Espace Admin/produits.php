<?php
session_start();
$bdd= new PDO('mysql:host=localhost; dbname=Innovupoffres;','root','');
if(!$_SESSION['mdp']){
    header('Location: connexion.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Publications</title>
    <style>
      .navi{
        color: white;
      }
      .navi:hover{
        color: peru;
      }
    </style>
</head>
<body>
    <!-- navbar -->
<div class="b-example-divider"></div>

<header style="background-color: black;" class="p-3 mb-3 border-bottom">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="index.php" class="nav-link px-2 link-secondary navi">Accueil</a></li>
        <li><a href="produits.php" class="nav-link px-2 link-dark navi">Publications</a></li>
        <li><a href="clients.php" class="nav-link px-2 link-dark navi">Clients</a></li>
      </ul>
      <h4  style="color:peru; font-weight: 700; margin-top: 5px;">ADMIN</h4>
      <a style="margin-left: 10px ;" type="button" class="btn btn-dark" href="deeconnexion.php">Déconnexion</a>
    </div>
  </div>
</header>

<?php

$allproduit=$bdd->query('SELECT *  FROM publications p , clients c where p.client_id = c.id_client and id_produits ORDER BY id_produits DESC ');
if(isset($_GET['recherche']) AND !empty($_GET['recherche'])){
    $recherche= htmlspecialchars($_GET['recherche']);
    $allproduit=$bdd->query('SELECT *  FROM publications p , clients c where p.client_id = c.id_client and id_produits AND nom_produits LIKE "%'.$recherche.'%" ORDER BY id_produits DESC ');
}

?>
<br>
<div class="container">
<form class="d-flex" method="GET">
      <input class="form-control me-2" type="search" name="recherche" placeholder="Recherche publication par catégorie" aria-label="Search" autocomplete="off">
      <button class="btn btn-outline-success" name="rechercher" type="submit">Rechercher</button>
    </form>
    <section class="afficher_theme">
      </div>

<br><br>
    <h1 align='center' class="parti" > Liste Publications</h1>
    <br><br><br><br>
    <table class="table table-hover">
        <tr>
            <td>ID</td>
            <td>ID Client</td>
            <td>Catégorie</td>
            <td>Prix </td>
            <td>Description</td>
            <td>Numero Télephone</td>
            <td>Date </td>
            <td>Image</td>
            <td>Action</td>
         
        </tr>
  
  <?php
  //Pour confirmer un produit
   if(isset($_GET['confirme'])AND !empty($_GET['confirme'])){
    $confirme =(int) $_GET['confirme'];

    $req=$bdd->prepare('UPDATE publications SET confirmer = 1 WHERE id_produits= ?');
    $req->execute(array($confirme));
    header('Location: produits.php');

}
//pour supprimer un produit 
if(isset($_GET['supprime'])AND !empty($_GET['supprime'])){
    $supprime =(int) $_GET['supprime'];

    $req=$bdd->prepare('DELETE FROM publications WHERE id_produits= ?');
    $req->execute(array($supprime));
}

      if($allproduit-> rowCount()>0){
        while($produits = $allproduit->fetch()){
        ?>
            <tr>
            <td> <?php echo $produits['id_produits'] ?></td>
            <td> <?php echo $produits['id_client'] ?></td> 
            <td> <?php echo $produits['nom_produits'] ?></td> 
            <td> <?php echo $produits['prix_produits'] ?></td> 
            <td> <?php echo $produits['descriptions'] ?></td> 
            <td> <?php echo $produits['num_client'] ?></td>
            <td> <?php echo $produits['date_produits'] ?></td>
            <td> <img src="../Espace Client/files/<?php echo $produits['image_produits']?>" style="width: 90px; height:90px;" ></td> 
            <td><?php if($produits['confirmer']==0){?> <a class="btn btn-success" href="produits.php?confirme=<?= $produits['id_produits'] ?>">Confirmer</a><?php }?>
             <a class="btn btn-danger" href="produits.php?supprime=<?= $produits['id_produits'] ?>">Supprimer</a>
            </td>
            </tr>

        <?php
    }

  }else {
                
   echo "<div class='alert alert-danger' role='alert' style=' font-weight: 700;'>
   Rien à afficher
 </div> " ;
 

 }
 
 ?>  
    
    </table>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>