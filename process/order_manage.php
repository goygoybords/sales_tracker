<?php
	session_start();
	error_reporting(0);
	require '../class/database.php';
	require '../class/customer.php';
	require '../class/order.php';
	require '../class/order_details.php';
	require '../class/product.php';
	require '../class/customer_payment.php';


	$db = new Database();
	$customer = new Customer();
	$order = new Order();
	$detail = new Order_Details();
	$customer_payment = new Customer_Payment();
	$product_class = new Product();

	
	extract($_POST);
	if(!isset($_GET['approve']) && !isset($_GET['send_mail']) && !isset($_GET['add_tracking']))
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
		$customer->setCreatedBy($_SESSION['id']);
		$customer->setStatus(1);



		$order->setOrderDate(date('Y-m-d',strtotime($order_date)));
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
						'created_by'		=> $customer->getCreatedBy(),
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
				if($payment_method == 2 )
				{
					$customer_payment->setCardType("");
					$customer_payment->setCardName("");
					$customer_payment->setCardNumber("");
					$customer_payment->setExpiryDate("");
					$customer_payment->setCvv("");
					$customer_payment->setAccountNumber($check_account_number);
					$customer_payment->setBankName($check_bank_name);
					$customer_payment->setRoutingNumber($check_routing_number);
					$customer_payment->setCheckNumber($check_number);
				}
				else if($payment_method == 3)
				{
					$customer_payment->setCardType("");
					$customer_payment->setCardName("");
					$customer_payment->setCardNumber("");
					$customer_payment->setExpiryDate("");
					$customer_payment->setCvv("");
					$customer_payment->setAccountNumber($account_number);
					$customer_payment->setBankName($bank_name);
					$customer_payment->setRoutingNumber($routing_number);
					$customer_payment->setCheckNumber($check_number);
				}
				else
				{
					$customer_payment->setCardType($card_type);
					$customer_payment->setCardName($cardholder);
					$customer_payment->setCardNumber($card_number);
					$customer_payment->setExpiryDate($expiry_date);
					$customer_payment->setCvv($cvv);
					$customer_payment->setCheckNumber("");
					$customer_payment->setAccountNumber(0);
					$customer_payment->setBankName("");
					$customer_payment->setRoutingNumber(0);

				}
				
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
							'account_number' => $customer_payment->getAccountNumber(),
							'bank_name'		 => $customer_payment->getBankName(),
							'routing_number' => $customer_payment->getRoutingNumber(),
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
						$get_product =	$db->select('products', array('quantity'), "id = ?", array($product[$i]) );
						foreach ($get_product as $p ) 
						{
							$total_qty = $p['quantity'] - $quantity[$i];
							$product_class->setQuantity($total_qty);
							$db->update("products", array('quantity') , "WHERE id = ?", array($product_class->getQuantity(), $product[$i])) ;

						}

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
			$order->setDateUpdated(date('Y-m-d H:i:s'));
			$order->setUpdatedBy($_SESSION['id']);

			$fields = array('firstname' ,'lastname' ,'contact_number' ,'country_id','shipping_address' , 'city' , 'zip', 'state_id' , 
				'same' , 'billing_country_id','billing_address' , 'billing_zip' , 'billing_zip' , 'billing_state_id');
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
						$customer->getSame(),
						$customer->getBillingCountryId(),
						$customer->getBillingAddress(),
						$customer->getBillingCity(),
						$customer->getBillingZip(),
						$customer->getBillingStateId() ,
						$customer->getCustomerId()
						);

			$customer_update = $db->update("customer", $fields , $where, $params);

			$fields = array("order_date","total", "shipping_method_id" , "shipping_fee" , "remarks", "notes" ,'merchant' , 'updated_by' ,'date_updated');
			$where  = "WHERE id = ?";
				$params = array(
						$order->getOrderDate(),
						$order->getTotal(),
						$order->getShippingMethodId(),
						$order->getShippingFee(),
						$order->getRemarks(),
						$order->getNotes(),
						$order->getMerchant(),
						$order->getUpdatedBy(),
						$order->getDateUpdated(),
						$order->getOrderId()
						);

			$order_update = $db->update("orders", $fields , $where, $params);


				$customer_payment->setId($payment_method_id_fm);
				$customer_payment->setPaymentMethod(intval($payment_method));
				if($payment_method == 2 )
				{
					$customer_payment->setCardType("");
					$customer_payment->setCardName("");
					$customer_payment->setCardNumber("");
					$customer_payment->setExpiryDate("");
					$customer_payment->setCvv("");
					$customer_payment->setAccountNumber($check_account_number);
					$customer_payment->setBankName($check_bank_name);
					$customer_payment->setRoutingNumber($check_routing_number);
					$customer_payment->setCheckNumber($check_number);
				}
				else if($payment_method == 3)
				{
					$customer_payment->setCardType("");
					$customer_payment->setCardName("");
					$customer_payment->setCardNumber("");
					$customer_payment->setExpiryDate("");
					$customer_payment->setCvv("");
					$customer_payment->setAccountNumber($account_number);
					$customer_payment->setBankName($bank_name);
					$customer_payment->setRoutingNumber($routing_number);
					$customer_payment->setCheckNumber($check_number);

				}
				else
				{
					$customer_payment->setCardType($card_type);
					$customer_payment->setCardName($cardholder);
					$customer_payment->setCardNumber($card_number);
					$customer_payment->setExpiryDate($expiry_date);
					$customer_payment->setCvv($cvv);
					$customer_payment->setCheckNumber("");
					$customer_payment->setAccountNumber(0);
					$customer_payment->setBankName("");
					$customer_payment->setRoutingNumber(0);
				}

			

			$fields = array('payment_method' , 'card_type' , 'card_number' , 'card_name', 'expiry_date' , 'cvv' , 'check_number',
				'account_number','bank_name' ,'routing_number');
			
			$where = "WHERE id = ?";
				$params = array(
						$customer_payment->getPaymentMethod(),
						$customer_payment->getCardType(),
						$customer_payment->getCardNumber(),
						$customer_payment->getCardName(),
						$customer_payment->getExpiryDate(),
						$customer_payment->getCvv(),
						$customer_payment->getCheckNumber(),
						$customer_payment->getAccountNumber(),
						$customer_payment->getBankName(),
						$customer_payment->getRoutingNumber(),
						$customer_payment->getId()
						);
			
			$payment_update = $db->update("customer_payment_methods", $fields , $where, $params);
			header("location: ../orders/manage.php?id=".$order->getOrderId()."&msg=updated");
		}

	}
		
	if(isset($_GET['approve']))
	{

		$order_id = $_GET['id'];
		$order->setOrderId($order_id);
		$order->setApprovedBy($_SESSION['id']);
		$order->setStatus(1);
			
		$fields = array("approved_by", "status");
		$where  = "WHERE id = ?";
		$params = array(
				$order->getApprovedBy(),
				$order->getStatus(),
				$order->getOrderId()
				);

		$order_update = $db->update("orders", $fields , $where, $params);

		header("location: ../orders/approved_orders.php?msg=approved");
	}

	if(isset($_GET['send_mail']))
	{
		require '../class/phpmailer/PHPMailerAutoload.php';
		// $order_id = $_GET['id'];
		// // $order->setOrderId($order_id);
		
		// // $get_customer_id = $db->select('orders' , array("customer_id" , "tracking_number"), "id = ?" , array($order->getOrderId() ) );
		// // $get_email = $db->select('customer' , array('firstname','lastname','email') , 
		// // 	'id = ?' , array($get_customer_id[0]['customer_id']) );

		// // 	$tracking_number = $get_customer_id[0][1] + 1;
		// // 	$fields = array("tracking_number");
		// // 	$where  = "WHERE id = ?";
		// // 	$params = array($tracking_number , $order->getOrderId());
		// // 	$db->update("orders", $fields , $where, $params);

		$mail = new PHPMailer;
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->SMTPAuth = true;  // authentication enabled
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465; 
		$mail->Username = "john.flashpark@gmail.com";  
		$mail->Password = "goygoy08";

		$mail->setFrom('salestracker@no-reply.com', 'Mailer');
		$mail->addAddress($get_email[0][2], $get_email[0][0]." ".$get_email[0][1]);     // Add a recipient
		// $mail->addAddress('ellen@example.com');               // Name is optional
		//mail->addReplyTo('info@example.com', 'Information');
		
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Order Process';
		$mail->Body    = 'Hi. Good Day. <br> We have processed your order. <br> Your Tracking Number is:'.$tracking_number.' ';

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} 
		else 
		{
		    header("location: ../orders/approved_orders.php?msg=sent");
		}
	}
	if(isset($_POST['add_tracking_number']))
	{
		$order->setOrderId($order_id_fm);
		echo $order->getOrderId();
	
		$fields = array("tracking_number");
		$where  = "WHERE id = ?";
		$params = array($tracking_number , $order->getOrderId());
		$db->update("orders", $fields , $where, $params);
		
		header("location: ../orders/approved_orders.php?msg=tracking");
	}
?>