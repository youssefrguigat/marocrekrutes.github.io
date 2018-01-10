<?php
session_start();
require_once 'class.user.php';

$reg_user = new user();

if($reg_user->isloggedin()!="")
{
 $reg_user->redirect('index.php');
}

if(isset($_POST['btn-signup']))
{
	$gender = trim($_POST['gender']);
	$firstname = trim($_POST['firstname']);
	$lastname = trim($_POST['lastname']);
    $society = trim($_POST['society']);
	$fonction = trim($_POST['fonction']);
	$email = trim($_POST['userEmail']);
	$ucpass = trim($_POST['ucpass']);
	$tel = trim($_POST['tel']);
	$reg_date = date("Y/m/d") ;
	$token= md5(uniqid(rand()));
	
	$stmt = $reg_user->runQuery("SELECT * FROM rekruteur WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if($stmt->rowCount() > 0)
	{
		$msg = "
		      <div class='alert alert-danger'>
					E-mail existe déjà, Veuillez fournir une autre adresse électronique valide.
			  </div>
			  ";
	}
	else
	{
		if($reg_user->register1($gender,$firstname,$lastname,$society,$fonction,$email,$ucpass,$tel,$reg_date,$token))
		{			
			$id = $reg_user->lastId();		
			$key = base64_encode($id);
			$id = $key;
			
			if($gender=="H"){$gender="Mr";}else{$gender="M";}
			
			$message = "					
						Bonjour $gender. $firstname $lastname,
						<br /><br />
						Nous vous remercions d'avoir choisi Maroc-ReKrute.com pour gérer vos offres en ligne et vous souhaitons la bienvenue sur nos pages.<br/>
						Pour confirmer votre compte, merci de valider votre e-mail en cliquant sur le lien suivant, ou en le copiant dans votre navigateur.
						<br /><br />
						<a href='http://localhost/maroc-rekrute/verifier.php?id=$id&token=$token'>http://localhost/maroc-rekrute/verifier.php?id=$id&token=$token</a>
						<br /><br />
						Notre équipe reste à votre entière disposition pour toute information complémentaire.
						<br /><br />
						Bonne visite sur ReKrute.com. 
						<br /><br />
						Très cordialement, 
						<br /><br />
						L'équipe de Maroc-ReKrute.com<br />
                        http://www.Maroc-ReKrute.com/<br />
                        E-mail : Contact@MarocReKrute.com<br />";
					
						
			$subject = "Confirmation de votre compte Rekruteur Maroc-ReKrute.com";
						
			$reg_user->send_mail($email,$message,$subject);	
			$msg = "
					<div class='alert alert-success'>
						Nous avons envoyé un email à $email.
                        Veuillez cliquer sur le lien de confirmation dans l'email pour créer votre compte.
			  		</div>
					";
		}
		else
		{
			echo "Désolé, la requête n'a pas pu s'exécuter ...";
		}		
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Inscription rekruteur - Maroc-Rekrute.com</title>
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
	<script type="text/javascript" src="assets/validate2.js" ></script>
	 <script type="text/javascript" src="assets/progress.js"></script>
	 <script type="text/javascript" src="assets/progress1.js"></script>
	 <script type="text/javascript">
	     $(document).ready(function(){
			 
            $("#password").click(function(){
            $("#pro").show();
         });
});
	 </script>
	 <style>
	  .signup-form-container1 {
	
	border-radius:3px;
	background:transparent;
	border-top:3px solid #d2d6de;
	margin:8% auto;
	max-width:550px;
	border-top-color:#00c0ef;
	box-shadow:0 8px 10px rgba(0, 0, 0, 0.5);
}

</style>
</head>
<body>
<?php include_once'header.php'; ?>
<div class="container">
   <div class="signup-form-container1">
      <form role="form" method="post" id="register-form1" autocomplete="off">
         
         <div class="form-header">
            <h1 class="form-title"><i class="fa fa-user" aria-hidden="true"></i> Inscrivez votre Entreprise : Information de base</h1>
            <div class="pull-right">
              <h3 class="form-title"><span class="glyphicon glyphicon-pencil"></span></h3>
            </div>

         </div>
         <div class="form-body">
             <?php if(isset($msg)) echo $msg;  ?>
			  <div class="ibox-content">
                        <div class="alert alert-info" role="alert">
            <div class="row vertical-info">
                <div class="col-xs-3 col-sm-2">
                    <i class="fa fa-exclamation-triangle fa-5x"></i>
                </div>
                <div class="col-xs-9 col-sm-10">
                    <p class="text-justify">
                        Aucune de ces informations ne sera visible par les étudiants. La gestion de vos candidatures se fera exclusivement sur notre site.</p>
                    
                </div>
            </div>
        </div>
             <div class="form-group">
               <div class="input-group" style="color:#888;"> 
                  <input type="radio" name="gender" value="H"> Homme&nbsp;&nbsp;&nbsp;
				  <?php if(isset($gender) && $gender=="Homme") echo "checked"; ?>
                  <input type="radio" name="gender"   value="F"> Femme
				  <?php if(isset($gender) && $gender=="Femme") echo "checked"; ?>				  
               </div>
               <span class="help-block" id="error" ></span>
            </div>

            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                  <input type="text" placeholder="Prénom" class="form-control" name="firstname" />
               </div>
               <span class="help-block" id="error" ></span>
            </div>
            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                  <input type="text" placeholder="Nom" class="form-control" name="lastname" />
               </div>
               <span class="help-block" id="error" ></span>
            </div>
            <div class="form-group">
               <div class="input-group">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></div>
                  <input type="text" placeholder="Société" class="form-control" name="society" />
               </div>
               <span class="help-block" id="error" ></span>
            </div>
			<div class="form-group">
               <div class="input-group">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-certificate"></span></div>
                  <input type="text" placeholder="Votre fonction" class="form-control" name="fonction" />
               </div>
               <span class="help-block" id="error" ></span>
            </div>
            <div class="form-group">
               <div class="input-group">
               <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
               <input type="text" placeholder="Adresse E-mail" class="form-control" name="userEmail" />
               </div>
               <span class="help-block" id="error"></span>
            </div> 

            <div class="row" style="margin-bottom:0;padding-bottom:0;">
                <div class="form-group col-lg-6" style="margin-bottom:0;padding-bottom:0;">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                            <input type="password" id="password" placeholder="Mot de passe" class="form-control" name="upass" />
                        </div>
						<div class="progress progress-striped active" style="display:none;" id="pro">
                        <div id="jak_pstrength" class="progress-bar" role="progressbar" 
						aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                        </div>
                        <span class="help-block" id="error"></span>
                </div>
                <div class="form-group col-lg-6" style="margin-bottom:6px;padding-bottom:0;">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                            <input type="password" id="cpassword" placeholder="Confirmez Mot de passe" class="form-control" name="ucpass" />
                        </div>
						<!--<div class="progress progress-striped active">
                        <div id="jak_pstrength1" class="progress-bar" role="progressbar" 
						aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                        </div>-->
                        <span class="help-block" id="error"></span>
                 </div> 				  
           </div>
           <div class="form-group">
               <div class="input-group">
               <div class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></div>
               <input type="text" placeholder="0621102516" class="form-control" name="tel" />
               </div>
               <span class="help-block" id="error"></span>
            </div> 
			 <div class="form-group">
                         <div class="input-group" >                                           
                        En cliquant sur le bouton <strong>'Valider mon inscription'</strong>, vous acceptez <strong><a href="https://www.stagiaires.ma/cgu">
						les conditions générales d'utilisation</a></strong>.
                         </div>
                 </div>
        </div>
		</div>
         <div class="form-footer">
		 
             <button class="btn btn-primary" type="submit" name="btn-signup">
               <span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Valider mon inscription
             </button>
         </div>
      </form>
   </div>
</div>
</body>
</html>