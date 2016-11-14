<?php 

	require '../class/database.php';
	
	$db = new Database();


	$events_array = array();

		$table = 'calendar_events';
		$fields = array('*');
		$where = "status = ?";
		$params = array(1);
	$list = $db->select($table, $fields, $where, $params);


	foreach ($list as $r ) 
	{
		 $e = array();
	     $e['id'] = $r['id'];
	     $e['title'] = $r['event_name'];
	     $e['start'] = date('Y-m-d', $r['start_date']);
	     $e['end'] = date('Y-m-d', $r['end_date']);
	     $e['description'] = $r['description'];
	     //$e['url'] = "specific_event.php?id=".$r['id'];
	     array_push($events_array, $e);
	}
	echo json_encode($events_array);

?>