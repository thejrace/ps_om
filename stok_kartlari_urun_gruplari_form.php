<?php
  	
	require 'inc/defs.php';
	require CLASS_DIR . "Input.php";
	require CLASS_DIR . "InputErrorHandler.php";
	require CLASS_DIR . "Validation.php";
	require CLASS_DIR . "RKod.php";
	require CLASS_DIR . "UrunGrubu.php";
	

	if( $_POST ){

		$OK = 1;
        $TEXT = "";
        $DATA = array();
        $INPUT_RET = array();

		$INPUT_LIST = array(
			"isim" 				=> array( array( "req" => true ),  null )
		);

		switch( Input::get("req") ){

			case 'urun_grubu_duzenle':

				$Validation = new Validation( new InputErrorHandler );
				$Validation->check_v2( Input::escape($_POST), $INPUT_LIST );
				if( $Validation->failed() ){
					$OK = 0;
					$INPUT_RET = $Validation->errors()->js_format_ref();
				} else {	
					$UrunGrubu = new UrunGrubu( Input::get("item_id") );
					if( $UrunGrubu->is_ok() ){
						if( !$UrunGrubu->duzenle( Input::escape($_POST) ) ){
							$OK = 0;
						}
					} else {
						$OK = 0;
					}
				}
				$TEXT = $UrunGrubu->get_return_text();

			


			break;

			case 'urun_grubu_ekle':

				$Validation = new Validation( new InputErrorHandler );
				$Validation->check_v2( Input::escape($_POST), $INPUT_LIST );
				if( $Validation->failed() ){
					$OK = 0;
					$INPUT_RET = $Validation->errors()->js_format_ref();
				} else {	
					$UrunGrubu = new UrunGrubu();
					if( !$UrunGrubu->ekle( Input::escape($_POST) ) ){
						$OK = 0;
					}
				}
				$TEXT = $UrunGrubu->get_return_text();

			break;

			case 'data_download':

				$UrunGrubu = new UrunGrubu( Input::get("item_id") );
				if( !$UrunGrubu->is_ok() ){
					$OK = 0;
				}
				$DATA = $UrunGrubu->get_details();
				$TEXT = $UrunGrubu->get_return_text();
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
		"title" 		=> "Ürün Grubu Tanımlama",
		"top_title" 	=> "Ürün Grubu Tanımlama",
		"template" 		=> "template_stok_kartlari_urun_gruplari_form.php",
		"html_libs" 	=> array()
	);


	if( Input::exists(Input::$GET, "item_id") ){
		// duzenleme
		$FORM_REQ = "urun_grubu_duzenle";
		$PAGE["title"] = "Ürün Grubu Düzenleme";
		$PAGE["top_title"] = "Ürün Grubu Düzenleme";
		$ITEM_ID = Input::get("item_id");
	} else {
		// yeni cari ekleme 
		$FORM_REQ = "urun_grubu_ekle";
		$ITEM_ID = "";
	}


	require 'inc/header.php';



  	require TEMPLATES_DIR . $PAGE["template"];


  	require 'inc/footer.php';

?>
