<?php
	require '../../class/database.php';
	$db = new Database();


	$table = "products";
	$fields = array("product_price");
	$where = "id = ?";
	$params = array($_POST['item']);

	$item = $db->select($table, $fields, $where, $params);
	echo json_encode( $item );
	
?>