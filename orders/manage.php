<?php
	session_start();
	if($_SESSION['isLogin'] != true){
		header("location: ../index.php");
		exit;
	}

	include '../include/start.html';
	require('../include/header.php');
	require '../class/database.php';
	require '../class/state.php';
	require '../class/customer.php';

	require '../class/order.php';
	require '../class/product.php';
	require '../class/countries.php';
	require '../class/shipping_method.php';
	require '../class/order_details.php';
	require '../class/customer_payment.php';
	require '../class/order_send_someone.php';

	$db = new Database();
	$order_id = (isset($_GET["id"]) ? $_GET["id"] : "");

	$form_state = 1;
	$form_header = "Add New Order";
	$submit_caption = "Save Order";
	$submit_name = "save_order";
	
	$list_product = $db->select("products", array("*"), "status = ?" , array(1));
	$list_countries = $db->select("countries" , array("*"));
	$list_methods = $db->select("shipping_method", array("*") , "status = 1");

	if($_SESSION['user_type'] == 3)
	{
		$list_customer = $db->select("customer" , array('id' , 'firstname' , 'lastname'), "created_by = ? AND status = ?", array($_SESSION['id'] , 1));
	}
	else
	{
		$list_customer = $db->select("customer" , array('id' , 'firstname' , 'lastname'), "status = 1");
	}
	
	
	$msg = (isset($_GET["msg"]) ? $_GET["msg"] : "");

	$order = new Order();
	$customer = new Customer();
	$customer_payment = new Customer_Payment();
	$someone = new Order_Send_Someone();

	$order->setShippingFee(5.00);

	if(isset($_GET['view_record']) || isset($_GET['add_tracking']))
	{
		$read_only = "readonly";
		$style = "display:none";
		$disabled = "disabled";
	}
	else
	{
		$read_only = "";
		$style = "";
		$disabled = "";
	}
										
	if($order_id)
	{
			if($msg != 'deleted')
			{
				$table = 'orders';
				$fields = array('*');
				$where = " id = ? ";
				$params = array($order_id);
				$orders = $db->select($table, $fields, $where, $params);

				if(count($orders))
				{
					foreach ($orders as $o)
					{
						$order->setOrderId($order_id);
						$order->setOrderDate(date('m/d/Y', strtotime($o['order_date'])));
						$order->setCustomerId($o['customer_id']);
						$order->setTotal($o['total']);
						$order->setShippingMethodId($o['shipping_method_id']);
						$order->setShippingFee($o['shipping_fee']);
						$order->setRemarks($o['remarks']);
						$order->setNotes($o['notes']);
						$order->setPaymentMethodId($o['payment_method_id']);
						$order->setMerchant($o['merchant']);
						$order->setPreparedBy($o['prepared_by']);
						$order->setTrackingNumber($o['tracking_number']);
						$order->setStatus($o['status']);
					}
					$get_customer = $db->select('customer' , array("*"), "id = ?", array($order->getCustomerId() ) );
				
					$get_send = $db->select("order_send_someone", array("*") , 'order_id = ?', array($order_id) );
					foreach ($get_send as $c ) 
					{
						$someone->setSendCounter($c['send_counter']);
						$someone->setSendName($c['send_name']);
						$someone->setSendContactNumber($c['send_contact_number']);
						$someone->setSendCountryId($c['send_country_id']);
						$someone->setSendAddress($c['send_address']);
						$someone->setSendCity($c['send_city']);
						$someone->setSendZip($c['send_zip']);
						$someone->setSendStateId($c['send_state_id']);
						$someone->setStatus(1);
					}

					foreach ($get_customer as $c ) 
					{
						$customer->setCustomerId($c['id']);
						$customer->setFirstname($c['firstname']);
						$customer->setLastname($c['lastname']);
						$customer->setEmail($c['email']);
						$customer->setContactNumber($c['contact_number']);
						$customer->setAlternateContactNumber($c['alternate_contact_number']);
						$customer->setCountryId($c['country_id']);
						$customer->setShippingAddress($c['shipping_address']);
						$customer->setCity($c['city']);
						$customer->setZip($c['zip']);
						$customer->setStateId($c['state_id']);
						$customer->setSame(intval($c['same']));
						$customer->setBillingCountryId(intval($c['billing_country_id']));
						$customer->setBillingStateId(intval($c['billing_state_id']));
						$customer->setBillingAddress(htmlentities($c['billing_address']));
						$customer->setBillingCity(htmlentities($c['billing_city']));
						$customer->setBillingZip(htmlentities($c['billing_zip']));
						$customer->setStatus($c['status']);
					}
					$get_payment = $db->select('customer_payment_methods' , array("*"), "id = ?" , array($order->getPaymentMethodId() ) );
					foreach ($get_payment as $p ) 
					{
						$customer_payment->setPaymentMethod($p['payment_method']);
						$customer_payment->setCardType($p['card_type']);
						$customer_payment->setCardNumber($p['card_number']);
						$customer_payment->setCardName($p['card_name']);
						$customer_payment->setExpiryDate($p['expiry_date']);
						$customer_payment->setCvv($p['cvv']);
						$customer_payment->setCheckNumber($p['check_number']);
						$customer_payment->setAccountNumber($p['account_number']);
						$customer_payment->setBankName($p['bank_name']);
						$customer_payment->setRoutingNumber($p['routing_number']);
					}
					$get_orders = $db->select('order_detail' , array("*"), "order_id = ? AND status = 1" , array($order->getOrderId() ) );

					$get_preparedby = $db->select('users' , array("CONCAT(first_name , ' ' , lastname) AS 'fullname' " , 'screen_name'), 'id = ?', array($order->getPreparedBy()));

					$form_state = 2;
					$form_header = "Edit Order Details";
					$submit_caption = "Save Changes";
					$submit_name = "update_order";
				}
				else
				{
					$_GET["msg"] = "none";
				}
			}
	}

