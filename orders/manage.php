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

	$db = new Database();
	$order_id = (isset($_GET["id"]) ? $_GET["id"] : "");

	$form_state = 1;
	$form_header = "Add New Order";
	$submit_caption = "Save Order";
	$submit_name = "save_order";
	
	$list_product = $db->select("products", array("*"), "status = ?" , array(1));
	$list_countries = $db->select("countries" , array("*"));
	$list_methods = $db->select("shipping_method", array("*") , "status = 1");
	$list_customer = $db->select("customer" , array('id' , 'firstname' , 'lastname'), "status = 1");
	
	$msg = (isset($_GET["msg"]) ? $_GET["msg"] : "");

	$order = new Order();
	$customer = new Customer();
	$order->setShippingFee(5.00);

	if(isset($_GET['view']))
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
						$order->setOrderDate(date('Y-m-d', $o['order_date']));
						$order->setCustomerId($o['customer_id']);
						$order->setTotal($o['total']);
						$order->setShippingMethodId($o['shipping_method_id']);
						$order->setShippingFee($o['shipping_fee']);
						$order->setRemarks($o['remarks']);
						$order->setNotes($o['notes']);
						$order->setPreparedBy($o['prepared_by']);
						$order->setStatus($o['status']);
					}
					$get_customer = $db->select('customer' , array("*"), "id = ?", array($order->getCustomerId() ) );
					foreach ($get_customer as $c ) 
					{
						$customer->setCustomerId($c['id']);
						$customer->setFirstname($c['firstname']);
						$customer->setLastname($c['lastname']);
						$customer->setEmail($c['email']);
						$customer->setContactNumber($c['contact_number']);
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
					$get_orders = $db->select('order_detail' , array("*"), "order_id = ? AND status = 1" , array($order->getOrderId() ) );

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
											<div class="col-sm-6">
												<div class="form-group floating-label">
													<input type="email" name = "email" class="form-control" <?php echo $read_only; ?> id="email" value="<?php echo $customer->getEmail(); ?>" >
													<label for="email">Email Address</label>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group floating-label">
													<input type="text" name = "contact_num" class="form-control" <?php echo $read_only; ?> id="contact_num" value="<?php echo $customer->getContactNumber(); ?>" required >
													<label for="lastname">Contact Number</label>
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

										<input type="hidden" name="customer_id_fm" value="<?php echo $customer->getCustomerId(); ?>">
										<input type="hidden" name="order_id_fm" value = "<?php echo $order->getOrderId(); ?>">
	

										<div class="form-group">
											<label><b>ORDER DETAILS</b></label>
										</div>
										<div class = "row">
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
												  							?>
												  								<option value ="<?php echo $product->getProductId(); ?>" >
												  									<?php echo $product->getProductDescription(); ?>
												  										
												  									</option>
												  							<?php endforeach;  ?>
												  					</select>
									  							</td>
									  							<td>
									  								<input type="text" name="quantity[]" <?php echo $read_only; ?> class = "form-control quantity browser-default" placeholder="Quantity" >		
												  				</td>
									  							<td><input type = "text" class = "form-control lblUprice" name = "unit_price[]" placeholder="Unit Price"></td>
									  							<td><input type = "text" class = "form-control lblAmount" readonly name = "amount[]" placeholder="Amount"></td>
									  						</tr>

								  						<?php elseif ($form_state == 2): ?>
								  							<?php 

								  								foreach ($get_orders as $g ): 
								  									$details = new Order_Details();
								  									$details->setProductId($g['product_id']);
								  									$details->setQuantity($g['quantity']);
								  									$details->setUnitPrice($g['unit_price']);
								  									$details->setAmount($g['amount']);

								  							?>
									  							<tr>
										  							<td>
										  								<select  name = "product[]" <?php echo $disabled; ?> class = "form-control item_list browser-default">
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
										  								<input type="text" name="quantity[]" <?php echo $read_only; ?> class = "form-control quantity browser-default" placeholder="Quantity" 
										  								value = "<?php echo $details->getQuantity();  ?>">		
													  				</td>
										  							<td>
										  								<input type = "text" class = "form-control lblUprice" readonly name = "unit_price[]" placeholder="Unit Price" 
										  								value = "<?php echo $details->getUnitPrice(); ?>">
										  							</td>
										  							<td>
										  								<input type = "text" class = "form-control lblAmount" readonly name = "amount[]" placeholder="Amount" 
										  								value="<?php echo $details->getAmount(); ?>">
										  								</td>
										  						</tr>
										  					<?php endforeach; ?>
								  						<?php endif; ?>
								  						
								  						<tr>
								  							<td></td>
								  							<td></td>
								  							<td>Shipping Fee:</td>
								  							<td>
								  								<input type = "text" class = "form-control shipping_fee" name = "shipping" readonly value = "<?php echo $order->getShippingFee(); ?>">
								  							</td>
								  						</tr>
								  						<tr>
								  							<td></td>
								  							<td></td>
								  							<td>Total:</td>
								  							<td><input type = "text" name = "total" class = "form-control displayTotal" readonly placeholder = "Total" value="<?php echo $order->getTotal(); ?>"></td>
								  						</tr>
								  					</tbody>
											</table>
											</div>
										</div>

										<div class="form-group">
											<label><b>SHIPPING METHOD</b></label>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group floating-label">
													<select name = "shipping_method" class = "form-control" <?php echo $disabled; ?> id = "shipping_method" required>
														<?php foreach ($list_methods as $m ): 
															$method = new Shipping_Method();
															$method->setId($m['id']);
															$method->setDescription($m['description']);
														?>
															<option value = "<?php echo $method->getId(); ?>"> 
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
														<option value = "1">Credit Card</option>
														<option value = "2">Direct Debit</option>
														<option value = "3">Check Payment</option>
													</select>
													<label class="method">Payment Method</label>
												</div>
											</div>
										</div>

										<div class="row">
    										<div class="col-sm-6">
												<div class="form-group floating-label">
													<select name="card_type" class = "form-control" id = "card_type">
												    	<option value="MasterCard">MasterCard</option>
												      	<option value="American Express">American Express</option>
												      	<option value="Carte Blanche">Carte Blanche</option>
												      	<option value="Diners Club">Diners Club</option>
													    <option value="Discover">Discover</option>
													    <option value="Enroute">enRoute</option>
													    <option value="JCB">JCB</option>
													    <option value="Maestro">Maestro</option>
													    <option value="MasterCard">MasterCard</option>
													    <option value="Solo">Solo</option>
													    <option value="Switch">Switch</option>
													    <option value="Visa">Visa</option>
													    <option value="Visa Electron">Visa Electron</option>
													    <option value="LaserCard">Laser</option>
												    </select>
													<label class="card_type">Card Type</label>
												</div>
											</div> 
											<div class="col-sm-6">
												<div class="form-group floating-label">
													<input type="text" name="cardholder" class = "form-control">
													<label class="card_holder">Card Holders Name</label>
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
													<input type="text" name="agent_name" id = "agent_name" class="form-control" readonly value = "">
													<label class="agent_name">Prepared By/Salesperson</label>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group floating-label">
														<input type="text" name="screen_name" id = "screen_name" class="form-control" readonly value = "">
														<label class="screen_name">Agent Screen Name</label>
													
												</div>
											</div>
										</div>
									
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
                var end1 = "</select></td>"  + "<td><input type='text' name='quantity[]' class = 'form-control quantity"+counter+" browser-default' placeholder='Quantity' > </td>";
                var end2 = "<td><input type = 'text' class = 'form-control lblUprice"+counter+"' name = 'unit_price[]' placeholder='Unit Price'></td>";
                var end3 = "<td><input type = 'text' class = 'form-control lblAmount"+counter+"' readonly name = 'amount[]' placeholder='Amount'></td>";
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
	                            $('.product'+counter).append('<option value='+datas[i].id+'>'+datas[i].product_description+'</option>');
	                            
	                        }
	                        $('.item_list'+counter).change(function()
	                         {
	                         	var item = $(".item_list"+counter+" option:selected").val();
					       	  	$.ajax({
				                        type: "POST",
				                        url: '../process/ajax/get_specific_item.php',
				                        data: { item: item },
				                        success: function(data)
				                        {   
				                        	var parse = JSON.parse(data);
				                            parseFloat($('.lblUprice'+counter).val(parse[0].product_price));
				                            // // compute amount
				                             $('.quantity'+counter).change(function()
				                             {

				                             	qty = parseInt($(".quantity"+counter).val());
				                             	price = parseFloat($(".lblUprice"+counter).val());
										  		amount = parseFloat(qty * price);
	                                                // compute total
	                                                //total = parseFloat($('.displayTotal').val());
	                                             grand = parseFloat( total + amount + shipping);
	                                                // grand = parseFloat(total);
										  		$(".lblAmount"+counter).val(amount.toFixed(2));
										  		$(".displayTotal").val(grand.toFixed(2));
				                            });
				                        }
				                    }); // end of ajax   
	                        });//end of item list
	                    }
	                }); // end of ajax                 
		  });

		  $('.item_list').change(function()
	       {
	       		var item = $(".item_list option:selected").val();
	       	  	$.ajax({
                        type: "POST",
                        url: '../process/ajax/get_specific_item.php',
                        data: { item: item },
                        success: function(data)
                        {   
                        	var parse = JSON.parse(data);
                            parseFloat($('.lblUprice').val(parse[0].product_price));
                            // // compute amount
                             $('.quantity').change(function()
                             {

                             	qty = parseInt($(".quantity").val());
                          		price = $(".lblUprice").val();
                           
                             	amount = parseFloat(qty * price);
					  			total = parseFloat(amount);
					  			grand = parseFloat(total + shipping);
					  	
						  		$(".lblAmount").val(amount.toFixed(2));
						  		$(".displayTotal").val(grand.toFixed(2) );
                            });
                        }
                    }); // end of ajax   
			});//end of item list	




	} );
</script>