<?php
	require '../../class/database.php';
	$db = new Database();


	$table = "calendar_events";
	$fields = array("event_name","description" ,"start_date AS 'start' " , "end_date AS 'end'" );
	$where = "status = 1";

	$reminders = $db->select($table, $fields, $where);
	echo json_encode( $reminders );
	
?>