<?php
  	
	require 'inc/defs.php';
	require CLASS_DIR . "Input.php";
	require CLASS_DIR . "InputErrorHandler.php";
	require CLASS_DIR . "Validation.php";
	require CLASS_DIR . "OdemeKarti.php";
	

	if( $_POST ){

		$OK = 1;
        $TEXT = "";
        $DATA = array();
        $INPUT_RET = array();

		$INPUT_LIST = array(
			"isim" 				=> array( array( "req" => true ),  null ),
			"tip" 				=> array( array( "select_not_zero" => true ),  null ),
			"toplam" 			=> array( array( "not_zero" => true ),  null )
		);

		switch( Input::get("req") ){

			case 'odeme_karti_ekle':

				$Validation = new Validation( new InputErrorHandler );
				$Validation->check_v2( Input::escape($_POST), $INPUT_LIST );
				if( $Validation->failed() ){
					$OK = 0;
					$INPUT_RET = $Validation->errors()->js_format_ref();
				} else {	
					
					$OdemeKarti = new OdemeKarti();
					if( !$OdemeKarti->ekle( Input::escape($_POST)) ){
						$OK = 0;
					}
					$TEXT = $OdemeKarti->get_return_text();
				}

			break;

			case 'odeme_karti_duzenle':

				$Validation = new Validation( new InputErrorHandler );
				$Validation->check_v2( Input::escape($_POST), $INPUT_LIST );
				if( $Validation->failed() ){
					$OK = 0;
					$INPUT_RET = $Validation->errors()->js_format_ref();
				} else {	
					$OdemeKarti = new OdemeKarti(Input::get("item_id"));
					if( $OdemeKarti->is_ok() ){
						if( !$OdemeKarti->duzenle( Input::escape($_POST)) ){
							$OK = 0;
						}	
					} else {
						$OK = 0;
					}
					$TEXT = $OdemeKarti->get_return_text();
				}
				
			break;

			case 'data_download':

				$OdemeKarti = new OdemeKarti( Input::get("item_id") );
				if( $OdemeKarti->is_ok() ){
					$DATA = $OdemeKarti->get_details();
				} else {
					$OK = 0;
				}
				$TEXT = $OdemeKarti->get_return_text();
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
		"title" 		=> "Ödeme Kartı Tanımlama",
		"top_title" 	=> "Ödeme Kartı Tanımlama",
		"template" 		=> "template_odeme_karti_form.php",
		"html_libs" 	=> array()
	);


	if( Input::exists(Input::$GET, "item_id") ){
		// duzenleme
		$FORM_REQ = "odeme_karti_duzenle";
		$PAGE["title"] = "Ödeme Kartı Düzenleme";
		$PAGE["top_title"] = "Ödeme Kartı Düzenleme";
		$ITEM_ID = Input::get("item_id");
	} else {
		// yeni cari ekleme 
		$FORM_REQ = "odeme_karti_ekle";
		$ITEM_ID = "";
	}


	require 'inc/header.php';



  	require TEMPLATES_DIR . $PAGE["template"];


  	require 'inc/footer.php';

?>
