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

                    $(document).on("click", ".duzenle", function(){
                        window.location = "<?php echo URL_CARI_DUZENLE_FORM ?>"+$(this).parent().parent().find("td").get(0).innerText;
                    });

                });

            </script>

