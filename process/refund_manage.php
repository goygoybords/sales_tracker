<?php
	require '../class/database.php';
	require '../class/refund.php';
	
	$db = new Database();
	$refund = new Refund();

	
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
		header("location: ../customer/customer_refund.php?msg=inserted");
	}

	if(isset($_POST['update_refund']))
	{
		// refund setters and getters
		// $refund->setId(htmlentities($id));
		// $refund->setFirstname(htmlentities($firstname));
		// $refund->setLastname(htmlentities($lastname));
		// $refund->setEmail(htmlentities($email));
		// $refund->setScreenName($screen_name);
		// $refund->setPassword($encrpytion->encryptIt($password));
		// $refund->setTeamId($team);
		// $refund->setrefundtypeid($refund_type);

		// $table  = "refunds";
		// $fields = array('first_name' ,'lastname' ,'email' , 'password' , 'refundtypeid' , 'screen_name' , 'team_id');
		// $where  = "WHERE id = ?";
		// $params = array($refund->getFirstname(), $refund->getLastname(), $refund->getEmail(),
		// 		$refund->getPassword(), $refund->getrefundtypeid(),  $refund->getScreenName() , $refund->getTeamId() ,$refund->getId() );
		
		// $result = $db->update($table, $fields, $where, $params);

		// header("location: ../refund/manage.php?id=".$refund->getId()."&msg=inserted");
	}
	if(isset($_GET['del']))
	{
		// $refund->setId($_GET['id']);
		// $refund->setStatus(0);
		// $table  = "refunds";
		// $fields = array('status');
		// $where  = "WHERE id = ?"; 
		// $params = array($refund->getStatus(), $refund->getId() );
		// $result = $db->update($table, $fields, $where, $params);
		// header("location: ../refund/refund.php?&msg=deleted");

	}
	
?>