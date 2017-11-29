<?php
	
	require 'inc/defs.php';
	
	$PAGE = array(
		"title" 		=> "Pamira Stone",
		"top_title"		=> "Pamira Stone",
		"template" 		=> "template_index.php",
		"html_libs" 	=> array()
	);


	require 'inc/header.php';


	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';

?>
