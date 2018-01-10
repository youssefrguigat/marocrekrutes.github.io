<?php
session_start();
require_once 'class.user.php';

$auth_user = new user();
	
	if(isset($_SESSION['user_session']))
	{
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM rekruteur WHERE Id_rekruteur=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Maroc-Rekrute.com - Emploi, Stage, offres d'emploi et recrutement au Maroc - Recrutement de cadres, dépôt de CV, lettre de motivation et Entretien</title>
    <meta name="application-name" content="http://localhost/maroc-rekrute/"/>
    <meta name="msapplication-starturl" content="http://localhost/maroc-rekrute/"/>
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />
    <meta name="viewport" content="width=device-width, target-densitydpi=160dpi, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="images/logo.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Ceci est le meta description" />
    <meta name="keywords" content="ce sont des mots méta" />
    <meta property="prop1" content="teneur1" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<style type="text/css">
	@charset "utf-8";
.line1{
	
	background-image: url('images/index.jpg');
	background-repeat: no-repeat;
    background-position: center;
    background-attachment: fixed;
}
.line2{
	background-image: url('images/openspace1.jpg');
	background-repeat: no-repeat;
    background-position: center;
    background-attachment: fixed;
}
.all{
	background-image: url('images/index.jpg');
	background: no-repeat center center scroll;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: cover;
    -o-background-size: cover;
}

.search {
  
  border-radius:5px;
  background-color: rgb(47, 64, 80);
  opacity:0.9;
  margin:10px auto;
  padding:30px 0 40px 0;
  max-width:600px;
  box-shadow:0 1px 5px rgba(0, 0, 0, 0.1)
}
.search1 {
  
  border-radius:5px;
  background-color: rgb(47, 64, 80);
  opacity:0.9;
  padding:30px 0 40px 0;
  max-width:600px;
  box-shadow:0 1px 5px rgba(0, 0, 0, 0.1)
}
.clear{clear:both;}
.jumbotron {
      background-image: url('images/index.jpg');
	  background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
      color: #fff;
      padding: 150px 25px;
	  margin:0;
  }
  .container-fluid.service{
      padding: 20px 50px;
  }
  .bg-grey {
      background-color: #f6f6f6;
  }
  .space{margin:0 5px 0 5px;}
  .logo-small {
      color: #2f4050;
      font-size: 50px;
  }
  .logo {
      color: #f4511e;
      font-size: 200px;
  }
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
  }
  .fcustom
  {
	  background-color:#2f4050;
	  color:#fff;	  
  }
  .fcustom ul{list-style:none;margin:0;padding:0;}
  .fcustom li{list-style:none;margin:0;}
  .fcustom a
  {
	  color:#fff;
	  
  }
  .fcustom a:hover
  {
	  color:orange;
	  
  }
</style>
</head>
<body>

<?php include_once'header.php'; ?>

<div class="jumbotron text-center">
<div class="search">
  
  <p>Trouvez votre emploi ou stage en quelques clicks</p> 
  <form class="form-inline">
    <div class="input-group">
      <input type="email" class="form-control" size="50" placeholder="Entrez une fonction, un secteur, une ville..." name="search" required>
      <div class="input-group-btn">
        <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> <strong>Trouvez</strong></button>
      </div>
    </div>
  </form>
