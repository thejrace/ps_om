<?php

	class StokHareket extends DataCommon {

		public function __construct( $id = null ){
			$this->pdo = DB::getInstance();
			$this->dt_table = DBT_STOK_HAREKETLERI;
			if( isset($id) ) $this->check( array("id"), $id);
		}

		public function ekle( $input ){

			if( !User::izin_kontrol( User::$IZ_STOK_HAREKET_GIRIS_CIKIS ) ){
				$this->return_text = "Bu işlemi yapmaya yetkiniz yok.";
				return false;
			}

			$kontrol = $this->pdo->query("SELECT * FROM " . $this->dt_table . " WHERE fis_no = ?", array($input["fis_no"]))->count();
			if($kontrol > 0 ){
				$this->return_text = "Bu fiş nolu stok hareketi daha önceden yapılmış.";
				return false;
			}

			$this->pdo->insert($this->dt_table, array(
				"tip" 					=> $input["tip"],
				"user" 					=> User::get_data("user_id"),
				"tarih" 				=> Common::date_reverse($input["tarih"]),
				"eklenme_tarihi" 		=> Common::get_current_datetime(),
				"fis_no" 				=> $input["fis_no"]
			));
			if($this->pdo->error()){
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}
			$this->details["id"] = $this->pdo->lastInsertedId();

			if( $input["tip"] == "Giriş" ){
				$miktar_carpan = 1;
			} else {
				$miktar_carpan = -1;
			}

			foreach( explode( "||", $input["stok_str"] ) as $stok_data ){
				$data_array = explode( "##", $stok_data );

				// 0 -> stok isim
				// 1 -> miktar
				// 2 -> yer

				// isim bos geldiyse ipleme
				if( trim($data_array[0]) == "" ) continue;
				if( (double)$data_array[1] == 0 ) continue;

				$StokKarti = new StokKarti( $data_array[0] );
				if( !$StokKarti->is_ok() ){
					// yeni stok karti
					$StokKarti = new StokKarti();
					$kart_data = array(
						"stok_adi" 		=> $data_array[0],
						"urun_grubu" 	=> "Tanımsız", // def
						"satis_fiyati" 	=> 0,
						"alis_fiyati" 	=> 0,
						"kdv_orani" 	=> 18,
						"kdv_dahil" 	=> 0,
						"birim"			=> "Adet"
					);
					if( !$StokKarti->ekle( $kart_data ) ){
						$this->return_text = $StokKarti->get_return_text();
						return false;
					}
					// guncellenmis karti init et
					$StokKarti = new StokKarti( $data_array[0] );
				}

				$StokKarti->stok_guncelle( $data_array[2], (double)$data_array[1] * $miktar_carpan );
				$StokKarti->stok_hareket_detay_ekle( $this->details["id"], (double)$data_array[1], $data_array[2] );
			}

			$this->return_text = "Stok hareketi eklendi.";
			return true;
		}

	}