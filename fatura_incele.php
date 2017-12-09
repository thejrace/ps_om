<?php
  
	require 'inc/defs.php';


	if( !User::izin_kontrol( User::$IZ_FATURA_INCELEME ) ){
		header("Location: " . MAIN_URL );
	}

	require CLASS_DIR . "Input.php";
	require CLASS_DIR . "Cari.php";
	require CLASS_DIR . "StokKarti.php";
	require CLASS_DIR . "Fatura.php";
  

	$PAGE = array(
		"title" 		=> "Fatura İncele",
		"top_title"		=> "Fatura İncele",
		"template" 		=> "template_fatura_incele.php",
		"html_libs" 	=> array()
	);

    $Fatura = new Fatura( Input::get("item_id") );
    if( !$Fatura->is_ok() ) header("Location: index.php");

    require 'inc/header.php';

    $cari_kayit = $Fatura->get_cari_kayit();
    $stok_detaylari = $Fatura->get_stok_detaylari();


	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';


?>
