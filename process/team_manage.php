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
		$team->setGroupId(intval($group_id));
		$team->setStatus(1);

		$data = [
					'user_id'    => $team->getUserId()   , 
					'team_name'  => $team->getTeamName() ,
					'group_id'	 => $team->getGroupId(),
					'status' => $team->getStatus() ,
				];
		$result = $db->insert($table, $data);
		
		$table = "users";
		$fields = array('team_id');
		$where  = "WHERE id = ?";
		$params = array($db->getDb()->lastInsertId(), $team->getUserId() );
		$result = $db->update($table, $fields, $where, $params);

		header("location: ../user/manage_teams.php?msg=inserted");
	}

	if(isset($_POST['update_team']))
	{
		// user setters and getters
		$team->setId(htmlentities($id));
		$team->setUserId(intval($user_id));
		$team->setTeamName(htmlentities($team_name));
		$team->setGroupId(intval($group_id));

		$fields = array('user_id' ,'team_name', 'group_id');
		$where  = "WHERE id = ?";
		$params = array($team->getUserId(), $team->getTeamName(), $team->getGroupId(), $team->getId() );
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