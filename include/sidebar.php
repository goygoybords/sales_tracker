<div id="sidebar">
	<!-- BEGIN MENUBAR-->
	<div id="menubar" class="menubar-inverse ">
		<div class="menubar-fixed-panel">
			<div>
				<a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
					<i class="fa fa-bars"></i>
				</a>
			</div>
			<div class="expanded">
				<a href="../search/search.php">
					<span class="text-lg text-bold text-primary ">Vina Business System</span>
				</a>
			</div>
		</div>
		<div class="menubar-scroll-panel">

			<!-- BEGIN MAIN MENU -->
			<ul id="main-menu" class="gui-controls">
				
				<li class="gui-folder">
					<a>
						<div class="gui-icon"><i class="fa fa-list-alt"></i></div>
						<span class="title">Orders</span>
					</a>
					<!--start submenu -->
					<ul>
						<li>
							<a href="../orders/unapproved_orders.php">
								<span class="title">Hold Orders</span>
							</a>
						</li>
						<li>
							<a href="../orders/approved_orders.php">
								<span class="title">Approved Orders</span>
							</a>
						</li>

					</ul><!--end /submenu -->
				</li><!--end /menu-li -->
				
				<li class="gui-folder">
					<a>
						<div class="gui-icon"><i class="fa fa-list-alt"></i></div>
						<span class="title">Customers</span>
					</a>
					<!--start submenu -->
					<ul>
						<li>
							<a href="../customer/customer.php">
								<span class="title">Customers</span>
							</a>
						</li>
						<li>
							<a href="../customer/blacklist_customer.php">
								<span class="title">Blacklist Customers</span>
							</a>
						</li>

					</ul><!--end /submenu -->
				</li><!--end /menu-li -->

				

				<li>
					<a href="../product/product.php">
						<div class="gui-icon"><i class="fa fa-list-alt"></i></div>
						<span class="title">Product</span>
					</a>
				</li>

				<li class="gui-folder">
					<a>
						<div class="gui-icon"><i class="fa fa-calendar"></i></div>
						<span class="title">Reminders</span>
					</a>
					<!--start submenu -->
					<ul>
						<li>
							<a href="../calendar/calendar.php">
								<span class="title">Calendar View</span>
							</a>
						</li>
					<!-- 	<li>
							<a href="../calendar/calendar_events.php">
								<span class="title">Create Events</span>
							</a>
						</li> -->
						<li>
							<a href="../calendar/upcoming_events.php">
								<span class="title">Create Reminder</span>
							</a>
						</li>

					</ul><!--end /submenu -->
				</li><!--end /menu-li -->

				
				<?php if($_SESSION['user_type'] == 1): ?>
				<li class="gui-folder">
					<a>
						<div class="gui-icon"><i class="fa fa-users"></i></div>
						<span class="title">Admin Modules</span>
					</a>
					<!--start submenu -->
					<ul>
						<li>
							<a href="../user/user.php">
								<span class="title">User Accounts</span>
							</a>
						</li>
						<li>
							<a href="../user/teams.php">
								<span class="title">Team Leader List</span>
							</a>
						</li>
						<li>
							<a href="../shipping/methods.php">
								<span class="title">Shipping Methods</span>
							</a>
						</li>
						<li>
							<a href="../report/reports.php">
								<!-- <div class="gui-icon"><i class="fa fa-table"></i></div> -->
								<span class="title">Reports</span>
							</a>
						</li>

					</ul><!--end /submenu -->
				</li><!--end /menu-li -->
				<?php endif; ?>
				<li>
					<a href="../logout.php">
						<div class="gui-icon"><i class="fa fa-sign-out"></i></div>
						<span class="title">Sign Out</span>
					</a>
				</li>
			</ul><!--end .main-menu -->
			<!-- END MAIN MENU -->

			<!-- <div class="menubar-foot-panel">
				<small class="no-linebreak hidden-folded">
					<span class="opacity-75">Copyright &copy; 2016</span> <strong><i class="fa fa-cube fa-fw"></i>Qubetek</strong>
				</small>
			</div> -->
		</div><!--end .menubar-scroll-panel-->
	</div><!--end #menubar-->
	<!-- END MENUBAR -->
</div>