<?php
	require '../../class/database.php';
	$db = new Database();
	
	$fields = array('total');
	$where  = "WHERE id = ?";
	$params = array($_POST['total'], $_POST['order_id']);
	$order_update = $db->update("orders", $fields , $where, $params);
	$delete_item = $db->delete("order_detail", "order_id = ? AND product_id = ?" , array($_POST['order_id'] , $_POST['product_id'] )  );
	if($delete_item)
		echo "true";
?>