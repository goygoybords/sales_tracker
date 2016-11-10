<?php
	require '../class/database.php';
	require '../class/product.php';


	$db = new Database();
	$product = new Product();

	extract($_POST);

	$product->setProductDescription(htmlentities($description));
	$product->setProductPrice(htmlentities($price));

		

	if(isset($_POST['save_product']))
	{
		$product->setStatus(1);
	
		$data = [
					'product_description' 	   => $product->getProductDescription(),
					'product_price' 		   => $product->getProductPrice(),
					'status' 				   => $product->getStatus() 

				];


		$customer_id = $db->insert("products", $data);
		header("location: ../product/manage.php?msg=inserted");
			
			
	}
	if(isset($_POST['update_product']))
	{
		$product->setProductId(intval($product_id_fm));
		
		$fields = array('product_description' ,'product_price' );
			$where  = "WHERE id = ?";
			$params = array(
					$product->getProductDescription(),
					$product->getProductPrice(),
					$product->getProductId()
					
					);

		$product_update = $db->update("products", $fields , $where, $params);

		header("location: ../product/manage.php?id=".$product->getProductId()."&msg=updated");
	}
	if(isset($_GET['del']))
	{
		$product_id = (isset($_GET["id"]) ? $_GET["id"] : "");
		$page_request = (isset($_GET["p"]) ? $_GET["p"] : "");

		$product->setProductId($product_id);
		$product->setStatus(0);
		$fields = array('status' );
			$where  = "WHERE id = ?";
			$params = array(
					$product->getStatus(),
					$product->getProductId()	
					);

		$product_update = $db->update("products", $fields , $where, $params);
		header("location: ../product/product.php?msg=deleted");
	}
?>