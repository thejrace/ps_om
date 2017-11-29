<?php
  	
	include 'inc/defs.php';
	include CLASS_DIR . "Input.php";
	include CLASS_DIR . "InputErrorHandler.php";
	include CLASS_DIR . "Validation.php";

	if( $_POST ){

		$OK = 1;
        $TEXT = "";
        $DATA = array();
        $INPUT_RET = array();

		$INPUT_LIST = array(
			"cari_tur" 				=> array( array( "req" => true, "not_zero" => true ),  null ),
			'cari_unvan'			=> array( array( "req" => true ), "" ),
			'cari_eposta'  			=> array( array(), null ),
			'cari_telefon_1'  		=> array( array(), null ),
			'cari_telefon_2' 		=> array( array(), null ),
			'cari_faks_no'  		=> array( array(), null ),
			'cari_adres'  			=> array( array( "req" => true ), null ),
			'cari_il' 				=> array( array( "req" => true ), null ),
			'cari_ilce' 			=> array( array( "req" => true ), null ),
			'cari_mali_tur' 		=> array( array( "req" => true ), null ),
			'cari_iban' 			=> array( array(), null ),
			'cari_v_tck_no'  		=> array( array(), null ),
			'cari_vergi_dairesi'	=> array( array(), null )
		);

		switch( Input::get("req") ){

			case 'cari_ekle':

				$Validation = new Validation( new InputErrorHandler );
				$Validation->check_v2( Input::escape($_POST), $INPUT_LIST );
				if( $Validation->failed() ){
					$OK = 0;
					$INPUT_RET = $Validation->errors()->js_format_ref();
				} else {	
					
				}
				
			break;

			case 'cari_duzenle':


				$Validation = new Validation( new InputErrorHandler );
				$Validation->check_v2( Input::escape($_POST), $INPUT_LIST );
				if( $Validation->failed() ){
					$OK = 0;
					$INPUT_RET = $Validation->errors()->js_format_ref();
				} else {	
					
				}

			

			break;
		}

		$output = json_encode(array(
            "ok"           => $OK,           
            "text"         => $TEXT,         
            "data"         => $DATA,
            "inputret"	   => $INPUT_RET,
            "oh"           => $_POST
        ));

        echo $output;
        die;
	}

	if( Input::exists(Input::$GET, "cid") ){
		// duzenleme
		$FORM_REQ = "cari_duzenle";
	} else {
		// yeni cari ekleme 
		$FORM_REQ = "cari_ekle";

	}


	$PAGE = array(
		"title" 		=> "Cari Tanımlama",
		"top_title" 	=> "Cari Tanımlama",
		"template" 		=> "template_cari_form.php",
		"html_libs" 	=> array()
	);

	include 'inc/header.php';



  include TEMPLATES_DIR . $PAGE["template"];


  include 'inc/footer.php';

?>
