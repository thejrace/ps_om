<?php
  	
	require 'inc/defs.php';
	require CLASS_DIR . "Common.php";
	require CLASS_DIR . "Input.php";
	require CLASS_DIR . "InputErrorHandler.php";
	require CLASS_DIR . "Validation.php";
	require CLASS_DIR . "DB.php";
	require CLASS_DIR . "DataCommon.php";
	require CLASS_DIR . "CariYetkili.php";
	require CLASS_DIR . "Cari.php";

	if( $_POST ){

		$OK = 1;
        $TEXT = "";
        $DATA = array();
        $INPUT_RET = array();

		$INPUT_LIST = array(
			"cari_tur" 				=> array( array( "req" => true, "select_not_zero" => true ),  null ),
			'cari_unvan'			=> array( array( "req" => true ), "" ),
			//'cari_eposta'  		=> array( array(), null ),
			//'cari_telefon_1' 		=> array( array(), null ),
			//'cari_telefon_2'		=> array( array(), null ),
			//'cari_faks_no'  		=> array( array(), null ),
			'cari_adres'  			=> array( array( "req" => true ), null ),
			'cari_il' 				=> array( array( "req" => true ), null ),
			'cari_ilce' 			=> array( array( "req" => true ), null ),
			'cari_mali_tur' 		=> array( array( "req" => true ), null ),
			'cari_iban' 			=> array( array(), null ),
			'vkn_tckn'  			=> array( array( "pozNumerik" => true ), null )
			//'cari_vergi_dairesi'	=> array( array(), null )
		);

		switch( Input::get("req") ){

			case 'cari_ekle':

				$Validation = new Validation( new InputErrorHandler );
				$Validation->check_v2( Input::escape($_POST), $INPUT_LIST );
				if( $Validation->failed() ){
					$OK = 0;
					$INPUT_RET = $Validation->errors()->js_format_ref();
				} else {	
					$Cari = new Cari();
					if( !$Cari->ekle( Input::escape($_POST) ) ){
						$OK = 0;
					}
					$TEXT = $Cari->get_return_text();
				}
				
			break;

			case 'cari_duzenle':


				$Validation = new Validation( new InputErrorHandler );
				$Validation->check_v2( Input::escape($_POST), $INPUT_LIST );
				if( $Validation->failed() ){
					$OK = 0;
					$INPUT_RET = $Validation->errors()->js_format_ref();
				} else {	
					$Cari = new Cari( Input::get("cid") );
					if( $Cari->is_ok() ){
						if( !$Cari->duzenle( Input::escape($_POST) ) ){
							$OK = 0;
						}
					} else {
						$OK = 0;
					}
					$TEXT = $Cari->get_return_text();
				}

			break;

			case 'cari_data_download':

				$Cari = new Cari( Input::get("cid") );
				if( $Cari->is_ok() ){
					$DATA["form"] = $Cari->get_details();
					$DATA["yetkililer"] = $Cari->get_yetkililer();
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

	$PAGE = array(
		"title" 		=> "Cari Tanımlama",
		"top_title" 	=> "Cari Tanımlama",
		"template" 		=> "template_cari_form.php",
		"html_libs" 	=> array()
	);


	if( Input::exists(Input::$GET, "cid") ){
		// duzenleme
		$FORM_REQ = "cari_duzenle";
		$PAGE["title"] = "Cari Düzenleme";
		$PAGE["top_title"] = "Cari Düzenleme";
		$CID = Input::get("cid");
	} else {
		// yeni cari ekleme 
		$FORM_REQ = "cari_ekle";
		$CID = "";
	}


	require 'inc/header.php';



  	require TEMPLATES_DIR . $PAGE["template"];


  	require 'inc/footer.php';

?>
