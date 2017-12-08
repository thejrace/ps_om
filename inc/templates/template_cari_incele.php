  

  <div class="row"> <!-- cari header -->

    
        <div class="col-md-4 col-sm-3 col-xs-12">

          <div class="x_panel">
            <div class="x_content">

                <h3>3AAA Organizasyon</h3>

                <ul class="list-unstyled user_data">
                <li><i class="fa fa-suitcase user-profile-icon"></i> Alıcı - Satıcı
                  </li>

                  <li><i class="fa fa-map-marker user-profile-icon"></i> Berk Çıkmazı No:16 İncirköy
                  </li>

                  <li>
                    <i class="fa fa-map-marker user-profile-icon"></i> Beykoz / İstanbul
                  </li>

                  <li class="m-top-xs">
                    <i class="fa fa-phone user-profile-icon"></i> 0543 239 02 69
                  </li>
                </ul>

                <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i> Düzenle</a>
                <br />
       
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-12">

          <div class="x_panel">
            <div class="x_content">
                                                   
              <h3>Bakiye</h3>
              <div class="bakiye-tm pozitif" style="padding:5px 0; text-align:center"> 357,00 <span class="simge-tl">&#8378;</span></div>

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
  </div> <!-- cari header -->

  <div class="row"> <!-- butonlar -->

         <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center;">
            <a class="btn btn-app cari-islem-a" url="<?php echo URL_FATURA_FORM_ALIS ?>&cari=" href="" target="_blank">
                <i class="fa fa-plus"></i> Yeni Alış 
            </a>
             <a class="btn btn-app cari-islem-a" url="<?php echo URL_FATURA_FORM_SATIS ?>&cari=" href="" target="_blank">
                  <i class="fa fa-minus"></i> Yeni Satış 
              </a>

              <a class="btn btn-app cari-islem-a" url="<?php echo URL_SATIS_FISI_FORM ?>&cari=" href="" target="_blank">
                  <i class="fa fa-building-o"></i> Yeni Sipariş Fişi
              </a>

              <a class="btn btn-app cari-islem-a" url="<?php echo URL_TAHSILAT_MAKBUZU_TAHSILAT ?>&cari=" href="" target="_blank">
                  <i class="fa fa-arrow-left"></i> Tahsilat Yap 
              </a>

              <a class="btn btn-app cari-islem-a" url="<?php echo URL_TAHSILAT_MAKBUZU_ODEME ?>&cari=" href="" target="_blank">
                  <i class="fa fa-arrow-right"></i> Ödeme Yap 
              </a>
          </div>


   </div> <!-- butonlar -->



      <div class="row"> <!-- tablar -->
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            
            <div class="x_content">


            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Faturalar / Fişler</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Makbuzlar</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">

                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">


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
                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                    <table id="cari_tahsilat_table" class="table table-striped table-bordered bulk_action dtable-obarey">
                      <thead>
                        <tr>
                          <th class="tr_cb">#</th>
                          <th>Tip</th>
                          <th>Tahsilat Tipi</th>
                          <th>Tutar</th>
                          <th>Tarih</th>
                          <th class="tr_cb"></th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>


                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

      <script type="text/javascript">

          $(document).ready(function(){

              $("#cari_tahsilat_table").DataTable({
                "pageLength": 50,
                "lengthMenu": [ 50, 75, 100 ],
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
                  null,
                  {
                    "data": null,
                    "orderable": false,
                    "searchable": false,
                    "defaultContent": '<button type="button" class="btn btn-xs btn-danger t_incele">İncele</button>'
                  }
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

          });

      </script>