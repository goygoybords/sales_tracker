<?php  

	class Order_Send_Someone 
	{
		
		private $id;
		private $send_counter;
		private $order_id;
		private $customer_id;
		private $send_name;
		private $send_contact_number;
		private $send_country_id;
		private $send_address;
		private $send_city;
		private $send_zip;
		private $send_state_id;
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

		    public function getSendCounter()
		    {
		        return $this->send_counter;
		    }

		    /**
		     * Sets the value of id.
		     *
		     * @param mixed $id the id
		     *
		     * @return self
		     */
		    public function setSendCounter($send_counter)
		    {
		        $this->send_counter = $send_counter;

		        return $this;
		    }

		    public function getOrderId()
		    {
		        return $this->order_id;
		    }

		    /**
		     * Sets the value of id.
		     *
		     * @param mixed $id the id
		     *
		     * @return self
		     */
		    public function setOrderId($order_id)
		    {
		        $this->order_id = $order_id;

		        return $this;
		    }

		    /**
		     * Gets the value of customer_id.
		     *
		     * @return mixed
		     */
		    public function getCustomerId()
		    {
		        return $this->customer_id;
		    }

		    /**
		     * Sets the value of customer_id.
		     *
		     * @param mixed $customer_id the customer id
		     *
		     * @return self
		     */
		    public function setCustomerId($customer_id)
		    {
		        $this->customer_id = $customer_id;

		        return $this;
		    }

		    /**
		     * Gets the value of send_name.
		     *
		     * @return mixed
		     */
		    public function getSendName()
		    {
		        return $this->send_name;
		    }

		    /**
		     * Sets the value of send_name.
		     *
		     * @param mixed $send_name the send name
		     *
		     * @return self
		     */
		    public function setSendName($send_name)
		    {
		        $this->send_name = $send_name;

		        return $this;
		    }

		    /**
		     * Gets the value of send_contact_number.
		     *
		     * @return mixed
		     */
		    public function getSendContactNumber()
		    {
		        return $this->send_contact_number;
		    }

		    /**
		     * Sets the value of send_contact_number.
		     *
		     * @param mixed $send_contact_number the send contact number
		     *
		     * @return self
		     */
		    public function setSendContactNumber($send_contact_number)
		    {
		        $this->send_contact_number = $send_contact_number;

		        return $this;
		    }

		    /**
		     * Gets the value of send_country_id.
		     *
		     * @return mixed
		     */
		    public function getSendCountryId()
		    {
		        return $this->send_country_id;
		    }

		    /**
		     * Sets the value of send_country_id.
		     *
		     * @param mixed $send_country_id the send country id
		     *
		     * @return self
		     */
		    public function setSendCountryId($send_country_id)
		    {
		        $this->send_country_id = $send_country_id;

		        return $this;
		    }

		    /**
		     * Gets the value of send_address.
		     *
		     * @return mixed
		     */
		    public function getSendAddress()
		    {
		        return $this->send_address;
		    }

		    /**
		     * Sets the value of send_address.
		     *
		     * @param mixed $send_address the send address
		     *
		     * @return self
		     */
		    public function setSendAddress($send_address)
		    {
		        $this->send_address = $send_address;

		        return $this;
		    }

		    /**
		     * Gets the value of send_city.
		     *
		     * @return mixed
		     */
		    public function getSendCity()
		    {
		        return $this->send_city;
		    }

		    /**
		     * Sets the value of send_city.
		     *
		     * @param mixed $send_city the send city
		     *
		     * @return self
		     */
		    public function setSendCity($send_city)
		    {
		        $this->send_city = $send_city;

		        return $this;
		    }

		    /**
		     * Gets the value of send_zip.
		     *
		     * @return mixed
		     */
		    public function getSendZip()
		    {
		        return $this->send_zip;
		    }

		    /**
		     * Sets the value of send_zip.
		     *
		     * @param mixed $send_zip the send zip
		     *
		     * @return self
		     */
		    public function setSendZip($send_zip)
		    {
		        $this->send_zip = $send_zip;

		        return $this;
		    }

		    /**
		     * Gets the value of send_state_id.
		     *
		     * @return mixed
		     */
		    public function getSendStateId()
		    {
		        return $this->send_state_id;
		    }

		    /**
		     * Sets the value of send_state_id.
		     *
		     * @param mixed $send_state_id the send state id
		     *
		     * @return self
		     */
		    public function setSendStateId($send_state_id)
		    {
		        $this->send_state_id = $send_state_id;

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

		}

?>