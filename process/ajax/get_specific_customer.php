<?php
	require '../../class/database.php';
	$db = new Database();


	$table = "customer";
	$fields = array("*");
	$where = "id = ?";
	$params = array($_POST['customer']);

	$customer = $db->select($table, $fields, $where, $params);

	$sql = "SELECT r.id FROM customer_refund r
              JOIN orders o 
              ON o.id = r.order_id 
              JOIN customer c
              ON o.customer_id = c.id
              WHERE c.id = ?";
    $cmd = $db->getDb()->prepare($sql);
    $cmd->execute(array($_POST['customer']));
    $count_inv = $cmd->fetchAll();
    $count = count($count_inv);
	$data = array();
	if($count > 0)
	{	
		
		foreach ($customer as $key => $value) 
		{
			$data[$key] = $value;
		}
		array_push($data, "bool");
		echo json_encode( $data );
	}
	else
	{
		echo json_encode( $customer );
	}
	

	
	
	
	// 


	




	
?>