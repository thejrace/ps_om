            <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <a href="<?php echo URL_CARI_FORM ?>"><button type="button" class="btn btn-md btn-info">+ Cari Ekle</button></a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="cari_table" class="table table-striped table-bordered bulk_action dtable-obarey">
                      <thead>
                        <tr>
                          <th class="tr_cb">#</th>
                          <th>Ünvan</th>
                          <th>Tür</th>
                          <th>İl</th>
                          <th>İlçe</th>
                          <th>Bakiye</th>
                          <th class="tr_cb"></th>
                          <th class="tr_cb"></th>
                          <th class="tr_cb"></th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div> <!--  ROW1 -->

            <div class="modal fade islemler_modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title" id="islemler_modal_title"></h4>
                    </div>
                    <div class="modal-body">
                      
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel tile">
                                  
                                  <div class="x_content" style="text-align:center">
                                    
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
                              </div>
                        </div>
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                    </div>

                  </div>
                </div>
              </div>
            </div>


 
            <script type="text/javascript">



                $(document).ready(function(){

                    var UI = {
                        ISLEMLER_MODAL_TITLE: $("#islemler_modal_title"),
                        MODAL_HREFS: $(".cari-islem-a")

                    };


                    $("#cari_table").DataTable({
                      "pageLength": 50,
                      "lengthMenu": [ 50, 75, 100 ],
                      "columns": [
                        null,
                        null,
                        null,
                        null,
                        null,
                        {
                          render: function ( data, type, row ) {
                            return bakiye_dt_format( data );
                            //return format_currency( data );
                          }
                        },
                        {
                          "data": null,
                          "orderable": false,
                          "defaultContent": '<button type="button" class="btn btn-xs btn-info islemler" data-toggle="modal" data-target=".islemler_modal">İşlemler</button>'
                        },
                        {
                          "data": null,
                          "orderable": false,
                          "defaultContent": '<button type="button" class="btn btn-xs btn-danger incele">İncele</button>'
                        },
                        {
                          "data": null,
                          "orderable": false,
                          "defaultContent": '<button type="button" class="btn btn-xs btn-success duzenle">Düzenle</button>'
                        }
                         
                        
                      ],
                      "processing": true,
                      "serverSide": true,
                      "ajax": $.fn.dataTable.pipeline({
                          url: "",
                          pages: 5
                      })

                    });

                    $(document).on("click", ".islemler", function(){
                        var data = $(this).parent().parent().find("td").get(1).innerText;
                        UI.ISLEMLER_MODAL_TITLE.html( data + " Cari İşlemler");
                        for( var k = 0; k < UI.MODAL_HREFS.length; k++ ){
                            UI.MODAL_HREFS[k].setAttribute("href", UI.MODAL_HREFS[k].getAttribute("url") + data );
                        }

                    });

                    $(document).on("click", ".duzenle", function(){
                        window.open("<?php echo URL_CARI_DUZENLE_FORM ?>"+$(this).parent().parent().find("td").get(0).innerText, "_blank");
                    });

                    $(document).on("click", ".incele", function(){
                        window.open("<?php echo URL_CARI_INCELE ?>"+$(this).parent().parent().find("td").get(0).innerText, "_blank");
                    });


                });

            </script>

