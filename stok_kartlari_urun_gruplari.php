<?php
  
	require 'inc/defs.php';
  
	if( !User::izin_kontrol( User::$IZ_URUN_GRUPLARI_GORUNTULEME ) ){
		header("Location: " . MAIN_URL );
	}

  
	if( $_GET ){

		require CLASS_DIR . 'SSP.php';

		$DATA_TABLES_ROWS = array(
			"primary_key" 	=> "id",
			"table"			=> DBT_STOK_KARTLARI_URUN_GRUPLARI,
			"cols" 			=> array(
				array( 'db' => 'id', 	'dt' => 0 ),
				array( 'db' => 'isim',  'dt' => 1 )
		    )
		);
		die(json_encode(
		    SSP::complex( $_GET, $DATA_TABLES_ROWS["table"], $DATA_TABLES_ROWS["primary_key"], $DATA_TABLES_ROWS["cols"], null, " durum = 1" )
		));
	}

	$PAGE = array(
		"title" 		=> "Ürün Grupları",
		"top_title"		=> "Ürün Grupları",
		"template" 		=> "template_stok_kartlari_urun_gruplari.php",
		"html_libs" 	=> array( "datatables" )
	);

    require 'inc/header.php';


	           
	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';


?>
