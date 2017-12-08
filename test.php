<?php

	require 'inc/defs.php';

	//session_start();
	require CLASS_DIR . 'Common.php';
	require CLASS_DIR . 'DB.php';
	require CLASS_DIR . 'Input.php';
	require CLASS_DIR . 'DataCommon.php';
	require CLASS_DIR . 'CariYetkili.php';
	require CLASS_DIR . 'Cari.php';
	require CLASS_DIR . 'Fatura.php';
	require CLASS_DIR . 'DTArama.php';




	echo '<pre>';
	print_r( DTArama::fatura_custom(array(
		"fis_turu" 		=> "0",
		"cari" 			=> "",
		"fiyat_tipi" 	=> "",
		"fiyat_alt" 	=> "",
		"fiyat_ust" 	=> "",
		"tarih_alt" 	=> "2017-12-03",
		"tarih_ust" 	=> ""
	)));	