            <div class="row">
                
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <button type="button" class="btn btn-md btn-info">+ Stok Kartı Ekle</button>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="cari_table" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          
                          <th class="tr_cb"><input type="checkbox" id="check-all" class="flat"></th>
                        
                          <th>Stok Kodu</th>
                          <th>Stok Adı</th>
                          <th>Satış Fiyatı</th>
                          <th>Birim</th>
                          <th>Ürün Grup</th>
                          <th>Stok</th>
                          <th class="tr_cb"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="tr_cb">
                           <input type="checkbox" id="check-all" class="flat">
                          </td>
                          <td>XXX</td>
                          <td>10x10 Limra</td>
                          <td>4.25</td>
                          <td>Adet</td>
                          <td>Doğal Taş</td>
                          <td>200</td>
                          <td class="tr_cb"><button type="button" class="btn btn-xs btn-success">Düzenle</button></td>
                        </tr>
                        <tr>
                         <td class="tr_cb">
                           <input type="checkbox" id="check-all" class="flat">
                          </td>
                          <td>XXX</td>
                          <td>5x5 Limra</td>
                          <td>4.25</td>
                          <td>Adet</td>
                          <td>Doğal Taş</td>
                          <td>200</td>
                          <td class="tr_cb"><button type="button" class="btn btn-xs btn-success">Düzenle</button></td>
                        </tr>
                        <tr>
                          <td class="tr_cb">
                           <input type="checkbox" id="check-all" class="flat">
                          </td>
                          <td>XXX</td>
                          <td>10x10 Traverten</td>
                          <td>4.25</td>
                          <td>Adet</td>
                          <td>Doğal Taş</td>
                          <td>200</td>
                          <td class="tr_cb"><button type="button" class="btn btn-xs btn-success">Düzenle</button></td>
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

