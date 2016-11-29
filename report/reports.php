<?php
	session_start();
	if($_SESSION['isLogin'] != true){
		header("location: ../index.php");
		exit;
	}

	include '../include/start.html';
	require('../include/header.php');
	require '../class/database.php';
	$db = new Database();

	$list_agents = $db->select("users" , array('id', 'first_name', 'lastname') , "usertypeid = 3");
	$list_teams = $db->select("teams" , array('id, team_name'), 'status = 1' );

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
								<header><i class="fa fa-fw fa-users"></i> Orders</header>
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
									echo '<span>'.$error.'</span>';
								}
							?>
							</div>
							<div class="col-lg-offset-0 col-md-12">
								<div class="card-body style-default-bright">
									<div class="card-body">
										<br />
										<div class="col-lg-offset-0 col-md-12">
											<div id = "filters">
												<div class="row">
													
													<!-- date filters -->
													<div class="col-sm-6">
														<div class="form-group">
															<select name = "agents" class = "form-control dirty" id = "agents"  >
																<option></option>
																<?php foreach ($list_agents as $l ) :?>
																	<option value="<?php echo $l['id']; ?>"><?php echo $l['first_name']." ".$l['lastname'];?></option>
																<?php endforeach; ?>
															</select>
															<label class="Agent">Agent</label>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group ">
															<select name = "teams" class = "form-control dirty" id = "teams"  >
															<option></option>
																<?php foreach ($list_teams as $l ) :?>
																	<option value="<?php echo $l['id']; ?>">
																		<?php echo $l['team_name']; ?>
																	</option>
																<?php endforeach; ?>
															</select>
															<label class="Team/Group">Team/Group</label>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
											                <div class='input-group date' id='datetimepicker1'>
											                    <input type='text' id = "min" class="form-control" placeholder="From" />
											                    <span class="input-group-addon">
											                        <span class="glyphicon glyphicon-calendar"></span>
											                    </span>
											                </div>
											            </div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
											                <div class='input-group date' id='datetimepicker2'>
											                    <input type='text' id = "max" class="form-control" placeholder="To" />
											                    <span class="input-group-addon">
											                        <span class="glyphicon glyphicon-calendar"></span>
											                    </span>
											                </div>
											            </div>
													</div>
												</div>
											</div>
											<!-- <input type = "text" name = "filter" id = "filter"> -->
											<input type = "submit" id = "filteraction" value = "Apply Filter" class = "btn btn-success">
											<a href = "../process/export_orders.php" id = "export" class = "btn btn-success">Export To Excel</a>
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
														<th>Tracking Number</th>
														<th>Status</th>		
													</thead>
<!-- 									
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
	        "order": [1,'desc'],
	            "ajax":{
	                url :"../process/ajax/report_list.php", // json datasource
	                type: "get",  // method  , by default get
	            }


	    } );

	    $( "#filteraction" ).click(function() 
		{
			var min = $("#min").val();
			var max = $("#max").val();
			var agent = $( "#agents option:selected" ).val();
			var team = $( "#teams option:selected" ).val();

			$("#export").attr("href", "http://www.google.com/")
		
			var data = dataTable.ajax.url( "../process/ajax/report_list_filter.php?min="+min+"&max="+max+"&agent="+agent).load();
		});

	   //  $("#employee-grid_filter").css("display","none");

	   //  $('.search-input-text').on( 'keyup click', function () {   // for text boxes
				// 	var i =$(this).attr('data-column');  // getting column index
				// 	var v =$(this).val();  // getting search input value
				// 	dataTable.columns(i).search(v).draw();
				// } );
	} );
</script>
