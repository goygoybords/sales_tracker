<?php
	require '../class/database.php';
	require '../class/calendar_events.php';
	
	$db = new Database();
	$events = new CalendarEvents();
	
	extract($_POST);

	$table = "calendar_events";
	if(isset($_POST['create_event']))
	{
		$start_date  = date('Y-m-d', strtotime($start_date));
		$end_date    = date('Y-m-d', strtotime($end_date));

		$events->setEventName(htmlentities($eventname));
		$events->setDescription(htmlentities($description));
		$events->setStartDate($start_date);
		$events->setEndDate($end_date);
		$events->setStatus(1);

		$data = [
					'event_name'   => $events->getEventName(),
					'description'  => $events->getDescription(),
					'start_date'   => $events->getStartDate(),
					'end_date'     => $events->getEndDate(),
					'status'  	   => $events->getStatus(),
		
				];
	
		$result = $db->insert($table, $data);
		header("location: ../calendar/manage.php?msg=inserted");
	}
	else if(isset($_POST['update_event']))
	{

		$start_date  = date('Y-m-d', strtotime($start_date));
		$end_date    = date('Y-m-d', strtotime($end_date));

		$events->setId(intval($id));
		$events->setDescription(htmlentities($description));
		$events->setEventName(htmlentities($eventname));
		$events->setStartDate($start_date);
		$events->setEndDate($end_date);

		$fields = array('event_name', 'description' ,'start_date', 'end_date');
			$where  = "WHERE id = ?";
			$params = array(
									$events->getEventName(),
									$events->getDescription(),
									$events->getStartDate(),
									$events->getEndDate(),
									$events->getId(),

								);
			$result = $db->update($table, $fields, $where, $params);
			header("location: ../calendar/manage.php?id=".$events->getId()."&msg=updated");
	}
	if(isset($_POST['delete_event']))
	{	

		$events->setId($event_id);
		$events->setStatus(0);
		$fields = array('status');
		$where  = "WHERE id = ?";
		$params = array(
							$events->getStatus(),
							$events->getId()
							);
		$result = $db->update($table, $fields, $where, $params);
		header("location: ../calendar/calendar.php");
	}
	
	
	if(isset($_GET['id']) && isset($_GET['del']))
	{

		$events->setId($_GET['id']);
		$events->setStatus(0);
		$fields = array('status');
		$where  = "WHERE id = ?";
		$params = array(
								$events->getStatus(),
								$events->getId()
							);
		$result = $db->update($table, $fields, $where, $params);
		header("location: ../calendar/upcoming_events.php");
	}

?>