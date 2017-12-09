<?php
  
	require 'inc/defs.php';


	if( !User::izin_kontrol( User::$IZ_FATURA_INCELEME ) ){
		header("Location: " . MAIN_URL );
	}

	require CLASS_DIR . "Input.php";
	require CLASS_DIR . "Cari.php";
	require CLASS_DIR . "StokKarti.php";
	require CLASS_DIR . "Fatura.php";

    $Fatura = new Fatura( Input::get("item_id") );
    if( !$Fatura->is_ok() ) header("Location: index.php");

	if( $_POST ){

		$OK = 1;
        $TEXT = "";
        $DATA = array();

		switch( Input::get("req") ){

			case 'fcevir':

				if( Input::get("convert") == "satis_faturasi" ){
					$cto = Fatura::$SATIS;
				} else {
					$cto = Fatura::$GR_SATIS;
				}
				if( !$Fatura->fis_convert( $cto ) ){
					$OK = 0;
				}
				$TEXT = $Fatura->get_return_text();

			break;

		}

		$output = json_encode(array(
            "ok"           => $OK,           
            "text"         => $TEXT,         
            "data"         => $DATA,
            "oh"		   => $_POST
        ));

        echo $output;
        die;
	}
  

	$PAGE = array(
		"title" 		=> "Fatura İncele",
		"top_title"		=> "Fatura İncele",
		"template" 		=> "template_fatura_incele.php",
		"html_libs" 	=> array()
	);



    require 'inc/header.php';

    $cari_kayit = $Fatura->get_cari_kayit();
    $stok_detaylari = $Fatura->get_stok_detaylari();


	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';


?>
