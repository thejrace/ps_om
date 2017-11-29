            <div class="row">

            <form class="form-horizontal form-label-left" id="cari_form" >
              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>Genel Bilgiler</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    

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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Ünvan</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control req" placeholder="Ünvan" name="cari_unvan" id="cari_unvan" />
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
                          <textarea class="form-control req" rows="3" placeholder="Açık Adres" name="cari_adres" id="cari_adres" /></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">İl</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control req" placeholder="İl" name="cari_il" id="cari_il" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">İlçe</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control req" placeholder="İlçe" name="cari_ilce" id="cari_ilce" />
                        </div>
                      </div>

                    
                  </div>
                </div>
              </div>  <!--  COL -->

              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>Mali Detaylar</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                   

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
                      <input type="hidden" name="req" value="<?php echo $FORM_REQ ?>" />
                      <input type="hidden" name="cid" value="<?php echo $CID ?>" id="cid_val"/>
                      
                   
                  </div>
                </div>
              </div>  <!--  COL -->

              </form>



            </div> <!--  ROW1 -->


            <div class="row">

              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>Yetkili Kişiler</small></h2>
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
                          <th>İsim</th>
                          <th>Telefon</th>
                          <th>Eposta</th>
                          <th>Not</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody class="table-row-form" id="yetkililer_tbody" ></tbody>
                    </table>
                    <button type="button" class="btn btn-sm btn-info" id="satir_ekle" ><i class="fa fa-plus"></i> Satır Ekle</button>
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
                        <input type="text" class="form-control yetkili_isim" placeholder="İsim"  value="%%ISIM_VAL%%"  />
                      </div>
                  </td>
                  <td>
                       <div class="col-md-11 col-sm-9 col-xs-12">
                        <input type="text" class="form-control yetkili_telefon"  data-inputmask="'mask' : '(999) 999 99 99'" placeholder="Telefon" value="%%TELEFON_VAL%%" />
                      </div>
                  </td>
                  <td>
                     <div class="col-md-11 col-sm-9 col-xs-12">
                        <input type="text" class="form-control yetkili_eposta" placeholder="Eposta" value="%%EPOSTA_VAL%%" />
                      </div>
                  </td>
                  <td>
                     <div class="col-md-11 col-sm-9 col-xs-12">
                        <input type="text" class="form-control yetkili_not" placeholder="Not"  value="%%NOT_VAL%%" />
                      </div>
                  </td>
                  <input type="hidden" class="yetkili_id" value="%%ID_VAL%%" />
                  <td><button type="button" class="btn btn-sm btn-danger satir_sil" parent="yetkili_%%YSIL%%" ><i class="fa fa-remove"></button></td>
                </tr>
          </script>

           <script type="text/javascript">  

              var DUZENLEME = false;
              var YCOUNT = 0;
              function yetkili_row_ekle( isim, eposta, telefon, not, id ){
                  UI.YETKILILER_TBODY.append(TEMPLATE.YETKILI_SATIR.replace("%%YID%%", YCOUNT).replace("%%YSIL%%", YCOUNT).replace("%%ISIM_VAL%%", isim).replace("%%TELEFON_VAL%%", telefon).replace("%%EPOSTA_VAL%%", eposta).replace("%%NOT_VAL%%", not).replace("%%ID_VAL%%", id));
                  YCOUNT++;
                  UI.YETKILILER_TBODY.find(":input").inputmask();
              }

              var UI = {
                  CARI_FORM           : document.getElementById("cari_form"),
                  YETKILILER_TBODY    : $("#yetkililer_tbody"),
                  SATIR_EKLE          : $("#satir_ekle"),
                  SATIR_SIL           : $(".satir_sil"),
                  SUBMIT_BTN          : $("#btn_form_submit"),
                  CID_VAL             : $("#cid_val"),
                  RADIO_GK            : $("[value='Gerçek Kişi']"),
                  RADIO_TK            : $("[value='Tüzel Kişi']")
              };
              var TEMPLATE = {
                  YETKILI_SATIR       : $("#yetkili_row").html()
              };  
            
              $(document).ready(function(){

                  var cid_val = trim(UI.CID_VAL.val());
                  if( cid_val != "" ){
                      PamiraNotify("info", "Yükleniyor", "Cari kaydın verileri alınıyor...");
                      REQ.ACTION("", { req:"cari_data_download", cid:cid_val }, function(res){
                          console.log(res);
                          PNotify.removeAll();
                          if( !res.ok ){
                             PamiraNotify("error", "Hata", res.text );
                             return;
                          }
                          for( var key in res.data.form ){
                              if( key != "id" && key != "mali_tur" || key !="eklenme_tarihi" || key != "son_duzenlenme_tarihi") $("#cari_"+key).val( res.data.form[key] );
                          }
                          for( var k = 0; k < res.data.yetkililer.length; k++ ) yetkili_row_ekle(res.data.yetkililer[k].isim, res.data.yetkililer[k].eposta, res.data.yetkililer[k].telefon, res.data.yetkililer[k].notlar, res.data.yetkililer[k].id );

                          UI.YETKILILER_TBODY.find(":input").inputmask();
                          if( res.data.form.mali_tur == "Gerçek Kişi" ){
                              UI.RADIO_GK.attr("checked", true).parent().addClass("active");
                              UI.RADIO_TK.attr("checked", false).parent().removeClass("active");
                          } else {
                              UI.RADIO_TK.attr("checked", true).parent().addClass("active");
                              UI.RADIO_GK.attr("checked", false).parent().removeClass("active");
                          }
                          DUZENLEME = true;
                      });
                  }

                  UI.SUBMIT_BTN.click(function(){
                      
                      UI.SUBMIT_BTN.get(0).disabled = true;
                      var yetkililer_data = [];
                      // yetkilileri ayıkla önce
                      var yrow = $(".yetkili_row"), temp_row;
                      if( yrow.length > 0 ){
                          for( var k = 0; k < yrow.length; k++ ){
                              temp_row = $(yrow[k]);
                              isim = temp_row.find(".yetkili_isim");
                              // isim boşsa ipleme o row u
                              if( isim[0].value != "" ){
                                  var eposta  = temp_row.find(".yetkili_eposta"),
                                      telefon = temp_row.find(".yetkili_telefon"),
                                      not     = temp_row.find(".yetkili_not"),
                                      id      = temp_row.find(".yetkili_id");
                                  yetkililer_data.push( isim[0].value+"##"+eposta[0].value+"##"+telefon[0].value+"##"+not[0].value+"##"+id[0].value );
                              }
                          }
                      }
                      console.log($(UI.CARI_FORM).serialize()+"&yetkililer_str="+yetkililer_data.join("||"));
                   
                      if( FormValidation.check(UI.CARI_FORM) ){
                          REQ.ACTION("", $(UI.CARI_FORM).serialize()+"&yetkililer_str="+yetkililer_data.join("||"), function(res){
                            console.log(res);
                            if( res.ok ){
                                  PamiraNotify("success", "İşlem Tamamlandı", res.text );
                                  // form reset
                                  if( !DUZENLEME ){
                                      UI.CARI_FORM.reset();
                                      YCOUNT = 0;
                                      UI.YETKILILER_TBODY.html("");
                                      UI.RADIO_TK.attr("checked", true).parent().addClass("active");
                                      UI.RADIO_GK.attr("checked", false).parent().removeClass("active");
                                  } else {
                                      // duzenleme sonrasi refresh yap yetkililer id si alabilmel için
                                      setTimeout(function(){ location.reload() }, 2000);

                                  }

                                  
                            } else {
                                if( Object.size(res.inputret) > 0 ){
                                    // sside form kontrol
                                    PamiraNotify("error", "Hata", FormValidation.error_to_pnotfiy( res.inputret ));

                                } else {
                                    // form ok, baska bisi yanlis olmussa
                                    PamiraNotify("error", "Hata", res.text );
                                }
                                UI.SUBMIT_BTN.get(0).disabled = false;
                            }
                          });
                      } else {
                          PamiraNotify("error", "Hata", "Formda eksiklikler var.");
                          UI.SUBMIT_BTN.get(0).disabled = false;
                      }
                  });

                  UI.SATIR_EKLE.click(function(){
                      yetkili_row_ekle("","","","", "");
                  });

                  $(document).on("click", ".satir_sil", function(){
                       remove_elem( document.getElementById( this.getAttribute("parent") ) );
                  });

              });


           </script>