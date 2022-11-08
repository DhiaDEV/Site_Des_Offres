<?php 
session_start();
    if(isset($_POST['valider'])){
        if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){
            $pseudo_par_defaut="admin" ;
            $mdp_par_defaut="admin12345";

            $pseudo_saisi=htmlspecialchars($_POST['pseudo']);
            $mdp_saisi=htmlspecialchars($_POST['mdp']); 

            if($pseudo_saisi == $pseudo_par_defaut AND $mdp_saisi == $mdp_par_defaut){
                $_SESSION['mdp'] = $mdp_saisi ;
                header('Location: index.php');

            }else{
                $errorMsg="<div class='alert alert-danger' role='alert' style=' font-weight: 700;'>
            Votre mot de passe ou pseudo est incorrect
            </div> ";
               
            }

        }else{
            $errorMsg="<div class='alert alert-danger' role='alert' style=' font-weight: 700;'>
            Veuillez completer tous les champs
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
    <title>Connexion Admin</title>
    <style>
        .vh-100{
            background-color: #04151F;
        }
    </style>
</head>
<body>
<form action="" method="POST">

<section class="vh-100">
<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
        <div class="card-body p-5 text-center">

            <h3 class="mb-5">Admin</h3>

            <div class="form-outline mb-4">
            <input type="text" name="pseudo" class="form-control form-control-lg" />
            <label class="form-label" for="typeEmailX-2">Login</label>
            </div>

            <div class="form-outline mb-4">
            <input type="password" name="mdp" id="typePasswordX-2" class="form-control form-control-lg" />
            <label class="form-label" for="typePasswordX-2">Password</label>
            </div>

        

            <button name="valider" class="btn btn-primary btn-lg btn-block" type="submit">Connexion</button>
            <br>
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