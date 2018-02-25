<?php
	session_start();
	if($_SESSION['isLogin'] != true){
		header("location: ../index.php");
		exit;
	}
	include '../include/start.html';
	require('../include/header.php');
	require '../class/database.php';
	require '../class/refund.php';

	$refund_id = (isset($_GET["id"]) ? $_GET["id"] : "");
	$db = new Database();
	$refund = new Refund();

	$form_state = 1;
	$form_header = "Refund Entry";
	$submit_caption = "SAVE";
	$name = "save_entry";
	$msg = (isset($_GET["msg"]) ? $_GET["msg"] : "");

	$list_orders = $db->select('orders' , array('id' , 'invoice_number') , "status = 2 AND refunded = 0"); //status is being shipped already
	 
	if($refund_id)
	{
			if($msg != 'deleted')
			{
				$table = 'customer_refund';
				$fields = array('*');
				$where = " id = ? ";
				$params = array($refund_id);
				$refund_data = $db->select($table, $fields, $where, $params);

				if(count($refund_data))
				{
					foreach ($refund_data as $l)
					{
						$refund->setId($l['id']);
						$refund->setOrderId($l['order_id']);
						$refund->setDate($l['date']);
						$refund->setAmount($l['amount']);
						$refund->setStatus($l['status']);
					}
					if($refund->getStatus() == 1)
					{
						$form_state = 2;
						$form_header = "Edit Refund Details";
						$submit_caption = "Save Changes";
					}
					else
					{
						$refund = new Refund();
						$_GET["msg"] = "prev_deleted";
					}
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
							<div class="col-lg-offset-0 col-md-12">
								<div class="card-body style-default-bright">
									<div class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-11">
												<form class="form-horizontal" method = "post" action = '../process/refund_manage.php'>
													<input type="hidden" name="id" id="id" value="<?php echo $refund->getId(); ?>" />
													<div class="card-body" id="div-add-user">
														<div class="row">
															<div class="form-group">
																<label for="Email5" class="col-sm-2 control-label">Date</label>
																<div class="col-sm-10">
																	<input type="text" name = "date" class="form-control"  id="date"
																	value = "<?php 
																			if($form_state == 2)
																				echo date('m/d/Y' , strtotime($refund->getDate())); ?>" 
																		required>
																</div>
															</div>
														<div class="form-group">
															<label for="team" class="col-sm-2 control-label">Invoice Number</label>
															<?php if($form_state == 1): ?>
															<div class="col-sm-6">															<select name = "order_id"  class = "form-control" >
																	<option> </option> 
																	<?php foreach ($list_orders as $o ) : ?>
																		<option value="<?php echo $o['id']; ?>">
																			<?php echo $o['invoice_number']; ?>	
																		</option>
																	<?php endforeach; ?>
																</select>
															</div>
															<?php elseif($form_state == 2): ?>
															<div class="col-sm-6">
																<?php 
																	$table = 'orders';
																	$fields = array('invoice_number');
																	$where = " id = ? ";
																	$params = array($refund->getOrderId());
																	$inv = $db->select($table, $fields, $where, $params);
																?>
																<input type="hidden"  class="form-control"
																	name="previous_invoice" value="<?php echo $refund->getOrderId(); ?>">
																<input type="text" id = "previous" class="form-control"
																	name="inv" value="<?php echo $inv[0][0]; ?>">
																
																<select name = "order_id" id="select_order_id" class = "form-control" >
																	<option> </option> 
																	<?php foreach ($list_orders as $o ) : ?>
																		<option value="<?php echo $o['id']; ?>">
																			<?php echo $o['invoice_number']; ?>	
																		</option>
																	<?php endforeach; ?>
																</select>
															</div>
															<button id = "change" class = "btn btn-info">Change Invoice</button>
															<?php endif; ?>
														</div>
														<div class="form-group">
															<label for="Password5" class="col-sm-2 control-label">Amount</label>
															<div class="col-sm-10">
																<input type="text" name = "amount" class="form-control" id="amount"
																value = "<?php echo $refund->getAmount(); ?>" >
															</div>
														</div>
														<br />
														<div class="row">
															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
																<?php if($form_state == 2) $name = "update_refund"; ?>
																<button type="submit" name = <?php echo $name; ?> class="btn btn-info"><?php echo $submit_caption; ?></button>
															</div>
														</div>
													</div><!--end .card-body -->
												</form>
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
														else if($msg == 'user_exist')
															$error = 'User already exist.';
														echo '<span>'.$error.'</span>';
													}
												?>
											</div>
											<div class="col-xs-12 col-sm-12 col-lg-1"></div>
										</div>
									</div><!--end .card -->
								</div><!--end .col -->
								<div class="col-md-12">
								</div>
							</div>
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
		$('#previous').show();
		$('#select_order_id').hide();

		$( "#change" ).click(function(e) 
		{
			e.preventDefault();
		 	$('#select_order_id').show();
		 	$('#previous').hide();
		});	

		$('#date').datepicker({
    		
		});

			

	} );
</script>

