<?php
	
	require 'inc/defs.php';

	$PAGE = array(
		"title" 		=> "Pamira Stone",
		"top_title"		=> "Pamira Stone",
		"template" 		=> "template_index.php",
		"html_libs" 	=> array()
	);


	require 'inc/header.php';


	echo User::get_data("user_email");


	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';

?>
