<?php
	
	class Pamira {

		private static $data = array();
		public static $EKLE = 1, $CIKAR = 2;
		private static $st_return_text;
		public static function toplam_kasa_hesapla(){

		}

		public static function istatistikleri_al(){
			$q = DB::getInstance()->query("SELECT * FROM " . DBT_PAMIRA_STONE )->results();
			self::$data = $q[0];
		}

		public static function alacaklari_hesapla(){
			self::$data["alacakli_cari_sayisi"] = DB::getInstance()->query("SELECT * FROM " . DBT_CARILER . " WHERE bakiye > 0")->count();
		}

		public static function verecekleri_hesapla(){
			self::$data["verecekli_cari_sayisi"] = DB::getInstance()->query("SELECT * FROM " . DBT_CARILER . " WHERE bakiye < 0")->count();
		}

		public static function odemeleri_hesapla(){

		}

		public static function son_fis_hareketlerini_al(){
			self::$data["son_fis_hareketleri"] = DB::getInstance()->query("SELECT * FROM " . DBT_FATURALAR . " ORDER BY eklenme_tarihi DESC LIMIT 10")->results();
		}

		public static function son_makbuz_hareketlerini_al(){
			self::$data["son_makbuz_hareketleri"] = DB::getInstance()->query("SELECT * FROM " . DBT_TAHSILAT_MAKBUZLARI . " ORDER BY eklenme_tarihi DESC LIMIT 10")->results();
		}

		public static function alacaklar_toplami_guncelle( $tutar ){
			return self::toplam_guncelle( "alacak", $tutar, "Alacaklar güncellendi.");
		}

		public static function verecekler_toplami_guncelle( $tutar ){
			return self::toplam_guncelle( "verecek", $tutar, "Verecekler güncellendi.");
		}

		public static function kasayi_guncelle( $tutar ){
			DB::getInstance()->query("UPDATE " . DBT_PAMIRA_STONE . " SET kasa = ?", array( (double)self::$data["kasa"] + (double)$tutar ));
			if( DB::getInstance()->error() ){
				self::$st_return_text = "Hata oluştu.[ ".DB::getInstance()->get_error_message()." ]";
				return false;
			}
			self::$st_return_text = "Kasa güncellendi.";
			return true;
		}

		private static function toplam_guncelle( $key, $tutar, $msg){
			$yeni_tutar = (double)self::$data[$key] + (double)$tutar;
			DB::getInstance()->query("UPDATE " . DBT_PAMIRA_STONE . " SET ".$key." = ?", array( $yeni_tutar) );
			if( DB::getInstance()->error() ){
				self::$st_return_text = "Hata oluştu.[ ".DB::getInstance()->get_error_message()." ]";
				return false;
			}
			self::$st_return_text = $msg;
			return true;
		}

		public static function odemeler_toplami_guncelle( $tip, $tutar ){

		}

		public static function get_return_text(){
			return self::$st_return_text;
		}

		public static function get_data( $key = null ){
			if(isset($key)) return self::$data[$key];
			return self::$data;
		}

	}