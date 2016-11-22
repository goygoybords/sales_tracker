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
$table = 'products';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => '`p`.`id`', 'dt' => 0, 'field' => 'id' ),
    array( 'db' => '`p`.`product_description`',   'dt' => 1, 'field' => 'product_description' ),
    array( 'db' => '`p`.`product_price`',         'dt' => 2, 'field' => 'product_price' ),
    array( 'db' => '`p`.`id`',                    'dt' => 3, 'formatter' => function( $d, $row )
            {
                if($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2)
                {
                    return '<a href="manage.php?id='.$d.'" >
                            <span class="label label-inverse" style = "color:black;">
                                <i class="fa fa-edit"></i> Edit
                            </span>
                        </a> &nbsp;
                        <a href="../process/product_manage.php?id='.$d.'&p=list&del" onclick="return confirm(\'Are you sure you want to delete this record?\')" >
                            <span class="label label-inverse" style = "color:black;">
                                <i class="fa fa-remove"></i> Delete
                            </span>
                        </a>
                        ';
                }
                else
                    return '<a href="manage.php?id='.$d.'" >
                            <span class="label label-inverse" style = "color:black;">
                                <i class="fa fa-edit"></i> View Product
                            </span>
                        </a> &nbsp;';
                
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
    
    $joinQuery = "FROM products p
                
                 ";
    $extraWhere =  "p.status = 1" ;
    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
    );

