           

            
            <div class="row">

               <div class="col-md-12 col-sm-12 col-xs-12 profile_details">
                <div class="well profile_view" style="width:100% !important; text-align:center">
                  <div class="col-md-12 col-sm-12  col-xs-12-12">
                    <h4 class="brief"><i>Cari</i></h4>
                    <div class="left col-md-12 col-sm-12  col-xs-12">
                      <h3><?php echo $Cari->get_details("unvan") ?></h3>
                      <ul class="list-unstyled">
                        <li><i class="fa fa-building"></i> <?php echo $Cari->get_details("adres") . " " . $Cari->get_details("ilce") . " / " . $Cari->get_details("il") ?></li>
                        <li><i class="fa fa-phone"></i> <?php echo $Cari->get_details("telefon_1") ?></li>
                        <li><i class="fa fa-phone"></i> <?php echo $Cari->get_details("telefon_2") ?></li>
                        <li><i class="fa fa-info"></i> <?php echo $Cari->get_details("eposta") ?></li>
                      </ul>
                    </div>
                   
                  </div>
                  <div class="col-xs-12 bottom text-center bakiye-tm">
                      
                      

                  </div>
                  <div class="col-xs-12 bottom text-center">
                      <a href="" target="_blank"><button type="button" class="btn btn-danger btn-xs" ><i class="fa fa-user"></i> Cariyi İncele</button></a>
                  </div>

                </div>
              </div>

            </div>


            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title" style="text-align:center">
              
                      <button type="button" class="btn btn-md tip_btn" ><i class="fa fa-exchange"></i> <h5 style="display:inline-block !important;">Tahsilat Makbuzu</h5></button>
                    <div class="clearfix"></div></span>
                  </div>
                  <div class="x_content">

                    <div class="col-xs-3">
                      <ul class="nav nav-tabs tabs-left">
                        <li class="active"><a href="#pesin" data-toggle="tab">Peşin</a>
                        </li>
                        <li><a href="#havale" data-toggle="tab">Havale</a>
                        </li>
                        <li><a href="#kredi_karti" data-toggle="tab">Kredi Kartı</a>
                        </li>
                        <li><a href="#cek" data-toggle="tab">Çek</a>
                        </li>
                      </ul>
                    </div>

                    <div class="col-xs-9">
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div class="tab-pane active" id="pesin">
                            <p class="lead">Peşin Makbuz</p>
                            <form class="form-horizontal form-label-left" id="tm_pesin_form">
                              <div class="row">
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Tutar</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control req posnum" placeholder="Tutar" name="tutar" />
                                        <span class="label label-info">Fiyat girişlerinde kuruş kısmını nokta ile ayırınız.</span>
                                      </div>

                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Tarih</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control req" placeholder="Tarih" name="tarih" dtpicker="true" />
                                      </div>
                                    </div>

                                    <div class="row" style="text-align: center;">
                                      <button type="button" class="btn btn-md kes_btn" form="#tm_pesin_form">Kes</button>
                                    </div>

                                    <input type="hidden" name="tahsilat_tipi" value="Peşin" />
                                    <input type="hidden" name="req" value="tahsilat_makbuzu_kes" />

                                  </div>
                              </div>  
                            </form>
                        </div>
                        <div class="tab-pane" id="havale">
                            <p class="lead">Havale Makbuzu</p>
                            <form class="form-horizontal form-label-left" id="tm_havale_form">
                              <div class="row">
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Tutar</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control req posnum" placeholder="Tutar" name="tutar" />
                                        <span class="label label-info">Fiyat girişlerinde kuruş kısmını nokta ile ayırınız.</span>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Tarih</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control req" placeholder="Tarih" name="tarih" dtpicker="true" />
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Banka</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                       <select class="form-control not_zero" name="havale_banka" />
                                          <option value="0">Seçiniz..</option>
                                        </select>
                                      </div>
                                    </div>

                                    <div class="row" style="text-align: center;">
                                      <button type="button" class="btn btn-md kes_btn" form="#tm_havale_form">Kes</button>
                                    </div>

                                    <input type="hidden" name="tahsilat_tipi" value="Havale" />
                                    <input type="hidden" name="req" value="tahsilat_makbuzu_kes" />

                                  </div>
                              </div>  
                            </form>
                        </div>
                        <div class="tab-pane" id="kredi_karti">
                            <p class="lead">Kredi Kartı Makbuzu</p>
                            <form class="form-horizontal form-label-left" id="tm_kredi_karti_form">
                              <div class="row">
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Tutar</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control req posnum" placeholder="Tutar" name="tutar" />
                                        <span class="label label-info">Fiyat girişlerinde kuruş kısmını nokta ile ayırınız.</span>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Tarih</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control req" placeholder="Tarih" name="tarih" dtpicker="true" />
                                      </div>
                                    </div>

                                    <div class="row" style="text-align: center;">
                                      <button type="button" class="btn btn-md kes_btn" form="#tm_kredi_karti_form">Kes</button>
                                    </div>

                                    <input type="hidden" name="tahsilat_tipi" value="Kredi Kartı" />
                                    <input type="hidden" name="req" value="tahsilat_makbuzu_kes" />

                                  </div>
                              </div>  
                            </form>
                        </div>
                        <div class="tab-pane" id="cek">
                            <p class="lead">Çek Makbuzu</p>
                            <form class="form-horizontal form-label-left" id="tm_cek_form">
                              <div class="row">
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Tutar</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control req posnum" placeholder="Tutar" name="tutar" />
                                        <span class="label label-info">Fiyat girişlerinde kuruş kısmını nokta ile ayırınız.</span>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Tarih</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control req" placeholder="Tarih" name="tarih" dtpicker="true" />
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Çek No</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control req" placeholder="Çek No" name="cek_no" />
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Çek Vade</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control req" placeholder="Çek Vade" name="cek_vade" dtpicker="true" />
                                      </div>
                                    </div>

                                    <div class="row" style="text-align: center;">
                                      <button type="button" class="btn btn-md kes_btn" form="#tm_cek_form">Kes</button>
                                    </div>

                                    <input type="hidden" name="tahsilat_tipi" value="Çek" />
                                    <input type="hidden" name="req" value="tahsilat_makbuzu_kes" />

                                  </div>
                              </div>  
                            </form>
                        </div>
                        
                      </div>
                    </div>

                    <div class="clearfix"></div>

                  </div>
                </div>
              </div>

            </div>

           <script type="text/javascript">

                var tip = "<?php echo $TIP ?>",
                    bakiye = <?php echo $Cari->get_details("bakiye") ?>;
             
                var UI = {
                    TIP_BTN: $(".tip_btn"),
                    KES_BTNS: $(".kes_btn"),
                    BAKIYE: $(".bakiye-tm")
                };
                
                function bakiye_guncelle(){
                    if( bakiye > 0 ){
                        UI.BAKIYE.removeClass("negatif").removeClass("sifir").addClass("pozitif").html( format_currency( bakiye) );
                    } else if( bakiye < 0 ){
                        UI.BAKIYE.removeClass("pozitif").removeClass("sifir").addClass("negatif").html( format_currency( bakiye) );
                    } else {
                        UI.BAKIYE.removeClass("sifir").removeClass("pozitif").addClass("negatif").html( format_currency( bakiye) );
                    }
                }

                $(document).ready(function(){

                    $("[dtpicker]").datetimepicker(DATEPICKER_DEF_OPTIONS);

                    bakiye_guncelle();

                    UI.TIP_BTN.click(function(){
                        var _this = $(this);

                        if( _this.hasClass("btn-danger") ){
                            _this.removeClass("btn-danger");
                            _this.addClass("btn-success");
                            _this.find("h5").get(0).innerHTML = "Tahsilat Makbuzu";
                            UI.KES_BTNS.removeClass("btn-danger").addClass("btn-success");
                            tip = 1;
                        } else {
                            _this.removeClass("btn-success");
                            _this.addClass("btn-danger");
                            _this.find("h5").get(0).innerHTML = "Ödeme Makbuzu";
                            UI.KES_BTNS.removeClass("btn-success").addClass("btn-danger");
                            tip = 2;
                        }
                    });


                    if( tip == "1" ){
                        UI.TIP_BTN.addClass("btn-success");
                        UI.KES_BTNS.addClass("btn-success");
                        UI.TIP_BTN.find("h5").get(0).innerHTML = "Tahsilat Makbuzu";
                    } else {
                        UI.TIP_BTN.addClass("btn-danger");
                        UI.KES_BTNS.addClass("btn-danger");
                        UI.TIP_BTN.find("h5").get(0).innerHTML = "Ödeme Makbuzu";
                    }

                    UI.KES_BTNS.click(function(){
                        var _this = $(this),
                            form = $(_this.attr("form"));

                        console.log(form.serialize()+"&tip="+tip);

                        UI.KES_BTNS.attr("disabled", true);
                        UI.TIP_BTN.attr("disabled", true);

                        var btns = [ UI.TIP_BTN ];
                        for( var k = 0; k < UI.KES_BTNS.length; k++ ) btns.push( $(UI.KES_BTNS[k]) );


                        form_submit(document.getElementById(_this.attr("form").substring(1)), btns, form.serialize()+"&tip="+tip, function(res){
                          if( res.ok ){
                              form.get(0).reset();
                              // bakiye update
                              bakiye = res.data;
                              bakiye_guncelle();
                          }

                          UI.KES_BTNS.attr("disabled", false);
                          UI.TIP_BTN.attr("disabled", false);
                      });

                   

                    });



                });


           </script>