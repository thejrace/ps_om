<?php
  	
	require 'inc/defs.php';

	require CLASS_DIR . "Input.php";

	if( $_POST ){

		require CLASS_DIR . "InputErrorHandler.php";
		require CLASS_DIR . "Validation.php";
		require CLASS_DIR . "MagazaFisi.php";

		$OK = 1;
        $TEXT = "";
        $DATA = array();
        $INPUT_RET = array();

		$INPUT_LIST = array(
			"aciklama"				=> array( array( "req" => true ), null ),
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

	$FORM_REQ = "fatura_ekle";


	require 'inc/header.php';


  	require TEMPLATES_DIR . $PAGE["template"];


  	require 'inc/footer.php';

?>
