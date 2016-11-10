<?php
	session_start();
	if($_SESSION['isLogin'] != true){
		header("location: ../index.php");
		exit;
	}
	include '../include/start.html';
	require('../include/header.php');

	require '../class/database.php';
	require '../class/shipping_method.php';

	$db = new Database();
	$method = new Shipping_Method();

	$method_id = (isset($_GET["id"]) ? $_GET["id"] : "");
	$form_state = 1;
	$form_header = "Add Shipping Method";
	$submit_caption = "SAVE DETAILS";
	
	$name = "save_method";
	$msg = (isset($_GET["msg"]) ? $_GET["msg"] : "");
	
	if($method_id)
	{
			if($msg != 'deleted')
			{
				$table = 'shipping_method';
				$fields = array('*');
				$where = " id = ? and status = 1 ";
				$params = array($method_id);
				$methods = $db->select($table, $fields, $where, $params);

				if(count($methods))
				{
					foreach ($methods as $m)
					{
						$method->setId($method_id);
						$method->setDescription($m['description']);
						$method->setStatus($m['status']);
					}

					if($method->getStatus() == 1)
					{
						$form_state = 2;
						$form_header = "Edit Product Details";
						$submit_caption = "Save Changes";
					}
					else
					{
						$method = new Shipping_Method();
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
												<form class="form-horizontal" method = "post" action = '../process/method_manage.php'>
													<input type="hidden" name="method_id_fm" id="id" value="<?php echo $method->getId(); ?>" />
													<div class="card-body" id="div-add-user">
														<div class="form-group">
															<label for="Email5" class="col-sm-2 control-label">Description</label>
															<div class="col-sm-10">
																<input type="text" name = "description" class="form-control"  
																value = "<?php echo $method->getDescription(); ?>" required>
															</div>
														</div>
														
														<br />
														<div class="row">
															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
																<?php if($form_state == 2) $name = "update_method"; ?>
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
