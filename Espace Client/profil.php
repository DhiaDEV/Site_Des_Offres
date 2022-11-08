<?php
session_start();
$bdd= new PDO('mysql:host=localhost; dbname=Innovupoffres;','root','');
//Sécurité... 
if(!$_SESSION['auth']){
    header('Location: pageConnexion.php');

}
if(isset($_GET['id_client']) AND $_GET['id_client']>0){
    $getid= intval($_GET['id_client']); //intval pour sécuriser l'id 
    //Récupérer les données de client par l id qui entrer
    $recupClient= $bdd->prepare('SELECT * FROM clients WHERE id_client= ?');
    $recupClient->execute(array($getid));
    $clientInfo= $recupClient->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Profile</title>
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
          <?php   
            if(isset($_SESSION['id_client']) AND $clientInfo['id_client']== $_SESSION['id_client']){

            
            ?>
          <li><a href="modifierProfile.php" class="nav-link px-2 link-dark navi">Paramètre</a></li>

          <?php
          }
          ?>
        </ul>
        <h4  style="color:peru; font-weight: 700; margin-top: 5px;"><?php echo $clientInfo['pseudo'] ?> </h4>
        <a style="margin-left: 10px ;" type="button" class="btn btn-dark" href="deconnexion.php">Déconnexion</a>
      </div>
    </div>
  </header>

<?php
//Déchiffrement
$myFiles=$bdd->prepare("SELECT * FROM publications p , clients c WHERE p.client_id = c.id_client and   type_img='image/*'");
$myFiles->execute();

foreach($myFiles as $data){
  $getFiles= "data:" .$data['type_img'] . ";base64,". base64_encode($data['position_img']);
}

  if(isset($_POST['envoyer'])){ 
    //ajouter pub
    if(!empty($_POST['nom_prd'])
    AND !empty($_POST['prix_prd'])
    AND !empty($_POST['description'])
    And !empty($_POST['num_client'])){

      $nom_prd=htmlspecialchars($_POST['nom_prd']);
      $prix_prd=htmlspecialchars($_POST['prix_prd']);
      $description=nl2br(htmlspecialchars($_POST['description']));
      $num_client = htmlspecialchars($_POST['num_client']);
      $fileType= $_FILES["file"]["type"];
      $fileName= $_FILES["file"]["name"];
      $file=$_FILES["file"]["tmp_name"];

      move_uploaded_file($file,"files/". $fileName);
      $position="files/". $fileName;

      $upload=$bdd->prepare("INSERT INTO publications(client_id,nom_produits,prix_produits,descriptions,num_client,image_produits,type_img,position_img) VALUES (:client_id, :nom_produits, :prix_produits, :descriptions, :num_client , :image_produits , :type_img , :position_img)");
      $upload->bindParam("client_id" ,$getid);
      $upload->bindParam("nom_produits",$nom_prd);
      $upload->bindParam("prix_produits",$prix_prd);
      $upload->bindParam("descriptions",$description);
      $upload->bindParam("num_client",$num_client);
      $upload->bindParam("image_produits", $fileName);
      $upload->bindParam("type_img",$fileType);
      $upload->bindParam("position_img",$position);
      if($upload->execute()){
        echo("<script>alert('Publication bien enregistrer')</script>");

      }
      else{
          echo'echec';
      }
  }}
?>
  <!-- Modal -->
<button type="button" class="btn btn-primary ajouter" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Ajouter</button>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter une Publication</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Catégorie</label>
            <input type="text" name="nom_prd" class="form-control">
          </div>  
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Prix</label>
            <input type="number" name="prix_prd" class="form-control">
          </div>
          <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
         </div>
         <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Numéro Téléphone</label>
            <input type="number" name="num_client" class="form-control">
          </div>
         <div class="mb-3">
          <label for="formFile" class="form-label">Image </label>
          <input class="form-control" type="file" name="file" accept="image/*" id="formFile">
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <button type="submit" name="envoyer" class="btn btn-primary" >Envoyer</button>
          </div>
         
    </form>
      </div> 
    </div>
  </div>
</div>

<div class="album py-5 bg-light">
    <div class="container cardd">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

<?php

      $id_client=$bdd->prepare("SELECT * FROM publications where client_id = ? and confirmer = 1 ");
      $id_client->execute(array($getid));
     while($produits = $id_client->fetch()){

?>

      <div class="col">
          <div class="card shadow-sm">
            <img class="bd-placeholder-img card-img-top" width="100%" height="350" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false" src="../Espace Client/files/<?php echo $produits['image_produits']?>"  >
            <div class="card-body">
              <p class="card-text" style="font-weight: 700 ;text-decoration: underline;"><?php echo $clientInfo['pseudo'] ?></p>
              <p class="card-text"> <span class="titr">Catégorie: </span> <?php echo $produits['nom_produits'] ?></p>
              <p class="card-text"> <span class="titr">Prix: </span> <?php echo $produits['prix_produits'] ?> <span style="font-weight: 500 ;"> TND</span></p>
              <p class="card-text"> <span class="titr">Description: </span> <?php echo $produits['descriptions'] ?></p>
              <p class="card-text"> <span class="titr">Numéro de Téléphone: </span> <?php echo $produits['num_client'] ?></p>

              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a class="btn btn-warning" href="modifierPubs.php?id_produits=<?= $produits['id_produits'] ?>">Modifier</a>
                  <a class="btn btn-danger" href="supprimerPubs.php?id_produits=<?= $produits['id_produits'] ?>">supprimer</a>

                </div>
                <small class="text-muted"><?php echo $produits['date_produits'] ?></small>
              </div>
            </div>
          </div>
        </div>

<?php
}
?> 


<?php if(isset($errorMsg)){echo'<p>'.$errorMsg.'</p>';} ?>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>

<?php } ?>