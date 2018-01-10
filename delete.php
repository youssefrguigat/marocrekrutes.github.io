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
if(isset($_POST['btn-del']))
{
    $id = $_GET['delete_id'];
    if($auth_user->deleteOffreEmploi($id))
    {
      $_SESSION['deleted'] = "deleted";
      header("Location: compte_rekruteur.php"); 
    }
	else{
		 $msg = "
	        <div class='alert alert-danger' role='alert' style='margin:20px auto;padding:5px auto;'>
            <div class='row vertical-info'>
                <div class='col-xs-12 col-sm-12 text-center'>
                    <p>
                         <i class='fa fa-exclamation-triangle fa-2x'></i>&nbsp;&nbsp;&nbsp;Suppression de l'offre n'a pas effectu&eacute; !!! veuillez essayer de nouveau </p>                    
                </div>
            </div>
        </div>";
	}
}

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/signup-form.css" type="text/css" />

	<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<style>
.container1 {
	
	border-radius:4px;
	background:transparent;
	border-top:3px solid #d2d6de;
	margin:8% auto;
	max-width:70%;
	border-top-color:#00c0ef;
	box-shadow:0 8px 10px rgba(0, 0, 0, 0.5);
}
</style>
<div class="container1">
  
  <?php
  
      if(isset($_GET['delete_id']))
      {
		$id_offrEmp = $_GET['delete_id'];
		$stmt1 = $auth_user->runQuery("SELECT * FROM offresemploi WHERE IdRekruteur=:IdRekruteur and IdEmploi=:id_offrEmp");
	    $stmt1->execute(array(":id_offrEmp"=>$id_offrEmp, ":IdRekruteur"=>$IdRekruteur));
	    if($stmt1->rowCount()>0)
         {
            //extract($crud->getID($id));
			 ?>
			 <form method="post">
			  <div class="form-header">
            <h1 class="form-title"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Supprimer cette offre</h1>
            <div class="pull-right">
              <h3 class="form-title">
			  <a href="compte_rekruteur.php" class="btn btn-large btn-success btn-updateoffre pull-right">
			  <i class="glyphicon glyphicon-backward"></i> &nbsp; Retour &nbsp;&nbsp;&nbsp;&nbsp;</a>
			  </h3>
            </div>

         </div>
			 <div class="form-body">
			    <?php if(isset($msg)){echo $msg;} ?>
             <table class='table table-bordered table-hover table-striped' style="margin-top:30px;">
                       <thead>
                         <tr align='center'>
						 <th align='center'>#</th>
                          <th>Titre </th>
                          <th><i class='glyphicon glyphicon-calendar'></i>Date de publication</th>
                          <th><i class='glyphicon glyphicon-calendar'></i>Date d'expiration</th>
                         </tr>
                      </thead>
                     <tbody> 
         <?php
            while($offreRow=$stmt1->fetch(PDO::FETCH_ASSOC))
            {
             ?>
			 <tr style="font-size:13px;font-weight:bold;">
					<td align='center'><i class="glyphicon glyphicon-arrow-right"></i></td>
				   <td><?php echo $offreRow["Titre"]; ?></td>
                   <td><?php echo date("j F Y", strtotime($offreRow["datePublication"])); ?></td>
                   <td><?php echo date("j F Y", strtotime($offreRow["dateExpiration"])); ?></td>
				   </tr> 
             <?php
            }
            ?>
            </table>
			</div>
		 <?php
		 }
        //else{$auth_user->redirect('compte_rekruteur.php');}
  }
  ?>
  <p>
<?php
if(isset($id_offrEmp))
{ 
 ?>
   <div class="form-footer">
    <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; OUI</button>
    <a href="compte_rekruteur.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NON</a>
	</div>
    </form>  
 <?php
}
else
{
 ?>
    <a href="compte_rekruteur.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
    <?php
}
?>
</p>
</div>
    <?php
	}
?>