<?php 
	/**
	* 
	*/
	class Product
	{
		private $product_id;
		private $product_description;
		private $product_price;
        private $quantity;
		private $status;

	   
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Sets the value of product_id.
     *
     * @param mixed $product_id the product id
     *
     * @return self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

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
     * Gets the value of product_description.
     *
     * @return mixed
     */
    public function getProductDescription()
    {
        return $this->product_description;
    }

    /**
     * Sets the value of product_description.
     *
     * @param mixed $product_description the product description
     *
     * @return self
     */
    public function setProductDescription($product_description)
    {
        $this->product_description = $product_description;

        return $this;
    }

    /**
     * Gets the value of product_price.
     *
     * @return mixed
     */
    public function getProductPrice()
    {
        return $this->product_price;
    }

    /**
     * Sets the value of product_price.
     *
     * @param mixed $product_price the product price
     *
     * @return self
     */
    public function setProductPrice($product_price)
    {
        $this->product_price = $product_price;

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