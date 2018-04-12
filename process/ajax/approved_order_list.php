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
                return date('Y-m-d', strtotime( $d));
            }, 'field' => 'order_date' 
        ),
    array( 'db' => "CONCAT_WS( '', `c`.`firstname`, ' ' ,`c`.`lastname` )", "dt" => 2, "field" => "customer_name", "as" => "customer_name" ),
    array( 'db' => '`o`.`remarks`',     'dt' => 3, 'field' => 'remarks' ),
    array( 'db' => '`o`.`notes`',     'dt' => 4, 'field' => 'notes' ),
    array( 'db' => '`o`.`total`', 'dt' => 5, 'formatter' => function( $d, $row )
            {
                return "$".$d;
            }, 'field' => 'total' 
        ),
    // array( 'db' => "CONCAT_WS( '', `up`.`first_name`, ' ' ,`up`.`lastname` )", "dt" => 6, "field" => "approved_by", "as" => "approved_by" ),
    // array( 'db' => '`u`.`screen_name`' , "dt" => 6, "field" => "prepared_by", "as" => "prepared_by" ),
    array( 'db' => '`up`.`screen_name`' , "dt" => 6, "field" => "approved_by", "as" => "approved_by" ),
    // array( 'db' => "CONCAT_WS( '', `up`.`first_name`, ' ' ,`up`.`lastname` )", "dt" => 7, "field" => "updated_by", "as" => "updated_by" ),
    array( 'db' => '`t`.`team_name`',     'dt' => 7, 'field' => 'team_name' ),
    array( 'db' => '`o`.`id`',          'dt' => 8, 'formatter' => function( $d, $row )
            {
              if($_SESSION['user_type'] == 1)
              {
                return '<a href="../process/order_manage.php?id='.$d.'&shipped">
                            <span class="label label-inverse" style = "color:black;">
                                <i class="fa fa-ship"></i> Ship
                            </span>
                        </a>
                        <a href="manage.php?id='.$d.'" >
                            <span class="label label-inverse" style = "color:black;">
                                <i class="fa fa-edit"></i> Edit
                            </span>
                        </a>';
              }
              else
              {
                return '
                        <a href="manage.php?id='.$d.'&view_record" >
                            <span class="label label-inverse" style = "color:black;">
                                <i class="fa fa-edit"></i> View Record
                            </span>
                        </a> &nbsp;';
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
                  JOIN users up
                  ON o.approved_by = up.id
                  JOIN teams t 
                  ON u.team_id = t.id
                 ";
        $extraWhere =  "o.prepared_by =".$_SESSION['id']." AND  o.status = 2" ;
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
                  JOIN users up
                  ON o.approved_by = up.id
                  JOIN teams t 
                  ON u.team_id = t.id
                 ";
        $extraWhere =  "u.team_id =".$_SESSION['team_id']." AND  o.status = 2" ;
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
                  JOIN users up
                  ON o.approved_by = up.id
                  JOIN teams t 
                  ON u.team_id = t.id
                 ";
        $extraWhere =  "o.status = 2" ;
    }
    
    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
    );

