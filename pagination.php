<?php  
 //pagination.php  
 require_once("session.php");	
require_once 'class.user.php'; 
header('Content-Type: text/html; charset=ISO-8859-1'); 
$pagin = new user();
	
	if(isset($_SESSION['user_session'])&& $_SESSION['type']=="Rekruteur")
	{
	   $IdRekruteur = $_SESSION['user_session'];
       $record_per_page = 5;  
       $page = '';  
       $output = '';  
       if(isset($_POST["page"]))  
       {  
         $page = $_POST["page"];  
       }  
       else  
       {  
         $page = 1;  
        }  
       $start_from = ($page - 1)*$record_per_page;  
       $query = "SELECT * FROM offresemploi where IdRekruteur=:IdRekruteur ORDER BY datePublication DESC LIMIT $start_from, $record_per_page";
       $stmt = $pagin->runQuery($query);
         $stmt->execute(array(":IdRekruteur"=>$IdRekruteur));
        $output .= "  
                  <table class='table table-bordered table-hover table-striped'>
                       <thead>
                         <tr>
						 <th>#</th>
                          <th>Titre </th>
                          <th><i class='glyphicon glyphicon-calendar'></i>Date de publication</th>
                          <th><i class='glyphicon glyphicon-calendar'></i>Date d'expiration</th>
						  <th colspan='2' align='center'>Actions</th>
                         </tr>
                      </thead>
                     <tbody> 
                   ";  
         if($stmt->rowCount()>0)
         {
                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $output .= '  
					<tr style="font-size:13px;font-weight:bold;">
					<td><i class="glyphicon glyphicon-arrow-right"></i></td>
				   <td>'.$row["Titre"].'</td>
                   <td>'.date("j F Y", strtotime($row["datePublication"])).'</td>
                   <td>'.date("j F Y", strtotime($row["dateExpiration"])).'</td>
                   <td align="center">
                <a href="edit-data.php?edit_id='.$row["IdEmploi"].'"><i class="glyphicon glyphicon-edit"></i></a>
                </td>
                <td align="center">
                <a href="delete.php?delete_id='.$row['IdEmploi'].'" ><i class="glyphicon glyphicon-trash"></i></a>
              </a>
				</td>
				   </tr> 
				   '; 
                }
              	$output .= '</tbody></table><br /><div align="center">';  
                $query = "SELECT * FROM offresemploi ORDER BY datePublication DESC";  
                $stmt = $pagin->runQuery($query);
                $stmt->execute();
	            $row=$stmt->fetch(PDO::FETCH_ASSOC);
  
                $total_records = $stmt->rowCount();  
                $total_pages = ceil($total_records/$record_per_page);  
                for($i=1; $i<=$total_pages; $i++)  
                {  
                 $output .= "<span class='pagination_link' style='cursor:pointer; margin:5px 5px 0 5px; padding:6px 8px; background-color:#00c0ef; color:#fff; border:1px solid #00c0ef;' id='".$i."'>".$i."</span>";  
                }  
                $output .= '</div>';  
                echo $output; 			
         }
		 else{
			 $output .= '
			   <tr>
               <td colspan="5" class="text-center">Aucune offre existe...</td>
            </tr>
			 </tbody></table><br />';
			 echo $output;
		 }
 
	} 
 ?>  
 