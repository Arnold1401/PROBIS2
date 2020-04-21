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
            <h1 class="mb-0 bread">ORDER SAYA</h1>

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
                            <small id="helpId" class="text-muted">*Pilih No order untuk melihat detail order Anda</small>
                        </div>
                        
                        <ul id="filter">
                            <li class="btn"> <label class="font-weight-bold"> Filter Status > </label> </li>
                            <li class="btn"><a href="#" data-value="" active>Semua</a></li>
                            <li class="btn"><a href="#" data-value="Proses">Proses</a></li>
                            <li class="btn"><a href="#" data-value="Pengiriman">Pengiriman</a></li>
                            <li class="btn"><a href="#" data-value="Sampai Tujuan">Sampai Tujuan</a></li>
                            <li class="btn"><a href="#" data-value="Selesai">Selesai</a></li>
                            <li class="btn"><a href="#" data-value="Piutang">Piutang</a></li>
                        </ul>
                        
                        <div class="table-responsive" id="tableall">
                            <table id="tableusers" class="table table-striped table-bordered" width="100%">
                                <!-- <input type="text" name="datefilter" id="filterdate" value="" /> -->
                                <thead>
                                    <tr>
                                        <th>No Order</th>
                                        <th>Tanggal Order</th>
                                        <th>Kurir</th>
                                        <th>Sales</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>    <!-- end table responsive -->
                    </div> <!-- end cardlist -->
                </div> <!-- end ftco-animate -->
            </div> <!-- end row -->
        </div> <!-- end container -->
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

<script>
    var idcust = "<?php if(isset($_SESSION["idcust"])){ echo $_SESSION["idcust"];}?>";
    console.log(idcust);
    
    function keluar(){
        $.post("ajaxs/ajaxlogin.php",
        {
            jenis:"keluar",
        },
        function(data){
            window.location.href="login.php";
        });
    }

    $(document).ready(function () {
        //datatable di list user
        tableuser = $('#tableusers').DataTable( 
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
                 "url":"datatables/datatable_orderall.php", //nanti diganti dengan di search berdasarkan id sales yg lagi login sekarang
                 "type":"POST",
                 "data":{"idcust":idcust},
             },
             "deferRender":true,
             "aLengthMenu":[[10,20,50],[10,20,50]], //combobox limit
             "columns":[ 
                {"data":"id_hjual"},               
                {"data":"tanggal", render: $.fn.dataTable.render.moment( 'DD-MMMM-YYYY' )},                         
                {"data":"kurir"},
                {"data":"id_sales"},
                {"data":"grandtotal", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' )},
                {"data":"status_order",
                    "searchable": true,
                    "orderable":true,
                    "render": function (data, type, row) {  
                        if (row.status_order == 'Proses') //proses
                        {
                            return "<label class='text-success'>Proses</label>";
                        }
                        else if (row.status_order == 'Pengiriman') //pengriman
                        {
                            return "<label class='text-warning'>Pengiriman</label>";
                        }
                        else if (row.status_order == 'Selesai') //selesai
                        {
                            return "<label class='text-info'>Selesai</label>";
                        }
                        else if (row.status_order == 'Piutang') //piutang
                        {
                            return "<label class='text-danger'>Piutang</label>";
                        }
                        
                    },
                    "target":-1,
                },
            
             ],
        } );

        

        var table = $('#tableusers').DataTable();
        $('#filter').on( 'click', 'a', function () {
            console.log($(this).data("value"));
            table.search( $(this).data("value")).draw();

            if ($(this).data("value") == "") {
                $('#tableusers').DataTable().ajax.reload(); //reload ajax datatable 
            }
        } );

      
    });
</script>
</body>
</html>