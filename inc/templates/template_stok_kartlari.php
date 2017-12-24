            <div class="row">
                
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <a href="<?php echo URL_STOK_KART_FORM ?>"><button type="button" class="btn btn-md btn-info">+ Stok Kartı Ekle</button></a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered bulk_action dtable-obarey">
                      <thead>
                        <tr>
                          
                          <th class="tr_cb">#</th>
                          <th>Stok Adı</th>
                          <th>Ürün Grup</th>

                          <th>Satış Fiyatı</th>
                          <th>KDV Dahil</th>
                          
                          <th>Stok</th>
                          <th>Birim</th>
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



            <div class="modal fade stok_detay_modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title" id="stok_detay_modal_title"></h4>
                    </div>
                    <div class="modal-body">
                      
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel tile">
                                  
                                  <div class="x_content tile_count" id="stok_detay_modal_content">
                                    
                                      <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
                                        <span class="count_top"><i class="fa fa-cubes"></i> Mağaza</span>
                                        <div class="count">0</div>
                                        
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
                                        <span class="count_top"><i class="fa fa-cubes"></i> Depo</span>
                                        <div class="count">0</div>
                                        
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
                                        <span class="count_top"><i class="fa fa-cubes"></i> Beykoz</span>
                                        <div class="count green">0</div>
                                        
                                      </div>


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

                var UI = {

                    STOK_MODAL_TITLE: $("#stok_detay_modal_title"),
                    STOK_MODAL_CONTENT : $("#stok_detay_modal_content")
                };
                $(document).ready(function(){ 

                    $("#datatable").DataTable({
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
                        null,
                        {
                          "data": null,
                          "orderable": false,
                          "defaultContent": '<button type="button" class="btn btn-xs btn-info stok_detaylari_btn" data-toggle="modal" data-target=".stok_detay_modal">Stok Detayları</button>'
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


                    $(document).on("click", ".stok_detaylari_btn", function(){
                        var tds = $(this).parent().parent().find("td");
                        REQ.ACTION("", { stok_karti: tds.get(0).innerText, req: "stok_karti_stok_detay_download" }, function(res){
                            console.log(res);
                            var html = "";
                            for( var k = 0; k < res.data.length; k++ ){
                              html += '<div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">'+
                                          '<span class="count_top"><i class="fa fa-cubes"></i> '+res.data[k].yer+'</span>';
                                if( res.data[k].miktar > 0 ){
                                    html += '<div class="count green">'+res.data[k].miktar+'<small style="font-size:12px">'+res.data[k].birim+'</small></div></div>';
                                } else {
                                    html += '<div class="count red">'+res.data[k].miktar+'<small style="font-size:12px">'+res.data[k].birim+'</small></div></div>';
                                }
                            }
                            UI.STOK_MODAL_TITLE.html( tds.get(1).innerText + " Stok Detayları");
                            UI.STOK_MODAL_CONTENT.html( html );
                        });
                        
                    });


                    $(document).on("click", ".duzenle", function(){
                        window.location = "<?php echo URL_STOK_KART_FORM_DUZENLE ?>"+$(this).parent().parent().find("td").get(0).innerText;
                    });

  

                });

            </script>

