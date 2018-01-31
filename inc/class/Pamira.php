<?php
	
	class Pamira {

		private static $data = array("kasa" => 0, "odemeler" => 0 );
		public static $EKLE = 1, $CIKAR = 2;
		private static $st_return_text;
		private static $bakiyeler = array();

		public static function bakiyeleri_ozetle(){
			$cariler = DB::getInstance()->query("SELECT * FROM " . DBT_CARILER . " WHERE durum = 1")->results();
			foreach( $cariler as $cari_item ){
				$Cari = new Cari($cari_item["id"]);
				if( $Cari->is_ok() && $Cari->get_details("durum") == 1 ){
					self::$bakiyeler[ $cari_item["id"] ] = $Cari->bakiye_hesapla();
				}
			}
		}

		// carileri bulmak icin alttaki iki metod
		public static function alacak_verecek_hesapla(){
			$alacak = 0;
			$verecek = 0;
			$alacakli_cari_sayisi = 0;
			$verecekli_cari_sayisi = 0;
			foreach( self::$bakiyeler as $bakiye ){
				if( $bakiye < 0 ){
					$verecek += $bakiye;
					$alacakli_cari_sayisi++;
				} else if( $bakiye > 0 ){
					$alacak += $bakiye;
					$verecekli_cari_sayisi++;
				}
			}
			self::$data["alacak"] = $alacak;
			self::$data["alacakli_cari_sayisi"] = $alacakli_cari_sayisi;
			self::$data["verecek"] = $verecek;
			self::$data["verecekli_cari_sayisi"] = $verecekli_cari_sayisi;
		}


		public static function kasa_ozetle(){
			$tahsilatlar = 0;
			$odemeler = 0;
			$makbuzlar = DB::getInstance()->query("SELECT * FROM " . DBT_TAHSILAT_MAKBUZLARI . " WHERE durum = ?",array(1))->results();
			foreach( $makbuzlar as $makbuz ){
				$Makbuz = new TahsilatMakbuzu($makbuz["id"]);
				if($Makbuz->is_ok() && $Makbuz->get_details("durum") == 1 ){
					if( $Makbuz->get_details("tip") == TahsilatMakbuzu::$TAHSILAT ){
						$tahsilatlar += $Makbuz->get_details("tutar");
					} else {
						$odemeler += $Makbuz->get_details("tutar");
					}
				}
			}
			// ödeme kartı
			$kartli_odemeler = DB::getInstance()->query("SELECT * FROM " . DBT_ODEMELER . " WHERE durum = ?", array(1))->results();
			foreach( $kartli_odemeler as $odeme_item ){
				$Odeme = new Odeme( $odeme_item["id"] );
				if( $Odeme->is_ok() && $Odeme->get_details("durum") == 1 ){
					$odemeler += $Odeme->get_details("tutar");
				}
			}

			// magazayi dahil et
			$magaza_satislari = DB::getInstance()->query("SELECT * FROM " . DBT_MAGAZA_FISLERI . " WHERE durum = ?",array(1))->results();
			foreach( $magaza_satislari as $magaza_item ){
				$Fis = new MagazaFisi($magaza_item["id"]);
				if( $Fis->is_ok() && $Fis->get_details("durum") == 1 ){
					$tahsilatlar += $Fis->get_details("toplam");
				}
			}

			self::$data["kasa"] = $tahsilatlar - $odemeler;
		}

		public static function son_fis_hareketlerini_al(){
			self::$data["son_fis_hareketleri"] = DB::getInstance()->query("SELECT * FROM " . DBT_FATURALAR . " WHERE durum = 1 ORDER BY eklenme_tarihi DESC LIMIT 10")->results();
		}

		public static function son_makbuz_hareketlerini_al(){
			self::$data["son_makbuz_hareketleri"] = DB::getInstance()->query("SELECT * FROM " . DBT_TAHSILAT_MAKBUZLARI . " WHERE durum = 1 ORDER BY eklenme_tarihi DESC LIMIT 10")->results();
		}

		public static function son_magaza_hareketlerini_al(){
			self::$data["son_magaza_hareketleri"] = DB::getInstance()->query("SELECT * FROM " . DBT_MAGAZA_FISLERI .  " WHERE durum = 1 ORDER BY eklenme_tarihi DESC LIMIT 10" )->results();
		}

		public static function son_odeme_hareketlerini_al(){
			self::$data["son_odeme_hareketleri"] = DB::getInstance()->query("SELECT * FROM " . DBT_ODEMELER ." WHERE durum = 1 ORDER BY eklenme_tarihi DESC LIMIT 10")->results();
		}

		// @DEPRECATED
		public static function odemeleri_guncelle( $tutar ){
			return self::toplam_guncelle( "odemeler", $tutar, "Ödemeler güncellendi.");
		}

		// @DEPRECATED
		public static function alacaklar_toplami_guncelle( $tutar ){
			return self::toplam_guncelle( "alacak", $tutar, "Alacaklar güncellendi.");
		}

		// @DEPRECATED
		public static function verecekler_toplami_guncelle( $tutar ){
			return self::toplam_guncelle( "verecek", $tutar, "Verecekler güncellendi.");
		}

		// @DEPRECATED
		public static function kasayi_guncelle( $tutar ){
			DB::getInstance()->query("UPDATE " . DBT_PAMIRA_STONE . " SET kasa = ?", array( (double)self::$data["kasa"] + (double)$tutar ));
			if( DB::getInstance()->error() ){
				self::$st_return_text = "Hata oluştu.[ ".DB::getInstance()->get_error_message()." ]";
				return false;
			}
			self::$st_return_text = "Kasa güncellendi.";
			return true;
		}

		// @DEPRECATED
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

		// @DEPRECATED
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