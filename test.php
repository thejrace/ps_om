<?php

	require 'inc/defs.php';
	require CLASS_DIR . "Common.php";
	require CLASS_DIR . "DB.php";
	require CLASS_DIR . "DataCommon.php";
	require CLASS_DIR . "CariYetkili.php";
	require CLASS_DIR . "Cari.php";


	function cari_ekleme_test(){
		$Cari = new Cari();
		$Cari->ekle( array(
			"cari_tur" 				=> "Alıcı - Satıcı",
			'cari_unvan'			=> "Test Cari",
			'cari_eposta'  			=> "ahmet@ahmet.com",
			'cari_telefon_1'  		=> "0539 292 2911",
			'cari_telefon_2' 		=> "",
			'cari_faks_no'  		=> "",
			'cari_adres'  			=> "it caddesi no:16",
			'cari_il' 				=> "İstanbul",
			'cari_ilce' 			=> "Beykoz",
			'cari_mali_tur' 		=> "Tüzel Kişi",
			'cari_iban' 			=> "TR00 381838384134091094",
			'cari_v_tck_no'  		=> "357078104849",
			'cari_vergi_dairesi'	=> "",
			"yetkililer_str"		=> "Ahmet Ziya Kanbur##ahmet@ahmet.com##0543 239 0269##||Mehmet Can##test@test.com####"
		));
		return $Cari->get_return_text();
	}

	//echo cari_ekleme_test();
