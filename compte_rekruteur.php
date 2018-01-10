<?php
require_once("session.php");
	
require_once 'class.user.php';
header('Content-Type: text/html; charset=ISO-8859-1');
$auth_user = new user();
	
	if(isset($_SESSION['user_session'])&& $_SESSION['type']=="Rekruteur")
	{
	  $IdRekruteur = $_SESSION['user_session'];
	
	  $stmt = $auth_user->runQuery("SELECT * FROM rekruteur WHERE Id_rekruteur=:IdRekruteur");
	  $stmt->execute(array(":IdRekruteur"=>$IdRekruteur));
	
	  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	
	  if(isset($_POST['btn-offrEmploi']))
      {
		 $secteur = $_POST['secteur'];
		 $fonctionn = $_POST['fonction1'];
		 $region = $_POST['region'];
		 $ville = $_POST['ville'];
		 $etude = $_POST['etude'];
		 $experience = $_POST['experience'];
		 $contrat = $_POST['contrat'];
		 $salaire = $_POST['salaire'];
		 $poste = $_POST['poste'];
		 $expDate = $_POST['exDate'];
		 $titre = $_POST['titre'];
		 $descPoste = $_POST['descPoste'];
		 $descProfil = $_POST['descprofil'];
		 
		 if($auth_user->saveOffreEmploi($IdRekruteur,$secteur,$fonctionn,$region,$ville,$etude,$experience,$contrat,$salaire,$poste,$expDate,$titre,$descPoste,$descProfil))
		{
			$msg_offre1= "
		      <div class='alert alert-success text-center'>
					<span class='glyphicon glyphicon-ok' style='font-size:18px;'></span>
					<strong>Votre offre d&apos;emploi est publi&eacute; avec succ&egrave;s et sera en ligne dans quelques munites.</strong>
			  </div>
			  ";
		}
	  }
	  if(isset($_POST['btn-enregistre']))
      {
		  $entreprise = $_POST['entreprise'];
		  $fonctionR = $_POST['fonctionU'];
		  $secteurU = $_POST['secteurU'];
		  $villeU = $_POST['villeU'];
		  $telU = $_POST['tel'];
		  $siteweb = $_POST['siteweb'];
		  $descriptionU = $_POST['descriptionU'];
		if($auth_user->UpdateInfo($IdRekruteur,$entreprise,$fonctionR,$secteurU,$villeU,$telU,$siteweb,$descriptionU))
		{
			$msg_Update= "
		      <div class='alert alert-success text-center'>
					<span class='glyphicon glyphicon-ok' style='font-size:18px;'></span>
					<strong>Modification effectu&eacute;e avec succ&egrave;s.</strong>
			  </div>
			  ";
		}
	  }
	  
	}
	else{$auth_user->redirect('compte.php');}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Compte rekruteur - Maroc-Rekrute.com</title>
    <link href="assets/styles.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="style.css" type="text/css"  />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
	<script type="text/javascript" src="assets/displayblock.js"></script>
	<script src="http://tinymce.cachefly.net/4.2/tinymce.min.js"></script>
   <script type="text/javascript" src="assets/charcl.js"></script>
   <script type="text/javascript" src="assets/charcl1.js"></script>
   <script type="text/javascript" src="assets/charcl3.js"></script>
   <script type="text/javascript" src="assets/validate4.js"></script>
   <link rel="stylesheet" href="assets/creat.css" type="text/css" />
	<link rel="stylesheet" href="assets/signup-form.css" type="text/css" />
	<link rel="stylesheet" href="assets/style2.css" type="text/css" />
	
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>

