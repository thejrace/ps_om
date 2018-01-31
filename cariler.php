<?php
	
	require 'inc/defs.php';

	if( !User::izin_kontrol( User::$IZ_CARILER_GORUNTULEME ) ){
		header("Location: " . MAIN_URL );
	}
	
	if( $_GET ){

		require CLASS_DIR . 'SSP.php';
		require CLASS_DIR . 'TahsilatMakbuzu.php';
		require CLASS_DIR . 'Fatura.php';
		require CLASS_DIR . 'Cari.php';

		$DATA_TABLES_ROWS = array(
			"primary_key" 	=> "id",
			"table"			=> DBT_CARILER,
			"cols" 			=> array(
				array( 'db' => 'id', 	'dt' => 0 ),
				array( 'db' => 'unvan', 'dt' => 1 ),
			    array( 'db' => 'tur',   'dt' => 2 ),
			    array( 'db' => 'il',    'dt' => 3 ),
			    array( 'db' => 'ilce',  'dt' => 4 ),
			    array( 'db' => 'bakiye',  'dt' => 5, 'formatter' => function( $d, $row ){
			    	$Cari = new Cari( $d );
			    	return $Cari->bakiye_hesapla();
			    })
		    )
		);
		die(json_encode(
		    SSP::complex( $_GET, $DATA_TABLES_ROWS["table"], $DATA_TABLES_ROWS["primary_key"], $DATA_TABLES_ROWS["cols"], null, " durum = 1" )
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
