<?php  
 		$host = 'localhost';
    	$dbname = 'businessvinadb01';
    	$user = 'root';
    	$pass = '';
    	$db = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
	
      $sql = "SELECT l.companyname, l.firstname, p.position, s.description, l.address, 
			c.event_name, c.start_date, c.end_date
			FROM leads l 
                JOIN positions p
                ON l.position = p.id 
                JOIN siccode s
                ON   l.siccode =  s.id
                JOIN calendar_events c
                ON l.id = c.leadid
       			WHERE c.status = ?";
      $cmd = $db->prepare($sql);
      $cmd->execute(array(0));
      $result = $cmd->fetchAll();  
      $output = '';
       $output .= '  
            <table class="table" bordered="1">  
                 <tr>  
                  
                      <th>Company Name</th>  
                      <th>First Name</th>  
                      <th>Position</th>
                      <th>SI Code</th>
                      <th>Address</th>
                      <th>Event Name</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                 </tr>  
       ';  
       foreach ($result as $r ) 
       {
       		$output .= '  
                 <tr>  
                      <td>'.$r["companyname"].'</td>  
                      <td>'.$r["firstname"].'</td>  
                      <td>'.$r["position"].'</td>  
                      <td>'.$r["description"].'</td>  
                      <td>'.$r["address"].'</td>  
                      <td>'.$r["event_name"].'</td>  
                      <td>'.date('m/d/Y',$r["start_date"]).'</td>  
                      <td>'.date('m/d/Y',$r["end_date"]).'</td>  
                 </tr>  
            ';  
       }
       $output .= '</table>';  
     
       $filename = "Event_Report_".date('Y-m-d').".xls";
       header("Content-Type: application/xls");   
       header("Content-Disposition: attachment; filename=".$filename);  
       echo $output;  
      
	 
 ?>  