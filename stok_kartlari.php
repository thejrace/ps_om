<?php

	require 'inc/defs.php';

	if( $_GET ){

		require CLASS_DIR . 'DB.php';
		require CLASS_DIR . 'SSP.php';
		require CLASS_DIR . 'DataCommon.php';
		require CLASS_DIR . 'UrunGrubu.php';

		$DATA_TABLES_ROWS = array(
			"primary_key" 	=> "id",
			"table"			=> DBT_STOK_KARTLARI,
			"cols" 			=> array(
				array( 'db' => 'stok_kodu', 	'dt' => 0 ),
				array( 'db' => 'stok_adi', 		'dt' => 1 ),
				array( 'db' => 'urun_grubu', 	'dt' => 2, 'formatter' => function($d, $row){
					$UrunGrubu = new UrunGrubu( $d );
					return $UrunGrubu->get_details("isim");
				}),
			    array( 'db' => 'satis_fiyati',  'dt' => 3 ),
			    array( 'db' => 'kdv_dahil',    	'dt' => 4 ),
			    array( 'db' => 'stok_miktar',  	'dt' => 5 ),
			    array( 'db' => 'birim',  		'dt' => 6 )
		    )
		);
		die(json_encode(
		    SSP::simple( $_GET, $DATA_TABLES_ROWS["table"], $DATA_TABLES_ROWS["primary_key"], $DATA_TABLES_ROWS["cols"] )
		));
	}

	if( $_POST ){

		require CLASS_DIR . 'Input.php';
		require CLASS_DIR . 'DB.php';
		require CLASS_DIR . 'DataCommon.php';
		require CLASS_DIR . 'StokKarti.php';


		$OK = 1;
        $TEXT = "";
        $DATA = array();
        $INPUT_RET = array();

        switch( Input::get("req") ){

        	case "stok_karti_stok_detay_download":

        		$StokKarti = new StokKarti( Input::get("stok_karti"));
        		if( $StokKarti->is_ok() ){
        			foreach( $StokKarti->get_stok_detaylari() as $stok_detay ){
        				$DATA[] = array( "yer" => $stok_detay["yer"], "miktar" => $stok_detay["miktar"], "birim" => $StokKarti->get_details("birim") );
        			}
        		} else {
        			$OK = 0;
        		}
        		$TEXT = $StokKarti->get_return_text();

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
	
	$PAGE = array(
		"title" 		=> "Stok Kartları",
		"top_title"		=> "Stok Kartları",
		"template" 		=> "template_stok_kartlari.php",
		"html_libs" 	=> array( "datatables" )
	);


	require 'inc/header.php';


	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';

?>
