<?php
  
	require 'inc/defs.php';
  
	if( !User::izin_kontrol( User::$IZ_ODEMELER_GORUNTULEME ) ){
		header("Location: " . MAIN_URL );
	}

	if( $_POST ){

		$OK = 1;
        $TEXT = "";
		require CLASS_DIR . "Input.php";
		require CLASS_DIR . "Odeme.php";
		if( Input::get("req") == "odeme_sil" ){

			$Odeme = new Odeme(Input::get("item_id"));
			if( $Odeme->is_ok() ){
				$Odeme->sil();
			} else {
				$OK = 0;
			}
			$TEXT = $Odeme->get_return_text();
		}

		$output = json_encode(array(
            "ok"           => $OK,           
            "text"         => $TEXT
        ));

        echo $output;
        die;

	}

  
	if( $_GET ){
		require CLASS_DIR . "Input.php";
		if( Input::exists( Input::$GET, "obarey_search") ){
			require CLASS_DIR . "Odeme.php";
			die( json_encode(Odeme::dt_arama( $_GET )) );
		} else {
			require CLASS_DIR . 'SSP.php';
			$DATA_TABLES_ROWS = array(
				"primary_key" 	=> "id",
				"table"			=> DBT_ODEMELER,
				"cols" 			=> array(
					array( 'db' => 'id', 						'dt' => 0 ),
					array( 'db' => 'aciklama',  					'dt' => 1 ),
					array( 'db' => 'odeme_tipi', 	 			'dt' => 2 ),
					array( 'db' => 'tutar',  					'dt' => 3 ),
					array( 'db' => 'tarih',  					'dt' => 4, 'formatter' => function($d, $row){ return Common::date_reverse( $d ); } )
			    )
			);
			die(json_encode(
			    //SSP::simple( $_GET, $DATA_TABLES_ROWS["table"], $DATA_TABLES_ROWS["primary_key"], $DATA_TABLES_ROWS["cols"] )
			    SSP::complex( $_GET, $DATA_TABLES_ROWS["table"], $DATA_TABLES_ROWS["primary_key"], $DATA_TABLES_ROWS["cols"], null, " durum = 1" )

			));
		}

		
	}

	$PAGE = array(
		"title" 		=> "Ödemeler",
		"top_title"		=> "Ödemeler",
		"template" 		=> "template_odemeler.php",
		"html_libs" 	=> array( "datatables", "jquery-ui", "datetimepicker" )
	);

    require 'inc/header.php';


	           
	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';


?>
