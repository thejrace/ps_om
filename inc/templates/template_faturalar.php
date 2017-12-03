            <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <a href="<?php echo URL_FATURA_FORM_ALIS ?>"><button type="button" class="btn btn-md btn-danger">+ Alış Faturası Oluştur</button></a>
                    <a href="<?php echo URL_FATURA_FORM_SATIS ?>"><button type="button" class="btn btn-md btn-success">+ Satış Faturası Oluştur</button></a>
                    <a href="<?php echo URL_SATIS_FISI_FORM ?>"><button type="button" class="btn btn-md btn-info">+ Sipariş Fişi Oluştur</button></a>
                    <div class="clearfix"></div>
                  </div>
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


                $(document).ready(function(){

                    $("#cari_table").DataTable({
                      "columns": [
                        null,
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
                          "defaultContent": '<button type="button" class="btn btn-xs btn-success duzenle">Detaylar</button>'
                        }
                      ],
                      "processing": true,
                      "serverSide": true,
                      "ajax": $.fn.dataTable.pipeline({
                          url: "",
                          pages: 5
                      })

                    });

                    $(document).on("click", ".duzenle", function(){
                        window.location = "<?php echo URL_FATURA_INCELE ?>"+$(this).parent().parent().find("td").get(0).innerText;
                    });

                });

            </script>

