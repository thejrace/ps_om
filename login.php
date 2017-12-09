<?php
	
	$REG_OR_LOG = true;
	require 'inc/defs.php';
	
	if( $_POST ){

		$OK = 1;
        $TEXT = "";


		if( $_POST["req"] == "login" ){

			if(trim($_POST["eposta"]) == "" || trim($_POST["pass"]) == "" ){
				$OK = 0;
				$TEXT = "Formda eksiklikler var.";
			} else {

				if( !User::login( $_POST ) ){
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
		"title" 		=> "Giriş Yap",
		"top_title"		=> "Giriş Yap",
		"template" 		=> "template_login.php",
		"html_libs" 	=> array()
	);

	require TEMPLATES_DIR . $PAGE["template"];

