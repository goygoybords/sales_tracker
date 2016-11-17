<?php
	require '../../class/database.php';
	$db = new Database();


	$table = "calendar_events";
	$fields = array("event_name","description" ,"FROM_UNIXTIME(start_date , '%Y-%m-%d') AS 'start' " , "FROM_UNIXTIME(end_date , '%Y-%m-%d') AS 'end'" );
	$where = "status = 1";

	$reminders = $db->select($table, $fields, $where);
	echo json_encode( $reminders );
	
?>