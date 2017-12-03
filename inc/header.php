<!DOCTYPE html>
<html>
  <head>

    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	  
    <title>Obarey <?php echo $PAGE["title"] ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo URL_VENDORS; ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo URL_VENDORS; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo URL_VENDORS; ?>nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo URL_VENDORS; ?>iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?php echo URL_VENDORS; ?>select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo URL_VENDORS; ?>bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
      <!-- PNotify -->
    <link href="<?php echo URL_VENDORS; ?>pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?php echo URL_VENDORS; ?>pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="<?php echo URL_VENDORS; ?>pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    

    <!-- Custom Theme Style -->
    <link href="<?php echo URL_CSS; ?>custom.css" rel="stylesheet">


    <!-- jQuery -->
    <script src="<?php echo URL_VENDORS; ?>jquery/dist/jquery.min.js"></script>

    <?php if( in_array("jquery-ui", $PAGE["html_libs"]) ){ ?>

    <!-- jQuery UI-->
    <script src="<?php echo URL_VENDORS; ?>jquery-ui/jquery-ui.js"></script>
    <link href="<?php echo URL_VENDORS; ?>jquery-ui/jquery-ui.css" rel="stylesheet">

    <?php } ?>

    <!-- Bootstrap -->
    <script src="<?php echo URL_VENDORS; ?>bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo URL_VENDORS; ?>fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo URL_VENDORS; ?>nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo URL_VENDORS; ?>bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo URL_VENDORS; ?>iCheck/icheck.min.js"></script>

    <!-- Select2 -->
    <script src="<?php echo URL_VENDORS; ?>select2/dist/js/select2.full.min.js"></script>
    <!-- PNotify -->
    <script src="<?php echo URL_VENDORS; ?>pnotify/dist/pnotify.js"></script>
    <script src="<?php echo URL_VENDORS; ?>pnotify/dist/pnotify.buttons.js"></script>
    <script src="<?php echo URL_VENDORS; ?>pnotify/dist/pnotify.nonblock.js"></script>

    <!-- jquery.inputmask -->
    <script src="<?php echo URL_VENDORS; ?>jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>


    <?php if( in_array("datetimepicker", $PAGE["html_libs"] ) ) { ?>

    <script src="<?php echo URL_VENDORS; ?>moment/min/moment.min.js"></script>
    <script src="<?php echo URL_VENDORS; ?>moment/min/locales.min.js"></script>
    <script src="<?php echo URL_VENDORS; ?>bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
    <link href="<?php echo URL_VENDORS; ?>bootstrap-datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet">

    <?php } ?>

    <?php if( in_array("datatables", $PAGE["html_libs"] ) ){ ?>

    <!-- Datatables -->
    <link href="<?php echo URL_VENDORS; ?>datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo URL_VENDORS; ?>datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo URL_VENDORS; ?>datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo URL_VENDORS; ?>datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">


    <script src="<?php echo URL_VENDORS; ?>datatables.net/js/jquery.dataTables.js"></script>
    <script src="<?php echo URL_VENDORS; ?>datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo URL_VENDORS; ?>datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo URL_VENDORS; ?>datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>

  
    <?php } ?>
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Pamira Stone</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Hoşgeldin,</span>
                <h2>Halim</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menü</h3>
                <ul class="nav side-menu">
                  <li><a href="<?php echo MAIN_URL ?>" ><i class="fa fa-tachometer"></i> Güncel Durum</a></li>
                  <li><a><i class="fa fa-download"></i> Satışlar <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo URL_FATURALAR ?>">Faturalar</a></li>
                      <li><a href="<?php echo URL_CARILER ?>">Cariler</a></li>
                      <!-- <li><a href="#">Satış Raporları</a></li> -->
                      <!-- <li><a href="#">Tahsilat Raporları</a></li> -->
                      <!-- <li><a href="#">Gelir - Gider Raporları</a></li> -->
                    </ul>
                  </li>
                  <li><a><i class="fa fa-upload"></i> Giderler <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <!-- <li><a href="#">Gider Listesi</a></li> -->
                      <!-- <li><a href="#">Ödemeler Raporu</a></li> -->
                      <!-- <li><a href="#">KDV Raporu</a></li> -->
                    </ul>
                  </li>
                  <li><a><i class="fa fa-money"></i> Nakit <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <!-- <li><a href="#">Kasa ve Bankalar</a></li> -->
                      <!-- <li><a href="#">Çekler</a></li> -->
                      <!-- <li><a href="#">Kasa - Banka Raporları</a></li> -->
                      <!-- <li><a href="#">Nakit Akış Raporu</a></li> -->
                    </ul>
                  </li>
                  <li><a><i class="fa fa-cubes"></i> Stok <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo URL_STOK_KARTLARI ?>">Stok Kartları</a></li>
                      <!-- <li><a href="<?php echo URL_STOK_HAREKETLERI ?>">Stok Hareketleri</a></li> -->
                      <!-- <li><a href="#">Stok Raporu</a></li> -->
                      <li><a href="<?php echo URL_STOK_KARTLARI_URUN_GRUPLARI ?>">Ürün Grupları</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->


          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="" alt="">Halim Kanbur
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Kullanıcı Ayarları</span>
                      </a>
                    </li>
                    
                    <li><a href="#"><i class="fa fa-sign-out pull-right"></i> Çıkış</a></li>
                  </ul>
                </li>

              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo $PAGE["top_title"]; ?></h3>
              </div>

              
            </div>
            <div class="clearfix"></div>