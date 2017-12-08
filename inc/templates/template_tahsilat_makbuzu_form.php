<!-- cari detay start -->
<div class="row">
  
</div>
<!-- cari detay end -->


<!-- action buton start -->
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
     <div class="x_panel">
        <div class="x_content" style="text-align:center">
           <button type="button" class="btn btn-md tip_btn" >
              <i class="fa fa-exchange"></i> 
              <h5 style="display:inline-block !important;">Tahsilat Makbuzu</h5>
           </button>
           </span>
        </div>
     </div>
  </div>
</div>
<!-- action buton end -->

 <!-- tahsilat form start -->
<form class="form-horizontal form-label-left" id="tahsilat_makbuzu_form">
     <input type="hidden" name="req" value="tahsilat_makbuzu_kes" />
     <input type="hidden" name="tip" id="makbuz_tip" />

    <div class="row">



         <div class="col-md-3 col-sm-12 col-xs-12 profile_details">
            <div class="well profile_view" style="width:100% !important; text-align:center">
               <div class="col-md-12 col-sm-12  col-xs-12">
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
                  <a href="<?php echo URL_CARI_INCELE . $Cari->get_details("id") ?>" target="_blank"><button type="button" class="btn btn-danger btn-xs" ><i class="fa fa-user"></i> Cariyi İncele</button></a>
               </div>
            </div>
         </div>


        <div class="col-md-9 col-sm-12 col-xs-12"">

            <div class="x_panel">
                <div class="x_title"><h4>Makbuz Detayları</h4><div class="clearfix"></div></div>
                <div class="x_content">

                     <div class="form-group">
                       <label class="control-label col-md-2 col-sm-3 col-xs-12">Tarih</label>
                       <div class="col-md-3 col-sm-9 col-xs-12">
                          <input type="text" class="form-control req" placeholder="Tarih" name="tarih" dtpicker="true" />
                       </div>
                    </div>

                    <div class="ln_solid"></div>

                    <div class="form-group">
                       <label class="control-label col-md-2 col-sm-3 col-xs-12">Peşin</label>
                       <div class="col-md-3 col-sm-9 col-xs-12">
                          <input type="text" class="form-control posnum" placeholder="Peşin Tutar" name="pesin_tutar" id="pesin_tutar" />
                          <span class="label label-info">Fiyat girişlerinde kuruş kısmını nokta ile ayırınız.</span>
                       </div>
                    </div>

                    <div class="ln_solid"></div>

                    <div class="row">

                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <div class="form-group">
                               <label class="control-label col-md-4 col-sm-3 col-xs-12" style="margin-left:36px">Havale</label>
                               <div class="col-md-6 col-sm-9 col-xs-12">
                                  <input type="text" class="form-control posnum" placeholder="Havale Tutar" name="havale_tutar" id="havale_tutar" />
                               </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <div class="form-group">
                               <label class="control-label col-md-2 col-sm-3 col-xs-12">Banka</label>
                               <div class="col-md-6 col-sm-9 col-xs-12">
                                  <select class="form-control" name="havale_banka" id="havale_banka" />
                                     <option value="0">Seçiniz..</option>
                                     <option value="1">Yapı Kredi</option>
                                  </select>
                               </div>
                            </div>
                        </div>
                     </div>

                     <div class="ln_solid"></div>

                     <div class="row">

                        <div class="col-md-5 col-sm-12 col-xs-12">
                             <div class="form-group">
                                 <label class="control-label col-md-4 col-sm-3 col-xs-12" style="margin-left:36px">Kredi Kartı</label>
                                 <div class="col-md-6 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control posnum" placeholder="Kredi Kartı Tutar" name="kredi_karti_tutar" id="kredi_karti_tutar" />
                                 </div>
                              </div>
                        </div>

                        <div class="col-md-5 col-sm-12 col-xs-12">

                            <div class="form-group">
                               <label class="control-label col-md-2 col-sm-3 col-xs-12">Banka</label>
                               <div class="col-md-6 col-sm-9 col-xs-12">
                                  <select class="form-control" name="kredi_karti_banka" id="kredi_karti_banka" />
                                     <option value="0">Seçiniz..</option>
                                     <option value="1">Yapı Kredi</option>
                                  </select>
                               </div>
                            </div>

                        </div>

                     </div>

                    
                     <div class="ln_solid"></div>
                
                     <div class="form-group">
                       <label class="control-label col-md-2 col-sm-3 col-xs-12">Çek</label>
                       <div class="col-md-3 col-sm-9 col-xs-12">
                          <input type="text" class="form-control posnum" placeholder="Çek Tutar" name="cek_tutar" id="cek_tutar" />
                       </div>
                    </div>
                    <div class="form-group">
                       <label class="control-label col-md-2 col-sm-3 col-xs-12">Çek No</label>
                       <div class="col-md-3 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Çek No" name="cek_no" id="cek_no"  />
                       </div>
                    </div>
                    <div class="form-group">
                       <label class="control-label col-md-2 col-sm-3 col-xs-12">Çek Vade</label>
                       <div class="col-md-3 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Çek Vade" name="cek_vade" dtpicker="true" id="cek_vade"  />
                       </div>
                    </div>

                    <div class="row" style="text-align:center"><button type="button" class="btn btn-md kes_btn">Kes</button></div>

                </div>
            </div>
        </div>
    </div> 


</form>
 <!-- tahsilat form end -->



<script type="text/javascript">
   var tip = "<?php echo $TIP ?>",
       bakiye = <?php echo $Cari->get_details("bakiye") ?>,
       pre_tutar = <?php echo $TUTAR ?>;
   
   var UI = {
       FORM: "tahsilat_makbuzu_form",
       TIP_BTN: $(".tip_btn"),
       KES_BTNS: $(".kes_btn"),
       BAKIYE: $(".bakiye-tm"),
       TIP_INPUT: $("#makbuz_tip")
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
      
       if( pre_tutar != 0 ){
             document.getElementById("pesin_tutar").value = pre_tutar;
             document.getElementById("havale_tutar").value = pre_tutar;
             document.getElementById("kredi_karti_tutar").value = pre_tutar;
             document.getElementById("cek_tutar").value = pre_tutar;
       }

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
           UI.TIP_INPUT.val( tip );
       });
   
    
       UI.TIP_INPUT.val( tip );
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
           var _this = $(this);

           UI.KES_BTNS.attr("disabled", true);
           UI.TIP_BTN.attr("disabled", true); 

           var btns = [ UI.KES_BTNS, UI.TIP_BTN ];
           var form_elem = document.getElementById(UI.FORM);
           form_submit(form_elem, btns, $("#"+UI.FORM).serialize(), function(res){
             if( res.ok ){
                 document.getElementById("pesin_tutar").value = "";
                 document.getElementById("havale_tutar").value = "";
                 document.getElementById("havale_banka").value = "0";
                 document.getElementById("kredi_karti_tutar").value = "";
                 document.getElementById("kredi_karti_banka").value = "0";
                 document.getElementById("cek_tutar").value = "";
                 document.getElementById("cek_vade").value = "";
                 document.getElementById("cek_no").value = "";
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