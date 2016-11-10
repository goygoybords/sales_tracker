<div id="header">
	<!-- BEGIN HEADER-->
	<header>
		<div class="headerbar">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="headerbar-left">
				<ul class="header-nav header-nav-options">
					<li class="header-nav-brand" >
						<div class="brand-holder">
							<a href="">
								<span class="text-lg text-bold text-biz"><i class="fa fa-cube fa-fw"></i>CRM</span>
							</a>
						</div>
					</li>
					<li>
						<a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
							<i class="fa fa-bars"></i>
						</a>
					</li>
				</ul>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="headerbar-right">
				<ul class="header-nav header-nav-options">
					<li class="dropdown hidden-xs">
						<a href="javascript:void(0);" class="btn btn-icon-toggle btn-default" data-toggle="dropdown">
							<i class="fa fa-bell"></i>
						</a>
						<!--ul class="dropdown-menu animation-expand">
							<li class="dropdown-header">Today's messages</li>
							<li>
								<a class="alert alert-callout alert-warning" href="javascript:void(0);">
									<img class="pull-right img-circle dropdown-avatar" src="assets/img/avatar2.jpg?1404026449" alt="" />
									<strong>Alex Anistor</strong><br/>
									<small>Testing functionality...</small>
								</a>
							</li>
							<li>
								<a class="alert alert-callout alert-info" href="javascript:void(0);">
									<img class="pull-right img-circle dropdown-avatar" src="assets/img/avatar3.jpg?1404026799" alt="" />
									<strong>Alicia Adell</strong><br/>
									<small>Reviewing last changes...</small>
								</a>
							</li>
							<li class="dropdown-header">Options</li>
							<li><a href="../../html/pages/login.html">View all messages <span class="pull-right"><i class="fa fa-arrow-right"></i></span></a></li>
							<li><a href="../../html/pages/login.html">Mark as read <span class="pull-right"><i class="fa fa-arrow-right"></i></span></a></li>
						</ul--><!--end .dropdown-menu -->
					</li><!--end .dropdown -->
					<li class="dropdown hidden-xs">
						<ul class="dropdown-menu animation-expand">
							<li class="dropdown-header">Server load</li>
							<li class="dropdown-progress">
								<a href="javascript:void(0);">
									<div class="dropdown-label">
										<span class="text-light">Server load <strong>Today</strong></span>
										<strong class="pull-right">93%</strong>
									</div>
									<div class="progress"><div class="progress-bar progress-bar-danger" style="width: 93%"></div></div>
								</a>
							</li><!--end .dropdown-progress -->
							<li class="dropdown-progress">
								<a href="javascript:void(0);">
									<div class="dropdown-label">
										<span class="text-light">Server load <strong>Yesterday</strong></span>
										<strong class="pull-right">30%</strong>
									</div>
									<div class="progress"><div class="progress-bar progress-bar-success" style="width: 30%"></div></div>
								</a>
							</li><!--end .dropdown-progress -->
							<li class="dropdown-progress">
								<a href="javascript:void(0);">
									<div class="dropdown-label">
										<span class="text-light">Server load <strong>Lastweek</strong></span>
										<strong class="pull-right">74%</strong>
									</div>
									<div class="progress"><div class="progress-bar progress-bar-warning" style="width: 74%"></div></div>
								</a>
							</li><!--end .dropdown-progress -->
						</ul><!--end .dropdown-menu -->
					</li><!--end .dropdown -->
				</ul><!--end .header-nav-options -->
				<ul class="header-nav header-nav-profile">
					<li class="dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
							<span class="profile-info" id="profile-info">
								<?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?>
							</span>
						</a>
						<ul class="dropdown-menu animation-dock">
							<li><a href="../logout.php"><i class="fa fa-fw fa-power-off text-danger"></i> Logout</a></li>
						</ul><!--end .dropdown-menu -->
					</li><!--end .dropdown -->
				</ul><!--end .header-nav-profile -->
			</div><!--end #header-navbar-collapse -->
		</div>
	</header>
	<!-- END HEADER-->
</div>