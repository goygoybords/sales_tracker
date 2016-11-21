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
	require '../class/countries.php';

	$db = new Database();
	$customer_id = (isset($_GET["id"]) ? $_GET["id"] : "");

	$form_state = 1;
	$form_header = "Add New Customer";
	$submit_caption = "Save Details";
	$submit_name = "save_customer";
	
	$msg = (isset($_GET["msg"]) ? $_GET["msg"] : "");

	$customer = new Customer();
	
	$list_countries = $db->select('countries' , array("*"));
	if($customer_id)
	{
			if($msg != 'deleted')
			{
				$get_customer = $db->select('customer' , array("*"), "id = ?", array($customer_id ) );

				if(count($get_customer))
				{
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
						$customer->setStatus($c['status']);

					}
				
					$form_state = 2;
					$form_header = "Edit Order Details";
					$submit_caption = "Save Changes";
					$submit_name = "update_customer";
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

							<form class="form" method="POST" action="../process/customer_manage.php">
								<div class="">
									<div class="card-body">
										<br/>
										<div class="form-group">
											<label><b>CUSTOMER DETAILS</b></label>
										</div>

										<div class="row">
											<div class="col-sm-6">
												<div class="form-group floating-label">
													<input type="text" name = "firstname" class="form-control" id="firstname" value="<?php echo $customer->getFirstName(); ?>" >
													<label for="firstname">First Name</label>
												</div>
											</div>

											<div class="col-sm-6">
												<div class="form-group floating-label">
													<input type="text" name = "lastname" class="form-control" id="lastname" value="<?php echo $customer->getLastName(); ?>" >
													<label for="lastname">Last Name</label>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group floating-label">
													<input type="email" name = "email" class="form-control" id="email" value="<?php echo $customer->getEmail(); ?>" >
													<label for="email">Email Address</label>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group floating-label">
													<input type="text" name = "contact_num" class="form-control" id="contact_num" value="<?php echo $customer->getContactNumber(); ?>" required >
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
													<select name = "country" class = "form-control" id = "country" >
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
													<label class="country">Country</label>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group floating-label">
													<input type="text" name = "address" class="form-control"  id="address" value="<?php echo $customer->getShippingAddress(); ?>" required>
													<label class="address">Address</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<div class="form-group floating-label">
													<select name = "state" class = "form-control" id = "state" required>
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
													<input type="text" name = "city" class="form-control" id="city" required value="<?php echo $customer->getCity(); ?>">
													<label class="city">City</label>
												</div>
											</div>

											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="text" name = "zip" class="form-control" id="zip" required value="<?php echo $customer->getZip(); ?>" >
													<label class="zip">Zip</label>
												</div>
											</div>
										</div>
										<br />

										<br/>
										<div class="form-group">
											<label><b>CUSTOMER BILLING DETAILS</b></label>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group floating-label">
													<select name = "billing_country" class = "form-control" id = "billing_country" >
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
													<label class="billing_country">Billing Country</label>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group floating-label">
													<input type="text" name = "billing_address" class="form-control"  id="billing_address" value="<?php echo $customer->getShippingAddress(); ?>" required>
													<label class="address">Billing Address</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<div class="form-group floating-label">
													<select name = "billing_state" class = "form-control" id = "billing_state" required>
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
													<input type="text" name = "billing_city" class="form-control" id="billing_city" required value="<?php echo $customer->getCity(); ?>">
													<label class="city">City</label>
												</div>
											</div>

											<div class="col-sm-4">
												<div class="form-group floating-label">
													<input type="text" name = "billing_zip" class="form-control" id="billing_zip" required value="<?php echo $customer->getZip(); ?>" >
													<label class="zip">Zip</label>
												</div>
											</div>
										</div>
										<br />

										<input type="hidden" name="customer_id_fm" value="<?php echo $customer->getCustomerId(); ?>">

										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
												<button type="submit" name = "<?php echo $submit_name; ?>" class="btn btn-info"><?php echo $submit_caption; ?></button>
												
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
