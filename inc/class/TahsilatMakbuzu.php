<?php

	class TahsilatMakbuzu extends DataCommon {

		public static $ITEM_TIP = 2; // cari kayit icin
		public static $TAHSILAT = 1, $ODEME = 2;
		public static $TIP_STR = array( 1 => "Tahsilat", 2 => "Ödeme" );

		public function __construct( $id = null ){
			$this->pdo = DB::getInstance();
			$this->dt_table = DBT_TAHSILAT_MAKBUZLARI;
			if( isset($id) ) $this->check( array("id"), $id);
		}

		public function ekle( Cari &$Cari, $input ){
			$this->pdo->insert( $this->dt_table, array(
				"cari" 				=> $Cari->get_details("id"),
				"cari_kayit_id" 	=> 0,
				"tutar" 			=> $input["tutar"],
				"tip" 				=> $input["tip"],
				"tahsilat_tipi" 	=> $input["tahsilat_tipi"],
				"tarih" 			=> Common::date_reverse( $input["tarih"] ),
				"eklenme_tarihi" 	=> Common::get_current_datetime(),
				"user" 				=> 0
			));
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}
			$this->details["id"] = $this->pdo->lastInsertedId();

			if( !$Cari->item_kayit_ekle( self::$ITEM_TIP, $this->details["id"] ) ){
				$this->return_text = $Cari->get_return_text();
				return false;
			}
			$cari_kayit_id = $Cari->get_details("item_detay_id");

			if( !$Cari->bakiye_guncelle( $input["tip"], $input["tutar"] ) ){
				$this->return_text = $Cari->get_return_text();
				return false;
			}

			// TODO kasa, çek hesaplari falan guncellenecek burada
			if( $input["tahsilat_tipi"] == "Havale" ){
				$this->pdo->query("UPDATE " . $this->dt_table . " SET 
					cari_kayit_id = ?,
					banka = ? WHERE id = ?", array(
						$cari_kayit_id,
						$input["banka"],
						$this->details["id"]
				));
			} else if( $input["tahsilat_tipi"] == "Çek" ){
				$this->pdo->query("UPDATE " . $this->dt_table . " SET 
					cari_kayit_id = ?,
					cek_no = ?,
					cek_vade = ? WHERE id = ?", array(
						$cari_kayit_id,
						$input["cek_no"],
						Common::date_reverse($input["cek_vade"]),
						$this->details["id"]
				));
			} else {
				$this->pdo->query("UPDATE " . $this->dt_table . " SET 
					cari_kayit_id = ? WHERE id = ?", array(
						$cari_kayit_id,
						$this->details["id"]
				));
			}

			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}

			$this->return_text = "Tahsilat makbuzu kesildi.";
			return true;
		}
		

	}