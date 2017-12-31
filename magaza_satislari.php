<?php
	
	require 'inc/defs.php';

	if( !User::izin_kontrol( User::$IZ_MAGAZA_SATISLARI_GORUNTULEME ) ){
		header("Location: " . MAIN_URL );
	}
	
	if( $_GET ){

		require CLASS_DIR . "Input.php";
		if( Input::exists( Input::$GET, "obarey_search") ){
			require CLASS_DIR . "MagazaFisi.php";
			die( json_encode(MagazaFisi::dt_arama( $_GET )) );
		} else {
			require CLASS_DIR . 'SSP.php';

			$DATA_TABLES_ROWS = array(
				"primary_key" 	=> "id",
				"table"			=> DBT_MAGAZA_FISLERI,
				"cols" 			=> array(
					array( 'db' => 'id', 	'dt' => 0 ),
					array( 'db' => 'toplam', 'dt' => 1 ),
				    array( 'db' => 'tarih',   'dt' => 2,  'formatter' => function($d, $row){ return Common::date_reverse( $d ); } ) 
			    )
			);
			die(json_encode(
			    SSP::complex( $_GET, $DATA_TABLES_ROWS["table"], $DATA_TABLES_ROWS["primary_key"], $DATA_TABLES_ROWS["cols"], null, " durum = 1" )
			));
		}

		
	}
	
	$PAGE = array(
		"title" 		=> "Mağaza Satışları",
		"top_title"		=> "Mağaza Satışları",
		"template" 		=> "template_magaza_satislari.php",
		"html_libs" 	=> array( "datatables", "datetimepicker" )
	);


	require 'inc/header.php';


	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';

?>
