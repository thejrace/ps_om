<?php
	
	require 'inc/defs.php';
	
	$PAGE = array(
		"title" 		=> "Cariler",
		"top_title"		=> "Cariler",
		"template" 		=> "template_cariler.php",
		"html_libs" 	=> array( "datatables" )
	);


	require 'inc/header.php';


	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';

?>
