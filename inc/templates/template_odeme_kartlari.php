            <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <a href="<?php echo URL_ODEME_KARTI_FORM ?>"><button type="button" class="btn btn-md btn-info">+ Ödeme Kartı Ekle</button></a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered bulk_action dtable-obarey">
                      <thead>
                        <tr>
                          <th class="tr_cb">#</th>
                          <th>İsim</th>
                          <th>Tip</th>
                          <th>Kalan</th>
                          <th>Toplam</th>
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
                        window.location = "<?php echo URL_ODEME_KARTI_FORM ?>?item_id="+$(this).parent().parent().find("td").get(0).innerText;
                    });

                });

            </script>

