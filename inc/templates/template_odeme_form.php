            <div class="row">
              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>Genel Bilgiler</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" id="odeme_form">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Ödeme Kartı</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control req" placeholder="Kart" id="kart" name="kart">
                        </div>
                      </div>

                      <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Ödeme Tipi</label>
                            <div class="col-md-3 col-sm-9 col-xs-12">
                              <select class="form-control req select_not_zero" name="odeme_tipi" id="odeme_tipi">
                                <option value="Nakit">Nakit</option>
                                <option value="Kredi Kartı">Kredi Kartı</option>
                              </select>
                            </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tutar</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control req numeric" placeholder="Tutar" id="tutar" name="tutar">
                          <span class="label label-info">Fiyat girişlerinde kuruş kısmını nokta ile ayırınız.</span>
                        </div>
                      </div>

                      <input type="hidden" name="req" value="<?php echo $FORM_REQ ?>" />

                    </form>
                    <div class="row" style="text-align: center;">
                      <button type="button" class="btn btn-md btn-success kaydet">Kaydet</button>
                    </div>
                  </div>

                </div>
              </div>  <!--  COL -->
            </div> <!--  ROW1 -->


            <script type="text/javascript"> 

               var UI = {
                  FORM: document.getElementById("odeme_form")
               };
               var DUZENLE_FORM = false;
                $(document).ready(function(){

                     REQ.AC( $("#kart"), PSGLOBAL.AC_COMMON, { tip:"odeme_karti" }, null );

                    $(".kaydet").click(function(){
                        form_submit( UI.FORM, $(this), $(UI.FORM).serialize(), function(){
                          if( !DUZENLE_FORM ) UI.FORM.reset();
                        });
                    });

                });

            </script>

              
           