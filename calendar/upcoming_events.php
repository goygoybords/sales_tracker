<?php
	session_start();
	if($_SESSION['isLogin'] != true){
		header("location: ../index.php");
		exit;
	}

	include '../include/start.html';
	require('../include/header.php');

	require '../class/database.php';
	require '../class/calendar_events.php';


	$db = new Database();
		$table = 'calendar_events';
		$fields = array('*');
		$where = "status = ? ORDER BY 1 DESC";
		$params = array(1);

		$event_data = $db->select($table, $fields, $where, $params);   
           
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
								<header><i class="fa fa-fw fa-users"></i> Calendar Events</header>
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
									echo '<span>'.$error.'</span>';
								}
							?>
							</div>
							<div class="col-lg-offset-0 col-md-12">
								<div class="card-body style-default-bright">
									<div class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
												<a class="btn btn-success btn-block" href="manage.php" name="btnAddUser" id="btnAddUser">Create Calendar Event</a>
											</div>
										</div>
										<br />
										<div class="col-lg-offset-0 col-md-12">
											<div class = "row" >
												<table class = "display responsive nowrap" id = "event-tbl">
													<thead>
														<th>Event Name</th>
														<th>Start Date</th>
														<th>End Date</th>
														<th>Action</th>
													</thead>
													<tbody>
														<?php foreach ($event_data as $e ) : ?>

														<?php
															$events = new CalendarEvents();
															$events->setEventName($e['event_name']);
															$events->setStartDate(date('Y-m-d' , strtotime($e['start_date'])));
															$events->setEndDate(date('Y-m-d' , strtotime($e['end_date'])));
															$events->setId($e['id']);
														?>
															<tr>
																<td><?php echo $events->getEventName(); ?></td>
																<td><?php echo $events->getStartDate(); ?></td>
																<td><?php echo $events->getEndDate();  ?></td>
																<td>
																	<a href="manage.php?id=<?php echo $events->getId(); ?>" >
																		<span class="label label-inverse" style = "color:black;">
																			<i class="fa fa-edit"></i> Edit
																		</span>
																	</a>
																	 <a href="../process/events_manage.php?id=<?php echo $e['id']; ?>&p=list&del" 
																	 onclick="return confirm('Are you sure you want to delete this record?')" >
											                            <span class="label label-inverse" style = "color:black;">
											                                <i class="fa fa-remove"></i> Delete
											                            </span>
											                        </a>
																	 
																</td>
															</tr>
														<?php endforeach; ?>
													</tbody>
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
	    $('#event-tbl').DataTable(
	    {
			// "bProcessing": true,
			// "bServerSide": true,
				"responsive": true,
	        "sPaginationType": "full_numbers",
	         "order": [0,'desc'],
	            // "ajax":{
	            //     url :"../process/lead_list2.php", // json datasource
	            //     type: "get",  // method  , by default get
	            // }
	    } );
	} );
</script>
