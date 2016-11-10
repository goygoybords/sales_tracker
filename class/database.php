<?php
	class Database
	{

		protected $host = 'localhost';
    	protected $dbname = 'sales_tracker';
    	protected $user = 'root';
    	protected $pass = '';
    	protected $db = "";

    	public function __construct()
    	{
    		try
    		{
    			$this->db = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->user,$this->pass);
    		}
    		catch(Exception $e)
 			{
 				echo $e->getMessage();
 			}
    	}

 		public function insert($table , $data)
 		{
 			try
 			{
 				$columnString = implode(',', array_keys($data));
	 			$valueString = implode(',', array_fill(0, count($data), '?'));
	 			$sql = "INSERT INTO {$table} (id, {$columnString}) VALUES (DEFAULT, {$valueString}) ";
	 			$cmd = $this->db->prepare($sql);
	 			$result = $cmd->execute(array_values($data));
	 			$result = $this->db->lastInsertId();
	 			return $result;
 			}
 			catch(Exception $e)
 			{
 				echo $e->getMessage();
 			}

 		}
 		public function select($table, $fields, $where = '1', $params = array() , $limit = '')
 		{
	 		//fetchArgs, etc
	        $fields = implode(', ', $fields);
	        //create query
	        $sql = "SELECT {$fields} FROM {$table} WHERE $where $limit";

	        //prepare statement
	        $cmd = $this->db->prepare($sql);
	        $cmd->execute($params);
	        $result = $cmd->fetchAll();
	        return $result;
	    }
	    public function update($table, $fields, $where = '', $params)
	    {
		 	$i=0;
		    foreach($fields as $key => $value)
		    {
		            $fields[$i] = $value."  = ?";
		            $i++;
		    }
		    $set = implode(", ",$fields);
		    $sql = "UPDATE {$table} SET {$set} {$where} ";
		    $cmd = $this->db->prepare($sql);
	        $result = $cmd->execute($params);
	        return $result;
	    }

	    public function getDb()
	    {
	    	return $this->db;
	    }
 		public function closeDb()
 		{
 			return $db = null;
 		}
	}
?>