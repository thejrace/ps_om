<?php

	class MagazaFisi extends DataCommon{


		public function __construct( $id = null ){
			$this->pdo = DB::getInstance();
			$this->dt_table = DBT_MAGAZA_FISLERI;
			if( isset($id) ) $this->check( array("id"), $id);
		}

		public function ekle( $input ){

			if( !User::izin_kontrol( User::$IZ_FATURA_EKLE ) ){
				$this->return_text = "Bu işlemi yapmaya yetkiniz yok.";
				return false;
			}

			$this->pdo->insert($this->dt_table, array(
				"aciklama" 			=> $input["aciklama"],
				"tarih" 			=> Common::date_reverse($input["tarih"]),
				"user" 				=> User::get_data("user_id"),
				"eklenme_tarihi" 	=> Common::get_current_datetime(),
				"toplam" 			=> 0
			));
			if( $this->pdo->error()){
				$this->return_text = "Bir hata oluştu.[".$this->pdo->get_error_message()."]";
				return false;
			}
			$this->details["id"] = $this->pdo->lastInsertedId();
			// urunlerin kaydini ekle
			$miktar = 0;
			foreach( explode( "||", $input["stok_str"] ) as $stok_data ){
				$data_array = explode( "##", $stok_data );
				// 0 -> ürün adi
				// 1 -> birim fiyat
				// 2 -> miktar
				// 3 -> toplam
				// 4 -> odeme_tipi

				// isim bos geldiyse ipleme
				if( trim($data_array[0]) == "" ) continue;
				if( $data_array[1] == 0 || $data_array[2] == 0 || $data_array[3] == 0 ) continue;

				$this->pdo->insert( DBT_MAGAZA_FISLERI_URUNLER, array(
					"urun" 			=> $data_array[0],
					"fiyat" 		=> $data_array[1],
					"miktar" 		=> $data_array[2],
					"toplam" 		=> $data_array[3],
					"fis" 			=> $this->details["id"],
					"odeme_tipi" 	=> $data_array[4]
				));
				$miktar += (double)$data_array[3];
				if( $this->pdo->error()){
					$this->return_text = "Bir hata oluştu.[".$this->pdo->get_error_message()."]";
					return false;
				}
			}

			// toplami ekle
			$this->pdo->query("UPDATE ". $this->dt_table . " SET toplam = ? WHERE id = ?", array( $miktar, $this->details["id"]));

			// tahsil et, kasayı guncelle
			Pamira::kasayi_guncelle( $miktar );

			$this->return_text = "Mağaza fişi kesildi.";
			return true;

		}

	}