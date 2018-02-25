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




  $table = 'orders';

// Table's primary key
$primaryKey = 'id';


// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

$columns = array(

    array( 'db' => '`o`.`invoice_number`',       'dt' => 0, 'field' => 'invoice_number' ),
    array( 'db' => '`o`.`order_date`', 'dt' => 1, 'formatter' => function( $d, $row )
            {
                return date('Y-m-d', strtotime($d));
            }, 'field' => 'order_date' 
        ),

    // array( 'db' => '`o`.`date_submitted`', 'dt' => 2, 'formatter' => function( $d, $row )
    //         {
    //             return date('Y-m-d', strtotime($d));
    //         }, 'field' => 'date_submitted' 
    //     ),

    array( 'db' => "CONCAT_WS( '', `c`.`firstname`, ' ' ,`c`.`lastname` )", "dt" => 2, "field" => "customer_name", "as" => "customer_name" ),

    // array( 'db' => '`o`.`total`',       'dt' => 4, 'field' => 'total' ),
    // array( 'db' => '`s`.`description`', 'dt' => 5, 'field' => 'description' ),
    array( 'db' => '`o`.`remarks`',     'dt' => 3, 'field' => 'remarks' ),
    // array( 'db' => '`o`.`notes`',       'dt' => 7, 'field' => 'notes' ),
    // array( 'db' => "CONCAT_WS( '', `u`.`first_name`, ' ' ,`u`.`lastname` )", "dt" => 4, "field" => "full_name", "as" => "full_name" ),
    

    array( 'db' => "CONCAT_WS( '', `up`.`first_name`, ' ' ,`up`.`lastname` )", "dt" => 4, "field" => "updated_by", "as" => "updated_by" ),
         
    array( 'db' => '`o`.`status`', 'dt' => 5, 'formatter' => function( $d, $row )
            {
                if($d == 0)
                  return "On Hold";
            }, 'field' => 'status' 
        ),

    array( 'db' => '`o`.`id`', 'dt' => 6, 'formatter' => function( $d, $row )
            {
                if($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2)
                {
                    return '<a href="manage.php?id='.$d.'" >
                            <span class="label label-inverse" style = "color:black;">
                                <i class="fa fa-edit"></i> Edit
                            </span>
                        </a> 
                        <a href="../process/order_manage.php?id='.$d.'&approve" onclick="return confirm(\'Are you sure you want to approve this record?\')" >
                            <span class="label label-inverse" style = "color:black;">
                                <i class="fa fa-check-square-o"></i> Approve 
                            </span>
                        </a>
                        ';
                }
                else if($_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 4)
                {
                  return '<a href="manage.php?id='.$d.'" >
                            <span class="label label-inverse" style = "color:black;">
                                <i class="fa fa-edit"></i> Edit
                            </span>
                        </a>';
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
    $extraWhere = "";
    $joinQuery = "";
    if($_SESSION['user_type'] == 3)
    {
        $joinQuery = "FROM orders o
                    JOIN customer c 
                  ON o.customer_id = c.id 
                  JOIN shipping_method s
                  ON s.id = o.shipping_method_id
                  JOIN users u 
                  ON o.prepared_by = u.id
                  LEFT JOIN users up
                  ON o.updated_by = up.id
                 ";
        $extraWhere =  "o.prepared_by =".$_SESSION['id']." AND  o.status = 0" ;
    }
    else if($_SESSION['user_type'] == 4)
    {
        $joinQuery = "FROM orders o
                    JOIN customer c 
                  ON o.customer_id = c.id 
                  JOIN shipping_method s
                  ON s.id = o.shipping_method_id
                  JOIN users u 
                  ON o.prepared_by = u.id
                  LEFT JOIN users up
                  ON o.updated_by = up.id
                 ";
                  // WHERE u.team_id = 3

        $extraWhere =  "u.team_id =".$_SESSION['team_id']." AND  o.status = 0" ;
    }
    else if($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2)
    {
        $joinQuery = "FROM orders o
                    JOIN customer c 
                  ON o.customer_id = c.id 
                  JOIN shipping_method s
                  ON s.id = o.shipping_method_id
                  JOIN users u 
                  ON o.prepared_by = u.id
                  LEFT JOIN users up
                  ON o.updated_by = up.id
                 ";
        $extraWhere =  "o.status = 0" ;
    }
    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
    );

