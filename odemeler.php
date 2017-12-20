<?php
  
	require 'inc/defs.php';
  
	if( !User::izin_kontrol( User::$IZ_ODEMELER_GORUNTULEME ) ){
		header("Location: " . MAIN_URL );
	}

  
	if( $_GET ){

		require CLASS_DIR . 'SSP.php';

		$DATA_TABLES_ROWS = array(
			"primary_key" 	=> "id",
			"table"			=> DBT_ODEMELER,
			"cols" 			=> array(
				array( 'db' => 'id', 						'dt' => 0 ),
				array( 'db' => 'kart',  					'dt' => 1 ),
				array( 'db' => 'odeme_tipi', 	 			'dt' => 2 ),
				array( 'db' => 'tutar',  					'dt' => 3 ),
				array( 'db' => 'eklenme_tarihi',  			'dt' => 4, 'formatter' => function($d, $row){ return Common::datetime_reverse( $d ); } )
		    )
		);
		die(json_encode(
		    SSP::simple( $_GET, $DATA_TABLES_ROWS["table"], $DATA_TABLES_ROWS["primary_key"], $DATA_TABLES_ROWS["cols"] )
		));
	}

	$PAGE = array(
		"title" 		=> "Ödemeler",
		"top_title"		=> "Ödemeler",
		"template" 		=> "template_odemeler.php",
		"html_libs" 	=> array( "datatables" )
	);

    require 'inc/header.php';


	           
	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';


?>
