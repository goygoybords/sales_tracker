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
$table = 'orders';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
session_start();
$columns = array(
    array( 'db' => '`o`.`id`', 'dt' => 0, 'formatter' => function( $d, $row )
            {
                return "INV-$d";
            }, 'field' => 'id' 
        ),

    array( 'db' => '`o`.`order_date`', 'dt' => 1, 'formatter' => function( $d, $row )
            {
                return date('Y-m-d', $d);
            }, 'field' => 'order_date' 
        ),

    array( 'db' => '`c`.`firstname`',   'dt' => 2, 'field' => 'firstname' ),
    array( 'db' => '`o`.`total`',       'dt' => 3, 'field' => 'total' ),
    array( 'db' => '`s`.`description`', 'dt' => 4, 'field' => 'description' ),
    array( 'db' => '`o`.`remarks`',     'dt' => 5, 'field' => 'remarks' ),
    array( 'db' => '`o`.`notes`',       'dt' => 6, 'field' => 'notes' ),
    array( 'db' => '`o`.`status`',      'dt' => 7, 'formatter' => function( $d, $row )
            {
                $_SESSION['status'] = $d;
                if($d == 0)
                {
                    return "Record Needs Approval";
                }
                else if($d == 1)
                {
                    return "Record Approved";
                }
                
                
            },
            'field' => 'status' 
            ),
    
    array( 'db' => '`o`.`id`',          'dt' => 8, 'formatter' => function( $d, $row )
            {
                if($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2)
                {
                    if($_SESSION['status'] == 0)
                    {
                        return '<a href="manage.php?id='.$d.'" >
                            <span class="label label-inverse" style = "color:black;">
                                <i class="fa fa-edit"></i> Edit
                            </span>
                        </a> &nbsp;

                        <a href="../process/order_manage.php?id='.$d.'&approve" onclick="return confirm(\'Are you sure you want to approve this record?\')" >
                            <span class="label label-inverse" style = "color:black;">
                                <i class="fa fa-remove"></i> Approve This Record
                            </span>
                        </a>
                        ';
                    }
                    else if($_SESSION['status'] == 1)
                    {
                        return '<a href="manage.php?id='.$d.'" >
                            <span class="label label-inverse" style = "color:black;">
                                <i class="fa fa-edit"></i> Edit
                            </span>
                        </a> ';
                    }
                }
                else if($_SESSION['user_type'] == 3)
                {
                    return '<a href="manage.php?id='.$d.'" >
                            <span class="label label-inverse" style = "color:black;">
                                <i class="fa fa-edit"></i> Edit
                            </span>
                        </a> ';

                }

                
            },
            'field' => 'id' 
            )
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
    
    $joinQuery = "FROM orders o
                  JOIN customer c 
                  ON o.customer_id = c.id 
                  JOIN shipping_method s
                  ON s.id = o.shipping_method_id
                 ";
    $extraWhere =  "o.status BETWEEN 0 AND 1" ;
    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
    );