?>
<!-- BEGIN BASE-->
<div id="base">

	<!-- BEGIN OFFCANVAS LEFT -->
	<div class="offcanvas">
	</div><!--end .offcanvas-->
	<!-- END OFFCANVAS LEFT -->

	<!-- BEGIN CONTENT-->
	<div id="content">
		<!-- BEGIN Customer content -->
		<section>
			<div class="section-body">
				<!-- Button - add new customer and add family memmbers -->
				<div class="row">
					<div class="col-lg-offset-0 col-md-12">
						<div class="card card-underline">
							<div class="card-head">
								<header><i class="fa fa-fw fa-user-plus"></i> <?php echo $form_header; ?></header>
							</div><!--end .card-head -->

							<form class="form" method="POST" action="../process/order_manage.php">
								<div class="">
									<div class="card-body">
										<br/>
										<div class="form-group">
											<label><b>CUSTOMER DETAILS</b></label>
										</div>

										<div class="row">
											<div class="col-sm-12" style="<?php echo $style; ?>">
												<div class="form-group floating-label">
													<select name = "customer_id" class = "form-control" id = "customer_id" >
													<option value = "add-new-cust" selected>Add New Customer</option>
													<?php foreach ($list_customer as $c ) : ?>
							  							<option value ="<?php echo $c['id']; ?>">
						  									<?php echo $c['firstname']." ".$c['lastname'] ?>
						  								</option>
						  							<?php endforeach; ?>
													</select>
													<label class="customer">Customer</label>
												</div>

													<input type="hidden" name="customer_state"  id = "customer-state" value = "0">
											</div>	
											

											<div class="col-sm-6">
												<div class="form-group floating-label">
													<input type="text" name = "firstname" <?php echo $read_only; ?> class="form-control" id="firstname" value="<?php echo $customer->getFirstName(); ?>" required >
													<label for="firstname">First Name</label>
												</div>
											</div>

											<div class="col-sm-6">
												<div class="form-group floating-label">
													<input type="text" name = "lastname" class="form-control" <?php echo $read_only; ?> id="lastname" value="<?php echo $customer->getLastName(); ?>" required >
													<label for="lastname">Last Name</label>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="email" name = "email" class="form-control" <?php echo $read_only; ?> id="email" value="<?php echo $customer->getEmail(); ?>" >
													<label for="email">Email Address</label>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="text" name = "contact_num" class="form-control" <?php echo $read_only; ?> id="contact_num" value="<?php echo $customer->getContactNumber(); ?>" required >
													<label for="lastname">Contact Number</label>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="text" name = "alternate_contact_num" class="form-control" <?php echo $read_only; ?> id="alternate_contact_num" 
													value="<?php echo $customer->getAlternateContactNumber(); ?>"  >
													<label for="lastname">Alternate Contact Number</label>
												</div>
											</div>

										</div>
										<br/>

										<div class="form-group">
											<label><b>CUSTOMER SHIPPING DETAILS</b></label>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group floating-label">
													<select name = "country" class = "form-control" id = "country" <?php echo $disabled; ?> >
													<option value="230">United States</option>
													<?php 
						  								foreach ($list_countries as $p ) : 
						  								
						  									$countries = new Countries();
						  									$countries->setCountryId($p['country_id']);
						  									$countries->setCountryName($p['country_name']);
						  							?>
							  							<option value ="<?php echo $countries->getCountryId(); ?>"
														<?php echo ($countries->getCountryId() == $customer->getCountryId() ? "selected='selected'" : ""); ?>
							  							>
						  									<?php echo $countries->getCountryName(); ?>
						  								</option>
						  							<?php endforeach; ?>
													</select>
													<label class="country">County</label>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group floating-label">
													<input type="text" name = "address" class="form-control" <?php echo $read_only; ?>  id="address" value="<?php echo $customer->getShippingAddress(); ?>" required>
													<label class="address">Address</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<div class="form-group floating-label">
													<select name = "state" class = "form-control" id = "state"  <?php echo $disabled; ?> >
														<option></option>
														<?php $states = $db->select('state' , array('*') , "status = ?" , array(1));  foreach ($states as $s ): ?>
														<?php
															$state = new State();
															$state->setId($s['id']);
															$state->setCode($s['code']);
														?>
															<option value = "<?php echo $state->getId(); ?>"
																<?php echo ($state->getId() == $customer->getStateId() ? "selected='selected'" : ""); ?>
															>
																<?php echo $state->getCode(); ?>
															</option>
														<?php endforeach; ?>
													</select>
													<label class="state">State</label>
												</div>
											</div>

											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="text" name = "city" class="form-control" id="city"  <?php echo $read_only; ?> value="<?php echo $customer->getCity(); ?>">
													<label class="city">City</label>
												</div>
											</div>

											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="text" name = "zip" class="form-control" id="zip"  <?php echo $read_only; ?> value="<?php echo $customer->getZip(); ?>" >
													<label class="zip">Zip</label>
												</div>
											</div>
										</div>
										<br />

										<div class = "row">
											<div class="col-sm-12">
												<div class="form-group floating-label" >
													<input type="checkbox" id="send_to_someone" name = "send_to_someone" value="1" <?php echo $disabled; ?> 
													<?php echo ($someone->getSendCounter() == 1 ? "checked" : ""); ?> />
													<input type="hidden" id = "send_display_state" value="<?php echo $someone->getSendCounter(); ?>" >
	  												<label for="test5">Send Shipment To Someone?</label>
												</div>
											</div>
										</div>

										<div class = "ship_some_form">
										<div class="form-group">
											<label><b>SHIP TO SOMEONE SHIPPING DETAILS</b></label>
										</div>

											<div class="row">
												<div class="col-sm-6">
													<div class="form-group floating-label">
														<input type="text" name = "ship_someone_name" class="form-control" <?php echo $read_only; ?>  
														id="ship_someone_name" value="<?php echo $someone->getSendName(); ?>" >
														<label class="address">Name</label>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group floating-label">
														<input type="text" name = "ship_someone_number" class="form-control" <?php echo $read_only; ?>  
														id="ship_someone_number" value="<?php echo $someone->getSendContactNumber(); ?>" >
														<label class="address">Contact Number</label>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group floating-label">
														<select name = "ship_someone_country" class = "form-control" id = "ship-someone-country" <?php echo $disabled; ?> >
														<option value="230">United States</option>
														<?php 
							  								foreach ($list_countries as $p ) : 
							  								
							  									$countries = new Countries();
							  									$countries->setCountryId($p['country_id']);
							  									$countries->setCountryName($p['country_name']);
							  							?>
								  							<option value ="<?php echo $countries->getCountryId(); ?>"
															<?php echo ($countries->getCountryId() == $someone->getSendCountryId() ? "selected='selected'" : ""); ?>
								  							>
							  									<?php echo $countries->getCountryName(); ?>
							  								</option>
							  							<?php endforeach; ?>
														</select>
														<label class="country">County</label>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group floating-label">
														<input type="text" name = "ship_someone_address" class="form-control" <?php echo $read_only; ?>  
														id="ship_someone_address" value="<?php echo $someone->getSendAddress(); ?>" >
														<label class="address">Address</label>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-sm-4">
													<div class="form-group floating-label">
														<select name = "ship_someone_state" class = "form-control" id = "ship_someone_state"  <?php echo $disabled; ?> >
															<option></option>
															<?php $states = $db->select('state' , array('*') , "status = ?" , array(1));  foreach ($states as $s ): ?>
															<?php
																$state = new State();
																$state->setId($s['id']);
																$state->setCode($s['code']);
															?>
																<option value = "<?php echo $state->getId(); ?>"
																	<?php echo ($state->getId() == $someone->getSendStateId() ? "selected='selected'" : ""); ?>
																>
																	<?php echo $state->getCode(); ?>
																</option>
															<?php endforeach; ?>
														</select>
														<label class="state">State</label>
													</div>
												</div>

												<div class="col-sm-4">
													<div class="form-group floating-label">
														<input type="text" name = "ship_someone_city" class="form-control" id="ship-someone-city"  
														<?php echo $read_only; ?> value="<?php echo $someone->getSendCity(); ?>">
														<label class="city">City</label>
													</div>
												</div>

												<div class="col-sm-4">
													<div class="form-group floating-label">
														<input type="text" name = "ship_someone_zip" class="form-control" id="ship-someone-zip"  <?php echo $read_only; ?> value="<?php echo $someone->getSendZip(); ?>" >
														<label class="zip">Zip</label>
													</div>
												</div>
											</div>
										</div>
										<br />

										<input type="hidden" name="customer_id_fm" value="<?php echo $customer->getCustomerId(); ?>">
										<input type="hidden" name="order_id_fm" value = "<?php echo $order->getOrderId(); ?>">
										<input type="hidden" name="payment_method_id_fm" value = "<?php echo $order->getPaymentMethodId(); ?>">
										
	

										<div class="form-group">
											<label><b>ORDER DETAILS</b></label>
										</div>
										<div class = "row">
											<div class="col-sm-12">
														<div class="form-group">
											                <div class='input-group date' id='datetimepicker1'>
											                    <input type='text' id = "order_date" name = "order_date" value = "<?php echo $order->getOrderDate(); ?>" placeholder="Order Date" class="form-control"   />
											                    <span class="input-group-addon">
											                        <span class="glyphicon glyphicon-calendar"></span>
											                    </span>
											                </div>
											            </div>
													</div>
											<div class = "col-lg-12">
												<a id = "add_more_button" class = "btn btn-info">Add More Items</a>
												<br>
												<br>
												<table class = "table order-table" border="1">
								  					<thead>
								  						<tr>
								  							<th>Product</th>
								  							<th>Quantity</th>
								  							<th>Unit Price</th>
								  							<th>Amount</th>
								  						<tr>
								  					</thead>
								  					<tbody>
								  						<?php if($form_state == 1): ?>
															<tr>
									  							<td>
									  								<select  name = "product[]" <?php echo $disabled; ?> class = "form-control item_list browser-default">
										  							<option disabled selected>Choose Items Here</option>
												  							<?php 
												  								foreach ($list_product as $p ) : 
												  									$product = new Product();
												  									$product->setProductId($p['id']);
												  									$product->setProductDescription($p['product_description']);
												  									$product->setQuantity($p['quantity']);
												  							?>
												  								<option value ="<?php echo $product->getProductId(); ?>" >
												  									<?php echo $product->getProductDescription(); ?>
												  										
												  									</option>
												  							<?php endforeach;  ?>
												  					</select>
									  							</td>
									  							<td>
									  								<input type="text" name="quantity[]" <?php echo $read_only; ?> class = "form-control quantity browser-default" value = "0.00" placeholder="Quantity" >		
												  				</td>
									  							<td><input type = "text" class = "form-control lblUprice" name = "unit_price[]" value = "0.00" placeholder="Unit Price"></td>
									  							<td><input type = "text" class = "form-control lblAmount" name = "amount[]" value = "0.00" placeholder="Amount"></td>
									  						</tr>

								  						<?php elseif ($form_state == 2): ?>
								  							<?php 
								  								$counter  = 0;
								  								foreach ($get_orders as $g ): 
								  									$details = new Order_Details();
								  									$details->setProductId($g['product_id']);
								  									$details->setQuantity($g['quantity']);
								  									$details->setUnitPrice($g['unit_price']);
								  									$details->setAmount($g['amount']);

								  							?>
									  							<tr>
										  							<td>
										  								<select  name = "product[]" <?php echo $disabled; ?> class = "form-control item_list<?php echo $counter; ?> browser-default">
											  							<option disabled selected>Choose Items Here</option>
											  								<?php 
													  								foreach ($list_product as $p ) : 
													  									$product = new Product();
													  									$product->setProductId($p['id']);
													  									$product->setProductDescription($p['product_description']);
													  							?>
													  								<option value ="<?php echo $product->getProductId(); ?>" 
																						<?php echo ($product->getProductId() == $details->getProductId() ? "selected='selected'" : ""); ?>
													  								>
													  									<?php echo $product->getProductDescription(); ?>
													  										
													  									</option>
													  							<?php endforeach;  ?>
													  							
													  					</select>
										  							</td>
										  							<td>
										  								<input type="text" name="quantity[]" <?php echo $read_only; ?> class = "form-control quantity<?php echo $counter; ?> browser-default" placeholder="Quantity" 
										  								value = "<?php echo $details->getQuantity();  ?>">		
													  				</td>
										  							<td>
										  								<input type = "text" class = "form-control lblUprice<?php echo $counter; ?>"  name = "unit_price[]" placeholder="Unit Price" 
										  								value = "<?php echo $details->getUnitPrice(); ?>">
										  							</td>
										  							<td>
										  								<input type = "text" class = "form-control lblAmount<?php echo $counter; ?>"  name = "amount[]" placeholder="Amount" 
										  								value="<?php echo $details->getAmount(); ?>">
										  								</td>
										  						</tr>

										  					<?php $counter++; ?>	
										  					<input type="hidden" id="counter_form" value="<?php echo $counter; ?>">
										  					<?php endforeach; ?>
								  						<?php endif; ?>
								  						<tr>
								  							<td></td>
								  							<td></td>
								  							<td>Total:</td>
								  							<td>	
								  								<?php if($form_state == 1): ?>
								  								<input type = "text" name = "total" class = "form-control displayTotal" readonly placeholder = "Total" value="0.00">
																<?php elseif($form_state == 2): ?>
																<input type = "text" name = "total" class = "form-control displayTotal" readonly placeholder = "Total" value="<?php echo $order->getTotal(); ?>">
																<?php endif; ?>
								  							</td>
								  						</tr>
								  					</tbody>
								  					<input type="hidden" value="<?php echo $form_state; ?>" id = "form_state">
								  						
								  					<?php if($form_state == 2): ?>
								  					<input type = "hidden" class = "form-control shipping_fee" name = "shipping"  value = "<?php echo $order->getShippingFee(); ?>">
								  					<?php else : ?>
								  						<input type = "hidden" class = "form-control shipping_fee" name = "shipping" value = "">
								  					<?php endif ;?>
								  						
											</table>
											</div>
										</div>

										<div class="form-group">
											<label><b>MERCHANT</b></label>
										</div>
										<div class="row" >
											<div class="col-sm-12">
												<div class="form-group floating-label">
													<input type="text" name="merchant" id = "merchant" class = "form-control" <?php echo $read_only; ?> value = "<?php echo $order->getMerchant(); ?>">
													<label class="merchant">Merchant</label>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label><b>SHIPPING METHOD</b></label>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group floating-label">
													<select name = "shipping_method" class = "form-control" <?php echo $disabled; ?> id = "shipping_method" required>
														<option></option>
														<?php foreach ($list_methods as $m ): 
															$method = new Shipping_Method();
															$method->setId($m['id']);
															$method->setDescription($m['description']);
														?>
															<option value = "<?php echo $method->getId(); ?>"
															<?php echo ($order->getShippingMethodId() == $method->getId() ? "selected='selected'" : ""); ?>
															> 
																<?php echo $method->getDescription(); ?>
															</option>
														<?php endforeach ?>
													</select>
													<label class="method">Shipping Method</label>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label><b>BILLING DETAILS</b></label>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group floating-label">
													<select name = "payment_method" class = "form-control" <?php echo $disabled; ?> id = "payment_method" >
														<option value = "1" selected 
															<?php echo ($customer_payment->getPaymentMethod() == 1 ? "selected='selected'" : ""); ?> >
															Credit Card
														</option>
														<option value = "2" <?php echo ($customer_payment->getPaymentMethod() == 2 ? "selected='selected'" : ""); ?> >
															Checking Account
														</option>
														<option value = "3" <?php echo ($customer_payment->getPaymentMethod() == 3 ? "selected='selected'" : ""); ?> >
															Savings Account
														</option>
													</select>
													<label class="method">Payment Method</label>
												</div>
											</div>
										</div>

										<div class="row" id = "card_details_view">
    										<div class="col-sm-6">
												<div class="form-group floating-label">
													<select name="card_type" class = "form-control" <?php echo $disabled; ?> id = "card_type">
												    	<option value="MasterCard" 
												    	<?php echo ($customer_payment->getCardType() == "MasterCard" ? "selected='selected'" : ""); ?> >
												    		MasterCard
												    	</option>
												      	<option value="American Express" 
												      		<?php echo ($customer_payment->getCardType() == "American Express" ? "selected='selected'" : ""); ?>>American Express</option>
													    <option value="Visa" <?php echo ($customer_payment->getCardType() == "Visa" ? "selected='selected'" : ""); ?> >Visa</option>
													    <option value="Discover" <?php echo ($customer_payment->getCardType() == "Discover" ? "selected='selected'" : ""); ?> >Discover</option>
													
												    </select>
													<label class="card_type">Card Type</label>
												</div>
											</div> 
											<div class="col-sm-6">
												<div class="form-group floating-label">
													<input type="text" name="cardholder" id = "cardholder" <?php echo $read_only; ?> class = "form-control" value = "<?php echo $customer_payment->getCardName(); ?>">
													<label class="card_holder">Card Holders Name</label>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="text" name="card_number" id = "card_number" class = "form-control" <?php echo $read_only; ?> value = "<?php echo $customer_payment->getCardNumber(); ?>">
													<label class="card_number">Card Number</label>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="text" name="expiry_date" id = "expiry_date" class = "form-control" <?php echo $read_only; ?> value = "<?php echo $customer_payment->getExpiryDate(); ?>">
													<label class="expiry_date">Expiry Date (MM/YY)</label>
												</div>
											</div> 
											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="text" name="cvv" id = "cvv" class = "form-control" <?php echo $read_only; ?> value = "<?php echo $customer_payment->getCvv(); ?>">
													<label class="cvv">CVV</label>
												</div>
											</div>
										</div>

										<div class="row" id = "check_details_view">
											<div class="col-sm-12">
												<div class="form-group floating-label">
													<input type="text" name="check_account_number" id = "account_number" <?php echo $read_only; ?> class = "form-control" 
													value = "<?php echo $customer_payment->getAccountNumber(); ?>">
													<label class="account_number">Account Number</label>
												</div>

												<div class="form-group floating-label">
													<input type="text" name="check_number" id = "check_number"  <?php echo $read_only; ?> class = "form-control" 
													value = "<?php echo $customer_payment->getCheckNumber(); ?>">
													<label class="check_number">Check Number</label>
												</div>
												<div class="form-group floating-label">
													<input type="text" name="check_bank_name" id = "bank_name" <?php echo $read_only; ?> class = "form-control" 
													value = "<?php echo $customer_payment->getBankName(); ?>">
													<label class="bank_name">Bank Name </label>
												</div>

												<div class="form-group floating-label">
													<input type="text" name="check_routing_number" id = "routing_number" <?php echo $read_only; ?> class = "form-control" 
													value = "<?php echo $customer_payment->getRoutingNumber(); ?>">
													<label class="routing_number">Routing Number</label>
												</div>
											</div>
										</div>

										<div class="row" id = "savings_details_view">
											<div class="col-sm-12">
												<div class="form-group floating-label">
													<input type="text" name="account_number" id = "account_number"  <?php echo $read_only; ?> class = "form-control" 
													value = "<?php echo $customer_payment->getAccountNumber(); ?>">
													<label class="account_number">Account Number</label>
												</div>

												<div class="form-group floating-label">
													<input type="text" name="bank_name" id = "bank_name" <?php echo $read_only; ?> class = "form-control" 
													value = "<?php echo $customer_payment->getBankName(); ?>">
													<label class="bank_name">Bank Name </label>
												</div>

												<div class="form-group floating-label">
													<input type="text" name="routing_number" id = "routing_number" <?php echo $read_only; ?> class = "form-control" 
													value = "<?php echo $customer_payment->getRoutingNumber(); ?>">
													<label class="routing_number">Routing Number</label>
												</div>
											</div>
										</div>


										<!-- billing address -->
										<div class="form-group">
											<label><b>BILLING ADDRESS </b></label>
										</div>

										<div class="row">
											<div class="col-sm-12">
												<div class="form-group floating-label" >
													<input type="checkbox" id="same" name = "same" value="1" <?php echo $disabled; ?> <?php echo ($customer->getSame() == 1 ? "checked" : ""); ?> />
	  												<label for="test5">Same address as shipping</label>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group floating-label">
													<select name = "billing_country" class = "form-control" id = "billing_country" <?php echo $disabled; ?> >
													<option value="230">United States</option>
													<?php 
						  								foreach ($list_countries as $p ) : 
						  								
						  									$countries = new Countries();
						  									$countries->setCountryId($p['country_id']);
						  									$countries->setCountryName($p['country_name']);
						  							?>
							  							<option value ="<?php echo $countries->getCountryId(); ?>"
														<?php echo ($countries->getCountryId() == $customer->getBillingCountryId() ? "selected='selected'" : ""); ?>
							  							>
						  									<?php echo $countries->getCountryName(); ?>
						  								</option>
						  							<?php endforeach; ?>
													</select>
													<label class="billing_country">Billing Country</label>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group floating-label">
													<input type="text" name = "billing_address" class="form-control"  id="billing_address" value="<?php echo $customer->getBillingAddress(); ?>" <?php echo $disabled; ?> required>
													<label class="address">Billing Address</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<div class="form-group floating-label">
													<select name = "billing_state" class = "form-control" id = "billing_state" <?php echo $disabled; ?> required>
														<option></option>
														<?php $states = $db->select('state' , array('*') , "status = ?" , array(1));  foreach ($states as $s ): ?>
														<?php
															$state = new State();
															$state->setId($s['id']);
															$state->setCode($s['code']);
														?>
															<option value = "<?php echo $state->getId(); ?>"
																<?php echo ($state->getId() == $customer->getBillingStateId() ? "selected='selected'" : ""); ?>
															>
																<?php echo $state->getCode(); ?>
															</option>
														<?php endforeach; ?>
													</select>
													<label class="state">State</label>
												</div>
											</div>

											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="text" name = "billing_city" class="form-control" id="billing_city" <?php echo $disabled; ?> required value="<?php echo $customer->getBillingCity(); ?>">
													<label class="city">City</label>
												</div>
											</div>

											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="text" name = "billing_zip" class="form-control" id="billing_zip" <?php echo $disabled; ?> required value="<?php echo $customer->getBillingZip(); ?>" >
													<label class="zip">Zip</label>
												</div>
											</div>
										</div>
										<!-- end of billing address -->

										<div class="form-group">
											<label><b>REMARKS AND NOTES</b></label>
										</div>
										<div class="row">

											<div class="col-sm-12">
											<div class="form-group floating-label">
														<textarea class ="form-control" name = "remarks" <?php echo $read_only; ?> id = "remarks" rows = "5"><?php echo $order->getRemarks(); ?></textarea>
													<label class="notes">Remarks</label>
												</div>
											<!-- 	<div class="form-group floating-label">
														<input type="text" name="remarks" id = "remarks" class = "form-control" value="<?php echo $order->getRemarks(); ?>">
													<label class="remarks">Remarks</label>
												</div> -->
											</div>
											<div class="col-sm-12">
												<div class="form-group floating-label">
														<textarea class ="form-control" name = "notes" <?php echo $read_only; ?> id = "notes" rows = "5"><?php echo $order->getNotes(); ?></textarea>
													<label class="notes">Notes</label>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label><b>SALESPERSON</b></label>
										</div>
										<div class="row">

											<div class="col-sm-6">
												<div class="form-group floating-label">
													<input type="text"  id = "agent_name" class="form-control" readonly 
													value = "<?php echo ($form_state == 2 ? $get_preparedby[0][0] : $_SESSION['firstname']." ".$_SESSION['lastname']); ?>">
													<label class="agent_name">Prepared By/Salesperson</label>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group floating-label">
														<input type="text" id = "screen_name" class="form-control" readonly 
														value = "<?php echo ($form_state == 2 ? $get_preparedby[0][1] : $_SESSION['screen_name']); ?>">
														
														<label class="screen_name">Agent Screen Name</label>
												</div>
											</div>
										</div>
										
										<?php if(isset($_GET['add_tracking'])): 
											$style = "display:block;";  
											$submit_caption = "Add Tracking";
											$submit_name = "add_tracking_number";

										?>
											<div class="form-group">
												<label><b>TRACKING NUMBER</b></label>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group floating-label">
														<input type="text"  id = "tracking_number" name = "tracking_number" class="form-control" value = "<?php echo $order->getTrackingNumber(); ?>">
														<label class="tracking_number">Tracking Number</label>
													</div>
												</div>
											</div>
										<?php endif; ?>

										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
												<button type="submit" style="<?php echo $style; ?>" name = "<?php echo $submit_name; ?>" class="btn btn-info">
												<?php echo $submit_caption; ?></button>
												
											</div>
										</div>
											<?php
											if(isset($_GET['msg']))
											{
												$msg = $_GET['msg'];
												if($msg == 'inserted')
													$error = 'Record Successfully Saved';
												else if($msg == 'updated')
													$error = 'Record Successfully Updated';
												else if($msg == 'deleted')
													$error = 'Record Successfully Deleted';
												else if($msg == 'prev_deleted')
													$error = 'Record was deleted previously';
												else if($msg == 'none')
													$error = 'Sorry, the record selected does not exist.';
												echo '<span>'.$error.'</span>';
											}
										?>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</form>
						</div><!--end .card -->

					</div>
				</div>
			</div>
		</section>
	</div><!--end #content-->
	<!-- END CONTENT -->
