<?php /**
* 
    */
    class Countries 
    {
        
       private $country_id;
       private $country_code;
       private $country_name;


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
     * Gets the value of country_code.
     *
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * Sets the value of country_code.
     *
     * @param mixed $country_code the country code
     *
     * @return self
     */
    public function setCountryCode($country_code)
    {
        $this->country_code = $country_code;

        return $this;
    }

    /**
     * Gets the value of country_name.
     *
     * @return mixed
     */
    public function getCountryName()
    {
        return $this->country_name;
    }

    /**
     * Sets the value of country_name.
     *
     * @param mixed $country_name the country name
     *
     * @return self
     */
    public function setCountryName($country_name)
    {
        $this->country_name = $country_name;

        return $this;
    }
}

?>