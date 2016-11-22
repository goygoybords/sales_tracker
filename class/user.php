<?php 
	class User 
	{
		private $id;
		private $firstname;
		private $lastname;
		private $email;
		private $password;
		private $status;
		private $usertypeid;
		private $datecreated;
		private $datelastlogin;
		private $screen_name;
		private $team_id;

		public function getTeamId()
		{
			return $this->team_id;
		}

		public function setTeamId($team_id)
		{
			$this->team_id = $team_id;
		}

		public function getId()
		{
			return $this->id;
		}

		public function setId($id)
		{
			$this->id = $id;
		}

		public function getFirstname()
		{
			return $this->firstname;
		}

		public function setFirstname($firstname)
		{
			$this->firstname = $firstname;
		}

		public function getLastname()
		{
			return $this->lastname;
		}

		public function setLastname($lastname)
		{
			$this->lastname = $lastname;
		}

		public function getEmail()
		{
			return $this->email;
		}

		public function setEmail($email)
		{
			$this->email = $email;
		}

		public function getPassword(){
			return $this->password;
		}

		public function setPassword($password)
		{
			$this->password = $password;
		}

		public function getStatus()
		{
			return $this->status;
		}

		public function setStatus($status)
		{
			$this->status = $status;
		}

		public function getUsertypeid()
		{
			return $this->usertypeid;
		}

		public function setUsertypeid($usertypeid)
		{
			$this->usertypeid = $usertypeid;
		}

		public function getDatecreated()
		{
			return $this->datecreated;
		}

		public function setDatecreated($datecreated)
		{
			$this->datecreated = $datecreated;
		}

		public function getDatelastlogin()
		{
			return $this->datelastlogin;
		}

		public function setDatelastlogin($datelastlogin)
		{
			$this->datelastlogin = $datelastlogin;
		}

		public function setScreenName($screen_name)
		{
			$this->screen_name = $screen_name;
		}

		public function getScreenName()
		{
			return $this->screen_name;
		}

	
	}

?>