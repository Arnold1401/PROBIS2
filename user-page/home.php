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
                    <li class="nav-item active"><a href="home.php" class="nav-link">Beranda</a></li>

                    <li class="nav-item"><a href="produk.php" class="nav-link">Produk</a></li>
                    <li class="nav-item"><a href="cart.php" class="nav-link"><span class="icon-shopping_cart"></span>[<?php if (isset($_SESSION["keranjang"])) {
        $arrkeranjang=unserialize($_SESSION["keranjang"]);
        $count=count($arrkeranjang);
        echo $count;
    }else{
        echo 0;
    }
 ?>]</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if (isset($_SESSION["nama_perusahaan"])) {
                                                                                                                                                            echo $_SESSION["nama_perusahaan"];
                                                                                                                                                        } ?></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="wishlist.php">Daftar Keinginan</a>
                            <a class="dropdown-item" href="status-order.php">Daftar Pesanan</a>
                            <a class="dropdown-item" href="tagihan.php">Tagihan</a>
                            <a class="dropdown-item" href="ulasan.php">Ulasan</a>
                            <hr>
                            <a class="dropdown-item" href="pengaturan.php">Akun Saya</a>
                            <a onclick="keluar()" class="dropdown-item">Keluar</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    <section id="home-section" class="hero">
        <div class="home-slider owl-carousel">
            <div class="slider-item" style="background-image: url(images/bg_1.jpg);">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                        <div class="col-md-12 ftco-animate text-center">
                            <h1 class="mb-2">We serve Fresh Vegestables &amp; Fruits</h1>
                            <h2 class="subheading mb-4">We deliver organic vegetables &amp; fruits</h2>
                            
                        </div>

                    </div>
                </div>
            </div>

            <div class="slider-item" style="background-image: url(images/bg_2.jpg);">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                        <div class="col-sm-12 ftco-animate text-center">
                            <h1 class="mb-2">100% Fresh &amp; Organic Foods</h1>
                            <h2 class="subheading mb-4">We deliver organic vegetables &amp; fruits</h2>
                            <p><a href="#" class="btn btn-primary">View Details</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row no-gutters ftco-services">
    <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
        <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                <span class="flaticon-customer-service"></span>
        </div>
        <div class="media-body">
            <h3 class="heading">Salesman terpercaya</h3>
            <span>Setiap Reseller memiliki sales yang dekat dengan wilayahnya</span>
        </div>
        </div>      
    </div>
    <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
        <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
                <span class="flaticon-diet"></span>
        </div>
        <div class="media-body">
            <h3 class="heading">Terkirim Secara Baik</h3>
            <span>Produk akan dipaketkan dengan baik</span>
        </div>
        </div>    
    </div>
    <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
        <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
                <span class="flaticon-award"></span>
        </div>
        <div class="media-body">
            <h3 class="heading">Produk Berkualitas Tinggi</h3>
            <span>Semua produk berasal dari perusahaan terpercaya</span>
        </div>
        </div>      
    </div>
    <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
        <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
                <span class="flaticon-customer-service"></span>
        </div>
        <div class="media-body">
            <h3 class="heading">Online Support</h3>
            <span>Call us </span>
        </div>
        </div>      
    </div>
    </div>
        </div>
    </section>

    <!-- Jenis Product
    
        jika type =1 artinya minuman
            type=2 barang konsumsi
            type=3 perawatan pribadi
            type=4 obat obat an 
    
     -->
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Produk Unggulan</span>
                    <h2 class="mb-4">Produk tersedia</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                        <a href="#" class="img-prod"><img class="img-fluid" src="images/product-1.jpg" alt="Colorlib Template">
                        <div></div>
    					</a>
    					<div class="text py-3 pb-4 px-3 text-center">
    						<h3><a href="#">Minuman</a></h3>
    						<div class="d-flex">
    							<div class="pricing"></div>
	    					</div>
	    					<div class="d-flex px-3 d-flex justify-content-center align-items-center text-center">
                                <a name="" id="" class="btn btn-primary" href="produk.php?type=1" role="button">Lihat Produk</a>	    						
    						</div>
    					</div>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="images/product-2.jpg" alt="Colorlib Template">
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3 text-center">
    						<h3><a href="#">Makanan Ringan</a></h3>
    						<div class="d-flex">
    							<div class="pricing"></div>
	    					</div>
    						<div class="d-flex px-3 d-flex justify-content-center align-items-center text-center">
                                <a name="" id="" class="btn btn-primary" href="produk.php?type=2" role="button">Lihat Produk</a>	    						
    						</div>
    					</div>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="images/product-3.jpg" alt="Colorlib Template">
	    					<div class="overlay"></div>
	    				</a>
    					<div class="text py-3 pb-4 px-3 text-center">
    						<h3><a href="#">Perawatan Diri</a></h3>
    						<div class="d-flex">
    							<div class="pricing"></div>
	    					</div>
    						<div class="d-flex px-3 d-flex justify-content-center align-items-center text-center">
                                <a name="" id="" class="btn btn-primary" href="produk.php?type=3" role="button">Lihat Produk</a>
    						</div>
    					</div>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="images/product-4.jpg" alt="Colorlib Template">
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3 text-center">
    						<h3><a href="#">Obat-Obatan</a></h3>
    						<div class="d-flex">
    							<div class="pricing"></div>
	    					</div>
    						<div class="d-flex px-3 d-flex justify-content-center align-items-center text-center">
                                <a name="" id="" class="btn btn-primary" href="produk.php?type=4" role="button">Lihat Produk</a>	    						
    						</div>
    					</div>
    				</div>
    			</div>	
    		</div>
    	</div>
    </section>
    <!-- END Jenis Product -->

    <?php
    include_once('justfooter.php')
    ?>

</body>
<script>
    function keluar() {
        $.post("ajaxs/ajaxlogin.php", {
                jenis: "keluar",
            },
            function(data) {
                window.location.href = "login.php";
            });
    }
</script>

</html>