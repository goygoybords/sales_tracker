<?php 
    /**
    * 
    */
    class Order 
    {
        private $order_id;
        private $order_date;
        private $customer_id;
        private $total;
        private $shipping_method_id;
        private $remarks;
        private $shipping_fee;
        private $notes;
        private $status;
        
        /**
         * Gets the value of order_id.
         *
         * @return mixed
         */
        public function getOrderId()
        {
            return $this->order_id;
        }

        /**
         * Sets the value of order_id.
         *
         * @param mixed $order_id the order id
         *
         * @return self
         */
        public function setOrderId($order_id)
        {
            $this->order_id = $order_id;

            return $this;
        }

        /**
         * Gets the value of order_date.
         *
         * @return mixed
         */
        public function getOrderDate()
        {
            return $this->order_date;
        }

        /**
         * Sets the value of order_date.
         *
         * @param mixed $order_date the order date
         *
         * @return self
         */
        public function setOrderDate($order_date)
        {
            $this->order_date = $order_date;

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
         * Gets the value of total.
         *
         * @return mixed
         */
        public function getTotal()
        {
            return $this->total;
        }

        /**
         * Sets the value of total.
         *
         * @param mixed $total the total
         *
         * @return self
         */
        public function setTotal($total)
        {
            $this->total = $total;

            return $this;
        }

        /**
         * Gets the value of shipping_method_id.
         *
         * @return mixed
         */
        public function getShippingMethodId()
        {
            return $this->shipping_method_id;
        }

        /**
         * Sets the value of shipping_method_id.
         *
         * @param mixed $shipping_method_id the shipping method id
         *
         * @return self
         */
        public function setShippingMethodId($shipping_method_id)
        {
            $this->shipping_method_id = $shipping_method_id;

            return $this;
        }

        /**
         * Gets the value of remarks.
         *
         * @return mixed
         */
        public function getRemarks()
        {
            return $this->remarks;
        }

        /**
         * Sets the value of remarks.
         *
         * @param mixed $remarks the remarks
         *
         * @return self
         */
        public function setRemarks($remarks)
        {
            $this->remarks = $remarks;

            return $this;
        }

        /**
         * Gets the value of shipping_fee.
         *
         * @return mixed
         */
        public function getShippingFee()
        {
            return $this->shipping_fee;
        }

        /**
         * Sets the value of shipping_fee.
         *
         * @param mixed $shipping_fee the shipping fee
         *
         * @return self
         */
        public function setShippingFee($shipping_fee)
        {
            $this->shipping_fee = $shipping_fee;

            return $this;
        }

        /**
         * Gets the value of notes.
         *
         * @return mixed
         */
        public function getNotes()
        {
            return $this->notes;
        }

        /**
         * Sets the value of notes.
         *
         * @param mixed $notes the notes
         *
         * @return self
         */
        public function setNotes($notes)
        {
            $this->notes = $notes;

            return $this;
        }

        public function getStatus()
        {
            return $this->status;
        }

        /**
         * Sets the value of notes.
         *
         * @param mixed $notes the notes
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