<?php

	class UrunGrubu extends DataCommon {

		public function __construct( $id = null ){
			$this->pdo = DB::getInstance();
			$this->dt_table = DBT_STOK_KARTLARI_URUN_GRUPLARI;
			if( isset($id) ) $this->check( array("id", "isim" ), $id);
		}

		public function ekle( $input ){
			if( !$this->isim_kontrol( $input["isim"] ) ) return false;
			$this->pdo->insert( $this->dt_table, array(
				"isim" 	=> $input["isim"],
				"durum" => 1
			));
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}
			$this->details["id"] = $this->pdo->lastInsertedId();
			$this->return_text = "Ürün grubu eklendi.";
			return true;
		} 

		public function duzenle( $input ){
			if( !$this->isim_kontrol( $input["isim"] ) ) return false;
			$this->pdo->query("UPDATE " . $this->dt_table . " SET isim = ? WHERE id = ?", array( $input["isim"], $this->details["id"] ) );
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}
			$this->return_text = "Ürün grubu düzenlendi.";
			return true;
		}

		public function sil( $input ){
		
		}

		private function isim_kontrol( $isim ){
			$kontrol = $this->pdo->query("SELECT * FROM " . $this->dt_table . " WHERE isim = ?", array( $isim ))->results();
			$this->return_text = "Bu isimde ürün grubu zaten var.";
			return count($kontrol) == 0;
		}	


	}