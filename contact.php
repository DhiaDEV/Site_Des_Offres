<?php require_once 'mail.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>contact</title>
    <style>
        body{
            background-color: black;
        }
        .remplir{
            text-align: center;
            padding-top: 20px;
            font-size: 40px;
            font-weight: 800;
            color: peru;
            font-family: cursive;
        }
        .center1{
            width: 50%;
            
        }
        .lab{
            color: peru;
            font-weight: 800;
        }
    </style>
</head>
<body>

<?php
if(isset($_POST['valider'])){
    if(!empty($_POST['sujet'])AND !empty($_POST['nom_prenom'])AND !empty($_POST['telephone'])AND !empty($_POST['email'])AND !empty($_POST['description'])){
        $sujet=htmlspecialchars($_POST['sujet']);
        $nom_prenom=htmlspecialchars($_POST['nom_prenom']);
        $telephone=htmlspecialchars($_POST['telephone']);
        $email=htmlspecialchars($_POST['email']);
        $description= nl2br(htmlspecialchars($_POST['description']));

        //mail..
        $mail->addAddress('dhiainfo1@gmail.com');
        $mail->Subject= $sujet;
        $mail->Body ='<b>Nom_Prenom:</b> '. $nom_prenom. '<br><b>Telephone:</b> ' . $telephone.'<br><b>Adresse Electronique:</b> '. $email . '<br><b>Description:</b> <br>' .$description;   
        $mail->send();
        echo("<script> alert('Mail bien envoyer') ;</script>");
      }
}
  
?>



<h1 class="remplir">Contacter-Nous</h1>
<br><br>
<div class="container center1">
<form class="row g-3 needs-validation" novalidate method="POST" action="" align="center">

<div class="mb-3 row">
        <label for="exampleFormControlInput1" class="col-sm-2 col-form-label lab">Sujet</label>
        <div class="col-sm-10">
        <input type="text" name="sujet" class="form-control"  placeholder="Entrer votre sujet">
        </div>
        </div>

<div class="mb-3 row">
        <label for="nom_prenom" class="col-sm-2 col-form-label lab">Nom_Prenom</label>
        <div class="col-sm-10">
        <input type="text" name="nom_prenom" class="form-control"  placeholder="Entrer votre nom et prénom">
        </div>
        </div>

    <div class="mb-3 row">
        <label for="exampleFormControlInput1" class="col-sm-2 col-form-label lab">Téléphone</label>
        <div class="col-sm-10">
        <input type="number" name="telephone" class="form-control"  placeholder="Entrer votre numero">
    </div>
    </div>

    <div class="mb-3 row">
        <label for="exampleFormControlInput1" class="col-sm-2 col-form-label lab">Email</label>
        <div class="col-sm-10">
        <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
    </div>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label lab">Description</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>


        <br><br>
        
        <button type="submit" name="valider" class="btn btn-success">Envoyer</button>
        <button type="reset"  class="btn btn-danger">Annuler</button>
          
 </form>
</div>
</body>
</html>