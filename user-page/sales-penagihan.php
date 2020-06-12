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
                <li class="nav-item active"><a href="#" class="nav-link">Penagihan</a></li>
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

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">         	
            <h1 class="mb-0 bread">YANG DITAGIHKAN</h1>

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
                            <small id="helpId" class="text-muted">*Tombol Detail - melihat detail barang yang dibeli oleh pelanggan</small><br>
                            <small id="helpId" class="text-muted">*Jika status tagihan <b> Tagihkan Pelanggan ini </b> maka sales perlu menagihkan langsung ke pelanggan</small>
                        </div>
                        
                        <div class="table-responsive" >
                            <table id="tableorders" class="table table-striped table-bordered text-dark" width="100%">
                                <!-- <input type="text" name="datefilter" id="filterdate" value="" /> -->
                                <thead>
                                    <tr>
                                        <th>No Pesanan</th>
                                        <th>Tanggal Pesanan</th>
                                        <th>Tanggal Jatuh tempo</th>
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
                                            <th colspan="3" style="text-align:right; font-weight:bold">Grandtotal :</th>
                                            <th style="font-weight:bold"></th>
                                        </tr>
                                        
                                        <tr>
                                            <th colspan="3" style="text-align:right; font-weight:bold">Total Tagihan :</th>
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

    //function sisa waktu pelunasan untuk semua piutang
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
                 "url":"datatables/datatable_penagihan.php", 
                 "type":"POST",
                 "data":{"idsales":idsales},
             },
             "deferRender":true,
             "aLengthMenu":[[10,20,50],[10,20,50]], //combobox limit
             "columns":[ 
                {"data":"id_piutang"},               
                {"data":"id_hjual"},                         
                {"data":"tanggal_jatuh_tempo", render: $.fn.dataTable.render.moment( 'DD-MMMM-YYYY' )},
                {"data":"sisa_tagihan", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' )},
                {"data":"sisa_waktu_pelunasan",
                    "searchable": false,
                    "orderable":false,
                    "render": function (data, type, row, meta) {  
                        if (row.sisa_waktu_pelunasan <= 3 && row.sisa_waktu_pelunasan >= 0) {
                            var rowIndex = meta.row+1;
                            return "<label class='text-warning font-weight-bold'>Sisa waktu pelunasan " + row.sisa_waktu_pelunasan + " hari </label>";
                        }
                        else if (row.sisa_waktu_pelunasan < 0) {
                            var rowIndex = meta.row+1;
                            $('#tableorders tbody tr:nth-child('+rowIndex+')').addClass('lightRed text-dark');
                            return "<label class='text-danger font-weight-bold'>Tagihkan pelanggan ini!</label>";
                        }
                        else if (row.sisa_waktu_pelunasan > 3) {
                            return "<label class='text-info font-weight-bold'>Sisa waktu pelunasan " + row.sisa_waktu_pelunasan + " hari </label>";
                        }
                       
                    }
                },
                {"data":"sisa_waktu_pelunasan",
                    "searchable": false,
                    "orderable":false,
                    "render": function (data, type, row, meta) {  
                        
                            return "<a id=\"GetDetail\" class='btn btn-info text-dark' id_cust=" + row.id_cust + " id_alamat=" + row.id_alamatpengiriman + "> Detail </a>"
                    }
                },
                
             ],
    
        } );
        //end of datatable di list order -- semua order yang pernah ada atau yang sedang jalan 
        

        //event jika list order dipilih/diclick 
        $('#tableorders tbody').on('click', 'tr', function () {
            $(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
        } );
        //end of event jika list order dipilih/diclick 

        
        
        var getTotal, temptotal, getseluruh='';
        //jika button di list orders dipilih/ditekan
        $('#tableorders tbody').on( 'click', 'a', function () {
            var action = this.id;
            data = tableuser.row($(this).closest('tr')).data();

            //action button Detail -- menampilkan detail order barang yang dibeli di bagian table bawah
            if(action == 'GetDetail')
            {
                getId = data[Object.keys(data)[1]]; //idhjual
                getIdAlamat = data[Object.keys(data)[5]]; //id alamat pengiriman
                getseluruh = data[Object.keys(data)[7]]; //ongkir
                getTotal = data[Object.keys(data)[5]]; //ongkir
                $("#ida").html(getIdAlamat);
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
                            
                            $("#totalsemua").html(
                                $.fn.dataTable.render.number('.','.','2','Rp').display(getTotal)
                            );                        }
                } );
                //end of table detail order barang dibagian bawah

                var idcust = $(this).attr("id_cust"); //idcust
                var getIdAlamat = $(this).attr("id_alamat"); //id alamat pengiriman
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
                    getIdAlamat:getIdAlamat,
                },
                function(data){                 
                    
                    var provinsi = data[0].split("-");
                    var kota = data[1].split("-");
                    var kec = data[2].split("-");
                    var alamat = data[3] + ", <br>" + kec[1] + ", <br>" + kota[1] + ", <br>"+ provinsi[1] ;
                    $("#alamat_pemilik").html(alamat);
                });
            }
            //end of action button Detail

            //action utk melunaskan hutang -- button bayar
            if(action == 'BayarHutang')
            {
                getId = data[Object.keys(data)[0]]; //idhjual
                getIdAlamat = data[Object.keys(data)[5]]; //id alamat pengiriman
                var tr = $(this).closest('tr');
                $("#ida").html(getIdAlamat);

                //DETAIL TAGIHAN
                $.post("ajaxreseller.php",{
                    jenis:"get_detail_tagihan",
                    getId:getId,
                },
                function(data){                 
                   var jatuhtempohutang = moment(data[2]).format("DD-MMMM-YYYY");
                   
                    $("#idhjualhutang").html($.parseJSON(data[1]));
                    $("#jatuhtempohutang").html(jatuhtempohutang);
                    $("#tagihan").html($.parseJSON(data[3]));
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
            }
            //end of action utk melunaskan hutang -- button bayar

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

    function tagihkan(id) {
        $("#tagihkan"). html("Sedang ditagihkan");
        $("#tagihkan").attr("disabled", true); 

        //kirim email ke reseller
        //status penagihan jadi 1 -- Sedang ditagihkan
    }

    
</script>
</body>
</html>