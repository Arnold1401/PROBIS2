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
                    <a class="dropdown-item active" href="status-order.php">Daftar Pesanan</a>
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

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">         	
            <h1 class="mb-0 bread">PESANAN SAYA</h1>

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
                        <div class="form-group">                    
                            <small id="helpId" class="text-muted">*Tombol Detail - melihat detail barang yang dibeli</small><br>
                            <small id="helpId" class="text-muted">*Tombol Selesai - konfirmasi order Anda bahwa orderan telah selesai</small>
                        </div>
                        
                        <ul id="filter">
                            <li class="btn"> <label class="font-weight-bold"> Filter Status > </label> </li>
                            <li class="btn"><a href="#tableall" data-value="" active>Semua</a></li>
                            <li class="btn"><a href="#tableall" data-value="Proses">Proses</a></li>
                            <li class="btn"><a href="#tableall" data-value="Pengiriman">Pengiriman</a></li>
                            <li class="btn"><a href="#tableall" data-value="Sampai Tujuan">Sampai Tujuan</a></li>
                            <li class="btn"><a href="#tableall" data-value="Selesai">Selesai</a></li>
                            <li class="btn"><a href="#tableall" data-value="Batal">Batal</a></li>
                        </ul>
                        
                        <div class="table-responsive" >
                            <table id="tableorders" class="table table-striped table-bordered text-dark" width="100%">
                                <!-- <input type="text" name="datefilter" id="filterdate" value="" /> -->
                                <thead>
                                    <tr>
                                        <th>No Pesanan</th>
                                        <th>Tanggal Pesanan</th>
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
            
            <div class="row my-4"  >
                    <div class="col-md-12" id="detailbarang">
                        <div class="card" >
                            <div class="card-header" >
                                <strong class="card-title">Detail Barang #<span id="idhjual"> </span></strong>
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
                              <div class="table-responsive" id="table_detail">
                                <table id="tabledetailorder" class="table table-striped table-bordered text-dark" width="100%">
                                        <!-- <input type="text" name="datefilter" id="filterdate" value="" /> -->
                                    <thead>
                                        <tr >
                                            <th>Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah Beli</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" style="text-align:right; font-weight:bold">Total:</th>
                                            <th style="font-weight:bold"></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" style="text-align:right; font-weight:bold">Biaya Pengiriman :</th>
                                            <th style="font-weight:bold" id="Ongkir"></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" style="text-align:right; font-weight:bold">Total :</th>
                                            <th style="font-weight:bold" id="totalsemua"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>    <!-- end table responsive -->
                            </div>
                        </div>
                    </div>
                </div>
        </div> <!-- end container -->
    </section>
    <!-- end cart -->

    <!--Modal untuk rating dan review-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        
        <div class="modal-body">
        <form method="POST" action="" class="form-group" >

            <h5 class="mb-4" id="nama_produkdiulas"></h5>
            <h6 class="mb-4" id="id_barangdiulas"></h6><hr>
            <img src="" alt="">

            <div class="form-group">
            <label for="">Bagaimana kualitas produk ini secara keseluruhan?</label>
                <div class="stars" data-rating="0">
                    <span class="star" data-rating="1">&nbsp;</span>
                    <span class="star" data-rating="2">&nbsp;</span>
                    <span class="star" data-rating="3">&nbsp;</span>
                    <span class="star" data-rating="4">&nbsp;</span>
                    <span class="star" data-rating="5">&nbsp;</span>
                </div>
            </div>

            <div class="form-group">
                <label for="">Berikan ulasan untuk produk ini</label>
                <textarea value="" class="form-control" name="" id="isiUlasan" rows="3" placeholder="Tulis deskripsi Anda mengenai produk ini"></textarea>
                <label class="col-form-label text-danger" id="warning"></label>
            </div>

            </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="button" id="kirimulasansaya" class="btn btn-primary">Kirim Ulasan</button>
        </div>
    </div>
    </div>
    </div>
    <!--End Modal untuk rating dan review-->

    
    <!-- modal untuk summary midtrans -->
    <!--<div class="modal fade bd-example-modal-lg" id="DetailHutang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Tagihan <span id="idhjualhutang">[id hjual]</span> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body " id="isisum">
                    <div class="form-group">
                        <h5 id="jatuhtempohutang"> Jatuh Tempo : </h5>
                        <h5>Total Tagihan <span> <h4 class="text-right font-weight-bold">Rp[total]</h4> </span></h5>
                        <hr>
                       
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link" id="nav-detailkirim-tab" data-toggle="tab" href="#nav-detailkirim" role="tab" aria-controls="nav-ulasan" aria-selected="false">Detail Pengiriman</a>
                            </div>
                        </nav>
                        <div class="tab-content my-4" id="nav-tabContent">
                            
                            <div class="tab-pane fade show" id="nav-detailkirim" role="tabpanel" aria-labelledby="nav-detailkirim-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Nama</h6>
                                        <h6 class="namapemilik"></h6>
                                        <br>
                                        <h6>Nomor Telepon</h6>
                                        <h6 class="nomorpemilik"></h6>
                                        <br>
                                        <h6>Email</h6>
                                        <h6 class="emailpemilik"></h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Alamat kirim</h6>
                                        <h6 class="alamatpemilik">[alamat toko]</h6>
                                        <br>
                                        <h6>Status Pesanan Sekarang</h6>
                                        <h6 class="alamatpemilik">[alamat toko]</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="" class="btn btn-outline-success">Selanjutnya</button> 
                </div>
            </div>
        </div>
    </div> -->
    <!-- end of modal untuk summary midtrans -->

    <?php
    include_once('justfooter.php')
     ?>

