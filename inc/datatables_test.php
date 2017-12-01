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
$table = 'cariler';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'unvan', 'dt' => 0 ),
    array( 'db' => 'tur',   'dt' => 1 ),
    array( 'db' => 'il',    'dt' => 2 ),
    array( 'db' => 'ilce',  'dt' => 3 )
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => 'Dogansaringulu9',
    'db'   => 'pamira_stone',
    'host' => 'localhost:3306'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'class/SSP.php' );
 
echo json_encode(
    SSP::simple( $_GET, $table, $primaryKey, $columns )
);