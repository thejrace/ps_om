<?php

	require 'inc/defs.php';
	
	$PAGE = array(
		"title" 		=> "Stok Kartları",
		"top_title"		=> "Stok Kartları",
		"template" 		=> "template_stok_kartlari.php",
		"html_libs" 	=> array( "datatables" )
	);


	require 'inc/header.php';


	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';

?>
