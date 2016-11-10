<?php
	class CalendarEvents
	{
		private $id;
        private $event_name;
        private $leadid;
        private $start_date;
        private $end_date;
        private $datecreated;
        private $status;
        private $description;
        private $user;
        private $event_type;


        public function getEventType()
        {
            return $this->event_type;
        }
        public function setEventType($event_type)
        {
            return $this->event_type = $event_type;
        }

        public function getUser()
        {
            return $this->user;
        }
        public function setUser($user)
        {
            return $this->user = $user;
        }

        public function getDescription()
        {
            return $this->description;
        }
        public function setDescription($description)
        {   
            return $this->description = $description;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getLeadid()
        {
            return $this->leadid;
        }

        public function setLeadid($leadid)
        {
            $this->leadid = $leadid;
        }

        public function getEvent_name()
        {
            return $this->event_name;
        }

        public function setEvent_name($event_name)
        {
            $this->event_name = $event_name;
        }

        public function getStart_date()
        {
            return $this->start_date;
        }

        public function setStart_date($start_date)
        {
            $this->start_date = $start_date;
        }

        public function getEnd_date()
        {
            return $this->end_date;
        }

        public function setEnd_date($end_date)
        {
            $this->end_date = $end_date;
        }

        public function getDatecreated()
        {
            return $this->datecreated;
        }

        public function setDatecreated($datecreated)
        {
            $this->datecreated = $datecreated;
        }

        public function getStatus()
        {
            return $this->status;
        }

        public function setStatus($status)
        {
            $this->status = $status;
        }
    }

?>