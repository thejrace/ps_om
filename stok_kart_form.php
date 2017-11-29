<?php
  
	include 'inc/defs.php';
  
	$PAGE = array(
		"title" 		=> "Stok Kart Tanımlama",
		"top_title"		=> "Stok Kart Tanımlama",
		"template" 		=> "templates/template_stok_kart_form.php",
		"html_libs" 	=> array()
	);

    include 'inc/header.php';


	  	/**

			DB - stok_kartlari
			*******************
			{ 
				"Adı":			{ "db":"ad",			"form":"stok_adi" },
				"Ürün Grubu":	{ "db":"urun_grubu", 	"form":"stok_urun_grubu" },
				"Alış Fiyatı":	{ "db":"alis_fiyati", 	"form":"stok_alis_fiyati" },
				"Satış Fiyatı":	{ "db":"satis_fiyati", 	"form":"stok_satis_fiyati" },
				"KDV":			{ "db":"kdv", 			"form":"stok_kdv" },
				"KDV Dahil":	{ "db":"kdv_dahil", 	"form":"stok_kdv_dahil" },
				"Birim":		{ "db":"birim", 		"form":"stok_birim" }
			}
			

	  */




	           
	include TEMPLATES_DIR . $PAGE["template"];


	include 'inc/footer.php';


?>
