            
             <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                   <div class="x_title">
                      <h4>Arama</h4>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                        </li>
                        </li>
                      </ul>
                      <div class="clearfix"></div>

                  </div>
                  <div class="x_content" style="display:none">
                      <form class="form-horizontal form-label-left" id="search_form">
                        <div class="row">
                          <div class="col-md-4 col-sm-12 col-xs-12">

                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">İsim</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <input type="text" class="form-control" placeholder="İsim" name="isim" id="isim" />
                                </div>
                              </div>

                          </div>

                          <div class="col-md-4 col-sm-12 col-xs-12">
                              

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Tutar Alt</label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control posnum" placeholder="Tutar Alt" name="tutar_alt" id="tutar_alt" />
                                  </div>
                                </div>

                                 <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Tutar Üst</label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control posnum" placeholder="Tutar Üst" name="tutar_ust" id="tutar_ust" />
                                  </div>
                                </div>

                              

                          </div>

                           <div class="col-md-4 col-sm-12 col-xs-12">

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Tarih Alt</label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Tarih Alt" name="tarih_alt" id="tarih_alt" dtpicker="true" />
                                  </div>
                                </div>

                                 <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Tarih Üst</label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Tarih Üst" name="tarih_ust" id="tarih_ust" dtpicker="true" />
                                  </div>
                                </div>


                          </div>

                      </div>

                      <div class="row" style="text-align: center;">
                        <button type="button" class="btn btn-md btn-success" id="btn_form_arama">Ara</button>
                        <button type="button" class="btn btn-md btn-danger" id="btn_form_temizle">Temizle</button>
                      </div>

                      <input type="hidden" name="obarey_search" value="true" />


                      </form>
                  </div>
                </div>
              </div>
            </div>          
  

            <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <a href="<?php echo URL_ODEME_FORM ?>"><button type="button" class="btn btn-md btn-info">+ Ödeme Ekle</button></a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered bulk_action dtable-obarey">
                      <thead>
                        <tr>
                          <th class="tr_cb">#</th>
                          <th>Açıklama</th>
                          <th>Ödeme Tipi</th>
                          <th>Tutar</th>
                          <th>Tarih</th>
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


 
            <script type="text/javascript">

                function init_server_side_table( TABLE ){

                     TABLE.DataTable({
                      "search": false,
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
                          "defaultContent": '<button type="button" class="btn btn-xs btn-success duzenle">Düzenle</button>'
                        },
                        {
                          "data": null,
                          "orderable": false,
                          "defaultContent": '<button type="button" class="btn btn-xs btn-danger sil">Sil</button>'
                        }
                      ],
                      "processing": true,
                      "serverSide": true,
                      "ajax": $.fn.dataTable.pipeline({
                          url: "",
                          pages: 5
                      })

                    });

                }

                $(document).ready(function(){

                    var TABLE = $("#datatable"),
                         TABLE_ARAMA_MOD = false;

                    init_server_side_table( TABLE );

                    $(document).on("click", ".duzenle", function(){
                        window.location = "<?php echo URL_ODEME_FORM_DUZENLE ?>"+$(this).parent().parent().find("td").get(0).innerText;
                    });

                    $(document).on("click", ".sil", function(){
                        var c = confirm("Ödeme kaydını silmek istediğinize emin misiniz?");
                        if( c ){
                          var tr = $(this).parent().parent();
                          REQ.ACTION("", { req:"odeme_sil", item_id: tr.find("td").get(0).innerText }, function(res){
                              console.log(res);
                              if( res.ok ){
                                  tr.remove();
                                  PamiraNotify("success", "İşlem başarılı.", res.text );
                              }
                          });
                        }
                      
                    });

                     var ARAMA_FORM = $("#search_form");
                     $("#btn_form_arama").click(function(){
                        console.log(ARAMA_FORM.serialize());
                        if( !FormValidation.check(ARAMA_FORM.get(0)) ){
                            PamiraNotify("error", "Hata", "Arama formunda eksiklikler var.");
                            return;
                        }
                        $.ajax({
                          type: "GET",
                          dataType: "json",
                          url: "",
                          data: ARAMA_FORM.serialize(),
                          success: function (res){
                              //console.log(res);
                              TABLE.DataTable().destroy();
                              TABLE.DataTable({
                                  "pageLength": 50,
                                  "lengthMenu": [ 50, 75, 100 ],
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
                                        "defaultContent": '<button type="button" class="btn btn-xs btn-success duzenle">Düzenle</button>'
                                      },
                                      {
                                        "data": null,
                                        "orderable": false,
                                        "defaultContent": '<button type="button" class="btn btn-xs btn-danger sil">Sil</button>'
                                      }
                                  ]
                              });
                              TABLE.DataTable().clear();
                              TABLE.DataTable().rows.add( res );
                              TABLE.DataTable().draw();
                              TABLE_ARAMA_MOD = true;
                          },
                          error: function(data) {
                              console.log("ajax hata");
                          }

                        });

                    });

                    $("#btn_form_temizle").click(function(){
                        if( TABLE_ARAMA_MOD ){
                            TABLE.DataTable().destroy();
                            init_server_side_table( TABLE );
                            TABLE_ARAMA_MOD = false;
                            ARAMA_FORM.get(0).reset();
                        }
                    });

                    REQ.AC( $("#isim"), PSGLOBAL.AC_COMMON, { tip:"odeme_karti" }, null );
                    

                });

            </script>

