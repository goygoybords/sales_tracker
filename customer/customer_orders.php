<?php
	session_start();
	if($_SESSION['isLogin'] != true){
		header("location: ../index.php");
		exit;
	}

	include '../include/start.html';
	require('../include/header.php');
	
	require '../class/database.php';
	require '../class/customer.php';


	$db = new Database();
	$customer_id = (isset($_GET["id"]) ? $_GET["id"] : "");
	$customer = new Customer();

	if($customer_id)
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
		}
		$get_orders = $db->select('orders', array('*'), 'customer_id = ?', array($customer_id))	;
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
								<header><i class="fa fa-fw fa-user-plus"></i> <?php echo $customer->getFirstName()." ".$customer->getLastName(); ?> Orders</header>
							</div><!--end .card-head -->

							<form class="form" >
								<div class="">
									<div class="card-body">
										<br/>
										<div class="form-group">
											<label><b>CUSTOMER DETAILS</b></label>
										</div>

										<div class="row">
											<div class="col-sm-6">
												<div class="form-group floating-label">
													<input type="text" name = "firstname" class="form-control" readonly id="firstname" value="<?php echo $customer->getFirstName(); ?>" >
													<label for="firstname">First Name</label>
												</div>
											</div>

											<div class="col-sm-6">
												<div class="form-group floating-label">
													<input type="text" name = "lastname" class="form-control" readonly id="lastname" value="<?php echo $customer->getLastName(); ?>" >
													<label for="lastname">Last Name</label>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group floating-label">
													<input type="email" name = "email" class="form-control" readonly id="email" value="<?php echo $customer->getEmail(); ?>" >
													<label for="email">Email Address</label>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group floating-label">
													<input type="text" name = "contact_num" class="form-control" readonly id="contact_num" value="<?php echo $customer->getContactNumber(); ?>" required >
													<label for="lastname">Contact Number</label>
												</div>
											</div>
										</div>
										<br/>
										<div class="form-group">
											<label><b>ORDERS</b></label>
										</div>
										<div class="row">
											<div class="col-lg-offset-0 col-md-12">
												<div class="card-body style-default-bright">
													<div class="card-body">
														<div class="col-lg-offset-0 col-md-12">
															<table class = "table display responsive nowrap" id = "lead-tbl">
																<thead>
																	<th>Invoice Number</th>
																	<th>Remarks</th>
																	<th>Total</th>
																	<th>Action</th>
																</thead>
																<tbody>
																	<?php foreach($get_orders as $o): ?>
																	<tr>
																		<td><?php echo "INV-".$o['id'];?></td>
																		<td><?php echo $o['remarks'];?></td>
																		<td><?php echo $o['total'];?></td>
																		<td> 
																		<a href="../orders/manage.php?id=<?php echo $o['id']; ?>&view" >
												                            <span class="label label-inverse" style = "color:black;">
												                                <i class="fa fa-edit"></i> View Record
												                            </span>
												                        </a> &nbsp;
												                        </td>
																	</tr>
																	<?php endforeach;?>
																</tbody>
															</table>
														</div>
													</div>
												</div><!--end .card -->
											</div><!--end .col -->
										</div>
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
		var dataTable = $('#lead-tbl').DataTable();
	} );
</script>