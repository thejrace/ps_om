<?php

	class Cari extends DataCommon {

		public function __construct( $id = null ){
			$this->pdo = DB::getInstance();
			$this->dt_table = DBT_CARILER;
			if( isset($id) ) $this->check( array("id", "unvan", "eposta", "vkn_tckn"), $id);
		}

		public function ekle( $input ){

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
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}
			$this->return_text = "Cari kayıt eklendi.";
			return true;
		}

		public function duzenle( $input ){
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

		public function get_yetkililer(){
			return $this->pdo->query("SELECT * FROM " . DBT_CARI_YETKILILER . " WHERE cari_id = ?", array($this->details["id"]))->results();
		}

		public function sil(){

		}

	}