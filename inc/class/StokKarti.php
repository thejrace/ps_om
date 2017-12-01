<?php

	class StokKarti extends DataCommon {

		public function __construct( $id = null ){
			$this->pdo = DB::getInstance();
			$this->dt_table = DBT_STOK_KARTLARI;
			if( isset($id) ) $this->check( array("id", "stok_kodu", "stok_adi"), $id);
		}

		public function ekle( $input ){
			// ürün grubu yoksa oluştur
			$UrunGrubu = new UrunGrubu( $input["urun_grubu"] );
			if( !$UrunGrubu->is_ok() ){
				$UrunGrubu = new UrunGrubu();
				$UrunGrubu->ekle( array("isim" => $input["urun_grubu"] ) );
				$urun_grubu_id = $UrunGrubu->get_details("id");
			} else {
				$urun_grubu_id = $UrunGrubu->get_details("id");
			}
			if( $this->mukerrer_kontrol($input["stok_adi"], $urun_grubu_id ) ) return false;
			$this->details["stok_kodu"] = RKod::olustur( RKod::$PF_STOK_KARTI );
			$this->pdo->insert($this->dt_table, array(
				"stok_kodu" 		=> $this->details["stok_kodu"],
				"stok_adi"  		=> $input["stok_adi"],
				"urun_grubu" 		=> $urun_grubu_id,
				"satis_fiyati" 		=> $input["satis_fiyati"],
				"alis_fiyati" 		=> $input["alis_fiyati"],
				"kdv_dahil" 		=> $input["kdv_dahil"],
				"kdv_orani" 		=> $input["kdv_orani"],
				"birim"				=> $input["birim"]
			));
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}
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
			$AktifUrunGrubu = new UrunGrubu( $this->details["urun_grubu"] );
			$GelenUrunGrubu = new UrunGrubu( $input["urun_grubu"] );
			if( !$GelenUrunGrubu->is_ok() ){
				// gelen urun grubu yoksa ekliyoruz
				$YeniUrunGrubu = new UrunGrubu();
				$YeniUrunGrubu->ekle(array("isim" => $input["urun_grubu"]) );
				$urun_grubu_id = $YeniUrunGrubu->get_details("id");
			} else {
				// gelen urun grubu kayitliysa, stok kartinin grubunu degistirip degistirmedigini kontrol ediyoruz
				$GelenUrunGrubu = new UrunGrubu( $input["urun_grubu"] );
				if( $AktifUrunGrubu->get_details("isim") != $input["urun_grubu"]  ){
					// grup degismisse stok adi ile birlikte mükerrer kayit kontrolu yapiyoruz
					if( $this->mukerrer_kontrol( $input["stok_adi"], $GelenUrunGrubu->get_details("id") ) ) return false;
				} else {
					// urun grubu degismemise, stok adinin degisip degismedigine bakicaz
					if( $this->details["stok_adi"] != $input["stok_adi"] ){
						if( $this->mukerrer_kontrol( $input["stok_adi"], $this->details["urun_grubu"]) ) return false;
					}
				}
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
					$input["satis_fiyati"],
					$input["alis_fiyati"],
					$input["kdv_dahil"],
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

		private function mukerrer_kontrol( $stok_adi, $urun_grubu ){
			$kontrol = $this->pdo->query("SELECT * FROM " . $this->dt_table . " WHERE stok_adi = ? && urun_grubu = ?", array( $stok_adi, $urun_grubu ))->results();
			$this->return_text = "Ürün grubunda bu isimde kart zaten mevcut.";
			return count($kontrol) > 0;
		}

		public function sil(){

		}

		public function stok_verilerini_cikar(){

		}



		// direk stok hareketi objesiyle halledebilirk ?
		public function stok_ekle( $yer, $eklenecek_miktar ){
			$this->stok_guncelle( $yer, ($eklenecek_miktar)  ); 
		}

		public function stok_cikar( $yer, $cikarilacak_miktar ){
			$this->stok_guncelle( $yer, ($cikarilacak_miktar * -1)  ); 
		}

		private function stok_guncelle( $yer, $islem_miktari ){
			$eski_miktar = $this->pdo->query("SELECT * FROM " . DBT_STOK_KARTLARI_STOKLAR . " WHERE yer = ? && stok_karti = ?", array($yer, $this->details["stok_kodu"]))->results();
			$this->pdo->query("UPDATE " . DBT_STOK_KARTLARI_STOKLAR . " SET miktar = ? WHERE id = ?", array( ($eski_miktar[0]["miktar"] + $islem_miktari), $eski_miktar[0]["id"] ) );
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[StokGuncelleme][".$this->pdo->get_error_message()."]";
				return false;
			}
			$this->return_text = "Stok güncellendi.";
			return true;
		}

	}