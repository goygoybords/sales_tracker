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
							<div class="col-md-12 col-sm-12 text-center">
								<img src="assets/img/logo.png" width="100%">
							</div>
							<div class="col-md-12 col-sm-12">
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
									<div class="col-sm-12 col-md-12 text-center">
										<button class="btn btn-info btn-md btn-raised btn-block" type="submit" style="height: 45px;" name="login">Login</button>
										<!-- <p><a href="#" style="color:#ffffff;">Forgot Password?</a></p> -->
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
							</div>
							
						</div><!--end .col -->

					</div><!--end .card -->
				</section>
				<!-- END LOGIN SECTION -->
				<style>
					body{
						background-image:url('assets/img/log.png');
						background-size:cover;
						background-position:center center;
						background-repeat:no-repeat;
					}
					.form-group{
						margin-bottom: 0px!important;
					}
					/*.form-group label{
						font-size:3rem;
					}*/
					.form-control{
							height: 45px;
							background-color:rgba(238, 238, 238, 0.58)!important;
					}
					.floating-label .form-control ~ label {
    					top: 30.5px;
    					font-size: 15px;
    				}
					.section-account{
						height: 100%!important;
    					padding-top: 15em!important;
					}
				</style>
				<?php include('common/footer.php'); ?>

				
