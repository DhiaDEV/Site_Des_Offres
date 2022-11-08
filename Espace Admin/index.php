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
    <title>Admin</title>
    <style>
      .navi{
        color: white;
      }
      .navi:hover{
        color:peru;
      }
      .titre{
        text-align: center;
        text-decoration: underline;
        color: black;
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


<h1 class="titre">Les statistiques</h1>
<br><br><br><br>
<?php
$totalPubs= $bdd->query('SELECT count(*)  FROM publications ');
$totalClient=$bdd->query('SELECT count(*) FROM clients ');


?>
<div class="min-w-screen min-h-screen bg-gray-200 flex items-center justify-center px-5 py-5" style="background-color: peru ;">
    <div class="w-full max-w-3xl" >
        <div class="-mx-2 md:flex" >
            <div class="w-full md:w-1/3 px-2" >
                <div class="rounded-lg shadow-sm mb-4" >
                    <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden" >
                        <div class="px-3 pt-8 pb-10 text-center relative z-10" >
                            <?php
                        while($pubs = $totalPubs->fetch()){
                        ?>
                            <h4 class="text-sm uppercase text-gray-500 leading-tight participant">Publication</h4>
                            <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3"><?php echo $pubs[0] ;}?></h3>
                            <!-- <p class="text-xs text-green-500 leading-tight">▲ 57.1%</p> -->
                        </div>
                        <div class="absolute bottom-0 inset-x-0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/3 px-2">
                <div class="rounded-lg shadow-sm mb-4">
                    <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                        <div class="px-3 pt-8 pb-10 text-center relative z-10">
                        <?php
                        while($pubs = $totalClient->fetch()){
                        ?>
                            <h4 class="text-sm uppercase text-gray-500 leading-tight cycle">Clients</h4>
                            <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3"><?php echo $pubs[0] ;}?></h3>
                            <!-- <p class="text-xs text-red-500 leading-tight">▼ 42.8%</p> -->
                        </div>
                        <div class="absolute bottom-0 inset-x-0">
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>