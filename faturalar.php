<?php
	
	require 'inc/defs.php';

	require CLASS_DIR . 'Common.php';
	require CLASS_DIR . 'DB.php';

	if( $_GET ){

		require CLASS_DIR . 'SSP.php';
		require CLASS_DIR . 'DataCommon.php';
		require CLASS_DIR . 'CariYetkili.php';
		require CLASS_DIR . 'Cari.php';
		require CLASS_DIR . 'Fatura.php';

		$DATA_TABLES_ROWS = array(
			"primary_key" 	=> "id",
			"table"			=> DBT_FATURALAR,
			"cols" 			=> array(
				array( 'db' => 'id', 					'dt' => 0 ),
				array( 'db' => 'cari_id', 				'dt' => 1, 'formatter' => function($d, $row){
					$Cari = new Cari( $d );
					if( $Cari->is_ok() ) return $Cari->get_details("unvan");
					return "Belirsiz Cari";
				}),
				array( 'db' => 'aciklama', 				'dt' => 2 ),
			    array( 'db' => 'fis_turu',   			'dt' => 3, 'formatter' => function($d, $row){ return Fatura::$TUR_STR[$d]; }),
			    array( 'db' => 'ara_toplam',    		'dt' => 4 ),
			    array( 'db' => 'genel_toplam',  		'dt' => 5 ),
			    array( 'db' => 'duzenlenme_tarihi',  	'dt' => 6, 'formatter' => function($d, $row){ return Common::datetime_reverse($d);  } )
		    )
		);
		die(json_encode(
		    SSP::simple( $_GET, $DATA_TABLES_ROWS["table"], $DATA_TABLES_ROWS["primary_key"], $DATA_TABLES_ROWS["cols"] )
		));
	}
	
	$PAGE = array(
		"title" 		=> "Faturalar",
		"top_title"		=> "Faturalar",
		"template" 		=> "template_faturalar.php",
		"html_libs" 	=> array( "datatables" )
	);


	require 'inc/header.php';


	require TEMPLATES_DIR . $PAGE["template"];


	require 'inc/footer.php';

?>
