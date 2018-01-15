<?php
	require '../../class/database.php';
	$db = new Database();


	$table = "shipping_method";
	$fields = array("price");
	$where = "id = ?";
	$params = array($_POST['shipping']);

	$shipping = $db->select($table, $fields, $where, $params);
	echo json_encode( $shipping );
	
?>