<script>
    var idcust = "<?php if(isset($_SESSION["idcust"])){ echo $_SESSION["idcust"];}?>";
    var emailcust = "<?php if(isset($_SESSION["email_user"])){ echo $_SESSION["email_user"];}?>";
   // console.log(idcust);
    var idbarangutkdiulas, iddjualulas;

    //button kirim ulasan di modal
    function kirimulasansaya() {
        var isiulasan = document.getElementById("isiUlasan").value;

         if (isiulasan == "") {
             $('#warning').html("Ulasan belum terisi");
         }
         else if (isiulasan != ""){
             $('#warning').html("");
             $.post("ajaxreseller.php",{
             jenis:"kirim_ulasan",
             idbarang : idbarangutkdiulas,
             idcust : idcust,
             rating : parseInt(document.querySelector('.stars').getAttribute('data-rating')),
             isiulasan :isiulasan,
             iddjualulas:iddjualulas,
             },
             function(data){
                 alert(data);
                 $('#tableorders').DataTable().ajax.reload(); //reload ajax datatable 
                 document.getElementById("isiUlasan").value = "";
                 document.querySelector('.stars').getAttribute('data-rating').value = "0";
             })
         }
        
    }
    //end of button kirim ulasan di modal

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

    //document ready
    $(document).ready(function () {

        //call event button kirim ulasan di modal
        $('#kirimulasansaya').click( function () {
            kirimulasansaya();
            $('#tabledetailorder').DataTable().ajax.reload(); //reload ajax datatable 
        });
        // end of call event button kirim ulasan di modal

        var tableuser="";

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
                 "url":"datatables/datatable_orderall.php", 
                 "type":"POST",
                 "data":{"idcust":idcust},
             },
             "deferRender":true,
             "aLengthMenu":[[10,20,50],[10,20,50]], //combobox limit
             "columns":[ 
                {"data":"id_hjual"},               
                {"data":"tanggal_order", render: $.fn.dataTable.render.moment( 'DD-MMMM-YYYY' )},                         
                {"data":"kurir"},
                {"data":"nama_sales"},
                {"data":"grandtotal", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' )},
                {"data":"status_order",
                    "searchable": true,
                    "orderable":true,
                    "render": function (data, type, row) {  
                        if (row.status_order == 'Proses') //proses
                        {
                            return "<label class='text-success font-weight-bold'>Proses</label> ";
                        }
                        else if (row.status_order == 'Pengiriman') //pengriman
                        {
                            return "<label class='text-warning font-weight-bold'>Pengiriman</label>";
                        }
                        else if (row.status_order == 'Sampai Tujuan') //piutang
                        {
                            return "<label class='text-info font-weight-bold'>Barang telah tiba</label>";
                        }
                        else if (row.status_order == 'Selesai') //selesai
                        {
                            return "<label class='text-info font-weight-bold'>Selesai</label> <br>"+
                            "<small> Diterima : " + moment(row.tanggal_orderselesai).format("DD-MMMM-YYYY") + " </small>";
                        }
                        else if (row.status_order == 'Batal') //hutang
                        {
                            return "<label class='text-danger font-weight-bold'>Batal</label>";
                        }
                        
                    },
                    "target":-1,
                },
                {"data":"status_order",
                    "searchable": true,
                    "orderable":true,
                    "render": function (data, type, row) {  
                        if (row.status_order == 'Proses') //proses
                        {
                            return "<a id=\"GetDetail\" class='btn btn-info text-dark' href='#detailbarang'>Detail</a>  "+"<a id=\"GetKonfirmasi\" class='btn btn-primary text-dark disabled'>Selesai</a>";
                        }
                        else if (row.status_order == 'Pengiriman') //pengriman
                        {
                            return "<a id=\"GetDetail\" class='btn btn-info text-dark' href='#detailbarang'>Detail</a>  "+"<a id=\"GetKonfirmasi\" class='btn btn-primary text-dark disabled'>Selesai</a>";
                        }
                        else if (row.status_order == 'Sampai Tujuan') //piutang
                        {
                            return "<a id=\"GetDetail\" class='btn btn-info text-dark' href='#detailbarang'>Detail</a>  "+"<a id=\"GetKonfirmasi\" class='btn btn-primary text-dark'>Selesai</a>";
                        }
                        else if (row.status_order == 'Selesai') //selesai
                        {
                            return "<a id=\"GetDetail\" class='btn btn-info text-dark' href='#detailbarang'>Detail</a>  "+"<a id=\"GetKonfirmasi\" class='btn btn-primary text-dark disabled'>Selesai</a>";
                        }
                        else if (row.status_order == 'Batal') //Batal
                        {
                            return "<a id=\"GetDetail\" class='btn btn-info text-dark' '>Detail</a>  ";
                        }
                        
                    },
                    "target":-1,
                },
                
             ],
        } );
        //end of datatable di list order -- semua order yang pernah ada atau yang sedang jalan 

        //event jika list order dipilih/diclick 
        $('#tableorders tbody').on('click', 'tr', function () {
            $(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
        } );
        //end of event jika list order dipilih/diclick 

        
        var getId,tabledetail, data="";

        //jika button di list orders dipilih/ditekan
        $('#tableorders tbody').on( 'click', 'a', function () {
            var action = this.id;
            data = tableuser.row($(this).closest('tr')).data();

            //action button Detail -- menampilkan detail order barang yang dibeli di bagian table bawah
            if(action == 'GetDetail')
            {
                getId = data[Object.keys(data)[0]]; //idhjual
                getIdAlamat = data[Object.keys(data)[5]]; //id alamat pengiriman
                var tr = $(this).closest('tr');

                //table detail order barang dibagian bawah
                tabledetail = $('#tabledetailorder').DataTable( {
                    // retrieve: true,
                    destroy: true, //destroy dulu biar ngerefresh pas ganti2 
                      "buttons": [ 'copy', 'excel', 'pdf' ],
                      "processing":true,
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
                      "serverSide":true,
                      "ordering":true, //set true agar bisa di sorting
                      "order":[[0, 'asc']], //default sortingnya berdasarkan kolom, field ke 0 paling pertama
                      "ajax":{
                          "url":"datatables/datatable_detailorder.php",
                          "type":"POST",
                          "data":{"get_id":getId},
                      },
                      "deferRender":true,
                      "aLengthMenu":[[10,20,50],[10,20,50]], //combobox limit
                      "columns":[
                          {"data":"id_djual"},
                          {"data":"nama_barang"},
                          {"data":"kuantiti"},                         
                          {"data":"subtotal", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' )},
                          {"data":"status_order",
                            "searchable": true,
                            "orderable":true,
                            "render": function (data, type, row) {  
                                if (row.status_order == 'Proses') //proses
                                {
                                    return null;
                                }
                                else if (row.status_order == 'Pengiriman') //pengriman
                                {
                                    return null;
                                }
                                else if (row.status_order == 'Sampai Tujuan') //piutang
                                {
                                    return null;
                                }
                                else if (row.status_order == 'Hutang') //Hutang
                                {
                                    return null;
                                }
                                else if (row.status_order == 'Selesai') //selesai
                                {
                                    if (row.id_ulasan == "0") {
                                        return "<a id=\"GiveUlasan\" class='btn btn-outline-primary text-dark' data-toggle='modal' data-target='#myModal'>Beri Ulasan</a>";
                                    }
                                    else if (row.id_ulasan != "0") {
                                        return "<a class='btn btn-outline-primary text-dark' href='ulasan.php'>Lihat Ulasan</a>";
                                    }
                                    
                                }
                                // else if (row.status_order == '') //selesai
                                // {
                                //     if (row.id_ulasan == "0") {
                                //         return "<a id=\"GiveUlasan\" class='btn btn-outline-primary text-dark' data-toggle='modal' data-target='#myModal'>Beri Ulasan</a>";
                                //     }
                                //     else if (row.id_ulasan != "0") {
                                //         return "<a class='btn btn-outline-primary text-dark' href='ulasan.php'>Lihat Ulasan</a>";
                                //     }
                                    
                                // }
                                        
                            },
                            "target":-1,
                        },
                      ],                      
                      "footerCallback": function ( row, data, start, end, display ) {
                            var api = this.api(), data;
                          
                            //Remove the formatting to get integer data for summation
                            var intVal = function ( i ) {
                                return typeof i === 'string' ?
                                    i.replace(/[\$,]/g, '')*1 :
                                    typeof i === 'number' ?
                                        i : 0;
                            };
            
                            // Total over all pages
                            total = api
                                .column( 3 )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
                
                            // Total over this page
                            pageTotal = api
                                .column( 3, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
            
                            // Update footer
                            $( api.column( 3 ).footer() ).html(
                                $.fn.dataTable.render.number('.','.','2','Rp').display(total)
                            );
                            var ongkir = getTotal - total;
                            $("#Ongkir").html(
                                $.fn.dataTable.render.number('.','.','2','Rp').display(ongkir)
                            );
                            $("#totalsemua").html(
                                $.fn.dataTable.render.number('.','.','2','Rp').display(getTotal)
                            );
                        }
                } );
                //end of table detail order barang dibagian bawah

                //dapatkan data customernya
                $("#idhjual").html(getId);
                //DETAIL CUSTOMERNYA -- nama notelp
                $.post("ajaxreseller.php",{
                    jenis:"get_detail_customerHutang",
                    idcust:idcust,
                },
                function(data){                 
                    $("#namapemilik").html(data[2]);
                    $("#nomorpemilik").html(data[3]);
                });

                //alamat customernya
                $.post("ajaxreseller.php",{
                    jenis:"get_detailalamat_customerHutang",
                    emailcust:emailcust,
                    getIdAlamat:getIdAlamat,
                },
                function(data){                 
                    var provinsi = data[0].split("-");
                    var kota = data[1].split("-");
                    var kec = data[2].split("-");
                    var alamat = data[3] + ", <br>" + kec[1] + ", <br>" + kota[1] + ", <br>"+ provinsi[1] ;
                    $("#alamatpemilik").html(alamat);
                });
                //end of dapatkan data customernya
            }
            //end of action button Detail

            //action button selesai - konfirmasi orderan di table list order
            if (action == 'GetKonfirmasi') {
                $.post("ajaxreseller.php",{
                    jenis:"konfirmasi_orderan_selesai",
                    getId : data[Object.keys(data)[0]], //id barang
                },
                function(data){
                    alert(data);
                    $('#tabledetailorder').DataTable().ajax.reload(); //reload ajax datatable 
                    $('#tableorders').DataTable().ajax.reload(); //reload ajax datatable 
                });
            }
            //end of action button selesai - konfirmasi orderan selesai


        } );
        //end of jika button di list orders dipilih/ditekan

        var getIdBarang, dataget="";

        //jika button pada detail order diklik/dipilih
        $('#tabledetailorder tbody').on( 'click', 'a', function () {
            var action = this.id;
            dataget = tabledetail.row($(this).closest('tr')).data();

            getIdBarang = dataget[Object.keys(dataget)[2]]; //get Id barang
            iddjualulas = dataget[Object.keys(dataget)[1]]; //get Id djual

            function getnamabarang(){
                $.post("ajaxreseller.php",{
                    jenis:"get_nama_barang",
                    getIdBarang:dataget[Object.keys(dataget)[2]], //get Id barang
                },
                function(data){                 
                    $("#nama_produkdiulas").html(data);
                    idbarangutkdiulas=getIdBarang;               
                });
            }

            //action button beri ulasan
            if (action == 'GiveUlasan') {
                getnamabarang();
            }
            //end of action button beri ulasan

        });
        //end of jika button pada detail order diklik/dipilih
        
        //filter list order berdasarkan status yang dpilih
        var table = $('#tableorders').DataTable();
        $('#filter').on( 'click', 'a', function () {
            console.log($(this).data("value"));
            table.search( $(this).data("value")).draw();
           // 
            if ($(this).data("value") == "") {
                $('#tableorders').DataTable().ajax.reload(); //reload ajax datatable 
               
            }
            $('#tabledetailorder').empty();
        } );
        //end of filter list order berdasarkan status yang dpilih
    });

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


    refreshstatus();
    function refreshstatus(){
        $.post("ajaxs/ajaxbackexec.php", {
                    jenis: "refreshpembayaran",
                },
                function(data) {
                    console.log(data);
            });
    }

    //----------------end of stars rating ----------------------------------//
</script>
</body>
</html>