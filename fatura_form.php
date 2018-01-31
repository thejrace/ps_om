<?php
  	
	require 'inc/defs.php';

	require CLASS_DIR . "Input.php";
	require CLASS_DIR . "RKod.php";
	require CLASS_DIR . "Cari.php";
	require CLASS_DIR . "Fatura.php";
	require CLASS_DIR . "UrunGrubu.php";
	require CLASS_DIR . "StokKarti.php";
	require CLASS_DIR . "TahsilatMakbuzu.php";


	if( $_POST ){

		require CLASS_DIR . "InputErrorHandler.php";
		require CLASS_DIR . "Validation.php";
	

		$OK = 1;
        $TEXT = "";
        $DATA = array();
        $INPUT_RET = array();

		$INPUT_LIST = array(
			"fis_turu"				=> array( array( "select_not_zero" => true ),  null ),
			"cari"					=> array( array( "req" => true ), null ),
			"fatura_no"				=> array( array( "pozNumerik" => true ), null ),
			"aciklama"				=> array( array( "req" => true ), null ),
			"duzenlenme_tarihi" 	=> array( array( "req" => true ), null ),
			"stok_str"				=> array( array( "req" => true ), null ),
			"cari_tur" 				=> array( array( "req" => true, "select_not_zero" => true ),  null ),
			//'cari_adres'  			=> array( array( "req" => true ), null ),
			//'cari_il' 				=> array( array( "req" => true ), null ),
			//'cari_ilce' 			=> array( array( "req" => true ), null ),
			// 'cari_mali_tur' 		=> array( array( "req" => true ), null ),
			'vkn_tckn'  			=> array( array( "pozNumerik" => true ), null )
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

				$Validation = new Validation( new InputErrorHandler );
				$Validation->check_v2( Input::escape($_POST), $INPUT_LIST );
				if( $Validation->failed() ){
					$OK = 0;
					$INPUT_RET = $Validation->errors()->js_format_ref();
				} else {	
					$Fatura = new Fatura( Input::get("item_id"));
					if( $Fatura->is_ok() ){
						if( !$Fatura->duzenle( Input::escape($_POST) ) ){
							$OK = 0;
						}
					} else {
						$OK = 0;
					}
					$TEXT = $Fatura->get_return_text();
				}

			break;


			case 'fatura_sil':

				$Fatura = new Fatura( Input::get("item_id"));
				if( $Fatura->is_ok() ){
					$Fatura->sil();
				} else {
					$OK = 0;
				}
				$TEXT = $Fatura->get_return_text();

			break;

			case 'data_download':

				$Fatura = new Fatura(Input::get("item_id"));
				if( $Fatura->is_ok() && $Fatura->get_details("durum") ==  1){
					
					$DATA =  $Fatura->get_details();
					$DATA["duzenlenme_tarihi"] = Common::datetime_reverse( $DATA["duzenlenme_tarihi"]);
					$urunler = array();
					foreach( $Fatura->get_stok_detaylari() as $stok ){
						$Kart = new StokKarti( $stok["stok_kodu"]);
						$stok["birim"] = $Kart->get_details("birim");
						$urunler[] = $stok;
					}
					$DATA["urunler"] = $urunler;
					$CDATA = $Fatura->get_cari_kayit();
					// direk cari ozet download ile yapamadim, json parse error aldım devamlı anlayamadı bu gönül?!?!?
					$Cari = new Cari($CDATA[0]["unvan"]);
					if( $Cari->is_ok() ){
						$DATA["cari_adres"] 		= $Cari->get_details("adres") . " " . $Cari->get_details("ilce") . " / " . $Cari->get_details("il");
						$DATA["cari_telefon_1"] 	= $Cari->get_details("telefon_1");
						$DATA["cari_eposta"] 		= $Cari->get_details("eposta");
						$DATA["cari_bakiye"] 		= $Cari->bakiye_hesapla();
						$DATA["cari_unvan"] 		= $Cari->get_details("unvan");
					}
				} else {
					$OK = 0;
				}
				$TEXT = $Fatura->get_return_text();

			break;


			case 'cari_ozet_download':

				$Cari = new Cari( Input::get("cari_unvan") );
				if( $Cari->is_ok() ){
					$DATA["adres"] 			= $Cari->get_details("adres") . " " . $Cari->get_details("ilce") . " / " . $Cari->get_details("il");
					$DATA["telefon_1"] 		= $Cari->get_details("telefon_1");
					$DATA["eposta"] 		= $Cari->get_details("eposta");
					$DATA["bakiye"] 		= $Cari->bakiye_hesapla();
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


			case 'cari_fiyat_gecmisi':

				$Cari = new Cari( Input::get("cari_unvan") );
				if( $Cari->is_ok() ){
					$StokKarti = new StokKarti( Input::get("stok_karti") );
					if( $StokKarti->is_ok() ){
						if( Input::get("fis_turu") != "" ){
							$DATA = $StokKarti->cari_fiyat_gecmisi( $Cari, Input::get("fis_turu") );
						} else {
							$OK = 0;
						}
					} else {
						$OK = 0;
					}
				} else {
					$OK = 0;
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
		"title" 		=> "Fatura / Fiş Oluştur",
		"top_title" 	=> "Fatura / Fiş Oluştur",
		"template" 		=> "template_fatura_form.php",
		"html_libs" 	=> array( "datatables", "jquery-ui", "datetimepicker" )
	);


	if( Input::exists(Input::$GET, "item_id") ){
		// duzenleme

		$Fatura = new Fatura( Input::get("item_id") );
		if( !$Fatura->is_ok() || $Fatura->get_details("durum") == 0 ) header("Location: " . URL_FATURALAR );

		$FORM_REQ = "fatura_duzenle";
		$PAGE["title"] = "Fatura / Fiş Düzenleme";
		$PAGE["top_title"] = "Fatura / Fiş Düzenleme";
		$ITEM_ID = Input::get("item_id");
		$FORM_SELECT = "0"; // fatura tür select val
		$FORM_CARI = "";

	} else {

		if( !Input::exists(Input::$GET, "tur") ){
			$FORM_SELECT = "0"; // seçiniz
		} else {
			if( Input::get("tur") != Fatura::$ALIS && Input::get("tur") != Fatura::$SATIS && Input::get("tur") != Fatura::$SIPARIS_FISI &&  Input::get("tur") != Fatura::$GR_ALIS && Input::get("tur") != Fatura::$GR_SATIS  ){
				die("Form türü belirtilmedi.");
			}
			$FORM_SELECT = Input::get("tur");
		}
		$FORM_REQ = "fatura_ekle";
		$ITEM_ID = "";

		if( Input::exists(Input::$GET, "cari") ){
			$FORM_CARI = Input::get("cari");
		} else {
			$FORM_CARI = "";
		}
		
	}


	require 'inc/header.php';


  	require TEMPLATES_DIR . $PAGE["template"];


  	require 'inc/footer.php';

?>
