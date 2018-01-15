<?php
	class Shipping_Method
	{
		private $id;
		private $description;
		private $price;
		private $status;

		public function getId()
		{
			return $this->id;
		}

		public function setId($id)
		{
			$this->id = $id;
		}


		public function getDescription()
		{
			return $this->description;
		}

		public function setDescription($description)
		{
			$this->description = $description;
		}

		public function getPrice()
		{
			return $this->price;
		}

		public function setPrice($price)
		{
			$this->price = $price;
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