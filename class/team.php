<?php

	class Team
	{
		
		private $id;
		private $user_id;
		private $team_name;
		private $group_id;
		private $status;

	    /**
	     * Gets the value of id.
	     *
	     * @return mixed
	     */
	    public function getId()
	    {
	        return $this->id;
	    }

	    /**
	     * Sets the value of id.
	     *
	     * @param mixed $id the id
	     *
	     * @return self
	     */
	    public function setId($id)
	    {
	        $this->id = $id;

	        return $this;
	    }

	    /**
	     * Gets the value of user_id.
	     *
	     * @return mixed
	     */
	    public function getUserId()
	    {
	        return $this->user_id;
	    }

	    /**
	     * Sets the value of user_id.
	     *
	     * @param mixed $user_id the user id
	     *
	     * @return self
	     */
	    public function setUserId($user_id)
	    {
	        $this->user_id = $user_id;

	        return $this;
	    }

	    /**
	     * Gets the value of team_name.
	     *
	     * @return mixed
	     */
	    public function getTeamName()
	    {
	        return $this->team_name;
	    }

	    /**
	     * Sets the value of team_name.
	     *
	     * @param mixed $team_name the team name
	     *
	     * @return self
	     */
	    public function setTeamName($team_name)
	    {
	        $this->team_name = $team_name;

	        return $this;
	    }

	    /**
	     * Gets the value of status.
	     *
	     * @return mixed
	     */
	    public function getStatus()
	    {
	        return $this->status;
	    }

	    /**
	     * Sets the value of status.
	     *
	     * @param mixed $status the status
	     *
	     * @return self
	     */
	    public function setStatus($status)
	    {
	        $this->status = $status;

	        return $this;
	    }

	    public function getGroupId()
	    {
	        return $this->group_id;
	    }

	    /**
	     * Sets the value of status.
	     *
	     * @param mixed $status the status
	     *
	     * @return self
	     */
	    public function setGroupId($group_id)
	    {
	        $this->group_id = $group_id;

	        return $this;
	    }
	}
		
?>