            <div class="row">

            <form class="form-horizontal form-label-left" id="hareket_form" >
              <div class="col-md-6  col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>Genel Bilgiler<small></small></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                      
                      <?php  if( $TIP_REQ == "Çıkış"){ ?>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fiş No</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Fiş No" name="fis_no" id="fis_no"  />
                        </div>
                      </div>

                      <?php } ?>

                      <input type="hidden" name="req" value="<?php echo $FORM_REQ ?>" />
                      <input type="hidden" name="tip" value="<?php echo $TIP_REQ ?>" />
                      <input type="hidden" name="item_id" value="<?php echo $ITEM_ID ?>" />

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tarih</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control req"  placeholder="Tarih" name="tarih" id="tarih" />
                          <span class="label label-info">Hareket tarihi.</span>
                        </div>

                      </div>


                  </div>
                </div>
              </div>  <!--  COL -->


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
                          <th class="col-md-1 col-sm-9 col-xs-12">Miktar</th>
                          <th class="col-md-1 col-sm-9 col-xs-12">Yer</th>
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
                        <input type="text" class="form-control miktar" placeholder="Miktar" parent="%%YID%%" value="%%MIKTAR_VAL%%" />
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
                  <td style="text-align:right"><button type="button" class="btn btn-sm btn-danger satir_sil" parent="yetkili_%%YID%%" ><i class="fa fa-remove"></i></button></td>
                  
                </tr>
          </script>

           <script type="text/javascript">  

              var DUZENLEME = false;
              var YCOUNT = 0;
              var ITEM_ID = "<?php echo $ITEM_ID ?>";



              function yetkili_row_ekle( kart, miktar, yer, id ){
                  UI.YETKILILER_TBODY.append(replaceAll(TEMPLATE.YETKILI_SATIR
                      .replace("%%KART_VAL%%", kart)
                      .replace("%%MIKTAR_VAL%%", miktar)
                      .replace("%%YER_VAL%%", yer)
                      .replace("%%ID_VAL%%", id), "%%YID%%", YCOUNT));
                  
                  var aktif_row = $("#yetkili_"+YCOUNT);
                  REQ.AC( $(".kart_"+YCOUNT), PSGLOBAL.AC_COMMON, { tip:"stok_karti" });
                  YCOUNT++;
              }

              var UI = {
                  FORM                : document.getElementById("hareket_form"),
                  YETKILILER_TBODY    : $("#yetkililer_tbody"),
                  SATIR_EKLE          : $("#satir_ekle"),
                  SATIR_SIL           : $(".satir_sil"),
                  SUBMIT_BTN          : $("#btn_form_submit")
              };
              var TEMPLATE = {
                  YETKILI_SATIR       : $("#yetkili_row").html()
              };  


              $(document).ready(function(){

                  if( ITEM_ID != "" ){
                    data_download( ITEM_ID, [ "id", "tip", "user", "eklenme_tarihi", "durum" ], "#", function(res){
                        var item;
                        for( var k = 0; k < res.data.urunler.length; k++ ){
                          item = res.data.urunler[k];
                          yetkili_row_ekle( item.stok_adi, item.miktar, item.yer, item.id );
                        }
                        DUZENLEME = true;

                    });
                  } else {
                      $("#sil_btn").remove();
                  }

                  UI.SUBMIT_BTN.click(function(){
                      //UI.SUBMIT_BTN.get(0).disabled = true;
                      var yetkililer_data = [];
                      // yetkilileri ayıkla önce
                      var yrow = $(".yetkili_row"), temp_row;
                      if( yrow.length > 0 ){
                          var error = false;
                          for( var k = 0; k < yrow.length; k++ ){
                              temp_row = $(yrow[k]);
                              
                              var miktar    = temp_row.find(".miktar"),
                                  yer       = temp_row.find(".yer"),
                                  id        = temp_row.find(".yetkili_id"),
                                  kart      = temp_row.find(".kart_"+id[0].getAttribute("parent"));


                               if( trim(kart[0].value) == ""  ){
                                  addClass(kart[0], "redborder");
                                  if( !error ) error = true;
                               }
                              
                                if( trim(miktar[0].value) == "" || !FormValidation.numeric(miktar[0].value) ){
                                  addClass(miktar[0], "redborder");
                                  if( !error ) error = true;
                               }

                               if( !error ){
                                  yetkililer_data.push( kart[0].value+"##"+
                                                        miktar[0].value+"##"+
                                                        yer[0].value+"##"+
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
                           if( !DUZENLEME ){
                                YCOUNT = 0;
                                UI.YETKILILER_TBODY.html("");
                                UI.FORM.reset();
                          } else {
                              //setTimeout(function(){ location.reload(); });
                          }
                         
                      });
                  });



                  UI.SATIR_EKLE.click(function(){
                      yetkili_row_ekle("", 0, "Depo", "");
                  });

                  $(document).on("click", ".satir_sil", function(){
                       remove_elem( document.getElementById( this.getAttribute("parent") ) );
                  });

                  $("#sil_btn").click(function(){

                      var c = confirm("Hareketi silmek istediğinze emin misiniz?");
                      if( c ){
                          this.disabled = true;
                          REQ.ACTION("", { req:"stok_hareketi_sil" }, function(res){
                              if( res.ok ){
                                  PamiraNotify("success", "İşlem Başarılı", res.text );
                                  setTimeout(function(){ location.reload(); }, 1000);
                              } else {
                                  PamiraNotify("error", "Hata", res.text );
                              }
                          });

                      }
                  });


                  $("#tarih").datetimepicker(DATEPICKER_DEF_OPTIONS);


              });


           </script>