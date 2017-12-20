<?php

	class OdemeKarti extends DataCommon {

		public function __construct( $id = null ){
			$this->pdo = DB::getInstance();
			$this->dt_table = DBT_ODEME_KARTLARI;
			if( isset($id) ) $this->check( array("id", "isim"), $id);
		}

		public function ekle( $input ){

			if( !User::izin_kontrol( User::$IZ_ODEME_KARTI_EKLE ) ){
				$this->return_text = "Bu işlemi yapmaya yetkiniz yok.";
				return false;
			}

			$kontrol = $this->pdo->query("SELECT * FROM " . $this->dt_table ." WHERE isim = ?", array( $input["isim"]))->count();
			if( $kontrol > 0 ){
				$this->return_text = "Bu ödeme kartı daha önceden eklenmiş.";
				return false;
			}
			if( $input["toplam"] == "" ){
				$toplam = 0;
			} else {
				$toplam = $input["toplam"];
			}
			$this->pdo->insert( $this->dt_table, array(
				"isim" 		=> $input["isim"],
				"tip" 		=> $input["tip"],
				"toplam" 	=> $toplam,
				"kalan" 	=> $toplam
			));
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}

			$this->return_text = "Ödeme Kartı eklendi.";
			return true;

		}

		public function duzenle( $input ){
			$this->return_text = "Bu işlemi gerçekleştiremezsiniz.";
			return false;
		}

		public function odeme_yap( $tutar, $odeme_tipi ){

			$yeni_kalan = 0; 
			$kalan_guncelle_flag = false;
			// ödeme toplamı olan kartlar için kontrol
			if( $this->details["toplam"] > 0 ){
				if( $this->details["kalan"] > 0 ){
					// fazla odeme yapmasini engellicez
					$yeni_kalan = $this->details["kalan"] - (double)$tutar;
					if( $yeni_kalan < 0 ){
						$this->return_text = "Kalan ödemeden fazla ödeme yapılamaz.( " . ( $yeni_kalan * - 1 ) . " fazladan ödeme yapmaya çalıştınız. )";
						return false;
					}
					$kalan_guncelle_flag = true;
				}
			}
			$this->pdo->insert(DBT_ODEMELER, array(
				"kart" 				=> $this->details["isim"],
				"odeme_tipi" 		=> $odeme_tipi,
				"tutar" 			=> $tutar,
				"user" 				=> User::get_data("user_id"),
				"eklenme_tarihi" 	=> Common::get_current_datetime()
			));
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}
			if( $kalan_guncelle_flag ){
				$this->pdo->query("UPDATE " . $this->dt_table . " SET kalan = ? WHERE id = ?", array( $yeni_kalan, $this->details["id"]));
				if( $this->pdo->error() ){
					$this->return_text = "Bir hata oluştu.[2][".$this->pdo->get_error_message()."]";
					return false;
				}
				$this->details["kalan"] = $yeni_kalan;
			}

			Pamira::kasayi_guncelle( (double)$tutar * -1 );

			$this->return_text = "Ödeme yapıldı.";
			return true;
		}


		public static function ac_arama( $term ){
			$q = array();
			foreach( DB::getInstance()->query("SELECT isim FROM " . DBT_ODEME_KARTLARI . " WHERE isim LIKE ? || isim LIKE ? || isim LIKE ?", array("%".$term, $term."%", "%".$term."%"))->results() as $res ) $q[] = $res["isim"];
			return $q;
		}

	}