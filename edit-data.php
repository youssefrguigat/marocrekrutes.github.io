
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
	  if(isset($_GET['edit_id']))
      {
        $id_offrEmp = $_GET['edit_id'];
		$stmt = $auth_user->runQuery("SELECT * FROM offresemploi WHERE IdRekruteur=:IdRekruteur and IdEmploi=:id_offrEmp");
	    $stmt->execute(array(":id_offrEmp"=>$id_offrEmp, ":IdRekruteur"=>$IdRekruteur));
	    if($stmt->rowCount()>0)
         {
	        $offreRow=$stmt->fetch(PDO::FETCH_ASSOC);
            //extract($crud->getID($id));
		 }
         else{$auth_user->redirect('compte_rekruteur.php');}		 
      }
	  
	  if(isset($_POST['btn-updateoffre']))
      {
		if(isset($_GET['edit_id']))
        {
		 $IdRekruteur = $_SESSION['user_session'];
         $id_offrEmp = $_GET['edit_id'];
		 $titre = $_POST['titre'];
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
		 $descPoste = $_POST['descPoste'];
		 $descProfil = $_POST['descprofil'];
		 
		 if($auth_user->UpdateOffreEmploi($id_offrEmp,$IdRekruteur,$secteur,$fonctionn,$region,$ville,$etude,$experience,$contrat,$salaire,$poste,$expDate,$titre,$descPoste,$descProfil))
		 {
			 $stmt = $auth_user->runQuery("SELECT * FROM offresemploi WHERE IdEmploi=:id_offrEmp");
	         $stmt->execute(array(":id_offrEmp"=>$id_offrEmp));
	
	         $offreRow=$stmt->fetch(PDO::FETCH_ASSOC);
			$msg_UpdateOffre = "
		      <div class='alert alert-success text-center'>
					<span class='glyphicon glyphicon-ok' style='font-size:18px;'></span>
					<strong>Votre offre d&apos;emploi a &eacute;t&eacute; modifi&eacute; avec succ&egrave;s et sera en ligne dans quelques munites.</strong>
			  </div>
			  ";
			  
		 }
	    }
	  }
	}
	else{$auth_user->redirect('compte.php');}
?>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="http://tinymce.cachefly.net/4.2/tinymce.min.js"></script>
   <script type="text/javascript" src="assets/charcl.js"></script>
   <script type="text/javascript" src="assets/charcl1.js"></script>
	<link rel="stylesheet" href="assets/signup-form.css" type="text/css" />
	<link rel="stylesheet" href="assets/creat.css" type="text/css" />
