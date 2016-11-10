<?php 

	require '../class/database.php';
	require '../class/calendar_events.php';
	require '../model/calendar_events_model.php';
	$events = new CalendarEvents();
	$events_model = new Calendar_Events_Model(new Database());

	$events_array = array();

		$table = 'calendar_events';
		$fields = array('*');
		$where = "status = ?";
		$params = array(1);
	$list = $events_model->get_all($table, $fields, $where, $params);


	foreach ($list as $r ) 
	{
		 $e = array();
	     $e['id'] = $r['id'];
	     $e['title'] = $r['event_name'];
	     $e['start'] = date('Y-m-d', $r['start_date']);
	     $e['end'] = date('Y-m-d', $r['end_date']);
	    // $e['url'] = "specific_event.php?id=".$r['lead_id']."&event=".$r['id'];
	     array_push($events_array, $e);
	}
	echo json_encode($events_array);

?>