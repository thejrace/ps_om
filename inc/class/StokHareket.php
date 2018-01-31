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

			if( isset($input["fis_no"]) && $input["fis_no"] != 0 ){
				$kontrol = $this->pdo->query("SELECT * FROM " . $this->dt_table . " WHERE fis_no = ?", array($input["fis_no"]))->count();
				if($kontrol > 0 ){
					$this->return_text = "Bu fiş nolu stok hareketi daha önceden yapılmış.";
					return false;
				}
				$fis_no = $input["fis_no"];
			} else {
				$fis_no = 0;
			}
			

			$this->pdo->insert($this->dt_table, array(
				"tip" 					=> $input["tip"],
				"user" 					=> User::get_data("user_id"),
				"tarih" 				=> Common::date_reverse($input["tarih"]),
				"eklenme_tarihi" 		=> Common::get_current_datetime(),
				"fis_no" 				=> $fis_no
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
						"stok_kodu" 	=> "",
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

				//$StokKarti->stok_guncelle( $data_array[2], (double)$data_array[1] * $miktar_carpan );
				$StokKarti->stok_hareket_detay_ekle( $this->details["id"], (double)$data_array[1], $data_array[2] );
			}

			$this->return_text = "Stok hareketi eklendi.";
			return true;
		}

		public function duzenle( $input ){

			if( !User::izin_kontrol( User::$IZ_STOK_HAREKET_DUZENLEME ) ){
				$this->return_text = "Bu işlemi yapmaya yetkiniz yok.";
				return false;
			}

			if( $input["tip"] == "Giriş" ){
				$miktar_carpan = 1;
				$this->pdo->query("UPDATE " . $this->dt_table . " SET tarih = ? WHERE id = ?", array( Common::date_reverse($input["tarih"]), $this->details["id"]));
			} else {
				$miktar_carpan = -1;
				$this->pdo->query("UPDATE " . $this->dt_table . " SET tarih = ?, fis_no = ? WHERE id = ?", array( Common::date_reverse($input["tarih"]), $input["fis_no"], $this->details["id"]));
			}

			$kayitli_urunler = $this->get_urunler();
			$gelenler_id = array();

			foreach( explode( "||", $input["stok_str"] ) as $stok_data ){
				$data_array = explode( "##", $stok_data );

				// 0 -> stok isim
				// 1 -> miktar
				// 2 -> yer
				// 3 -> id

				if( $data_array[3] != "" ){
					// id gelmiş

					if( (double)$data_array[1] == 0 ) continue;
					$StokKarti = new StokKarti($data_array[0]);
					if( !$StokKarti->is_ok() ) continue;
					
					$this->pdo->query("UPDATE " . DBT_STOK_HAREKETLERI_URUNLER . " SET 
						stok_kodu = ?,
						stok_adi = ?,
						miktar = ?,
						yer = ? WHERE id = ?", array(
							$StokKarti->get_details("stok_kodu"),
							$data_array[0],
							$data_array[1],
							$data_array[2],
							$data_array[3]
					));
					// bir onceki kayitla miktar farkını bulucaz ona göre stoğu guncelle
					$fark = 0;
					foreach( $kayitli_urunler as $kayitli_urun ){
						if( $kayitli_urun["id"] == $data_array[3] ){
							$this->pdo->query("UPDATE " . DBT_STOK_HAREKETLERI_URUNLER . " SET miktar = ? WHERE id = ?", array( $data_array[1], $kayitli_urun["id"] ));

							/*$fark = (int)$kayitli_urun["miktar"] - (int)$data_array[1];
							if( $fark < 0 ){
								// yeni miktar daha fazla
								// giriş yapılıyorsa stoğa farkı ekle
								// cikis yapiliyorsa fark stoktan çıkar
								if( $miktar_carpan == -1 ){	
									$StokKarti->stok_guncelle( $data_array[2], $fark );
								} else {
									$StokKarti->stok_guncelle( $data_array[2], $fark * -1);
								}							
							} else {
								// yeni miktar oncekinden az
								// giriş yapılıyorsa stoktan farkı çıkar
								// cikis yapiliyorsa farkı stoğa ekle
								if( $miktar_carpan == -1 ){	
									$StokKarti->stok_guncelle( $data_array[2], $fark );
								} else {
									$StokKarti->stok_guncelle( $data_array[2], $fark * -1 );
								}
							}	*/

							break;
						}
					}
					$gelenler_id[] = $data_array[3];
				} else {
					// yeni ekleniyor

					// isim bos geldiyse ipleme
					if( trim($data_array[0]) == "" ) continue;
					// miktar 0 sa ipleme
					if( (double)$data_array[1] == 0 ) continue;

					$StokKarti = new StokKarti( $data_array[0] );
					if( !$StokKarti->is_ok() ){
						// yeni stok karti
						$StokKarti = new StokKarti();
						$kart_data = array(
							"stok_adi" 		=> $data_array[0],
							"stok_kodu" 	=> "",
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

					//$StokKarti->stok_guncelle( $data_array[2], (double)$data_array[1] * $miktar_carpan );
					$StokKarti->stok_hareket_detay_ekle( $this->details["id"], (double)$data_array[1], $data_array[2] );
				}				
			}

			// silinen ürünleri, db den kaldir
			foreach( $kayitli_urunler as $varolanlar ){
				if( !in_array( $varolanlar["id"], $gelenler_id ) ){
					$this->pdo->query("DELETE FROM " . DBT_STOK_HAREKETLERI_URUNLER . " WHERE id = ?", array( $varolanlar["id"]));
				}
			}

			$this->return_text = "Stok hareketi güncellendi.";
			return true;
		}

		public function sil(){

			if( !User::izin_kontrol( User::$IZ_STOK_HAREKET_SILME ) ){
				$this->return_text = "Bu işlemi yapmaya yetkiniz yok.";
				return false;
			}

			$this->pdo->query("UPDATE " . $this->dt_table . " SET durum = ? WHERE id = ?", array( 0, $this->details["id"]));
			foreach( $this->get_urunler() as $urun ){
				$StokKarti = new StokKarti( $urun["stok_kodu"] );
				if( !$StokKarti->is_ok() ) continue;
				if( $this->details["tip"] == "Giriş" ){
					// giriş silinirse, eklenenleri stoktan düş
					//$StokKarti->stok_guncelle( $urun["yer"], $urun["miktar"] * -1 );
				} else {
					// cikis iptalse, cikanlari geri ekle
					//$StokKarti->stok_guncelle( $urun["yer"], $urun["miktar"] );
				}
				$this->pdo->query("UPDATE " . DBT_STOK_HAREKETLERI_URUNLER . " SET durum = ? WHERE id = ?", array( 0, $urun["id"]));
			}
			$this->return_text = "Stok hareketi silindi.";
			return true;
		}

		public function get_urunler(){
			return $this->pdo->query("SELECT * FROM " . DBT_STOK_HAREKETLERI_URUNLER . " WHERE hareket_id = ?", array($this->details["id"]))->results();
		}

		public static function dt_arama( $input ){
			$prefix = "SELECT id, tip, tarih, fis_no FROM " . DBT_STOK_HAREKETLERI;

			$wheres = array();
			$where_vals = array();

			$wheres[] = " durum = ? ";
			$where_vals[] = 1;


			if( trim($input["tip"]) != "0" ){
				$wheres[] = " tip = ? ";
				$where_vals[] = $input["tip"];
			}

			if( trim($input["fis_no"]) != "" ){
				$wheres[] = " fis_no = ? ";
				$where_vals[] = $input["fis_no"];
			}

			if( trim($input["tarih_alt"]) != "" ){
				$wheres[] = " tarih >= ? ";
				$where_vals[] = Common::date_reverse($input["tarih_alt"]);
			}

			if( trim($input["tarih_ust"]) != "" ){
				$wheres[] = " tarih <= ? ";
				$where_vals[] = Common::date_reverse($input["tarih_ust"]);
			}

			$dt_data = array();

			$sql = $prefix . " WHERE " . implode(" && ", $wheres );
			$query = DB::getInstance()->query($sql, $where_vals)->results();
			foreach( $query as $q ){
				$dt_data[] = array(
					$q["id"],
					$q["tip"],
					$q["fis_no"],
					Common::date_reverse($q["tarih"])
				);
			}
			
			return $dt_data;
		}
		

	}