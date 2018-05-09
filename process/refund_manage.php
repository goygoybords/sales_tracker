<?php
	require '../class/database.php';
	require '../class/refund.php';
	
	$db = new Database();
	$refund = new Refund();
	session_start();
	
	$table = "customer_refund";
	extract($_POST);
	
	if(isset($_POST['save_entry']))
	{

		$refund->setOrderId(htmlentities($order_id));
		$refund->setDate(htmlentities(date('Y-m-d',strtotime($date))));
		$refund->setAmount(htmlentities($amount));
		$refund->setStatus(1);

		$data = [
					'date'      => $refund->getDate(), 
					'order_id'  => $refund->getOrderId() ,
					'amount'    => $refund->getAmount()    ,
					'status'    => $refund->getStatus() ,
				];


		echo $result = $db->insert($table, $data);
		$data = [
					'description' => "Refunded an Order",
					'date_log'    => date("Y-m-d h:i:sa"),
					'user_id'     => intval($_SESSION['id']) ,
					'order_id'    => $refund->getOrderId(),
				];
						
		$logs = $db->insert("logs", $data);

		$table  = "orders";
		$fields = array('refunded');
		$where  = "WHERE id = ?";
		$params = array(1 , $refund->getOrderId() );
		$result = $db->update($table, $fields, $where, $params);

		header("location: ../customer/customer_refund.php?msg=inserted");
	}

	if(isset($_POST['update_refund']))
	{	
		$id = intval($id);
		$refund->setOrderId(htmlentities($order_id));
		$refund->setDate(htmlentities(date('Y-m-d',strtotime($date))));
		$refund->setAmount(htmlentities($amount));

		if($_POST['order_id'] == null)
		{
			$table  = "customer_refund";
			$fields = array('date' , 'amount');
			$where  = "WHERE id = ?";
			$params = array($refund->getDate(),  $refund->getAmount(), $id );
			
			$result = $db->update($table, $fields, $where, $params);
		}
		else
		{
			$table  = "customer_refund";
			$fields = array('date' ,'order_id' ,'amount');
			$where  = "WHERE id = ?";
			$params = array($refund->getDate(), 
					$refund->getOrderId(), $refund->getAmount(), $id 
					);
			
			$result = $db->update($table, $fields, $where, $params);

			//update old invoice to 0
			$table  = "orders";
			$fields = array('refunded');
			$where  = "WHERE id = ?";
			$params = array(0 , $previous_invoice );
			$result = $db->update($table, $fields, $where, $params);

			//update new invoice to 1
			$table  = "orders";
			$fields = array('refunded');
			$where  = "WHERE id = ?";
			$params = array(1 , $refund->getOrderId() );
			$result = $db->update($table, $fields, $where, $params);
		}
		$data = [
					'description' => "Updated a refund record",
					'date_log'    => date("Y-m-d h:i:sa"),
					'user_id'     => intval($_SESSION['id']) ,
					'order_id'    => $refund->getOrderId(),
				];
		header("location: ../customer/customer_refund_manage.php?id=".$id."&msg=updated");
	}
	if(isset($_GET['refund']))
	{
		$table = "orders";
		$fields = array('total');
		$where = "id = ?";
		$params = array(intval($_GET['id']));
		$amount_db = $db->select($table, $fields, $where, $params);
		

		$refund->setOrderId(intval($_GET['id']));
		$refund->setDate(date('Y-m-d'));
		$refund->setAmount(intval($amount_db[0][0]));
		$refund->setStatus(1);

		$data = [
					'date'      => $refund->getDate(), 
					'order_id'  => $refund->getOrderId() ,
					'amount'    => $refund->getAmount()    ,
					'status'    => $refund->getStatus() ,
				];

		$result = $db->insert("customer_refund", $data);
		$data = [
					'description' => "Refunded an Order",
					'date_log'    => date("Y-m-d h:i:sa"),
					'user_id'     => intval($_SESSION['id']) ,
					'order_id'    => $refund->getOrderId(),
				];
						
		$logs = $db->insert("logs", $data);

		$table  = "orders";
		$fields = array('refunded');
		$where  = "WHERE id = ?";
		$params = array(1 , $refund->getOrderId() );
		$result = $db->update($table, $fields, $where, $params);

		header("location: ../orders/shipped_orders.php?msg=refund");
	}
	
?>