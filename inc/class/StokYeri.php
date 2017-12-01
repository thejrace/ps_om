<?php

	class StokYeri extends DataCommon {

		public function __construct( $id = null ){
			$this->pdo = DB::getInstance();
			$this->dt_table = DBT_STOK_YERLERI;
			if( isset($id) ) $this->check( array("id", "isim" ), $id);
		}

		// yeni olusturuldugunda tum stok kartlari icin stok_kartlari_stoklar tablsouna kayit eklencek

	}