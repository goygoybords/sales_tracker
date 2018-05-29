<?php
	session_start();
	if($_SESSION['isLogin'] != true){
		header("location: ../index.php");
		exit;
	}

	include '../include/start.html';
	require('../include/header.php');
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
								<header><i class="fa fa-fw fa-users"></i>Unapproved Orders</header>
							</div><!--end .card-head -->
							<div class="col-lg-offset-0 col-md-12">
								<?php
								if(isset($_GET['msg']))
								{
									$msg = $_GET['msg'];
									if($msg == 'deleted')
										$error = 'Record Successfully Deleted';
									else if($msg == 'prev_deleted')
										$error = 'Record was deleted previously';
									else if($msg == 'none')
										$error = 'Sorry, the record selected does not exist.';
									else if($msg == 'blacklist')
										$error = 'Customer Record was blacklisted';
									else if($msg == 'approved')
										$error = 'Record Approved';
									echo '<span>'.$error.'</span>';
								}
							?>
							</div>
							<div class="col-lg-offset-0 col-md-12">
								<div class="card-body style-default-bright">
									<div class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
												<a class="btn btn-success btn-block" href="manage.php" name="btnAddLead" id="btnAddLead">ADD NEW ORDER</a>
											</div>
										</div>
										<br />
										<div class="col-lg-offset-0 col-md-12">
												<table class = "table display responsive nowrap" id = "lead-tbl">
													<thead>
														<th>Order ID</th>
														<th>Date</th>
														<th>Customer</th>
														<th>Contact #</th>
														<th>Remarks</th>
														<th>Notes</th>
														<th>Total</th>
														<th>Updated By</th>
														<th>Team</th>
														<th>Status</th>
														<th>Action</th>
													</thead>
												</table>
											</div>
										</div>
									</div><!--end .card -->
								</div><!--end .col -->
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
		$('#datetimepicker1').datepicker();
		$("#datetimepicker2").datepicker();
			
		var dataTable = $('#lead-tbl').DataTable(
	    {
	    	"aoColumns": [ 
	    	 	null, null, null, null, { "sClass": "long_text_edit" }, { "sClass": "long_text_edit" }, null,
		        null, null, null, null,
		        ],
			"bProcessing": true,
			"bServerSide": true,
				"responsive": true,
	        "sPaginationType": "full_numbers",
	        "iDisplayLength": 25,
	        "order": [0,'desc'],
	            "ajax":{
	                url :"../process/ajax/unapproved_order_list.php", // json datasource
	                type: "get",  // method  , by default get
	            }
	    } );
	} );
</script>

<style type="text/css">
			.dataTable th, .dataTable td {
			max-width: 80px;
			min-width: 70px;
			overflow: hidden;
			text-overflow: ellipsis;
			white-space: nowrap;
			}
		</style>
