<?php
	require '../class/database.php';
	require '../class/calendar_events.php';
	require '../model/calendar_events_model.php';
	$events = new CalendarEvents();
	$events_model = new Calendar_Events_Model(new Database());
	extract($_POST);

	$table = "calendar_events";
	if(isset($_POST['create_event']))
	{
		$start_date  = date('Y-m-d', strtotime($start_date));
		$end_date    = date('Y-m-d', strtotime($end_date));

		$events->setEvent_name(htmlentities($eventname));
		$events->setStart_date(strtotime($start_date));
		$events->setEnd_date(strtotime($end_date));
		$events->setStatus(1);

		$data = [
					'event_name'   => $events->getEvent_name(),
					'start_date'   => $events->getStart_date(),
					'end_date'     => $events->getEnd_date(),
					'status'  	   => $events->getStatus(),
		
				];
	
		$result = $events_model->createEvent($table, $data);
		header("location: ../calendar/manage.php?msg=inserted");
	}
	else if(isset($_POST['update_event']))
	{

		$start_date  = date('Y-m-d', strtotime($start_date));
		$end_date    = date('Y-m-d', strtotime($end_date));

		$events->setId(intval($id));
		$events->setEvent_name(htmlentities($eventname));
		$events->setStart_date(strtotime($start_date));
		$events->setEnd_date(strtotime($end_date));

		$fields = array('event_name', 'start_date', 'end_date');
			$where  = "WHERE id = ?";
			$params = array(
									$events->getEvent_name(),
									$events->getStart_date(),
									$events->getEnd_date(),
									$events->getId(),

								);
			$result = $events_model->updateEvent($table, $fields, $where, $params);
			header("location: ../calendar/manage.php?id=".$events->getId()."&msg=updated");
	}
	
	else if(isset($_POST['delete_event']))
	{
		$events->setId($id);
		$events->setStatus(0);
		$fields = array('status');
		$where  = "WHERE id = ?";
		$params = array(
								$events->getStatus(),
								$events->getId()
							);
		$result = $events_model->updateEvent($table, $fields, $where, $params);
		header("location: ../calendar/manage.php?id=".$events->getId()."&msg=deleted");
	}

	else if(isset($_POST['join_event']))
	{
		$events->setId($event);
		$events->setLead_id($id);
		$events->setStatus(2);
		$fields = array('lead_id', 'status');
		$where  = "WHERE id = ? and status = 1";
		$params = array(
								$events->getLead_id(),
								$events->getStatus(),
								$events->getId()
							);
		$result = $events_model->updateEvent($table, $fields, $where, $params);
		header("location: ../calendar/specific_event.php?id=".$events->setLead_id()."&msg=joined");
	}
	
	if(isset($_GET['id']))
	{
		$events->setId($_GET['id']);
		$events->setStatus(0);
		$fields = array('status');
		$where  = "WHERE id = ?";
		$params = array(
								$events->getStatus(),
								$events->getId()
							);
		$result = $events_model->updateEvent($table, $fields, $where, $params);
		header("location: ../calendar/upcoming_events.php");
	}

?>