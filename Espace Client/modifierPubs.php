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
    <title>Modifier Publication</title>
</head>
<body>

<?php
if(isset( $_GET['id_produits']) AND !empty($_GET['id_produits'])){
    // En recuperer l'id qui envoyer a modifier
    $getId=$_GET['id_produits'];
    

    $recupProduit=$bdd->prepare('SELECT * FROM publications WHERE id_produits=?');
    $recupProduit->execute(array($getId));

    if($recupProduit-> rowCount()>0){
      $produitInfo=$recupProduit->fetch();

      $nom_prd=$produitInfo['nom_produits'];
      $prix_prd=$produitInfo['prix_produits'];
      $description= $produitInfo['descriptions'];
      $num_client = $produitInfo['num_client'];
      $fileType= $produitInfo['type_img'];
      $fileName= $produitInfo['image_produits'];
      $file=$produitInfo['position_img'];

      move_uploaded_file($file,"files/". $fileName);
      $position="files/". $fileName;
    
      //   Nouvelle donnée asaisie
      if(isset($_POST['envoyer'])){
        $nom_prdSaisie=htmlspecialchars($_POST['nom_prd']);
        $prix_prdSaisie=htmlspecialchars($_POST['prix_prd']);
        $descriptionSaisie=htmlspecialchars($_POST['description']);
        $num_prdSaisie=htmlspecialchars($_POST['num_client']);
        $fileTypeNouv= $_FILES["file"]["type"];
        $fileNameNouv= $_FILES["file"]["name"];
        $fileNouv=$_FILES["file"]["tmp_name"];
        move_uploaded_file($fileNouv,"files/". $fileNameNouv);
        $positionNouv="files/". $fileNameNouv;

        // requête modifier
        $updateProduit=$bdd->prepare('UPDATE publications SET nom_produits=?, prix_produits=? , descriptions=? , num_client=? , image_produits=? 
            , type_img=? , position_img=?  WHERE id_produits=?');
        $updateProduit->execute(array($nom_prdSaisie,$prix_prdSaisie,$descriptionSaisie,$num_prdSaisie,$fileNameNouv,$fileTypeNouv,$positionNouv,$getId  ));

        header('Location: profil.php?id_client='. $_SESSION['id_client']);



      }

    }
}
 
?>

<!-- Modal -->
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Modifier Publication</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Catégorie </label>
            <input type="text" name="nom_prd" value="<?= $nom_prd?>" class="form-control">
          </div>  
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Prix</label>
            <input type="double" name="prix_prd" value="<?= $prix_prd ?>" class="form-control">
          </div>
          <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control" name="description"  id="exampleFormControlTextarea1" rows="3"><?= $description  ?></textarea>
         </div>
         <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Numéro Téléphone</label>
            <input type="number" name="num_client" value="<?=$num_client ?>" class="form-control">
          </div>
         <div class="mb-3">
          <label for="formFile" class="form-label">Image </label>
          <input class="form-control" type="file"  name="file" accept="image/*" id="formFile">
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <button type="submit" name="envoyer" class="btn btn-primary" >Envoyer</button>
          </div>
         
    </form>
      </div> 
    </div>
  </div>





    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>
