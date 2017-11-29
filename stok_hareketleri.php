<?php
	
	include 'inc/defs.php';

	$PAGE = array(
		"title" 		=> "Stok Hareketleri",
		"top_title"		=> "Stok Hareketleri",
		"template" 		=> "template_stok_hareketleri.php",
		"html_libs" 	=> array( "datatables" )
	);


	include 'inc/header.php';


	include TEMPLATES_DIR . $PAGE["template"];


	include 'inc/footer.php';

?>
