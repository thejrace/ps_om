<?php

		define("MAIN_DIR", $_SERVER["DOCUMENT_ROOT"] . "/pamira_stone/");
		define("INC_DIR", MAIN_DIR . "inc/");
		define("CLASS_DIR", INC_DIR . "class/");
		define("TEMPLATES_DIR", INC_DIR . "templates/");
		define("RES_DIR", MAIN_DIR . "res/");
		define("RES_CSS_DIR", MAIN_DIR . "res/css/");
		define("RES_JS_DIR", MAIN_DIR . "res/js/");
		define("RES_VENDORS_DIR", MAIN_DIR . "res/vendors/");


		//define("MAIN_URL", "http://localhost/pamira_stone/");
		define("MAIN_URL", "http://filmograf.com.tr/pamira_stone/");


		define("URL_CARILER", MAIN_URL . "cariler.php");
		define("URL_CARI_FORM", MAIN_URL . "cari_form.php");
		define("URL_CARI_DUZENLE_FORM", URL_CARI_FORM . "?item_id=");
		define("URL_CARI_INCELE", MAIN_URL . "cari_incele.php?item_id=");

		define("URL_FATURALAR", MAIN_URL . "faturalar.php");
		define("URL_FATURA_FORM", MAIN_URL . "fatura_form.php");
		define("URL_FATURA_DUZENLE", MAIN_URL . "fatura_form.php?item_id=");
		define("URL_FATURA_FORM_ALIS", URL_FATURA_FORM . "?tur=1");
		define("URL_FATURA_FORM_SATIS", URL_FATURA_FORM . "?tur=2");
		define("URL_SATIS_FISI_FORM", URL_FATURA_FORM . "?tur=3");
		define("URL_FATURA_INCELE", MAIN_URL . "fatura_incele.php?item_id=");

		define("URL_MAGAZA_SATIS_FORM", MAIN_URL . "magaza_satis_form.php");
		define("URL_MAGAZA_SATIS_FORM_DUZENLE", MAIN_URL . "magaza_satis_form.php?item_id=");
		define("URL_MAGAZA_SATISLARI", MAIN_URL . "magaza_satislari.php");

		define("URL_TAHSILAT_MAKBUZU", MAIN_URL . "tahsilat_makbuzu_form.php");
		define("URL_TAHSILAT_MAKBUZU_TAHSILAT", URL_TAHSILAT_MAKBUZU . "?tip=1");
		define("URL_TAHSILAT_MAKBUZU_ODEME", URL_TAHSILAT_MAKBUZU . "?tip=2");

		define("URL_LOGIN", MAIN_URL . "login.php");
		define("URL_LOGOUT", MAIN_URL . "logout.php");
		define("URL_REGISTER", MAIN_URL . "register.php");

		define("URL_ODEME_KARTLARI", MAIN_URL . "odeme_kartlari.php");
		
		define("URL_ODEME_KARTI_FORM", MAIN_URL . "odeme_karti_form.php");
		define("URL_ODEMELER", MAIN_URL . "odemeler.php");
		define("URL_ODEME_FORM", MAIN_URL . "odeme_form.php");
		define("URL_ODEME_FORM_DUZENLE", MAIN_URL . "odeme_form.php?item_id=");


		// verisinden otomatik çözecegiz türünü
		define("URL_FATURA_FORM_DUZENLE", URL_FATURA_FORM . "?item_id=");

		define("URL_STOK_HAREKETLERI", MAIN_URL . "stok_hareketleri.php");
		define("URL_STOK_HAREKET_FORM", MAIN_URL . "stok_hareket_form.php");
		define("URL_STOK_GIRIS_FORM", URL_STOK_HAREKET_FORM . "?tip=Giriş");
		define("URL_STOK_CIKIS_FORM", URL_STOK_HAREKET_FORM . "?tip=Çıkış");

		define("URL_AC_COMMON", MAIN_URL . "inc/ac_common.php");

		define("URL_STOK_KARTLARI", MAIN_URL . "stok_kartlari.php");
		define("URL_STOK_KART_FORM", MAIN_URL . "stok_kart_form.php");
		define("URL_STOK_KART_FORM_DUZENLE", URL_STOK_KART_FORM . "?item_id=");
		define("URL_STOK_KARTLARI_URUN_GRUPLARI", MAIN_URL . "stok_kartlari_urun_gruplari.php");
		define("URL_STOK_KARTLARI_URUN_GRUPLARI_FORM", MAIN_URL . "stok_kartlari_urun_gruplari_form.php");
		define("URL_STOK_KARTLARI_URUN_GRUPLARI_FORM_DUZENLE", URL_STOK_KARTLARI_URUN_GRUPLARI_FORM . "?item_id=");

		define("URL_RES", MAIN_URL . "res/");
		define("URL_CSS", URL_RES . "css/");
		define("URL_JS", URL_RES . "js/");
		define("URL_IMG", URL_RES . "img/");
		define("URL_VENDORS",  URL_RES . "vendors/" );

		ini_set('error_log', MAIN_DIR . "error.log");

		// laptop local
		/*define("DB_NAME", "pamira_stone");
		define("DB_USER", "root");
		define("DB_PASS", "");
		define("DB_IP", "localhost:3306");*/


		// PC local
		/*define("DB_NAME", "pamira_stone");
		define("DB_USER", "root");
		define("DB_PASS", "Dogansaringulu9");
		define("DB_IP", "localhost:3306");*/

		// hosting
		/*define("DB_NAME", "pamira_stone");
		define("DB_USER", "pamira_stone");
		define("DB_PASS", "WAzzabii308");
		define("DB_IP", "94.73.147.252");*/

		// radore hosting
		define("DB_NAME", "db037816");
		define("DB_USER", "user037816");
		define("DB_PASS", "WAzzabii308*");
		define("DB_IP", "mysql.local.radorehosting.com");

		/*
			15814
			Hlmknbr73-
		*/


		define("DBT_CARILER", "cariler");
		define("DBT_CARI_YETKILILER", "cari_yetkililer");
		define("DBT_STOK_KARTLARI", "stok_kartlari");
		define("DBT_STOK_KARTLARI_STOKLAR", "stok_kartlari_stoklar");
		define("DBT_STOK_KARTLARI_URUN_GRUPLARI", "stok_kartlari_urun_gruplari");
		define("DBT_STOK_YERLERI", "stok_yerler");
		define("DBT_FATURALAR", "faturalar");
		define("DBT_FATURA_STOK_DETAYLARI", "fatura_stok_detaylari");
		// define("DBT_FATURA_CARI_DETAYLARI", "fatura_cari_detaylari");
		define("DBT_TAHSILAT_MAKBUZLARI", "tahsilat_makbuzlari");
		define("DBT_ITEM_CARI_KAYITLARI", "item_cari_kayitlar");
		define("DBT_USERS", "kullanicilar");
		define("DBT_COOKIE_TOKENS", "cookie_tokens");
		define("DBT_PAMIRA_STONE", "pamira_stone");

		define("DBT_STOK_HAREKETLERI", "stok_hareketleri");
		define("DBT_STOK_HAREKETLERI_URUNLER", "stok_hareketleri_urunler");

		define("DBT_MAGAZA_FISLERI", "magaza_fisleri");
		define("DBT_MAGAZA_FISLERI_URUNLER", "magaza_fisleri_urunler");

		define("DBT_ODEMELER", "odemeler");
		define("DBT_ODEME_KARTLARI", "odeme_kartlari");

		session_start();

		require CLASS_DIR . 'Common.php';
		require CLASS_DIR . 'DB.php';

		require CLASS_DIR . "DataCommon.php";
		require CLASS_DIR . "User.php";

		// her giriste cookie çaktığım için sadece remember_me kontrolu yeter
		// giriş sayfasina girdiyse, zaten giriş yapilmis mi kontrol et
		if( isset($REG_OR_LOG) ){
			if( User::remember() ){
				header("Location: ".MAIN_URL);
			} 
		} else {
			// diger sayfalarda giris yapilmamissa login sayfasına yönlendir
			if( !User::remember() ) header("Location: ".URL_LOGIN);
			
			User::$IZINLER_TEMPLATE = array(
				User::$SEVIYE_MUHASEBE => array(
					User::$IZ_CARI_EKLE,
					User::$IZ_CARI_DUZENLE,
					User::$IZ_CARILER_GORUNTULEME,
					User::$IZ_CARI_INCELEME,
					User::$IZ_FATURA_EKLE,
					//self::$IZ_FATURA_DUZENLE,
					User::$IZ_FATURALAR_GORUNTULEME,
					User::$IZ_FATURA_INCELEME,
					User::$IZ_STOK_KARTI_EKLE,
					User::$IZ_STOK_KARTI_DUZENLE,
					User::$IZ_STOK_KARTLARI_GORUNTULEME,
					User::$IZ_STOK_KARTI_INCELEME,
					User::$IZ_URUN_GRUBU_EKLE,
					User::$IZ_URUN_GRUBU_DUZENLE,
					User::$IZ_URUN_GRUPLARI_GORUNTULEME,
					User::$IZ_TAHSILAT_MAKBUZU_EKLE,
					//self::$IZ_TAHSILAT_MAKBUZU_DUZENLE,
					User::$IZ_TAHSILAT_MAKBUZU_INCELEME,
					User::$IZ_FIS_FATURALANDIRMA,
					User::$IZ_ODEME_KARTLARI_GORUNTULEME,
					User::$IZ_ODEME_KARTI_EKLE,
					User::$IZ_ODEME_YAP,
					User::$IZ_ODEMELER_GORUNTULEME,
					User::$IZ_STOK_HAREKETLERI_GORUNTULEME,
					User::$IZ_STOK_HAREKET_GIRIS_CIKIS,
					User::$IZ_MAGAZA_SATISLARI_GORUNTULEME,
					User::$IZ_STOK_HAREKET_DUZENLEME,
					User::$IZ_STOK_HAREKET_SILME
				),
				User::$SEVIYE_NORMAL => array(
					User::$IZ_CARILER_GORUNTULEME,
					User::$IZ_CARI_INCELEME,
					User::$IZ_FATURALAR_GORUNTULEME,
					User::$IZ_FATURA_INCELEME,
					User::$IZ_STOK_KARTLARI_GORUNTULEME,
					User::$IZ_STOK_KARTI_INCELEME,
					User::$IZ_URUN_GRUPLARI_GORUNTULEME,
					User::$IZ_TAHSILAT_MAKBUZU_INCELEME,
					User::$IZ_MAGAZA_SATISLARI_GORUNTULEME
				),
				User::$SEVIYE_ADMIN => array(
					User::$IZ_CARI_EKLE,
					User::$IZ_CARI_DUZENLE,
					User::$IZ_CARILER_GORUNTULEME,
					User::$IZ_CARI_INCELEME,
					User::$IZ_FATURA_EKLE,
					User::$IZ_FATURA_DUZENLE,
					User::$IZ_FATURALAR_GORUNTULEME,
					User::$IZ_FATURA_INCELEME,
					User::$IZ_STOK_KARTI_EKLE,
					User::$IZ_STOK_KARTI_DUZENLE,
					User::$IZ_STOK_KARTLARI_GORUNTULEME,
					User::$IZ_STOK_KARTI_INCELEME,
					User::$IZ_URUN_GRUBU_EKLE,
					User::$IZ_URUN_GRUBU_DUZENLE,
					User::$IZ_URUN_GRUPLARI_GORUNTULEME,
					User::$IZ_TAHSILAT_MAKBUZU_EKLE,
					User::$IZ_TAHSILAT_MAKBUZU_DUZENLE,
					User::$IZ_TAHSILAT_MAKBUZU_INCELEME,
					User::$IZ_FIS_FATURALANDIRMA,
					User::$IZ_REGISTER,
					User::$IZ_ODEME_KARTLARI_GORUNTULEME,
					User::$IZ_ODEME_KARTI_EKLE,
					User::$IZ_ODEME_YAP,
					User::$IZ_ODEMELER_GORUNTULEME,
					User::$IZ_STOK_HAREKETLERI_GORUNTULEME,
					User::$IZ_STOK_HAREKET_GIRIS_CIKIS,
					User::$IZ_MAGAZA_SATISLARI_GORUNTULEME,
					User::$IZ_STOK_HAREKET_DUZENLEME,
					User::$IZ_STOK_HAREKET_SILME
				)

			);

			User::$IZINLER = User::$IZINLER_TEMPLATE[User::get_data("user_level")];
		}
		

		

