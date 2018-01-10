<?php

require_once 'dbconfig.php';

class user
{
	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
	}
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	public function lastId()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	public function register($gender,$firstname,$lastname,$email,$ucpass,$tel,$reg_date,$token)
	{
		try
		{
		$new_password = password_hash($ucpass, PASSWORD_DEFAULT);
		$stmt = $this->conn->prepare("insert into candidat (gender,firstname,lastname,userEmail,userPass,tel,reg_date,token)values(:gender,:fname,:lname,:email,:ucpass,:tel,:Jdate,:token)");
		$stmt->bindparam(":gender",$gender);
		$stmt->bindparam(":fname",$firstname);
		$stmt->bindparam(":lname",$lastname);
		$stmt->bindparam(":email",$email);
		$stmt->bindparam(":ucpass",$new_password);
		$stmt->bindparam(":tel",$tel);
		$stmt->bindparam(":Jdate",$reg_date);
		$stmt->bindparam(":token",$token);
		$stmt->execute();
		return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function register1($gender,$firstname,$lastname,$society,$fonction,$email,$ucpass,$tel,$reg_date,$token)
	{
		try
		{
		$new_password = password_hash($ucpass, PASSWORD_DEFAULT);
		$stmt = $this->conn->prepare("insert into rekruteur (gender,firstname,lastname,society,fonction,userEmail,userPass,tel,reg_date,token)values(:gender,:fname,:lname,:society,:fonction,:email,:ucpass,:tel,:Jdate,:token)");
		$stmt->bindparam(":gender",$gender);
		$stmt->bindparam(":fname",$firstname);
		$stmt->bindparam(":lname",$lastname);
		$stmt->bindparam(":society",$society);
		$stmt->bindparam(":fonction",$fonction);
		$stmt->bindparam(":email",$email);
		$stmt->bindparam(":ucpass",$new_password);
		$stmt->bindparam(":tel",$tel);
		$stmt->bindparam(":Jdate",$reg_date);
		$stmt->bindparam(":token",$token);
		$stmt->execute();
		return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function login($uemail,$upass)
	{
		try{
			$stmt = $this->conn->prepare("SELECT * FROM candidat WHERE userEmail=:email");
			$stmt->execute(array(':email'=>$uemail));
			$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($upass, $userRow['userPass']))
				{
					$_SESSION['user_session'] = $userRow['Id_candidat'];
					$_SESSION['type'] = "Candidat";
					return true;
				}
				else{ return false;}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
	}
	public function login1($uemail,$upass)
	{
		try{
			$stmt = $this->conn->prepare("SELECT * FROM rekruteur WHERE userEmail=:email");
			$stmt->execute(array(':email'=>$uemail));
			$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($upass, $userRow['userPass']))
				{
					$_SESSION['user_session'] = $userRow['Id_rekruteur'];
					$_SESSION['type'] = "Rekruteur";
					return true;
				}
				else{ return false;}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
	}
	/*******************************Secteur List********************************/
	public function secteur()
    {
       $stmt = $this->db->prepare("SELECT * FROM secteur order by secteur");
       $stmt->execute();
       return $stmt;
    }
	
	/*******************************Fonction List********************************/
	public function fonction()
    {
       $stmt = $this->db->prepare("SELECT * FROM fonction order by fonction");
       $stmt->execute();
       return $stmt;
    }
	/*******************************region List********************************/
	public function region()
    {
       $stmt = $this->db->prepare("SELECT * FROM region");
       $stmt->execute();
       $row=$stmt->fetch(PDO::FETCH_ASSOC);
       return $row;
    }
	/*******************************ville List********************************/
	public function ville()
    {
       $stmt = $this->db->prepare("SELECT * FROM ville");
       $stmt->execute();
       $row=$stmt->fetch(PDO::FETCH_ASSOC);
       return $row;
    }
	/*******************************niveau_etude List********************************/
	public function niveau_etude()
    {
       $stmt = $this->db->prepare("SELECT * FROM niveau_etude");
       $stmt->execute();
       $row=$stmt->fetch(PDO::FETCH_ASSOC);
       return $row;
    }
	/*******************************niveau_experience List********************************/
	public function niveau_experience()
    {
       $stmt = $this->db->prepare("SELECT * FROM niveau_experience");
       $stmt->execute();
       $row=$stmt->fetch(PDO::FETCH_ASSOC);
       return $row;
    }
	/*******************************Offre d emploi********************************/
	
	public function getID($id)
    {
       $stmt = $this->db->prepare("SELECT * FROM offresemploi WHERE IdEmploi=:id");
       $stmt->execute(array(":id"=>$id));
       $showRow=$stmt->fetch(PDO::FETCH_ASSOC);
       return $showRow;
    }
	
	public function saveOffreEmploi($IdRekruteur,$secteur,$fonctionn,$region,$ville,$etude,$experience,$contrat,$salaire,$poste,$expDate,$titre,$descPoste,$descProfil)
	{
		try{
			
		$stmt = $this->conn->prepare("insert into offresemploi (IdRekruteur,IdSecteur,IdFonction,IdRegion,IdVille,IdNetude,IdNExp,IdTypeCtt,IdSalaire,nbrPoste,dateExpiration,Titre,descriptPoste,profilRecherch)values
		(:IdRekruteur,:IdSecteur,:IdFonction,:IdRegion,:IdVille,:IdNetude,:IdNExp,:IdTypeCtt,:IdSalaire,:nbrPoste,:dateExpiration,:Titre,:descriptPoste,:profilRecherch)");
		$stmt->bindparam(":IdRekruteur",$IdRekruteur);
		$stmt->bindparam(":IdSecteur",$secteur);
		$stmt->bindparam(":IdFonction",$fonctionn);
		$stmt->bindparam(":IdRegion",$region);
		$stmt->bindparam(":IdVille",$ville);
		$stmt->bindparam(":IdNetude",$etude);
		$stmt->bindparam(":IdNExp",$experience);
		$stmt->bindparam(":IdTypeCtt",$contrat);
		$stmt->bindparam(":IdSalaire",$salaire);
		$stmt->bindparam(":nbrPoste",$poste);
		$stmt->bindparam(":dateExpiration",$expDate);
		$stmt->bindparam(":Titre",$titre);
		$stmt->bindparam(":descriptPoste",$descPoste);
		$stmt->bindparam(":profilRecherch",$descProfil);
		$stmt->execute();
		return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function UpdateOffreEmploi($id_offrEmp,$IdRekruteur,$secteur,$fonctionn,$region,$ville,$etude,$experience,$contrat,$salaire,$poste,$expDate,$titre,$descPoste,$descProfil)
	{
		try{
			
		$stmt = $this->conn->prepare("update offresemploi set IdRekruteur=:IdRekruteur,IdSecteur=:IdSecteur,IdFonction=:IdFonction,IdRegion=:IdRegion,IdVille=:IdVille,IdNetude=:IdNetude,IdNExp=:IdNExp,IdTypeCtt=:IdTypeCtt,IdSalaire=:IdSalaire,nbrPoste=:nbrPoste,dateExpiration=:dateExpiration,Titre=:Titre,descriptPoste=:descriptPoste,profilRecherch=:profilRecherch where IdEmploi=:id_offrEmp");
		$stmt->bindparam(":id_offrEmp",$id_offrEmp);
		$stmt->bindparam(":IdRekruteur",$IdRekruteur);
		$stmt->bindparam(":IdSecteur",$secteur);
		$stmt->bindparam(":IdFonction",$fonctionn);
		$stmt->bindparam(":IdRegion",$region);
		$stmt->bindparam(":IdVille",$ville);
		$stmt->bindparam(":IdNetude",$etude);
		$stmt->bindparam(":IdNExp",$experience);
		$stmt->bindparam(":IdTypeCtt",$contrat);
		$stmt->bindparam(":IdSalaire",$salaire);
		$stmt->bindparam(":nbrPoste",$poste);
		$stmt->bindparam(":dateExpiration",$expDate);
		$stmt->bindparam(":Titre",$titre);
		$stmt->bindparam(":descriptPoste",$descPoste);
		$stmt->bindparam(":profilRecherch",$descProfil);
		$stmt->execute();
		return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function deleteOffreEmploi($id_offrEmp)
	{
		try{
			
		$stmt = $this->conn->prepare("delete from offresemploi where IdEmploi=:id_offrEmp");
		$stmt->bindparam(":id_offrEmp",$id_offrEmp);
		$stmt->execute();
		return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function UpdateInfo($IdRekruteur,$entreprise,$fonctionR,$secteurU,$villeU,$telU,$siteweb,$descriptionU)
	{
		try{
			
		$stmt = $this->conn->prepare("update rekruteur set society=:entreprise,fonction=:fonctionR,secteurs=:secteurU,ville=:villeU,tel=:telU,siteweb=:siteweb,description=:descriptionU where Id_rekruteur=:IdRekruteur");
		$stmt->bindparam(":IdRekruteur",$IdRekruteur);
		$stmt->bindparam(":entreprise",$entreprise);
		$stmt->bindparam(":fonctionR",$fonctionR);
		$stmt->bindparam(":secteurU",$secteurU);
		$stmt->bindparam(":villeU",$villeU);
		$stmt->bindparam(":telU",$telU);
		$stmt->bindparam(":siteweb",$siteweb);
		$stmt->bindparam(":descriptionU",$descriptionU);
		$stmt->execute();
		return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function isloggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	public function logout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}	
	
	function send_mail($email,$message,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "ssl";                 
		$mail->Host       = "smtp.gmail.com";      
		$mail->Port       = 465;             
		$mail->AddAddress($email);
		$mail->Username="youssefrguigat@gmail.com";  
		$mail->Password="";            
		$mail->SetFrom('youssefrguigat@gmail.com','Maroc-Rekrute.com');
		$mail->AddReplyTo("youssefrguigat@gmail.com","Maroc-Rekrute.com");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}	
}
?>