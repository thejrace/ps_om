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

		public function duzenle( $input ){

			if( !User::izin_kontrol( User::$IZ_FATURA_DUZENLE ) ){
				$this->return_text = "Bu işlemi yapmaya yetkiniz yok.";
				return false;
			}

			$miktar = 0;
			$gelenler_id = array();
			// başta aliyoruz, yeni eklenenleri uçurmamak icin
			$kayitli_urunler = $this->get_urunler();
			foreach( explode( "||", $input["stok_str"] ) as $stok_data ){
				$data_array = explode( "##", $stok_data );
				// 0 -> ürün adi
				// 1 -> birim fiyat
				// 2 -> miktar
				// 3 -> toplam
				// 4 -> odeme_tipi
				// 5 -> id

				// id gelmişse
				if( $data_array[5] != "" ){

					$this->pdo->query("UPDATE " . DBT_MAGAZA_FISLERI_URUNLER . " SET 
						urun = ?,
						fiyat = ?,
						miktar = ?,
						toplam = ?,
						odeme_tipi = ? WHERE id = ?
						", array(
							$data_array[0],
							$data_array[1],
							$data_array[2],
							$data_array[3],
							$data_array[4],
							$data_array[5]
					));

					$gelenler_id[] = $data_array[5];

				} else {
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


				}
				$miktar += (double)$data_array[3];
				
				if( $this->pdo->error()){
					$this->return_text = "Bir hata oluştu.[".$this->pdo->get_error_message()."]";
					return false;
				}
			}

			// silinen ürünleri, db den kaldir
			foreach( $kayitli_urunler as $varolanlar ){
				if( !in_array( $varolanlar["id"], $gelenler_id ) ){
					$this->pdo->query("DELETE FROM " . DBT_MAGAZA_FISLERI_URUNLER . " WHERE id = ?", array( $varolanlar["id"]));
				}
			}

			$fark = (double)$this->details["toplam"] - $miktar;
			Pamira::kasayi_guncelle( $fark * -1 );

			$this->pdo->query("UPDATE " . $this->dt_table . " SET toplam = ?, tarih = ? WHERE id = ?", array( $miktar, Common::date_reverse($input["tarih"]), $this->details["id"] ));
			if( $this->pdo->error()){
				$this->return_text = "Bir hata oluştu.[".$this->pdo->get_error_message()."]";
				return false;
			}

			$this->return_text = "Mağaza fişi güncellendi.";
			return true;
		}

		public function sil(){

			if( !User::izin_kontrol( User::$IZ_FATURA_DUZENLE ) ){
				$this->return_text = "Bu işlemi yapmaya yetkiniz yok.";
				return false;
			}

			$this->pdo->query("UPDATE " . $this->dt_table . " SET durum = ? WHERE id = ?", array( 0, $this->details["id"] ) );
			$this->pdo->query("UPDATE " . DBT_MAGAZA_FISLERI_URUNLER . " SET durum = ? WHERE fis = ?", array(0, $this->details["id"]) );
			Pamira::kasayi_guncelle( (double)$this->details["toplam"] * -1 );

			$this->return_text = "Mağaza Fişi silindi.";
			return true;
		}

		public function get_urunler(){
			return $this->pdo->query("SELECT * FROM " . DBT_MAGAZA_FISLERI_URUNLER . " WHERE fis = ?", array( $this->details["id"]))->results();
		}

		public static function dt_arama( $input ){
			$prefix = "SELECT id, toplam, tarih FROM " . DBT_MAGAZA_FISLERI;

			$wheres = array();
			$where_vals = array();

			$wheres[] = " durum = ? ";
			$where_vals[] = "1";


			if( trim($input["tutar_alt"]) != "" ){
				$wheres[] = " toplam >= ? ";
				$where_vals[] = $input["tutar_alt"];
			}

			if( trim($input["tutar_ust"]) != "" ){
				$wheres[] = " toplam <= ? ";
				$where_vals[] = $input["tutar_ust"];
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
					$q["toplam"],
					Common::date_reverse($q["tarih"])
				);
			}
			
			return $dt_data;
		}

	

	}