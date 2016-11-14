<?php /**
* 
    */
    class CalendarEvents 
    {
        private $id;
        private $event_name;
        private $description;
        private $start_date;
        private $end_date;
        private $status;


    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of event_name.
     *
     * @param mixed $event_name the event name
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    
    /**
     * Gets the value of event_name.
     *
     * @return mixed
     */
    public function getEventName()
    {
        return $this->event_name;
    }

    /**
     * Sets the value of event_name.
     *
     * @param mixed $event_name the event name
     *
     * @return self
     */
    public function setEventName($event_name)
    {
        $this->event_name = $event_name;

        return $this;
    }

    /**
     * Gets the value of description.
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the value of description.
     *
     * @param mixed $description the description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Gets the value of start_date.
     *
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Sets the value of start_date.
     *
     * @param mixed $start_date the start date
     *
     * @return self
     */
    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;

        return $this;
    }

    /**
     * Gets the value of end_date.
     *
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * Sets the value of end_date.
     *
     * @param mixed $end_date the end date
     *
     * @return self
     */
    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;

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