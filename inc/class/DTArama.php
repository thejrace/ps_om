<?php

	class DTArama {

		public static function fatura_custom( $input ){

			$prefix = "SELECT id, cari_id, aciklama, duzenlenme_tarihi, fis_turu, ara_toplam, genel_toplam FROM " . DBT_FATURALAR;

			$wheres = array();
			$where_vals = array();
			$where_flag = false;

			if( $input["fis_turu"] != "0" ){
				$wheres[] = " fis_turu = ? ";
				$where_vals[] = $input["fis_turu"];
				$where_flag = true;
			}

			if( trim($input["cari"]) != "" ){
				$Cari = new Cari( $input["cari"] );
				if( $Cari->is_ok() ){
					$wheres[] = " cari_id = ? ";
					$where_vals[] = $Cari->get_details("id");
					if( !$where_flag ) $where_flag = true;
				}
			}

			if( $input["fiyat_tipi"] != "0" ){
				if( trim($input["fiyat_alt"]) != "" ){
					$wheres[] = " " . $input["fiyat_tipi"] . " >= ? ";
					$where_vals[] = $input["fiyat_alt"]; 
					if( !$where_flag ) $where_flag = true;
				}
				if( trim($input["fiyat_ust"]) != "" ){
					$wheres[] = " " . $input["fiyat_tipi"] . " <= ? ";
					$where_vals[] = $input["fiyat_ust"]; 
					if( !$where_flag ) $where_flag = true;
				}
			}

			if( trim($input["tarih_alt"]) != "" ){
				$wheres[] = " duzenlenme_tarihi >= ? ";
				$where_vals[] = Common::date_reverse($input["tarih_alt"]);
				if( !$where_flag ) $where_flag = true;
			}

			if( trim($input["tarih_ust"]) != "" ){
				$wheres[] = " duzenlenme_tarihi <= ? ";
				$where_vals[] = Common::date_reverse($input["tarih_ust"]);
				if( !$where_flag ) $where_flag = true;
			}
			$dt_data = array();
			if( $where_flag ){
				$sql = $prefix . " WHERE " . implode(" && ", $wheres );
				$query = DB::getInstance()->query($sql, $where_vals)->results();
				foreach( $query as $q ){
					$Cari = new Cari($q["cari_id"]);
					if( $Cari->is_ok() ){
						$unvan = $Cari->get_details("unvan");
					} else {
						$unvan = "Belirsiz Cari";
					}
					$dt_data[] = array(
						$q["id"],
						$unvan,
						$q["aciklama"],
						Fatura::$TUR_STR[$q["fis_turu"]],
						$q["ara_toplam"],
						$q["genel_toplam"],
						Common::datetime_reverse($q["duzenlenme_tarihi"])
					);
				}
			}
			return $dt_data;
		}

	}