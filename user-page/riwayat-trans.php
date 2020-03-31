<?php
require_once("head.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width">
    <style>
        .star{
          color: goldenrod;
          font-size: 2.0rem;
          padding: 0 0rem; /* space out the stars */
        }
        .star::before{
          content: '\2606';    /* star outline */
          cursor: pointer;
        }
        .star.rated::before{
          /* the style for a selected star */
          content: '\2605';  /* filled star */
        }
        
        .stars{
            counter-reset: rateme 0;   
            font-size: 1.5rem;
            font-weight: 900;
        }
        .star.rated{
            counter-increment: rateme 1;
        }
        .stars::after{
            content: counter(rateme) '/5';
        }
    </style>
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
                <li class="nav-item active"><a href="home.php" class="nav-link">Home</a></li>
               
                <li class="nav-item"><a href="produk.php" class="nav-link">Produk</a></li>
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
            <h1 class="mb-0 bread">RIWAYAT ORDER SAYA</h1>

          </div>
        </div>
      </div>
    </div>

    <!-- RIWAYAT TRANS -->
    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="content mt-3">
                <div class="animated fadeIn">

                    <!-- Header piutang-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="cart-list">
                            <form>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="thead-primary">
                                    <tr>
                                        <th>Tanggal Order</th>                                    
                                        <th>No Order</th>
                                        <th>Kurir Pengiriman</th>
                                        <th>Sales</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>                                                                                                           
                                        <td>
                                            01 Januari 2020                      
                                        </td>
                                        <td>
                                            <a class="text-info" data-toggle="modal" data-target=".bd-example-modal-xl">00101</a>
                                        </td>
                                        <td>Rp4.90</td>                                                                  
                                        <td class="total">Rp12.90</td>
                                        <td>
                                            <label class="text-success">Selesai</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            01 Januari 2020                      
                                        </td>
                                        <td>
                                            <a class="text-info" data-toggle="modal" data-target=".bd-example-modal-lg">00101</a>
                                        </td>
                                        <td>Rp4.90</td>                                    
                                        <td class="total">Rp12.90</td>                     
                                        <td>
                                            <label class="text-danger">Batal</label>
                                        </td>
                                    </tr>               
                                    </tbody>
                                </table>
                            </div> 
                            </form>   
                            </div>  
                        </div>
                    </div>
                        
                    </div>
                    <!--End Header piutang-->

                    <!-- Detail piutang-->
                    <div class="row py-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Detail Barang Piutang</strong>
                                </div>
                                <div class="card-list">
                                <form>
                                <div class="table-responsive">
                                <table class="table table-striped table-bordered center">
                                <thead class="thead center">
                                <tr>
                                    <th>Gambar Produk</th>                                    
                                    <th>Nama produk</th>
                                    <th>Jumlah Beli</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>                                                                                                           
                                    <td>
                                        <img src="/probis/probis2/images/imageService.png" class="img-fluid" alt="Responsive image" width="150px">
                                    </td>              
                                    <td>[nama produk]</td>    
                                    <td>[jumlah beri]</td>   
                                    <td>[total harga]</td>                                    
                                    <td>                        
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >Tulis Ulasan</button>
                                    </td>
                                </tr>

                                <tr>                                                                                                           
                                <td>
                                <img src="/probis/probis2/images/imageService.png" class="img-fluid" alt="Responsive image" width="150px">
                                </td>              
                                <td>[nama produk]</td>                                     
                                <td>                        
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Tulis Ulasan</button>
                                </td>
                                </tr>

                                </tbody>
                                </table>
                                </div>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Detail piutang-->
                </div>
            </div>
        </div>            
    </section>
    <!-- end RIWAYAT TRANS -->

    <!--Modal untuk rating dan review-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        
        <div class="modal-body">
        <form method="POST" action="" class="form-group" >

            <h5 class="mb-4">[nama produk]</h5> <hr>
            <img src="" alt="">

            <div class="form-group">
            <label for="">Bagaimana kualitas produk ini secara keseluruhan?</label>
                <div class="stars" data-rating="0">
                <span class="star">&nbsp;</span>
                <span class="star">&nbsp;</span>
                <span class="star">&nbsp;</span>
                <span class="star">&nbsp;</span>
                <span class="star">&nbsp;</span>
            </div>
            </div>

            <div class="form-group">
                <label for="">Berikan ulasan untuk produk ini</label>
                <textarea value="" class="form-control" name="" id="" rows="3" placeholder="Tulis deskripsi Anda mengenai produk ini"></textarea>
            </div>

            <div class="form-group">
                <label for="">Bagikan foto produk yang Anda terima</label>
                <div class="input-group mb-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile02">
                    <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text" id="">Upload</span>
                </div>
            </div>

            </div>
            </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary">Kirim Ulasan</button>
        </div>
    </div>
    </div>
    </div>
    <!--End Modal untuk rating dan review-->

    <?php
    include_once('justfooter.php')
     ?>
   
  <!-- script utk rating atau stars -->
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

        //initial setup
        document.addEventListener('DOMContentLoaded', function(){
            let stars = document.querySelectorAll('.star');
            stars.forEach(function(star){
                star.addEventListener('click', setRating); 
            });
            
            let rating = parseInt(document.querySelector('.stars').getAttribute('data-rating'));
            let target = stars[rating - 1];
            target.dispatchEvent(new MouseEvent('click'));
        });

        function setRating(ev){
            let span = ev.currentTarget;
            let stars = document.querySelectorAll('.star');
            let match = false;
            let num = 0;
            stars.forEach(function(star, index){
                if(match){
                    star.classList.remove('rated');
                }else{
                    star.classList.add('rated');
                }
                //are we currently looking at the span that was clicked
                if(star === span){
                    match = true;
                    num = index + 1;
                }
            });
            document.querySelector('.stars').setAttribute('data-rating', num);
        }
        
    </script>
</body>
</html>