</div>
<!-- END BASE -->
<?php
	include '../include/sidebar.php';
	include '../include/end.php';
?>

<script type="text/javascript">
	$(document).ready(function()
	{	
		var send_state = $("#send_display_state").val();
		if(send_state == 1)
			$(".ship_some_form").show();
		else
			$(".ship_some_form").hide();

		$("#send_to_someone").click(function() 
		{
		    if($(this).is(":checked")) 
		    {
		        $(".ship_some_form").show(); 
		    } 
		    else 
		    {
		        $(".ship_some_form").hide();
		    }
		});

		$('#order_date').datepicker({
    		
		});

		$("#card_details_view").hide();
		$("#check_details_view").hide();
		$("#savings_details_view").hide();

		var payment = $( "#payment_method option:selected" ).val();

		if(payment == 1)
		{
			$("#card_details_view").show();
			$("#check_details_view").hide();
			$("#savings_details_view").hide();
		}
		else if(payment == 2)
		{
			$("#card_details_view").hide();
	       	$("#check_details_view").show();
	       	$("#savings_details_view").hide();
		} 
		else if(payment == 3)
		{
			$("#card_details_view").hide();
	       	$("#check_details_view").hide();
	       	$("#savings_details_view").show();

		}
		$('#payment_method').change(function()
	       {
	       		payment = $( "#payment_method option:selected" ).val();
	       		if(payment == 1)
	       		{
	       			$("#card_details_view").show();
	       			$("#check_details_view").hide();
	       			$("#savings_details_view").hide();
	       		}
	       		if(payment == 2)
	       		{
	       			$("#card_details_view").hide();
			       	$("#check_details_view").show();
			       	$("#savings_details_view").hide();
	       		}
	       		else if(payment == 3)
	       		{
	       			$("#card_details_view").hide();
			       	$("#check_details_view").hide();
			       	$("#savings_details_view").show();
	       		}

	       }
	    );

		$( "#shipping_method" ).change(function() 
		{
			 var method = $( "#shipping_method option:selected" ).val();
			 if(method != null)
	       		{
	       			$.ajax({ 
					  type: "POST", 
					  url: "../process/ajax/get_specific_shipping.php", 
					  data: {"shipping": method} ,
					  success: function(data)
	                   {	
	                   		var parse = JSON.parse(data);
	                   		$(".shipping_fee").val(parse[0][0]);
	                   		//console.log(parse[0][0]);
	                   }
					}); 
	       		}
			
		});

	    
		 $('#customer_id').change(function()
	       {
	       		var customer = $( "#customer_id option:selected" ).val();
	       		if(customer != 'add-new-cust')
	       		{
	       			$("#customer-state").val(1);
	       			$.ajax({ 
					  type: "POST", 
					  url: "../process/ajax/get_specific_customer.php", 
					  data: {"customer": customer} ,
					  success: function(data)
	                   {	
	                   		var parse = JSON.parse(data);
	                   		for (var i = 0; i < parse.length; i++) 
	                   		{
	                   			console.log();
	                   			$("#firstname").val(parse[i].firstname).addClass("dirty");
	                   			$("#lastname").val(parse[i].lastname).addClass("dirty");
	                   			$("#contact_num").val(parse[i].contact_number).addClass("dirty");
	                   			$("#alternate_contact_num").val(parse[i].alternate_contact_number).addClass("dirty");
	                   			$("#email").val(parse[i].email).addClass("dirty");
	                   			$("#address").val(parse[i].shipping_address).addClass("dirty");
	                   			$("#city").val(parse[i].city).addClass("dirty");
	                   			$("#zip").val(parse[i].zip).addClass("dirty");


	                   			$('#country').val(parse[i].country_id);
								$('#country').trigger('change');
								$('[name=country] option').filter(function() 
								{ 
							    	return ($(this).val() == data.country_id);
								}).prop('selected', true);

								$('#state').val(parse[i].state_id);
								$('#state').trigger('change');
								$('[name=state] option').filter(function() 
								{ 
							    	return ($(this).val() == data.state_id);
								}).prop('selected', true);
	                   			

								$("#billing_address").val(parse[i].billing_address).addClass("dirty");
								$("#billing_city").val(parse[i].billing_city).addClass("dirty");
								$("#billing_zip").val(parse[i].billing_zip).addClass("dirty");


								$('#billing_country').val(parse[i].billing_country_id);
								$('#billing_country').trigger('change');
								$('[name=billing_country] option').filter(function() 
								{ 
							    	return ($(this).val() == parse[i].billing_country_id);
								}).prop('selected', true);

								$('#billing_state').val(parse[i].billing_state_id);
								$('#billing_state').trigger('change');
								$('[name=billing_state] option').filter(function() 
								{ 
							    	return ($(this).val() == parse[i].billing_state_id);
								}).prop('selected', true);

	                   		} 	
	                   }
					}); 
	       		}
	       		else
	       		{
       				$("#customer-state").val(0);
       				$("#firstname").val("").removeClass("dirty");
                   	$("#lastname").val("").removeClass("dirty");
                   	$("#contact_num").val("").removeClass("dirty");
                   	$("#alternate_contact_num").val("").removeClass("dirty");
                   	$("#email").val("").removeClass("dirty");
                   	$("#address").val("").removeClass("dirty");
                   	$("#city").val("").removeClass("dirty");
                   	$("#zip").val("").removeClass("dirty");


                   	$('#country').val(0);
					$('#country').trigger('change');
					$('[name=country] option').filter(function() 
					{ 
				 		return ($(this).val() == 230 );
					}).prop('selected', true);
					$("#country").addClass("dirty");

					$('#state').val(0);
					$('#state').trigger('change');


					$("#billing_address").val("").removeClass("dirty");
					$("#billing_city").val("").removeClass("dirty");
					$("#billing_zip").val("").removeClass("dirty");

					$('#billing_country').val(0);
					$('#billing_country').trigger('change');
					$('[name=billing_country] option').filter(function() 
					{ 
				 		return ($(this).val() == 230 );
					}).prop('selected', true);
					$("#billing_country").addClass("dirty");

					$('#billing_state').val(0);
					$('#billing_state').trigger('change');

					$("#same").prop('checked', false); 

	       		}
	            
		});//end of i

		$('#same').click(function()
		 {
	  		if ($(this).is(':checked')) 
	  		{
	    		
	       			var country = $('#country').val();
	       			var state = $("#state").val();
					var address = $("#address").val();
					var city = $("#city").val();
					var zip = $('#zip').val();

					$("#billing_address").val(address).addClass("dirty");
					$("#billing_city").val(city).addClass("dirty");
					$("#billing_zip").val(zip).addClass("dirty");


					$('#billing_country').val(country);
					$('#billing_country').trigger('change');
					$('[name=billing_country] option').filter(function() 
					{ 
				    	return ($(this).val() == country);
					}).prop('selected', true);

					$('#billing_state').val(state);
					$('#billing_state').trigger('change');
					$('[name=billing_state] option').filter(function() 
					{ 
				    	return ($(this).val() == state);
					}).prop('selected', true);
	  		} 
	  		else 
	  		{

	  			$("#billing_address").val("").removeClass("dirty");
				$("#billing_city").val("").removeClass("dirty");
				$("#billing_zip").val("").removeClass("dirty");

				$('#billing_country').val(0);
					$('#billing_country').trigger('change');
					$('[name=billing_country] option').filter(function() 
					{ 
				 		return ($(this).val() == 230 );
					}).prop('selected', true);
					$("#billing_country").addClass("dirty");

					$('#billing_state').val(0);
					$('#billing_state').trigger('change');
	    		
	  		}
		});

		var state = $("#form_state").val();
		if(state == 1)
		{
			  var counter = 0;
			  var qty = 0;
			  var price = 0.0;
			  var amount = 0.0;
			  var shipping = parseFloat($(".shipping_fee").val());
			  var total= 0.0;
			  var grand = 0.0;
			  $("#add_more_button").click(function()
			  {
	    			counter++;
	                var start = "<tr><td>";
	                var middle = "<select name = 'product[]' class = 'form-control item_list"+counter+" product"+counter+ " browser-default'>";
	                var end1 = "</select></td>"  + "<td><input type='text' name='quantity[]' class = 'form-control quantity"+counter+" browser-default' value='0.00' placeholder='Quantity' > </td>";
	                var end2 = "<td><input type = 'text' value='0.00' class = 'form-control lblUprice"+counter+"' name = 'unit_price[]' placeholder='Unit Price'></td>";
	                var end3 = "<td><input type = 'text' value='0.00' class = 'form-control lblAmount"+counter+"'  name = 'amount[]' placeholder='Amount'></td>";
	                var superEnd = "</tr>";
	                var combine = start + middle + end1 + end2  + end3 + superEnd;
	                $('.order-table tbody').prepend(combine);
		             $.ajax({
		                    type: "GET",
		                    url: '../process/ajax/get_items.php',
		                    data: 'json',
		                    success: function(data)
		                    {
		                       	var datas = JSON.parse(data);
		                        $('.product'+counter).append('<option disabled selected>Choose Items Here</option>');
		                        for (var i = 0; i < datas.length; i++) 
		                        {
		                            // $('.product'+counter).append('<option value='+datas[i].id+'>'+datas[i].product_description+ " --- Stock On Hand: " + datas[i].quantity + '</option>');
		                            $('.product'+counter).append('<option value='+datas[i].id+'>'+datas[i].product_description + '</option>');
		                            
		                        }
		                        $('.item_list'+counter).change(function()
		                         {	
		                            	$('.quantity'+counter).change(function () 
									  	{ 
									  		qty = parseInt($(".quantity"+counter).val());
									  		
									  		 $('.lblAmount'+counter).change(function () 
											  	{ 
											  		price = parseFloat($(".lblUprice"+counter).val());
											  		amount = parseFloat($(".lblAmount"+counter).val());
		                                            total = parseFloat($('.displayTotal').val());
		                                             // grand = parseFloat( total + amount + shipping);
		                                            grand = parseFloat( total + amount );
											  		$(".lblAmount"+counter).val(amount.toFixed(2));
											  		$(".displayTotal").val(grand.toFixed(2));
											  	}
											  );
									  	}
									  );
		                        });//end of item list
		                    }
		                }); // end of ajax                 
			  });
		
			   $('.item_list').change(function()
		       {
		            $('.quantity').change(function () 
				  	{ 
				  		qty = parseInt($(".quantity").val());
				  		 $('.lblAmount').change(function () 
						  	{ 
						  		price = parseFloat($(".lblUprice").val());
						  		amount = parseFloat($(".lblAmount").val());
						  		total = parseFloat(amount);
						  		//grand = parseFloat(total + shipping);
						  		grand = parseFloat(total);
						  		$(".lblAmount").val(amount.toFixed(2));
						  		$(".displayTotal").val(grand.toFixed(2) );
						  	}
						  );
				  	}
				  );
				});//end of item list	   
		}
		else
		{
			var counters= $("#counter_form").val();
			alert(state);
			   

		}



		  
	} );
</script>