<?php
	require '../class/database.php';
	require '../class/team.php';
	
	$db = new Database();
	$team = new Team();
	
	$table = "teams";
	extract($_POST);
	if(isset($_POST['register_team']))
	{

		$team->setUserId(intval($user_id));
		$team->setTeamName(htmlentities($team_name));
		$team->setStatus(1);

		$data = [
					'user_id'    => $team->getUserId()   , 
					'team_name'  => $team->getTeamName() ,
					'status' => $team->getStatus() ,
				];

		$result = $db->insert($table, $data);
		header("location: ../user/manage_teams.php?msg=inserted");
		
		// $fields = array('email');
		// $where = "email = ?";
		// $params = array($user->getEmail());

		// $check = $db->select($table, $fields, $where , $params  );
		// if(count($check) == 1)
		// {
		// 	header("location: ../user/manage.php?msg=user_exist");
		// }
		// else
		// {
		// 	$result = $db->insert($table, $data);
		// 	header("location: ../user/manage.php?msg=inserted");
		// }
	}

	if(isset($_POST['update_team']))
	{
		// user setters and getters
		$team->setId(htmlentities($id));
		$team->setUserId(intval($user_id));
		$team->setTeamName(htmlentities($team_name));


		$fields = array('user_id' ,'team_name');
		$where  = "WHERE id = ?";
		$params = array($team->getUserId(), $team->getTeamName(), $team->getId() );
		$result = $db->update($table, $fields, $where, $params);
		header("location: ../user/manage_teams.php?id=".$team->getId()."&msg=updated");
	}
	if(isset($_GET['del']))
	{
		$team->setId($_GET['id']);
		$team->setStatus(0);
	
		$fields = array('status');
		$where  = "WHERE id = ?"; 
		$params = array($team->getStatus(), $team->getId() );
		$result = $db->update($table, $fields, $where, $params);
		header("location: ../user/teams.php?&msg=deleted");

	}
	
?>