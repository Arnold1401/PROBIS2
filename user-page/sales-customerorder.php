<?php
require_once("head.php");
?>

<!DOCTYPE html>
<html>
<head>
   <style>
   #table thead th{
    background-color:green;
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
                <li class="nav-item active"><a href="sales-home.php" class="nav-link">Beranda</a></li>
               
                <li class="nav-item"><a href="sales-listcustomer.php" class="nav-link">List CustomerKu</a></li>
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

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_2.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">         	
            <h1 class="mb-0 bread">ORDER SAYA</h1>

          </div>
        </div>
      </div>
    </div>

    <!-- cart -->
    <section class="ftco-section ftco-cart">
        <div class="container">
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                <div class="col-md-12">
                        <div class="card">

                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">List Customer</strong>
                            </div>
                            <div class="card-body">

                            <div class="form-group">
                                <small>*Status Menunggu - data user belum dicek/diperiksa</small><br>
                              <small>*Status Valid - data user sesuai</small><br>
                              <small>*Status Tidak Valid - data user tidak sesuai</small><br>
                            </div>
                              
                              <div class="table-responsive">
                              <table id="tableusers" class="table table-striped table-bordered table-dark" width="100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#ID customer</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Nama Pemilik</th>
                                            <th>No Telepon</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                              </div>
                                
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
        </div>
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
    include_once('justfooter.php')
     ?>

</body>


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

    //document ready
    $(document).ready(function () {
        var tableuser="";

        //datatable di list user
        tableuser = $('#tableusers').DataTable( 
        {
             "buttons": [ 'copy', 'excel', 'pdf' ],
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
                 "url":"datatable_users.php", //nanti diganti dengan di search berdasarkan id sales yg lagi login sekarang
                 "type":"POST"
             },
             "deferRender":true,
             "aLengthMenu":[[10,20,50],[10,20,50]], //combobox limit
             "columns":[ 
                {"data":"id_cust"},               
                {"data":"nama_perusahaan"},                         
                {"data":"nama_pemilik"},
                {"data":"notelp"},
                {"data":"status",
                    "searchable": false,
                    "orderable":false,
                    "render": function (data, type, row) {  
                        if (row.status == '1') {
                            return "<button type='button' id=\"Lihat_Order\"  style='color:white;' class='btn btn-outline-success'>Lihat Ordernya</button>";
                                
                            
                        }
                        else if (row.status == '0' || row.status == '2') {
                            return "<button type='button' id=\"GetDetail\" class='btn btn-outline-info btn-sm'>Detail</button>";
                        }
                        
                    },
                    "target":-1,
                },
                
                          
             ],
        } );

    });
    //end of document ready
</script>
</html>