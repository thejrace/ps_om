<?php
	
	require 'defs.php';


	require CLASS_DIR . 'Input.php';

	if( Input::get("req") == "ac" ){

		$q = array();

		switch( Input::get("tip") ){
			case 'cari':
				require CLASS_DIR . "Cari.php";
				$q = Cari::ac_arama(Input::get("term"));
			break;

			case 'stok_karti':
				require CLASS_DIR . "StokKarti.php";
				$q = StokKarti::ac_arama(Input::get("term"));
			break;

			case 'urun_grubu':
				require CLASS_DIR . "UrunGrubu.php";
				$q = UrunGrubu::ac_arama(Input::get("term"));
			break;

			case 'odeme_karti':
				require CLASS_DIR . "OdemeKarti.php";
				$q = OdemeKarti::ac_arama(Input::get("term"));
			break;
		}

		die( json_encode($q));



	}