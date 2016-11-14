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
				<section>
					<div class="section-header">
						<ol class="breadcrumb">
							<li class="active">Calendar</li>
						</ol>
					</div>
					<div class="section-body">
						<div class="row">
							<!-- BEGIN CALENDAR -->
							<div class="col-sm-12">
								<div class="card">
									<div class="card-head style-primary">
										<header>
											<span class="selected-day">&nbsp;</span> &nbsp;<small class="selected-date">&nbsp;</small>
										</header>
										<div class="tools">
											<div class="btn-group">
												<a id="calender-prev" class="btn btn-icon-toggle ink-reaction"><i class="fa fa-angle-left"></i></a>
												<a id="calender-next" class="btn btn-icon-toggle ink-reaction"><i class="fa fa-angle-right"></i></a>
											</div>
											<div class="btn-group pull-right">
											</div>
										</div>
										<ul class="nav nav-tabs tabs-text-contrast tabs-accent" data-toggle="tabs">
											<li data-mode="month" class="active"><a href="#">Month</a></li>
											<li data-mode="agendaWeek"><a href="#">Week</a></li>
											<li data-mode="agendaDay"><a href="#">Day</a></li>
										</ul>
									</div><!--end .card-head -->
									<div class="card-body no-padding">
										<div id="calendar"></div>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
							<!-- END CALENDAR -->

						</div><!--end .row -->
					</div><!--end .section-body -->
				</section>
			</div><!--end #content-->

			<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button> -->
			<!-- Modal -->
				<div id="calendarModal" class="modal fade">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Event Details</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-11">
										
											<div class="card-body" id="div-add-lead">
												<div class="form-group">
													<label for="event_title" class="col-sm-2 control-label">Event:</label>
													<div class="col-sm-10">
														<input type="text" name = "eventname" class="form-control"  id="cal_event_title"
														value="" readonly="">
													</div>
												</div>
												<div class="form-group">
													<label for="event_title" class="col-sm-2 control-label">Description:</label>
													<div class="col-sm-10">
														<input type="text" name = "eventname" class="form-control"  id="cal_description"
														value="" readonly="">
													</div>
												</div>
												<div class="form-group">
													<label for="event_title" class="col-sm-2 control-label">Start:</label>
													<div class="col-sm-10">
														<input type="text" name = "eventname" class="form-control"  id="cal_start"
														value="" readonly="">
													</div>
												</div>
												<div class="form-group">
													<label for="event_title" class="col-sm-2 control-label">End:</label>
													<div class="col-sm-10">
														<input type="text" name = "eventname" class="form-control"  id="cal_end"
														value="" readonly="">
													</div>
												</div>
												
											</div>
									</div>
								</div>
													
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
							</div>
						</div>
					</div>
				</div>
			
			<!-- END CONTENT -->
		</div>
		<!-- END BASE -->
		<?php
			include '../include/sidebar.php';
			include '../include/end.php';
		?>


	