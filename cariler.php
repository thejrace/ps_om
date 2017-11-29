<?php
	
	include 'inc/defs.php';
	
	$PAGE = array(
		"title" 		=> "Cariler",
		"top_title"		=> "Cariler",
		"template" 		=> "template_cariler.php",
		"html_libs" 	=> array( "datatables" )
	);


	include 'inc/header.php';


	include TEMPLATES_DIR . $PAGE["template"];


	include 'inc/footer.php';

?>
