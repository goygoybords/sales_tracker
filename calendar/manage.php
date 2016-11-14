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


	$event_id = (isset($_GET["id"]) ? $_GET["id"] : "");
	$db = new Database();
	$events = new CalendarEvents();
	
	$form_state = 1;
	$form_header = "Create Calendar Event";
	$submit_caption = "Create Event";

	$msg = (isset($_GET["msg"]) ? $_GET["msg"] : "");
	if($event_id)
	{
			if($msg != 'deleted')
			{
				$table = 'calendar_events';
				$fields = array('*');
				$where = " id = ? ";
				$params = array($event_id);
				$events_data = $db->select($table, $fields, $where, $params);

				if(count($events_data))
				{
					foreach ($events_data as $l)
					{
						$events->setId($l['id']);
						$events->setEventName($l['event_name']);
						$events->setDescription($l['description']);
						$events->setStartDate(date('m/d/Y', $l['start_date']));
						$events->setEndDate(date('m/d/Y', $l['end_date']));
						$events->setStatus($l['status']);
					}

					if($events->getStatus() == 1)
					{
						$form_state = 2;
						$form_header = "Edit Event Details";
						$submit_caption = "Save Changes";
					}
					else
					{
						$events = new CalendarEvents();
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
												<form class="form-horizontal" method = "post" action = '../process/events_manage.php'>
													<input type="hidden" name="id" id="id" value="<?php echo $events->getId(); ?>" />
													<div class="card-body" id="div-add-lead">
														<div class="form-group">
															<label for="eventname" class="col-sm-2 control-label">Event Name</label>
															<div class="col-sm-10">
																<input type="text" name = "eventname" class="form-control"  id="eventname"
																value="<?php echo $events->getEventName(); ?>" required autofocus='autofocus'>
															</div>
														</div>
														<div class="form-group">
															<label for="eventname" class="col-sm-2 control-label">Description</label>
															<div class="col-sm-10">
																<input type="text" name = "description" class="form-control"  id="description"
																value="<?php echo $events->getDescription(); ?>" required >
															</div>
														</div>

														<div class="form-group">
															<label for="start_date" class="col-sm-2 control-label">Start Date</label>
															<div class="col-sm-10">
																<div class="input-group date" data-provide="datepicker">
																	<div class="input-group-content">
																		<input class="form-control static" name="start_date" id="datepicker"
																		value="<?php echo $events->getStartDate(); ?>" type="text">
																	</div>
																	<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																</div>
															</div>
														</div>

														<div class="form-group">
															<label for="end_date" class="col-sm-2 control-label">End Date</label>
															<div class="col-sm-10">
																<div class="input-group date" data-provide="datepicker">
																	<div class="input-group-content">
																		<input class="form-control static" name="end_date" id="datepicker"
																		value="<?php echo $events->getEndDate(); ?>" type="text">
																	</div>
																	<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																</div>
															</div>
														</div>

														<br />
														<div class="row">
															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
																<?php
																	if($form_state == 1)
																		$txt_name = "create_event";
																	else if($form_state == 2)
																		$txt_name = "update_event";
																?>
																<button type="submit" name = "<?php echo $txt_name; ?>" class="btn btn-info"><?php echo $submit_caption; ?></button>
																
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
	include '../include/end.html';
?>
