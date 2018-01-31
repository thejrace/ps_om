<?php

	class Fatura extends DataCommon {

		public static $ITEM_TIP = 1; // cari kayit icin
		public static $ALIS = 1, $SATIS = 2, $SIPARIS_FISI = 3, $GR_ALIS = 4, $GR_SATIS = 5;
		public static $TUR_STR = array(
			1 => "Alış",
			2 => "Satış",
			3 => "Sipariş Fişi",
			4 => "Alış Fişi",
			5 => "Satış Fişi"
		);
		// alis faturalarnda fiyatlari - olarak ekle

		public function __construct( $id = null ){
			$this->pdo = DB::getInstance();
			$this->dt_table = DBT_FATURALAR;
			if( isset($id) ) $this->check( array("id"), $id);
		}

	
		public function ekle( $input ){
			if( !User::izin_kontrol( User::$IZ_FATURA_EKLE ) ){
				$this->return_text = "Bu işlemi yapmaya yetkiniz yok.";
				return false;
			}

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
				"user" 					=> User::get_data("user_id"),
				"eklenme_tarihi" 		=> Common::get_current_datetime(),
				"fis_turu" 				=> $input["fis_turu"],
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
			if( !$Cari->item_kayit_ekle( self::$ITEM_TIP, $this->details["id"] ) ){
				$this->return_text = $Cari->get_return_text();
				return false;
			}
			$cari_detay_id = $Cari->get_details("item_detay_id");

			$bakiye_toplam = 0;
			$ara_toplam = 0;
			$genel_toplam = 0;
			$kdv_miktar = 0;
			// düşme - ekleme için bakiye çarpani
			$bakiye_carpan = 1;


			// resmiyet kontrolu
			if( $input["fis_turu"] == Fatura::$GR_ALIS || $input["fis_turu"] == Fatura::$GR_SATIS  ){
				// gayri resmi
				$resmi = false;
			} else if( $input["fis_turu"] == Fatura::$SATIS || $input["fis_turu"] == Fatura::$ALIS || $input["fis_turu"] == Fatura::$SIPARIS_FISI){
				// resmi
				$resmi = true;
			}

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
				// 6: birim
				// 7: id ( duzenlemede gelecek )
				$StokKarti = new StokKarti( $data_array[0] );
				if( !$StokKarti->is_ok() ){
					// yeni stok karti
					$StokKarti = new StokKarti();
					$kart_data = array(
						"stok_adi" 		=> $data_array[0],
						"stok_kodu"		=> "",
						"urun_grubu" 	=> "Tanımsız", // def
						"satis_fiyati" 	=> Common::convert_try_reverse($data_array[1]),
						"alis_fiyati" 	=> Common::convert_try_reverse($data_array[1]),
						"kdv_orani" 	=> $data_array[2],
						"kdv_dahil" 	=> Common::convert_try_reverse(Common::kdv_dahil_hesaplama( $data_array[2], $data_array[1] )),
						"birim"			=> $data_array[6]
					);
					if( !$StokKarti->ekle( $kart_data ) ){
						$this->return_text = $StokKarti->get_return_text();
						return false;
					}
					// guncellenmis karti init et
					$StokKarti = new StokKarti( $data_array[0] );
				}

				
				// kartı faturaya ekleme
				if( !$StokKarti->faturaya_ekle( $this->details["id"], $input["fis_turu"], Common::convert_try_reverse($data_array[1]), $data_array[2], Common::convert_try_reverse($data_array[3]), $data_array[6], Common::convert_try_reverse($data_array[4]), $data_array[5], (int)$resmi  )){
					$this->return_text = $StokKarti->get_return_text();
					return false;
				}
				
				// kdvsiz
				$ara_toplam += Common::convert_try_reverse($data_array[1]) * Common::convert_try_reverse($data_array[3]);
				// kdvli
				$genel_toplam += Common::convert_try_reverse($data_array[4]);
			}

			// resmiyet kontrolu
			if( !$resmi  ){
				// gayri resmi
				$bakiye_toplam = $ara_toplam;
				$genel_toplam = $ara_toplam;
				$kdv_miktar = 0;
			} else {
				// resmi
				$bakiye_toplam = $genel_toplam;
				$kdv_miktar = $genel_toplam - $ara_toplam;
			}

			/*if( $input["fis_turu"] != Fatura::$SIPARIS_FISI ){
				// fis harici bakiye hareketi yapiyoruz
				if( !$Cari->bakiye_guncelle( $input["fis_turu"], $bakiye_toplam ) ){
					$this->return_text = $Cari->get_return_text();
					return false;	
				}
			}*/

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

		public function duzenle( $input ){

			if( !User::izin_kontrol( User::$IZ_FATURA_DUZENLE ) ){
				$this->return_text = "Bu işlemi yapmaya yetkiniz yok.";
				return false;
			}

			// ekleme metoduyla senkronize gidiyor
			// cari değişmiş mi kontrol
			$EskiCari = new Cari( $this->details["cari_id"] );
			$cari_id = $this->details["cari_id"];
			$cari_detay_id  = $this->details["cari_kayit_id"];
			if( $EskiCari->is_ok() ){
				if( $EskiCari->get_details("unvan") != $input["cari"] ){
					// cari degismis
					// 1- önceki carinin bakiyesini güncelle
					// 2- yeni carinin bakiyesini güncelle
					// 3- cari_kayit_item db den güncellenecek

					// ilk iki adım toplam fatura tutarı hesaplandıktan sonra yapılacak
					$YeniCari = new Cari( $input["cari"] );
					if( !$YeniCari->is_ok() ){
						// yeni cariyi formla kayıt etmişse fatura sayfasından
						$YeniCari = new Cari();
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
						if( !$YeniCari->ekle($cari_form_data) ){
							$this->return_text = $YeniCari->get_return_text();
							return false;
						}
						// yeni cari objesini al bakiye ve cari detay için
						$YeniCari = new Cari( $input["cari"] );
					}

					// cari item id yi guncellemiyoruz, silip yenisini ekliyoruz
					$cid_query = $this->get_cari_kayit();
					$this->pdo->query("DELETE FROM " . DBT_ITEM_CARI_KAYITLARI . " WHERE id = ?", array( $cid_query[0]["id"]));

					// yenisi ekle
					if( !$YeniCari->item_kayit_ekle( self::$ITEM_TIP, $this->details["id"] ) ){
						$this->return_text = $YeniCari->get_return_text();
						return false;
					}
					// bu ve cari_id fatura db ye eklenecek
					$cari_detay_id = $YeniCari->get_details("item_detay_id");
					$cari_id = $YeniCari->get_details("id");
				}
			}

			// fatura no kontrol
			if( trim($input["fatura_no"]) != "" ){
				if( !$this->fatura_no_kontrol( $input["fatura_no"] ) ){
					$this->return_text = "Bu numaralı faturanın kaydı zaten yapılmış.";
					return false;
				}
			}

			$bakiye_toplam = 0;
			$ara_toplam = 0;
			$genel_toplam = 0;
			$kdv_miktar = 0;
			// düşme - ekleme için bakiye çarpani
			$bakiye_carpan = 1;

			// resmiyet kontrolu
			if( $input["fis_turu"] == Fatura::$GR_ALIS || $input["fis_turu"] == Fatura::$GR_SATIS  ){
				// gayri resmi
				$resmi = false;
			} else if( $input["fis_turu"] == Fatura::$SATIS || $input["fis_turu"] == Fatura::$ALIS || $input["fis_turu"] == Fatura::$SIPARIS_FISI){
				// resmi
				$resmi = true;
			}

			// array_key_exists kontrolü için düzenleme yap array ec
			$faturaya_kayitli_stok_kartlari = array();
			foreach(  $this->get_stok_detaylari() as $stok_detay_data ) $faturaya_kayitli_stok_kartlari[$stok_detay_data["stok_adi"]] = $stok_detay_data;

			// silinmis kayitli verilerin id lerini ayiklayabilmek icin, islem gormusleri toplayacagimiz array
			$islem_gormus_kartlar = array();

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
				// 6: birim
				// 7: id ( duzenlemede gelecek )
				$StokKarti = new StokKarti( $data_array[0] );
				if( !$StokKarti->is_ok() ){
					// yeni stok karti
					$StokKarti = new StokKarti();
					$kart_data = array(
						"stok_adi" 		=> $data_array[0],
						"stok_kodu"		=> "",
						"urun_grubu" 	=> "Tanımsız", // def
						"satis_fiyati" 	=> Common::convert_try_reverse($data_array[1]),
						"alis_fiyati" 	=> Common::convert_try_reverse($data_array[1]),
						"kdv_orani" 	=> $data_array[2],
						"kdv_dahil" 	=> Common::convert_try_reverse(Common::kdv_dahil_hesaplama( $data_array[2], $data_array[1] )),
						"birim"			=> $data_array[6]
					);
					if( !$StokKarti->ekle( $kart_data ) ){
						$this->return_text = $StokKarti->get_return_text();
						return false;
					}
					// guncellenmis karti init et
					$StokKarti = new StokKarti( $data_array[0] );
				}
				// kayitli olanlari güncelleme yapmadan direk silip, yeniden ekliyoruz
				if( trim($data_array[7]) != "" ){
					// stok kartı formda ve kayitlarda mevcut
					// eski kaydini sil
					$this->pdo->query("DELETE FROM " . DBT_FATURA_STOK_DETAYLARI . " WHERE id = ?", array( $data_array[7]));
					$islem_gormus_kartlar[] = $data_array[7];
				}

				// kartı faturaya ekle
				// ( kayitli olanlari veya yeni eklenenleri ekleme, her turlu ekleme yapiyoruz  )
				if( !$StokKarti->faturaya_ekle( $this->details["id"], $input["fis_turu"], Common::convert_try_reverse($data_array[1]), $data_array[2], Common::convert_try_reverse($data_array[3]), $data_array[6], Common::convert_try_reverse($data_array[4]), $data_array[5], (int)$resmi  )){
					$this->return_text = $StokKarti->get_return_text();
					return false;
				}
				
				// kdvsiz
				$ara_toplam += Common::convert_try_reverse($data_array[1]) * Common::convert_try_reverse($data_array[3]);
				// kdvli
				$genel_toplam += Common::convert_try_reverse($data_array[4]);
			}

			// formda id si yok ama kayitlarda var olan, düzenleme esnasında silinmiş kartları uçur
			foreach( $faturaya_kayitli_stok_kartlari as $kayitli_kart ){
				if( !in_array( $kayitli_kart["id"], $islem_gormus_kartlar ) ){
					$this->pdo->query("DELETE FROM " . DBT_FATURA_STOK_DETAYLARI ." WHERE id = ?",array( $kayitli_kart["id"]));
				}
			}

			// resmiyet kontrolu
			if( !$resmi  ){
				// gayri resmi
				$bakiye_toplam = $ara_toplam;
				$genel_toplam = $ara_toplam;
				$kdv_miktar = 0;
			} else {
				// resmi
				$bakiye_toplam = $genel_toplam;
				$kdv_miktar = $genel_toplam - $ara_toplam;
			}

			// kullanıcının bakiyesini eski kayda göre geri alıyoruz
			// sonra yeni kaydın bakiye toplamına göre tekrar güncelliyoruz
			// kayıt satışsa bakiyesini azaltıcaz ( 0 a yakınlaşacak, alacağımız azalacak )
			// kayıt alışsa bakiyesini arttırcaz  ( 0 dan uzaklaşacak, vereceğimiz azalacak )
			/*if( $this->details["fis_turu"] == Fatura::$SATIS || $this->details["fis_turu"] == Fatura::$GR_SATIS ){
				if( isset($YeniCari)){
					$YeniCari->bakiye_guncelle( Fatura::$ALIS, $bakiye_toplam );
				} else {
					$EskiCari->bakiye_guncelle( Fatura::$ALIS, $bakiye_toplam );
				}
			} else if( $this->details["fis_turu"] == Fatura::$ALIS || $this->details["fis_turu"] == Fatura::$GR_ALIS ){
				if( isset($YeniCari)){
					$YeniCari->bakiye_guncelle( Fatura::$SATIS, $bakiye_toplam );
				} else {
					$EskiCari->bakiye_guncelle( Fatura::$SATIS, $bakiye_toplam );
				}
			}
	
			// carinin bakiyeyi güncelle, duruma göre arttırıp - azaltıcaz
			if( $input["fis_turu"] != Fatura::$SIPARIS_FISI ){
				// fis harici bakiye hareketi yapiyoruz
				if( isset($YeniCari)){
					$YeniCari->bakiye_guncelle( $input["fis_turu"], $bakiye_toplam );
				} else {
					$EskiCari->bakiye_guncelle( $input["fis_turu"], $bakiye_toplam );
				}
			}*/

			// tum islemlerden sonra tekrar guncelliyoruz kaydi
			$this->pdo->query("UPDATE " . $this->dt_table . " SET 
				ara_toplam = ?,
				genel_toplam = ?,
				kdv_miktar = ?,
				genel_toplam_yaziyla = ?,
				cari_id = ?,
				cari_kayit_id = ? WHERE id = ?", array(
					$ara_toplam,
					$genel_toplam,
					$kdv_miktar,
					Common::fiyat_yaziyla($genel_toplam),
					$cari_id,
					$cari_detay_id,
					$this->details["id"]
			));
			if( $this->pdo->error() ){ 
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}

			$this->return_text = "Fatura / Fiş düzenlendi.";
			return true;
		}

		public function sil(){
			$this->pdo->query("UPDATE " . $this->dt_table ." SET durum = ? WHERE id = ?",array( 0, $this->details["id"]));
		}

		private function fatura_no_kontrol( $no ){
			return count($this->pdo->query("SELECT * FROM " . $this->dt_table . " WHERE fatura_no = ?", array( $no ) )->results()) == 0;
		}

		public function get_stok_detaylari(){
			return $this->pdo->query("SELECT * FROM " . DBT_FATURA_STOK_DETAYLARI . " WHERE fatura_id = ?", array( $this->details["id"]))->results();
		}

		public function get_cari_kayit(){
			return $this->pdo->query("SELECT * FROM " . DBT_ITEM_CARI_KAYITLARI . " WHERE item_tip = ? && item_id = ?", array( self::$ITEM_TIP, $this->details["id"] ))->results();
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

		// siparis fisini faturaya cevirme
		// - fatura kaydininin tipini guncelle
		// - carinin bakiyeyi guncelle
		// - stok kartlarinin stoklarini guncelle
		public function fis_convert( $cto ){

			if( $cto == self::$GR_SATIS ){
				// kdv sizse genel toplami ara toplama esitliyoruz
				$this->details["genel_toplam"] = $this->details["ara_toplam"];
			}
			// kdv yi yeniden hesapla
			$kdv_miktar = (double)$this->details["genel_toplam"] - (double)$this->details["ara_toplam"];

			/*$Cari = new Cari( $this->details["cari_id"] );
			if( $Cari->is_ok() ){
				if( !$Cari->bakiye_guncelle( $cto, $this->details["genel_toplam"] ) ){
					$this->return_text = $Cari->get_return_text();
					return false;
				}
			}*/

			/*foreach( $this->get_stok_detaylari() as $stok_detay ){
				$StokKarti = new StokKarti( $stok_detay["stok_kodu"] );
				if( $StokKarti->is_ok() ){
					if( !$StokKarti->stok_cikar( $stok_detay["yer"], $stok_detay["miktar"] ) ){
						$this->return_text = $StokKarti->get_return_text();
						return false;
					}
				}
			}*/

			$this->pdo->query("UPDATE " . $this->dt_table . " SET 
				fis_turu = ?,
				ara_toplam = ?,
				genel_toplam = ?,
				kdv_miktar = ?,
				genel_toplam_yaziyla = ? WHERE id = ?", array(
					$cto,
					$this->details["ara_toplam"],
					$this->details["genel_toplam"],
					$kdv_miktar,
					Common::fiyat_yaziyla($this->details["genel_toplam"]),
					$this->details["id"]
			));
			if( $this->pdo->error() ){ 
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}

			$this->return_text = "Sipariş fişi faturalandırıldı.";
			return true;
		}



	}