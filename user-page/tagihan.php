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
                    <a class="dropdown-item" href="status-order.php">Daftar Pesanan</a>
                    <a class="dropdown-item active" href="tagihan.php">Tagihan</a>
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

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_2.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">         	
            <h1 class="mb-0 bread">TAGIHAN SAYA</h1>

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
                            <small id="helpId" class="text-muted">**Tombol Selesaikan Pembayaran - melakukan konfirmasi pembayaran</small><br>
                            <small id="helpId" class="text-muted">***Tombol Bayar Tagihan - melunaskan sisa tagihan</small>
                        </div>
                        
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
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>    <!-- end table responsive -->
                    </div> <!-- end cardlist -->
                </div> <!-- end ftco-animate -->
            </div> <!-- end row -->
            
            <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Detail Barang</strong>
                            </div>
                            <div class="card-body">    
                                <div class="row text-dark">
                                    <div class="col-md-6">
                                        <h6>Nama Pembeli</h6>
                                        <h6 id="nama_pemilik"></h6>
                                        <br>
                                        <h6>Nomor Telepon</h6>
                                        <h6 id="nomor_pemilik"></h6>
                                        <br>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Alamat kirim</h6>
                                        <h6 id="alamat_pemilik"></h6>                               
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
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" style="text-align:right; font-weight:bold">Total Pembelian:</th>
                                            <th style="font-weight:bold"></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" style="text-align:right; font-weight:bold">Biaya Pengiriman :</th>
                                            <th style="font-weight:bold" id="Ongkir"></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" style="text-align:right; font-weight:bold">Grandtotal (Total Pembelian + Biaya Pengiriman) :</th>
                                            <th style="font-weight:bold" id="totalsemua"></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" style="text-align:right; font-weight:bold">Uang muka (15% dari Grandtotal jika pembayaran cicilan) :</th>
                                            <th style="font-weight:bold" id="uangmuka"></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" style="text-align:right; font-weight:bold">Grandtotal - uang muka 15% (Sisa tagihan untuk pembayarn cicilan) : </th>
                                            <th style="font-weight:bold" id="sisatagihanpesanan"></th>
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
        <button type="button" id="kirimulasansaya" class="btn btn-primary">Kirim Ulasan</button>
        </div>
    </div>
    </div>
    </div>
    <!--End Modal untuk rating dan review-->

    
    <!-- modal untuk summary midtrans -->
    <div class="modal fade " id="DetailBayarHutang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span id="ida" style="display:none;">0</span>
                    <h5 class="modal-title">Detail Tagihan #<span id="idhjualhutang">[id hjual]</span> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body " id="isisum">
                    <div class="form-group">
                        <h5 > Jatuh Tempo : <span id="jatuhtempohutang"> </span></h5>
                        <h5>Total Tagihan <span> <h4 class="text-right font-weight-bold" id="tagihan">Rp[total]</h4> </span></h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Nama</h6>
                                <h6 id="namapemilik">[nama yg punya toko]</h6>
                                <br>
                                <h6>Nomor Telepon</h6>
                                <h6 id="nomorpemilik">[Nomor Telepon toko]</h6>
                                <br>
                                
                            </div>
                            <div class="col-md-6">
                                <h6>Alamat kirim</h6>
                                <h6 id="alamatpemilik">[alamat toko]</h6> 
                                <br>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="bayar_sisa_tagihan()" class="btn btn-outline-success">Bayar Sisa Tagihan</button> 
                </div>
            </div>
        </div>
    </div>
    <!-- end of modal untuk summary midtrans -->

    <?php
    include_once('justfooter.php')
     ?>

