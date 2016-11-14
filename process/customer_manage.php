<?php
	require '../class/database.php';
	require '../class/customer.php';
	require '../class/order.php';
	require '../class/order_details.php';

	$db = new Database();
	$customer = new Customer();
	$order = new Order();
	$detail = new Order_Details();

	extract($_POST);
	if(!isset($_GET['del']))
	{
		$customer->setFirstName(htmlentities($firstname));
		$customer->setLastname(htmlentities($lastname));
		$customer->setContactNumber(htmlentities($contact_num));
		$customer->setCountryId(intval($country));
		$customer->setShippingAddress(htmlentities($address));
		$customer->setStateId(intval($state));
		$customer->setCity(htmlentities($city));
		$customer->setZip(htmlentities($zip));
		$customer->setStatus(1);


		if(isset($_POST['save_customer']))
		{
		
			$data = [
						'firstname' 	   => $customer->getFirstName(),
						'lastname' 		   => $customer->getLastname() ,
						'contact_number'   => $customer->getContactNumber() ,
						'country_id'  	   => $customer->getCountryId()   ,
						'shipping_address' => $customer->getShippingAddress()      ,
						'city'  		   => $customer->getCity()   ,
						'zip' 			   => $customer->getZip() ,
						'state_id' 		   => $customer->getStateId() ,
						'status' 		   => $customer->getStatus() ,
					];


			$customer_id = $db->insert("customer", $data);
			//orders
			
			header("location: ../customer/manage.php?msg=inserted");
				
				
			
		}
		if(isset($_POST['update_customer']))
		{
			$customer->setCustomerId($customer_id_fm);

			$fields = array('firstname' ,'lastname' ,'contact_number' ,'country_id','shipping_address' , 'city' , 'zip', 'state_id');
				$where  = "WHERE id = ?";
				$params = array(
						$customer->getFirstname(),
						$customer->getLastname(),
						$customer->getContactNumber(),
						$customer->getCountryId(),
						$customer->getShippingAddress(),
						$customer->getCity(),
						$customer->getZip(),
						$customer->getStateId(),
						$customer->getCustomerId()
						);

			$customer_update = $db->update("customer", $fields , $where, $params);

			header("location: ../customer/manage.php?id=".$customer->getCustomerId()."&msg=updated");
		}

	}
		
	else if(isset($_GET['del']))
	{

		$customer_id = $_GET['id'];
		$customer->setStatus(0);
			
			$fields = array("status");
			$where  = "WHERE id = ?";
			$params = array(
					$customer->getStatus(),
					$customer_id
					);

			$db->update("customer", $fields , $where, $params);

			header("location: ../customer/customer.php?msg=deleted");
	}
?>