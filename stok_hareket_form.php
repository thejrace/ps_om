<?php
	
	include 'inc/defs.php';
	
	if( $_GET["tip"] != "giris" && $_GET["tip"] != "cikis"  ) header("Location:index.php");
	
	$TIP = $_GET["tip"];

	$PAGE = array(
		"title" 		=> "",
		"top_title"		=> "",
		"template" 		=> "template_stok_hareket_form.php",
		"html_libs" 	=> array()
	);

	if( $TIP == "giris" ){
		$PAGE["title"] = "Stok Girişi Oluştur";
		$PAGE["top_title"] = "Stok Girişi Oluştur";
	} else {
		$PAGE["title"] = "Stok Çıkışı Oluştur";
		$PAGE["top_title"] = "Stok Çıkışı Oluştur";
	}

	include 'inc/header.php';


	include TEMPLATES_DIR . $PAGE["template"];


	include 'inc/footer.php';

?>
