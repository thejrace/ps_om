<?php
	
	require 'inc/defs.php';

	require CLASS_DIR . "Cari.php";
	require CLASS_DIR . "Fatura.php";
	require CLASS_DIR . "TahsilatMakbuzu.php";
	require CLASS_DIR . "MagazaFisi.php";
	require CLASS_DIR . "OdemeKarti.php";
	require CLASS_DIR . "StokHareket.php";


	$PAGE = array(
		"title" 		=> "Pamira Stone",
		"top_title"		=> "Pamira Stone",
		"template" 		=> "template_index.php",
		"html_libs" 	=> array()
	);

	Pamira::alacaklari_hesapla();
	Pamira::verecekleri_hesapla();
	Pamira::son_fis_hareketlerini_al();
	Pamira::son_makbuz_hareketlerini_al();
	Pamira::son_magaza_hareketlerini_al();
	Pamira::son_odeme_hareketlerini_al();

	require 'inc/header.php';


	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';

?>
