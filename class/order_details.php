<?php 
    /**
    * 
    */
    class Order_Details 
    {
        private $details_id;
        private $order_id;
        private $product_id;
        private $quantity;
        private $unit_price;
        private $amount;
        private $status;
        
        /**
         * Gets the value of details_id.
         *
         * @return mixed
         */
        public function getDetailsId()
        {
            return $this->details_id;
        }

        /**
         * Sets the value of details_id.
         *
         * @param mixed $details_id the details id
         *
         * @return self
         */
        public function setDetailsId($details_id)
        {
            $this->details_id = $details_id;

            return $this;
        }

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
         * Gets the value of product_id.
         *
         * @return mixed
         */
        public function getProductId()
        {
            return $this->product_id;
        }

        /**
         * Sets the value of product_id.
         *
         * @param mixed $product_id the product id
         *
         * @return self
         */
        public function setProductId($product_id)
        {
            $this->product_id = $product_id;

            return $this;
        }

        /**
         * Gets the value of quantity.
         *
         * @return mixed
         */
        public function getQuantity()
        {
            return $this->quantity;
        }

        /**
         * Sets the value of quantity.
         *
         * @param mixed $quantity the quantity
         *
         * @return self
         */
        public function setQuantity($quantity)
        {
            $this->quantity = $quantity;

            return $this;
        }

        /**
         * Gets the value of unit_price.
         *
         * @return mixed
         */
        public function getUnitPrice()
        {
            return $this->unit_price;
        }

        /**
         * Sets the value of unit_price.
         *
         * @param mixed $unit_price the unit price
         *
         * @return self
         */
        public function setUnitPrice($unit_price)
        {
            $this->unit_price = $unit_price;

            return $this;
        }

        /**
         * Gets the value of amount.
         *
         * @return mixed
         */
        public function getAmount()
        {
            return $this->amount;
        }

        /**
         * Sets the value of amount.
         *
         * @param mixed $amount the amount
         *
         * @return self
         */
        public function setAmount($amount)
        {
            $this->amount = $amount;

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