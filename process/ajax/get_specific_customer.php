<?php
	require '../../class/database.php';
	$db = new Database();


	$table = "customer";
	$fields = array("*");
	$where = "id = ?";
	$params = array($_POST['customer']);

	$customer = $db->select($table, $fields, $where, $params);
	echo json_encode( $customer );
	
?>