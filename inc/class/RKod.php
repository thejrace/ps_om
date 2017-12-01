<?php

	class RKod {


		public static   $PF_URUN_GRUBU = "PSUG",
	                    $PF_STOK_KARTI = "STK";


	    public static   $URUN_GRUBU     = 0,
	                    $STOK_KARTI     = 1;


	    public static function olustur( $tip, $data = array() ){
	    	$hash = "";
	    	switch( $tip ){

	    		case self::$URUN_GRUBU:

	    			do {
	                    $hash = self::$PF_URUN_GRUBU . "_" . Common::generate_random_string( 20 );
	                    $check_query = DB::getInstance()->query("SELECT * FROM " . DBT_STOK_KARTLARI_URUN_GRUPLARI . " WHERE kod = ?", array( $hash ) )->results();
	                } while ( count( $check_query )  > 0 );

	    		break;

	    		case self::$STOK_KARTI:
	    			do {
	                    $hash = self::$PF_STOK_KARTI . Common::generate_random_string( 40 );
	                    $check_query = DB::getInstance()->query("SELECT * FROM " . DBT_STOK_KARTLARI . " WHERE stok_kodu = ?", array( $hash ) )->results();
	                } while ( count( $check_query )  > 0 );
	    		break;

	    	}
	    	return $hash;
	    }


	}