<?php
require_once("session.php");
	
require_once 'class.user.php';

$auth_user = new user();
	if($_SESSION['type']=="")
	{
		$auth_user->redirect('index.php');
	}
	else if($_SESSION['type']=="Candidat")
	{
	
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM candidat WHERE Id_candidat=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	}
	else{$auth_user->redirect('compte_rekruteur.php');}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <!-- Bootstrap -->
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap -->
    <!--<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">-->
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="style.css" type="text/css"  />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<title>welcome - <?php print($userRow['userEmail']); ?></title>
</head>

<body>
<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand " href="#" style="color:#00c0ef; font-size:19px;" >Maroc-Rekrute.ma</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" >
          
          <div class="nav pull-right">
            <ul class="nav navbar-nav" >
            <li class="dropdown">
          <a href="#" class="dropdown-toggle" style="color:#fff;font-size:16px;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Offres d'emploi  <span class="glyphicon glyphicon-chevron-down" style="font-size:9px;"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Cadres</a></li><li role="separator" class="divider"></li>
            <li><a href="#">Dirigeants</a></li><li role="separator" class="divider"></li>
            <li><a href="#">Jeunes diplômés</a></li><li role="separator" class="divider"></li>
            <li><a href="#">Métiers IT</a></li><li role="separator" class="divider"></li>
            <li><a href="#">Call center</a></li>
          </ul>
        </li>
        <li><a href="#" style="color:#fff;font-size:16px;">Offres de stage</a></li>
        <li class="active"><a href="#" style="color:#fff;font-size:16px;">CV en ligne</a></li>
            <li><a href="#" style="color:#fff;font-size:16px;">Qui sommes-nous ?</a></li>
            <li><a href="#" style="color:#fff;font-size:16px;">Contactez-nous</a></li>
          </ul>
		  <?php 
               if(!$session->isloggedin())
                 {?>
            <button type="button" class="btn btn-warning navbar-btn" data-toggle="modal" data-target="#myModal">
            <span class="glyphicon glyphicon-briefcase"></span> Espace Recruteur</button>nbsp;&nbsp;
            <a href="login-candidat.php" class="btn btn-primary navbar-btn"><span class="glyphicon glyphicon-user"></span> Espace Candidat</a>
           <?php}
		   else{?>
		    <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi <?php echo $userRow['userEmail']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
                <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
		   </ul><?php }?>
		  </div>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<?php include_once'header.php'; ?>
<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://www.codingcage.com">Maroc-rekrute.ma</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="http://www.codingcage.com/2015/04/php-login-and-registration-script-with.html">Back to Article</a></li>
            <li><a href="http://www.codingcage.com/search/label/jQuery">jQuery</a></li>
            <li><a href="http://www.codingcage.com/search/label/PHP">PHP</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi <?php echo $userRow['userEmail']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
                <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="clearfix"></div>
    	
    
<div class="container-fluid" style="margin-top:80px;">
	
    <div class="container">
    
    	<label class="h5">welcome : <?php print($userRow['firstname']); ?> <?php print($userRow['lastname']); ?>&nbsp; <?php echo session_id(); ?></label>
        <hr />
        
        <h1>
        <a href="home.php"><span class="glyphicon glyphicon-home"></span> home</a> &nbsp; 
        <a href="profile.php"><span class="glyphicon glyphicon-user"></span> profile</a></h1>
       	<hr />
        
        <p class="h4">User Home Page</p> 
       
        
    <p class="blockquote-reverse" style="margin-top:200px;">
    Programming Blog Featuring Tutorials on PHP, MySQL, Ajax, jQuery, Web Design and More...<br /><br />
    <a href="http://www.codingcage.com/2015/04/php-login-and-registration-script-with.html">tutorial link</a>
    </p>
    
    </div>

</div>

<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>