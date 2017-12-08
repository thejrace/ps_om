<?php
	
	require 'inc/defs.php';
	if( $_GET ){

		require CLASS_DIR . 'DB.php';
		require CLASS_DIR . 'SSP.php';

		$DATA_TABLES_ROWS = array(
			"primary_key" 	=> "id",
			"table"			=> DBT_CARILER,
			"cols" 			=> array(
				array( 'db' => 'id', 	'dt' => 0 ),
				array( 'db' => 'unvan', 'dt' => 1 ),
			    array( 'db' => 'tur',   'dt' => 2 ),
			    array( 'db' => 'il',    'dt' => 3 ),
			    array( 'db' => 'ilce',  'dt' => 4 ),
			    array( 'db' => 'bakiye',  'dt' => 5 )
		    )
		);
		die(json_encode(
		    SSP::simple( $_GET, $DATA_TABLES_ROWS["table"], $DATA_TABLES_ROWS["primary_key"], $DATA_TABLES_ROWS["cols"] )
		));
	}
	
	$PAGE = array(
		"title" 		=> "Cariler",
		"top_title"		=> "Cariler",
		"template" 		=> "template_cariler.php",
		"html_libs" 	=> array( "datatables" )
	);


	require 'inc/header.php';


	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';

?>
