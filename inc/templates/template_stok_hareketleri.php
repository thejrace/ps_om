            <div class="row">
                
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <a href="<?php echo URL_STOK_CIKIS_FORM ?>"><button type="button" class="btn btn-md btn-info">+ Stok Çıkışı Olştur</button></a>
                    <a href="<?php echo URL_STOK_GIRIS_FORM ?>"><button type="button" class="btn btn-md btn-danger">+ Stok Girişi Oluştur</button></a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="stok_hareket_table" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>Tip</th>
                          <th>Cari</th>
                          <th>Düzenlenme Tarihi</th>
                          <th class="tr_cb"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Stok Girişi</td>
                          <td>3A</td>
                          <td>11-29-2017 13:43:32</td>
                          <td class="tr_cb"><button type="button" class="btn btn-xs btn-success">Detaylar</button></td>
                        </tr>
                        <tr>
                          <td>Stok Çıkışı</td>
                          <td>3A</td>
                          <td>11-29-2017 13:43:32</td>
                          <td class="tr_cb"><button type="button" class="btn btn-xs btn-success">Detaylar</button></td>
                        </tr>
                        <tr>
                          <td>Stok Girişi</td>
                          <td>3A</td>
                          <td>11-29-2017 13:43:32</td>
                          <td class="tr_cb"><button type="button" class="btn btn-xs btn-success">Detaylar</button></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>



            </div> <!--  ROW1 -->

            <script type="text/javascript">


                $(document).ready(function(){

                    $("#stok_hareket_table").DataTable();

                });

            </script>

