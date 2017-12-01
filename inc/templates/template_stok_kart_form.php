            <div class="row">
              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>Genel Bilgiler</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" id="stok_kart_form">

                    


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Stok Adı</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control req" placeholder="Stok Adı" name="stok_adi" id="stok_adi"  />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Ürün Grubu</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control req" placeholder="Ürün Grubu" name="urun_grubu" id="urun_grubu" />
                          <span class="label label-info">Kayıtlı olmayan ürün grubu otomatik olarak oluşturulacaktır.</span>
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>

                      

                      <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Alış Fiyatı</label>
                            <div class="col-md-4 col-sm-9 col-xs-12"> 
                              <input type="text" class="form-control numeric posnum" value="0" name="alis_fiyati" id="alis_fiyati" /> 
                            </div>
                            <span class="label label-info">Fiyat girişlerinde kuruş kısmını nokta ile ayırınız.</span>
                      </div>

                      <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Satış Fiyatı</label>
                            <div class="col-md-4 col-sm-9 col-xs-12">
                              <input type="text" class="form-control numeric posnum" value="0" name="satis_fiyati" id="satis_fiyati" />
                            </div>
                      </div>

                      <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">KDV</label>
                            <div class="col-md-3 col-sm-9 col-xs-12">
                              <select class="form-control numeric posnum" name="kdv_orani" id="kdv_orani">
                                <option value="18">%18</option>
                                <option value="8">%8</option>
                                <option value="1">%1</option>
                                <option value="0">%0</option>
                              </select>
                            </div>
                      </div>

                      <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">KDV Dahil</label>
                            <div class="col-md-4 col-sm-9 col-xs-12">
                              <input type="text" class="form-control numeric posnum" value="0" name="kdv_dahil" id="kdv_dahil" />
                            </div>
                      </div>


                      <div class="ln_solid"></div>

                      <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Birim</label>
                            <div class="col-md-3 col-sm-9 col-xs-12">
                              <select class="form-control select_not_zero" name="birim" id="birim">
                                <option value="0">Seçiniz..</option>
                                <option value="Adet">Adet</option>
                                <option value="Kilogram">Kilogram</option>
                                <option value="Litre">Litre</option>
                                <option value="Metreküp">Metreküp</option>
                                <option value="Metrekare">Metrekare</option>
                              </select>
                            </div>
                      </div>
                      <input type="hidden" name="req" value="<?php echo $FORM_REQ ?>" />
                      <input type="hidden" name="item_id" value="<?php echo $ITEM_ID ?>" id="item_id"/>
                        
                    </form>
                  </div>
                </div>
              </div>  <!--  COL -->


            </div> <!--  ROW1 -->

              <div class="row" style="text-align: center;">
              <button type="button" class="btn btn-md btn-success kaydet">Kaydet</button>
            </div>
           
           <script type="text/javascript">
             
                var UI = {
                    FORM: document.getElementById("stok_kart_form"),
                    ITEM_ID: $("#item_id"),
                    KDV_DAHIL_INPUT: $("#kdv_dahil"),
                    SATIS_FIYATI_INPUT: $("#satis_fiyati"),
                    KDV_ORAN_INPUT: $("#kdv_orani")
                };
                var DUZENLE_FORM = false;

                $(document).ready(function(){

                    if( UI.ITEM_ID.val() != "" ){
                        DUZENLE_FORM = true;
                        data_download( UI.ITEM_ID.val(), ["id", "stok_kodu"], "#", null );
                    }

                    $(".kaydet").click(function(){
                        form_submit( UI.FORM, $(this), $(UI.FORM).serialize(), function(){
                          if( !DUZENLE_FORM ) UI.FORM.reset();
                        });
                    });

                    UI.KDV_DAHIL_INPUT.keyup(function(){
                      var val = this.value;
                      if( trim(val) == "" ) return;
                        if( FormValidation.numeric(val) && FormValidation.posnum(val) ){
                            satis_fiyati_hesapla();
                        } else {
                            PNotify.removeAll();
                            PamiraNotify("error", "Hata", "Lütfen geçerli bir fiyat değeri giriniz.");
                        }
                    }.debounce(200, false));

                    UI.SATIS_FIYATI_INPUT.keyup(function(){
                        var val = this.value;
                        if( trim(val) == "" ) return;
                        if( FormValidation.numeric(val) && FormValidation.posnum(val) ){
                            kdv_dahil_fiyati_hesapla();
                        } else {
                            PNotify.removeAll();
                            PamiraNotify("error", "Hata", "Lütfen geçerli bir fiyat değeri giriniz.");
                        }
                    }.debounce(200, false));

                    UI.KDV_ORAN_INPUT.change(function(){
                        kdv_dahil_fiyati_hesapla();
                    });

                    $( "#urun_grubu" ).autocomplete({
                      source: "",
                      minLength: 2
                    });

                });

                function satis_fiyati_hesapla(){
                    UI.SATIS_FIYATI_INPUT.val( parseFloat(parseFloat(UI.KDV_DAHIL_INPUT.val()) / ( (parseFloat(UI.KDV_ORAN_INPUT.val()) / 100 ) + 1 ) ).toFixed(2));
                }

                function kdv_dahil_fiyati_hesapla(){
                    UI.KDV_DAHIL_INPUT.val( parseFloat(parseFloat(UI.SATIS_FIYATI_INPUT.val()) + ( parseFloat(UI.SATIS_FIYATI_INPUT.val()) * parseFloat(UI.KDV_ORAN_INPUT.val()) / 100 )).toFixed(2) );
                }


           </script>