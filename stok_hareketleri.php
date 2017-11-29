<?php
	
	require 'inc/defs.php';

	$PAGE = array(
		"title" 		=> "Stok Hareketleri",
		"top_title"		=> "Stok Hareketleri",
		"template" 		=> "template_stok_hareketleri.php",
		"html_libs" 	=> array( "datatables" )
	);


	require 'inc/header.php';


	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';

?>
