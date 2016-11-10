<?php
	class State
	{
		private $id;
		private $code;
		private $name;
		private $status;

		public function getId()
		{
			return $this->id;
		}

		public function setId($id)
		{
			$this->id = $id;
		}


		public function getCode()
		{
			return $this->code;
		}

		public function setCode($code)
		{
			$this->code = $code;
		}

		public function getName()
		{
			return $this->name;
		}

		public function setName($name)
		{
			$this->name = $name;
		}


		public function getStatus()
		{
			return $this->status;
		}

		public function setStatus($status)
		{
			$this->status = $status;
		}
	}
?>