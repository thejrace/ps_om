<?php

	class Fatura extends DataCommon {

		public static $ALIS = 1, $SATIS = 2, $SATIS_FISI = 3, $GR_ALIS = 4, $GR_SATIS = 5;
		// alis faturalarnda fiyatlari - olarak ekle

		public function __construct( $id = null ){
			$this->pdo = DB::getInstance();
			$this->dt_table = DBT_FATURALAR;
			if( isset($id) ) $this->check( array("id"), $id);
		}

		public function ekle( $input ){
			// yeni cari kontrol
			$Cari = new Cari( $input["cari"] );
			if( !$Cari->is_ok() ){
				$Cari = new Cari();
				$cari_form_data = array(
					"unvan" 			=> $input["cari"],
					"eposta" 			=> $input["cari_eposta"],
					"telefon_1" 		=> $input["cari_telefon_1"],
					"telefon_2" 		=> $input["cari_telefon_2"],
					"faks_no" 			=> $input["cari_faks_no"],
					"adres" 			=> $input["cari_adres"],
					"il" 				=> $input["cari_il"],
					"ilce" 				=> $input["cari_ilce"],
					"tur"  				=> $input["cari_tur"],
					"mali_tur" 			=> $input["cari_mali_tur"],
					"iban" 				=> $input["cari_iban"],
					"vkn_tckn" 			=> $input["cari_vkn_tckn"],
					"vergi_dairesi" 	=> $input["cari_vergi_dairesi"],
					"yetkililer_str" 	=> ""
				);
				if( !$Cari->ekle($cari_form_data) ){
					$this->return_text = $Cari->get_return_text();
					return false;
				}
				// yeni cari objesini al bakiye ve cari detay için
				$Cari = new Cari( $input["cari"] );
			}	

			// fatura no kontrol
			if( trim($input["fatura_no"]) != "" ){
				if( !$this->fatura_no_kontrol( $input["fatura_no"] ) ){
					$this->return_text = "Bu numaraları faturanın kaydı zaten yapılmış.";
					return false;
				}
			}
			
			// faturayi ekle
			$this->pdo->insert( $this->dt_table, array(
				"aciklama" 				=> $input["aciklama"],
				"fatura_no"				=> trim($input["fatura_no"]),
				"cari" 					=> $Cari->get_details("id"),
				"duzenlenme_tarihi" 	=> Common::datetime_reverse($input["duzenlenme_tarihi"]),
				"tahsilat_tarihi" 		=> $input["tahsilat_tarihi"],
				"user" 					=> 0,
				"eklenme_tarihi" 		=> Common::get_current_datetime(),
				"fis_turu" 				=> $input["tur"],
				"durum" 				=> 1,
				"ara_toplam" 			=> 0,
				"genel_toplam" 			=> 0,
				"kdv_miktar" 			=> 0,
				"genel_toplam_yaziyla" 	=> "",
				"versiyon" 				=> 1
			));
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}
			$this->details["id"] = $this->pdo->lastInsertedId();

			// carinin detaylarini kaydet
			if( !$Cari->faturaya_ekle( $this->details["id"] ) ){
				$this->return_text = $Cari->get_return_text();
				return false;
			}
			$cari_detay_id = $Cari->get_details("fatura_detay_id");

			$bakiye_toplam = 0;
			$ara_toplam = 0;
			$genel_toplam = 0;
			$kdv_miktar = 0;
			// düşme - ekleme için bakiye çarpani
			$bakiye_carpan = 1;
			// stok detaylarini ekle
			foreach( explode( "||", $input["stok_str"] ) as $stok_data ){
				$data_array = explode( "##", $stok_data );
				// 0: stok_karti isim
				// 1: fiyat
				// 2: kdv
				// 3: miktar
				// 4: toplam
				// 5: yer
				// 6: id ( duzenlemede gelecek )
				$StokKarti = new StokKarti( $data_array[0] );
				if( !$StokKarti->is_ok() ){
					// yeni stok karti
					$StokKarti = new StokKarti();
					$kart_data = array(
						"stok_adi" 		=> $data_array[0],
						"urun_grubu" 	=> "Tanımsız", // def
						"satis_fiyati" 	=> $data_array[1],
						"alis_fiyati" 	=> $data_array[1],
						"kdv_orani" 	=> $data_array[2],
						"kdv_dahil" 	=> Common::kdv_dahil_hesaplama( $data_array[2], $data_array[1] ),
						"birim"			=> "Adet" // def dedim ulen
					);
					if( !$StokKarti->ekle( $kart_data ) ){
						$this->return_text = $StokKarti->get_return_text();
						return false;
					}
					// guncellenmis karti init et
					$StokKarti = new StokKarti( $data_array[0] );
				}

				
				// kartı faturaya ekleme
				if( !$StokKarti->faturaya_ekle( $this->details["id"], $input["tur"], $data_array[1], $data_array[2], $data_array[3], $data_array[4], $data_array[5] )){
					$this->return_text = $StokKarti->get_return_text();
					return false;
				}
				
				// kdvsiz
				$ara_toplam += $data_array[1] * $data_array[3];
				// kdvli
				$genel_toplam += $data_array[4];
			}

			// resmiyet kontrolu
			if( $input["tur"] == Fatura::$GR_ALIS || $input["tur"] == Fatura::$GR_SATIS ){
				// gayri resmi
				$bakiye_toplam = $ara_toplam;
				$genel_toplam = $ara_toplam;
				$kdv_miktar = 0;
			} else if( $input["tur"] == Fatura::$SATIS || $input["tur"] == Fatura::$ALIS ){
				// resmi
				$bakiye_toplam = $genel_toplam;
				$kdv_miktar = $genel_toplam - $ara_toplam;
			}

			if( $input["tur"] != Fatura::$SATIS_FISI ){
				// fis harici bakiye hareketi yapiyoruz
				if( !$Cari->bakiye_guncelle( $input["tur"], $bakiye_toplam ) ){
					$this->return_text = $Cari->get_return_text();
					return false;	
				}
			}

			// tum islemlerden sonra tekrar guncelliyoruz kaydi
			$this->pdo->query("UPDATE " . $this->dt_table . " SET 
				ara_toplam = ?,
				genel_toplam = ?,
				kdv_miktar = ?,
				genel_toplam_yaziyla = ?,
				cari = ? WHERE id = ?", array(
					$ara_toplam,
					$genel_toplam,
					$kdv_miktar,
					Common::fiyat_yaziyla($genel_toplam),
					$cari_detay_id,
					$this->details["id"]
			));
			if( $this->pdo->error() ){ 
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}

			$this->return_text = "Fatura / Fiş oluşturuldu.";
			return true;
		}

		private function fatura_no_kontrol( $no ){
			return count($this->pdo->query("SELECT * FROM " . $this->dt_table . " WHERE fatura_no = ?", array( $no ) )->results()) == 0;
		}


		public function duzenle( $input ){

		}

		public function sil(){

		} 

		public function tahsil_et(){

		}

		public function tahsilat_yap(){

		}



	}