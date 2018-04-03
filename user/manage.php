<?php
	session_start();
	if($_SESSION['isLogin'] != true){
		header("location: ../index.php");
		exit;
	}
	include '../include/start.html';
	require('../include/header.php');

	require '../class/database.php';
	require '../class/user.php';
	require '../class/team.php';
	require '../class/password_encrypt.php';

	$user_id = (isset($_GET["id"]) ? $_GET["id"] : "");
	$db = new Database();
	$user = new User();
	$encrpytion = new Password_Encrypt();

	$form_state = 1;
	$form_header = "Add User";
	$submit_caption = "REGISTER USER";
	$name = "register_user";
	$msg = (isset($_GET["msg"]) ? $_GET["msg"] : "");

	$list_team = $db->select('teams' , array('id' , 'team_name') , "status = 1");
	if($user_id)
	{
			if($msg != 'deleted')
			{
				$table = 'users';
				$fields = array('*');
				$where = " id = ? ";
				$params = array($user_id);
				$user_data = $db->select($table, $fields, $where, $params);

				if(count($user_data))
				{
					foreach ($user_data as $l)
					{

						$user->setId($l['id']);
						$user->setFirstname($l['first_name']);
						$user->setLastname($l['lastname']);
						$user->setPassword($encrpytion->decryptIt($l['password']));
						$user->setScreenName($l['screen_name']);
						$user->setEmail($l['email']);
						$user->setUsertypeid($l['usertypeid']);
						$user->setTeamId($l['team_id']);
						$user->setStatus($l['status']);
					}

					if($user->getStatus() == 1)
					{
						$form_state = 2;
						$form_header = "Edit User Details";
						$submit_caption = "Save Changes";
					}
					else
					{
						$user = new User();
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
												<form class="form-horizontal" method = "post" action = '../process/user_manage.php'>
													<input type="hidden" name="id" id="id" value="<?php echo $user->getId(); ?>" />
													<div class="card-body" id="div-add-user">
														<div class="row">
															<div class="col-sm-6">
																<div class="form-group">
																	<label for="Firstname5" class="col-sm-4 control-label">Firstname</label>
																	<div class="col-sm-8">
																		<input type="text" name = "firstname" class="form-control" id="Firstname5"
																		value = "<?php echo $user->getFirstname(); ?>" required>
																	</div>
																</div>
															</div>
															<div class="col-sm-6">
																<div class="form-group">
																	<label for="Lastname5" class="col-sm-4 control-label">Lastname</label>
																	<div class="col-sm-8">
																		<input type="text" name = "lastname" class="form-control" id="Lastname5"
																		value = "<?php echo $user->getLastname(); ?>" required>
																	</div>
																</div>
															</div>
														</div>
														<div class="form-group">
															<label for="Email5" class="col-sm-2 control-label">Username</label>
															<div class="col-sm-10">
																<input type="text" name = "username" class="form-control"  id="Email5"
																value = "<?php echo $user->getUsername(); ?>" required>
															</div>
														</div>
														<div class="form-group">
															<label for="Password5" class="col-sm-2 control-label">Password</label>
															<div class="col-sm-10">
																<input type="password" name = "password" class="form-control" id="Password5"
																value = "<?php echo $user->getPassword(); ?>" required>
															</div>
														</div>
														<div class="form-group">
															<label for="Password5" class="col-sm-2 control-label">Screen Name</label>
															<div class="col-sm-10">
																<input type="text" name = "screen_name" class="form-control" id="screen_name"
																value = "<?php echo $user->getScreenName(); ?>" >
															</div>
														</div>
														<div class="form-group">
															<label for="UserType" class="col-sm-2 control-label">User Type</label>
															<div class="col-sm-10">
																<select name = "user_type" id="user_type" class = "form-control" required>
																	<option value = "1" <?php if($user->getUsertypeid() == 1) echo "selected"; ?> >Admin</option>
																	<option value = "2" <?php if($user->getUsertypeid() == 2) echo "selected"; ?> >QA</option>
																	<option value = "3" <?php if($user->getUsertypeid() == 3) echo "selected"; ?> >Agent</option>
																	<option value = "4" <?php if($user->getUsertypeid() == 4) echo "selected"; ?> >Team Leader</option>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label for="team" class="col-sm-2 control-label">Sales Team</label>
															<div class="col-sm-10">
																<select name = "team" id="team" class = "form-control">
																	<option> </option> 
																	<?php foreach ($list_team as $l ) :
																		$team = new Team();
																		$team->setId($l['id']);
																		$team->setTeamName($l['team_name']);
																	?>
																	<option value = "<?php echo $team->getId(); ?>" 
																		<?php if($user->getTeamId() == $team->getId()) echo "selected"; ?> >
																		<?php echo $team->getTeamName(); ?>
																	</option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
														
														<br />
														<div class="row">
															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
																<?php if($form_state == 2) $name = "update_user"; ?>
																<button type="submit" name = <?php echo $name; ?> class="btn btn-info"><?php echo $submit_caption; ?></button>
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
														else if($msg == 'user_exist')
															$error = 'User already exist.';
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
	include '../include/end.php';
?>

