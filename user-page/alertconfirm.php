<?php
require_once("head.php");
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
                    <h3 class="mb-3">Request Token</h3>
          	        <span class="subheading">Hello pelanggan, Isi untuk konfirmasi email</span>            
                </div>

                <div class="form-group">                   
                    <input type="text" class="form-control" id="txttoken" placeholder="Token">  
                    <a href="#" onclick="kirimulang()" class="text-center">Kirim ulang email! </a>               
                </div>
               
                <div class="form-group justify-content-center">
                   <button type="button" name="login" onclick="verify()" class="btn btn-primary py-2 px-5">Konfirmasi Email</button>
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
    <?php include_once "scriptonly.php"; ?>
</body>
<script>
    function verify() {
        $.post("ajaxs/ajaxconfirmemail.php",
        {
            jenis:"verify",
            token:$("#txttoken").val(),
        },
        function(data){
            alert(data);
            if (data.search("berhasil")) {
                window.location.href="login.php";
            }
        });


    }

    function kirimulang() {
        $.post("ajaxs/ajaxconfirmemail.php",
        {
            jenis:"kirimulang",
        },
        function(data){
            var str=data;
            var n = str.search("Message has been sent");
            if (n>0) {
                alert("Token telah dikirim melalui email anda !");
            }
        });
    }
</script>
</html>