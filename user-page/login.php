<?php
require_once("headlogin.php");
?>
<!DOCTYPE html>
<html>
<head>
    
</head>
<body class="goto-here">

    <!-- nav -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
        <a class="navbar-brand" href="home.php">EMOS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="register.php" class="nav-link">Register</a></li>
            </ul>
        </div>
    </div>
    </nav>
    <!-- END nav -->


    <section class="ftco-section contact-section bg-light ">
        <div class="container">
        <div class="row block-9 justify-content-center">
        
        <div class="col-md-6 order-md-last d-flex">    
            <form action="" method="post" class="bg-white p-5 contact-form">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h3 class="mb-3">Login</h3>
          	        <span class="subheading">Hello pelanggan, Isi untuk masuk</span>            
                </div>

                <!-- Login -->
                <div class="form-group">
                    <input type="text" class="form-control" name="email_user" id="txt_user" aria-describedby="helpId" placeholder="Email">
                </div>
                <div class="form-group">                   
                    <input type="password" class="form-control" name="password_user" id="txt_pass" placeholder="Password">  
                    <a href="lupa-password.php" class="text-center">Lupa Password? Klik disini! </a>               
                </div>
               
                <div class="form-group justify-content-center">
                   <button type="button" onclick="login()" class="btn btn-primary py-2 px-5">Login</button>
                </div>
                <!--End Login -->

                <hr>

                <!-- Go to Register -->
                <a href="register.php" class="text-center">Belum punya akun? Register disini! </a>

                <!-- ini contoh link utk ke admin-page -->
                <!-- <a href="/probis/probis2/admin-page/admin-home.php" class="text-center">Belum punya akun? Register disini! </a> -->
                <!-- End Go to Register -->
            </form>

        </div>

          
        </div>
      </div>
        </div>
    </section>
    
  <?php
    include_once "scriptonly.php";
  ?>
    <script>
        function login() {
            $.post("ajaxs/ajaxlogin.php",
            {
                jenis:"login",
                user:$("#txt_user").val(),
                pass:$("#txt_pass").val(),
            },
            function(data){
                console.log(data);
                if (data.search("admin salah password")>0||data.search("data tidak ditemukan")>0) {
                    
                }else{
                    //window.location.href=data;
                }
            });
        }
    </script>

   
</body>
</html>