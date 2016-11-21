<?php
	session_start();
	if($_SESSION['isLogin'] != true){
		header("location: ../index.php");
		exit;
	}
	include '../include/start.html';
	require('../include/header.php');

	require '../class/database.php';
	$db = new Database();
	
	 $sql = "SELECT t.id, CONCAT(u.first_name, ' ', u.lastname) AS 'TeamLeader',t.team_name
				FROM teams t
				JOIN users u
				ON t.user_id = u.id
				WHERE t.status = 1
            ";
    $cmd = $db->getDb()->prepare($sql);
    $cmd->execute(array(1));
    $teams = $cmd->fetchAll();
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
								<header><i class="fa fa-fw fa-users"></i> User Accounts</header>
							</div><!--end .card-head -->
							<div class="col-lg-offset-0 col-md-12">
								<?php
								if(isset($_GET['msg']))
								{
									$msg = $_GET['msg'];
									if($msg == 'deleted')
										$error = 'Record Successfully Deleted';
									else if($msg == 'prev_deleted')
										$error = 'Record was deleted previously';
									else if($msg == 'none')
										$error = 'Sorry, the record selected does not exist.';
									echo '<span>'.$error.'</span>';
								}
							?>
							</div>
							<div class="col-lg-offset-0 col-md-12">
								<div class="card-body style-default-bright">
									<div class="card-body">
										<div class="row">
											<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
												<a class="btn btn-success btn-block" href="manage_teams.php" name="btnAddUser" id="btnAddUser">ADD NEW TEAMS</a>
											</div>
										</div>
										<br />
										<div class="col-lg-offset-0 col-md-12">
											<div class = "row" >
												<table class = "display responsive nowrap" id = "user-tbl">
													<thead>
														<th>#</th>
														<th>Team Leader</th>
														<th>Team Name</th>
														<th>Action</th>
													</thead>
													<tbody>
														<?php foreach ($teams as $t ) : ?>
														<tr>
															<td><?php echo $t['id'];  ?> </td>
															<td><?php echo $t['TeamLeader'];  ?></td>
															<td><?php echo $t['team_name'];  ?></td>
															<td>
										                        <a href="manage_teams.php?id=<?php echo $t['id']; ?>" >
										                            <span class="label label-inverse" style = "color:black;">
										                                <i class="fa fa-edit"></i> Edit
										                            </span>
										                        </a> &nbsp;
										                        <a href="../process/team_manage.php?id=<?php echo $t['id']; ?>&del" 
										                        onclick="return confirm('Are you sure you want to delete this record?')" >
										                            <span class="label label-inverse" style = "color:black;">
										                                <i class="fa fa-remove"></i> Delete
										                            </span>
										                        </a>
									                        </td>
														</tr>
														<?php endforeach; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div><!--end .card -->
								</div><!--end .col -->
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

<script type="text/javascript">
	$(document).ready(function()
	{
	    $('#user-tbl').DataTable(
	    {
			// "bProcessing": true,
			// "bServerSide": true,
			// "responsive": true,
	  //       "sPaginationType": "full_numbers",
	  //       "order": [0,'asc'],
	  //           "ajax":{
	  //               url :"../process/ajax/user_list.php", // json datasource
	  //               type: "get",  // method  , by default get
	  //           }
	    } );
	} );
</script>
