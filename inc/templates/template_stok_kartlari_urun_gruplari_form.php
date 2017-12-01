            <div class="row">
              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>Genel Bilgiler</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" id="urun_grup_form">

                    


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">İsim</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control req" placeholder="İsim" id="urun_grubu_isim" name="isim">
                        </div>
                      </div>
                      <input type="hidden" name="req" value="<?php echo $FORM_REQ ?>" />
                      <input type="hidden" id="item_id" name="item_id" value="<?php echo $ITEM_ID ?>" />
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
                  FORM: document.getElementById("urun_grup_form"),
                  ITEM_ID: $("#item_id")
               };
               var DUZENLE_FORM = false;
                $(document).ready(function(){

                    if( UI.ITEM_ID.val() != "" ){
                        DUZENLE_FORM = true;
                        data_download( UI.ITEM_ID.val(), ["id", "kod"], "#urun_grubu_", null );
                    }

                    $(".kaydet").click(function(){
                        form_submit( UI.FORM, $(this), $(UI.FORM).serialize(), function(){
                          if( !DUZENLE_FORM ) UI.FORM.reset();
                        });
                    });

                });

            </script>

              
           