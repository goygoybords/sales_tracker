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
								<header><i class="fa fa-fw fa-users"></i>Approved Orders</header>
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
									else if($msg == 'approved')
										$error = 'Record Approved';
									else if($msg == 'sent')
										$error = 'Mail Sent';
									echo '<span>'.$error.'</span>';
								}
							?>
							</div>
							<div class="col-lg-offset-0 col-md-12">
								<div class="card-body style-default-bright">
									<div class="card-body">
									
										<div class="col-lg-offset-0 col-md-12">
											
												<br/>
												<br/>
												<table class = "table display responsive nowrap" id = "lead-tbl">
													<thead>
														<th>Invoice Number</th>
														<th>Date</th>
														<th>Customer</th>
														<th>Total</th>
														<th>Shipping Method</th>
														<th>Remarks</th>
														<th>Notes</th>
														<th>Prepared By/Salesperson</th>
														<th>Approved By</th>
														<th>Tracking Number</th>
														<th>Action</th>
													</thead>
<!-- 													<tfoot>
														<tr>
															<td><input type="text" data-column="0"  placeholder = "Search ID" class="search-input-text"></td>
															<td><input type="text" data-column="1"  placeholder = "Search Lead Status" class="search-input-text"></td>
															<td><input type="text" data-column="2"  placeholder = "Search Name" class="search-input-text"></td>
															<td><input type="text" data-column="3"  placeholder = "Search Position" class="search-input-text"></td>
															<td><input type="text" data-column="4"  placeholder = "Search SI Code" class="search-input-text"></td>
															<td><input type="text" data-column="5"  placeholder = "Search Address" class="search-input-text"></td>
															<td></td>
														</tr>
													</tfoot> -->
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
			"bProcessing": true,
			"bServerSide": true,
				"responsive": true,
	        "sPaginationType": "full_numbers",
	        "order": [0,'desc'],
	            "ajax":{
	                url :"../process/ajax/approved_order_list.php", // json datasource
	                type: "get",  // method  , by default get
	            }


	    } );

	   //  $("#employee-grid_filter").css("display","none");

	   //  $('.search-input-text').on( 'keyup click', function () {   // for text boxes
				// 	var i =$(this).attr('data-column');  // getting column index
				// 	var v =$(this).val();  // getting search input value
				// 	dataTable.columns(i).search(v).draw();
				// } );
	} );
</script>
