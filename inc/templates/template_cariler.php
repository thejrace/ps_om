            <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <a href="<?php echo URL_CARI_FORM ?>"><button type="button" class="btn btn-md btn-info">+ Cari Ekle</button></a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="cari_table" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          
                          <th class="tr_cb"><input type="checkbox" id="check-all" class="flat"></th>
                        
                          <th>Ünvan</th>
                          <th>Tür</th>
                          <th>İl</th>
                          <th>İlçe</th>
                          <th class="tr_cb"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="tr_cb">
                           <input type="checkbox" id="check-all" class="flat">
                          </td>
                          <td>Filmograf</td>
                          <td>Alıcı - Satıcı</td>
                          <td>İstanbul</td>
                          <td>Kadıköy</td>
                          <td class="tr_cb"><a href="<?php echo URL_CARI_DUZENLE_FORM ?>CID"><button type="button" class="btn btn-xs btn-success">Düzenle</button></a></td>
                        </tr>
                        <tr>
                         <td class="tr_cb">
                           <input type="checkbox" id="check-all" class="flat">
                          </td>
                          <td>Fatilmograf</td>
                          <td>Alıcı</td>
                          <td>İstanbul</td>
                          <td>Beykoz</td>
                          <td class="tr_cb"><a href="<?php echo URL_CARI_DUZENLE_FORM ?>CID"><button type="button" class="btn btn-xs btn-success">Düzenle</button></a></td>
                        </tr>
                        <tr>
                          <td class="tr_cb">
                           <input type="checkbox" id="check-all" class="flat">
                          </td>
                          <td>qqFilmograf</td>
                          <td>Tedarikçi</td>
                          <td>Ankara</td>
                          <td>Oran</td>
                          <td class="tr_cb"><a href="<?php echo URL_CARI_DUZENLE_FORM ?>CID"><button type="button" class="btn btn-xs btn-success">Düzenle</button></a></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div> <!--  ROW1 -->


 
            <script type="text/javascript">


                $(document).ready(function(){

                    $("#cari_table").DataTable();

                });

            </script>

