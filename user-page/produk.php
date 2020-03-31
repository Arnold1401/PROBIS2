<?php
require_once("head.php");
?>

<!DOCTYPE html>
<html>
<head>
   
</head>
<body class="goto-here">
    <!-- header paling atas -->
    <div class="py-1 bg-primary">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                            <span class="text">+ 1234 5678 9100</span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                            <span class="text">emos@gmail.com</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END header paling atas -->

    <!-- nav -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
        <a class="navbar-brand" href="home.php">EMOS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="home.php" class="nav-link">Home</a></li>
               
                <li class="nav-item active"><a href="produk.php" class="nav-link">Produk</a></li>
                <li class="nav-item cta cta-colored"><a href="cart.php" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if(isset($_SESSION["nama_perusahaan"])){ echo $_SESSION["nama_perusahaan"];}?></a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                    <a class="dropdown-item" href="wishlist.php">Daftar Keinginan</a>
                    <a class="dropdown-item" href="status-order.php">Status Order</a>
                    <a class="dropdown-item" href="riwayat-trans.php">Riwayat Order</a>
                    <a class="dropdown-item" href="piutang.php">Piutang</a>
                    <a class="dropdown-item" href="ulasan.php">Ulasan</a>
                    <hr>
                    <a class="dropdown-item" href="pengaturan.php">Akun Saya</a>
                    <a class="dropdown-item" onclick="keluar()">Keluar</a>
                </div>
                </li>
            </ul>
        </div>
    </div>
    </nav>
    <!-- END nav -->

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">         	
            <h1 class="mb-0 bread">PRODUK</h1>
            <div class="col-md-12 d-flex align-items-center">
            
            <!-- Cari Product -->
            <form action="#" class="subscribe-form">
              <div class="form-group d-flex">
                <input type="text" class="form-control" placeholder="Cari Produk">
                <input name="" id="" class="btn btn-primary" type="button" value="Cari">              
              </div>
            </form>
            <!--End Cari Product -->

          </div>
          </div>
        </div>
      </div>
    </div>

    

    <!-- Jenis Product -->
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-10 mb-5 text-center">
    				<ul class="product-category">
    					<li><a href="#" class="active">Semua</a></li>
    					<li><a href="#">Minuman</a></li>
    					<li><a href="#">Konsumsi</a></li>
    					<li><a href="#">Pribadi</a></li>
    					<li><a href="#">Obat</a></li>
    				</ul>
          </div>
        </div>
        
        <!-- row Jenis Product -->
        <div class="row">
          <div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
              <a href="#" class="img-prod"><img class="img-fluid" src="images/product-1.jpg" alt="Colorlib Template"></a>
    					<div class="text py-3 pb-4 px-3 text-center">
                <h3><a href="#">Minuman</a></h3>
                  <div class="d-flex">
                    <div class="pricing"></div>
                  </div>
                
                  <div class="d-flex px-3 d-flex justify-content-center align-items-center text-center">
                    <a name="" id="" class="btn btn-primary" href="detailproduk.php" role="button">Detail</a>
	    							<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-3">
	    								<span><i class="ion-ios-heart"></i></span>
	    							</a>
                  </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
              <a href="#" class="img-prod"><img class="img-fluid" src="images/product-1.jpg" alt="Colorlib Template"></a>
    					<div class="text py-3 pb-4 px-3 text-center">
                <h3><a href="#">Minuman</a></h3>
                  <div class="d-flex">
                    <div class="pricing"></div>
                  </div>
                
                  <div class="d-flex px-3 d-flex justify-content-center align-items-center text-center">
                    <a name="" id="" class="btn btn-primary" href="detailproduk.php" role="button">Detail</a>
	    							<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-3">
	    								<span><i class="ion-ios-heart"></i></span>
	    							</a>
                  </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
              <a href="#" class="img-prod"><img class="img-fluid" src="images/product-1.jpg" alt="Colorlib Template"></a>
    					<div class="text py-3 pb-4 px-3 text-center">
                <h3><a href="#">Minuman</a></h3>
                  <div class="d-flex">
                    <div class="pricing"></div>
                  </div>
                
                  <div class="d-flex px-3 d-flex justify-content-center align-items-center text-center">
                    <a name="" id="" class="btn btn-primary" href="detailproduk.php" role="button">Detail</a>
	    							<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-3">
	    								<span><i class="ion-ios-heart"></i></span>
	    							</a>
                  </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
              <a href="#" class="img-prod"><img class="img-fluid" src="images/product-1.jpg" alt="Colorlib Template"></a>
    					<div class="text py-3 pb-4 px-3 text-center">
                <h3><a href="#">Minuman</a></h3>
                  <div class="d-flex">
                    <div class="pricing"></div>
                  </div>
                
                  <div class="d-flex px-3 d-flex justify-content-center align-items-center text-center">
                    <a name="" id="" class="btn btn-primary" href="detailproduk.php" role="button">Detail</a>
	    							<a href="#" class="buy-now d-flex justify-content-center align-items-center mx-3">
	    								<span><i class="ion-ios-heart"></i></span>
	    							</a>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end row Jenis Product -->
            
        <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div>
    	</div>
    </section>
    <!-- END Jenis Product -->

    <?php
    include_once('justfooter.php')
     ?>
   <script>
    function keluar(){
        $.post("ajaxs/ajaxlogin.php",
        {
            jenis:"keluar",
        },
        function(data){
            window.location.href="login.php";
        });
    }
</script>
</body>
</html>