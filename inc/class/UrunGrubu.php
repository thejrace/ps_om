<?php

	class UrunGrubu extends DataCommon {

		public function __construct( $id = null ){
			$this->pdo = DB::getInstance();
			$this->dt_table = DBT_STOK_KARTLARI_URUN_GRUPLARI;
			if( isset($id) ) $this->check( array("id", "isim" ), $id);
		}

		public function ekle( $input ){

			if( !User::izin_kontrol( User::$IZ_URUN_GRUBU_EKLE ) ){
				$this->return_text = "Bu işlemi yapmaya yetkiniz yok.";
				return false;
			}

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

			if( !User::izin_kontrol( User::$IZ_URUN_GRUBU_DUZENLE ) ){
				$this->return_text = "Bu işlemi yapmaya yetkiniz yok.";
				return false;
			}

			if( !$this->isim_kontrol( $input["isim"] ) ) return false;
			$this->pdo->query("UPDATE " . $this->dt_table . " SET isim = ? WHERE id = ?", array( $input["isim"], $this->details["id"] ) );
			if( $this->pdo->error() ){
				$this->return_text = "Bir hata oluştu.[1][".$this->pdo->get_error_message()."]";
				return false;
			}
			$this->return_text = "Ürün grubu düzenlendi.";
			return true;
		}

		public function sil(){
			if( !User::izin_kontrol( User::$IZ_URUN_GRUBU_DUZENLE ) ){
				$this->return_text = "Bu işlemi yapmaya yetkiniz yok.";
				return false;
			}
			
			$this->pdo->query("UPDATE " . $this->dt_table ." SET durum = ? WHERE id = ?", array(0, $this->details["id"]));
			$this->return_text = "Ürün grubu silindi.";
			return true;
		}

		private function isim_kontrol( $isim ){
			$kontrol = $this->pdo->query("SELECT * FROM " . $this->dt_table . " WHERE isim = ?", array( $isim ))->results();
			$this->return_text = "Bu isimde ürün grubu zaten var.";
			return count($kontrol) == 0;
		}	

		public static function ac_arama( $term ){
			$q = array();
			foreach( DB::getInstance()->query("SELECT isim FROM " . DBT_STOK_KARTLARI_URUN_GRUPLARI . " WHERE (isim LIKE ? || isim LIKE ? || isim LIKE ?) && durum = ?", array("%".$term, $term."%", "%".$term."%", 1))->results() as $res ) $q[] = $res["isim"];
			return $q;
		}

	}