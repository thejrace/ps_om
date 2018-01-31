            
            
            <div class="row">

            <form class="form-horizontal form-label-left" id="fatura_form" >
              <div class="col-md-6  col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>Genel Bilgiler<small></small></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Açıklama</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control req" placeholder="Açıklama" name="aciklama" id="aciklama" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Türü</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control not_zero" name="fis_turu" id="fis_turu" />
                            <option value="0">Seçiniz..</option>
                            <option value="1">Alış</option>
                            <option value="2">Satış</option>
                            <option value="3">Sipariş Fişi</option>
                            <option value="4">Alış Fişi</option>
                            <option value="5">Satış Fişi</option>
                          </select>
                        </div>
                      </div>

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fatura No</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control numeric posnum" placeholder="Fatura No" name="fatura_no" id="fatura_no" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cari</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control req" placeholder="Cari" name="cari" id="cari" />
                          <button type="button" class="btn btn-xs btn-info" id="yeni_cari_detay" data-toggle="modal" data-target=".yeni_cari_modal" ><i class="fa fa-plus"></i> Cari Bilgileri Ekle</button>
                          <span class="label label-danger">Kayıtlı olmayan Cariler için bilgi verin.</span>
                        </div>
                      </div>
                      <div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <div class="row fatura-cari-detay">
                            <div class="bs-glyphicons">
                              <ul class="bs-glyphicons-list">
                                <li>
                                  <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                  <span class="glyphicon-class" id="cari_adres_label"> - Veri yok</span>
                                </li>
                                <li>
                                  <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
                                  <span class="glyphicon-class" id="cari_bakiye_label"> - Veri yok</span>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>

                      </div>

                     
                      
                      

                    
                  </div>
                </div>
              </div>  <!--  COL -->

              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>Tarih Detayları<small></small></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                   

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Düzenlenme Tarihi</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control req" data-inputmask="'mask' : '99-99-9999 99:99:99'" placeholder="Düzenlenme Tarihi" name="duzenlenme_tarihi" id="duzenlenme_tarihi" />
                        </div>
                      </div>


                      <input type="hidden" name="req" value="<?php echo $FORM_REQ ?>" />
                      <input type="hidden" name="item_id" value="<?php echo $ITEM_ID ?>" id="item_id"/>
                      
                   
                  </div>
                </div>
              </div>  <!--  COL -->

              </form>


              <form action="" method="post" class="form-horizontal form-label-left" id="yeni_cari_form">

               <div class="modal fade yeni_cari_modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title">Yeni Cari Detayları</h4>
                    </div>
                    <div class="modal-body">
                      
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                  
                                  <div class="x_content ">
                                    

                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Türü</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <select class="form-control not_zero" name="cari_tur" id="cari_tur" />
                                            <option value="0">Seçiniz..</option>
                                            <option value="Alıcı">Alıcı</option>
                                            <option value="Satıcı">Satıcı</option>
                                            <option value="Alıcı - Satıcı">Alıcı - Satıcı</option>
                                            <option value="Tedarikçi">Tedarikçi</option>
                                          </select>
                                        </div>
                                      </div>
                                     
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Eposta</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control email" placeholder="Eposta" name="cari_eposta" id="cari_eposta" />
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Telefon 1</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control" data-inputmask="'mask' : '(999) 999 99 99'" placeholder="Telefon" name="cari_telefon_1" id="cari_telefon_1" />
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Telefon 2</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control" data-inputmask="'mask' : '(999) 999 99 99'" placeholder="Telefon" name="cari_telefon_2" id="cari_telefon_2" />
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Faks</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control" data-inputmask="'mask' : '(999) 99 99'" placeholder="Faks Numarası" name="cari_faks_no" id="cari_faks_no" />
                                        </div>
                                      </div>

                                      <div class="ln_solid"></div>

                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Açık Adres</span>
                                        </label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <textarea class="form-control" rows="3" placeholder="Açık Adres" name="cari_adres" id="cari_adres" /></textarea>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">İl</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control" placeholder="İl" name="cari_il" id="cari_il" />
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">İlçe</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control" placeholder="İlçe" name="cari_ilce" id="cari_ilce" />
                                        </div>
                                      </div>

                                       <div class="ln_solid"></div>

                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tür</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <div id="gender" class="btn-group" style="margin-bottom: 5px;" data-toggle="buttons">
                                            <label class="btn btn-default active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                              <input type="radio" name="cari_mali_tur" value="Tüzel Kişi" checked> &nbsp; Tüzel Kişi &nbsp;
                                            </label>
                                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                              <input type="radio" name="cari_mali_tur" value="Gerçek Kişi"> Gerçek Kişi
                                            </label>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">IBAN Numarası</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control" placeholder="IBAN Numarası" name="cari_iban" id="cari_iban"/>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">VKN / TCKN</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control posnum" placeholder="VKN / TCKN" name="cari_vkn_tckn" id="cari_vkn_tckn" />
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Vergi Dairesi</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control" placeholder="Vergi Dairesi" name="cari_vergi_dairesi" id="cari_vergi_dairesi" />
                                        </div>
                                      </div>


                                  </div>
                                </div>
                              </div>
                        </div>
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Tamam</button>
                    </div>

                  </div>
                </div>
            </div>
            </form>
            


            </div> <!--  ROW1 -->


            <div class="row">

              <div class="col-md-12  col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>Stok Detayları<small> </small></h4>

                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <span class="label label-danger">Kayıtlı olmayan stok kartları otomatik oluşturulacaktır.</span>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th class="col-md-2 col-sm-9 col-xs-12">Cinsi</th>
                          <th class="col-md-1 col-sm-9 col-xs-12">Fiyat</th>
                          <th class="col-md-1 col-sm-9 col-xs-12">KDV</th>
                          <th class="col-md-1 col-sm-9 col-xs-12">Miktar</th>
                          <th class="col-md-1 col-sm-9 col-xs-12">Birim</th>
                          <th class="col-md-1 col-sm-9 col-xs-12">Toplam</th>
                          <th class="col-md-1 col-sm-9 col-xs-12">Yer</th>
                          <th class="col-md-1 col-sm-9 col-xs-12"></th>
                          <th class="col-md-1 col-sm-9 col-xs-12"></th>
                        </tr>
                      </thead>
                      <tbody class="table-row-form" id="yetkililer_tbody" ></tbody>
                    </table>
                    <button type="button" class="btn btn-sm btn-info" id="satir_ekle" ><i class="fa fa-plus"></i> Ürün Ekle</button>
                  </div>
                </div>
              </div>

            
            </div> <!--  ROW1 -->

            <div class="row" style="text-align: center;">
              <button type="button" class="btn btn-md btn-success" id="btn_form_submit">Kaydet</button>
            </div>


             <div class="modal fade fiyat_gecmisi_modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title"><span id="fiyat_gecmisi_kart_label"></span> Fiyat Geçmişi</h4>
                    </div>
                    <div class="modal-body">
                      
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                  
                                  <div class="x_content ">
                                    

                                      <table id="fiyat_gecmisi_table" class="table table-striped table-bordered bulk_action dtable-obarey">
                                        <thead>
                                          <tr>
                                            <th>Fiyat</th>
                                            <th>Miktar</th>
                                            <th>Tür</th>
                                            <th>KDV</th>
                                            <th>Tarih</th>
                                          </tr>
                                        </thead>
                                        <tbody id="fiyat_gecmisi_tbody">
                                            
                                        </tbody>
                                      </table>

                                  </div>
                                </div>
                              </div>
                        </div>
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Tamam</button>
                    </div>

                  </div>
                </div>
            </div>
           
           <div class="row">

              <div class="col-md-6  col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>İşlemler<small></small></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    

                     <button type="button" class="btn btn-sm btn-danger" id="sil_btn" ><i class="fa fa-remove"></i> Sil</button>


                  </div>
                </div>
              </div>  <!--  COL -->

           </div>

          <script type="text/template" id="yetkili_row">
                <tr id="yetkili_%%YID%%" class="yetkili_row" >
                  <td>
                      <div >
                        <input type="text" class="form-control kart_%%YID%%" placeholder="Kart" parent="%%YID%%"  value="%%KART_VAL%%"  />
                      </div>
                  </td>
                  <td>
                       <div >
                        <input type="text" class="form-control fiyat convert-try" placeholder="Fiyat" parent="%%YID%%" value="%%FIYAT_VAL%%" />
                      </div>
                  </td>
                  <td>
                     <div>
                        <select class="form-control kdv" lastval="%%KDV_LASTVAL%%" value="%%KDV_VAL%%" parent="%%YID%%">
                            <option value="18">%18</option>
                            <option value="8">%8</option>
                            <option value="1">%1</option>
                            <option value="0">%0</option>
                        </select>
                       
                      </div>
                  </td>
                  <td>
                     <div >
                        <input type="text" class="form-control posnum miktar convert-try" placeholder="Miktar" parent="%%YID%%" value="%%MIKTAR_VAL%%" />
                      </div>
                  </td>
                  <td>
                     <div >
                        <select class="form-control birim" value="%%BIRIM_VAL%%" parent="%%YID%%">
                            <option value="Adet">Adet</option>
                            <option value="Kilogram">Kilogram</option>
                            <option value="Litre">Litre</option>
                            <option value="Metreküp">Metreküp</option>
                            <option value="Metrekare">Metrekare</option>
                        </select>
                      </div>
                  </td>
                  <td>
                     <div >
                        <input type="text" class="form-control toplam convert-try" placeholder="Toplam" parent="%%YID%%"  value="%%TOPLAM_VAL%%" />
                      </div>
                  </td>
                  <td>
                     <div >
                        <select class="form-control yer" value="%%YER_VAL%%" parent="%%YID%%">
                            <?php 

                              foreach( DB::getInstance()->query("SELECT * FROM " . DBT_STOK_YERLERI )->results() as $yer ){
                                echo "<option value=\"".$yer["isim"]."\">".$yer["isim"]."</option>";
                              }

                            ?>
                        </select>
                      </div>
                  </td>


                  <input type="hidden" class="yetkili_id" value="%%ID_VAL%%" parent="%%YID%%" />
                  <td style="text-align:right"><button type="button" class="btn btn-sm btn-success fiyat_gecmisi" parent="%%YID%%" data-toggle="modal" data-target=".fiyat_gecmisi_modal"><i class="fa fa-tags"></i> Cari Fiyat Geçmişi</button></td>
                  <td style="text-align:right"><button type="button" class="btn btn-sm btn-danger satir_sil" parent="yetkili_%%YID%%" ><i class="fa fa-remove"></i></button></td>
                  
                </tr>
          </script>

           <script type="text/javascript">  

              var DUZENLEME = false;
              var YCOUNT = 0;

              function stok_kart_fiyat_download(item, elem){
                  REQ.ACTION("", { req:"stok_karti_data_download", stok_karti: item, cari: UI.CARI_INPUT.val(), fis_turu:UI.TUR_INPUT.val()  }, function(res){
                      //console.log(res);
                      var parent = $("#yetkili_"+elem.attr("parent"));
                      parent.find(".birim").get(0).value = res.data.birim;
                      parent.find(".fiyat").get(0).value = res.data.fiyat;
                      if( UI.TUR_INPUT.val() == "4" || UI.TUR_INPUT.val() == "5" ){
                          parent.find(".kdv").get(0).setAttribute("lastval",res.data.kdv);
                      } else {
                          parent.find(".kdv").get(0).value = res.data.kdv;
                      }
                      $(parent.find(".fiyat").get(0)).trigger("keyup");
                      convert_try_trigger();
                  });
              }

              function yetkili_row_ekle( kart, fiyat, kdv, miktar, toplam, yer, birim, id ){
                  UI.YETKILILER_TBODY.append(replaceAll(TEMPLATE.YETKILI_SATIR
                      .replace("%%KART_VAL%%", kart)
                      .replace("%%FIYAT_VAL%%", fiyat)
                      .replace("%%KDV_VAL%%", kdv)
                      .replace("%%KDV_LASTVAL%%", kdv)
                      .replace("%%MIKTAR_VAL%%", miktar)
                      .replace("%%TOPLAM_VAL%%", toplam)
                      .replace("%%YER_VAL%%", yer)
                      .replace("%%BIRIM_VAL%%", birim)
                      .replace("%%ID_VAL%%", id), "%%YID%%", YCOUNT));


                  var aktif_row = $("#yetkili_"+YCOUNT);
                  var yer_select = aktif_row.find(".yer");
                  var kdv_select = aktif_row.find(".kdv");
                  if( yer != "" ) yer_select[0].value = yer;
                  kdv_select[0].value = kdv;
                  REQ.AC( $(".kart_"+YCOUNT), PSGLOBAL.AC_COMMON, { tip:"stok_karti" }, function( item, elem ){
                      stok_kart_fiyat_download(item, elem);
                  });
                  YCOUNT++;
                  // gayri resmi ise, yeni eklenen satırında kdv inputunu disable edip, 0 yapiyoruz
                  if( UI.TUR_INPUT.val() == "4" || UI.TUR_INPUT.val() == "5" ){
                      kdv_select[0].disabled = true;
                      kdv_select[0].value = 0;
                  }
                  convert_try_trigger();
              }

              var UI = {
                  FORM                : document.getElementById("fatura_form"),
                  CARI_FORM           : document.getElementById("yeni_cari_form"),
                  YETKILILER_TBODY    : $("#yetkililer_tbody"),
                  SATIR_EKLE          : $("#satir_ekle"),
                  SATIR_SIL           : $(".satir_sil"),
                  SUBMIT_BTN          : $("#btn_form_submit"),
                  ITEM_ID             : $("#item_id"),
                  CARI_ADRES_LABEL    : $("#cari_adres_label"),
                  CARI_BAKIYE_LABEL   : $("#cari_bakiye_label"),
                  CARI_INPUT          : $("#cari"),
                  TUR_INPUT           : $("#fis_turu"),
                  FIYAT_GECMISI_TABLE : $("#fiyat_gecmisi_table"),
                  FIYAT_GECMISI_TBODY : $("#fiyat_gecmisi_tbody")
              };
              var TEMPLATE = {
                  YETKILI_SATIR       : $("#yetkili_row").html()
              };  

              var YENI_CARI = true;
              var fis_turu = "<?php echo $FORM_SELECT ?>",
                  cari_get = "<?php echo $FORM_CARI ?>";

              function cari_detay_download( item ){
                  REQ.ACTION("", { req:"cari_ozet_download", cari_unvan: item }, function(res){
                      console.log(res);
                      UI.CARI_BAKIYE_LABEL.html("Carinin <br/> " + bakiye_dt_format(res.data.bakiye) + " <br/> bakiyesi bulunmaktadır.");
                      UI.CARI_ADRES_LABEL.html(res.data.adres + "<br/>" + res.data.telefon_1 + "<br/>" + res.data.eposta );
                      YENI_CARI = false;
                  });
              }

              $(document).ready(function(){

                  var item_id = trim(UI.ITEM_ID.val());
                  if( item_id != "" ){
                    data_download( item_id,  [ "id", "cari_id", "cari_kayit_id", "user", "durum", "ara_toplam", "genel_toplam", "kdv_miktar", "genel_toplam_yaziyla", "versiyon" ], "#", function(res){
                        for( var k = 0; k < res.data.urunler.length; k++ ) yetkili_row_ekle( res.data.urunler[k].stok_adi, res.data.urunler[k].birim_fiyat, res.data.urunler[k].kdv_orani, res.data.urunler[k].miktar, res.data.urunler[k].toplam, res.data.urunler[k].yer, res.data.urunler[k].birim, res.data.urunler[k].id );
                          DUZENLEME = true;
                          UI.CARI_INPUT.val(res.data.cari_unvan);
                          UI.CARI_BAKIYE_LABEL.html("Carinin <br/> " + bakiye_dt_format(res.data.cari_bakiye) + " <br/> bakiyesi bulunmaktadır.");
                          UI.CARI_ADRES_LABEL.html(res.data.cari_adres + "<br/>" + res.data.cari_telefon_1 + "<br/>" + res.data.cari_eposta );
                          YENI_CARI = false;
                          convert_try_trigger();
                    });
                  } else {
                      UI.TUR_INPUT.val(fis_turu);
                      UI.TUR_INPUT.trigger("change");
                      $("#sil_btn").remove();
                  }                  

                  if( cari_get != "" ){
                      cari_detay_download( cari_get );
                      UI.CARI_INPUT.val(cari_get);
                  }

                  var resmi = true;
                  UI.TUR_INPUT.change(function(){
                      // trigger kayışları
                      var kdvs = $(document).find(".kdv"),
                          fiyats = $(document).find(".fiyat");
                      if( this.value == "4" || this.value == "5" ){
                          resmi = false;
                          for( var k = 0; k < kdvs.length; k++ ){
                            kdvs[k].disabled = true;
                            kdvs[k].setAttribute("lastval", kdvs[k].value);
                            kdvs[k].value = "0";
                          }
                      } else {
                          resmi = true;
                          for( var k = 0; k < kdvs.length; k++ ){
                            kdvs[k].disabled = false;
                            if( kdvs[k].getAttribute("lastval") != "" ){
                              kdvs[k].value = kdvs[k].getAttribute("lastval");
                            }
                            
                          }
                      }
                      for( var k = 0; k < fiyats.length; k++ ) $(fiyats[k]).trigger("keyup");
                      
                  });

                  UI.SUBMIT_BTN.click(function(){
                      //UI.SUBMIT_BTN.get(0).disabled = true;
                      var yetkililer_data = [];
                      // yetkilileri ayıkla önce
                      var yrow = $(".yetkili_row"), temp_row;
                      if( yrow.length > 0 ){
                          var error = false;
                          for( var k = 0; k < yrow.length; k++ ){
                              temp_row = $(yrow[k]);
                              
                                                           
                              var fiyat     = temp_row.find(".fiyat"),
                                  kdv       = temp_row.find(".kdv"),
                                  miktar    = temp_row.find(".miktar"),
                                  toplam    = temp_row.find(".toplam"),
                                  yer       = temp_row.find(".yer"),
                                  birim     = temp_row.find(".birim"),
                                  id        = temp_row.find(".yetkili_id"),
                                  kart      = temp_row.find(".kart_"+id[0].getAttribute("parent"));


                               if( trim(kart[0].value) == "" ){
                                  addClass(kart[0], "redborder");
                                  if( !error ) error = true;
                               }
                               if( trim(kdv[0].value) == "" ){
                                  addClass(kdv[0], "redborder");
                                  if( !error ) error = true;
                               }
                               if( trim(miktar[0].value) == "" ){
                                  addClass(miktar[0], "redborder");
                                  if( !error ) error = true;
                               }
                               if( trim(toplam[0].value) == "" ){
                                  addClass(toplam[0], "redborder");
                                  if( !error ) error = true;
                               }
                               if( trim(birim[0].value) == "" ){
                                  addClass(birim[0], "redborder");
                                  if( !error ) error = true;
                               }
                               if( trim(yer[0].value) == "" ){
                                  addClass(yer[0], "redborder");
                                  if( !error ) error = true;
                               }

                               if( !error ){
                                  yetkililer_data.push( kart[0].value+"##"+
                                                        fiyat[0].value+"##"+
                                                        kdv[0].value+"##"+
                                                        miktar[0].value+"##"+
                                                        toplam[0].value+"##"+
                                                        yer[0].value+"##"+
                                                        birim[0].value+"##"+
                                                        id[0].value);
                               }
                          }
                      }
                 
                      if( error ){
                          PamiraNotify("error", "Hata", "Stok detayları formunda eksiklikler var.");
                          return; 
                      }

                      var cari_form = "";
                      if( YENI_CARI ) cari_form = "&"+$(UI.CARI_FORM).serialize();

                      console.log($(UI.FORM).serialize()+"&stok_str="+yetkililer_data.join("||")+cari_form);

                      //return;
                      form_submit(UI.FORM, UI.SUBMIT_BTN, $(UI.FORM).serialize()+"&stok_str="+yetkililer_data.join("||")+cari_form, function(res){
                          // form reset
                          if( !DUZENLEME ){
                              UI.FORM.reset();
                              UI.CARI_FORM.reset();
                              YCOUNT = 0;
                              UI.YETKILILER_TBODY.html("");
                              
                          } else {
                              // duzenleme sonrasi refresh yap yetkililer id si alabilmel için
                              //setTimeout(function(){ location.reload() }, 1000);
                          }
                      });
                  });



                  UI.SATIR_EKLE.click(function(){
                      yetkili_row_ekle("",0,0,1,0,"","Adet", "");
                      UI.TUR_INPUT.trigger("change");
                  });

                  $(document).on("click", ".satir_sil", function(){
                       remove_elem( document.getElementById( this.getAttribute("parent") ) );
                  });

                  UI.CARI_INPUT.keyup(function(){
                      YENI_CARI = true;
                      UI.CARI_BAKIYE_LABEL.html("- Veri yok");
                      UI.CARI_ADRES_LABEL.html("- Veri yok");
                  }.debounce(100, false));


                  REQ.AC( UI.CARI_INPUT, PSGLOBAL.AC_COMMON, { tip:"cari" }, function( item ){
                      YENI_CARI = true;
                      cari_detay_download( item );
                  });


                  $(document).on("keyup", ".fiyat", function(){
                      var _this = $(this),
                          parent = $("#yetkili_"+_this.attr("parent")), kdv;

                      if( !resmi ){
                          // gayriresmi 
                          kdv = 0;
                      } else {  
                          kdv = parent.find(".kdv").get(0).value;
                          // resmi
                      }
                      var kdv_dahil_birim_fiyat = kdv_dahil_hesapla( input_convert_try(_this.val()), input_convert_try(kdv) );
                        parent.find(".toplam").get(0).value = (kdv_dahil_birim_fiyat * parseFloat( input_convert_try(parent.find(".miktar").get(0).value) )).toFixed(2);
                      if( _this.hasClass("redborder") ) _this.removeClass("redborder");
                      convert_try_trigger();
                  });
                  $(document).on("change", ".kdv", function(){
                      var _this = $(this),
                          parent = $("#yetkili_"+_this.attr("parent"));

                      // resmi degilse hareket yapmiyoruz kdv degisiminde
                      if( resmi ){
                          var kdv_dahil_birim_fiyat = kdv_dahil_hesapla( input_convert_try(parent.find(".fiyat").get(0).value) , input_convert_try(_this.val()) );
                          parent.find(".toplam").get(0).value = (kdv_dahil_birim_fiyat * parseFloat( input_convert_try(parent.find(".miktar").get(0).value) )).toFixed(2);
                      } 
                      if( _this.hasClass("redborder") ) _this.removeClass("redborder");
                      convert_try_trigger();

                  });
                  $(document).on("keyup", ".toplam", function(){
                      var _this = $(this),
                          parent = $("#yetkili_"+_this.attr("parent")), kdv;
                      if( !resmi ){
                          kdv = 0;
                      } else {
                          kdv = parent.find(".kdv").get(0).value;
                      }
                       var  kdv_dahil_birim_fiyat = parseFloat( input_convert_try(_this.val()) ) / parseFloat( input_convert_try(parent.find(".miktar").get(0).value)),
                            kdv_haric_birim_fiyat = kdv_haric_hesapla( kdv_dahil_birim_fiyat, kdv );
                      parent.find(".fiyat").get(0).value = parseFloat( kdv_haric_birim_fiyat).toFixed(2);
                      if( _this.hasClass("redborder") ) _this.removeClass("redborder");
                      convert_try_trigger();
                  });
                  $(document).on("keyup", ".miktar", function(){
                      var _this = $(this),
                          parent = $("#yetkili_"+_this.attr("parent")), kdv;
                      if( !resmi ){
                          kdv = 0;
                      } else {
                          kdv = parent.find(".kdv").get(0).value;
                      }
                      var kdv_dahil_birim_fiyat = kdv_dahil_hesapla( input_convert_try(parent.find(".fiyat").get(0).value), kdv );
                      parent.find(".toplam").get(0).value = (kdv_dahil_birim_fiyat * parseFloat( input_convert_try(_this.val()) )).toFixed(2);
                      if( _this.hasClass("redborder") ) _this.removeClass("redborder");
                      convert_try_trigger();
                  });


                  $("#sil_btn").click(function(){

                      var c = confirm("Fişi silmek istediğinze emin misiniz?");
                      if( c ){
                          this.disabled = true;
                          REQ.ACTION("", { req:"fatura_sil" }, function(res){
                              if( res.ok ){
                                  PamiraNotify("success", "İşlem Başarılı", res.text );
                                  setTimeout(function(){ location.reload(); }, 1000);
                              } else {
                                  PamiraNotify("error", "Hata", res.text );
                              }
                          });

                      }
                  });


                  $("#duzenlenme_tarihi").datetimepicker(DATETIMEPICKER_DEF_OPTIONS);
                  $("#tahsilat_tarihi").datetimepicker(DATETIMEPICKER_DEF_OPTIONS);

                  UI.FIYAT_GECMISI_TABLE.DataTable();
                  $(document).on("click", ".fiyat_gecmisi", function(){   
                      UI.FIYAT_GECMISI_TABLE.DataTable().clear();
                      var parent = $("#yetkili_"+this.getAttribute("parent"));
                      var stok_karti = parent.find(".kart_"+this.getAttribute("parent")).get(0).value;
                      var cari_unvan = UI.CARI_INPUT.val();
                      var fis_turu = UI.TUR_INPUT.val();
                      if( trim(stok_karti) == "" || trim(cari_unvan) == "" || fis_turu == "0" ){
                          PamiraNotify("error", "Hata", "Fiyat geçmişi için Fatura Türü, Cari ve Stok Karı bilgileri girilmelidir.");
                          return;
                      }
                      REQ.ACTION("", { req:"cari_fiyat_gecmisi", stok_karti: stok_karti, cari_unvan: cari_unvan, fis_turu: fis_turu  }, function(res){
                          if( res.ok == 0 ){
                            PamiraNotify("error", "Hata", "Cari ve Stok Kartı bilgileri girilmedi.");
                          } else{
                            for( var k = 0; k < res.data.length; k++ ){
                               UI.FIYAT_GECMISI_TABLE.DataTable().rows.add([
                                  { 
                                    0: format_currency(res.data[k].fiyat),
                                    1: res.data[k].miktar,
                                    2: res.data[k].fatura_tipi,
                                    3: '%'+res.data[k].kdv,
                                    4: res.data[k].tarih
                                  }
                               ]);
                            }
                            UI.FIYAT_GECMISI_TABLE.DataTable().draw();
                          }
                      });
                  });
              });


           </script>