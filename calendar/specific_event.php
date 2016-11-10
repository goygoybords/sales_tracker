<?php
	session_start();
	if($_SESSION['isLogin'] != true){
		header("location: ../index.php");
		exit;
	}
	include '../include/start.html';
	require('../include/header.php');

	require '../class/database.php';
	require '../class/lead.php';
	require '../class/calendar_events.php';


	require '../model/lead_model.php';
	require '../model/calendar_events_model.php';


	$customer_id = (isset($_GET["id"]) ? $_GET["id"] : "");
	$event_id = (isset($_GET["event"]) ? $_GET["event"] : "");

	$events = new CalendarEvents();
	$leads = new Leads();
	$events_model = new Calendar_Events_Model(new Database());
	$lead_model = new Lead_Model(new Database());

	$form_state = 1;
	$form_header = "Join Event";
	$submit_caption = "Join Event";

	$msg = (isset($_GET["msg"]) ? $_GET["msg"] : "");
	if($customer_id)
	{
		$table = 'calendar_events';
		$fields = array('*');
		$where = " status = ? ";
		$params = array(1);
		$events_data = $events_model->get_all($table, $fields, $where, $params);

		$table = 'leads';
		$fields = array('companyname');
		$where = " id = ? AND status = ? ";
		$params = array($customer_id, 1);
		$company = $lead_model->get_by_id($table, $fields, $where, $params);
		foreach ($company as $c )
		{
			$leads->setId($customer_id);
			$leads->setCompanyname($c['companyname']);
		}
	}
	if($event_id && $customer_id )
	{
		$submit_caption = "Event Detail";
		$table = 'calendar_events';
		$fields = array('*');
		$where = " id = ? AND status = ? ";
		$params = array($event_id, 2);
		$events_data = $events_model->get_all($table, $fields, $where, $params);

		foreach ($events_data as $d )
		{
			$events->setEvent_name($d['event_name']);
		}

		$table = 'leads';
		$fields = array('companyname');
		$where = " id = ? AND status = ? ";
		$params = array($customer_id, 1);
		$company = $lead_model->get_by_id($table, $fields, $where, $params);
		foreach ($company as $c )
		{
			$leads->setId($customer_id);
			$leads->setCompanyname($c['companyname']);
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
													<input type="hidden" name="id" id="id" value="<?php echo $leads->getId(); ?>" />
													<div class="card-body" id="div-add-lead">
														<div class="form-group">
															<label for="Company" class="col-sm-2 control-label">Company</label>
															<div class="col-sm-10">
																<input type="text" name = "lead" class="form-control"  id="lead"
																value="<?php echo $leads->getCompanyname(); ?>" disabled autofocus='autofocus'>
															</div>
														</div>

														<div class="form-group">
															<label for="eventname" class="col-sm-2 control-label">Event Name</label>
															<div class="col-sm-10">
																<?php if(!$event_id) { ?>
																<select name = "event" class = "form-control" required>
																	<option value = "">Choose An Event</option>
																	<?php
																		foreach ($events_data as $l):

																			$events->setId($l['id']);
																			$events->setEvent_name($l['event_name']);
																	?>
																		<option value = "<?php echo $events->getId(); ?>" <?php ?> > <?php echo $events->getEvent_name(); ?></option>
																		<?php endforeach; ?>
																</select>
																<?php } else { ?>
																<input type="text" name = "event" class="form-control"  id="event"
																value="<?php echo $events->getEvent_name(); ?>" disabled autofocus='autofocus'>
																<?php } ?>
															</div>
														</div>


														<br />
														<div class="row">
															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
																<?php
																$disabled = "";
																if($event_id)
																	$disabled = "disabled";
																?>
																<button type="submit" name = "join_event" <?php echo $disabled; ?> class="btn btn-info"><?php echo $submit_caption; ?></button>
															</div>
														</div>
													</div><!--end .card-body -->
												</form>
													<?php
													if(isset($_GET['msg']))
													{
														$msg = $_GET['msg'];
														if($msg == 'joined')
															$error = 'Event Successfully Recorded';

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
