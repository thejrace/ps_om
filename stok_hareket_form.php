<?php
	
	require 'inc/defs.php';
	
	if( $_GET["tip"] != "Giriş" && $_GET["tip"] != "Çıkış"  ) header("Location:index.php");

	require CLASS_DIR . "Input.php";

	if( $_POST ){

		require CLASS_DIR . "InputErrorHandler.php";
		require CLASS_DIR . "Validation.php";
		require CLASS_DIR . "StokKarti.php";
		require CLASS_DIR . "StokHareket.php";

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
	
	$FORM_REQ = $_GET["tip"];

	$PAGE = array(
		"title" 		=> "",
		"top_title"		=> "",
		"template" 		=> "template_stok_hareket_form.php",
		"html_libs" 	=> array( "jquery-ui", "datetimepicker")
	);

	if( $FORM_REQ == "Giriş" ){
		$PAGE["title"] = "Stok Girişi Oluştur";
		$PAGE["top_title"] = "Stok Girişi Oluştur";
	} else {
		$PAGE["title"] = "Stok Çıkışı Oluştur";
		$PAGE["top_title"] = "Stok Çıkışı Oluştur";
	}

	require 'inc/header.php';


	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';

?>
