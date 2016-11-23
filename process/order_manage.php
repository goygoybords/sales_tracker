<?php
	session_start();
	require '../class/database.php';
	require '../class/customer.php';
	require '../class/order.php';
	require '../class/order_details.php';
	require '../class/customer_payment.php';


	$db = new Database();
	$customer = new Customer();
	$order = new Order();
	$detail = new Order_Details();
	$customer_payment = new Customer_Payment();

	extract($_POST);
	if(!isset($_GET['approve']))
	{
	
		$customer->setFirstName(htmlentities($firstname));
		$customer->setLastname(htmlentities($lastname));
		$customer->setContactNumber(htmlentities($contact_num));
		$customer->setCountryId(intval($country));
		$customer->setShippingAddress(htmlentities($address));
		$customer->setStateId(intval($state));
		$customer->setCity(htmlentities($city));
		$customer->setZip(htmlentities($zip));
		
		if(isset($_POST['same']) == 1)
			$customer->setSame($same);
		else
			$customer->setSame(0);

		$customer->setAlternateContactNumber(htmlentities($alternate_contact_num));
		$customer->setBillingCountryId(intval($billing_country));
		$customer->setBillingStateId(intval($billing_state));
		$customer->setBillingAddress(htmlentities($billing_address));
		$customer->setBillingCity(htmlentities($billing_city));
		$customer->setBillingZip(htmlentities($billing_zip));
		$customer->setStatus(1);


		$order->setOrderDate(strtotime(date('Y-m-d')));
		$order->setTotal(doubleval($total));
		$order->setShippingMethodId(intval($shipping_method));
		$order->setShippingFee(doubleval($shipping));
		$order->setRemarks(htmlentities($remarks));
		$order->setNotes(htmlentities($notes));

		$order->setPreparedBy(intval($_SESSION['id']));
		$order->setMerchant(htmlentities($merchant));
		$order->setDateSubmitted(date('Y-m-d H:i:s'));


		if(isset($_POST['save_order']))
		{
			if($customer_state == 0)
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
			}
			//orders
			if($customer_id)
			{
				$order->setCustomerId($customer_id);
				$order->setStatus(0);

				$customer_payment->setCustomerId($customer_id);
				$customer_payment->setPaymentMethod(intval($payment_method));
				if($payment_method == 2)
					$customer_payment->setCardType("");
				else
					$customer_payment->setCardType($card_type);
				$customer_payment->setCardName($cardholder);
				$customer_payment->setCardNumber($card_number);
				$customer_payment->setExpiryDate($expiry_date);
				$customer_payment->setCvv($cvv);
				$customer_payment->setCheckNumber($check_number);
				$customer_payment->setStatus(1);

				$data = [
							'customer_id' 	 => $customer_payment->getCustomerId(),
							'payment_method' => $customer_payment->getPaymentMethod(),
							'card_type' 	 => $customer_payment->getCardType(),
							'card_number' 	 => $customer_payment->getCardNumber(),
							'card_name' 	 => $customer_payment->getCardName(),
							'expiry_date' 	 => $customer_payment->getExpiryDate(),
							'cvv' 			 => $customer_payment->getCvv(),
							'check_number'   => $customer_payment->getCheckNumber(),
							'status' 		 => $customer_payment->getStatus()
						];


				$payment_id = $db->insert("customer_payment_methods", $data);
			

				$order->setPaymentMethodId($payment_id);
				$data = [
						'order_date' 	      => $order->getOrderDate(),
						'customer_id' 		  => $order->getCustomerId() ,
						'total'  	          => $order->getTotal()   ,
						'shipping_method_id ' => $order->getShippingMethodId()      ,
						'shipping_fee'  	  => $order->getShippingFee()   ,
						'remarks' 			  => $order->getRemarks() ,
						'notes' 		      => $order->getNotes() ,
						'payment_method_id'   => $order->getPaymentMethodId(),
						'merchant'			  => $order->getMerchant(),
						'prepared_by'		  => $order->getPreparedBy(),
						'date_submitted' 	  => $order->getDateSubmitted(),
						'status' 		      => $order->getStatus() ,
					];

				$order_id = $db->insert("orders", $data);
				if($order_id)
				{
					//Order Detail Detail Entries
			        for($i=0; $i < count($product) ; $i++)
			        {
			            $detail->setOrderId($order_id);
			            $detail->setProductId(intval($product[$i]));
			            $detail->setQuantity(intval($quantity[$i]));
			            $detail->setUnitPrice(doubleval($unit_price[$i]));
			            $detail->setAmount(doubleval($amount[$i]));
			            $detail->setStatus(1);

			            $data = [
							'order_id' 	  => $detail->getOrderId(),
							'product_id'  => $detail->getProductId() ,
							'quantity' 	  => $detail->getQuantity() ,
							'unit_price ' => $detail->getUnitPrice() ,
							'amount'  	  => $detail->getAmount()   ,
							'status' 	  => $detail->getStatus() ,
						];
						$order_details_id = $db->insert("order_detail", $data);
			        }
			        header("location: ../orders/manage.php?msg=inserted");
				}
				
			}
		}
		if(isset($_POST['update_order']))
		{
			$customer->setCustomerId($customer_id_fm);
			$order->setOrderId($order_id_fm);

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

			$fields = array("total", "shipping_method_id" , "shipping_fee" , "remarks", "notes");
			$where  = "WHERE id = ?";
				$params = array(
						$order->getTotal(),
						$order->getShippingMethodId(),
						$order->getShippingFee(),
						$order->getRemarks(),
						$order->getNotes(),
						$order->getOrderId()
						);

			$order_update = $db->update("orders", $fields , $where, $params);

			header("location: ../orders/manage.php?id=".$order->getOrderId()."&msg=updated");
		}

	}
		
	else if(isset($_GET['approve']))
	{

		$order_id = $_GET['id'];
		$order->setOrderId($order_id);
		$order->setStatus(1);
			
			$fields = array("status");
			$where  = "WHERE id = ?";
			$params = array(
					$order->getStatus(),
					$order->getOrderId()
					);

			$order_update = $db->update("orders", $fields , $where, $params);

			header("location: ../orders/orders.php?msg=approved");
	}
?>