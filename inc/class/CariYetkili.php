<?php

	class CariYetkili extends DataCommon {

		public function __construct( $id = null ){
			$this->pdo = DB::getInstance();
			$this->dt_table = DBT_CARI_YETKILILER;
			if( isset($id) ) $this->check(array("id", "isim", "eposta", "telefon" ), $id );
		}

		public function ekle( $cari_id, $input_str ){
			$data_array = explode( "##", $input_str );
			$this->pdo->insert( $this->dt_table, array(
				"cari_id" 	=> $cari_id,
				"isim" 		=> $data_array[0],
				"eposta" 	=> $data_array[1],
				"telefon" 	=> $data_array[2],
				"notlar" 	=> $data_array[3]
			));
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}
			$this->return_text = "Cari yetkili eklendi.";
			return true;
		}

		public function duzenle( $isim, $eposta, $telefon, $notlar ){
			$this->pdo->query("UPDATE " . $this->dt_table . " SET isim = ?, eposta = ?, telefon = ?, notlar = ? WHERE id = ?", array( $isim, $eposta, $telefon, $notlar, $this->details["id"]));
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}
			$this->return_text = "Cari yetkili düzenlendi.";
			return true;
		}

		public function sil(){
			$this->pdo->query("DELETE FROM " . $this->dt_table . " WHERE id = ?", array($this->details["id"]) );
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}
			$this->return_text = "Cari yetkili silindi.";
			return true;
		}

	}