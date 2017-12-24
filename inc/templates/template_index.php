

                <div class="row">
                	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-money"></i>
                          </div>
                          <div class="count fc"><?php echo Pamira::get_data("kasa") ?></div>

                          <h3>Pamira Kasa</h3>
                          <p>Tüm hesaplar toplamı</p>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-arrow-circle-down"></i>
                          </div>
                          <div class="count fc"><?php echo Pamira::get_data("alacak") ?></div>

                          <h3>Alacaklar</h3>
                          <p><?php echo Pamira::get_data("alacakli_cari_sayisi") ?> farklı cari hesaptan</p>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-arrow-circle-up"></i>
                          </div>
                          <div class="count fc"><?php echo Pamira::get_data("verecek") ?></div>

                          <h3>Verecekler</h3>
                          <p><?php echo Pamira::get_data("verecekli_cari_sayisi") ?> farklı cari hesaba</p>
                        </div>
                      </div>
                      
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-credit-card"></i>
                          </div>
                          <div class="count fc"><?php echo Pamira::get_data("odemeler") ?></div>

                          <h3>Kalan Ödemeler</h3>
                          <p>...</p>
                        </div>
                      </div>
                    </div>


                <div class="row">
                	 <div class="col-md-6 col-sm-6 col-xs-12">
			              <div class="x_panel">
			                <div class="x_title">
			                  <h4>Son Fiş Hareketleri</small></h2>
			                  <ul class="nav navbar-right panel_toolbox">
			                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                    </li>
			                  </ul>
			                  <div class="clearfix"></div>
			                </div>
			                <div class="x_content">
			                  <ul class="list-unstyled timeline">

			                  	<?php foreach( Pamira::get_data("son_fis_hareketleri") as $fis_data ) { 

			                  			$Fatura = new Fatura( $fis_data["id"] );
			                  			$Kullanici = new User( $fis_data["user"] );
			                  			$CariData = $Fatura->get_cari_kayit();


			                  			echo  '<li>
							                      <div class="block">
							                        <div class="tags">
							                          <a href="'.URL_FATURA_INCELE.$fis_data["id"].'" class="tag '.Common::sef_link(Fatura::$TUR_STR[$Fatura->get_details("fis_turu")]).' ">
							                            <span>'.Fatura::$TUR_STR[$Fatura->get_details("fis_turu")].'</span>
							                          </a>
							                        </div>
							                        <div class="block_content">
							                          <h2 class="title">
				                                          <a><b><i class="fa fa-user"></i> '.$CariData[0]["unvan"].'</b>, Tutar: <span class="fc">'.$Fatura->get_details("genel_toplam").'</span></a></h2>
							                          <div class="byline">
							                            <span>'.Common::datetime_reverse($Fatura->get_details("eklenme_tarihi")).'</span> <a>'.$Kullanici->get_details("isim").' tarafından</a>
							                          </div>
							                        </div>
							                      </div>
							                    </li>';


			                  	} ?>
			                   
			                   
			                  </ul>

			                </div>
			              </div>
			            </div>


			            <div class="col-md-6 col-sm-6 col-xs-12">
			              <div class="x_panel">
			                <div class="x_title">
			                  <h4>Son Makbuzlar</small></h2>
			                  <ul class="nav navbar-right panel_toolbox">
			                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                    </li>
			                  </ul>
			                  <div class="clearfix"></div>
			                </div>
			                <div class="x_content">
			                  <ul class="list-unstyled timeline">
			                    	
			                  		<?php foreach( Pamira::get_data("son_makbuz_hareketleri") as $makbuz_data ) { 

			                  			$Makbuz = new TahsilatMakbuzu( $makbuz_data["id"] );
			                  			$CariData = $Makbuz->get_cari_kayit();
			                  			$Kullanici = new User( $makbuz_data["user"] );

			                  			echo  '<li>
							                      <div class="block">
							                        <div class="tags">
							                          <a href="#" class="tag '.Common::sef_link(TahsilatMakbuzu::$TIP_STR[$Makbuz->get_details("tip")]).'">
							                            <span>'.TahsilatMakbuzu::$TIP_STR[$Makbuz->get_details("tip")].'</span>
							                          </a>
							                        </div>
							                        <div class="block_content">
							                          <h2 class="title">
				                                          <a><b><i class="fa fa-user"></i> '.$CariData[0]["unvan"].'</b>,  '.$Makbuz->get_details("tahsilat_tipi").', Tutar: <span class="fc">'.$Makbuz->get_details("tutar").'</span></a></h2>
							                          <div class="byline">
							                            <span>'.Common::datetime_reverse($Makbuz->get_details("eklenme_tarihi")).'</span> <a>'.$Kullanici->get_details("isim").' tarafından</a>
							                          </div>
							                        </div>
							                      </div>
							                    </li>';


			                  	} ?>

			                  </ul>

			                </div>
			              </div>
			            </div>


                </div>


                <div class="row">
                	 <div class="col-md-6 col-sm-6 col-xs-12">
			              <div class="x_panel">
			                <div class="x_title">
			                  <h4>Mağaza Hareketleri</small></h2>
			                  <ul class="nav navbar-right panel_toolbox">
			                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                    </li>
			                  </ul>
			                  <div class="clearfix"></div>
			                </div>
			                <div class="x_content">
			                  <ul class="list-unstyled timeline">

			                  	<?php foreach( Pamira::get_data("son_magaza_hareketleri") as $magaza_hareket ){  


			                  			$MagazaFisi = new MagazaFisi( $magaza_hareket["id"] );
			                  			$Kullanici = new User( $magaza_hareket["user"] );

			                  			echo  '<li>
							                      <div class="block">
							                        <div class="tags">
							                          <a href="#" class="tag">
							                            <span>Mağaza</span>
							                          </a>
							                        </div>
							                        <div class="block_content">
							                          <h2 class="title">
				                                          <a><i class="fa fa-tags"></i> Mağaza ( '.Common::date_reverse($MagazaFisi->get_details("tarih")).' ) Tutar: <span class="fc">'.$MagazaFisi->get_details("toplam").'</span></a></h2>
							                          <div class="byline">
							                            <span>'.Common::datetime_reverse($MagazaFisi->get_details("eklenme_tarihi")).'</span> <a>'.$Kullanici->get_details("isim").' tarafından</a>
							                          </div>
							                        </div>
							                      </div>
							                    </li>';
						               }
			                  	?>
			                   	
			                   
			                  </ul>

			                </div>
			              </div>
			            </div>


			            <div class="col-md-6 col-sm-6 col-xs-12">
			              <div class="x_panel">
			                <div class="x_title">
			                  <h4>Son Ödemeler</small></h2>
			                  <ul class="nav navbar-right panel_toolbox">
			                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			                    </li>
			                  </ul>
			                  <div class="clearfix"></div>
			                </div>
			                <div class="x_content">
			                  <ul class="list-unstyled timeline">
			                    	
			                  		<?php foreach( Pamira::get_data("son_odeme_hareketleri") as $odeme_hareket ){  


			                  			$OdemeKarti = new OdemeKarti($odeme_hareket["kart"]);
			                  			$Kullanici = new User( $odeme_hareket["user"] );

			                  			echo  '<li>
							                      <div class="block">
							                        <div class="tags">
							                          <a href="#" class="tag alis">
							                            <span> '.$OdemeKarti->get_details("isim") .' ödeme</span>
							                          </a>
							                        </div>
							                        <div class="block_content">
							                          <h2 class="title">
				                                          <a><i class="fa fa-download"></i><b> '.$odeme_hareket["odeme_tipi"].'</b>, Tutar: <span class="fc">'.$odeme_hareket["tutar"].'</span></a></h2>
							                          <div class="byline">
							                            <span>'.Common::datetime_reverse($odeme_hareket["eklenme_tarihi"]).'</span> <a>'.$Kullanici->get_details("isim").' tarafından</a>
							                          </div>
							                        </div>
							                      </div>
							                    </li>';

						               }
			                  	?>

			                  </ul>

			                </div>
			              </div>
			            </div>






                </div>



                <script type="text/javascript">


                	$(document).ready(function(){

                		var fcs_standart = $(".fc");
                		for( var k = 0; k < fcs_standart.length; k++ ) fcs_standart[k].innerHTML = format_currency( fcs_standart[k].innerHTML );


                	})

                </script>