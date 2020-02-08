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
                <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
            </ul>
        </div>
    </div>
    </nav>
    <!-- END nav -->



    <section class="ftco-section contact-section bg-light ">
        <div class="container">
            
        
        <div class="row block-9 justify-content-center">

        <!-- Profile Usaha beserta pemiliknya -->
        <div class="col-md-6 d-flex">
            <form action="#" class="bg-white p-4 contact-form">
                <div class="form-group">
                  <h5 for="">Profil Usaha</h5>
                  <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Nama Perusahaan/Toko">
                  <small id="helpId" class="form-text text-muted">Isi Nama Perusahaan/Toko</small>
                </div>

                <hr>

                <div class="form-group">
                  <h5 for="">Profil Pemilik</h5>
                  <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Nama Pemilik">
                  <small id="helpId" class="form-text text-muted">Isi Nama Pemilik</small>
                </div>

                <div class="form-group">
                    <input type="number" class="form-control" name="" id="" placeholder="Nomor KTP">
                    <small id="helpId" class="form-text text-muted">Isi Nomor KTP Anda</small>              
                </div>

                <div class="form-group">
                    <input type="file" id="myFile" name="filename">           
                </div>

                <div class="form-group">
                    <input type="number" class="form-control" name="" id="" placeholder="Nomor Telpon">
                    <small id="helpId" class="form-text text-muted">Isi Nomor Telpon Anda</small>              
                </div>

                <div class="form-group">
                    <input type="date" class="form-control" id="" name="bdaytime">
                    <small id="helpId" class="form-text text-muted">Isi Tanggal/Bulan/Tahun Lahir Anda</small>
                </div>

                <div class="form-group">
                  <select class="form-control" name="" id="">
                    <option>Wanita</option>
                    <option>Pria</option>                   
                  </select>
                  <small id="helpId" class="form-text text-muted">Jenis Kelamin</small>
                </div>

                <div class="form-group">
                  <label for="">Alamat</label>
                  <textarea class="form-control" name="" id="" rows="3"></textarea>
                </div>

                <!-- Go to fill username and pass -->
                <a name="" id="" class="btn btn-primary justify-content-end" href="#" role="button"> <span class="icon-arrow-right"></span> </a>
                <!-- End Go to fill username and pass -->

            </form>
        </div>
        <!-- End Profile Usaha beserta pemiliknya -->
        
        <!-- Account -->
        <div class="col-md-6 order-md-last d-flex">    
            <form action="#" class="bg-white p-4 contact-form">
                
                <div class="form-group">
                    <h5 for="">Account</h5>          
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="example@gmail.com">
                  <small id="helpId" class="form-text text-muted">Isi Email anda sesuai format</small>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Username">
                    <small id="helpId" class="form-text text-muted">Isi Username anda</small>
                </div>
                <div class="form-group">                   
                    <input type="password" class="form-control" name="" id="" placeholder="Password">                 
                </div>
                <div class="form-group">                   
                    <input type="password" class="form-control" name="" id="" placeholder="Konfirmasi Password">                 
                </div>
                <div class="form-group justify-content-center">
                   <button type="button" name="" id="" class="btn btn-primary py-2 px-5">Register</button>
                </div>


                <hr>

                <!-- Go to Register and verification -->
                <a href="" class="text-center">Jangan Lupa untuk memverifikasi akun melalui email anda</a>
                <!-- End Go to Register and verification -->
            </form>

        </div>
        <!--End Account -->

        </div>
      </div>
        </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>
</body>
</html>