<body>
<?php include_once 'header.php'; ?>
<div class="container split">
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src="images/ceo.png" class="img-responsive img-circle" style="width:50%;height:20%;border:2px solid #00c0ef;" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						<?php echo $userRow['firstname']; ?>&nbsp;<?php echo $userRow['lastname']; ?>
					</div>
					<div class="profile-usertitle-job">
						<?php echo $userRow['fonction']; ?><br>
						
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<li class="active">
							<a href="#" id="pill1" alt="Tableau de bord"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;<strong>Tableau de bord</strong></a>
						</li>
						<?php
						if(isset($_SESSION['user_session'])&& $_SESSION['type']=="Rekruteur")
	                     {
							 $user_id = $_SESSION['user_session'];
	
	                         $stmt = $auth_user->runQuery("SELECT * FROM rekruteur WHERE Id_rekruteur=:user_id");
	                         $stmt->execute(array(":user_id"=>$user_id));
	
	                         $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
							 if ((is_null($userRow['description']))||(is_null($userRow['ville']))||(is_null($userRow['secteurs']))) 
							 { 
						       echo "<li class='dropdown'>
                               <a class='dropdown-toggle isDisabled' data-toggle='dropdown' alt='Crée une offre'  href='#'>
						       <span class='glyphicon glyphicon-pencil'></span>&nbsp;&nbsp;<strong>Cr&eacute;e une offre</strong>&nbsp;<span class='caret'></span></a>
                               <ul class='dropdown-menu'>
                                <li><a href='#' id='pill21' alt='Crée une offre d emploi'>Une offre d&apos;emploi</a></li>
                                <li><a href='#' id='pill22' alt='Crée une offre de stage'>Une offre de stage</a></li>
                               </ul>
                               </li> "; 
							   $check= "
		                         <div class='alert alert-danger text-center'>
				                  	<span class='glyphicon glyphicon-exclamation-sign' style='font-size:18px;'></span>
					                <strong>Afin de publier une offre, cliquez sur modifier pour compl&eacute;ter votre profil.</strong>
			                     </div>
			                      ";
						     }
                             else
							 { 
						       echo "<li class='dropdown'>
                               <a class='dropdown-toggle' data-toggle='dropdown' alt='Crée une offre'  href='#'>
						       <span class='glyphicon glyphicon-pencil'></span>&nbsp;&nbsp;<strong>Cr&eacute;e une offre</strong>&nbsp;<span class='caret'></span></a>
                               <ul class='dropdown-menu'>
                                <li><a href='#' id='pill21' alt='Crée une offre d emploi'>Une offre d&apos;emploi</a></li>
                                <li><a href='#' id='pill22' alt='Crée une offre de stage'>Une offre de stage</a></li>
                               </ul>
                               </li> ";
						     }
						 }
						?>
						<li>
							<a href="#" id="pill3" alt="Mes offres d'emploi"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;<strong>Mes offres d&apos;emploi</strong></a>
						</li>
						<li>
							<a href="#" id="pill4" alt="Mes offres de stage"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;<strong>Mes offres de stage</strong></a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
            <div class="profile-content" >
			<!--start info-->
				<div class="row" id="info">
                  <div class="col-md-12">
		           <div class="form-header">
                     <h1 class="form-title">
					 <span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp; Compte rekruteur</h1>
					 <a href="#" alt="Modifier" id="pill5" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-pencil"></i> Modifier</a>
                    </div>
					
                   <div class="form-body" >
				   <div class="account" style="margin-bottom:0;">
				         <div class="row">
						     <div class="col-md-12">
							     <?php if(isset($_SESSION['deleted'])){ ?>
                                  <div class="alert alert-success" style="display:none;" >
                                    <p><i class="fa fa-check" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;Votre offre a &eacute;t&eacute; supprim&eacute; avec succ&eacute;s</p>
                                  </div>
                                  <?php unset($_SESSION['deleted']);}?> 
								  <script>
								  $(".alert-success").css("display","block").fadeTo(4000, 500).slideUp(500, function(){
                                  $(".alert-success").css("display","none").slideUp(500);
                                   });
								   </script>
							     <?php if(isset($msg_offre1)) echo $msg_offre1;  ?>
								 <?php if(isset($check)) echo $check;  ?>
								 <?php if(isset($msg_Update)) echo $msg_Update;  ?>
							 </div>
						 </div>
						 </div>
				   <div class="account" style="margin-top:0;"> 
				       
				     <div class="container-fluid well span6">
					    
	                     <div class="row-fluid">
                             <div class="col-md-6">
                                <div class="span10">
								<strong>Entreprise:</strong>
                                <span title="<?php echo $userRow['society']; ?>"><?php echo $userRow['society']; ?></span><br>
                                 <strong>Ville:</strong>
								 <?php
								    $ville_id = $userRow['ville'];
	
	                                 $stmt = $auth_user->runQuery("SELECT * FROM ville WHERE id=:ville_id");
	                                 $stmt->execute(array(":ville_id"=>$ville_id));
	
	                                 $userVille=$stmt->fetch(PDO::FETCH_ASSOC);
								 ?>
								 <span title="<?php echo $userVille['ville']; ?>"><?php echo $userVille['ville']; ?></span><br>
								 	<strong>Site Web:</strong>
                                <span title="<?php echo $userRow['siteweb']; ?>">
								<a href="<?php echo $userRow['siteweb']; ?>"><?php echo $userRow['siteweb']; ?></a></span><br>							 
                                 <strong>Compte cr&eacute;&eacute; le:</strong>
								 <span title="<?php echo date("N F Y", strtotime($userRow['reg_date'])); ?>">
								 <?php echo date("j F Y", strtotime($userRow['reg_date'])); ?></span>       
                                         
                                </div>
							 </div>
							 <div class="col-md-6">
							 <?php
								    $secteur_id = $userRow['secteurs'];
	
	                                 $stmt = $auth_user->runQuery("SELECT * FROM secteur WHERE Id_secteur=:Id_secteur");
	                                 $stmt->execute(array(":Id_secteur"=>$secteur_id));
	
	                                 $userSecteur=$stmt->fetch(PDO::FETCH_ASSOC);
								 ?>
							 <strong>Secteur:</strong>
                                <span title="<?php echo $userSecteur['secteur']; ?>"><?php echo $userSecteur['secteur']; ?></span><br>
							 <strong>Email:</strong>
								 <span title="<?php echo $userRow['userEmail']; ?>"><?php echo $userRow['userEmail']; ?></span><br>							 
                                 <strong>T&eacute;l&eacute;phone:</strong>
								 <span title="<?php echo $userRow['tel']; ?>"><?php echo $userRow['tel']; ?></span><br>
								 
							 </div>
                         </div>
                         </div>
                     </div> 
           
                     <div class="account"> 
				       
				     <div class="container-fluid well span6">
					    
	                     <div class="row-fluid">
                             <div class="col-md-12">
                                <div class="span10">
								<strong>Description:</strong>
                                <p><?php echo $userRow['description']; ?></p>      
                                </div>
							 </div>
                         </div>
                         </div>
                     </div>		   
					</div>
                   </div>
		         </div>
	            
				<!--end start-->
				
				<!--start create emploi-->
				<div class="row" id="create_emploi">
                  <div class="col-md-12">
		           <div class="form-header">
                     <h1 class="form-title"><span class="glyphicon glyphicon-plus"></span>&nbsp; Cr&eacute;e une offre d&apos;emploi</h1>
                    
                   </div>
                   <div class="form-body" style="font-size:14px;">
		               <!--start Crée offre-->
					   <div class="descript">
					   <form role="form" method="post" autocomplete="on">
						  <fieldset>
						  <br>
						  <br>
                          <label for="Secteur d'activité">Secteur d&apos;activit&eacute;:</label>
                          <select  name="secteur">
                             <option value="0" selected="selected">S&eacute;lectionnez un secteur</option>
                             <?php
                               $stmt = $auth_user->runQuery("SELECT * FROM secteur order by secteur");
                               $stmt->execute();
        
                               while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                               {
                                extract($row);
                             ?>
                             <option value="<?php echo $Id_secteur; ?>"><?php echo $secteur; ?></option>
                             <?php
                               }
                             ?>
                          </select>
                            
							 <label for="fonction">Fonction:</label>
                            <select  name="fonction1">
                             <option value="0" selected="selected">S&eacute;lectionnez une fonction</option> 
							<?php
                               $stmt = $auth_user->runQuery("SELECT * FROM fonction order by fonction");
                               $stmt->execute();  
						       while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                               {
                                extract($row);
                             ?>
							 <option value="<?php echo $id_fonction; ?>"><?php echo $fonction; ?></option>
							 <?php
                               }
                             ?>
                             </select>
						  <div class="row">
						    <div class="col-md-7">
						  <label for="Région">R&eacute;gion:</label>
                          <select name="region">
                           <option value="0" selected="selected">S&eacute;lectionnez une r&eacutegion</option>
                             <?php
                               $stmt = $auth_user->runQuery("SELECT * FROM region");
                               $stmt->execute();
        
                               while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                               {
                                extract($row);
                             ?>
                             <option value="<?php echo $Id_region; ?>"><?php echo $region; ?></option>
                             <?php
                               }
                             ?>
                          </select>
						  </div>
						  <div class="col-md-5">
						  <label for="Ville">Ville:</label>
                          <select name="ville">
                            <option value="0" selected="selected">S&eacute;lectionnez une ville</option>
                             <?php
                               $stmt = $auth_user->runQuery("SELECT * FROM ville");
                               $stmt->execute();
        
                               while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                               {
                                extract($row);
                             ?>
                             <option value="<?php echo $id; ?>"><?php echo $ville; ?></option>
                             <?php
                               }
                             ?>
                          </select>
						  </div>
						 </div> 
						 <div class="row">
						    <div class="col-md-5">
							<label for="Niveau d'études">Niveau d&apos;&eacute;tudes:</label>
                          <select name="etude">
                              <option value="0" selected="selected">S&eacute;lectionnez un niveau d&apos;&eacute;tudes</option>
                             <?php
                               $stmt = $auth_user->runQuery("SELECT * FROM niveau_etude");
                               $stmt->execute();
        
                               while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                               {
                                extract($row);
                             ?>
                             <option value="<?php echo $Id_Netude; ?>"><?php echo $niveauEtude; ?></option>
                             <?php
                               }
                             ?>
                          </select>						  
						  </div>
						  <div class="col-md-7">
						  <label for="Niveau d'expérience">Niveau d&apos;exp&eacute;rience:</label>
                          <select name="experience">
                             <option value="0" selected="selected">S&eacute;lectionnez niveau d&apos;exp&eacute;rience</option>
                             <?php
                               $stmt = $auth_user->runQuery("SELECT * FROM niveau_experience");
                               $stmt->execute();
        
                               while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                               {
                                extract($row);
                             ?>
                             <option value="<?php echo $Id_niveau; ?>"><?php echo $niveau; ?></option>
                             <?php
                               }
                             ?>
                          </select>				  
						 
						  </div>
						 </div> 
						 <div class="row">
						  <div class="col-md-5">
						  <label for="Type de contrat">Type de contrat:</label>
                          <select name="contrat">
                            <option value="0" selected="selected">S&eacute;lectionnez Type de contrat</option>
                             <?php
                               $stmt = $auth_user->runQuery("SELECT * FROM contrat");
                               $stmt->execute();
        
                               while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                               {
                                extract($row);
                             ?>
                             <option value="<?php echo $Id_contrat; ?>"><?php echo $contrat; ?></option>
                             <?php
                               }
                             ?>
                          </select>
						  </div>
						  <div class="col-md-7">
						 <label for="Salaire">Salaire:</label>
                          <select name="salaire">
                            <option value="0" selected="selected">Salaire</option>
                             <?php
                               $stmt = $auth_user->runQuery("SELECT * FROM salaire");
                               $stmt->execute();
        
                               while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                               {
                                extract($row);
                             ?>
                             <option value="<?php echo $Id_salaire; ?>"><?php echo $salaire; ?></option>
                             <?php
                               }
                             ?>
                          </select>
						  </div>
						 </div> 
						 <div class="row">
						  <div class="col-md-5">
						  <label for="nbr_Poste">Postes propos&eacute;s:</label>
                          <input type="text" placeholder="Nombre de postes" id="nbrPoste" name="poste">
						  </div>
						  <div class="col-md-7">
						  <label for="Titre">Date d&apos;expiration de l&apos;offre:</label>
						  <input type="date" id="calendrier" max="2020-01-01" min="2018-01-01" name="exDate">
						   </div>
						 </div>
						  <label for="Titre">Titre:</label>
                          <input type="text" placeholder="Titre de l'offre" id="titre" name="titre">
						  </fieldset>
						  <fieldset>
						  <label for="Description">Description du poste:</label>
						  <textarea placeholder="Description du poste" id="a" class="description" name="descPoste"></textarea>
						  
						  </fieldset>
						  <fieldset>
						  <label for="Description">Profil recherch&eacute;:</label>
						  <textarea placeholder="Profil recherché" id="b" class="description" name="descprofil"></textarea>
                        </fieldset>
						<fieldset>
						<button type="submit" name="btn-offrEmploi" class="btn btn-primary btn-lg">Publier cette offre</button>
						</fieldset
					   </form>  
					   </div>
					   <!--end crée offre-->
                   </div>
		         </div>
	            </div>
				<!--end create emploi-->
				<script type="text/javascript" src="assets/charcl.js"></script>
				<!--start create stage-->
				<div class="row" id="create_stage">
                  <div class="col-md-12">
		           <div class="form-header">
                     <h1 class="form-title"><span class="glyphicon glyphicon-plus"></span>&nbsp; Crée une offre de stage :</h1>
                    
                   </div>
                   <div class="form-body" style="font-size:14px;">
		               <!--start Crée offre-->
					   <div class="signup-form-container1">
      <form role="form" method="post" id="register-form1" autocomplete="off">
         
         <div class="form-body">
             <?php if(isset($msg)) echo $msg;  ?>
			  <div class="ibox-content">
                       
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
                        En cliquant sur le bouton <strong>'Valider mon inscription'</strong>, vous acceptez <strong><a href="#">
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
					   <!--end crée offre-->
                   </div>
		         </div>
	            </div>
				<!--end create stage-->
				
				<!--start emploi-->
				<div class="row" id="emploi">
                  <div class="col-md-12">
		           <div class="form-header">
                     <h1 class="form-title"><span class="glyphicon glyphicon-list"></span>&nbsp; Mes offres d'emploi :</h1>
                     
                   </div>
                   <div class="form-body" id="pagination_data">
				   
                   </div>
