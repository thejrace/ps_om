<?php
	
	require 'inc/defs.php';

	if( !User::izin_kontrol( User::$IZ_STOK_HAREKETLERI_GORUNTULEME ) ){
		header("Location: " . MAIN_URL );
	}

  
	if( $_GET ){


		require CLASS_DIR . "Input.php";
		if( Input::exists( Input::$GET, "obarey_search") ){
			require CLASS_DIR . "StokHareket.php";
			die( json_encode(StokHareket::dt_arama( $_GET )) );
		} else {

			require CLASS_DIR . 'SSP.php';

			$DATA_TABLES_ROWS = array(
				"primary_key" 	=> "id",
				"table"			=> DBT_STOK_HAREKETLERI,
				"cols" 			=> array(
					array( 'db' => 'id', 			'dt' => 0 ),
					array( 'db' => 'tip',  			'dt' => 1 ),
					array( 'db' => 'tarih', 	 	'dt' => 3, 'formatter' => function($d, $row){ return Common::date_reverse($d);} ),
					array( 'db' => 'fis_no',  		'dt' => 2 )
			    )
			);
			die(json_encode(
			    SSP::simple( $_GET, $DATA_TABLES_ROWS["table"], $DATA_TABLES_ROWS["primary_key"], $DATA_TABLES_ROWS["cols"] )
			));
		}
	}

	$PAGE = array(
		"title" 		=> "Stok Hareketleri",
		"top_title"		=> "Stok Hareketleri",
		"template" 		=> "template_stok_hareketleri.php",
		"html_libs" 	=> array( "datatables", "datetimepicker" )
	);


	require 'inc/header.php';


	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';

?>
