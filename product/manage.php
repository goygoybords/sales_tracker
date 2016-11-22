<?php
	session_start();
	if($_SESSION['isLogin'] != true){
		header("location: ../index.php");
		exit;
	}
	include '../include/start.html';
	require('../include/header.php');

	require '../class/database.php';
	require '../class/product.php';

	$db = new Database();
	$product = new Product();

	$product_id = (isset($_GET["id"]) ? $_GET["id"] : "");
	$form_state = 1;
	$form_header = "Add Product";
	$submit_caption = "SAVE DETAILS";
	
	$name = "save_product";
	$msg = (isset($_GET["msg"]) ? $_GET["msg"] : "");

	if($_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 4)
		$disabled = "disabled";
	else 
		$disabled = "";
	
	if($product_id)
	{
			if($msg != 'deleted')
			{
				$table = 'products';
				$fields = array('*');
				$where = " id = ? and status = 1 ";
				$params = array($product_id);
				$products = $db->select($table, $fields, $where, $params);

				if(count($products))
				{
					foreach ($products as $p)
					{
						$product->setProductId($product_id);
						$product->setProductDescription($p['product_description']);
						$product->setProductPrice(doubleval($p['product_price']));
						$product->setStatus($p['status']);					
					}

					if($product->getStatus() == 1)
					{
						$form_state = 2;
						$form_header = "Edit Product Details";
						$submit_caption = "Save Changes";
					}
					else
					{
						$user = new User();
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
												<form class="form-horizontal" method = "post" action = '../process/product_manage.php'>
													<input type="hidden" name="product_id_fm" id="id" value="<?php echo $product->getProductId(); ?>" />
													<div class="card-body" id="div-add-user">
														<div class="form-group">
															<label for="Email5" class="col-sm-2 control-label">Description</label>
															<div class="col-sm-10">
																<input type="text" name = "description" class="form-control"  
																value = "<?php echo $product->getProductDescription(); ?>" <?php echo $disabled; ?> required>
															</div>
														</div>
														<div class="form-group">
															<label for="Email5" class="col-sm-2 control-label">Price</label>
															<div class="col-sm-10">
																<input type="text" name = "price" class="form-control"  
																value = "<?php echo $product->getProductPrice();  ?>" <?php echo $disabled; ?> required>
															</div>
														</div>
														
														<br />
														<div class="row">
															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
																<?php if($form_state == 2) $name = "update_product"; ?>
																<button type="submit" <?php echo $disabled; ?> name = <?php echo $name; ?> class="btn btn-info"><?php echo $submit_caption; ?></button>
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
