<?php /**
* 
    */
    class Refund 
    {
        private $id;
        private $order_id;
        private $order_date;
        private $amount;
        private $status;

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            return $this->id = $id;
        }

        public function getAmount()
        {
            return $this->amount;
        }

        public function setAmount($amount)
        {
            $this->amount = $amount;

            return $this;
        }
      

        public function getOrderId()
        {
            return $this->order_id;
        }

        public function setOrderId($order_id)
        {
            $this->order_id = $order_id;

            return $this;
        }

        public function getDate()
        {
            return $this->order_date;
        }

        public function setDate($order_date)
        {
            $this->order_date = $order_date;

            return $this;
        }

        public function getStatus()
        {
            return $this->status;
        }

        public function setStatus($status)
        {
            $this->status = $status;

            return $this;
        }
    }

?>