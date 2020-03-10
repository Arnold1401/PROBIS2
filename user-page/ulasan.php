<?php
require_once("head.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <title>Star Rating System</title>
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
                <li class="nav-item"><a href="home.php" class="nav-link">Home</a></li>
               
                <li class="nav-item"><a href="produk.php" class="nav-link">Produk</a></li>
                <li class="nav-item cta cta-colored"><a href="cart.php" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">[nama Toko/Perusahaan]</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                    <a class="dropdown-item" href="wishlist.php">Daftar Keinginan</a>
                    <a class="dropdown-item" href="status-order.php">Status Order</a>
                    <a class="dropdown-item" href="riwayat-trans.php">Riwayat Order</a>
                    <a class="dropdown-item" href="piutang.php">Piutang</a>
                    <a class="dropdown-item" href="ulasan.php">Ulasan</a>
                    <hr>
                    <a class="dropdown-item" href="pengaturan.php">Akun Saya</a>
                    <a class="dropdown-item" href="index.php">Keluar</a>
                </div>
                </li>
            </ul>
        </div>
    </div>
    </nav>
    <!-- END nav -->

    <section class="ftco-section contact-section bg-light ">
        <div class="container">
            <div class="row block-9 justify-content-center">
                <div class="col-md-12 d-flex">
                    <div class="row my-2 col-12 pb-5 mx-0 px-0">

                        <!-- tabs -->
                        <div class="col-sm-12 col-12 col-lg-3 p-0 ">
                            <div class="nav nav-pills flex-column flex-sm-row nav-justified col-12 p-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">                   
                                <a class="col-lg-12 flex-sm-fill text-sm-center nav-link btn-outline-success active" id="v-pills-all-tab" data-toggle="pill" href="#v-pills-all" role="tab" aria-controls="v-pills-all" aria-selected="false">Ulasan Saya</a>
                                <a class="col-lg-12 flex-sm-fill text-sm-center nav-link btn-outline-success" id="v-pills-sports-tab" data-toggle="pill" href="#v-pills-sports" role="tab" aria-controls="v-pills-sports" aria-selected="false">Riwayat Ulasan</a>
                            </div>
                        </div>
                         <!-- end tabs -->

                         <!-- Pengaturan Akun dan password -->
                        <div class="tab-content col-12 col-lg-9 py-1 px-1" id="v-pills-tabContent">                                                       
                            <div class="tab-pane fade show active bg-white p-3 contact-form" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-all-tab">
                                
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
                                   
                                    <button type="button" class="btn btn-outline-success">Kirim</button>
                                    <button type="button" class="btn btn-outline-danger">Batal</button>
                                </form>
                            </div>

                            <div class="tab-pane fade bg-white p-3 contact-form" id="v-pills-sports" role="tabpanel" aria-labelledby="v-pills-sports-tab">
                                <h4 class="mb-4">Pengaturan Profil</h4> <hr>
                                <form method="POST" action="" class="form-group" >
                                    <div class="alert alert-warning" role="alert">
                                    Data anda belum diverivikasi oleh Admin. Silakan menunggu 2-3 hari kerja.
                                    Notifikasi ini hanya akan mucul jika data belum diverifikasi.
                                    </div>

                                    <div class="alert alert-success" role="alert">
                                    Anda telah terverifikasi. Notifikasi ini muncul jika admin telah memverifikasi data anda
                                </div>

                                    <div class="form-group">        
                                        <h5 for="">Profil Usaha</h5>
                                        <small id="helpId" class="form-text text-muted">Nama Perusahaan/Toko</small>                            
                                        <input value="emos"  type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="emos">  
                                    </div>
                                    <hr>

                                    <div class="form-group">
                                        <h5 for="">Profil Pemilik</h5>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile02">
                                            <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="">Upload</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                <small id="helpId" class="form-text text-muted">Nama Pemilik</small>
                                <input value="Alfira Jessica" type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Nama Pemilik">                               
                                </div>

                                <div class="form-group">
                                <small id="helpId" class="form-text text-muted">Nomor KTP Anda</small>              
                                <input value="1234567891023456" type="number" class="form-control" name="" id="" placeholder="Nomor KTP">                               
                                </div>

                                <div class="form-group">
                                <small id="helpId" class="form-text text-muted">Nomor Telpon Anda</small>              
                                <input value="082288569879" type="number" class="form-control" name="" id="" placeholder="Nomor Telpon">                        
                                </div>

                                <div class="form-group">
                                <small id="helpId" class="form-text text-muted">Tanggal/Bulan/Tahun Lahir Anda</small>
                                <input type="date" class="form-control" id="" name="bdaytime">                        
                                </div>

                                <div class="form-group">
                                <small id="helpId" class="form-text text-muted">Jenis Kelamin</small>
                                <select class="form-control" name="" id="">
                                <option>Wanita</option>
                                <option>Pria</option>                   
                                </select>                               
                                </div>

                                <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea value="Jl bratang binangun I" class="form-control" name="" id="" rows="3"></textarea>
                                </div>
                           
                                <button type="button" class="btn btn-outline-success">Simpan Perubahan</button>                      
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    include_once('justfooter.php')
     ?>
   
    <!-- script utk rating atau stars -->
    <script>
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