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
		$customer->setEmail(htmlentities($email));
		$customer->setCountryId(intval($country));
		$customer->setShippingAddress(htmlentities($address));
		$customer->setStateId(intval($state));
		$customer->setCity(htmlentities($city));
		$customer->setZip(htmlentities($zip));
		
		$customer->setAlternateContactNumber(htmlentities($alternate_contact_num));
		if(isset($_POST['same']) == 1)
		{
			$customer->setSame($same);
		}
		else
			$customer->setSame(0);
		
		$customer->setBillingCountryId(intval($billing_country));
		$customer->setBillingStateId(intval($billing_state));
		$customer->setBillingAddress(htmlentities($billing_address));
		$customer->setBillingCity(htmlentities($billing_city));
		$customer->setBillingZip(htmlentities($billing_zip));
		$customer->setStatus(1);


		if(isset($_POST['save_customer']))
		{
			$data = [
						'firstname' 	   => $customer->getFirstName(),
						'lastname' 		   => $customer->getLastname(),
						'email'			   => $customer->getEmail(),
						'contact_number'   => $customer->getContactNumber() ,
						'alternate_contact_number' => $customer->getAlternateContactNumber(),
						'country_id'  	   => $customer->getCountryId()   ,
						'shipping_address' => $customer->getShippingAddress() ,
						'city'  		   => $customer->getCity()   ,
						'zip' 			   => $customer->getZip() ,
						'state_id' 		   => $customer->getStateId() ,
						'same'			   => $customer->getSame(),
						'billing_country_id' => $customer->getBillingCountryId(),
						'billing_address'    => $customer->getBillingAddress(),
						'billing_city' 		 => $customer->getBillingCity(),
						'billing_zip'  		 => $customer->getBillingZip(),
						'billing_state_id'   => $customer->getBillingStateId() ,
						'status' 		   => $customer->getStatus() ,
					];

			

			$customer_id = $db->insert("customer", $data);
			header("location: ../customer/manage.php?msg=inserted");
		}
		if(isset($_POST['update_customer']))
		{
			$customer->setCustomerId($customer_id_fm);

			$fields = array('firstname' ,'lastname','email' ,'contact_number','alternate_contact_number' ,'country_id','shipping_address' , 'city' , 'zip', 'state_id', 
				'same' , 'billing_country_id' , 'billing_address' , 'billing_city' , 'billing_zip' , 'billing_state_id');
				$where  = "WHERE id = ?";
				$params = array(
						$customer->getFirstname(),
						$customer->getLastname(),
						$customer->getEmail(),
						$customer->getContactNumber(),
						$customer->getAlternateContactNumber(),
						$customer->getCountryId(),
						$customer->getShippingAddress(),
						$customer->getCity(),
						$customer->getZip(),
						$customer->getStateId(),
						$customer->getSame(), 
						$customer->getBillingCountryId(), 
						$customer->getBillingAddress(), 
						$customer->getBillingCity(), 
						$customer->getBillingZip(), 
						$customer->getBillingStateId(),
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