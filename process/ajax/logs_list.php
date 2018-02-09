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

// DB table to use
session_start();
$table = 'logs';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

$columns = array(
    array( 'db' => '`l`.`id`',       'dt' => 0, 'field' => 'id' ),
    array( 'db' => '`o`.`invoice_number`',       'dt' => 1, 'field' => 'invoice_number' ),
    array( 'db' => '`l`.`date_log`', 'dt' => 2, 'formatter' => function( $d, $row )
            {
                return date('Y-m-d h:i:sa', strtotime($d));
            }, 'field' => 'date_log' 
        ),
    array( 'db' => "CONCAT_WS( '', `u`.`first_name`, ' ' ,`u`.`lastname` )", "dt" => 3, "field" => "user", "as" => "user" ),
    array( 'db' => '`l`.`description`',  'dt' => 4, 'field' => 'description' ),
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
    
      $joinQuery = "FROM logs l 
                    JOIN orders o 
                    ON o.id = l.order_id
                    JOIN users u 
                    ON u.id = l.user_id
               ";
      $extraWhere =  "" ;
    
    
    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
    );

