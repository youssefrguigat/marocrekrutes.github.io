<?php  
 //pagination.php  
 require_once("session.php");	
require_once 'class.user.php'; 
header('Content-Type: text/html; charset=ISO-8859-1'); 
 $pagin=new user();
 $record_per_page = 3;  
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
 $query = "SELECT * FROM offresemploi ORDER BY datePublication DESC LIMIT $start_from, $record_per_page";
  $stmt = $pagin->runQuery($query);
         $stmt->execute();
        $output .= "  
                  <table class='table table-striped table-hover table-bordered'>
                       <thead>
                         <tr>
                          <th scope='col'>Titre </th>
                          <th scope='col'>Date de publication</th>
                          <th scope='col'>Date d'expiration</th>
                         </tr>
                      </thead>
                     <tbody> 
                   ";  
         if($stmt->rowCount()>0)
         {
                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $output .= '  
                    <tr>
				   <td>'.$row["Titre"].'</td>
                   <td><i class="glyphicon glyphicon-calendar"></i>'.date("j F Y", strtotime($row["datePublication"])).'</td>
                   <td><i class="glyphicon glyphicon-calendar"></i>'.date("j F Y", strtotime($row["dateExpiration"])).'</td>
                   </tr> 
                    '; 
                }  
		 }
		 else{
			 $output .= '
			   <tr>
               <td>Offre existe...</td>
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
      $output .= "<span class='pagination_link1' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
 }  
 $output .= '</div><br /><br />';  
 echo $output;  
 ?>  
 