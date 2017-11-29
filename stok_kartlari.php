<?php

	include 'inc/defs.php';
	
	$PAGE = array(
		"title" 		=> "Stok Kartları",
		"top_title"		=> "Stok Kartları",
		"template" 		=> "template_stok_kartlari.php",
		"html_libs" 	=> array( "datatables" )
	);


	include 'inc/header.php';


	include TEMPLATES_DIR . $PAGE["template"];


	include 'inc/footer.php';

?>
