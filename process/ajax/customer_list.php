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
$table = 'customer';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => '`c`.`id`',              'dt' => 0, 'field' => 'id' ),
    array( 'db' => '`c`.`firstname`',       'dt' => 1, 'field' => 'firstname' ),
    array( 'db' => '`c`.`lastname`',        'dt' => 2, 'field' => 'lastname' ),
    array( 'db' => '`c`.`contact_number`',  'dt' => 3, 'field' => 'contact_number' ),
    array( 'db' => '`c`.`shipping_address`',  'dt' => 4, 'field' => 'shipping_address' ),
    array( 'db' => '`c`.`id`',              'dt' => 5, 'formatter' => function( $d, $row )
            {
                return '
                         <a href="customer_orders.php?id='.$d.'" >
                            <span class="label label-inverse" style = "color:black;">
                                <i class="fa fa-edit"></i> View Orders
                            </span>
                        </a> &nbsp;
                        
                        <a href="manage.php?id='.$d.'" >
                            <span class="label label-inverse" style = "color:black;">
                                <i class="fa fa-edit"></i> Edit
                            </span>
                        </a> &nbsp;
                       
                        <a href="../process/customer_manage.php?id='.$d.'&p=list&del" onclick="return confirm(\'Are you sure you want to delete this record?\')" >
                            <span class="label label-inverse" style = "color:black;">
                                <i class="fa fa-remove"></i> Delete
                            </span>
                        </a>
                        ';
            },
            'field' => 'id' )
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
    
    $joinQuery = "FROM customer c";
    $extraWhere =  "" ;
    if($_SESSION['user_type'] == 3)
    {
        $extraWhere =  "c.created_by =".$_SESSION['id']." AND  c.status = 1" ;
    }
    else
    {
         $extraWhere =  "c.status = 1" ;
    }
    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
    );

