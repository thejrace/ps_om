<?php
	
	require 'inc/defs.php';
	
	if( $_GET["tip"] != "Giriş" && $_GET["tip"] != "Çıkış"  ) header("Location:index.php");

	require CLASS_DIR . "Input.php";
	require CLASS_DIR . "StokKarti.php";
	require CLASS_DIR . "StokHareket.php";

	if( $_POST ){

		require CLASS_DIR . "InputErrorHandler.php";
		require CLASS_DIR . "Validation.php";
		

		$OK = 1;
        $TEXT = "";
        $DATA = array();
        $INPUT_RET = array();

		$INPUT_LIST = array(
			"fis_no"				=> array( array( "req" => true ), null ),
			"tip"					=> array( array( "req" => true ), null ),
			"tarih" 				=> array( array( "req" => true ), null ),
			"stok_str"				=> array( array( "req" => true ), null )
 		);

		switch( Input::get("req") ){

			case 'stok_hareketi_ekle':

				$Validation = new Validation( new InputErrorHandler );
				$Validation->check_v2( Input::escape($_POST), $INPUT_LIST );
				if( $Validation->failed() ){
					$OK = 0;
					$INPUT_RET = $Validation->errors()->js_format_ref();
				} else {	
					
					$StokHareket = new StokHareket();
					if( !$StokHareket->ekle(Input::escape($_POST))){
						$OK = 0;
					}
					$TEXT = $StokHareket->get_return_text();

				}

			break;

			case 'stok_hareketi_duzenle':

				$Validation = new Validation( new InputErrorHandler );
				$Validation->check_v2( Input::escape($_POST), $INPUT_LIST );
				if( $Validation->failed() ){
					$OK = 0;
					$INPUT_RET = $Validation->errors()->js_format_ref();
				} else {	
					
					$StokHareket = new StokHareket( Input::get("item_id"));
					if( $StokHareket->is_ok() ){
						if( !$StokHareket->duzenle(Input::escape($_POST))){
							$OK = 0;
						}
					} else {
						$OK = 0;
					}
					
					$TEXT = $StokHareket->get_return_text();

				}

			break;

			case 'stok_hareketi_sil':

				$StokHareket = new StokHareket( Input::get("item_id"));
				if($StokHareket->is_ok() ){
					if(!$StokHareket->sil()){
						$OK = 0;
					}
				} else {
					$OK = 0;
				}
				$TEXT = $StokHareket->get_return_text();

			break;

			case 'data_download':

				$Hareket = new StokHareket(Input::get("item_id"));
				$DATA = $Hareket->get_details();
				$DATA["tarih"] = Common::date_reverse($DATA["tarih"]);
				$DATA["urunler"] = $Hareket->get_urunler();
				$TEXT = $Hareket->get_return_text();

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
	
	$TIP_REQ = $_GET["tip"];

	$PAGE = array(
		"title" 		=> "",
		"top_title"		=> "",
		"template" 		=> "template_stok_hareket_form.php",
		"html_libs" 	=> array( "jquery-ui", "datetimepicker")
	);

	if( Input::exists(Input::$GET, "item_id") ){

		$FORM_REQ = "stok_hareketi_duzenle";
		$ITEM_ID = Input::get("item_id");
		$TITLE_SUB = "Düzenle";
		$Hareket = new StokHareket( Input::get("item_id") );
		if( !$Hareket->is_ok() || $Hareket->get_details("durum") == 0 ) header("Location: " . URL_STOK_HAREKETLERI );
	} else {
		$FORM_REQ = "stok_hareketi_ekle";
		$ITEM_ID = "";
		$TITLE_SUB = "Ekle";
	}

	if( $TIP_REQ == "Giriş" ){
		$PAGE["title"] = "Stok Girişi ".$TITLE_SUB;
		$PAGE["top_title"] = "Stok Girişi ".$TITLE_SUB;
	} else {
		$PAGE["title"] = "Stok Çıkışı ".$TITLE_SUB;
		$PAGE["top_title"] = "Stok Çıkışı ".$TITLE_SUB;
	}

	require 'inc/header.php';


	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';

?>
