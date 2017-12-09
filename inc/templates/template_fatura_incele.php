<div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
                                          <i class="fa fa-globe"></i>
                                          <small class="pull-right">Düz. Tarihi: <?php echo Common::datetime_reverse($Fatura->get_details("duzenlenme_tarihi")) ?></small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          Cari
                          <address>
                                          <strong><?php echo $cari_kayit[0]["unvan"] ?></strong>
                                          <br><strong>Adres: </strong><?php echo $cari_kayit[0]["adres"] ?>
                                          <br><?php echo $cari_kayit[0]["ilce"] ?> / <?php echo $cari_kayit[0]["il"] ?>
                                          <br><strong>Telefon 1: </strong><?php echo $cari_kayit[0]["telefon_1"] ?>
                                          <br><strong>Telefon 2: </strong><?php echo $cari_kayit[0]["unvan"] ?>
                                          <br><strong>Faks No: </strong><?php echo $cari_kayit[0]["faks_no"] ?>
                                          <br><strong>Eposta: </strong><?php echo $cari_kayit[0]["eposta"] ?>
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <b>Fatura No #<?php echo $Fatura->get_details("fatura_no") ?></b>
                          <br>
                          <br>
                          <b>Fatura ID </b> #<?php echo $Fatura->get_details("id") ?>
                          <br>
                          <b>Tahsilat Tarihi:</b> <?php echo Common::datetime_reverse($Fatura->get_details("tahsilat_tarihi")) ?>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                
                                <th>Stok Kodu</th>
                                <th>Stok Kartı</th>
                                <th>Birim Fiyat</th>
                                <th>KDV</th>
                                <th>Miktar</th>
                                <th>Toplam</th>
                              </tr>
                            </thead>
                            <tbody>
                                
                                <?php  

                                    foreach( $stok_detaylari as $stok_detay ){

                                         echo '<tr><td>'.$stok_detay["stok_kodu"].'</td>
                                              <td>'.$stok_detay["stok_adi"].'</td>
                                              <td format-cur="true">'.$stok_detay["birim_fiyat"].'</td>
                                              <td >'.$stok_detay["kdv_orani"].'</td>
                                              <td>'.$stok_detay["miktar"].'</td>
                                              <td format-cur="true">'.$stok_detay["toplam"].'</td></tr>';

                                    }

                                ?>

                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                         
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <p class="lead">Fatura Özet</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Ara Toplam:</th>
                                  <td format-cur="true"><?php echo $Fatura->get_details("ara_toplam") ?></td>
                                </tr>
                                <tr>
                                  <th>KDV Miktarı</th>
                                  <td format-cur="true"><?php echo $Fatura->get_details("kdv_miktar") ?></td>
                                </tr>
                                <tr>
                                  <th>Genel Toplam:</th>
                                  <td format-cur="true"><?php echo $Fatura->get_details("genel_toplam") ?></td>
                                </tr>
                                <tr>
                                  <th>Genel Toplam Yazıyla:</th>
                                  <td><?php echo $Fatura->get_details("genel_toplam_yaziyla") ?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">

                          <?php if( $Fatura->get_details("fis_turu") == Fatura::$SIPARIS_FISI && User::izin_kontrol( User::$IZ_FIS_FATURALANDIRMA ) ) { ?>

                                <button class="btn btn-success" data-toggle="modal" data-target=".faturalandir_modal"><i class="fa fa-file-text"></i> Faturalandır</button>

                          <?php } ?>

                          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Yazdır</button>
                        </div>
                      </div>
                    </section>

                    <div class="modal fade faturalandir_modal" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">

                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Faturalandır</h4>
                          </div>
                          <div class="modal-body">
                            
                              <div class="row">
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                      <div class="x_panel tile">
                                        
                                        <div class="x_content " style="text-align:center">
                                          
                                           <button class="btn btn-info fcevir" data="satis_fisi" ><i class="fa fa-file-text"></i> Satış Fişine Çevir</button><br /><br />
                                           <button class="btn btn-danger fcevir"  data="satis_faturasi"><i class="fa fa-file-text"></i> Satış Faturasına Çevir</button>

                                        </div>
                                    </div>
                              </div>
                            
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>

 
                  <script type="text/javascript">


                      $(document).ready(function(){

                          $(".fcevir").click(function(){

                              REQ.ACTION("", { req:"fcevir", item_id: <?php echo Input::get("item_id") ?>, convert:this.getAttribute("data") }, function(res){
                                  console.log(res);
                              });

                          });


                          var formatlar = $("[format-cur]");
                          for( var k = 0; k < formatlar.length; k++ ){
                              formatlar[k].innerHTML = format_currency(formatlar[k].innerHTML);
                          }

                      });

                  </script>

