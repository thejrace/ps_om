<?php
  	
	require 'inc/defs.php';
	require CLASS_DIR . "Common.php";
	require CLASS_DIR . "Input.php";
	require CLASS_DIR . "DB.php";


	if( $_POST ){

		require CLASS_DIR . "InputErrorHandler.php";
		require CLASS_DIR . "Validation.php";
		require CLASS_DIR . "DataCommon.php";
		require CLASS_DIR . "UrunGrubu.php";
		require CLASS_DIR . "StokKarti.php";
		require CLASS_DIR . "CariYetkili.php";
		require CLASS_DIR . "Cari.php";
		require CLASS_DIR . "Fatura.php";

		$OK = 1;
        $TEXT = "";
        $DATA = array();
        $INPUT_RET = array();

		$INPUT_LIST = array(
			"tur" 				=> array( array( "select_not_zero" => true ),  null ),
			"cari"				=> array( array( "req" => true ), null ),
			"fatura_no"			=> array( array( "pozNumerik" => true ), null ),
			"aciklama"			=> array( array( "req" => true ), null ),
			"duzenlenme_tarihi" => array( array( "req" => true ), null ),
			"stok_str"			=> array( array( "req" => true ), null )
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
					if( !$Fatura->ekle( Input::escape($_POST) ) ){
						$OK = 0;
					}
					$TEXT = $Fatura->get_return_text();
				}

			break;

			case 'fatura_duzenle':
			break;

			case 'data_download':
			break;


			case 'cari_ozet_download':

				$Cari = new Cari( Input::get("cari_unvan") );
				if( $Cari->is_ok() ){
					$DATA["adres"] = $Cari->get_details("adres") . " " . $Cari->get_details("ilce") . " / " . $Cari->get_details("il");
					$DATA["bakiye"] = $Cari->get_details("bakiye");
				} else {
					$OK = 0;
				}
				$TEXT = $Cari->get_return_text();

			break;

			// stok karti eklenirken faturaya, fis turune gore cariye verilen fiyati alma islemleri
			case 'stok_karti_data_download':

				$StokKarti = new StokKarti( Input::get("stok_karti") );
				if( !$StokKarti->is_ok() ){
					// eger stok karti tanimli degilse onceden fiyati belirlenmemiştir, veri donmuyoruz
					$OK = 0;
				} else {
					// inputta fis turu seçiniz.. ise false donuyoruz
					if( Input::get("fis_turu") == "0" ){
						$OK = 0;
					} else {
						$Cari = new Cari( Input::get("cari") );
						if( $Cari->is_ok() ){
							
							$son_data = $StokKarti->cariye_verilen_son_fiyati_al( $Cari->get_details("id"), Input::get("fis_turu") );
							$DATA["fiyat"] = $son_data["fiyat"];
							$DATA["kdv"]   = $son_data["kdv"];

						} else {
							// cari kaydi yok false donuyoruz gene
							$OK = 0;
						}
					}
				}

			break;

			case 'ac':
				$q = array();
				if( Input::get("tip") == "cari" ){
					$q = Cari::ac_arama(Input::get("term"));
				} else {
					$q = StokKarti::ac_arama(Input::get("term"));
				}
				die( json_encode($q));
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
		"title" 		=> "Fatura / Fiş Oluştur",
		"top_title" 	=> "Fatura / Fiş Oluştur",
		"template" 		=> "template_fatura_form.php",
		"html_libs" 	=> array( "jquery-ui" )
	);


	if( Input::exists(Input::$GET, "item_id") ){
		// duzenleme
		$FORM_REQ = "fatura_duzenle";
		$PAGE["title"] = "Fatura / Fiş Düzenleme";
		$PAGE["top_title"] = "Fatura / Fiş Düzenleme";
		$ITEM_ID = Input::get("item_id");
		$FORM_SELECT = "0"; // fatura tür select val

	} else {

		if( !Input::exists(Input::$GET, "tur") ){
			$FORM_SELECT = "0"; // seçiniz
		} else {
			require CLASS_DIR . "DataCommon.php";
			require CLASS_DIR . "Fatura.php";	

			if( Input::get("tur") != Fatura::$ALIS && Input::get("tur") != Fatura::$SATIS && Input::get("tur") != Fatura::$SATIS_FISI &&  Input::get("tur") != Fatura::$GR_ALIS && Input::get("tur") != Fatura::$GR_SATIS  ){
				die("Form türü belirtilmedi.");
			}
			$FORM_SELECT = Input::get("tur");
		}
		$FORM_REQ = "fatura_ekle";
		$ITEM_ID = "";
		
	}


	require 'inc/header.php';


  	require TEMPLATES_DIR . $PAGE["template"];


  	require 'inc/footer.php';

?>