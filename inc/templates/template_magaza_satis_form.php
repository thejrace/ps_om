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

                      <input type="hidden" name="tur" value="2" id="tur" />
                      <input type="hidden" name="cari" value="Mağaza" id="cari" />
                      <input type="hidden" name="req" value="<?php echo $FORM_REQ ?>" />

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fatura No</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control numeric posnum" placeholder="Fatura No" name="fatura_no" id="fatura_no" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Satış Tarihi</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control req" data-inputmask="'mask' : '99-99-9999'" placeholder="Satış Tarihi" name="duzenlenme_tarihi" id="duzenlenme_tarihi" />
                          <span class="label label-info">Satışın yapıldığı tarih.</span>
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
                    <span class="label label-danger">Kayıtlı olmayan stok kartları otomatik oluşturulacaktır.</span>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th class="col-md-2 col-sm-9 col-xs-12">Kart</th>
                          <th class="col-md-1 col-sm-9 col-xs-12">Fiyat</th>

                          <th class="col-md-1 col-sm-9 col-xs-12">Miktar</th>

                          <th class="col-md-1 col-sm-9 col-xs-12">Toplam</th>
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
           

          <script type="text/template" id="yetkili_row">
                <tr id="yetkili_%%YID%%" class="yetkili_row" >
                  <td>
                      <div >
                        <input type="text" class="form-control kart_%%YID%%" placeholder="Kart" parent="%%YID%%"  value="%%KART_VAL%%"  />
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
                    <div class="checkbox">
                        <label>
                          <input type="checkbox" class="flat faturali_cb" parent="%%YID%%"> Faturalı
                        </label>
                      </div>
                  </td>

                  <input type="hidden" value="0" parent="%%YID%%" class="faturali" />
                  <input type="hidden" class="yetkili_id" value="%%ID_VAL%%" parent="%%YID%%" />
                  <input type="hidden" class="kdv" value="%%KDV_VAL%%" parent="%%YID%%" />
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

              function yetkili_row_ekle( kart, fiyat, kdv, miktar, toplam, id ){
                  UI.YETKILILER_TBODY.append(replaceAll(TEMPLATE.YETKILI_SATIR
                      .replace("%%KART_VAL%%", kart)
                      .replace("%%FIYAT_VAL%%", fiyat)
                      .replace("%%KDV_VAL%%", kdv)
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


                  $(document).on("click", ".faturali_cb", function(){
                      var parent = $("#yetkili_"+this.getAttribute("parent")),
                          kdv_item = parent.find(".faturali");
                      if( kdv_item[0].value == "1" ){
                          kdv_item[0].value = "0";
                      } else {
                          kdv_item[0].value = "1";
                      }
                      $(parent.find(".fiyat").get(0)).trigger("keyup");


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
                                  faturali    = temp_row.find(".faturali"),
                                  toplam    = temp_row.find(".toplam"),
                                  id        = temp_row.find(".yetkili_id"),
                                  kart      = temp_row.find(".kart_"+id[0].getAttribute("parent"));


                               if( trim(kart[0].value) == "" ){
                                  addClass(kart[0], "redborder");
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


                               if( !error ){
                                  yetkililer_data.push( kart[0].value+"##"+
                                                        fiyat[0].value+"##"+
                                                        kdv[0].value+"##"+
                                                        miktar[0].value+"##"+
                                                        toplam[0].value+"##"+
                                                        faturali[0].value+"##"+
                                                        id[0].value);
                               }
                          }
                      }
                 
                      /*console.log(yetkililer_data);
                      return;*/

                      if( error ){
                          PamiraNotify("error", "Hata", "Stok detayları formunda eksiklikler var.");
                          return; 
                      }

                      

                      console.log($(UI.FORM).serialize()+"&stok_str="+yetkililer_data.join("||"));

                      //return;
                      form_submit(UI.FORM, UI.SUBMIT_BTN, $(UI.FORM).serialize()+"&stok_str="+yetkililer_data.join("||"), function(res){
                          // form reset
                          if( !DUZENLEME ){
                              UI.FORM.reset();
                              UI.CARI_FORM.reset();
                              YCOUNT = 0;
                              UI.YETKILILER_TBODY.html("");
                              
                          } else {
                              // duzenleme sonrasi refresh yap yetkililer id si alabilmel için
                              setTimeout(function(){ location.reload() }, 1000);
                          }
                      });
                  });



                  UI.SATIR_EKLE.click(function(){
                      yetkili_row_ekle("", 0, 0, 1, 0, "");
                  });

                  $(document).on("click", ".satir_sil", function(){
                       remove_elem( document.getElementById( this.getAttribute("parent") ) );
                  });


                  $(document).on("keyup", ".fiyat", function(){
                      var _this = $(this),
                          parent = $("#yetkili_"+_this.attr("parent")),
                          faturali_kontrol = parent.find(".faturali").get(0).value;

                      if( faturali_kontrol == "1" ){
                          var kdv_dahil_birim_fiyat = kdv_dahil_hesapla( _this.val(), parent.find(".kdv").get(0).value );
                          parent.find(".toplam").get(0).value = (kdv_dahil_birim_fiyat * parseFloat( parent.find(".miktar").get(0).value )).toFixed(2);
                      } else {
                          parent.find(".toplam").get(0).value = ( _this.val() * parseFloat( parent.find(".miktar").get(0).value )).toFixed(2);
                      }
                      if( _this.hasClass("redborder") ) _this.removeClass("redborder");
                  });
                  
                  $(document).on("keyup", ".toplam", function(){
                      var _this = $(this),
                          parent = $("#yetkili_"+_this.attr("parent")),
                          faturali_kontrol = parent.find(".faturali").get(0).value;

                      if( faturali_kontrol == "1" ){
                          var kdv_dahil_birim_fiyat = parseFloat(_this.val()) / parseFloat( parent.find(".miktar").get(0).value),
                              kdv_haric_birim_fiyat = kdv_haric_hesapla( kdv_dahil_birim_fiyat, parent.find(".kdv").get(0).value );
                          parent.find(".fiyat").get(0).value = parseFloat( kdv_haric_birim_fiyat).toFixed(2);
                      } else {
                          parent.find(".fiyat").get(0).value = parseFloat(_this.val()) / parseFloat( parent.find(".miktar").get(0).value).toFixed(2);
                      }
                      if( _this.hasClass("redborder") ) _this.removeClass("redborder");
                  });
                  $(document).on("keyup", ".miktar", function(){
                      var _this = $(this),
                          parent = $("#yetkili_"+_this.attr("parent")),
                          faturali_kontrol = parent.find(".faturali").get(0).value;

                      if( faturali_kontrol == "1" ){
                          var kdv_dahil_birim_fiyat = kdv_dahil_hesapla( parent.find(".fiyat").get(0).value, parent.find(".kdv").get(0).value );
                          parent.find(".toplam").get(0).value = (kdv_dahil_birim_fiyat * parseFloat( _this.val() )).toFixed(2);
                      } else {
                          parent.find(".toplam").get(0).value = ( parseFloat(parent.find(".fiyat").get(0).value) * parseFloat( _this.val() )).toFixed(2);
                      }

                          
                      if( _this.hasClass("redborder") ) _this.removeClass("redborder");
                  });

                  $("#duzenlenme_tarihi").datetimepicker(DATEPICKER_DEF_OPTIONS);


              });


           </script>