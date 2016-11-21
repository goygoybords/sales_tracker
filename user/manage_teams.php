<?php
	session_start();
	if($_SESSION['isLogin'] != true){
		header("location: ../index.php");
		exit;
	}
	include '../include/start.html';
	require('../include/header.php');

	require '../class/database.php';
	require '../class/team.php';


	$team_id = (isset($_GET["id"]) ? $_GET["id"] : "");
	$db = new Database();
	$team = new Team();

	$form_state = 1;
	$form_header = "Add New Team";
	$submit_caption = "REGISTER TEAM";
	$name = "register_team";
	$msg = (isset($_GET["msg"]) ? $_GET["msg"] : "");

	$team_lead_list = $db->select('users' , array('id','first_name' , 'lastname'), 'usertypeid = ? AND status = ?' , array(4, 1) );

	if($team_id)
	{
			if($msg != 'deleted')
			{
				$table = 'teams';
				$fields = array('*');
				$where = " id = ? ";
				$params = array($team_id);
				$user_data = $db->select($table, $fields, $where, $params);


				if(count($user_data))
				{
					foreach ($user_data as $l)
					{
						$team->setId($l['id']);
						$team->setUserId($l['user_id']);
						$team->setTeamName($l['team_name']);
						$team->setStatus($l['status']);
					}

					if($team->getStatus() == 1)
					{
						$form_state = 2;
						$form_header = "Edit Team Details";
						$submit_caption = "Save Changes";
					}
					else
					{
						$team = new Team();
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
												<form class="form-horizontal" method = "post" action = '../process/team_manage.php'>
													<input type="hidden" name="id" id="id" value="<?php echo $team->getId(); ?>" />
													<div class="card-body" id="div-add-user">
														<div class="form-group">
															<label for="team_name" class="col-sm-2 control-label">Team Name</label>
															<div class="col-sm-10">
																<input type="text" name = "team_name" class="form-control" id="team_name"
																value = "<?php echo $team->getTeamName(); ?>" required >
															</div>
														</div>
														<div class="form-group">
															<label for="user_id" class="col-sm-2 control-label">Team Leader</label>
															<div class="col-sm-10">
																<select name = "user_id" id="user_id" class = "form-control" required>
																	<option></option>
																	<?php foreach($team_lead_list as $l) : ?>
																		<option value = "<?php echo $l['id']; ?>" 
																			<?php echo ($team->getUserId() == $l['id'] ? "selected='selected'" : ""); ?> >
																			<?php echo $l['first_name']." ".$l['lastname']; ?>
																		</option>
																
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
														<br />
														<div class="row">
															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
																<?php if($form_state == 2) $name = "update_team"; ?>
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
