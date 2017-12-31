<?php

	class Odeme extends DataCommon {

		public function __construct( $id = null ){
			$this->pdo = DB::getInstance();
			$this->dt_table = DBT_ODEMELER;
			if( isset($id) ) $this->check( array("id", "kart"), $id);
		}

		public function ekle( $input ){

			$this->pdo->insert(DBT_ODEMELER, array(
				"kart" 				=> $input["kart"],
				"odeme_tipi" 		=> $input["odeme_tipi"],
				"tutar" 			=> $input["tutar"],
				"user" 				=> User::get_data("user_id"),
				"banka_ekstra" 		=> $input["banka_ekstra"],
				"tarih" 			=> Common::date_reverse($input["tarih"]),
				"aciklama" 			=> $input["aciklama"],
				"eklenme_tarihi" 	=> Common::get_current_datetime(),
				"duzenlenme_tarihi" => Common::get_current_datetime()
			));
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}

			Pamira::kasayi_guncelle( (double)$input["tutar"] * -1 );

			$this->return_text = "Ödeme yapıldı.";
			return true;

		}

		public function duzenle( $input ){

			if( (double)$this->details["tutar"] != (double)$input["tutar"] ){
				// iki tutar arasindaki farki bul
				$fark = (double)$input["tutar"] - (double)$this->details["tutar"];
				// eger yeni tutar eskisinden fazlaysa kasayı azaltıcaz
				// eger yeni tutar az ise kasayı arttır
				Pamira::kasayi_guncelle( (double)$fark * -1 );
				// iki durumda da -1 ile çarpıyoruz
					
			}

			$this->pdo->query("UPDATE " . $this->dt_table . " SET 
				kart = ?,
				odeme_tipi = ?,
				tutar = ?,
				banka_ekstra = ?,
				tarih = ?,
				aciklama = ?,
				duzenlenme_tarihi = ? WHERE id = ?",array(
					$input["kart"],
					$input["odeme_tipi"],
					$input["tutar"],
					$input["banka_ekstra"],
					Common::date_reverse($input["tarih"]),
					$input["aciklama"],
					Common::get_current_datetime(),
					$this->details["id"]
			));
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}
			$this->return_text = "Ödeme kaydı güncellendi.";
			return true;
		}

		public function sil(){
			$this->pdo->query("UPDATE " . $this->dt_table . " SET durum = ? WHERE id = ?", array( 0, $this->details["id"]));
			$this->return_text = "Ödeme kaydı silindi.";

			// iptal durumunda kasaya parayi geri ekle
			Pamira::kasayi_guncelle( (double)$this->details["tutar"] );


			return true;
		}

		public static function ac_arama( $term ){
			$q = array();
			foreach( DB::getInstance()->query("SELECT kart FROM " . DBT_ODEMELER . " WHERE kart LIKE ? || kart LIKE ? || kart LIKE ?", array("%".$term, $term."%", "%".$term."%"))->results() as $res ) $q[] = $res["kart"];
			return $q;
		}

		public static function dt_arama( $input ){
			$prefix = "SELECT id, kart, odeme_tipi, tutar, tarih FROM " . DBT_ODEMELER;

			$wheres = array();
			$where_vals = array();

			$wheres[] = " durum = ? ";
			$where_vals[] = "1";

			if( $input["isim"] != "" ){
				$wheres[] = " kart = ? ";
				$where_vals[] = $input["isim"];
			}

			if( trim($input["tutar_alt"]) != "" ){
				$wheres[] = " tutar >= ? ";
				$where_vals[] = $input["tutar_alt"];
			}

			if( trim($input["tutar_ust"]) != "" ){
				$wheres[] = " tutar <= ? ";
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
					$q["kart"],
					$q["odeme_tipi"],
					$q["tutar"],
					Common::date_reverse($q["tarih"])
				);
			}
			
			return $dt_data;
		}

	}