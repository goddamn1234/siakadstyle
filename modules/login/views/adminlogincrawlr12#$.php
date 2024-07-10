<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="96x96" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/g/vf/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/g/vf/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/g/vf/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="76x76" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/g/vf/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="60x60" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/g/vf/apple-icon-60x60.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/s/m/e/css/style.default.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/s/m/e/css/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/s/m/e/css/uielement.css">

    <!-- Custom styling plus plugins -->
    <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/s/m/e/js/plugins/jquery-1.7.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/s/m/e/js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/s/m/e/js/plugins/jquery.cookie.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/s/m/e/js/plugins/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/s/m/e/js/plugins/jquery.uniform.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/s/m/e/js/plugins/jquery.bxSlider.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/s/m/e/js/plugins/jquery.slimscroll.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/s/m/r/js/custom/general.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/s/m/e/js/custom/tables.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/s/m/e/js/custom/widgets.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/s/m/e/js/custom/forms.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/s/m/e/js/others/jquery.tipsy.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/s/m/e/js/custom/index.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ERUDIO - Sistem Informasi Akademik</title>
    <link rel="SHORTCUT ICON" href="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/g/vf/favicon-16x16.png" type="image/x-png">
	<style>
        .hero-image {
        background-image: url("https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/g/background02.png");
        background-color: #cccccc;
        height: 800px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        }
        .fa {
            padding: 20px;
            font-size: 30px;
            width: 50px;
            text-align: center;
            text-decoration: none;
            margin: 5px 2px;
        }

        .fa:hover {
            opacity: 0.7;
        }

        .fa-erudioweb {
            height: 35px;
            background-image: url("https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/g/erudiofaa.png");
            background-color: #ea4c89;
            background-position: center;
            background-repeat: no-repeat;
        }

        .fa-facebook {
            background: #3B5998;
            color: white;
            border-radius:10px;
        }

        .fa-youtube {
            background: #bb0000;
            color: white;
            border-radius:10px;
        }

        .fa-instagram {
            background: #f40083;
            color: white;
            border-radius:10px;
        }
    </style>

    <script type="text/javascript">
        document.addEventListener('contextmenu', function(event) {
            event.preventDefault();
        });

        document.addEventListener('keydown', function(event) {
            // Prevent Ctrl+U or Command+U
            if ((event.ctrlKey || event.metaKey) && (event.key === 'u' || event.key === 'U')) {
                event.preventDefault();
            }
            // Prevent Ctrl+Shift+I or Command+Option+I
            if ((event.ctrlKey || event.metaKey) && event.shiftKey && (event.key === 'i' || event.key === 'I')) {
                event.preventDefault();
            }
            // Prevent Ctrl+Shift+J or Command+Option+J
            if ((event.ctrlKey || event.metaKey) && event.shiftKey && (event.key === 'j' || event.key === 'J')) {
                event.preventDefault();
            }
            // Prevent Ctrl+S or Command+S
            if ((event.ctrlKey || event.metaKey) && (event.key === 's' || event.key === 'S')) {
                event.preventDefault();
            }
            // Prevent Ctrl+H or Command+H
            if ((event.ctrlKey || event.metaKey) && (event.key === 'h' || event.key === 'H')) {
                event.preventDefault();
            }
            // Prevent Ctrl+A or Command+A
            if ((event.ctrlKey || event.metaKey) && (event.key === 'a' || event.key === 'A')) {
                event.preventDefault();
            }
            // Prevent F12
            if (event.key === 'F12' || event.keyCode === 123) {
                event.preventDefault();
            }
        });
    </script>
</head>
<div class="hero-image">
    <br/><br/>
<body class="loginpage">
	
	<div class="loginbox" style="/*background:#ffe5e5;*/">

		<div class="loginboxinner">

		          <!-- <div class="combobox">

                  </div> -->
                  
                                  
            <div id="login" class="animate form">
                <section class="login_content">
                <?php echo form_open('login/cek');?>
                    <h4><i class="icon ico-lock"></i> Login <strong>FORM</strong></h4>
                    <div class="username"><div>
                        <input type="text" name="username" class="usernameinner" placeholder="Username" required="" />
                    </div></div>
                    <div class="password"><div>
                        <input type="password" name="pass" class="passwordinner" placeholder="Password" required="" />
                    </div></div>
                    <div>
				        <button type='submit'>Login</button>
                    </div>
            </div>
            
            
            </form>
            </div>
            
	    <div class="logininfo" style="/*! background:#ffe5e5; */">
          <div class="boxlogo" style="/*! background-color:#ffe5e5; */">
                <a href="http://erudioindonesia.sch.id" target="_blank">
                    <img class="logoIndex" height="42" width="100" src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/g/ln/eruu.png" />
                </a>
                <h1 style="color:#ff7569;">SIAKAD</h1>
              <h4 class="titleunv" style="color:#ff7569;">Sistem Informasi Akademik</h4>
        </div>
          <hr/>

          <h4 class="heading">&nbsp;</h4>
          <div class="contentInfo">
              <div id="scroll1" class="mousescroll">
                       <!-- Add font awesome icons -->
                <a href="https://erudioindonesia.sch.id" class="fa" target="_blank" style="color: #8c8686; background-color: #fff; border-radius: 10px; padding: 17.5px;">
                    <center>
                        <img src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/g/hr/erudio.png" alt="" style="width: 55px; height: 33px; object-fit: cover;">
                    </center>
                </a>
                <a href="https://linktr.ee/erudio.indonesia" class="fa fa-sitemap" style="color: #fff;background-color:#8a1213;border-radius:10px;" target="_blank"></a>
                <a href="https://www.instagram.com/erudio.indonesia" class="fa fa-instagram" target="_blank"></a>
                <a href="https://www.youtube.com/channel/UCAzG1zB3qWpW9BK5esnzoLw" class="fa fa-youtube" target="_blank"></a>
                <a href="https://www.facebook.com/ErudioIndonesia" class="fa fa-facebook" target="_blank"></a>

        <!--
                </div> 	-->	
			
            </div>
        </div><!--loginboxinner-->
        
    </div><!--loginbox-->
</div>
</body>
</html>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/g/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/goddamn1234/siakadstyle/lx/js/lobibox.js"></script>
    <script>
        $(document).ready(function(){
            $("#loginForm").submit(function(event){
                event.preventDefault(); // prevent form from submitting normally

                var user = $("#user").val();
                var pass = $("#pass").val();

                $.ajax({
                    url: "<?php echo site_url('login/cek'); ?>",
                    type: "post",
                    data: { user: user, pass: pass },
                    success: function(response){
                        if (response === "success") {
                            Lobibox.notify('success', {
                                msg: 'Login Berhasil'
                            });
                        } else {
                            Lobibox.notify('error', {
                                msg: 'Gagal Login'
                            });
                        }
                    },
                    error: function(){
                        Lobibox.notify('error', {
                            msg: 'Terjadi Kesalahan, Silakan Coba Lagi'
                        });
                    }
                });
            });
        });
    </script>
    
    

