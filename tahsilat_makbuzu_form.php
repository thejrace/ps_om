<?php
  
	require 'inc/defs.php';
	require CLASS_DIR . "Common.php";
	require CLASS_DIR . "Input.php";
	require CLASS_DIR . "DB.php";
	require CLASS_DIR . "DataCommon.php";
	require CLASS_DIR . "Cari.php";
	require CLASS_DIR . "RKod.php";

	if( $_POST ){

		require CLASS_DIR . "InputErrorHandler.php";
		require CLASS_DIR . "Validation.php";
		require CLASS_DIR . "TahsilatMakbuzu.php";

		$OK = 1;
        $TEXT = "";
        $DATA = array();
        $INPUT_RET = array();

		$INPUT_LIST = array(
			"pesin_tutar" 			=> array( array( "pozNumerik" => true ),  null ),
			'havale_tutar'			=> array( array( "pozNumerik" => true ),  null ),
			'kredi_karti_tutar'		=> array( array( "pozNumerik" => true ),  null ),
			'cek_tutar'				=> array( array( "pozNumerik" => true ),  null ),
			'tarih'  				=> array( array( "req" => true ), null )
		);

		switch( Input::get("req") ){


			case 'tahsilat_makbuzu_kes':

				$Validation = new Validation( new InputErrorHandler );
				$Validation->check_v2( Input::escape($_POST), $INPUT_LIST );
				if( $Validation->failed() ){
					$OK = 0;
					$INPUT_RET = $Validation->errors()->js_format_ref();
				} else {
					$TahsilatMakbuzu = new TahsilatMakbuzu();
					$Cari = new Cari(Input::get("cari"));
					if( !$TahsilatMakbuzu->ekle( $Cari, Input::escape($_POST))){
						$OK = 0;
					}
					$TEXT = $TahsilatMakbuzu->get_return_text();
					$DATA = $Cari->get_details("yeni_bakiye");
				}

			break;


			case 'data_download':

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
		"title" 		=> "Tahsilat / Ödeme Makbuzu Kes",
		"top_title"		=> "Tahsilat / Ödeme Makbuzu Kes",
		"template" 		=> "template_tahsilat_makbuzu_form.php",
		"html_libs" 	=> array( "jquery-ui", "datetimepicker" )
	);

	if( !Input::exists(Input::$GET, "tip") || !Input::exists(Input::$GET, "cari") ){
		header("Location: index.php");
	} else {
		if( Input::get("tip") != "1" && Input::get("tip") != "2"){
			header("Location: index.php");
		} 

		$Cari = new Cari( Input::get("cari") );
		if( !$Cari->is_ok() ) header("Location: index.php");

		$TIP = Input::get("tip");

		if( Input::exists(Input::$GET, "tutar") ){
			$TUTAR = Input::get("tutar");
		} else {
			$TUTAR = 0;
		}
	}



    require 'inc/header.php';

	require TEMPLATES_DIR . $PAGE["template"];

	require 'inc/footer.php';