<script>
    var idcust = "<?php if(isset($_SESSION["idcust"])){ echo $_SESSION["idcust"];}?>";
    var emailcust = "<?php if(isset($_SESSION["email_user"])){ echo $_SESSION["email_user"];}?>";
   // console.log(idcust);
    var idbarangutkdiulas, iddjualulas;
    var getId,tabledetail, data, getIdAlamat="";

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

    //button bayar lunas hutang nya -- dari button bayar tagihan
    function bayar_sisa_tagihan(getId) {
        
        console.log(getId);
    }
    //end of button bayar tagihan

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
        CekTglExpireSemuaBarang();
        sisa_waktu_pelunasan();

        console.log(idcust);
        //call event button kirim ulasan di modal
        $('#kirimulasansaya').click( function () {
            kirimulasansaya();
            $('#tabledetailorder').DataTable().ajax.reload(); //reload ajax datatable 
        });
        // end of call event button kirim ulasan di modal

        //call event button bayar sisa tagihan di modal
        $('#bayar_sisa_tagihan').click( function () {
            bayar_sisa_tagihan();

        });
        // end of call event button bayar sisa tagihan di modal

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
                 "url":"datatables/datatable_tagihanall.php", 
                 "type":"POST",
                 "data":{"idcust":idcust},
             },
             "deferRender":true,
             "aLengthMenu":[[10,20,50],[10,20,50]], //combobox limit
             "columns":[ 
                {"data":"id_hjual"},               
                {"data":"tanggal_order", render: $.fn.dataTable.render.moment('DD-MMMM-YYYY')},                         
                {"data":"kurir"},
                {"data":"nama_sales"},//nama_sales
                {"data":"totalkeselurahan", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' )},
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
                        else if (row.status_order == 'Piutang') //piutang
                        {
                            return "<label class='text-danger font-weight-bold'>Piutang</label>";
                        }   
                        else if (row.status_order == '') //piutang
                        {
                            return "<label class='text-danger font-weight-bold'>..</label>";
                        }                                           
                    },
                    "target":-1,
                },
                {"data":"status_pembayaran",
                    "searchable": true,
                    "orderable":true,
                    "render": function (data, type, row) {  
                        
                        if (row.status_pembayaran == 'Menunggu Pembayaran') //transksi biasa
                        {
                            var id=row.id_hjual;
                            return "<a id=\"GetDetail\" class='btn btn-info text-dark'>Detail</a>  "+
                            "<a class='btn btn-primary text-dark' onclick=\"selesaikan(\'"+id+"\')\" data-toggle='modal' >Selesaikan Pembayaran</a>";
                            // note : functionnya di if(action == "BayarLunas")
                        }
                        else if(row.status_pembayaran == 'Hutang') //transaksi cicilan -- pembayaran pertama
                        {
                            var id=row.id_hjual;
                            return "<a id=\"GetDetail\" class='btn btn-info text-dark'>Detail</a>  "+
                            "<a class='btn btn-primary text-dark'  onclick=\"bayarhutang(\'"+id+"\')\"  data-toggle='modal'  >Selesaikan Pembayaran</a>";
                            // note : functionnya di if(action == "Pembayaran_pertama")
                        }
                        else if(row.status_pembayaran == 'Menunggu Pelunasan') //transaksi cicilan -- status ini muncul ketika sudah terbayar 15%
                        {
                            var id=row.id_hjual;
                            return "<a id=\"GetDetail\" class='btn btn-info text-dark'>Detail</a>  "+
                            "<a class='btn btn-primary text-dark' onclick=\"selesaikanhutang(\'"+id+"\')\" data-toggle='modal'  >Bayar Tagihan</a>";
                            // note : functionnya di if(action == "BayarHutang_Lunas") -- nanti diarahkan ke function bayar_sisa_tagihan
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

        
        
        var getTotal, getUangmuka, temptotal='';
        //jika button di list orders dipilih/ditekan
        $('#tableorders tbody').on( 'click', 'a', function () {
            var action = this.id;
            data = tableuser.row($(this).closest('tr')).data();

            //action button Detail -- menampilkan detail order barang yang dibeli di bagian table bawah
            if(action == 'GetDetail')
            {
                getId = data[Object.keys(data)[0]]; //idhjual
                getIdAlamat = data[Object.keys(data)[5]]; //id alamat pengiriman
                getTotal = data[Object.keys(data)[6]]; //total keseluruhan
                getUangmuka = data[Object.keys(data)[7]]; //field grandtotal - 15% dari total keseluruhan
                console.log(getUangmuka);
                $("#ida").html(getIdAlamat);
                var tr = $(this).closest('tr');

                //dapatkan total pembelian per Id yang dipilih -- utk cek ongkir
                /*$.post("ajaxreseller.php",{
                    jenis:"getTotal",
                    getId:getId,
                },
                function(data){                 
                   // getTotal = data[1];
                    $("#ongkir").html(data[1]);
                   // temptotal = getTotal;
                });             
                console.log(getTotal);*/
                //dapatkan total pembelian per Id yang dipilih -- utk cek ongkir
                

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

                            var ongkir = getTotal - total; //field total keseluruhan - total dari subtotal di tabel
                            $("#Ongkir").html(
                                $.fn.dataTable.render.number('.','.','2','Rp').display(ongkir)
                            );
                            $("#totalsemua").html(
                                $.fn.dataTable.render.number('.','.','2','Rp').display(getTotal)
                            );
                            
                            var sisatag = getTotal - getUangmuka;
                            $("#uangmuka").html(
                                    $.fn.dataTable.render.number('.','.','2','Rp').display(getUangmuka)
                                );

                                $("#sisatagihanpesanan").html(
                                    $.fn.dataTable.render.number('.','.','2','Rp').display(sisatag)
                                );
                           
                        }
                } );
                //end of table detail order barang dibagian bawah

                //DETAIL CUSTOMERNYA -- nama notelp
                $.post("ajaxreseller.php",{
                    jenis:"get_detail_customerHutang",
                    idcust:idcust,
                },
                function(data){                 
                    $("#nama_pemilik").html(data[2]);
                    $("#nomor_pemilik").html(data[3]);
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
                    var alamat = data[3] + ", <br> Kecamatan " + kec[1] + ", <br> Kota " + kota[1] + ", <br> Provinsi "+ provinsi[1] ;
                    $("#alamat_pemilik").html(alamat);
                });
            }
            //end of action button Detail

            //action utk "selesaikan pembayaran" untk transaksi lunas dgn status Menunggu pembayaran
            /*if(action == 'BayarLunas')
            {
                getId = data[Object.keys(data)[0]]; //idhjual
                console.log("bayar lunas");
                //kasih aja notif pembayaran berhasil.. alert
            }
            //end of utk "selesaikan pembayaran" untk transaksi lunas

            //action utk "selesaikan pembayaran" untk transaksi cicilan dgn status hutang
            if(action == 'Pembayaran_pertama')
            {
                getId = data[Object.keys(data)[0]]; //idhjual
                console.log("pembayaran pertama");
                //kasih aja notif pembayaran berhasil.. trus munculin sisa tagihannya terserah lah intinya mek alert tok
            }
            //end of action utk "selesaikan pembayaran" untk transaksi cicilan dgn status hutang

            //action utk "selesaikan pembayaran" untk transaksi cicilan/hutang dgn status menunggu pelunasan
            if(action == 'BayarHutang_Lunas')
            {
                getId = data[Object.keys(data)[0]]; //idhjual
                console.log(getId);
                getIdAlamat = data[Object.keys(data)[5]]; //id alamat pengiriman
                var tr = $(this).closest('tr');
                $("#ida").html(getIdAlamat);

                //ini untuk muncul di modal
                    //DETAIL TAGIHAN
                    $.post("ajaxreseller.php",{
                        jenis:"get_detail_tagihan",
                        getId:getId,
                    },
                    function(data){                 
                    var jatuhtempohutang = moment(data[2]).format("DD-MMMM-YYYY");
                    
                        $("#idhjualhutang").html(data[1]);
                        $("#jatuhtempohutang").html(jatuhtempohutang);
                        $("#tagihan").html($.parseJSON(data[4]));
                    });

                    //DETAIL CUSTOMERNYA -- nama notelp
                    $.post("ajaxreseller.php",{
                        jenis:"get_detail_customerHutang",
                        idcust:idcust,
                    },
                    function(data){                 
                        $("#namapemilik").html(data[2]);
                        $("#nomorpemilik").html(data[3]);
                    // $("#emailpemilik").html(data[1]);
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
                //end of ini untuk muncul di modal

                
            }*/
            //end of action utk "selesaikan pembayaran" untk transaksi cicilan/hutang dgn status menunggu pelunasan

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

    function getinfo(idhjual) {
        $.post("ajaxs/ajaxtagihan.php",{
                    jenis:"getinfo",
                    id:idhjual
                },
                function(data){                 
                    console.log(data);
                    var arr=JSON.parse(data);
                    $("#idhjualhutang").html(arr["idp"]);             
                    $("#jatuhtempohutang").html(arr["tgl"]);             
                    $("#tagihan").html(arr["amount"]);             
                });
    }

    function bayarhutang(id){
            $.post("ajaxs/ajaxtagihan.php",{
                    jenis:"bayartagihan",
                    idh:id,
                },
                function(data){                   
                    window.location.href="pagepay.php";
                });
    }

    //----------------end of stars rating ----------------------------------//

    function selesaikan(id) {
        $.post("ajaxs/ajaxtagihan.php",{
                    jenis:"selesaikan",
                    idhjual:id,
                },
                function(data){   
                    alert("berhasil melakukan pembayaran");
                    $('#tableorders').DataTable().ajax.reload();  
                    CekTglExpireSemuaBarang();                
                });
    }

    function selesaikanhutang(id) {
        $.post("ajaxs/ajaxtagihan.php",{
                    jenis:"selesaikanhutang",
                    idhjual:id,
                    CurrentDate:moment(new Date()).format("YYYY-MM-DD"),
                },
                function(data){    
                    alert("berhasil melakukan pelunasan tagihan");  
                    $('#tableorders').DataTable().ajax.reload();    
                    CekTglExpireSemuaBarang();    
                });
    }

    function hitunguntung(){
        $.post("ajaxs/ajaxbackexec.php", {
                    jenis: "untung",
                },
                function(data) {
                    console.log(data);
                    CekTglExpireSemuaBarang();
            });
    }
    hitunguntung();

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

</script>
</body>
</html>