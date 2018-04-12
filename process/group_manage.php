<?php
	require '../class/database.php';
	require '../class/team.php';
	
	$db = new Database();
	$team = new Team();
	
	$table = "groupings";
	extract($_POST);
	if(isset($_POST['register_group']))
	{

		$data = [
					'description'    => htmlentities($description)   , 
					'status' => 1,
				];

		$result = $db->insert($table, $data);
		header("location: ../user/manage_group.php?msg=inserted");
	}

	if(isset($_POST['update_group']))
	{
		$fields = array('description');
		$where  = "WHERE id = ?";
		$params = array(htmlentities($description), intval($id)  );
		$result = $db->update($table, $fields, $where, $params);
		header("location: ../user/manage_group.php?id=".$id."&msg=updated");
	}
	if(isset($_GET['del']))
	{
			
		$fields = array('status');
		$where  = "WHERE id = ?"; 
		$params = array(0, intval($_GET['id']) );
		$result = $db->update($table, $fields, $where, $params);
		header("location: ../user/groupings.php?&msg=deleted");

	}
	
?>