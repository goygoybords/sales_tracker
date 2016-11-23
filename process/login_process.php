<?php 
	session_start();
	require '../class/database.php';
	require '../class/user.php';
	
	$db = new Database();
	$user = new User();
	

	extract($_POST);
	
	if(isset($_POST['login']))
	{
		$user->setEmail(htmlentities($email));
		$user->setPassword(htmlentities($password));

		$user->setDatelastlogin(strtotime(date('Y-m-d')));

		$table = "users";
		$fields = array('id','first_name' , 'lastname', 'usertypeid', 'screen_name');
		$where = "email = ? AND password = ? AND status = 1";
		$params = array($user->getEmail(), md5($user->getPassword()) );

		$login = $db->select($table, $fields, $where, $params);
		if(count($login) > 0)
		{
			foreach ($login as $l ) 
			{

				$_SESSION['id'] = $l['id'];
 				$_SESSION['firstname'] = $l['first_name'];
				$_SESSION['lastname'] = $l['lastname'];
				$_SESSION['user_type'] = $l['usertypeid'];
				$_SESSION['screen_name'] = $l['screen_name'];
				$_SESSION['isLogin'] = true;
				if($l['usertypeid'] == 4)
				{
					$teams = $db->select('teams' , array('id'), 'user_id = ?' , array($l['id']));
					foreach ($teams as $t ) 
					{
						$_SESSION['team_id'] = $t['id'];
					}
				}
				$db->update("users", array('datelastlogin'), "WHERE id = ?" , array($user->getDatelastlogin() , $l['id']));
				header("location: ../orders/unapproved_orders.php");
			}
		}
		else
		{
			header("location: ../index.php?error=invalid");
		}
	}
?>