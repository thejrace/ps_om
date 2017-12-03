<?php

	class Fatura extends DataCommon {

		public static $ALIS = 1, $SATIS = 2, $SATIS_FISI = 3, $GR_ALIS = 4, $GR_SATIS = 5;
		public static $TUR_STR = array(
			1 => "Alış",
			2 => "Satış",
			3 => "Satış Fişi",
			4 => "Gayriresmi Alış",
			5 => "Gayriresmi Satış"
		);
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
					"cari_unvan" 				=> $input["cari"],
					"cari_eposta" 				=> $input["cari_eposta"],
					"cari_telefon_1" 			=> $input["cari_telefon_1"],
					"cari_telefon_2" 			=> $input["cari_telefon_2"],
					"cari_faks_no" 				=> $input["cari_faks_no"],
					"cari_adres" 				=> $input["cari_adres"],
					"cari_il" 					=> $input["cari_il"],
					"cari_ilce" 				=> $input["cari_ilce"],
					"cari_tur"  				=> $input["cari_tur"],
					"cari_mali_tur" 			=> $input["cari_mali_tur"],
					"cari_iban" 				=> $input["cari_iban"],
					"cari_vkn_tckn" 			=> $input["cari_vkn_tckn"],
					"cari_vergi_dairesi" 		=> $input["cari_vergi_dairesi"],
					"yetkililer_str" 			=> ""
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
					$this->return_text = "Bu numaralı faturanın kaydı zaten yapılmış.";
					return false;
				}
			}
			
			// faturayi ekle
			$this->pdo->insert( $this->dt_table, array(
				"aciklama" 				=> $input["aciklama"],
				"fatura_no"				=> trim($input["fatura_no"]),
				"cari_id" 				=> $Cari->get_details("id"),
				"cari_kayit_id"			=> 0,
				"duzenlenme_tarihi" 	=> Common::datetime_reverse($input["duzenlenme_tarihi"]),
				"tahsilat_tarihi" 		=> Common::datetime_reverse($input["tahsilat_tarihi"]),
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

				// isim bos geldiyse ipleme
				if( trim($data_array[0]) == "" ) continue;

				// 0: stok_karti isim
				// 1: fiyat
				// 2: kdv
				// 3: miktar
				// 4: toplam
				// 5: yer
				// 6: id ( duzenlemede gelecek )
				// 7: birim
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
						"birim"			=> $data_array[7]
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
				cari_kayit_id = ? WHERE id = ?", array(
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

		public function get_stok_detaylari(){
			return $this->pdo->query("SELECT * FROM " . DBT_FATURA_STOK_DETAYLARI . " WHERE fatura_id = ?", array( $this->details["id"]))->results();
		}

		public function get_cari_kayit(){
			return $this->pdo->query("SELECT * FROM " . DBT_FATURA_CARI_DETAYLARI . " WHERE fatura_id = ?", array( $this->details["id"] ))->results();
		}

		public function stok_detaylari_arama( $kw_array ){
			// fatraya ayni urun iki row olarka girerse bunda kaçırıyor.
			// tum fatura ekleme sistemlerini degistirmemiz gerek.
			// ama ayin urunden farkli kdv li girebilir mi ?!
			foreach( $this->get_stok_detaylari() as $stok_detay ){
				if( in_array($stok_detay["stok_adi"], $kw_array) || in_array($stok_detay["stok_kodu"], $kw_array) ){
					$this->details["fiyat"] = $stok_detay["birim_fiyat"];
					$this->details["kdv"]   = $stok_detay["kdv_orani"];
					$this->details["miktar"] = $stok_detay["miktar"];
					return true;
				}
			}
			return false;
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