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
    <title>Clients</title>
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

$allClient=$bdd->query('SELECT * FROM clients WHERE id_client');
if(isset($_GET['recherche']) AND !empty($_GET['recherche'])){
    $recherche= htmlspecialchars($_GET['recherche']);
    $allClient=$bdd->query('SELECT * FROM clients where id_client AND pseudo LIKE "%'.$recherche.'%" ORDER BY id_client DESC');
}

?>
<br>
<div class="container">
<form class="d-flex" method="GET">
      <input class="form-control me-2" type="search" name="recherche" placeholder="Recherche Clients" aria-label="Search" autocomplete="off">
      <button class="btn btn-outline-success" name="rechercher" type="submit">Rechercher</button>
    </form>
    <section class="afficher_Client">
      </div>

<br><br>
    <h1 align='center' >  Liste Des Clients</h1>
    <br><br><br><br>
    <table class="table table-hover">
        <tr>
            <td>ID</td>
            <td>Pseudo</td>
            <td>Nom</td>
            <td>Prenom</td>
            <td>Action</td>
        </tr>
   

  <?php
//pour supprimer un participant 
if(isset($_GET['supprime'])AND !empty($_GET['supprime'])){
    $supprime =(int) $_GET['supprime'];

    $req=$bdd->prepare('DELETE FROM clients WHERE id_client= ?');
    $req->execute(array($supprime));
}

      if($allClient-> rowCount()>0){
        while($client = $allClient->fetch()){
        ?>
            <tr>
            <td> <?php echo $client['id_client'] ?></td> 
            <td> <?php echo $client['pseudo'] ?></td> 
            <td> <?php echo $client['nomC'] ?></td> 
            <td> <?php echo $client['prenomC'] ?></td>  
            <td><a class="btn btn-danger" href="clients.php?supprime=<?= $client['id_client'] ?>">Supprimer</a></td>
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