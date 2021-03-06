<?php

	class TahsilatMakbuzu extends DataCommon {

		public static $ITEM_TIP = 2; // cari kayit icin
		public static $TAHSILAT = 1, $ODEME = 2;
		public static $TIP_STR = array( 1 => "Tahsilat", 2 => "Ödeme" );

		private $makbuz_ids = array();

		public function __construct( $id = null ){
			$this->pdo = DB::getInstance();
			$this->dt_table = DBT_TAHSILAT_MAKBUZLARI;
			if( isset($id) ) $this->check( array("id"), $id);
		}


		private function makbuz_kes( $data ){
			$this->pdo->insert( $this->dt_table, $data );
			if( $this->pdo->error() ){
				$this->return_text = "Hata oluştu[3][".$this->pdo->get_error_message()."]";
				return false;
			}
			$this->makbuz_ids[] = $this->pdo->lastInsertedId();
			return true;
		}

		public function ekle( Cari &$Cari, $input ){

			if( !User::izin_kontrol( User::$IZ_TAHSILAT_MAKBUZU_EKLE ) ){
				$this->return_text = "Bu işlemi yapmaya yetkiniz yok.";
				return false;
			}
			
			if( trim($input["tarih"]) == "" ){
				$this->return_text = "Tarih girilmedi.";
				return false;
			}

			$db_exec_array = array(
				"cari_id" 				=> $Cari->get_details("id"),
				"tarih" 				=> Common::date_reverse($input["tarih"]),
				"cari_kayit_id" 		=> 0,
				"tip"					=> $input["tip"],
				"eklenme_tarihi" 		=> Common::get_current_datetime(),
				"user" 					=> User::get_data("user_id")
			);

			$toplam_tutar = 0;
		

			if( trim($input["pesin_tutar"]) != "" ){
				$db_exec_array["tutar"] = Common::convert_try_reverse($input["pesin_tutar"]);
				$db_exec_array["tahsilat_tipi"] = "Peşin";
				if( !$this->makbuz_kes( $db_exec_array ) ) return false;
				$toplam_tutar += (double)Common::convert_try_reverse($input["pesin_tutar"]);
			}

			if( trim($input["havale_tutar"]) != "" ){
				$db_exec_array["tutar"] = Common::convert_try_reverse($input["havale_tutar"]);
				$db_exec_array["tahsilat_tipi"] = "Havale";
				$db_exec_array["banka"] = $input["havale_banka"];
				if( !$this->makbuz_kes( $db_exec_array ) ) return false;
				$toplam_tutar += (double)Common::convert_try_reverse($input["havale_tutar"]);
			}

			if( trim($input["kredi_karti_tutar"]) != "" ){
				$db_exec_array["tutar"] = Common::convert_try_reverse($input["kredi_karti_tutar"]);
				$db_exec_array["tahsilat_tipi"] = "Kredi Kartı";
				$db_exec_array["banka"] = $input["havale_banka"];
				if( !$this->makbuz_kes( $db_exec_array ) ) return false;
				$toplam_tutar += (double)Common::convert_try_reverse($input["kredi_karti_tutar"]);
			}

			if( trim($input["cek_tutar"]) != "" ){
				$db_exec_array["tutar"] = Common::convert_try_reverse($input["cek_tutar"]);
				$db_exec_array["tahsilat_tipi"] = "Çek";
				$db_exec_array["cek_no"] = $input["cek_no"];
				$db_exec_array["cek_vade"] = Common::date_reverse($input["cek_vade"]);
				if( !$this->makbuz_kes( $db_exec_array ) ) return false;
				$toplam_tutar += (double)Common::convert_try_reverse($input["cek_tutar"]);
			}

			foreach( $this->makbuz_ids as $makbuz_id ){
				if( isset($input["cari_kayit_id"] ) ){
					// statik magaza tahsilatları için
					$cari_kayit_id = $input["cari_kayit_id"];
				} else {
					if( !$Cari->item_kayit_ekle( self::$ITEM_TIP, $makbuz_id ) ){
						$this->return_text = $Cari->get_return_text();
						return false;
					}
					$cari_kayit_id = $Cari->get_details("item_detay_id");
				}
				$this->pdo->query("UPDATE " . $this->dt_table . " SET cari_kayit_id = ? WHERE id = ?", array( $cari_kayit_id, $makbuz_id));
				if( $this->pdo->error() ){
					$this->return_text = "Bir hata oluştu.[2]";
					return false;
				}	
			}
			/*if( !$Cari->bakiye_guncelle( $input["tip"], $toplam_tutar ) ){
				$this->return_text = $Cari->get_return_text();
				return false;
			}*/
				
			$this->return_text = "Makbuz(lar) kesildi.";
			return true;
		}

		public function get_cari_kayit(){
			if( $this->details["cari_kayit_id"] == 2 ){
				return $this->pdo->query("SELECT * FROM " . DBT_ITEM_CARI_KAYITLARI . " WHERE id = ?", array( 2 ))->results();
			} else {
				return $this->pdo->query("SELECT * FROM " . DBT_ITEM_CARI_KAYITLARI . " WHERE item_tip = ? && item_id = ?", array( self::$ITEM_TIP, $this->details["id"] ))->results();
			}
			
		}

	}