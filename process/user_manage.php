<?php
	require '../class/database.php';
	require '../class/user.php';
	require '../class/password_encrypt.php';
	
	$db = new Database();
	$user = new User();
	$encrpytion = new Password_Encrypt();
	
	$table = "users";
	extract($_POST);
	
	if(isset($_POST['register_user']))
	{

		// user setters and getters
		$user->setFirstname(htmlentities($firstname));
		$user->setLastname(htmlentities($lastname));
		$user->setEmail(htmlentities($email));
		$user->setPassword($encrpytion->encryptIt($password));
		$user->setUsertypeid($user_type);
		$user->setScreenName($screen_name);
		$user->setDatecreated(strtotime(date('Y-m-d')));
		$user->setTeamId($team);
		$user->setStatus(1);

		$data = [
					'first_name' => $user->getFirstname()  , 
					'lastname'  => $user->getLastname()   ,
					'email'     => $user->getEmail()      ,
					'password'  => $user->getPassword()   ,
					'usertypeid' => $user->getUsertypeid() ,
					'screen_name' => $user->getScreenName(),
					'datecreated' => $user->getDatecreated() ,
					'team_id' => $user->getTeamId(),
					'status' => $user->getStatus() ,
				];

		$fields = array('email');
		$where = "email = ?";
		$params = array($user->getEmail());

		$check = $db->select($table, $fields, $where , $params  );
		if(count($check) == 1)
		{
			header("location: ../user/manage.php?msg=user_exist");
		}
		else
		{
			$result = $db->insert($table, $data);
			header("location: ../user/manage.php?msg=inserted");
		}
	}

	if(isset($_POST['update_user']))
	{
		// user setters and getters
		$user->setId(htmlentities($id));
		$user->setFirstname(htmlentities($firstname));
		$user->setLastname(htmlentities($lastname));
		$user->setEmail(htmlentities($email));
		$user->setScreenName($screen_name);
		$user->setPassword($encrpytion->encryptIt($password));
		$user->setTeamId($team);
		$user->setUsertypeid($user_type);

		$table  = "users";
		$fields = array('first_name' ,'lastname' ,'email' , 'password' , 'usertypeid' , 'screen_name' , 'team_id');
		$where  = "WHERE id = ?";
		$params = array($user->getFirstname(), $user->getLastname(), $user->getEmail(),
				$user->getPassword(), $user->getUsertypeid(),  $user->getScreenName() , $user->getTeamId() ,$user->getId() );
		
		$result = $db->update($table, $fields, $where, $params);

		header("location: ../user/manage.php?id=".$user->getId()."&msg=inserted");
	}
	if(isset($_GET['del']))
	{
		$user->setId($_GET['id']);
		$user->setStatus(0);
		$table  = "users";
		$fields = array('status');
		$where  = "WHERE id = ?"; 
		$params = array($user->getStatus(), $user->getId() );
		$result = $db->update($table, $fields, $where, $params);
		header("location: ../user/user.php?&msg=deleted");

	}
	
?>