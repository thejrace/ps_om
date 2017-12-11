<?php
  	
	require 'inc/defs.php';

	if( $_POST ){

		DB::getInstance()->insert("fatura_css", array(

			"profil_ismi" 				=> "obarey",
			"duzenlenme_tarihi_1" 		=> $_POST["duzenlenme_tarihi_1"]["top"] . "#" . $_POST["duzenlenme_tarihi_1"]["left"],
			"duzenlenme_tarihi_2" 		=> $_POST["duzenlenme_tarihi_2"]["top"] . "#" . $_POST["duzenlenme_tarihi_2"]["left"],
			"duzenlenme_saati_1" 		=> $_POST["duzenlenme_saati_1"]["top"] . "#" . $_POST["duzenlenme_saati_1"]["left"],
			"duzenlenme_saati_2" 		=> $_POST["duzenlenme_saati_2"]["top"] . "#" . $_POST["duzenlenme_saati_2"]["left"],
			"cari_unvan" 				=> $_POST["cari_unvan"]["top"] . "#" . $_POST["cari_unvan"]["left"],
			"cari_adres" 				=> $_POST["cari_adres"]["top"] . "#" . $_POST["cari_adres"]["left"],
			"cari_il_ilce" 				=> $_POST["cari_il_ilce"]["top"] . "#" . $_POST["cari_il_ilce"]["left"],
			"cari_vergi_dairesi" 		=> $_POST["cari_vergi_dairesi"]["top"] . "#" . $_POST["cari_vergi_dairesi"]["left"],
			"cari_tckn_vno" 			=> $_POST["cari_tckn_vno"]["top"] . "#" . $_POST["cari_tckn_vno"]["left"],
			"ara_toplam" 				=> $_POST["ara_toplam"]["top"] . "#" . $_POST["ara_toplam"]["left"],
			"kdv" 						=> $_POST["kdv"]["top"] . "#" . $_POST["kdv"]["left"],
			"genel_toplam" 				=> $_POST["genel_toplam"]["top"] . "#" . $_POST["genel_toplam"]["left"],
			"genel_toplam_yaziyla" 		=> $_POST["genel_toplam_yaziyla"]["top"] . "#" . $_POST["genel_toplam_yaziyla"]["left"],
			"stok_detaylari" 			=> $_POST["stok_detaylari"]["top"] . "#" . $_POST["stok_detaylari"]["left"]
		));

		die(json_encode(array("data" => 1)));

	}


	require CLASS_DIR . "Fatura.php";


?>

