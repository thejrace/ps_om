<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pamira Stone Kullanıcı Oluştur </title>

    <!-- Bootstrap -->
    <link href="<?php echo URL_VENDORS; ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo URL_VENDORS; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo URL_VENDORS; ?>nprogress/nprogress.css" rel="stylesheet">

    <!-- PNotify -->
    <link href="<?php echo URL_VENDORS; ?>pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?php echo URL_VENDORS; ?>pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="<?php echo URL_VENDORS; ?>pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?php echo URL_VENDORS; ?>jquery/dist/jquery.min.js"></script>

    <!-- PNotify -->
    <script src="<?php echo URL_VENDORS; ?>pnotify/dist/pnotify.js"></script>
    <script src="<?php echo URL_VENDORS; ?>pnotify/dist/pnotify.buttons.js"></script>
    <script src="<?php echo URL_VENDORS; ?>pnotify/dist/pnotify.nonblock.js"></script>



    <!-- Custom Theme Style -->
    <link href="<?php echo URL_CSS; ?>custom.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form id="login_form">
              <h1>Kullanıcı Oluştur</h1>
              <div>
                <input type="text" name="isim" class="form-control" placeholder="İsim" />
              </div>
              <div>
                <input type="email" name="eposta" class="form-control" placeholder="Eposta" />
              </div>
              <div>
                <input type="password" name="pass" class="form-control" placeholder="Şifre" />
              </div>
              <div>
                <a class="btn btn-default submit">Oluştur</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                
                <div class="clearfix"></div>
                <br />

                <div>
                  <p>©2017 Pamira Stone</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>


    <script type="text/javascript">

        $(document).ready(function(){

            $(".submit").click(function( ev ){

                var eposta = $("[name='eposta']"),
                    pass = $("[name='pass']"),
                    isim = $("[name='isim']");

                if( eposta.val() == "" || pass.val() == "" || isim.val() == "" ){
                    new PNotify({
                      title: "Hata",
                      text: "Formda eksiklikler var!.",
                      type: "error",
                      styling: 'bootstrap3'
                  });
                } else {

                    $.ajax({
                        type:"POST",
                        dataType:"json",
                        data: { req:"register", eposta:eposta.val(), pass:pass.val(), isim:isim.val() },
                        success: function(res){

                            if( res.ok ){
                              new PNotify({
                                  title: "Kayıt Başarılı",
                                  text: "",
                                  type: "success",
                                  styling: 'bootstrap3'
                              });
                              setTimeout(function(){ location.reload() }, 1000);
                            } else {
                                new PNotify({
                                  title: "Hata",
                                  text: res.text,
                                  type: "error",
                                  styling: 'bootstrap3'
                              });
                            }
                            
                        }
                    });

                }

                ev.preventDefault();
            });


        });


    </script>


  </body>
</html>
