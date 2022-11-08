<?php
session_start();
$bdd= new PDO('mysql:host=localhost; dbname=Innovupoffres;','root','');

//validation de formulaire
if(isset($_POST['valider'])){
    //vérifier si l'user a completer  tous les champs 
    if(!empty($_POST['pseudo']) AND !empty($_POST['lastname']) AND !empty($_POST['firstname']) AND !empty($_POST['mdp']) ){
        //Les données de l'user
        $user_pseudo = htmlspecialchars($_POST['pseudo']);
        $user_lastname=htmlspecialchars($_POST['lastname']);
        $user_firsttname=htmlspecialchars($_POST['firstname']);
        $user_password=password_hash($_POST['mdp'],PASSWORD_DEFAULT);

        // verifier si l'utilisateur existe deja dans le site
        $checkIfUserAlReadyExists =$bdd->prepare('SELECT pseudo FROM clients WHERE pseudo=?');
        $checkIfUserAlReadyExists->execute(array($user_pseudo));

        if($checkIfUserAlReadyExists->rowCount()==0){
            // insérer l'user dans le BDD
            $insertUserOnWebSite = $bdd->prepare('INSERT INTO clients(pseudo , nomC , prenomC , mdpC) VALUES(?,?,?,?)');
            $insertUserOnWebSite->execute(array($user_pseudo,$user_lastname,$user_firsttname,$user_password));
            //Récuperer les informations de l'utilisateur
            $getInfosOfThisUserReq= $bdd->prepare('SELECT id_client ,pseudo ,nomC , prenomC FROM clients WHERE nomC= ? AND prenomC =? AND pseudo=?');
            $getInfosOfThisUserReq->execute(array($user_lastname,$user_firsttname,$user_pseudo));

            $userInfo= $getInfosOfThisUserReq-> fetch();
            // Authentifier l'utilisateur sur le site et récupérer ses données dans des variables globales sessions
            $_SESSION['auth']= true;
            $_SESSION['id_client']= $userInfo['id_client'];
            $_SESSION['lastname']= $userInfo['nomC'];
            $_SESSION['firstname']= $userInfo['prenomC'];
            $_SESSION['pseudo']= $userInfo['pseudo'];

            //Rediriger l'utilisateur sur la page d'accueil
            header('Location: profil.php?id_client='.$_SESSION['id_client']);






        }else{
            $errorMsg="L'utilisateur existe déja  ";
        }


    } else {
        $errorMsg="<div class='alert alert-danger' role='alert' style=' font-weight: 700;'>
        Veuillez complèter tous les champs
        </div> ";

    }
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
    <title>Connexion</title>


    <style>
        body{
            height: 100%;
            background-color: #04151F;
        }
        .vh-100{
            background-color: #04151F;
            height: 100%;
        }
        .formu{
            margin-top: -40px;
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

                <h3 class="mb-5">S'inscrire</h3>

                <div class="form-outline mb-4">
                <input type="text" name="pseudo" class="form-control form-control-lg" />
                <label class="form-label" >Pseudo</label>
                </div>

                <div class="form-outline mb-4">
                <input type="text" name="lastname" class="form-control form-control-lg" />
                <label class="form-label" >Nom</label>
                </div>

                <div class="form-outline mb-4">
                <input type="text" name="firstname" class="form-control form-control-lg" />
                <label class="form-label" >Prenom</label>
                </div>

                <div class="form-outline mb-4">
                <input type="password" name="mdp" id="typePasswordX-2" class="form-control form-control-lg" />
                <label class="form-label" for="typePasswordX-2">Mot de passe</label>
                </div>

            

                <button name="valider" class="btn btn-primary btn-lg btn-block" type="submit">S'inscrire</button>
                <br>
                <div>
                <a type="button" class="btn btn-link" href="pageConnexion.php">J'ai déjà un compte, je me connecte</a>
                </div>
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