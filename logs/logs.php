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
								<header><i class="fa fa-fw fa-users"></i>Logs</header>
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
											<table class = "table display responsive nowrap" id = "lead-tbl">
												<thead>
													<th>#</th>
													<th>Invoice Number</th>
													<th>Date</th>
													<th>User</th>
													<th>Description</th>		
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
		var dataTable = $('#lead-tbl').DataTable(
	    {
			"bProcessing": true,
			"bServerSide": true,
				"responsive": true,
	        "sPaginationType": "full_numbers",
	        "order": [0,'desc'],
	            "ajax":{
	                url :"../process/ajax/logs_list.php", // json datasource
	                type: "get",  // method  , by default get
	            }
	    } );
	} );
</script>
