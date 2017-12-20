<?php
  
	require 'inc/defs.php';
  
	if( !User::izin_kontrol( User::$IZ_ODEME_KARTLARI_GORUNTULEME ) ){
		header("Location: " . MAIN_URL );
	}

  
	if( $_GET ){

		require CLASS_DIR . 'SSP.php';

		$DATA_TABLES_ROWS = array(
			"primary_key" 	=> "id",
			"table"			=> DBT_ODEME_KARTLARI,
			"cols" 			=> array(
				array( 'db' => 'id', 		'dt' => 0 ),
				array( 'db' => 'isim',  	'dt' => 1 ),
				array( 'db' => 'tip', 	 	'dt' => 2 ),
				array( 'db' => 'kalan',  	'dt' => 3 ),
				array( 'db' => 'toplam',  	'dt' => 4 ),
		    )
		);
		die(json_encode(
		    SSP::simple( $_GET, $DATA_TABLES_ROWS["table"], $DATA_TABLES_ROWS["primary_key"], $DATA_TABLES_ROWS["cols"] )
		));
	}

	$PAGE = array(
		"title" 		=> "Ödeme Kartları",
		"top_title"		=> "Ödeme Kartları",
		"template" 		=> "template_odeme_kartlari.php",
		"html_libs" 	=> array( "datatables" )
	);

    require 'inc/header.php';


	           
	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';


?>
