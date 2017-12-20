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
                          <input type="text" class="form-control req" placeholder="Açıklama" name="aciklama" id="aciklama" value="Mağaza satışı " />
                        </div>
                      </div>

                      <input type="hidden" name="req" value="<?php echo $FORM_REQ ?>" />


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Satış Tarihi</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control req" data-inputmask="'mask' : '99-99-9999'" placeholder="Satış Tarihi" name="tarih" id="tarih" />
                          <span class="label label-info">Satışların yapıldığı tarih.</span>
                        </div>

                      </div>


                  </div>
                </div>
              </div>  <!--  COL -->

             

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
                    
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th class="col-md-2 col-sm-9 col-xs-12">Ürün</th>
                          <th class="col-md-1 col-sm-9 col-xs-12">Birim Fiyat</th>

                          <th class="col-md-1 col-sm-9 col-xs-12">Miktar</th>

                          <th class="col-md-1 col-sm-9 col-xs-12">Toplam</th>
                          <th class="col-md-1 col-sm-9 col-xs-12">Ödeme Tipi</th>
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


           

          <script type="text/template" id="yetkili_row">
                <tr id="yetkili_%%YID%%" class="yetkili_row" >
                  <td>
                      <div >
                        <input type="text" class="form-control kart_%%YID%%" placeholder="Ürün" parent="%%YID%%"  value="%%KART_VAL%%"  />
                      </div>
                  </td>
                  <td>
                       <div >
                        <input type="text" class="form-control fiyat" placeholder="Fiyat" parent="%%YID%%" value="%%FIYAT_VAL%%" />
                      </div>
                  </td>
                  <td>
                     <div >
                        <input type="text" class="form-control miktar" placeholder="Miktar" parent="%%YID%%" value="%%MIKTAR_VAL%%" />
                      </div>
                  </td>
                  <td>
                     <div >
                        <input type="text" class="form-control toplam" placeholder="Toplam" parent="%%YID%%"  value="%%TOPLAM_VAL%%" />
                      </div>
                  </td>

                  <td>
                     <div >
                        <select class="form-control odeme_tipi" parent="%%YID%%">
                            <option value="Nakit">Nakit</option>
                            <option value="Kredi Kartı">Kredi Kartı</option>
                        </select>
                      </div>
                  </td>
                 

                  <input type="hidden" class="yetkili_id" value="%%ID_VAL%%" parent="%%YID%%" />
                  <td style="text-align:right"><button type="button" class="btn btn-sm btn-danger satir_sil" parent="yetkili_%%YID%%" ><i class="fa fa-remove"></i></button></td>
                  
                </tr>
          </script>

           <script type="text/javascript">  

              var DUZENLEME = false;
              var YCOUNT = 0;

              function stok_kart_fiyat_download(item, elem){
                  console.log({ req:"stok_karti_data_download", stok_karti: item, cari: UI.CARI_INPUT.val(), fis_turu:UI.TUR_INPUT.val()  });
                  REQ.ACTION("", { req:"stok_karti_data_download", stok_karti: item, cari: UI.CARI_INPUT.val(), fis_turu:UI.TUR_INPUT.val()  }, function(res){
                      console.log(res);
                      var parent = $("#yetkili_"+elem.attr("parent"));
                      parent.find(".fiyat").get(0).value = res.data.fiyat;
                      parent.find(".kdv").get(0).value = res.data.kdv;
                      $(parent.find(".fiyat").get(0)).trigger("keyup");
                  });
              }

              function yetkili_row_ekle( kart, fiyat, miktar, toplam, id ){
                  UI.YETKILILER_TBODY.append(replaceAll(TEMPLATE.YETKILI_SATIR
                      .replace("%%KART_VAL%%", kart)
                      .replace("%%FIYAT_VAL%%", fiyat)
                      .replace("%%MIKTAR_VAL%%", miktar)
                      .replace("%%TOPLAM_VAL%%", toplam)
                      .replace("%%ID_VAL%%", id), "%%YID%%", YCOUNT));
                  var aktif_row = $("#yetkili_"+YCOUNT);

                  REQ.AC( $(".kart_"+YCOUNT), PSGLOBAL.AC_COMMON, { tip:"stok_karti" }, function( item, elem ){
                      stok_kart_fiyat_download(item, elem);

                  });
                  YCOUNT++;
              }

              var UI = {
                  FORM                : document.getElementById("fatura_form"),
                  CARI_FORM           : document.getElementById("yeni_cari_form"),
                  YETKILILER_TBODY    : $("#yetkililer_tbody"),
                  SATIR_EKLE          : $("#satir_ekle"),
                  SATIR_SIL           : $(".satir_sil"),
                  SUBMIT_BTN          : $("#btn_form_submit"),
                  CARI_ADRES_LABEL    : $("#cari_adres_label"),
                  CARI_BAKIYE_LABEL   : $("#cari_bakiye_label"),
                  CARI_INPUT          : $("#cari"),
                  TUR_INPUT           : $("#tur"),
                  FIYAT_GECMISI_TABLE : $("#fiyat_gecmisi_table"),
                  FIYAT_GECMISI_TBODY : $("#fiyat_gecmisi_tbody")
              };
              var TEMPLATE = {
                  YETKILI_SATIR       : $("#yetkili_row").html()
              };  



              $(document).ready(function(){

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
                                  miktar    = temp_row.find(".miktar"),
                                  toplam    = temp_row.find(".toplam"),
                                  odeme_tipi = temp_row.find(".odeme_tipi"),
                                  id        = temp_row.find(".yetkili_id"),
                                  kart      = temp_row.find(".kart_"+id[0].getAttribute("parent"));


                               if( trim(kart[0].value) == ""  ){
                                  addClass(kart[0], "redborder");
                                  if( !error ) error = true;
                               }
                              
                               if( trim(fiyat[0].value) == "" || !FormValidation.numeric(fiyat[0].value) ){
                                  addClass(miktar[0], "redborder");
                                  if( !error ) error = true;
                               }
                                if( trim(miktar[0].value) == "" || !FormValidation.numeric(miktar[0].value) ){
                                  addClass(miktar[0], "redborder");
                                  if( !error ) error = true;
                               }
                               if( trim(toplam[0].value) == "" || !FormValidation.numeric(toplam[0].value) ){
                                  addClass(toplam[0], "redborder");
                                  if( !error ) error = true;
                               }


                               if( !error ){
                                  yetkililer_data.push( kart[0].value+"##"+
                                                        fiyat[0].value+"##"+
                                                        miktar[0].value+"##"+
                                                        toplam[0].value+"##"+
                                                        odeme_tipi[0].value+"##"+
                                                        id[0].value);
                               }
                          }
                      }
                 
                     /* console.log(yetkililer_data);
                      return;*/

                      if( error ){
                          PamiraNotify("error", "Hata", "Stok detayları formunda eksiklikler var.");
                          return; 
                      }

                    
                      console.log($(UI.FORM).serialize()+"&stok_str="+yetkililer_data.join("||"));

                      //return;
                      form_submit(UI.FORM, UI.SUBMIT_BTN, $(UI.FORM).serialize()+"&stok_str="+yetkililer_data.join("||"), function(res){
                          YCOUNT = 0;
                          UI.YETKILILER_TBODY.html("");
                      });
                  });



                  UI.SATIR_EKLE.click(function(){
                      yetkili_row_ekle("", 0, 1, 0, "");
                  });

                  $(document).on("click", ".satir_sil", function(){
                       remove_elem( document.getElementById( this.getAttribute("parent") ) );
                  });


                  $(document).on("keyup", ".fiyat", function(){
                      var _this = $(this),
                          parent = $("#yetkili_"+_this.attr("parent"));
                      parent.find(".toplam").get(0).value = ( _this.val() * parseFloat( parent.find(".miktar").get(0).value )).toFixed(2);
                      if( _this.hasClass("redborder") ) _this.removeClass("redborder");
                  });
                  
                  $(document).on("keyup", ".toplam", function(){
                      var _this = $(this),
                          parent = $("#yetkili_"+_this.attr("parent"));
                      parent.find(".fiyat").get(0).value = parseFloat(_this.val()) / parseFloat( parent.find(".miktar").get(0).value).toFixed(2);

                      if( _this.hasClass("redborder") ) _this.removeClass("redborder");
                  });
                  $(document).on("keyup", ".miktar", function(){
                      var _this = $(this),
                          parent = $("#yetkili_"+_this.attr("parent"));

                      parent.find(".toplam").get(0).value = ( parseFloat(parent.find(".fiyat").get(0).value) * parseFloat( _this.val() )).toFixed(2);

                          
                      if( _this.hasClass("redborder") ) _this.removeClass("redborder");
                  });

                  $("#tarih").datetimepicker(DATEPICKER_DEF_OPTIONS);


              });


           </script>