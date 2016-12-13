<?php
	require '../class/database.php';
	require '../class/shipping_method.php';
	
	$db = new Database();
	$method = new Shipping_Method();


	extract($_POST);
	$method->setDescription(htmlentities($description));
	$method->setPrice(doubleval($price));

	if(isset($_POST['save_method']))
	{
		$method->setStatus(1);
		
		$data = [
					'description' 	   => $method->getDescription(),
					'price' 		   => $method->getPrice(),
					'status' 		   => $method->getStatus() ,
				];


		$db->insert("shipping_method", $data);
		header("location: ../shipping/manage.php?msg=inserted");
	}
	if(isset($_POST['update_method']))
	{
		$method->setId(intval($method_id_fm));

		$fields = array('description', 'price');
			$where  = "WHERE id = ?";
			$params = array(
					$method->getDescription(),
					$method->getPrice(),
					$method->getId()
					);

		$db->update("shipping_method", $fields , $where, $params);

	
		header("location: ../shipping/manage.php?id=".$method->getId()."&msg=updated");
	}
	if(isset($_GET['del']))
	{
		$method_id = (isset($_GET["id"]) ? $_GET["id"] : "");
		// $page_request = (isset($_GET["p"]) ? $_GET["p"] : "");

		$method->setId($method_id);
		$method->setStatus(0);
		$fields = array('status');
			$where  = "WHERE id = ?";
			$params = array(
					$method->getStatus(),
					$method->getId()	
					);

		$product_update = $db->update("shipping_method", $fields , $where, $params);
		header("location: ../shipping/methods.php?msg=deleted");
	}
?>