<?php
$bdd= new PDO('mysql:host=localhost; dbname=Innovupoffres;','root','');
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
    .titree{
      padding: 10px;
      text-align: center;
      font-weight: 800;
      color: peru;
      font-size: 40px;
      text-decoration: underline;
    }
    .carte{
      width: 50%;
      height: 10px;
    }

  iframe{
    width: 100%;
  }
  .ou{
    text-align: center;
    font-weight: 800;


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
            <a  href="index.php" style="color: peru ; font-weight: 800; ">Innovup Offres</a>
          </div>
        </div>

        <div class="col-9  text-right">
          

          <span class="d-inline-block d-lg-none"><a href="#" class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span class="icon-menu h3 text-white"></span></a></span>

          

          <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
            <ul class="site-menu main-menu js-clone-nav ml-auto ">
              <li class="active"><a href="index.php" class="nav-link navi">Accueil</a></li>
              <li><a href="lesPubs.php" class="nav-link navi">Publications</a></li>
              <li><a href="contact.php" class="nav-link navi">Contact</a></li>
            </ul>
          </nav>
        </div>

        
      </div>
    </div>

  </header>
<div class="ftco-blocks-cover-1">
  <div class="site-section-cover overlay" data-stellar-background-ratio="0.5" style="background-image: url('b.jpg');">
    <div class="container">
      <div class="row align-items-center justify-content-center text-center">
        <div class="col-md-7">
          <h1 class="mb-3">Accélérez vos ventes et vos achats gratuitement!
</h1>
          <p>Gérer vos ventes et vos achats en toute sécurité sur notre site web
</p>
          <p><a href="../Projet_PFA/Espace Client/pageConnexion.php" class="btn btn-primary">Login users</a></p>
          <p><a href="../Projet_PFA/Espace Admin/connexion.php" class="btn btn-primary">Login Admin</a></p>

        </div>
      </div>
    </div>
  </div>
</div>
<h4 class="ou">Où sommes-nous</h4>
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12763.337548725165!2d10.186063!3d36.89431!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd67219130f77f260!2sINNOVUP!5e0!3m2!1sfr!2stn!4v1666130804159!5m2!1sfr!2stn" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>



<footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <h2 class="footer-heading mb-3">About Us</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
          </div>
          <div class="col-lg-8 ml-auto">
            <div class="row">
              <div class="col-lg-6 ml-auto">
                <h2 class="footer-heading mb-4">Quick Links</h2>
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                   
                  <li><a href= "contact.php" >Contact Us</a></li>
                </ul>
              </div>
              <div class="col-lg-6">
                <h2 class="footer-heading mb-4">Newsletter</h2>
                <form action="#" class="d-flex" class="subscribe">
                  <input type="text" class="form-control mr-3" placeholder="Email">
                  <input type="submit" value="Send" class="btn btn-primary">
                </form>
              </div>
              
            </div>
          </div>
        </div>
        </footer>

</div>


</body>
</html>