<script>  
 $(document).ready(function(){  
      load_data();  
      function load_data(page)  
      {  
           $.ajax({  
                url:"pagination.php",  
                method:"POST",  
                data:{page:page},  
                success:function(data){  
                     $('#pagination_data').html(data);  
                }  
           })  
      }  
      $(document).on('click', '.pagination_link', function(){  
           var page = $(this).attr("id");  
           load_data(page);  
      });  
 });  
 </script>  
		         </div>
	            </div>
				<!--end emploi-->
				<!--start stage-->
				<div class="row" id="stage">
                  <div class="col-md-12">
		           <div class="form-header">
                     <h1 class="form-title"><span class="glyphicon glyphicon-list"></span>&nbsp; Mes offres de stage :</h1>
                    
                   </div>
                   <div class="form-body" id="pagination_data1">
		               <p>fhfhfhfh4 fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh
			   fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh
			   fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh
			   fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh
			   fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh
			   fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh fhfhfhfh</p>
                   </div>
<script>  
 $(document).ready(function(){  
      load_data();  
      function load_data(page)  
      {  
           $.ajax({  
                url:"pagination1.php",  
                method:"POST",  
                data:{page:page},  
                success:function(data){  
                     $('#pagination_data1').html(data);  
                }  
           })  
      }  
      $(document).on('click', '.pagination_link1', function(){  
           var page = $(this).attr("id");  
           load_data(page);  
      });  
 });  
 </script>  
		         </div>
	            </div>
				<!--end stage-->
				
				<!--start update-->
				<div class="row" id="update">
                  <div class="col-md-12">
		           <div class="form-header">
                     <h1 class="form-title"><span class="glyphicon glyphicon-edit"></span>&nbsp; Modifiez votre compte rekruteur :</h1>
                    
                   </div>
                   <div class="form-body">
		              <div class="descript">
					  <form role="form" method="post" id="UpdateForm" autocomplete="on">
						  <fieldset>
						  <br>
						  <label for="Entreprises">Entreprise:</label>
                          <input type="text" placeholder="Nom Entreprise" id="titre" name="entreprise" value="<?php echo $userRow['society']; ?>">
						  <span class="error_msg"></span>
						  <label for="Fonction du recruteur">Fonction du recruteur:</label>
                          <input type="text" placeholder="Fonction du recruteur" id="titre" name="fonctionU" value="<?php echo $userRow['fonction']; ?>">
						  <span class="error_msg"></span>
                          <label for="Secteur d'activité">Secteur d&apos;activit&eacute;:</label>
                          <select  name="secteurU">
                             <option value="<?php echo $userSecteur['Id_secteur']; ?>" selected="selected"><?php echo $userSecteur['secteur']; ?></option>
                             <?php
                               $stmt = $auth_user->runQuery("SELECT * FROM secteur order by secteur");
                               $stmt->execute();
        
                               while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                               {
                                extract($row);
                             ?>
                             <option value="<?php echo $Id_secteur; ?>"><?php echo $secteur; ?></option>
                             <?php
                               }
                             ?>
                          </select>
						  <span class="error_msg"></span>
						  <label for="Ville">Ville:</label>
                          <select name="villeU">
                            <option value="<?php echo $userVille['id']; ?>" selected="selected"><?php echo $userVille['ville']; ?></option>
                             <?php
                               $stmt = $auth_user->runQuery("SELECT * FROM ville");
                               $stmt->execute();
        
                               while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                               {
                                extract($row);
                             ?>
                             <option value="<?php echo $id; ?>"><?php echo $ville; ?></option>
                             <?php
                               }
                             ?>
                          </select>
						  <span class="error_msg"></span>
						 <label for="tel">T&eacute;l&eacute;phone:</label>
                          <input type="text" placeholder="XXXXXXXXXX" id="titre" name="tel" value="<?php echo $userRow['tel']; ?>">
						  <span class="error_msg"></span>
						  <label for="siteweb">Site web:</label>
                          <input type="text" placeholder="http://www.siteweb.com" id="titre" name="siteweb" value="<?php echo $userRow['siteweb']; ?>">
						  <span class="error_msg"></span>
						  <label for="Description">Description:</label>
						  <textarea placeholder="Description de l'entreprise" id="c" class="description" name="descriptionU" >
						  <?php echo $userRow['description']; ?>
						  </textarea>
						  <span class="error_msg"></span>          
						  </fieldset>
						<fieldset class="text-center">
						<button type="submit" name="btn-enregistre" class="enregistre btn btn-primary">Enregistr&eacute;</button>
						<button type="submit" name="btn-annuler" class="enregistre btn btn-danger">Annuler</button>
						</fieldset>
					   </form> 
					   </div>
                   </div>
		         </div>
	            </div>
				<!--end update-->
				</div>
            </div>
		</div>
	</div>
</div>
  
</div>
</div>
</body>
</html>