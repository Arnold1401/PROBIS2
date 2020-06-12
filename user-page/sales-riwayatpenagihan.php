<?php
require_once("head.php");
?>

<!DOCTYPE html>
<html>
<head>
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

        .lightRed {
            background-color: #f0aaaa !important
        }

        .lightyellow{
            background-color: #f5e042;
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
                <li class="nav-item "><a href="sales-home.php" class="nav-link">Pesanan</a></li>
                <li class="nav-item "><a href="sales-penagihan.php" class="nav-link">Penagihan</a></li>
                <!-- <li class="nav-item"><a href="sales-listcustomer.php" class="nav-link">List CustomerKu</a></li> -->
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if(isset($_SESSION["nama_user"])){ echo $_SESSION["nama_user"];}?></a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                    <a class="dropdown-item active" href="#.php">Riwayat Penagihan</a>
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
            <h1 class="mb-0 bread">RIWAYAT PENAGIHAN SAYA</h1>

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
                            <table id="tableorders" class="table table-striped table-bordered text-dark" width="100%">
                                <!-- <input type="text" name="datefilter" id="filterdate" value="" /> -->
                                <thead>
                                    <tr>
                                        <th>Id Hutang</th>
                                        <th>No Pesanan</th>
                                        <th>Tanggal Pelunasan</th>
                                        <th>Total</th>
                                        
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

    
    <?php
    include_once('justfooter.php')
     ?>

<script>
    var idsales = "<?php if(isset($_SESSION["id_sales"])){ echo $_SESSION["id_sales"];}?>";
    var emailcust = "<?php if(isset($_SESSION["email_user"])){ echo $_SESSION["email_user"];}?>";
   // console.log(idcust);
    var idbarangutkdiulas, iddjualulas;
    var getId,tabledetail, data, getIdAlamat="";


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

    function CekTglExpireSemuaBarang(){
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
      
    //document ready
    $(document).ready(function () {
        var tableuser="";
        var sisa_jatuhtempo="";
        CekTglExpireSemuaBarang();
        sisa_waktu_pelunasan();

        //datatable di list order -- semua order yang pernah ada atau yang sedang jalan 
        tableuser = $('#tableorders').DataTable( 
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
                 "url":"datatables/datatable_riwayatpenagihan.php", 
                 "type":"POST",
                 "data":{"idsales":idsales},
             },
             "deferRender":true,
             "aLengthMenu":[[10,20,50],[10,20,50]], //combobox limit
             "columns":[ 
                {"data":"id_piutang"},               
                {"data":"id_hjual"},                         
                {"data":"tanggal_pelunasan", render: $.fn.dataTable.render.moment( 'DD-MMMM-YYYY' )},
                {"data":"sisa_tagihan", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' )},
                
             ],
    
        } );
        //end of datatable di list order -- semua order yang pernah ada atau yang sedang jalan 
        

        //event jika list order dipilih/diclick 
        $('#tableorders tbody').on('click', 'tr', function () {
            $(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
        } );
        //end of event jika list order dipilih/diclick 

        
        
        
    });

    
</script>
</body>
</html>