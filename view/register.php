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
            <a class="navbar-brand" href="index.html">EMOS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="contact.html" class="nav-link">Login</a></li>
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
                  <h5 for="">Company Profile</h5>
                  <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Company Name">
                  <small id="helpId" class="form-text text-muted">Please fill your company name</small>
                </div>

                <hr>

                <div class="form-group">
                  <h5 for="">Owner Profile</h5>
                  <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Name">
                  <small id="helpId" class="form-text text-muted">Please fill your name</small>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="example@gmail.com">
                  <small id="helpId" class="form-text text-muted">Please fill your email</small>
                </div>

                <div class="form-group">
                    <input type="number" class="form-control" name="" id="" placeholder="Phone Number">
                    <small id="helpId" class="form-text text-muted">Please fill your phone number</small>              
                </div>

                <div class="form-group">
                    <input type="date" class="form-control" id="" name="bdaytime">
                    <small id="helpId" class="form-text text-muted">Please fill your birthdate</small>
                </div>

                <div class="form-group">
                  <select class="form-control" name="" id="">
                    <option>Female</option>
                    <option>Male</option>                   
                  </select>
                  <small id="helpId" class="form-text text-muted">Select gender</small>
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
                    <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Username">
                    <small id="helpId" class="form-text text-muted">Please fill your Username</small>
                </div>
                <div class="form-group">                   
                    <input type="password" class="form-control" name="" id="" placeholder="Password">                 
                </div>
                <div class="form-group">                   
                    <input type="password" class="form-control" name="" id="" placeholder="Confirm Password">                 
                </div>
                <div class="form-group justify-content-center">
                   <button type="button" name="" id="" class="btn btn-primary py-2 px-5">Register</button>
                </div>


                <hr>

                <!-- Go to Register and verification -->
                <a href="" class="text-center">Dont forget to verify your account. Customer Number will sent to your email </a>
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