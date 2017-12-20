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
			"kart" 				=> array( array( "req" => true ),  null ),
			"odeme_tipi" 		=> array( array( "req" => true ),  null ),
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
					
					$OdemeKarti = new OdemeKarti(Input::get("kart"));
					if( $OdemeKarti->is_ok() ){
						if( !$OdemeKarti->odeme_yap( Input::get("tutar"), Input::get("odeme_tipi") ) ){
							$OK = 0;
						}
					} else {
						$OK = 0;
					}
					$TEXT = $OdemeKarti->get_return_text();
				}

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
		"html_libs" 	=> array("jquery-ui")
	);


	$FORM_REQ = "odeme_yap";

	require 'inc/header.php';



  	require TEMPLATES_DIR . $PAGE["template"];


  	require 'inc/footer.php';

?>
