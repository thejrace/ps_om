<?php
	
	require 'inc/defs.php';

	require CLASS_DIR . 'Input.php';
	require CLASS_DIR . 'Cari.php';


	if( !User::izin_kontrol( User::$IZ_CARI_INCELEME ) ){
		header("Location: " . MAIN_URL );
	}

	if( Input::exists(Input::$GET, "item_id") ){
		$Cari = new Cari(Input::get("item_id"));
		if( !$Cari->is_ok() || $Cari->get_details("durum") == 0 ) header("Location: index.php");
	} else {
		header("Location: index.php");
	}

	if( $_POST ){


		$OK = 1;
        $TEXT = "";
        $DATA = array();
        $INPUT_RET = array();

        switch( Input::get("req") ){

        	case 'cari_sil':
        		$Cari = new Cari(Input::get("item_id"));
        		if( $Cari->is_ok() && $Cari->get_details("durum") == 1 ){
        			if( !$Cari->sil() ){
        				$OK = 0;
        			}
        		} else {
        			$OK = 0;
        		}
        		$TEXT = $Cari->get_return_text();
        	break;
        }

        $output = json_encode(array(
            "ok"           => $OK,           
            "text"         => $TEXT,         
            "data"         => $DATA,
            "inputret"	   => $INPUT_RET,
            "oh"           => Input::escape($_POST)
        ));

        echo $output;
        die;

	}

	if( $_GET ){

		
		require CLASS_DIR . 'SSP.php';
		require CLASS_DIR . 'Fatura.php';
		require CLASS_DIR . 'TahsilatMakbuzu.php';

		if( Input::exists(Input::$GET, "dt_download")){
			if( Input::get("dt_id") == "faturalar" ){
				$DATA_TABLES_ROWS = array(
					"primary_key" 	=> "id",
					"table"			=> DBT_FATURALAR,
					"cols" 			=> array(
						array( 'db' => 'id', 					'dt' => 0 ),
						array( 'db' => 'aciklama', 				'dt' => 1 ),
					    array( 'db' => 'fis_turu',   			'dt' => 2, 'formatter' => function($d, $row){ return Fatura::$TUR_STR[$d]; }),
					    array( 'db' => 'ara_toplam',    		'dt' => 3 ),
					    array( 'db' => 'genel_toplam',  		'dt' => 4 ),
					    array( 'db' => 'duzenlenme_tarihi',  	'dt' => 5, 'formatter' => function($d, $row){ return Common::datetime_reverse($d);  } )
				    )
				);
			} else {
				$DATA_TABLES_ROWS = array(
					"primary_key" 	=> "id",
					"table"			=> DBT_TAHSILAT_MAKBUZLARI,
					"cols" 			=> array(
						array( 'db' => 'id', 				'dt' => 0 ),
						array( 'db' => 'tip', 				'dt' => 1, 'formatter' => function($d, $row){ return TahsilatMakbuzu::$TIP_STR[$d]; } ),
						array( 'db' => 'tahsilat_tipi',  	'dt' => 2 ),
					    array( 'db' => 'tutar',    			'dt' => 3 ),
					    array( 'db' => 'tarih',    			'dt' => 4, 'formatter' => function($d, $row){ return Common::date_reverse($d); } )
					    
				    )
				);
			}	
			die(json_encode(
			    SSP::complex( $_GET, $DATA_TABLES_ROWS["table"], $DATA_TABLES_ROWS["primary_key"], $DATA_TABLES_ROWS["cols"], null, " cari_id = '".$Cari->get_details("id")."'" )
			));
		}
	}
	
	$PAGE = array(
		"title" 		=> "Cari İncele",
		"top_title"		=> "Cari İncele",
		"template" 		=> "template_cari_incele.php",
		"html_libs" 	=> array( "datatables" )
	);


	require 'inc/header.php';


	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';
