<?php

	class Cari extends DataCommon {

		public function __construct( $id = null ){
			$this->pdo = DB::getInstance();
			$this->dt_table = DBT_CARILER;
			if( isset($id) ) $this->check( array("id", "unvan"), $id);
		}
		
		public function ekle( $input ){

			if( !User::izin_kontrol( User::$IZ_CARI_EKLE ) ){
				$this->return_text = "Bu işlemi yapmaya yetkiniz yok.";
				return false;
			}

			$unvan_kontrol = $this->pdo->query("SELECT * FROM " . $this->dt_table . " WHERE unvan = ?", array( $input["cari_unvan"] ) )->results();
			if( count($unvan_kontrol) > 0 ){
				$this->return_text = "Bu ünvana sahip cari kayıt zaten var.";
				return false;
			}
			$this->pdo->insert( $this->dt_table, array(
				"unvan" 					=> $input["cari_unvan"],
				"eposta"					=> $input["cari_eposta"],
				"telefon_1" 				=> $input["cari_telefon_1"],
				"telefon_2" 				=> $input["cari_telefon_2"],
				"faks_no"					=> $input["cari_faks_no"],
				"adres"						=> $input["cari_adres"],
				"il"						=> $input["cari_il"],
				"ilce"						=> $input["cari_ilce"],
				"tur"						=> $input["cari_tur"],
				"mali_tur"					=> $input["cari_mali_tur"],
				"iban"						=> $input["cari_iban"],
				"vkn_tckn"					=> $input["cari_vkn_tckn"],
				"vergi_dairesi" 			=> $input["cari_vergi_dairesi"],
				"durum"						=> 1,
				"eklenme_tarihi"			=> Common::get_current_datetime(),
				"son_duzenlenme_tarihi"		=> Common::get_current_datetime()
			));
			$this->details["id"] = $this->pdo->lastInsertedId();
			if( $input["yetkililer_str"] != "" ){
				foreach( explode( "||", $input["yetkililer_str"]) as $yetkili_input ){
					$CariYetkili = new CariYetkili();
					if( !$CariYetkili->ekle( $this->details["id"], $yetkili_input ) ){
						$this->return_text = $CariYetkili->get_return_text();
						return false;
					}
				}
			}	
			// dt tables, formatter icin
			$this->pdo->query("UPDATE " . $this->dt_table . " SET bakiye = ? WHERE id = ?",array( $this->details["id"], $this->details["id"]));

			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}
			$this->return_text = "Cari kayıt eklendi.";
			return true;
		}

		public function duzenle( $input ){

			if( !User::izin_kontrol( User::$IZ_CARI_DUZENLE ) ){
				$this->return_text = "Bu işlemi yapmaya yetkiniz yok.";
				return false;
			}

			$unvan_kontrol = $this->pdo->query("SELECT * FROM " . $this->dt_table . " WHERE unvan = ? && id != ?", array( $input["cari_unvan"], $this->details["id"] ) )->results();
			if( count($unvan_kontrol) > 0 ){
				$this->return_text = "Bu ünvana sahip cari kayıt zaten var.";
				return false;
			}
			$this->pdo->query("UPDATE " . $this->dt_table . " SET 
				unvan 				= ?,
				eposta 				= ?,
				telefon_1 			= ?,
				telefon_2 			= ?,
				faks_no 			= ?,
				adres 				= ?,
				il 					= ?,
				ilce 				= ?,
				tur 				= ?,
				mali_tur 			= ?,
				iban 				= ?,
				vkn_tckn 			= ?,
				vergi_dairesi 		= ?,
				son_duzenlenme_tarihi = ? WHERE id = ?",
				array(
					$input["cari_unvan"],
					$input["cari_eposta"],
					$input["cari_telefon_1"],
					$input["cari_telefon_2"],
					$input["cari_faks_no"],
					$input["cari_adres"],
					$input["cari_il"],
					$input["cari_ilce"],
					$input["cari_tur"],
					$input["cari_mali_tur"],
					$input["cari_iban"],
					$input["cari_vkn_tckn"],
					$input["cari_vergi_dairesi"],
					Common::get_current_datetime(),
					$this->details["id"]
				));
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}

			$gelenler_id = array();
			// silinenleri bulmak icin düzenleme öncesi db den verileri alıyoruz
			$varolan_yetkililer = $this->get_yetkililer();
			if( $input["yetkililer_str"] != "" ){
				foreach( explode( "||", $input["yetkililer_str"]) as $yetkili_input ){
					$data_array = explode( "##", $yetkili_input );
					if( $data_array[4] == "" ){
						$CariYetkili = new CariYetkili();
						if( !$CariYetkili->ekle( $this->details["id"], $yetkili_input ) ){
							$this->return_text = $CariYetkili->get_return_text();
							return false;
						}
					} else {
						$CariYetkili = new CariYetkili($data_array[4]);
						if( $CariYetkili->is_ok() ){
							if( !$CariYetkili->duzenle( $data_array[0], $data_array[1], $data_array[2], $data_array[3] ) ){
								$this->return_text = $CariYetkili->get_return_text();
								return false;
							}
							$gelenler_id[] = $data_array[4];
						}
					}
				}
				// silinenleri uçur
				foreach( $varolan_yetkililer as $yetkili ){
					if( !in_array( $yetkili["id"], $gelenler_id ) ){
						$CariYetkili = new CariYetkili($yetkili["id"]);
						if( $CariYetkili->is_ok()){
							$CariYetkili->sil();
						}
					}
				}
			} else {
				// boş geldiyse varolanlar silinmis demek varsa uçur
				foreach( $this->get_yetkililer() as $yetkili ){
					$CariYetkili = new CariYetkili( $yetkili["id"] );
					if( $CariYetkili->is_ok() ){
						if( !$CariYetkili->sil() ){
							$this->return_text = $CariYetkili->get_return_text();
							return false;
						}
					}
				}
			}
			$this->return_text = "Cari kayıt düzenlendi.";
			return true;
		}

		public function sil(){

			if( !User::izin_kontrol( User::$IZ_CARI_DUZENLE ) ){
				$this->return_text = "Bu işlemi yapmaya yetkiniz yok.";
				return false;
			}

			if( count( $this->get_kesilmis_faturalar() ) > 0 ){
				$this->return_text = "Bu cari ile işlem yapılmış. Silinemez.";
				return false;
			} else {
				$this->pdo->query("UPDATE " . $this->dt_table . " SET durum = ? WHERE id = ?", array(0, $this->details["id"]));
				$this->return_text = "Cari silindi.";
				return true;
			}
		}

		// @DEPRECATED
		// artik kullanmiyoruz faturalari, tahsilatlari toplayarak çıkarıcaz ( 31.01.2018 )
		public function bakiye_guncelle( $fis_turu, $miktar ){
			if( class_exists("Fatura") ){
				if( $fis_turu == Fatura::$ALIS || $fis_turu == Fatura::$GR_ALIS ){
					$bakiye_carpan = -1;
					// birşey alınmışsa vereceklerimiz artiyor, ekliyoruz
					Pamira::verecekler_toplami_guncelle( $miktar );	
				} else if( $fis_turu == Fatura::$SATIS || $fis_turu == Fatura::$GR_SATIS ){
					$bakiye_carpan = 1;
					// bir sey satmissak alacaklarimiz artiyor, ekliyoruz
					Pamira::alacaklar_toplami_guncelle( $miktar  );	
				}
			} else {
				if( $fis_turu == TahsilatMakbuzu::$TAHSILAT ){
					$bakiye_carpan = -1;
					// tahsilat yapmissak alacaklarımız azalmış
					Pamira::alacaklar_toplami_guncelle( $miktar * -1  );
					// kasadaki para artmış oluyor
					Pamira::kasayi_guncelle( $miktar );
				} else if( $fis_turu == TahsilatMakbuzu::$ODEME ){
					$bakiye_carpan = 1;
					// odeme yapmissak vereceklerimiz azalmış
					Pamira::verecekler_toplami_guncelle( $miktar * -1 );
					// kasadaki para azalmış oluyor
					Pamira::kasayi_guncelle( $miktar * - 1 );
				}
			}
			$this->details["yeni_bakiye"] = ($this->details["bakiye"] + ($miktar * $bakiye_carpan) );
			$this->pdo->query("UPDATE " . $this->dt_table . " SET bakiye = ? WHERE id = ?", array( $this->details["yeni_bakiye"], $this->details["id"]));
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[BakiyeGuncelleme1][".$this->pdo->get_error_message()."]";
				return false;
			}
			$this->return_text = "Bakiye güncellendi.";
			return true;
		}

		public function bakiye_hesapla(){

			// faturalari bul
			$faturalar = $this->get_kesilmis_faturalar();
			$fatura_alacak = 0;
			$fatura_verecek = 0;
			$makbuz_alinanlar = 0;
			$makbuz_verilenler = 0;
			foreach( $faturalar as $fatura ){
				$Fatura = new Fatura( $fatura["id"] );
				if( $Fatura->is_ok() && $Fatura->get_details("durum") == 1 ){
					if( $Fatura->get_details("fis_turu") == Fatura::$GR_ALIS || $Fatura->get_details("fis_turu") == Fatura::$ALIS ){
						$fatura_verecek += $Fatura->get_details("genel_toplam");
					} else if( $Fatura->get_details("fis_turu") == Fatura::$GR_SATIS || $Fatura->get_details("fis_turu") == Fatura::$SATIS ){
						$fatura_alacak += $Fatura->get_details("genel_toplam");
					}
				}
			}
			// tahsilat makbuzlarini hesapla
			$makbuzlar = $this->pdo->query("SELECT * FROM " . DBT_TAHSILAT_MAKBUZLARI . " WHERE cari_id = ? && durum = ?", array( $this->details["id"], 1 ) )->results();
			foreach( $makbuzlar as $makbuz_item ){
				$Makbuz = new TahsilatMakbuzu($makbuz_item["id"]);
				if( $Makbuz->is_ok() && $Makbuz->get_details("durum") == 1 ){
					if( $Makbuz->get_details("tip") == TahsilatMakbuzu::$ODEME ){
						$makbuz_verilenler += $Makbuz->get_details("tutar");
					} else if( $Makbuz->get_details("tip") == TahsilatMakbuzu::$TAHSILAT ){
						$makbuz_alinanlar += $Makbuz->get_details("tutar");
					}
				}
			}
			$kalan_odemeler = $fatura_verecek - $makbuz_verilenler;
			$kalan_alacaklar = $fatura_alacak - $makbuz_alinanlar;
			return $kalan_alacaklar - $kalan_odemeler;
		}

		public function item_kayit_ekle( $item_tip, $item_id ){
			$this->pdo->insert(DBT_ITEM_CARI_KAYITLARI, array(
				"item_tip"			=> $item_tip,
				"item_id" 			=> $item_id,
				"unvan" 			=> $this->details["unvan"],
				"adres" 			=> $this->details["adres"],
				"il" 				=> $this->details["il"],
				"ilce" 				=> $this->details["ilce"],
				"mali_tur" 			=> $this->details["mali_tur"],
				"telefon_1" 		=> $this->details["telefon_1"],
				"telefon_2" 		=> $this->details["telefon_2"],
				"tur" 				=> $this->details["tur"],
				"vkn_tckn" 			=> $this->details["vkn_tckn"],
				"vergi_dairesi" 	=> $this->details["vergi_dairesi"],
				"eposta" 			=> $this->details["eposta"],
				"iban" 				=> $this->details["iban"],
				"faks_no" 			=> $this->details["faks_no"]
			));
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[CariFaturayaEkleme][".$this->pdo->get_error_message()."]";
				return false;
			}
			$this->details["item_detay_id"] = $this->pdo->lastInsertedId();
			return true;
		}

		public function get_kesilmis_faturalar( $tur = null  ){
			if( !isset($tur) ){
				return $this->pdo->query("SELECT * FROM " . DBT_FATURALAR . " WHERE cari_id = ? && durum = ? ORDER BY duzenlenme_tarihi DESC", array( $this->details["id"], 1 ) )->results();
			} else {
				return $this->pdo->query("SELECT * FROM " . DBT_FATURALAR . " WHERE cari_id = ? && fis_turu = ? && durum = ? ORDER BY duzenlenme_tarihi DESC ", array( $this->details["id"], $tur, 1 ) )->results();
			}
		}

		public function get_yetkililer(){
			return $this->pdo->query("SELECT * FROM " . DBT_CARI_YETKILILER . " WHERE cari_id = ?", array($this->details["id"]))->results();
		}


		public static function ac_arama( $term ){
			$q = array();
			foreach( DB::getInstance()->query("SELECT unvan FROM " . DBT_CARILER . " WHERE (unvan LIKE ? || unvan LIKE ? || unvan LIKE ?) && durum = ?", array("%".$term, $term."%", "%".$term."%", 1))->results() as $res ) $q[] = $res["unvan"];
			return $q;
		}

	}