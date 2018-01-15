<?php 

    /**
    * 
    */
    class Customer_Payment
    {
        private $id;
        private $customer_id;
        private $payment_method;
        private $card_type;
        private $card_number;
        private $card_name;
        private $expiry_date;
        private $cvv;
        private $check_number;
        private $account_number;
        private $bank_name;
        private $routing_number;
        private $status;


        public function getRoutingNumber()
        {
            return $this->routing_number;
        }

        /**
         * Sets the value of id.
         *
         * @param mixed $id the id
         *
         * @return self
         */
        public function setRoutingNumber($routing_number)
        {
            $this->routing_number = $routing_number;

            return $this;
        }

        public function getBankName()
        {
            return $this->bank_name;
        }

        /**
         * Sets the value of id.
         *
         * @param mixed $id the id
         *
         * @return self
         */
        public function setBankName($bank_name)
        {
            $this->bank_name = $bank_name;

            return $this;
        }

        public function getAccountNumber()
        {
            return $this->account_number;
        }

        /**
         * Sets the value of id.
         *
         * @param mixed $id the id
         *
         * @return self
         */
        public function setAccountNumber($account_number)
        {
            $this->account_number = $account_number;

            return $this;
        }
        
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
         * Gets the value of payment_method.
         *
         * @return mixed
         */
        public function getPaymentMethod()
        {
            return $this->payment_method;
        }

        /**
         * Sets the value of payment_method.
         *
         * @param mixed $payment_method the payment method
         *
         * @return self
         */
        public function setPaymentMethod($payment_method)
        {
            $this->payment_method = $payment_method;

            return $this;
        }

        /**
         * Gets the value of card_type.
         *
         * @return mixed
         */
        public function getCardType()
        {
            return $this->card_type;
        }

        /**
         * Sets the value of card_type.
         *
         * @param mixed $card_type the card type
         *
         * @return self
         */
        public function setCardType($card_type)
        {
            $this->card_type = $card_type;

            return $this;
        }

        /**
         * Gets the value of card_number.
         *
         * @return mixed
         */
        public function getCardNumber()
        {
            return $this->card_number;
        }

        /**
         * Sets the value of card_number.
         *
         * @param mixed $card_number the card number
         *
         * @return self
         */
        public function setCardNumber($card_number)
        {
            $this->card_number = $card_number;

            return $this;
        }

        /**
         * Gets the value of card_name.
         *
         * @return mixed
         */
        public function getCardName()
        {
            return $this->card_name;
        }

        /**
         * Sets the value of card_name.
         *
         * @param mixed $card_name the card name
         *
         * @return self
         */
        public function setCardName($card_name)
        {
            $this->card_name = $card_name;

            return $this;
        }

        /**
         * Gets the value of expiry_date.
         *
         * @return mixed
         */
        public function getExpiryDate()
        {
            return $this->expiry_date;
        }

        /**
         * Sets the value of expiry_date.
         *
         * @param mixed $expiry_date the expiry date
         *
         * @return self
         */
        public function setExpiryDate($expiry_date)
        {
            $this->expiry_date = $expiry_date;

            return $this;
        }

        /**
         * Gets the value of cvv.
         *
         * @return mixed
         */
        public function getCvv()
        {
            return $this->cvv;
        }

        /**
         * Sets the value of cvv.
         *
         * @param mixed $cvv the cvv
         *
         * @return self
         */
        public function setCvv($cvv)
        {
            $this->cvv = $cvv;

            return $this;
        }

        /**
         * Gets the value of check_number.
         *
         * @return mixed
         */
        public function getCheckNumber()
        {
            return $this->check_number;
        }

        /**
         * Sets the value of check_number.
         *
         * @param mixed $check_number the check number
         *
         * @return self
         */
        public function setCheckNumber($check_number)
        {
            $this->check_number = $check_number;

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