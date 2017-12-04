<?php

		define("MAIN_DIR", $_SERVER["DOCUMENT_ROOT"] . "/pamira_stone/");
		define("INC_DIR", MAIN_DIR . "inc/");
		define("CLASS_DIR", INC_DIR . "class/");
		define("TEMPLATES_DIR", INC_DIR . "templates/");
		define("RES_DIR", MAIN_DIR . "res/");
		define("RES_CSS_DIR", MAIN_DIR . "res/css/");
		define("RES_JS_DIR", MAIN_DIR . "res/js/");
		define("RES_VENDORS_DIR", MAIN_DIR . "res/vendors/");


		define("MAIN_URL", "http://localhost/pamira_stone/");
		//define("MAIN_URL", "http://ahsaphobby.net/pamira_stone/");


		define("URL_CARILER", MAIN_URL . "cariler.php");
		define("URL_CARI_FORM", MAIN_URL . "cari_form.php");
		define("URL_CARI_DUZENLE_FORM", URL_CARI_FORM . "?item_id=");

		define("URL_FATURALAR", MAIN_URL . "faturalar.php");
		define("URL_FATURA_FORM", MAIN_URL . "fatura_form.php");
		define("URL_FATURA_FORM_ALIS", URL_FATURA_FORM . "?tur=1");
		define("URL_FATURA_FORM_SATIS", URL_FATURA_FORM . "?tur=2");
		define("URL_SATIS_FISI_FORM", URL_FATURA_FORM . "?tur=3");
		define("URL_FATURA_INCELE", MAIN_URL . "fatura_incele.php?item_id=");

		define("URL_TAHSILAT_MAKBUZU", MAIN_URL . "tahsilat_makbuzu_form.php");
		define("URL_TAHSILAT_MAKBUZU_TAHSILAT", URL_TAHSILAT_MAKBUZU . "?tip=1");
		define("URL_TAHSILAT_MAKBUZU_ODEME", URL_TAHSILAT_MAKBUZU . "?tip=2");

		// verisinden otomatik çözecegiz türünü
		define("URL_FATURA_FORM_DUZENLE", URL_FATURA_FORM . "?item_id=");

		define("URL_STOK_HAREKETLERI", MAIN_URL . "stok_hareketleri.php");
		define("URL_STOK_HAREKET_FORM", MAIN_URL . "stok_hareket_form.php");
		define("URL_STOK_GIRIS_FORM", URL_STOK_HAREKET_FORM . "?tip=giris");
		define("URL_STOK_CIKIS_FORM", URL_STOK_HAREKET_FORM . "?tip=cikis");


		define("URL_STOK_KARTLARI", MAIN_URL . "stok_kartlari.php");
		define("URL_STOK_KART_FORM", MAIN_URL . "stok_kart_form.php");
		define("URL_STOK_KART_FORM_DUZENLE", URL_STOK_KART_FORM . "?item_id=");
		define("URL_STOK_KARTLARI_URUN_GRUPLARI", MAIN_URL . "stok_kartlari_urun_gruplari.php");
		define("URL_STOK_KARTLARI_URUN_GRUPLARI_FORM", MAIN_URL . "stok_kartlari_urun_gruplari_form.php");
		define("URL_STOK_KARTLARI_URUN_GRUPLARI_FORM_DUZENLE", URL_STOK_KARTLARI_URUN_GRUPLARI_FORM . "?item_id=");

		define("URL_RES", MAIN_URL . "res/");
		define("URL_CSS", URL_RES . "css/");
		define("URL_JS", URL_RES . "js/");
		define("URL_VENDORS",  URL_RES . "vendors/" );

		ini_set('error_log', MAIN_DIR . "error.log");

		define("DB_NAME", "pamira_stone");
		define("DB_USER", "root");
		define("DB_PASS", "Dogansaringulu9");
		define("DB_IP", "localhost:3306");

		/*define("DB_NAME", "pamira_stone");
		define("DB_USER", "pamira_stone");
		define("DB_PASS", "WAzzabii308");
		define("DB_IP", "94.73.147.252");*/



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