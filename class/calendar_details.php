<?php
	class CalendarDetails
	{
		private $id;
        private $leadid;
        private $calendar_event_id;
        private $datecreated;
        private $status;

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
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

        public function getCalendar_event_id()
        {
            return $this->calendar_event_id;
        }

        public function setCalendar_event_id($calendar_event_id)
        {
            $this->calendar_event_id = $calendar_event_id;
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