</div>
</div>
<!-- Container (offres d'emploi Section) -->
<div class="container-fluid bg-grey service text-center">
  
  <h1>Les recherches populaires</h1>
   <br><br>
  <div class="container">
  <div class="row">
    <div class="col-sm-4">
      <img src="images/icon1.png" alt="Paris" style="padding:20px;background-color:#fff;border:2px solid #6699ff;" width="160" height="160">
      <br><h5 class="btn btn-primary"><strong>Dirigeants</strong></h4>
    </div>
	<div class="col-sm-4">
       <img src="images/icon3.png" alt="San Francisco"style="padding:20px;background-color:#fff;border:2px solid #6699ff;" width="160" height="160">
       <br><h5 class="btn btn-primary"><strong>Jeunes diplômés</strong></h5>
    </div>
    <div class="col-sm-4">
      <img src="images/icon2.jpg" alt="New York" style="padding:20px;background-color:#fff;border:2px solid #6699ff;" width="160" height="160">
      <br><h5 class="btn btn-primary"><strong>Cadres</strong></h5>
    </div>    
  </div>
    <br><br>
  <div class="row">
    <div class="col-sm-4">
      <img src="images/icon4.png" alt="Paris"style="padding:20px;background-color:#fff;border:2px solid #6699ff;" width="160" height="160">
        <br><h5 class="btn btn-primary"><strong>Centres d'appel</strong></h5>
    </div>
    <div class="col-sm-4">
      <img src="images/icon5.png" alt="New York" style="padding:20px;background-color:#fff;border:2px solid #6699ff;" width="160" height="160">
        <br><h5 class="btn btn-primary"><strong>Métiers IT</strong></h5>
    </div>
    <div class="col-sm-4">
      <img src="images/icon6.png" alt="New York" style="padding:20px;background-color:#fff;border:2px solid #6699ff;" width="160" height="160">
        <br><h5 class="btn btn-primary"><strong>Stages</strong></h5>
    </div>
  </div>
 </div>
</div>	

<div class="container-fluid line2">
   <div class="row">
      <div class="col-sm-6" >
	  gg
	  </div>
	  <div class="col-sm-6">
	      <div class="search1">  
            <p>Trouvez votre emploi ou stage en quelques clicks</p> 
            <form class="form-inline">
              <div class="input-group">
                <input type="email" class="form-control" size="50" placeholder="Entrez une fonction, un secteur, une ville..." name="search" required>
                <div class="input-group-btn">
                <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> <strong>Trouvez</strong></button>
                </div>
              </div>
            </form>
           </div>
	  </div>
   </div>
</div>
<footer class="footer fcustom" >
    <div class="container">
        <div class="row">
            <a href="" data-scroll="true" data-id="#fortopscroll" class="scroll-arrow hidden-xs hidden-sm"><i class="fa fa-angle-up"></i></a>
            <div class="col-sm-12 col-lg-12">
                <div class="cols">
                    <div class="col-sm-6 col-md-3">
                        <div class="col">
                            <h3>Navigation rapide</h3>
                            <ul>
                                <li><a href="/conditions-generale-utilisation-et-confidentialite.html">Mentions légales</a></li>
                                <li><a href="http://company.rekrute.com/rekrute-emploi-et-recrutement/?q=node/9">Politique Qualité</a></li>
                                <li><a href="/foire-aux-questions.html">FAQ</a></li>
                                <li><a href="/contactez-nous.html">Contactez-nous</a></li>
                                <li><a href="http://company.rekrute.com/rekrute-emploi-et-recrutement">Qui sommes-nous ?</a></li>
                                <li><a href="/presse-et-media.html">Presse</a></li>
                                <li><a href="/plan-du-site-rekrute.html">Plan du site</a></li>
                                <li><a href="http://www.infosmaroc.com">Publicité</a></li>

                            </ul>
                        </div>
						<br><br><br>
						<div class="row">
                                <div class="offexp col-md-12">
                                    <h3>Retrouvez-nous sur les réseaux sociaux :</h3>
                                    <a class="ps" href="https://www.facebook.com/ReKrute/"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                                    <a class="ps" href="https://twitter.com/rekrutecom?lang=fr"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                                    <a class="ps" href="https://www.linkedin.com/company/815799/"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                                    <a class="ps" href="https://www.youtube.com/user/Rekrute1"><i class="fa fa-youtube-square" aria-hidden="true"></i></a>
                                </div>
                            </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="col">
                            <h3>Les offres par fonction</h3>
                            <ul>
                                <li><a href="/offres.html?page=&clear=1&positionId%5B0%5D=27">Offre d’emploi: Commercial / Vente / Export</a></li>
                                <li><a href="/offres.html?page=&clear=1&positionId%5B0%5D=20">Offre d’emploi: Production / Qualité / Sécurité</a></li>
                                <li><a href="/offres.html?page=&clear=1&positionId%5B0%5D=12">Offre d’emploi: Gestion / Comptabilité / Finance</a></li>
                                <li><a href="/offres.html?page=&clear=1&positionId%5B0%5D=21">Offre d’emploi: RH / Personnel / Formation</a></li>
                                <li><a href="/offres.html?page=&clear=1&positionId%5B0%5D=13">Offre d’emploi: Informatique / Electronique</a></li>
                                <li><a href="/offres.html?page=&clear=1&positionId%5B0%5D=11">Offre d’emploi: Gestion projet / Etudes / R&D</a></li>
                                <li><a href="/offres.html?page=&clear=1&positionId%5B0%5D=25">Offre d’emploi: Travaux / Chantiers / BTP</a></li>
                                <li><a href="/offres.html?page=&clear=1&positionId%5B0%5D=16">Offre d’emploi: Marketing / EBusiness</a></li>
                                <li><a href="/offres.html?page=&clear=1&positionId%5B0%5D=24">Offre d’emploi: Métiers du Call Center</a></li>
                                <li><a href="/offres.html?page=&clear=1&positionId%5B0%5D=37">Offre d’emploi: Banque (métiers de la)</a></li>
                                <li><a href="/offres.html?page=&clear=1&positionId%5B0%5D=3">Offre d’emploi: Assurance (métiers de l')</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="col">
                            <h3>Les offres par secteur</h3>
                            <ul>
                                <li><a href="/offres.html?page=&clear=1&sectorId%5B0%5D=12">Offre d’emploi: Call Center / Web Center</a></li>
                                <li><a href="/offres.html?page=&clear=1&sectorId%5B0%5D=25&sectorId%5B1%5D=24">Offre d’emploi: Informatique, Internet / Multimédia</a></li>
                                <li><a href="/offres.html?page=&clear=1&sectorId%5B0%5D=10">Offre d’emploi: Banque / Finance</a></li>
                                <li><a href="/offres.html?page=&clear=1&sectorId%5B0%5D=5">Offre d’emploi: Assurance / Courtage</a></li>
                                <li><a href="/offres.html?page=&clear=1&sectorId%5B0%5D=7">Offre d’emploi: Automobile / Motos / Cycles</a></li>
                                <li><a href="/offres.html?page=&clear=1&sectorId%5B0%5D=4">Offre d’emploi: Agroalimentaire</a></li>
                                <li><a href="/offres.html?page=&clear=1&sectorId%5B0%5D=48">Offre d’emploi: Offshoring / Nearshoring</a></li>
                                <li><a href="/offres.html?page=&clear=1&sectorId%5B0%5D=11">Offre d’emploi: BTP / Génie Civil</a></li>
                                <li><a href="/offres.html?page=&clear=1&sectorId%5B0%5D=16">Offre d’emploi: Distribution</a></li>
                                <li><a href="/offres.html?page=&clear=1&sectorId%5B0%5D=22">Offre d’emploi: Hôtellerie / Restauration</a></li>
                                <li><a href="/offres.html?page=&clear=1&sectorId%5B0%5D=15">Offre d’emploi: Conseil / Etudes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="col">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Les offres par ville</h3>
                                    <ul>
                                        <li><a href="offres-emploi-casablanca.html">Emploi Casablanca et région - Maroc</a></li>
                                        <li><a href="offres-emploi-rabat.html">Emploi Rabat et région - Maroc</a></li>
                                        <li><a href="offres-emploi-tanger.html">Emploi Tanger et région - Maroc</a></li>
                                        <li><a href="offres-emploi-marrakech.html">Emploi Marrakech et région - Maroc</a></li>
                                        <li><a href="/offres.html?page=&clear=1&countryId=-1">International</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="offexp col-md-12"><h3>Les offres par niveau d'expérience et d'étude</h3></div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <ul>
                                        <li><a href="/offres.html?page=&clear=1&studyLevelId=bac2">Bac + 2</a></li>
                                        <li><a href="/offres.html?page=&clear=1&studyLevelId=bac3">Bac + 3</a></li>
                                        <li><a href="/offres.html?page=&clear=1&studyLevelId=bac4">Bac + 4</a></li>
                                        <li><a href="/offres.html?page=&clear=1&studyLevelId=bac5%2B">Bac + 5 et plus</a></li>
                                    </ul>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <ul>
                                        <li><a href="/offres.html?page=&clear=1&workExperienceId%5B0%5D=1">Débutant</a></li>
                                        <li><a href="/offres.html?page=&clear=1&workExperienceId%5B0%5D=3">de 1 à 3 ans </a></li>
                                        <li><a href="/offres.html?page=&clear=1&workExperienceId%5B0%5D=4">de 3 à 5 ans</a></li>
                                        <li><a href="/offres.html?page=&clear=1&workExperienceId%5B0%5D=5">de 5 à 10 ans </a></li>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<br><br>
    <div class="btm-bar">
        <div class="container text-center">
            <p><strong>&copy; Copyright 2017 ReKrute. All rights reserved.</strong></p>
        </div>
    </div>
</footer>

</body>
</html>