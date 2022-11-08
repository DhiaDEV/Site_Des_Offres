<?php
$bdd= new PDO('mysql:host=localhost; dbname=Innovupoffres;','root','');

$pubsParPage=5;
$pubsTotalesReq=$bdd->query('SELECT id_produits , client_id from publications');
$pubsTotales=$pubsTotalesReq->rowCount();
$pageTotales = ceil( $pubsTotales/$pubsParPage);
if(isset($_GET['page'])AND !empty($_GET['page']) AND $_GET['page']>0 AND $_GET['page']<=$pageTotales){
  $_GET['page'] = intval($_GET['page']);
  $pageCourante = $_GET['page'];
} 
else {
  $pageCourante= 1;
}
$depart=($pageCourante-1)* $pubsParPage;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">
    <title>Accueil</title>
    <style>
        body{
            background-color: black;
        }
    .titree{
      padding: 10px;
      text-align: center;
      font-weight: 800;
      color: peru;
      font-size: 40px;
      text-decoration: underline;
    }
    .c{
      width: 40%;
    }
    .ccc{
      margin-left: 220px;
    }

  
    
    </style>
   
</head>
<body>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    
<div class="site-wrap" id="home-section">

  <div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>



  <header class="site-navbar site-navbar-target" role="banner">

    <div class="container">
      <div class="row align-items-center position-relative">

        <div class="col-3 ">
          <div class="site-logo">
            <a style="color: peru ; font-weight: 800;" href="index.php">Innovup Offres</a>
          </div>
        </div>

        <div class="col-9  text-right">
          

          <span class="d-inline-block d-lg-none"><a href="#" class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span class="icon-menu h3 text-white"></span></a></span>

          

          <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
            <ul class="site-menu main-menu js-clone-nav ml-auto ">
              <li class="active"><a href="index.php" class="nav-link">Home</a></li>
              <li><a href="lesPubs.php" class="nav-link">Publication</a></li>
              <li><a href="contact.html" class="nav-link">Contact</a></li>
            </ul>
          </nav>
        </div>

        
      </div>
    </div>

  </header>

<br><br>
<br>
<br>
<br>



    <div class="container c ">
<?php
  $recupproduit= $bdd->query('SELECT * FROM publications p , clients c where p.client_id = c.id_client and  id_produits and confirmer = 1 ORDER BY id_produits DESC limit '. $depart.','.$pubsParPage);
     while($produits = $recupproduit->fetch()){

?>

        <div class="col">
          <div class="card shadow-sm carte">
            <img class="bd-placeholder-img card-img-top" width="100%" height="350" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false" src="../Projet_PFA/Espace Client/files/<?php echo $produits['image_produits']?>"  >
            <div class="card-body">
              <p class="card-text" style="font-weight: 700 ;text-decoration: underline;"><?php echo $produits['pseudo'] ?></p>
              <p class="card-text"> <span class="titr">Catégorie: </span> <?php echo $produits['nom_produits'] ?></p>
              <p class="card-text"> <span class="titr">Prix: </span> <?php echo $produits['prix_produits'] ?> <span style="font-weight: 500 ;"> TND</span></p>
              <p class="card-text"> <span class="titr">Description: </span> <?php echo $produits['descriptions'] ?></p>
              <p class="card-text"> <span class="titr">Numero de Telephone: </span> <?php echo $produits['num_client'] ?></p>

              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                </div>
                <small class="text-muted"><?php echo $produits['date_produits'] ?></small>
              </div>
            </div>
          </div>
        </div>
        <br>
    


<?php
}
?> 
<div class="container ccc">
<?php
for($i=1; $i<=$pubsTotales;$i++){
  if($i== $pageCourante){
    echo $i.' ';
  }else{
    echo '<a href="lesPubs.php?page='.$i.'">'.$i.'</a> ';

  }
}
?>
</div>
  </body>
</html>