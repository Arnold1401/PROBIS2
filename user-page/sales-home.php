<?php
require_once("head.php");
include("conn.php");

$id=$_SESSION["id_sales"];





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
                <li class="nav-item active"><a href="#" class="nav-link">Pesanan</a></li>
                <li class="nav-item "><a href="sales-penagihan.php" class="nav-link">Penagihan</a></li>
                <!-- <li class="nav-item"><a href="sales-listcustomer.php" class="nav-link">List CustomerKu</a></li> -->
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if(isset($_SESSION["nama_user"])){ echo $_SESSION["nama_user"];}?></a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                    <a class="dropdown-item" href="sales-riwayatpenagihan.php">Riwayat Penagihan</a>
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

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_2.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">         	
            <h1 class="mb-0 bread">DAFTAR PESANAN</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- cart -->
    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                    <div class="form-group">                    
                      <small id="helpId" class="text-muted">*Tombol Sampai Tujuan -- Mengubah status order barang jika barang telah sampai di tujuan</small><br>
                      <small id="helpId" class="text-muted">*Tombol Detail -- Melihat detail barang yang dipesan oleh pelanggan</small>
                    </div>
                        <div class="table-responsive" id="example"> </div><!-- end of class responsive -->
                        
                    </div> <!-- end of card list -->
                </div> <!-- end of col-md-12 ftco-animate -->
                </div> <!-- end of row -->

                
                <div class="row my-4">              
                    <div class="col-md-12 ftco-animate" >
                    <div class="card">
                        <div class="card-header" >
                            <strong class="card-title">Detail Barang #<span id="idhjual"> </span></strong>
                        </div>
                    </div>
                    <div class="card-body text-dark" >    
                        <div class="row">
                            <div class="col-md-6">
                            <h6>Nama Pembeli</h6>
                            <h6 id="namapemilik"></h6>
                            <br>
                            <h6>Nomor Telepon</h6>
                            <h6 id="nomorpemilik"></h6>
                            <br>
                            </div>
                            <div class="col-md-6">
                            <h6>Alamat kirim</h6>
                            <h6 id="alamatpemilik"></h6>                               
                            </div>
                        </div>
                        <div class="table-responsive" id="details">
                        </div>
                    </div>
                    </div> <!-- end of col-md -->
                </div> <!-- end of row -->
        </div> <!-- end of container -->
    </section>
    <!-- end cart -->

    <!-- Modal untuk detail order -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">[No Order]</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    <!--end Modal -->

    <?php
    include_once('justfooter.php');
     ?>
     
   <script>
    var $id = "<?php if(isset($_SESSION["id_sales"])){ echo $_SESSION["id_sales"];}?>";
    $(document).ready(function () {
        var link= "tabelhome.php?id="+$id;
        $("#example").load(link);
    });
    

    

    
 



    function keluar(){
        $.post("ajaxs/ajaxlogin.php",
        {
            jenis:"keluar",
        },
        function(data){
            window.location.href="login.php";
        });
    }

   /* function CekTglExpireSemuaBarang(){
        $.post("ajaxs/ajaxexpire.php",{
            jenis:"CekTglExpireSemuaBarang",
            CurrentDate:moment(new Date()).format("YYYY-MM-DD"),
            },
            function(data){
                console.log(data);
                $('#example').DataTable().ajax.reload(); //reload ajax datatable 
            })
        }
        function sisa_waktu_pelunasan() {
        $.post("ajaxreseller.php",{
            jenis:"cek_sisa_waktupelunasan",
            CurrentDate:moment(new Date()).format("YYYY-MM-DD"),
            },
            function(data){
                console.log(data);
                
            })
        }
        CekTglExpireSemuaBarang();
        sisa_waktu_pelunasan();*/
</script>
</body>
</html>