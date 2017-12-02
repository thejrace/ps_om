            <div class="row">

            <form class="form-horizontal form-label-left" id="fatura_form" >
              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>Genel Bilgiler</small></h2>
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
                          <select class="form-control not_zero" name="tur" id="tur" />
                            <option value="0">Seçiniz..</option>
                            <option value="1">Alış</option>
                            <option value="2">Satış</option>
                            <option value="3">Satış Fişi</option>
                            <option value="4">Gayriresmi Alış</option>
                            <option value="5">Gayriresmi Satış</option>
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

              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>Tarih Detayları</small></h2>
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

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tahsilat Tarihi</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control req" data-inputmask="'mask' : '99-99-9999 99:99:99'" placeholder="Tahsilat Tarihi" name="tahsilat_tarihi" id="tahsilat_tarihi" />
                        </div>
                      </div>


                      <input type="hidden" name="req" value="<?php echo $FORM_REQ ?>" />
                      <input type="hidden" name="item_id" value="<?php echo $ITEM_ID ?>" id="item_id"/>
                      
                   
                  </div>
                </div>
              </div>  <!--  COL -->

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

              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>Stok Detayları</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Kart</th>
                          <th>Fiyat</th>
                          <th>KDV</th>
                          <th>Miktar <span id="stok_kart_birim_label">( Adet )</span></th>
                          <th>Toplam</th>
                          <th>Yer</th>
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
           

          <script type="text/template" id="yetkili_row">
                <tr id="yetkili_%%YID%%" class="yetkili_row" >
                  <td>
                      <div class="col-md-11 col-sm-9 col-xs-12">
                        <input type="text" class="form-control kart" placeholder="Kart"  value="%%KART_VAL%%"  />
                      </div>
                  </td>
                  <td>
                       <div class="col-md-11 col-sm-9 col-xs-12">
                        <input type="text" class="form-control fiyat" placeholder="Fiyat" value="%%FIYAT_VAL%%" />
                      </div>
                  </td>
                  <td>
                     <div class="col-md-11 col-sm-9 col-xs-12">
                        <input type="text" class="form-control kdv" placeholder="KDV" value="%%KDV_VAL%%" />
                      </div>
                  </td>
                  <td>
                     <div class="col-md-11 col-sm-9 col-xs-12">
                        <input type="text" class="form-control miktar" placeholder="Miktar"  value="%%MIKTAR_VAL%%" />
                      </div>
                  </td>
                  <td>
                     <div class="col-md-11 col-sm-9 col-xs-12">
                        <input type="text" class="form-control toplam" placeholder="Toplam"  value="%%TOPLAM_VAL%%" />
                      </div>
                  </td>
                  <td>
                     <div class="col-md-11 col-sm-9 col-xs-12">
                        <select class="form-control yer" value="%%YER_VAL%%">
                            <?php 

                              foreach( DB::getInstance()->query("SELECT * FROM " . DBT_STOK_YERLERI )->results() as $yer ){
                                echo "<option value=\"".$yer["isim"]."\">".$yer["isim"]."</option>";
                              }

                            ?>
                        </select>
                      </div>
                  </td>


                  <input type="hidden" class="yetkili_id" value="%%ID_VAL%%" />
                  <td><button type="button" class="btn btn-sm btn-danger satir_sil" parent="yetkili_%%YSIL%%" ><i class="fa fa-remove"></button></td>
                </tr>
          </script>

           <script type="text/javascript">  

              var DUZENLEME = false;
              var YCOUNT = 0;
              function yetkili_row_ekle( kart, fiyat, kdv, miktar, toplam, yer, id ){
                  UI.YETKILILER_TBODY.append(TEMPLATE.YETKILI_SATIR
                      .replace("%%YID%%", YCOUNT)
                      .replace("%%YSIL%%", YCOUNT)
                      .replace("%%KART_VAL%%", kart)
                      .replace("%%FIYAT_VAL%%", fiyat)
                      .replace("%%KDV_VAL%%", kdv)
                      .replace("%%MIKTAR_VAL%%", miktar)
                      .replace("%%TOPLAM_VAL%%", toplam)
                      .replace("%%YER_VAL%%", yer)
                      .replace("%%ID_VAL%%", id));

                  var yer_select = $("#yetkili_"+YCOUNT).find(".yer");
                  yer_select[0].value = yer;

                  YCOUNT++;
                  UI.YETKILILER_TBODY.find(":input").inputmask();
                  REQ.AC( $(".kart"), "", { tip:"stok_karti" }, function( item ){

                      REQ.ACTION("", { req:"stok_karti_data_download", stok_karti: item, cari: UI.CARI_INPUT.val(), fis_turu:UI.TUR_INPUT.val()  }, function(res){
                          console.log(res);
                      });

                  });
              }

              var UI = {
                  FORM                : document.getElementById("fatura_form"),
                  YETKILILER_TBODY    : $("#yetkililer_tbody"),
                  SATIR_EKLE          : $("#satir_ekle"),
                  SATIR_SIL           : $(".satir_sil"),
                  SUBMIT_BTN          : $("#btn_form_submit"),
                  ITEM_ID             : $("#item_id"),
                  CARI_ADRES_LABEL    : $("#cari_adres_label"),
                  CARI_BAKIYE_LABEL   : $("#cari_bakiye_label"),
                  CARI_INPUT          : $("#cari"),
                  TUR_INPUT           : $("#tur")
              };
              var TEMPLATE = {
                  YETKILI_SATIR       : $("#yetkili_row").html()
              };  

              var fis_turu = "<?php echo $FORM_SELECT ?>";

              $(document).ready(function(){



                  var item_id = trim(UI.ITEM_ID.val());
                  if( item_id != "" ){
                    data_download( item_id, [ "id", "mali_tur", "eklenme_tarihi", "son_duzenlenme_tarihi" ], "#cari_", function(res){
                        for( var k = 0; k < res.data.yetkililer.length; k++ ) yetkili_row_ekle(res.data.yetkililer[k].isim, res.data.yetkililer[k].eposta, res.data.yetkililer[k].telefon, res.data.yetkililer[k].notlar, res.data.yetkililer[k].id );
                          DUZENLEME = true;
                    });
                  } else {
                      UI.TUR_INPUT.val(fis_turu);
                  }

                  UI.SUBMIT_BTN.click(function(){
                      //UI.SUBMIT_BTN.get(0).disabled = true;
                      var yetkililer_data = [];
                      // yetkilileri ayıkla önce
                      var yrow = $(".yetkili_row"), temp_row;
                      if( yrow.length > 0 ){
                          for( var k = 0; k < yrow.length; k++ ){
                              temp_row = $(yrow[k]);
                              var kart = temp_row.find(".kart");
                              // isim boşsa ipleme o row u
                              if( kart[0].value != "" ){
                                  var fiyat     = temp_row.find(".fiyat"),
                                      kdv       = temp_row.find(".kdv"),
                                      miktar    = temp_row.find(".miktar"),
                                      toplam    = temp_row.find(".toplam"),
                                      yer       = temp_row.find(".yer"),
                                      id        = temp_row.find(".yetkili_id");
                                  yetkililer_data.push( kart[0].value+"##"+
                                                        fiyat[0].value+"##"+
                                                        kdv[0].value+"##"+
                                                        miktar[0].value+"##"+
                                                        toplam[0].value+"##"+
                                                        yer[0].value+"##"+
                                                        id[0].value);
                              }
                          }
                      }
                      console.log($(UI.FORM).serialize()+"&stok_str="+yetkililer_data.join("||"));
                      //return;
                      form_submit(UI.FORM, UI.SUBMIT_BTN, $(UI.FORM).serialize()+"&stok_str="+yetkililer_data.join("||"), function(res){
                          // form reset
                          if( !DUZENLEME ){
                              //UI.FORM.reset();
                              //YCOUNT = 0;
                              //UI.YETKILILER_TBODY.html("");
                              
                          } else {
                              // duzenleme sonrasi refresh yap yetkililer id si alabilmel için
                              setTimeout(function(){ location.reload() }, 1000);
                          }
                      });
                  });

                  UI.SATIR_EKLE.click(function(){
                      yetkili_row_ekle("","","","","","","");
                  });

                  $(document).on("click", ".satir_sil", function(){
                       remove_elem( document.getElementById( this.getAttribute("parent") ) );
                  });

                  REQ.AC( UI.CARI_INPUT, "", { tip:"cari" }, function( item ){
                        REQ.ACTION("", { req:"cari_ozet_download", cari_unvan: item }, function(res){
                            //console.log(res);
                            UI.CARI_BAKIYE_LABEL.html("Carinin <br/> " + bakiye_dt_format(res.data.bakiye) + " <br/> bakiyesi bulunmaktadır.");
                            UI.CARI_ADRES_LABEL.html(res.data.adres);
                        });
                  });



              });


           </script>