<!DOCTYPE html>
<html style="background:#fff !important">
  <head>

    <!-- Meta, title, CSS, favicons, etc. -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	  
    <title>Obarey</title>
 
    <!-- Bootstrap -->
    <link href="<?php echo URL_VENDORS; ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo URL_VENDORS; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo URL_CSS; ?>custom.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?php echo URL_VENDORS; ?>jquery/dist/jquery.min.js"></script>
    <!-- jQuery UI-->
    <script src="<?php echo URL_VENDORS; ?>jquery-ui/jquery-ui.js"></script>
    <link href="<?php echo URL_VENDORS; ?>jquery-ui/jquery-ui.css" rel="stylesheet">

    <!-- Bootstrap -->
    <script src="<?php echo URL_VENDORS; ?>bootstrap/dist/js/bootstrap.min.js"></script>



    
  </head>
  <body style="background:#fff !important">


  		<div class="fatura_a4 ">

  			<div class="fatura_row">
  				<div class="fatura_item duzenlenme_tarihi_1">duzenlenme_tarihi</div>
	  			<div class="fatura_item duzenlenme_saati_1">duzenlenme_saati</div>
	  			<div class="fatura_item duzenlenme_tarihi_2">duzenlenme_tarihi</div>
	  			<div class="fatura_item duzenlenme_saati_2">duzenlenme_saati</div>

	  			<div class="fatura_item cari_unvan">cari_unvan</div>
	  			<div class="fatura_item cari_adres">cari_adres</div>
	  			<div class="fatura_item cari_il_ilce">cari_il_ilce</div>

	  			<div class="fatura_item cari_vergi_dairesi">cari_vergi_dairesi</div>
	  			<div class="fatura_item cari_tckn_vno">cari_tckn_vno</div>


	  			<div class="fatura_item ara_toplam">ara_toplam</div>
	  			<div class="fatura_item kdv">kdv</div>
	  			<div class="fatura_item genel_toplam">genel_toplam</div>
	  			<div class="fatura_item genel_toplam_yaziyla">genel_toplam_yaziyla</div>

	  			<div class="fatura_item stok_detaylari">stok_detaylari</div>
  			</div>

  			 <div class="fatura_row">
  				<div class="fatura_item duzenlenme_tarihi_1">duzenlenme_tarihi</div>
	  			<div class="fatura_item duzenlenme_saati_1">duzenlenme_saati</div>
	  			<div class="fatura_item duzenlenme_tarihi_2">duzenlenme_tarihi</div>
	  			<div class="fatura_item duzenlenme_saati_2">duzenlenme_saati</div>

	  			<div class="fatura_item cari_unvan">cari_unvan</div>
	  			<div class="fatura_item cari_adres">cari_adres</div>
	  			<div class="fatura_item cari_il_ilce">cari_il_ilce</div>

	  			<div class="fatura_item cari_vergi_dairesi">cari_vergi_dairesi</div>
	  			<div class="fatura_item cari_tckn_vno">cari_tckn_vno</div>


	  			<div class="fatura_item ara_toplam">ara_toplam</div>
	  			<div class="fatura_item kdv">kdv</div>
	  			<div class="fatura_item genel_toplam">genel_toplam</div>
	  			<div class="fatura_item genel_toplam_yaziyla">genel_toplam_yaziyla</div>

	  			<div class="fatura_item stok_detaylari">stok_detaylari</div>
  			</div>

  			<div class="fatura_row">
  				<div class="fatura_item duzenlenme_tarihi_1">duzenlenme_tarihi</div>
	  			<div class="fatura_item duzenlenme_saati_1">duzenlenme_saati</div>
	  			<div class="fatura_item duzenlenme_tarihi_2">duzenlenme_tarihi</div>
	  			<div class="fatura_item duzenlenme_saati_2">duzenlenme_saati</div>

	  			<div class="fatura_item cari_unvan">cari_unvan</div>
	  			<div class="fatura_item cari_adres">cari_adres</div>
	  			<div class="fatura_item cari_il_ilce">cari_il_ilce</div>

	  			<div class="fatura_item cari_vergi_dairesi">cari_vergi_dairesi</div>
	  			<div class="fatura_item cari_tckn_vno">cari_tckn_vno</div>


	  			<div class="fatura_item ara_toplam">ara_toplam</div>
	  			<div class="fatura_item kdv">kdv</div>
	  			<div class="fatura_item genel_toplam">genel_toplam</div>
	  			<div class="fatura_item genel_toplam_yaziyla">genel_toplam_yaziyla</div>

	  			<div class="fatura_item stok_detaylari">stok_detaylari</div>
  			</div> 

  		</div>

  		<!-- <button type="button" id="yazdir">YAZDIR</button> -->

  		<script type="text/javascript">


  				$( function() {


		  			<?php  if( isset($_GET["profil"] ) ){  

		  				$data = DB::getInstance()->query("SELECT * FROM fatura_css WHERE profil_ismi = ?", array($_GET["profil"]))->results();


		  			 ?>

		  				var kayitli_koordinatlar = <?php echo json_encode($data[0]) ?>;

		  				for( var item in kayitli_koordinatlar ){
  							if( item == "id" || item == "profil_ismi" ) continue;
  							var koord = kayitli_koordinatlar[item].split("#");
	  						$("."+item).css({
	  							position: 'relative',
	  							left: koord[1] + "px",
	  							top: koord[0] + "px"
	  						});
	  					}

		  			<?php } else { ?>

		  				var kayitli_koordinatlar = {};


		  			<?php } ?>

  				

  					var koordinatlar = {};


  					

  					$( ".cari_vergi_dairesi" ).draggable({
				    	stop: function( event, ui ) {
				    		koordinatlar["cari_vergi_dairesi"] = ui.position;
				    	}
				    });
				    $( ".cari_tckn_vno" ).draggable({
				    	stop: function( event, ui ) {
				    		koordinatlar["cari_tckn_vno"] = ui.position;
				    	}
				    });


				    $( ".duzenlenme_tarihi_1" ).draggable({
				    	stop: function( event, ui ) {
				    		koordinatlar["duzenlenme_tarihi_1"] = ui.position;
				    	}
				    });
				    $( ".duzenlenme_tarihi_2" ).draggable({
				    	stop: function( event, ui ) {
				    		koordinatlar["duzenlenme_tarihi_2"] = ui.position;
				    	}
				    });
				    $( ".duzenlenme_saati_1" ).draggable({
				    	stop: function( event, ui ) {
				    		koordinatlar["duzenlenme_saati_1"] = ui.position;
				    	}
				    });
				    $( ".duzenlenme_saati_2" ).draggable({
				    	stop: function( event, ui ) {
				    		koordinatlar["duzenlenme_saati_2"] = ui.position;
				    	}
				    });

				    $( ".cari_unvan" ).draggable({
				    	stop: function( event, ui ) {
				    		koordinatlar["cari_unvan"] = ui.position;
				    	}
				    });
				    $( ".cari_adres" ).draggable({
				    	stop: function( event, ui ) {
				    		koordinatlar["cari_adres"] = ui.position;
				    	}
				    });
				    $( ".cari_il_ilce" ).draggable({
				    	stop: function( event, ui ) {
				    		koordinatlar["cari_il_ilce"] = ui.position;
				    	}
				    });
				    
				    $( ".kdv" ).draggable({
				    	stop: function( event, ui ) {
				    		koordinatlar["kdv"] = ui.position;
				    	}
				    });
				    $( ".genel_toplam" ).draggable({
				    	stop: function( event, ui ) {
				    		koordinatlar["genel_toplam"] = ui.position;
				    	}
				    });
				    $( ".ara_toplam" ).draggable({
				    	stop: function( event, ui ) {
				    		koordinatlar["ara_toplam"] = ui.position;
				    	}
				    });
				    $( ".genel_toplam_yaziyla" ).draggable({
				    	stop: function( event, ui ) {
				    		koordinatlar["genel_toplam_yaziyla"] = ui.position;
				    	}
				    });

				    $( ".stok_detaylari" ).draggable({
				    	stop: function( event, ui ) {
				    		koordinatlar["stok_detaylari"] = ui.position;
				    	}
				    });
					
				    $("#yazdir").click(function(){
				    	console.log( koordinatlar );
				    	$.ajax({
				    		"url":"",
				    		"data": koordinatlar,
				    		"dataType":"json",
				    		"type":"POST",
				    		success:function(res){
				    			console.log(res);
				    		}
				    	});
				    });



				});

  		</script>

  </body>
</html>