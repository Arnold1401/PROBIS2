<?php
require_once("head.php");
?>

<!DOCTYPE html>
<html>
<head>
<style>
        .star{
          color: goldenrod;
          font-size: 1.5rem;
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
            font-size: 1.0rem;
            font-weight: 900;
        }
        .star.rated{
            counter-increment: rateme 1;
        }
        .stars::after{
            content: counter(rateme) '/5';
        }
        .text-wrap{
    white-space:normal;
}
.width-200{
    width:200px;
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
                <li class="nav-item"><a href="home.php" class="nav-link">Beranda</a></li>
               
                <li class="nav-item"><a href="produk.php" class="nav-link">Produk</a></li>
                <li class="nav-item">
                    <a href="cart.php" class="nav-link"><span class="icon-shopping_cart"></span>[<?php if (isset($_SESSION["keranjang"])) {
        $arrkeranjang=unserialize($_SESSION["keranjang"]);
        $count=count($arrkeranjang);
        echo $count;
    }else{
        echo 0;
    }
 ?>]</a></li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if(isset($_SESSION["nama_perusahaan"])){ echo $_SESSION["nama_perusahaan"];}?></a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                    <a class="dropdown-item" href="wishlist.php">Daftar Keinginan</a>
                    <a class="dropdown-item" href="status-order.php">Daftar Pesanan</a>
                    <a class="dropdown-item" href="tagihan.php">Tagihan</a>
                    <a class="dropdown-item active" href="ulasan.php">Ulasan</a>
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

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">         	
            <h1 class="mb-0 bread">ULASAN SAYA</h1>

          </div>
        </div>
      </div>
    </div>

    <!-- cart -->
    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row" id="tableall">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list" >
                        
                        
                        <div class="table-responsive" >
                            <table id="table_ulasan" class="table table-striped table-bordered text-dark"  width="100%">
                                <thead>
                                    <tr>
                                        <th>Produk diulas</th>
                                        <th>Rating</th>
                                        <th>Review</th>
                                    </tr>
                                </thead>
                                <tbody style="word-wrap: break-word;min-width: 160px;max-width: 160px;white-space:normal;">
                                </tbody>
                            </table>
                        </div>    <!-- end table responsive -->
                    </div> <!-- end cardlist -->
                </div> <!-- end ftco-animate -->
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end cart -->

    
    <?php
    include_once('justfooter.php')
     ?>

<script>
    var idcust = "<?php if(isset($_SESSION["idcust"])){ echo $_SESSION["idcust"];}?>";

    //logout
    function keluar(){
        $.post("ajaxs/ajaxlogin.php",
        {
            jenis:"keluar",
        },
        function(data){
            window.location.href="login.php";
        });
    }
    //end of logout
    
    $(document).ready(function () {
        var table_ulasan="";
        var nilai="";


        //datatable di list order -- semua order yang pernah ada atau yang sedang jalan 
        table_ulasan = $('#table_ulasan').DataTable( 
        {
            
             "responsive":true,
             "language": {
                "lengthMenu": "Tampilkan _MENU_ data per Halaman",
                "zeroRecords": "Maaf Data yang dicari tidak ada",
                "info": "Tampilkan data _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search":"Cari",
                "paginate": {
                    "first":      "Pertama",
                    "last":       "terakhir",
                    "next":       "Selanjutnya",
                    "previous":   "Sebelumnya"
                    },
             },
             "processing":true,
             "serverSide":true,
             "ordering":true, //set true agar bisa di sorting
             "order":[[0, 'asc']], //default sortingnya berdasarkan kolom, field ke 0 paling pertama
             "ajax":{
                 "url":"datatables/datatable_ulasanSaya.php", 
                 "type":"POST",
                 "data":{"idcust":idcust},
             },
             "deferRender":true,
             "aLengthMenu":[[10,20,50],[10,20,50]], //combobox limit
             "columns":[ 
                {"data":"nama_barang"},               
                {"data":"rating",
                    "searchable": true,
                    "orderable":true,
                    "render": function (data, type, row) {  
                        if (row.rating == '1') //proses
                        {
                            return "<div class='stars' data-rating='0'>"+
                                        "<span class='star rated' data-rating='1'>&nbsp;</span>"+
                                        "<span class='star' data-rating='2'>&nbsp;</span>"+
                                        "<span class='star' data-rating='3'>&nbsp;</span>"+
                                        "<span class='star' data-rating='4'>&nbsp;</span>"+
                                        "<span class='star' data-rating='5'>&nbsp;</span>"+
                                    "</div>";
                        }
                        else if (row.rating == '2') //proses
                        {
                            return "<div class='stars' data-rating='0'>"+
                                        "<span class='star rated' data-rating='1'>&nbsp;</span>"+
                                        "<span class='star rated' data-rating='2'>&nbsp;</span>"+
                                        "<span class='star' data-rating='3'>&nbsp;</span>"+
                                        "<span class='star' data-rating='4'>&nbsp;</span>"+
                                        "<span class='star' data-rating='5'>&nbsp;</span>"+
                                    "</div>";
                        }
                        else if (row.rating == '3') //proses
                        {
                            return "<div class='stars' data-rating='0'>"+
                                        "<span class='star rated' data-rating='1'>&nbsp;</span>"+
                                        "<span class='star rated' data-rating='2'>&nbsp;</span>"+
                                        "<span class='star rated' data-rating='3'>&nbsp;</span>"+
                                        "<span class='star' data-rating='4'>&nbsp;</span>"+
                                        "<span class='star' data-rating='5'>&nbsp;</span>"+
                                    "</div>";
                        }
                        else if (row.rating == '4') //proses
                        {
                            return "<div class='stars' data-rating='0'>"+
                                        "<span class='star rated' data-rating='1'>&nbsp;</span>"+
                                        "<span class='star rated' data-rating='2'>&nbsp;</span>"+
                                        "<span class='star rated' data-rating='3'>&nbsp;</span>"+
                                        "<span class='star rated' data-rating='4'>&nbsp;</span>"+
                                        "<span class='star' data-rating='5'>&nbsp;</span>"+
                                    "</div>";
                        }
                        else if (row.rating == '5') //proses
                        {
                            return "<div class='stars' data-rating='0'>"+
                                        "<span class='star rated' data-rating='1'>&nbsp;</span>"+
                                        "<span class='star rated' data-rating='2'>&nbsp;</span>"+
                                        "<span class='star rated' data-rating='3'>&nbsp;</span>"+
                                        "<span class='star rated' data-rating='4'>&nbsp;</span>"+
                                        "<span class='star rated' data-rating='5'>&nbsp;</span>"+
                                    "</div>";
                        }
                        
                    },
                    "target":-1,
                },
                {"data":"isi_review"},
             ],
        } );
        //end of datatable di list order -- semua order yang pernah ada atau yang sedang jalan 

    

        //----------------stars rating ----------------------------------//
        //initial setup
        document.addEventListener('DOMContentLoaded', function(){
            let stars = document.querySelectorAll('.star');
            stars.forEach(function(star){
                star.addEventListener('click', setRating); 
            });
            
            let rating = parseInt(document.querySelector('.stars').getAttribute('data-rating'));
            let target = stars[rating - 1];
            //target.dispatchEvent(new MouseEvent('click'));
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
        //----------------end of stars rating ----------------------------------//
    });

    
        
</script>
</body>
</html>