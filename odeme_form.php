<?php
  	
	require 'inc/defs.php';
	require CLASS_DIR . "Input.php";
	require CLASS_DIR . "InputErrorHandler.php";
	require CLASS_DIR . "Validation.php";
	require CLASS_DIR . "Odeme.php";
	

	if( $_POST ){

		$OK = 1;
        $TEXT = "";
        $DATA = array();
        $INPUT_RET = array();

		$INPUT_LIST = array(
			// "kart" 				=> array( array( "req" => true ),  null ),
			"odeme_tipi" 		=> array( array( "req" => true ),  null ),
			"banka_ekstra"		=> array( array(), null ),
			"aciklama"			=> array( array(), null ),
			"tarih"				=> array( array(), null ),
			"tutar" 			=> array( array( "req" => true, "pozNumerik" => true ),  null )
		);

		switch( Input::get("req") ){

			case 'odeme_yap':

				$Validation = new Validation( new InputErrorHandler );
				$Validation->check_v2( Input::escape($_POST), $INPUT_LIST );
				if( $Validation->failed() ){
					$OK = 0;
					$INPUT_RET = $Validation->errors()->js_format_ref();
				} else {	
					
					$Odeme = new Odeme();
					if( !$Odeme->ekle( Input::escape($_POST) ) ){
						$OK = 0;
					}
					$TEXT = $Odeme->get_return_text();
				}

			break;


			case 'odeme_duzenle':

				$Validation = new Validation( new InputErrorHandler );
				$Validation->check_v2( Input::escape($_POST), $INPUT_LIST );
				if( $Validation->failed() ){
					$OK = 0;
					$INPUT_RET = $Validation->errors()->js_format_ref();
				} else {	
					$Odeme = new Odeme( Input::get("item_id"));
					if( $Odeme->is_ok() ){
						if( !$Odeme->duzenle( Input::escape($_POST) ) ){
							$OK = 0;
						}
					} else {
						$OK = 0;
					}
					$TEXT = $Odeme->get_return_text();
				}

			break;

			case 'data_download':

				$Odeme = new Odeme(Input::get("item_id"));
				if( $Odeme->is_ok() && $Odeme->get_details("durum") == 1 ){
					$DATA = $Odeme->get_details();
					$DATA["tarih"] = Common::date_reverse($DATA["tarih"]);
				} else {
					$OK = 0;
				}
				$TEXT = $Odeme->get_return_text();


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
		"title" 		=> "Ödeme Yap",
		"top_title" 	=> "Ödeme Yap",
		"template" 		=> "template_odeme_form.php",
		"html_libs" 	=> array("jquery-ui", "datetimepicker")
	);

	if( Input::exists(Input::$GET, "item_id") ){
		$FORM_REQ = "odeme_duzenle";
		$ITEM_ID = Input::get("item_id");
	} else {
		$FORM_REQ = "odeme_yap";
		$ITEM_ID = "";
	}
	

	require 'inc/header.php';



  	require TEMPLATES_DIR . $PAGE["template"];


  	require 'inc/footer.php';

?>
