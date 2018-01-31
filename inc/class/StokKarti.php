<?php

	class StokKarti extends DataCommon {

		public function __construct( $id = null ){
			$this->pdo = DB::getInstance();
			$this->dt_table = DBT_STOK_KARTLARI;
			if( isset($id) ) $this->check( array("id", "stok_kodu", "stok_adi"), $id);
		}

		public function ekle( $input ){

			if( !User::izin_kontrol( User::$IZ_STOK_KARTI_EKLE ) ){
				$this->return_text = "Bu işlemi yapmaya yetkiniz yok.";
				return false;
			}

			if( $this->mukerrer_kontrol($input["stok_adi"] ) ) return false;
			$this->details["stok_kodu"] = RKod::olustur( RKod::$PF_STOK_KARTI );

			if( trim($input["stok_kodu"]) != "" ){
				// elle girmiş, kontrol edicez
				if( count($this->pdo->query("SELECT * FROM " . $this->dt_table . " WHERE stok_kodu = ?", array( $input["stok_kodu"] ) )->results()) > 0 ) {
					$this->return_text = "Bu stok kodu başka bir ürün tanımlı!";
					return false;
				}
				$this->details["stok_kodu"] = trim($input["stok_kodu"]);
			} else {
				// otomatik
				$this->details["stok_kodu"] = RKod::olustur( RKod::$PF_STOK_KARTI );
			}

			// ürün grubu yoksa oluştur
			$UrunGrubu = new UrunGrubu( $input["urun_grubu"] );
			if( !$UrunGrubu->is_ok() ){
				$UrunGrubu = new UrunGrubu();
				$UrunGrubu->ekle( array("isim" => $input["urun_grubu"] ) );
				$urun_grubu_id = $UrunGrubu->get_details("id");
			} else {
				$urun_grubu_id = $UrunGrubu->get_details("id");
			}
						

			$this->pdo->insert($this->dt_table, array(
				"stok_kodu" 		=> $this->details["stok_kodu"],
				"stok_adi"  		=> $input["stok_adi"],
				"urun_grubu" 		=> $urun_grubu_id,
				"satis_fiyati" 		=> Common::convert_try_reverse($input["satis_fiyati"]),
				"alis_fiyati" 		=> Common::convert_try_reverse($input["alis_fiyati"]),
				"kdv_dahil" 		=> Common::convert_try_reverse($input["kdv_dahil"]),
				"kdv_orani" 		=> $input["kdv_orani"],
				"birim"				=> $input["birim"]
			));
			$this->details["id"] = $this->pdo->lastInsertedId();
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}

			// stok miktarını faturalardan güncelleyebilmek için, stok miktar kısmına id yi ekliyoruz
			// datatables formatter için
			$this->pdo->query("UPDATE " . $this->dt_table . " SET stok_miktar = ? WHERE id = ?", array( $this->details["id"], $this->details["id"]));

			// başlangıç stokları ekle
			foreach( $this->pdo->query("SELECT * FROM " . DBT_STOK_YERLERI )->results() as $yer ){
				$this->pdo->insert( DBT_STOK_KARTLARI_STOKLAR, array(
					"stok_karti" 	=> $this->details["stok_kodu"],
					"yer" 			=> $yer["isim"],
					"miktar" 		=> 0
				));
				if( $this->pdo->error() ){
					$this->return_text = "Bir hata oluştu.[2][".$this->pdo->get_error_message()."]";
					return false;
				}
			}
			$this->return_text = "Stok kartı eklendi.";
			return true;
		}

		public function duzenle( $input ){

			if( !User::izin_kontrol( User::$IZ_STOK_KARTI_DUZENLE ) ){
				$this->return_text = "Bu işlemi yapmaya yetkiniz yok.";
				return false;
			}

			if( $this->details["stok_adi"] != $input["stok_adi"] && $this->mukerrer_kontrol( $input["stok_adi"] ) ) return false;
			$GelenUrunGrubu = new UrunGrubu( $input["urun_grubu"] );
			if( !$GelenUrunGrubu->is_ok() ){
				// gelen urun grubu yoksa ekliyoruz
				$YeniUrunGrubu = new UrunGrubu();
				$YeniUrunGrubu->ekle(array("isim" => $input["urun_grubu"]) );
				$urun_grubu_id = $YeniUrunGrubu->get_details("id");
			} else {
				// gelen urun grubu kayitliysa, stok kartinin grubunu degistirip degistirmedigini kontrol ediyoruz
				/*$GelenUrunGrubu = new UrunGrubu( $input["urun_grubu"] );
				if( $AktifUrunGrubu->get_details("isim") != $input["urun_grubu"]  ){
					// grup degismisse stok adi ile birlikte mükerrer kayit kontrolu yapiyoruz
					if( $this->mukerrer_kontrol( $input["stok_adi"], $GelenUrunGrubu->get_details("id") ) ) return false;
				} else {
					// urun grubu degismemise, stok adinin degisip degismedigine bakicaz
					if( $this->details["stok_adi"] != $input["stok_adi"] ){
						if( $this->mukerrer_kontrol( $input["stok_adi"], $this->details["urun_grubu"]) ) return false;
					}
				}*/
				
				$urun_grubu_id = $GelenUrunGrubu->get_details("id");
			}
			$this->pdo->query("UPDATE " . $this->dt_table . " SET 
				stok_adi = ?,
				urun_grubu = ?,
				satis_fiyati = ?,
				alis_fiyati = ?,
				kdv_dahil = ?,
				kdv_orani = ?,
				birim = ? WHERE stok_kodu = ?",array(
					$input["stok_adi"],
					$urun_grubu_id,
					Common::convert_try_reverse($input["satis_fiyati"]),
					Common::convert_try_reverse($input["alis_fiyati"]),
					Common::convert_try_reverse($input["kdv_dahil"]),
					$input["kdv_orani"],
					$input["birim"],
					$this->details["stok_kodu"] )
			);
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}
			$this->return_text = "Stok kartı düzenlendi.";
			return true;
		}

		private function mukerrer_kontrol( $stok_adi ){
			$kontrol = $this->pdo->query("SELECT * FROM " . $this->dt_table . " WHERE stok_adi = ? ", array( $stok_adi ))->results();
			$this->return_text = "Bu isimde stok kartı zaten mevcut.";
			return count($kontrol) > 0;
		}

		public function stok_detaylari_cikar(){

			// aliş ve satış faturalarını bul, birbirinden çıkar
			$fatura_stok_itemleri = $this->pdo->query("SELECT * FROM " . DBT_FATURA_STOK_DETAYLARI . " WHERE stok_kodu = ?", array( $this->details["stok_kodu"]))->results();
			$alislar = 0;
			$satislar = 0;
			foreach( $fatura_stok_itemleri as $item ){
				$Fatura = new Fatura( $item["fatura_id"] );
				if( $Fatura->is_ok() && $Fatura->get_details("durum") == 1 ){
					if( $Fatura->get_details("fis_turu") == Fatura::$GR_ALIS || $Fatura->get_details("fis_turu") == Fatura::$ALIS ){
						$alislar += $item["miktar"];
					} else if( $Fatura->get_details("fis_turu") == Fatura::$GR_SATIS || $Fatura->get_details("fis_turu") == Fatura::$SATIS ){
						$satislar += $item["miktar"];
					}
				}
			}

			$stok_hareket_detaylari = $this->pdo->query("SELECT * FROM " . DBT_STOK_HAREKETLERI_URUNLER ." WHERE stok_kodu = ?", array( $this->details["stok_kodu"]))->results();
			foreach( $stok_hareket_detaylari as $hareket ){
				$StokHareket = new StokHareket($hareket["hareket_id"]);
				if( $StokHareket->is_ok() && $StokHareket->get_details("durum") == 1 ){
					if( $StokHareket->get_details("tip") == "Giriş"){
						$alislar += $hareket["miktar"];
					} else {
						$satislar += $hareket["miktar"];
					}
				}
			}
			
			return $alislar - $satislar;
		}

		// fiş fatura yazarken stok karti eklendiginde, kullaniciya verilen son fiyati alma
		public function cari_fiyat_gecmisi( Cari $Cari, $fis_turu ){
			$faturalar = array();
			foreach( $Cari->get_kesilmis_faturalar( $fis_turu ) as $fatura ){
				$Fatura = new Fatura( $fatura["id"] );
				if( $Fatura->stok_detaylari_arama( array( $this->details["stok_adi"] ) ) ){
					$faturalar[] = array(
						"fatura_id" => $fatura["id"],
						"fatura_tipi" => Fatura::$TUR_STR[$fis_turu],
						"fiyat" 	=> $Fatura->get_details("fiyat"),
						"kdv" 		=> $Fatura->get_details("kdv"),
						"tarih" 	=> Common::datetime_reverse($fatura["duzenlenme_tarihi"]),
						"miktar" 	=> $Fatura->get_details("miktar")
					);	
				}
			}
			return $faturalar;
		}

		public function sil(){

		}


		// fatura / fişe eklemede stok islemleri
		// kdv dahil sadece mağaza satışlarında anlamlı
		public function faturaya_ekle( $fatura_id, $fis_turu, $birim_fiyat, $kdv, $miktar, $birim, $toplam, $yer, $kdv_dahil  ){
			$fis = false;
			if( $fis_turu == Fatura::$ALIS || $fis_turu == Fatura::$GR_ALIS ){
				// stoğa ekliyoruz
				$miktar_carpan = 1;
			} else if( $fis_turu == Fatura::$SATIS || $fis_turu == Fatura::$GR_SATIS ){
				// stoktan düşüyoruz
				$miktar_carpan = -1;
			} else {
				// sipariş fişi, stok hareketi yapmiyoruz
				$fis = true;
			}
			// detaylari ekle db ye
			$this->pdo->insert( DBT_FATURA_STOK_DETAYLARI, array(
				"fatura_id" 	=> $fatura_id,
				"stok_kodu" 	=> $this->details["stok_kodu"],
				"stok_adi"		=> $this->details["stok_adi"],
				"birim_fiyat" 	=> Common::convert_try_reverse($birim_fiyat),
				"miktar" 		=> Common::convert_try_reverse($miktar),
				"birim"			=> $birim,
				"kdv_orani" 	=> $kdv,
				"toplam" 		=> Common::convert_try_reverse($toplam),
				"yer" 			=> $yer,
				"kdv_dahil"     => $kdv_dahil
			));
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[FaturayaEkleme][1][".$this->pdo->get_error_message()."]";
				return false;
			}
			if( !$fis ){
				// fis harici islemlerde stok hareketleri
				// kartın stoğunu guncelle
				// manuel elle stok girişi yapiyoruz artik, otomatik stok güncelleme iptal
				//$this->stok_guncelle( $yer, $miktar * $miktar_carpan );
			}
			return true;
		}

		// @DEPRECATED
		// direk stok hareketi objesiyle halledebilirk ?
		public function stok_ekle( $yer, $eklenecek_miktar ){
			return $this->stok_guncelle( $yer, ($eklenecek_miktar)  ); 
		}

		// @DEPRECATED
		public function stok_cikar( $yer, $cikarilacak_miktar ){
			return $this->stok_guncelle( $yer, ($cikarilacak_miktar * -1)  ); 
		}

		// @DEPRECATED
		// yer bazlı
		public function stok_guncelle( $yer, $islem_miktari ){
			$eski_miktar = $this->pdo->query("SELECT * FROM " . DBT_STOK_KARTLARI_STOKLAR . " WHERE yer = ? && stok_karti = ?", array($yer, $this->details["stok_kodu"]))->results();
			$this->pdo->query("UPDATE " . DBT_STOK_KARTLARI_STOKLAR . " SET miktar = ? WHERE id = ?", array( ($eski_miktar[0]["miktar"] + $islem_miktari), $eski_miktar[0]["id"] ) );
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[StokGuncelleme][".$this->pdo->get_error_message()."]";
				return false;
			}
			// tabloyu da guncelle
			if( !$this->toplam_stok_guncelle() ) return false;
			$this->return_text = "Stok güncellendi.";
			return true;
		}

		// @DEPRECATED
		// kart tablosundaki sütunu guncelleme
		private function toplam_stok_guncelle(){
			$toplam = 0;
			foreach( $this->pdo->query("SELECT * FROM " . DBT_STOK_KARTLARI_STOKLAR . " WHERE stok_karti = ?", array( $this->details["stok_kodu"]))->results() as $yer_stok_data ) $toplam += $yer_stok_data["miktar"];
			$this->pdo->query("UPDATE " . $this->dt_table . " SET stok_miktar = ? WHERE id = ?", array( $toplam, $this->details["id"] ));
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[ToplamStokGuncelleme][".$this->pdo->get_error_message()."]";
				return false;
			}
			$this->return_text = "Stok güncellendi.";
			return true;
		}

		public function stok_hareket_detay_ekle( $hareket_id, $miktar, $yer ){
			$this->pdo->insert(DBT_STOK_HAREKETLERI_URUNLER, array(
				"hareket_id" 	=> $hareket_id,
				"stok_kodu" 	=> $this->details["stok_kodu"],
				"stok_adi" 		=> $this->details["stok_adi"],
				"miktar" 		=> Common::convert_try_reverse($miktar),
				"yer"			=> $yer
			));
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[StokHareketDetayEkleme][".$this->pdo->get_error_message()."]";
				return false;
			}
			$this->return_text = "Stok hareketine eklendi.";
			return true;
		}

		public function get_stok_detaylari(){
			return $this->pdo->query("SELECT * FROM " . DBT_STOK_KARTLARI_STOKLAR . " WHERE stok_karti = ?", array( $this->details["stok_kodu"]))->results();
		}


		public static function ac_arama( $term ){
			$q = array();
			foreach( DB::getInstance()->query("SELECT stok_adi FROM " . DBT_STOK_KARTLARI . " WHERE (stok_adi LIKE ? || stok_adi LIKE ? || stok_adi LIKE ?) && durum = ?", array("%".$term, $term."%", "%".$term."%", 1))->results() as $res ) $q[] = $res["stok_adi"];
			return $q;
		}

	}