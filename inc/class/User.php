<?php
	
	class User extends DataCommon{

		public static $st_return_text;
		public static $SEVIYE_MUHASEBE = 1, $SEVIYE_NORMAL = 2, $SEVIYE_ADMIN = 3;


		public static 	$IZ_CARI_EKLE 						= 1,
						$IZ_CARI_DUZENLE 					= 2,
						$IZ_CARILER_GORUNTULEME 			= 3,
						$IZ_CARI_INCELEME 					= 4,
						$IZ_FATURA_EKLE 					= 5,
						$IZ_FATURA_DUZENLE 					= 6,
						$IZ_FATURALAR_GORUNTULEME 			= 7,
						$IZ_FATURA_INCELEME 				= 8,
						$IZ_STOK_KARTI_EKLE 				= 9,
						$IZ_STOK_KARTI_DUZENLE 				= 10,
						$IZ_STOK_KARTLARI_GORUNTULEME 		= 11,
						$IZ_STOK_KARTI_INCELEME 			= 12,
						$IZ_URUN_GRUBU_EKLE 				= 13,
						$IZ_URUN_GRUBU_DUZENLE 				= 14,
						$IZ_URUN_GRUPLARI_GORUNTULEME 		= 15,
						$IZ_TAHSILAT_MAKBUZU_EKLE 			= 16,
						$IZ_TAHSILAT_MAKBUZU_DUZENLE 		= 17,
						$IZ_TAHSILAT_MAKBUZU_INCELEME 		= 18,
						$IZ_FIS_FATURALANDIRMA 				= 19,
						$IZ_REGISTER						= 20,
						$IZ_ODEME_KARTLARI_GORUNTULEME      = 21,
						$IZ_ODEME_KARTI_EKLE 				= 22,
						$IZ_ODEME_YAP 						= 23,
						$IZ_ODEMELER_GORUNTULEME			= 24,
						$IZ_STOK_HAREKETLERI_GORUNTULEME    = 25,
						$IZ_STOK_HAREKET_GIRIS_CIKIS		= 26,
						$IZ_MAGAZA_SATISLARI_GORUNTULEME    = 27;

		public static $IZINLER_TEMPLATE = array();
		public static $IZINLER = array();

		public function __construct( $id ){
			// constructor app içi kullanim için
			// diger metodlar static
			$this->pdo = DB::getInstance();
			$this->dt_table = DBT_USERS;
			if( isset($id) ) $this->check( array("id"), $id);
		}

		// formla login
		public static function login( $input ){

			$email_query = DB::getInstance()->query("SELECT * FROM " . DBT_USERS . " WHERE eposta = ?", array( $input["eposta"]));
			if( $email_query->count() ==  1 ){
				$user_data = $email_query->results();
				$user_salt = $user_data[0]["salt"];
				$user_pass = $user_data[0]["pass"];
				$user_id   = $user_data[0]["id"];
			} else {	
				self::$st_return_text = "Eposta veya şifre yanlış.";
				return false;
			}
			// sifre kontrolu
			$input_pass = hash( 'sha256', $user_salt . $input["pass"] );
			if( $input_pass != $user_pass ){
				self::$st_return_text = "Eposta veya şifre yanlış.";
				return false;
			}

			// remember me kontrolu
			if( isset( $input["remember_me"] ) ){
				if( !self::update_remember_me_token($user_id) ){
					self::$st_return_text = "Bir hata oluştu[3].";
					return false;
				}
			}

			$_SESSION["user_id"] 	= $user_id;
			$_SESSION["user_name"] 	= $user_data[0]["isim"];
			$_SESSION["user_email"] = $input["eposta"];
			$_SESSION["user_level"] = $user_data[0]["seviye"];

			self::$st_return_text = "Giriş başarılı.";
			return true;
		}

		public static function remember(){

			if( !isset($_COOKIE["pstoken"] ) ) return false;
			$cookie = $_COOKIE["pstoken"];
			$selector  = substr($cookie, 0, 12 );
			$validator = substr($cookie, 12 );
			
			// selector kontrolu
			$selector_query = DB::getInstance()->query("SELECT * FROM " . DBT_COOKIE_TOKENS . " WHERE selector = ? ", array($selector) )->results();
			if( count($selector_query) != 1 ) {
				self::$st_return_text = "Selector DB de yok yalanji var gene.";
				return false;
			}

			// cookie deki validator den token olustur, dbki ile karsilastir
			$cookie_token = hash( 'sha256', $validator );
			$auth_token = $selector_query[0]["token"];
			$user_id = $selector_query[0]["user_id"];
			if( !Common::hash_equals( $auth_token, $cookie_token) ){
				self::$st_return_text = "Tokenlar uyusmuyor. Yalanji var.";
				return false;
			}
			if( !self::update_remember_me_token( $selector_query[0]["user_id"] ) ){
				self::$st_return_text = "Bir hata oluştu[3].";
				return false;
			}

			$query = DB::getInstance()->query("SELECT * FROM " . DBT_USERS . " WHERE id = ?",array( $user_id) )->results();
			$_SESSION["user_id"] 	= $query[0]["id"];
			$_SESSION["user_name"] 	= $query[0]["isim"];
			$_SESSION["user_email"] = $query[0]["eposta"];
			$_SESSION["user_level"] = $query[0]["seviye"];

			return true;
		}

		public static function register( $input ){
			// salt olustur
			$salt = utf8_encode( mcrypt_create_iv( 64, MCRYPT_DEV_URANDOM ) );
			$hash = hash( 'sha256', $salt . $input["pass"] );
			DB::getInstance()->insert( DBT_USERS, array(
				"isim" 			=> $input["isim"],
				"eposta" 		=> $input["eposta"],
				"salt" 			=> $salt,
				"pass" 			=> $hash,
				"seviye" 		=> $input["seviye"],
				"durum" 		=> 1,
				"son_giris" 	=> Common::get_current_datetime()
			));
			if( DB::getInstance()->error() ){
				self::$st_return_text = "Hata oluştu[1][".DB::getInstance()->get_error_message()."]";
				return false;
			}
			self::$st_return_text = "Kayıt başarılı.";
			return true;
		}

		private static function update_remember_me_token( $user_id ){

			$selector  = substr( base64_encode( mcrypt_create_iv( 12, MCRYPT_DEV_URANDOM ) ), 0, 12 );
			$validator = base64_encode( mcrypt_create_iv( 32, MCRYPT_DEV_URANDOM ) );
			$token     = hash( 'sha256', $validator );
			// yeni mi ekleyecegiz yoksa update mi kontrol
			$exists_query = DB::getInstance()->query("SELECT * FROM " . DBT_COOKIE_TOKENS . " WHERE user_id = ?", array($user_id))->results();
			if( count($exists_query) == 1 ){
				DB::getInstance()->query("UPDATE " . DBT_COOKIE_TOKENS . " SET token = ?, selector = ? WHERE user_id = ?", array( $token, $selector, $user_id ) );
				if( DB::getInstance()->error() ) return false;
			} else {	
				DB::getInstance()->insert(DBT_COOKIE_TOKENS, array(
					"user_id"  => $user_id,
					"selector" => $selector,
					"token"    => $token
				));
				if( DB::getInstance()->error() ) return false;
			}
			setCookie("pstoken", $selector.$validator, time()+86400*365, "/");
			return true;

		}

		public static function logout(){
			setcookie("pstoken", "", time()-86400*365, "/");
			if( isset($_SESSION["user_id"])) unset($_SESSION["user_id"]);
			if( isset($_SESSION["user_name"])) unset($_SESSION["user_name"]);
			if( isset($_SESSION["user_email"])) unset($_SESSION["user_email"]);
			if( isset($_SESSION["user_level"])) unset($_SESSION["user_level"]);
		}

		public static function check_login(){
			return isset($_SESSION["user_id"]) && isset($_SESSION["user_name"]) && isset($_SESSION["user_email"]) && isset($_SESSION["user_level"]);
		}

		public static function get_data( $key = null ){
			// session data dön
			return $_SESSION[$key];
		}

		public static function izin_kontrol( $action ){
			return in_array( $action, self::$IZINLER );
		}

	}
	