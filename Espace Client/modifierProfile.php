<?php
session_start();
$bdd= new PDO('mysql:host=localhost; dbname=Innovupoffres;','root','');
if(isset($_GET['id_client']) AND $_GET['id_client']>0){
    $getid= intval($_GET['id_client']); //intval pour sécuriser l'id 
    //Récupérer les données de client par l id qui entrer
    $recupClient= $bdd->prepare('SELECT * FROM clients WHERE id_client= ?');
    $recupClient->execute(array($getid));
    $clientInfo= $recupClient->fetch();
}
  


if(isset($_SESSION['id_client'])){

    $reqClient= $bdd->prepare('SELECT * FROM clients WHERE id_client= ? ');
    $reqClient->execute(array($_SESSION['id_client']));

    $clients= $reqClient->fetch();
    //Modification pseudo
    if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $clients['pseudo']){
        $newpseudo= htmlspecialchars($_POST['newpseudo']);
        $insertpseudo= $bdd->prepare("UPDATE clients SET pseudo =? WHERE id_client= ?");
        $insertpseudo->execute(array($newpseudo , $_SESSION['id_client']));
        header('Location: profil.php?id_client='. $_SESSION['id_client']);
    } 

  //Modification NOM
    if(isset($_POST['newlastname']) AND !empty($_POST['newlastname']) AND $_POST['newlastname'] != $clients['nomC']){
        $newlastname= htmlspecialchars($_POST['newlastname']);
        $insertlastname= $bdd->prepare("UPDATE clients SET nomC =? WHERE id_client= ?");
        $insertlastname->execute(array($newlastname , $_SESSION['id_client']));
        header('Location: profil.php?id_client='. $_SESSION['id_client']);
    } 

    //Modification Prenom
    if(isset($_POST['newfirstname']) AND !empty($_POST['newfirstname']) AND $_POST['newfirstname'] != $clients['prenomC']){
        $newfirstname= htmlspecialchars($_POST['newfirstname']);
        $insertfirstname= $bdd->prepare("UPDATE clients SET prenomC =? WHERE id_client= ?");
        $insertfirstname->execute(array($newfirstname , $_SESSION['id_client']));
        header('Location: profil.php?id_client='. $_SESSION['id_client']);
    }
    
     //Modification MDP
     if(isset($_POST['newmdp']) AND !empty($_POST['newmdp'])){
        $newmdp= sha1($_POST['newmdp']);
        $insertmdpC= $bdd->prepare("UPDATE clients SET mdpC =? WHERE id_client= ?");
        $insertmdpC->execute(array($newmdp , $_POST['newmdp']));
        header('Location: profil.php?id_client='. $_SESSION['id_client']);
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
    <title>Modifier Profile</title>
    <style>
        .retourpf{
            margin-left: 20px;
        }
    </style>
</head>
<body>
    
<form action="" method="POST" >
    <section class="vh-100">
    <div class="container py-5 h-100 formu">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

                <h3 class="mb-5">Modifier Profile</h3>

                <div class="form-outline mb-4">
                <input type="text" name="newpseudo" value="<?php echo $clients['pseudo'] ?>" class="form-control form-control-lg" />
                <label class="form-label" >Pseudo</label>
                </div>

                <div class="form-outline mb-4">
                <input type="text" name="newlastname" value="<?php echo $clients['nomC'] ?>"  class="form-control form-control-lg" />
                <label class="form-label" >Nom</label>
                </div>

                <div class="form-outline mb-4">
                <input type="text" name="newfirstname" value="<?php echo $clients['prenomC'] ?>"  class="form-control form-control-lg" />
                <label class="form-label" >Prenom</label>
                </div>

                <div class="form-outline mb-4">
                <input type="password" name="newmdp"   id="typePasswordX-2" class="form-control form-control-lg" />
                <label class="form-label" for="typePasswordX-2">Mot de passe</label>
                </div>

            

                <button name="valider" class="btn btn-primary btn-lg btn-block" type="submit">Modifier</button>
            
            </div>
            </div>

            <?php if(isset($errorMsg)){echo'<p>'.$errorMsg.'</p>';} ?>
        </div>
        </div>
    </div>
    </section>
</form>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>

<?php
}
else {
    header('Location: pageConnexion.php');
}

?>