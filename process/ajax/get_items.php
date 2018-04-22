<?php
	require '../../class/database.php';
	$db = new Database();
	$table = "products";
	$fields = array("*");
	$where = "status = ?";
	$params = array(1);

	$products = $db->select($table, $fields, $where, $params, 'order by 2');
	echo json_encode( $products );
	
?>