<?php /**
* 
    */
    class Customer 
    {
        
        private $customer_id;
        private $firstname;
        private $lastname;
        private $email;
        private $contact_number;
        private $country_id;
        private $shipping_address;
        private $city;
        private $zip;
        private $state_id;
        private $status;
    
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
         * Gets the value of firstname.
         *
         * @return mixed
         */
        public function getFirstname()
        {
            return $this->firstname;
        }

        /**
         * Sets the value of firstname.
         *
         * @param mixed $firstname the firstname
         *
         * @return self
         */
        public function setFirstname($firstname)
        {
            $this->firstname = $firstname;

            return $this;
        }

        /**
         * Gets the value of lastname.
         *
         * @return mixed
         */
        public function getLastname()
        {
            return $this->lastname;
        }

        /**
         * Sets the value of lastname.
         *
         * @param mixed $lastname the lastname
         *
         * @return self
         */
        public function setLastname($lastname)
        {
            $this->lastname = $lastname;

            return $this;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function setEmail($email)
        {
            $this->email = $email;

            return $this;
        }

        /**
         * Gets the value of contact_number.
         *
         * @return mixed
         */
        public function getContactNumber()
        {
            return $this->contact_number;
        }

        /**
         * Sets the value of contact_number.
         *
         * @param mixed $contact_number the contact number
         *
         * @return self
         */
        public function setContactNumber($contact_number)
        {
            $this->contact_number = $contact_number;

            return $this;
        }

        /**
         * Gets the value of country_id.
         *
         * @return mixed
         */
        public function getCountryId()
        {
            return $this->country_id;
        }

        /**
         * Sets the value of country_id.
         *
         * @param mixed $country_id the country id
         *
         * @return self
         */
        public function setCountryId($country_id)
        {
            $this->country_id = $country_id;

            return $this;
        }

        /**
         * Gets the value of shipping_address.
         *
         * @return mixed
         */
        public function getShippingAddress()
        {
            return $this->shipping_address;
        }

        /**
         * Sets the value of shipping_address.
         *
         * @param mixed $shipping_address the shipping address
         *
         * @return self
         */
        public function setShippingAddress($shipping_address)
        {
            $this->shipping_address = $shipping_address;

            return $this;
        }

        /**
         * Gets the value of city.
         *
         * @return mixed
         */
        public function getCity()
        {
            return $this->city;
        }

        /**
         * Sets the value of city.
         *
         * @param mixed $city the city
         *
         * @return self
         */
        public function setCity($city)
        {
            $this->city = $city;

            return $this;
        }

        /**
         * Gets the value of zip.
         *
         * @return mixed
         */
        public function getZip()
        {
            return $this->zip;
        }

        /**
         * Sets the value of zip.
         *
         * @param mixed $zip the zip
         *
         * @return self
         */
        public function setZip($zip)
        {
            $this->zip = $zip;

            return $this;
        }

        /**
         * Gets the value of state_id.
         *
         * @return mixed
         */
        public function getStateId()
        {
            return $this->state_id;
        }

        /**
         * Sets the value of state_id.
         *
         * @param mixed $state_id the state id
         *
         * @return self
         */
        public function setStateId($state_id)
        {
            $this->state_id = $state_id;

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