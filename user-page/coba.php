<?php
require_once("head.php");

session_start();
include 'conn.php';
if (isset($_POST["login"])) {
    # code...
    $conn = getConn();
    $sql = "select * from users where email_user='".$_POST["email_user"]."' and password_user = '".$_POST["password_user"]."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
            $_SESSION["nama_user"]=$row["nama_user"];
            $_SESSION["email_user"]=$row["email_user"];
            $_SESSION["role_user"]=$row["role_user"];
            $_SESSION["status_akun"]=$row["status_akun"];
        }

        // mengetahui siapa yg sedang login (role)
        // (0 - admin) (1 - reseller)(2 - sales)
        if ($_SESSION["role_user"] == "0"){
            header("location: /probis/probis2/admin-page/admin-home.php");
        }

        if ($_SESSION["role_user"]=="1") {
            header("location: home.php");
        }

        if ($_SESSION["role_user"]=="2") {
            header("location: home.php");
        }
        
    }
    else {
        echo "<script>alert('tidak ditemukan');</script>";
    }
    $conn->close();
}

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
        <form>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault01">First name</label>
      <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="Mark"
        required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Last name</label>
      <input type="text" class="form-control" id="validationDefault02" placeholder="Last name" value="Otto"
        required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefaultUsername">Username</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend21">@</span>
        </div>
        <input type="text" class="form-control" id="validationDefaultUsername" placeholder="Username"
          aria-describedby="inputGroupPrepend21" required>
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationDefault03">City</label>
      <input type="text" class="form-control" id="validationDefault03" placeholder="City" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationDefault04">State</label>
      <input type="text" class="form-control" id="validationDefault04" placeholder="State" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationDefault05">Zip</label>
      <input type="text" class="form-control" id="validationDefault05" placeholder="Zip" required>
    </div>
  </div>
  <div class="form-group">
    <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input" id="invalidCheck12" required>
      <label class="custom-control-label" for="invalidCheck">Agree to terms and conditions</label>
    </div>
  </div>
  <button class="btn btn-primary btn-sm" type="submit">Submit form</button>
</form>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

        </div>

          
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