<!-- cari header -->
<div class="row">
   <!-- cari header -->
   <div class="col-md-4 col-sm-3 col-xs-12">
      <div class="x_panel">
         <div class="x_content">
            <h3><?php echo $Cari->get_details("unvan") ?></h3>
            <ul class="list-unstyled user_data">
               <li><i class="fa fa-suitcase user-profile-icon"></i> <?php echo $Cari->get_details("tur") ?>
               </li>
               <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $Cari->get_details("adres") ?>
               </li>
               <li>
                  <i class="fa fa-map-marker user-profile-icon"></i> <?php echo $Cari->get_details("ilce") ?> / <?php echo $Cari->get_details("il") ?>
               </li>
               <li class="m-top-xs">
                  <i class="fa fa-phone user-profile-icon"></i> <?php echo $Cari->get_details("telefon_1") ?>
               </li>
            </ul>
            <a class="btn btn-success" href="<?php echo URL_CARI_DUZENLE_FORM . $Cari->get_details("id") ?>" target="_blank"><i class="fa fa-edit m-right-xs"></i> Düzenle</a>
            <br />
         </div>
      </div>
   </div>
   <div class="col-md-3 col-sm-3 col-xs-12">
      <div class="x_panel">
         <div class="x_content">
            <h3>Bakiye</h3>
            <div class="bakiye-tm" style="padding:5px 0; text-align:center"></div>
         </div>
      </div>
   </div>
   <div class="col-md-5 col-sm-3 col-xs-12">
      <div class="x_panel">
         <div class="x_content">
            <h3>Grafik</h3>
         </div>
      </div>
   </div>
</div> 
 <!-- cari header -->

 <!-- butonlar -->
<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center;">
      <a class="btn btn-app cari-islem-a" href="<?php echo URL_FATURA_FORM_ALIS ?>&cari=<?php echo $Cari->get_details("unvan") ?>" target="_blank">
      <i class="fa fa-plus"></i> Yeni Alış 
      </a>
      <a class="btn btn-app cari-islem-a" href="<?php echo URL_FATURA_FORM_SATIS ?>&cari=<?php echo $Cari->get_details("unvan") ?>"  target="_blank">
      <i class="fa fa-minus"></i> Yeni Satış 
      </a>
      <a class="btn btn-app cari-islem-a" href="<?php echo URL_SATIS_FISI_FORM ?>&cari=<?php echo $Cari->get_details("unvan") ?>" target="_blank">
      <i class="fa fa-building-o"></i> Yeni Sipariş Fişi
      </a>
      <a class="btn btn-app cari-islem-a" href="<?php echo URL_TAHSILAT_MAKBUZU_TAHSILAT ?>&cari=<?php echo $Cari->get_details("unvan") ?>"  target="_blank">
      <i class="fa fa-arrow-left"></i> Tahsilat Yap 
      </a>
      <a class="btn btn-app cari-islem-a" href="<?php echo URL_TAHSILAT_MAKBUZU_ODEME ?>&cari=<?php echo $Cari->get_details("unvan") ?>"  target="_blank">
      <i class="fa fa-arrow-right"></i> Ödeme Yap 
      </a>
   </div>
</div>
<!-- butonlar -->


<div class="row">


      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title"><h4>Faturalar</h4><div class="clearfix"></div></div>     
              <div class="x_content">
                  <table id="cari_fatura_table" class="table table-striped table-bordered bulk_action dtable-obarey">
                       <thead>
                          <tr>
                             <th class="tr_cb">#</th>
                             <th>Açıklama</th>
                             <th>Tür</th>
                             <th>Ara Toplam</th>
                             <th>Genel Toplam</th>
                             <th>Düzenlenme Tarihi</th>
                             <th class="tr_cb"></th>
                          </tr>
                       </thead>
                       <tbody>
                       </tbody>
                    </table>
              </div>
          </div>
      </div>

      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title"><h4>Makbuzlar</h4><div class="clearfix"></div></div>
              <div class="x_content">
                  <table id="cari_tahsilat_table" class="table table-striped table-bordered bulk_action dtable-obarey">
                     <thead>
                        <tr>
                           <th class="tr_cb">#</th>
                           <th>Tip</th>
                           <th>Tahsilat Tipi</th>
                           <th>Tutar</th>
                           <th>Tarih</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
              </div>
          </div>
      </div>

</div>

<script type="text/javascript">
   $(document).ready(function(){

       var bakiye = <?php echo $Cari->get_details("bakiye") ?>,
           bakiye_elem = $(".bakiye-tm");

       bakiye_elem.html( bakiye_dt_format(bakiye));
       if( bakiye < 0 ){
          bakiye_elem.addClass("negatif");
       } else if( bakiye > 0 ){
          bakiye_elem.addClass("pozitif");
       } else {
          bakiye_elem.addClass("sifir");
       }
   
       $("#cari_tahsilat_table").DataTable({
         "pageLength": 50,
         "lengthMenu": [ 50, 75, 100 ],
         "searching": false,
         rowCallback: function( row, data, index ){
             format_fatura_row( data[1], row );
         },
         "columns": [
           null,
           null,
           null,
           {
             render: function ( data, type, row ) {      
                 return format_currency( data );
             }
           },
           null
         ],
         "processing": true,
         "serverSide": true,
         "ajax": $.fn.dataTable.pipeline({
             url: window.location.href+"&dt_download=true&dt_id=makbuzlar",
             pages: 5
         })
       });
       $("#cari_fatura_table").DataTable({
         "pageLength": 50,
         "lengthMenu": [ 50, 75, 100 ],
         "searching": false,
         rowCallback: function( row, data, index ){
             format_fatura_row( data[2], row );
         },
         "columns": [
           null,
           null,
           null,
           {
             render: function ( data, type, row ) {      
               return format_currency( data );
             }
           },
           {
             render: function ( data, type, row ) {      
               return format_currency( data );
             }
           },
           null,
           {
             "data": null,
             "orderable": false,
             "searchable": false,
             "defaultContent": '<button type="button" class="btn btn-xs btn-danger f_incele">İncele</button>'
           }
         ],
         "processing": true,
         "serverSide": true,
         "ajax": $.fn.dataTable.pipeline({
             url: window.location.href+"&dt_download=true&dt_id=faturalar",
             pages: 5
         })
       });

        $(document).on("click", ".f_incele", function(){
            window.open("<?php echo URL_FATURA_INCELE ?>"+$(this).parent().parent().find("td").get(0).innerText, "_blank");
        });
   
   });
   
</script>