<style>
.signup-form-container1 {
	
	border-radius:4px;
	background:transparent;
	border-top:3px solid #d2d6de;
	margin:8% auto;
	max-width:70%;
	border-top-color:#00c0ef;
	box-shadow:0 8px 10px rgba(0, 0, 0, 0.5);
}
</style>
<?php include_once'header.php';?>
<div class="clearfix"></div><br />
<div class="container">
<div class="signup-form-container1">
  <form method='post'>
         <div class="form-header">
            <h1 class="form-title"><i class="fa fa-user" aria-hidden="true"></i> <span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifier cette offre</h1>
            <div class="pull-right">
              <h3 class="form-title">
			  <a href="compte_rekruteur.php" class="btn btn-large btn-success btn-updateoffre pull-right">
			  <i class="glyphicon glyphicon-backward"></i> &nbsp; Retour &nbsp;&nbsp;&nbsp;&nbsp;</a>
			  </h3>
            </div>

         </div>
	<div class="form-body">
	    <?php if(isset($msg_UpdateOffre)){echo $msg_UpdateOffre;} ?>
	    <div class="descript1">
		
		    <label for="Titre">Titre:</label>
            <input type="text" placeholder="Titre de l'offre" id="titre" name="titre" value="<?php echo $offreRow['Titre']; ?>">
             <label for="Secteur d'activité">Secteur d&apos;activit&eacute;:</label>
			  <?php
			  $secteur_id = $offreRow['IdSecteur'];
	
	                                 $stmt = $auth_user->runQuery("SELECT * FROM secteur WHERE Id_secteur=:secteur_id");
	                                 $stmt->execute(array(":secteur_id"=>$secteur_id));
	
	                                 $offresecteur=$stmt->fetch(PDO::FETCH_ASSOC);
			  ?>
               <select  name="secteur">
                             <option value="<?php echo $offresecteur['Id_secteur']; ?>" selected="selected"><?php echo $offresecteur['secteur']; ?></option>
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
		   <?php
			  $fonction_id = $offreRow['IdFonction'];
	
	                                 $stmt = $auth_user->runQuery("SELECT * FROM fonction WHERE id_fonction=:fonction_id");
	                                 $stmt->execute(array(":fonction_id"=>$fonction_id));
	
	                                 $offrefonction=$stmt->fetch(PDO::FETCH_ASSOC);
			  ?>
            <select  name="fonction1">
                             <option value="<?php echo $offrefonction['id_fonction']; ?>" selected="selected"><?php echo $offrefonction['fonction']; ?></option> 
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
			<?php
			  $region_id = $offreRow['IdRegion'];
	
	                                 $stmt = $auth_user->runQuery("SELECT * FROM region WHERE Id_region=:region_id");
	                                 $stmt->execute(array(":region_id"=>$region_id));
	
	                                 $offreregion=$stmt->fetch(PDO::FETCH_ASSOC);
			  ?>
               <select name="region">
                           <option value="<?php echo $offreregion['Id_region']; ?>" selected="selected"><?php echo $offreregion['region']; ?></option>
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
			<?php
			  $ville_id = $offreRow['IdVille'];
	
	                                 $stmt = $auth_user->runQuery("SELECT * FROM ville WHERE id=:ville_id");
	                                 $stmt->execute(array(":ville_id"=>$ville_id));
	
	                                 $offreville=$stmt->fetch(PDO::FETCH_ASSOC);
			  ?>
               <select name="ville">
                            <option value="<?php echo $offreville['id']; ?>" selected="selected"><?php echo $offreville['ville']; ?></option>
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
			   <?php
			  $Netude_id = $offreRow['IdNetude'];
	
	                                 $stmt = $auth_user->runQuery("SELECT * FROM niveau_etude WHERE Id_Netude=:Netude_id");
	                                 $stmt->execute(array(":Netude_id"=>$Netude_id));
	
	                                 $offreNetude=$stmt->fetch(PDO::FETCH_ASSOC);
			  ?>
               <select name="etude">
                              <option value="<?php echo $offreNetude['Id_Netude']; ?>" selected="selected"><?php echo $offreNetude['niveauEtude']; ?></option>
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
                           <?php
			  $NExp_id = $offreRow['IdNExp'];
	
	                                 $stmt = $auth_user->runQuery("SELECT * FROM niveau_experience WHERE Id_niveau=:NExp_id");
	                                 $stmt->execute(array(":NExp_id"=>$NExp_id));
	
	                                 $offreNExp=$stmt->fetch(PDO::FETCH_ASSOC);
			  ?>
						  <select name="experience">
                             <option value="<?php echo $offreNExp['Id_niveau']; ?>" selected="selected"><?php echo $offreNExp['niveau']; ?></option>
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
                          <?php
			                 $TypeCtt_id = $offreRow['IdTypeCtt'];
	
	                                 $stmt = $auth_user->runQuery("SELECT * FROM contrat WHERE Id_contrat=:TypeCtt_id");
	                                 $stmt->execute(array(":TypeCtt_id"=>$TypeCtt_id));
	
	                                 $offrecontrat=$stmt->fetch(PDO::FETCH_ASSOC);
			  ?>
						 <select name="contrat">
                            <option value="<?php echo $offrecontrat['Id_contrat'];?>" selected="selected"><?php echo $offrecontrat['contrat'];?></option>
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
						  <?php
			                 $salaire_id = $offreRow['IdSalaire'];
	
	                                 $stmt = $auth_user->runQuery("SELECT * FROM salaire WHERE Id_salaire=:salaire_id");
	                                 $stmt->execute(array(":salaire_id"=>$salaire_id));
	
	                                 $offresalaire=$stmt->fetch(PDO::FETCH_ASSOC);
			             ?>
                          <select name="salaire">
                            <option value="<?php echo $offresalaire['Id_salaire'];?>" selected="selected"><?php echo $offresalaire['salaire'];?></option>
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
                          <input type="text" placeholder="Nombre de postes" id="nbrPoste" name="poste" value="<?php echo $offreRow['nbrPoste']; ?>">
						  </div>
						  <div class="col-md-7">
						  
						  <label for="Titre">Date d&apos;expiration de l&apos;offre:</label>
						  <?php 
						    $date = $offreRow['dateExpiration'];
                            $newDate = new DateTime($date); // remove those quotations
                            // should not be YY-mm-dd but Y-m-d
						  ?>
						  <input type="date" id="calendrier" max="2020-01-01" min="2018-01-01" name="exDate" value="<?php echo $newDate->format('Y-m-d'); ?>">
						   </div>
						 </div>
						  
						  <fieldset>
						  <label for="Description">Description du poste:</label>
						  <textarea placeholder="Description du poste" id="a" class="description" name="descPoste"><?php echo $offreRow['descriptPoste']; ?></textarea>
						  </fieldset>
						  <fieldset>
						  <label for="Description">Profil recherch&eacute;:</label>
						  <textarea placeholder="Profil recherché" id="b" class="description" name="descprofil"><?php echo $offreRow['profilRecherch']; ?></textarea>
                        </fieldset>
				   <div class="row text-center">
	     <div class="col-md-6">
		    <button type="submit" class="btn btn-primary btn-updateoffre" name="btn-updateoffre">
            <span class="glyphicon glyphicon-edit"></span> &nbsp; Enregistrer</button> 
         </div>	
         <div class="col-md-6">		 
            <a href="compte_rekruteur.php" class="btn btn-large btn-success btn-updateoffre"><i class="glyphicon glyphicon-backward"></i> &nbsp; Retour</a>
	     </div>
	   </div>
       </div>						  
	</div>
</form>    
     
</div>
</div>
