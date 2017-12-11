<?php
  	
	require 'inc/defs.php';

	require CLASS_DIR . "Input.php";

	if( $_POST ){

		require CLASS_DIR . "InputErrorHandler.php";
		require CLASS_DIR . "Validation.php";
		require CLASS_DIR . "RKod.php";
		require CLASS_DIR . "UrunGrubu.php";
		require CLASS_DIR . "StokKarti.php";
		require CLASS_DIR . "CariYetkili.php";
		require CLASS_DIR . "Cari.php";
		require CLASS_DIR . "Fatura.php";
		require CLASS_DIR . "TahsilatMakbuzu.php";

		$OK = 1;
        $TEXT = "";
        $DATA = array();
        $INPUT_RET = array();

		$INPUT_LIST = array(
			"tur" 					=> array( array( "select_not_zero" => true ),  null ),
			"cari"					=> array( array( "req" => true ), null ),
			"fatura_no"				=> array( array( "pozNumerik" => true ), null ),
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
					$Fatura = new Fatura();
					if( !$Fatura->magaza_fisi_kes( Input::escape($_POST) ) ){
						$OK = 0;
					} else {
						// fişi kestikten sonra tahsilat makbuzunu da kesiyoruz
						$Cari = new Cari("Mağaza");
						$TahsilatMakbuzu = new TahsilatMakbuzu();
						if( !$TahsilatMakbuzu->ekle( $Cari, array(
							"tarih" 			=> Input::get("duzenlenme_tarihi"),
							"tip"  			 	=> TahsilatMakbuzu::$TAHSILAT,
							"havale_tutar" 		=> "",
							"kredi_karti_tutar" => "",
							"cek_tutar" 		=> "",
							"pesin_tutar" 		=> $Fatura->get_details("genel_toplam"),
							"cari_kayit_id"		=> 2 // tahsilat makbuzu mağaza cari statik

						))){
							$OK = 0;
						}
					}
					$TEXT = $Fatura->get_return_text();
				}

			break;

			case 'fatura_duzenle':
			break;

			case 'data_download':
			break;


			// stok karti eklenirken faturaya, fis turune gore cariye verilen fiyati alma islemleri
			case 'stok_karti_data_download':

				$StokKarti = new StokKarti( Input::get("stok_karti") );
				if( !$StokKarti->is_ok() ){
					// eger stok karti tanimli degilse onceden fiyati belirlenmemiştir, veri donmuyoruz
					$OK = 0;
				} else {

					// birim standart
					$DATA["birim"] = $StokKarti->get_details("birim");

					if( Input::get("fis_turu") == "0" ){
						$OK = 0;
					} else {
						if( Input::get("fis_turu") == Fatura::$ALIS || Input::get("fis_turu") == FATURA::$GR_ALIS ){
							$DATA["fiyat"] = $StokKarti->get_details("alis_fiyati");
						} else {
							$DATA["fiyat"] = $StokKarti->get_details("satis_fiyati");
						}
						$DATA["kdv"] = $StokKarti->get_details("kdv_orani");
					}
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


	if( Input::exists(Input::$GET, "item_id") ){
		// duzenleme
		$FORM_REQ = "fatura_duzenle";

	} else {

		
		$FORM_REQ = "fatura_ekle";
	

	}


	require 'inc/header.php';


  	require TEMPLATES_DIR . $PAGE["template"];


  	require 'inc/footer.php';

?>
