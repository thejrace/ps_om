<?php
  	
	require 'inc/defs.php';

	require CLASS_DIR . "Input.php";
	require CLASS_DIR . "MagazaFisi.php";

	if( $_POST ){

		require CLASS_DIR . "InputErrorHandler.php";
		require CLASS_DIR . "Validation.php";
		

		$OK = 1;
        $TEXT = "";
        $DATA = array();
        $INPUT_RET = array();

		$INPUT_LIST = array(
			
			"duzenlenme_tarihi" 	=> array( array( "req" => true ), null ),
			"stok_str"				=> array( array( "req" => true ), null )
 		);

		switch( Input::get("req") ){

			case 'fatura_ekle':

				$Validation = new Validation( new InputErrorHandler );
				$Validation->check_v2( Input::escape($_POST), $INPUT_LIST );
				if( $Validation->failed() ){
					$OK = 0;
					$INPUT_RET = $Validation->errors()->js_format_ref();
				} else {	
					
					$MagazaFisi = new MagazaFisi();
					if( !$MagazaFisi->ekle(Input::escape($_POST))){
						$OK = 0;
					}
					$TEXT = $MagazaFisi->get_return_text();

				}

			break;

			case 'fatura_duzenle':

				$Validation = new Validation( new InputErrorHandler );
				$Validation->check_v2( Input::escape($_POST), $INPUT_LIST );
				if( $Validation->failed() ){
					$OK = 0;
					$INPUT_RET = $Validation->errors()->js_format_ref();
				} else {	
					
					$MagazaFisi = new MagazaFisi( Input::get("item_id"));
					if( $MagazaFisi->is_ok() ){
						if( !$MagazaFisi->duzenle(Input::escape($_POST))){
							$OK = 0;
						}
					} else {
						$OK = 0;
					}
					
					$TEXT = $MagazaFisi->get_return_text();

				}

			break;


			case 'fatura_sil':

				$MagazaFisi = new MagazaFisi( Input::get("item_id") );
				if( !$MagazaFisi->sil() ){
					$OK = 0;
				}
				$TEXT = $MagazaFisi->get_return_text();

			break;

			case 'data_download':

				$MagazaFisi = new MagazaFisi( Input::get("item_id") );
				if( $MagazaFisi->is_ok() ){
					$DATA = $MagazaFisi->get_details();
					$DATA["tarih"] = Common::date_reverse($DATA["tarih"]);
					$DATA["urunler"] = $MagazaFisi->get_urunler();
				} else {
					$OK = 0;
				}
				$TEXT = $MagazaFisi->get_return_text();

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
		"title" 		=> "Mağaza Satışı",
		"top_title" 	=> "Mağaza Satışı",
		"template" 		=> "template_magaza_satis_form.php",
		"html_libs" 	=> array( "datatables", "jquery-ui", "datetimepicker" )
	);

	if( Input::exists(Input::$GET, "item_id") ){
		$FORM_REQ = "fatura_duzenle";
		$ITEM_ID  = Input::get("item_id");
		$Fis = new MagazaFisi( $ITEM_ID );
		if( !$Fis->is_ok() || $Fis->get_details("durum") == 0 ) header("Location: ".URL_MAGAZA_SATISLARI);
	} else {
		$FORM_REQ = "fatura_ekle";
		$ITEM_ID  = "";
	}

	


	require 'inc/header.php';


  	require TEMPLATES_DIR . $PAGE["template"];


  	require 'inc/footer.php';

?>
