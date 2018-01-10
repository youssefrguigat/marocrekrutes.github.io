<?php
session_start();
require_once 'class.user.php';

$reg_user = new user();

if($reg_user->isloggedin()!="")
{
 $reg_user->redirect('index.php');
}
if(isset($_POST['btn-login']))
{
	$uemail = strip_tags($_POST['ruemail']);
	$upass = strip_tags($_POST['rupass']);
	if($reg_user->login1($uemail,$upass))
     {
    //$error = "Wrong Details !";

    $reg_user->redirect('compte_rekruteur.php');
    }
    else
    {
	$error = "
		      <div class='alert alert-danger'>
					E-mail ou mot de passe invalide.
			  </div>
			  ";
    } 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Login rekruteur - Maroc-Rekrute.com</title>
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
	<link href="https://www.stagiaires.ma/assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/signup-form.css" type="text/css" />
	<script type="text/javascript" src="assets/validate3.js" ></script>
	<style>
	  .signup-form-container {
	
	border-radius:3px;
	background:transparent;
	border-top:3px solid #d2d6de;
	margin:12% auto;
	max-width:450px;
	padding-bottom:10px;
	border-top-color:#00c0ef;
	box-shadow:0 8px 10px rgba(0, 0, 0, 0.5);
}
	</style>
</head>
<body>
<?php include_once'header.php'; ?>
<div class="container">
<div class="signup-form-container">
       <div class="form-header">
            <h1 class="form-title"><i class="fa fa-user" aria-hidden="true"></i> Déjà inscrit? Connectez-vous</h1>
            <div class="pull-right">
              <h3 class="form-title"><span class="glyphicon glyphicon-pencil"></span></h3>
            </div>

         </div>
       <div class="form-body">
           <form role="form" method="post" id="login-form1" autocomplete="on">
                  <?php if(isset($error)) echo $error;  ?>
            <div class="form-group">
               <div class="input-group">
               <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
               <input type="text" placeholder="E-mail" class="form-control" name="ruemail" />
               </div>
               <span class="help-block" id="error"></span>
            </div> 

            <div class="form-group">
               <div class="input-group">
               <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
               <input type="password" id="password2" placeholder="Mot de passe" class="form-control" name="rupass" />
               </div>
               <span class="help-block" id="error"></span>
            </div> 
            
             <div class="form-group">
                         <div class="input-group" >                                           
                        <a href="/password-recruteur-perdu.html" class="forgot">Mot de passe oublié ?</a>
                         </div>
                 </div>
                 <button class="btn btn-block btn-warning" name="btn-login" type="submit"><i class="fa fa-sign-in"></i>&nbsp; Connexion</button>
             <a href="inscription-rekruteur.php" class="btn btn-block btn-primary" ><i class="fa fa-user-plus"></i>&nbsp; Créer votre compte Recruteur</a>

            
      </form>
	  </div>
   </div>
</body>
</html>