            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="text-align:center">
                    <a href="<?php echo URL_FATURA_FORM_ALIS ?>"><button type="button" class="btn btn-md btn-danger">+ Alış Faturası Oluştur</button></a>
                    <a href="<?php echo URL_FATURA_FORM_SATIS ?>"><button type="button" class="btn btn-md btn-success">+ Satış Faturası Oluştur</button></a>
                    <a href="<?php echo URL_SATIS_FISI_FORM ?>"><button type="button" class="btn btn-md btn-info">+ Sipariş Fişi Oluştur</button></a>
                </div>
              </div>
            </div>

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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Fiş Türü</label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="form-control" name="fis_turu" id="fis_turu" />
                                      <option value="0">Seçiniz..</option>
                                      <option value="1">Alış</option>
                                      <option value="2">Satış</option>
                                      <option value="4">Alış Fişi</option>
                                      <option value="5">Satış Fişi</option>
                                    </select>
                                  </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Cari</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <input type="text" class="form-control" placeholder="Cari" name="cari" id="cari" />
                                </div>
                              </div>

                          </div>

                          <div class="col-md-4 col-sm-12 col-xs-12">
                              
                               <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Fiyat Tipi</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                      <select class="form-control" name="fiyat_tipi" id="fiyat_tipi" />
                                        <option value="0">Seçiniz..</option>
                                        <option value="genel_toplam">Genel Toplam</option>
                                        <option value="ara_toplam">Ara Toplam</option>
                                        
                                      </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Fiyat Alt</label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control posnum convert-try" placeholder="Fiyat Alt" name="fiyat_alt" id="fiyat_alt" />
                                  </div>
                                </div>

                                 <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Fiyat Üst</label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control posnum convert-try" placeholder="Fiyat Üst" name="fiyat_ust" id="fiyat_ust" />
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
                  <div class="x_content">
                    <table id="cari_table" class="table table-striped table-bordered bulk_action dtable-obarey">
                      <thead>
                        <tr>
                          <th class="tr_cb">#</th>
                          <th>Cari</th>
                          <th>Açıklama</th>
                          <th>Tür</th>
                          <th>Ara Toplam</th>
                          <th>Genel Toplam</th>
                          <th>Düzenlenme Tarihi</th>
                          <th class="tr_cb">#</th>
                          <th class="tr_cb">#</th>
                          <th class="tr_cb">#</th>
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
                      "searching": false,
                      "pageLength": 50,
                      "lengthMenu": [ 50, 75, 100 ],
                      "columns": [
                        null,
                        { "orderable": false },
                        { "orderable": false },
                        null,
                        { 
                          render: function ( data, type, row ) {
                              return format_currency( data );
                          }},
                        { 
                          render: function ( data, type, row ) {
                              return format_currency( data );
                          }},
                        { "searchable": false },
                        {
                          "data": null,
                          "orderable": false,
                          "defaultContent": '<button type="button" class="btn btn-xs btn-danger tahsil_et" >Tahsil Et</button>'
                        },
                        {
                          "data": null,
                          "orderable": false,
                          "defaultContent": '<button type="button" class="btn btn-xs btn-warning duzenle" >Düzenle</button>'
                        },
                        {
                          "data": null,
                          "orderable": false,
                          "defaultContent": '<button type="button" class="btn btn-xs btn-info detaylar" >İncele</button>'
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

                    var TABLE = $("#cari_table"),
                        ARAMA_FORM = $("#search_form"),
                        TABLE_ARAMA_MOD = false;

                    init_server_side_table( TABLE );

                    $("[dtpicker]").datetimepicker(DATEPICKER_DEF_OPTIONS_NO_PLACEHOLDER);

                    REQ.AC( $("#cari"), PSGLOBAL.AC_COMMON, { tip:"cari" }, null);

                    $("#btn_form_temizle").click(function(){
                        if( TABLE_ARAMA_MOD ){
                            TABLE.DataTable().destroy();
                            init_server_side_table( TABLE );
                            TABLE_ARAMA_MOD = false;
                            ARAMA_FORM.get(0).reset();
                        }
                    });

                    $("#btn_form_arama").click(function(){
                        //console.log(ARAMA_FORM.serialize());
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
                                    { "orderable": false },
                                    { "orderable": false },
                                    null,
                                    { 
                                      render: function ( data, type, row ) {
                                        return format_currency( data );
                                    }},
                                    { 
                                      render: function ( data, type, row ) {
                                        return format_currency( data );
                                    }},
                                    { "searchable": false },
                                    {
                                      "data": null,
                                      "orderable": false,
                                      "defaultContent": '<button type="button" class="btn btn-xs btn-danger tahsil_et" >Makbuz Kes</button>'
                                    },
                                    {
                                      "data": null,
                                      "orderable": false,
                                      "defaultContent": '<button type="button" class="btn btn-xs btn-warning duzenle" >Düzenle</button>'
                                    },
                                    {
                                      "data": null,
                                      "orderable": false,
                                      "defaultContent": '<button type="button" class="btn btn-xs btn-info detaylar" >İncele</button>'
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
              
                    $(document).on("click", ".detaylar", function(){
                        window.open("<?php echo URL_FATURA_INCELE ?>"+$(this).parent().parent().find("td").get(0).innerText, "_blank");
                    });

                    $(document).on("click", ".duzenle", function(){
                        window.open("<?php echo URL_FATURA_DUZENLE ?>"+$(this).parent().parent().find("td").get(0).innerText, "_blank");
                    });

                     $(document).on("click", ".tahsil_et", function(){
                        var tds = $(this).parent().parent().find("td");
                        //console.log(tds);
                        if( tds[3].innerText == "Alış" || tds[3].innerText == "Alış Fişi" ){
                            window.open("<?php echo URL_TAHSILAT_MAKBUZU_ODEME ?>&cari="+tds[1].innerText+"&tutar="+tds[5].innerText.substring(0, tds[5].innerText.length - 2).replace(",", "."), "_blank");
                        } else if( tds[3].innerText == "Satış" || tds[3].innerText == "Satış Fişi" ){
                            window.open("<?php echo URL_TAHSILAT_MAKBUZU_TAHSILAT ?>&cari="+tds[1].innerText+"&tutar="+tds[5].innerText.substring(0, tds[5].innerText.length - 2).replace(",", "."), "_blank");
                        } else {
                            PamiraNotify("error", "Hata", "Fişi önce faturalandırmalısınz.");
                        }
                    });

                });

            </script>

