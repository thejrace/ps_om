<?php
  
	require 'inc/defs.php';
	require CLASS_DIR . "Common.php";
	require CLASS_DIR . "Input.php";

	if( Input::exists(Input::$GET, "term") ){
		// ürün grubu otokompilit
		require CLASS_DIR . "DB.php";
		$q = array();
		foreach( DB::getInstance()->query("SELECT isim FROM " . DBT_STOK_KARTLARI_URUN_GRUPLARI . " WHERE isim LIKE ? || isim LIKE ? || isim LIKE ?", array("%".Input::get("term"), Input::get("term")."%", "%".Input::get("term")."%"))->results() as $res ) $q[] = $res["isim"];
		die( json_encode($q));

	}

	if( $_POST ){

		require CLASS_DIR . "InputErrorHandler.php";
		require CLASS_DIR . "Validation.php";
		require CLASS_DIR . "DB.php";
		require CLASS_DIR . "DataCommon.php";
		require CLASS_DIR . "RKod.php";
		require CLASS_DIR . "UrunGrubu.php";
		require CLASS_DIR . "StokKarti.php";

		$OK = 1;
        $TEXT = "";
        $DATA = array();
        $INPUT_RET = array();

		$INPUT_LIST = array(
			"stok_adi" 			=> array( array( "req" => true ),  null ),
			'urun_grubu'		=> array( array( "req" => true ), "" ),
			'alis_fiyati'  		=> array( array( "req" => true, "pozNumerik" => true ), null ),
			'satis_fiyati' 		=> array( array( "req" => true, "pozNumerik" => true ), null ),
			'kdv_orani' 		=> array( array( "req" => true, "pozNumerik" => true ), null ),
			'kdv_dahil' 		=> array( array( "req" => true, "pozNumerik" => true ), null ),
			'birim' 			=> array( array( "select_not_zero" => true  ), null )
		);

		switch( Input::get("req") ){


			case 'stok_kart_ekle':

				$Validation = new Validation( new InputErrorHandler );
				$Validation->check_v2( Input::escape($_POST), $INPUT_LIST );
				if( $Validation->failed() ){
					$OK = 0;
					$INPUT_RET = $Validation->errors()->js_format_ref();
				} else {	
					$StoKKarti = new StokKarti();
					if( !$StoKKarti->ekle( Input::escape($_POST) ) ){
						$OK = 0;
					}
					$TEXT = $StoKKarti->get_return_text();
				}

			break;

			case 'stok_kart_duzenle':

				$Validation = new Validation( new InputErrorHandler );
				$Validation->check_v2( Input::escape($_POST), $INPUT_LIST );
				if( $Validation->failed() ){
					$OK = 0;
					$INPUT_RET = $Validation->errors()->js_format_ref();
				} else {	
					$StoKKarti = new StokKarti( Input::get("item_id"));
					if( !$StoKKarti->duzenle( Input::escape($_POST) ) ){
						$OK = 0;
					}
					$TEXT = $StoKKarti->get_return_text();
				}

			break;

			case 'data_download':

				$StokKarti = new StokKarti( Input::get("item_id"));
				if( $StokKarti->is_ok() ){
					$UrunGrubu = new UrunGrubu( $StokKarti->get_details("urun_grubu"));
					$DATA = $StokKarti->get_details();
					$DATA["urun_grubu"] = $UrunGrubu->get_details("isim");
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
		"title" 		=> "Stok Kart Tanımlama",
		"top_title"		=> "Stok Kart Tanımlama",
		"template" 		=> "template_stok_kart_form.php",
		"html_libs" 	=> array( "jquery-ui")
	);

	if( Input::exists(Input::$GET, "item_id") ){
		// duzenleme
		$FORM_REQ = "stok_kart_duzenle";
		$PAGE["title"] = "Stok Kart Düzenleme";
		$PAGE["top_title"] = "Stok Kart Düzenleme";
		$ITEM_ID = Input::get("item_id");
	} else {
		// yeni cari ekleme 
		$FORM_REQ = "stok_kart_ekle";
		$ITEM_ID = "";
	}


    require 'inc/header.php';


	  	/**

			DB - stok_kartlari
			*******************
			{ 
				"Adı":			{ "db":"ad",			"form":"stok_adi" },
				"Ürün Grubu":	{ "db":"urun_grubu", 	"form":"stok_urun_grubu" },
				"Alış Fiyatı":	{ "db":"alis_fiyati", 	"form":"stok_alis_fiyati" },
				"Satış Fiyatı":	{ "db":"satis_fiyati", 	"form":"stok_satis_fiyati" },
				"KDV":			{ "db":"kdv", 			"form":"stok_kdv" },
				"KDV Dahil":	{ "db":"kdv_dahil", 	"form":"stok_kdv_dahil" },
				"Birim":		{ "db":"birim", 		"form":"stok_birim" }
			}
			

	  */


	           
	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';


?>
