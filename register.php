<?php
	

	require 'inc/defs.php';

	if( !User::izin_kontrol( User::$IZ_REGISTER ) ){
		header("Location: " . MAIN_URL );
	}
	
	if( $_POST ){

		$OK = 1;
        $TEXT = "";


		if( $_POST["req"] == "register" ){

			if(trim($_POST["eposta"]) == "" || trim($_POST["pass"]) == "" || trim($_POST["isim"]) == "" ){
				$OK = 0;
				$TEXT = "Formda eksiklikler var.";
			} else {

				if( !User::register( $_POST ) ){
					$OK = 0;
				}
				$TEXT = User::$st_return_text;
			}
		}

		$output = json_encode(array(
            "ok"           => $OK,           
            "text"         => $TEXT,         
            "oh"           => $_POST
        ));

        echo $output;
        die;

	}
	
	$PAGE = array(
		"title" 		=> "Kullanıcı Oluştur",
		"top_title"		=> "Kullanıcı Oluştur",
		"template" 		=> "template_register.php",
		"html_libs" 	=> array()
	);

	require TEMPLATES_DIR . $PAGE["template"];

