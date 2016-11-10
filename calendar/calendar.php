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
			<!-- END CONTENT -->
		</div>
		<!-- END BASE -->
		<?php
			include '../include/sidebar.php';
			include '../include/end.php';
		?>


	