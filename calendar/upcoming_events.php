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
	require '../model/calendar_events_model.php';

	$event_model = new Calendar_Events_Model(new Database());
		// $table = 'calendar_events';
		// $fields = array('*');
		// $where = "status = ? ORDER BY datecreated DESC";
		// $params = array(1);
	$event_data = $event_model->get_all_join();
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
										<!-- <div class="row">
											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
												<a class="btn btn-success btn-block" href="manage.php" name="btnAddUser" id="btnAddUser">Create Calendar Events</a>
											</div>
										</div> -->
										<br />
										<div class="col-lg-offset-0 col-md-12">
											<div class = "row" >
												<table class = "display responsive nowrap" id = "event-tbl">
													<thead>
														<th>Date Created</th>
														<th>Customer</th>
														<th>Event Type</th>
														<th>Event Name</th>
														<th>Start Date</th>
														<th>End Date</th>
														<th>Action</th>
													</thead>
													<tbody>
														<?php foreach ($event_data as $e ) : ?>

														<?php
															$events = new CalendarEvents();
															$events->setDatecreated(date('Y-m-d', $e['datecreated']));
															$events->setEventType($e['event_type']);
															$events->setEvent_name($e['event_name']);
															$events->setStart_date(date('Y-m-d' , $e['start_date']));
															$events->setEnd_date(date('Y-m-d' , $e['end_date']));
															$events->setId($e['id']);
														?>
															<tr>
																<td><?php echo $events->getDatecreated(); ?></td>
																<td><?php echo $e['companyname']; ?></td>
																<td>
																	<?php 
																		if( $events->getEventType() == 1 ) echo "Task";
																		else if( $events->getEventType() == 2 ) echo "Appointment";  
																	?>
																</td>
																<td><?php echo $events->getEvent_name(); ?></td>
																<td><?php echo $events->getStart_date(); ?></td>
																<td><?php echo $events->getEnd_date();  ?></td>
																<td>
																	<a href="../process/events_manage.php?id=<?php echo $events->getId(); ?>" >
																		<span class="label label-inverse" style = "color:black;">
																			<i class="fa fa-edit"></i> Finish
																		</span>
																	</a>
																	<!--  <a href="../process/lead_manage.php?id='.$d.'&p=list&del"
																	 onclick="return confirm(\'Are you sure you want to delete this record?\')" >
											                            <span class="label label-inverse" style = "color:black;">
											                                <i class="fa fa-remove"></i> Delete
											                            </span>
											                        </a> -->
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
