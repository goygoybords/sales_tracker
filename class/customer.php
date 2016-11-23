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

        private $alternate_contact_number;
        private $same;
        private $billing_country_id;
        private $billing_address;
        private $billing_city;
        private $billing_zip;
        private $billing_state_id;


        public function getAlternateContactNumber()
        {
            return $this->alternate_contact_number;
        }
        public function setAlternateContactNumber($alternate_contact_number)
        {
            $this->alternate_contact_number = $alternate_contact_number;
            return $this;
        }

        public function getSame()
        {
            return $this->same;
        }
        public function setSame($same)
        {
            $this->same = $same;
            return $this;
        }
        
        public function getBillingCountryId()
        {
            return $this->billing_country_id;
        }
        public function setBillingCountryId($billing_country_id)
        {
            $this->billing_country_id = $billing_country_id;
            return $this;
        }
        public function getBillingAddress()
        {
            return $this->billing_address;
        }

        public function setBillingAddress($billing_address)
        {
            $this->billing_address = $billing_address;

            return $this;
        }


        public function getBillingCity()
        {
            return $this->billing_city;
        }

        public function setBillingCity($billing_city)
        {
            $this->billing_city = $billing_city;

            return $this;
        }

        public function getBillingZip()
        {
            return $this->billing_zip;
        }

        public function setBillingZip($billing_zip)
        {
            $this->billing_zip = $billing_zip;
            return $this;
        }

        public function getBillingStateId()
        {
            return $this->billing_state_id;
        }

        public function setBillingStateId($billing_state_id)
        {
            $this->billing_state_id = $billing_state_id;
            return $this;
        }


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