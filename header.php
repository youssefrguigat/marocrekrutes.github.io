 
<nav class="navbar navbar-inverse navbar-fixed-top navbar-burger" role="navigation" >
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand " href="index.php" style="color:#00c0ef; font-size:19px;" >Maroc-Rekrute.ma</a>
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
        <li><a href="#" style="color:#fff;font-size:16px;">CV en ligne</a></li>
            <li><a href="#" style="color:#fff;font-size:16px;">Qui sommes-nous ?</a></li>
            <li><a href="#" style="color:#fff;font-size:16px;">Contactez-nous</a></li>
          </ul>
		  <?php 
          if(isset($_SESSION['user_session']))
		{
			$mail=$userRow['userEmail'];
		    echo "<ul class='nav navbar-nav navbar-right'>
            <li class='dropdown'>
              <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
			  <span class='glyphicon glyphicon-cog'></span></a>
              <ul class='dropdown-menu'>
			    <li><a href='#'><strong> $mail </strong></a></li>
                <li><a href='profile.php'><span class='glyphicon glyphicon-user'></span>&nbsp;View Profile</a></li>
                <li><a href='logout.php?logout=true'><span class='glyphicon glyphicon-log-out'></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
		   </ul>";
           }
		   else{ 
             echo "
			<a href='login-rekruteur.php' class='btn btn-warning navbar-btn'><span class='glyphicon glyphicon-briefcase'></span> Espace Recruteur</a>
            &nbsp;&nbsp;<a href='login-candidat.php' class='btn btn-primary navbar-btn'><span class='glyphicon glyphicon-user'></span> Espace Candidat</a>";
		   }?>
		  </div>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	<div class="clear"></div>