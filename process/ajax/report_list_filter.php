<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
if(isset($_GET)):
// DB table to use
// DB table to use
$table = 'orders';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
session_start();

$columns = array(

    array( 'db' => '`o`.`invoice_number`',       'dt' => 0, 'field' => 'invoice_number' ),
    array( 'db' => '`o`.`order_date`', 'dt' => 1, 'formatter' => function( $d, $row )
            {
                return date('Y-m-d', strtotime( $d));
            }, 'field' => 'order_date' 
        ),
    array( 'db' => "CONCAT_WS( '', `c`.`firstname`, ' ' ,`c`.`lastname` )", "dt" => 2, "field" => "customer_name", "as" => "customer_name" ),
    array( 'db' => '`o`.`total`',       'dt' => 3, 'field' => 'total' ),
    array( 'db' => '`s`.`description`', 'dt' => 4, 'field' => 'description' ),
    array( 'db' => '`o`.`remarks`',     'dt' => 5, 'field' => 'remarks' ),
    array( 'db' => '`o`.`notes`',       'dt' => 6, 'field' => 'notes' ),
    array( 'db' => "CONCAT_WS( '', `u`.`first_name`, ' ' ,`u`.`lastname` )", "dt" => 7, "field" => "full_name", "as" => "full_name" ),
    array( 'db' => '`o`.`tracking_number`',       'dt' => 8, 'field' => 'tracking_number' ),
    array( 'db' => '`o`.`status`', 'dt' => 9, 'formatter' => function( $d, $row )
            {
                if($d == 0)
                {
                  return "Order Pending";
                }
                else if ($d == 1)
                {
                  return "Order Billed";

                }
            }, 'field' => 'status' 
        ),
   
    );

// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'sales_tracker',
    'host' => 'localhost'
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
    // require( 'ssp.php' );
    require('ssp.customized.class.php' );
    $extraWhere = "";  
        $min =  date('Y-m-d', strtotime($_GET['min']));
        $max =  date('Y-m-d', strtotime($_GET['max']));
        $agent = intval($_GET['agent']);
        $team = intval($_GET['team']);
  
    if($_GET['min'] != 0 && $_GET['max'] != 0 && $agent == 0 && $team == 0) //search by date
    {
        $extraWhere = "o.order_date BETWEEN '$min' AND '$max' ";
    }

    else if ($_GET['min'] != 0 && $_GET['max'] != 0 && $agent != 0 && $team != 0) //search by all
    {
        $extraWhere = "o.order_date BETWEEN '$min' AND '$max'  AND o.prepared_by = '$agent' AND u.team_id = '$team' ";
    }

    else if($agent !=0 && $_GET['min'] == 0 && $_GET['max'] == 0 && $team == 0) // search by agent only
    {
        $extraWhere = " o.prepared_by = '$agent' ";
    }
    else if($_GET['min'] != 0 && $_GET['max'] != 0 && $team != 0 ) //search by date and team
    {
        $extraWhere = "o.order_date BETWEEN '$min' AND '$max' AND u.team_id = '$team' ";
    }
    else
    {
        $extraWhere =  "o.status BETWEEN 0 AND 1" ;
    }

    $joinQuery = "FROM orders o
                  JOIN customer c 
                  ON o.customer_id = c.id 
                  JOIN shipping_method s
                  ON s.id = o.shipping_method_id
                  JOIN users u 
                  ON o.prepared_by = u.id
                 ";

    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
    );

endif;