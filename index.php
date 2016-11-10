<?php 
	session_start();
	if(isset($_SESSION['isLogin']) == true)
		header("location: dashboard/main.php");
?>
<?php include('common/header.php'); ?>
		<!-- BEGIN LOGIN SECTION -->
		<section class="section-account">						
			<div class="card contain-xs style-transparent">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12">
							<br/>
							<span class="text-lg text-bold text-primary">User Sign In</span>
							<br/>
							<form class="form floating-label" action="process/login_process.php" accept-charset="utf-8" method="post">
								<div class="form-group">
									<input type="email" class="form-control" id="email" name="email" required>
									<label for="email">Email</label>
								</div>
								<div class="form-group">
									<input type="password" class="form-control" id="password" name="password" required>
									<label for="password">Password</label>									
								</div>
								<br/>
								<div class="row">
									<!-- <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 text-left">
										<div class="checkbox checkbox-inline checkbox-styled">
											<label>
												<input type="checkbox"> <span>Remember me</span>
											</label>
										</div>
									</div><!end .col --> 
									<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-right">
										<button class="btn btn-primary btn-raised btn-block" type="submit" name="login">Login</button>
									</div><!--end .col -->
								</div><!--end .row -->
							</form>
							<?php 
								if(isset($_GET['error']))
								{
									
									 if($_GET['error'] = 'invalid')
									{
										echo '<div id = "error">
										<span style = "font-size: 14px;color: red;font-style: italic;">Invalid Username or Password</span>
										</div>';
									}
									
								}
							?>
						</div><!--end .col -->

					</div><!--end .card -->
				</section>
				<!-- END LOGIN SECTION -->

				<?php include('common/footer.php'); ?>

				
