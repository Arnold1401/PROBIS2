<?php
require_once("adminhead.php");
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
   
</head>

<body>
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
                
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                    <li>
                    <a href="admin-home.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">Master</h3><!-- /.menu-title -->
                    <li>
                        <a href="admin-manageuser.php"> <i class="menu-icon fa fa-laptop"></i>User </a>
                    </li>
                    <li>
                        <a href="admin-managesales.php"> <i class="menu-icon fa fa-id-badge"></i>Sales </a>
                    </li>
                    <li>
                        <a href="admin-barang.php"> <i class="menu-icon fa fa-th"></i>Barang </a>
                    </li>
                    <li>
                        <a href="admin-piutang.php"> <i class="menu-icon fa fa-th"></i>Piutang </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">
                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">                                                                                                     
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>    
                        <div class="user-menu dropdown-menu">
                           
                            <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a>

                            <a onclick="keluar()" class="nav-link" ><i class="fa fa-power-off"></i> Logout</a>
                        </div>                   
                    </div>                   
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->
        

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>      
                            <li><a href="#">Master</a></li>                            
                            <li><a href="#">Barang</a></li>                                                  
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Barang</strong>
                            </div>
                            <div class="card-body card-block">

                                <!-- crud barang-->
                                <form class="was-validated">

                                  <div class="row form-group">
                                    <div class="col col-md-3">
                                      <label for="file-input" class=" form-control-label">File input</label>
                                    </div>
                                      
                                    <div class="col-12 col-md-9">
                                      <input type="file" id="file-input" name="file-input" class="form-control-file">
                                    </div>
                                    <small id="helpfile-input" class="invalid-feedback">Isi Alamat Anda</small>
                                  </div>

                                  <div class="form-group">
                                    <label for="" class=" form-control-label">Nama Barang</label>
                                      <input type="text" id="txt_namabarang" placeholder="Isi Nama Barang" class="form-control" aria-describedby="helpnama_barang" required>
                                      <small class="helpnama_barang">Isi Nama Barang</small>
                                  </div>

                                    <div class="row form-group">

                                        <div class="col col-md-6">
                                            <label for="" class=" form-control-label">Jenis Satuan Barang </label>
                                                <select name="select" id="cb_satuan" class="form-control" aria-describedby="helpselect_barang" required>
                                                    <option value="">Pilih</option>
                                                    <option value="0">Box</option>
                                                    <option value="1">Pcs</option>
                                                    <option value="2">Botol</option>
                                                    <option value="3">Tambah Satuan Baru</option>
                                                </select>
                                                <small id="helpkota_user" class="invalid-feedback">Isi Alamat Anda</small>
                                                <small>*Pilih Satuan Barang</small><br>
                                                <small>*Pilih Tambahkan Satuan Barang untuk menambah satuan barang yang tidak tertera</small>
                                        </div>

                                        <div class="col-auto col-md-6">
                                            <label for="" class=" form-control-label">Satuan Barang Tambahan </label>
                                            <div class="input-group prepand">
                                                <input type="text" id="txt_satuan" name="" placeholder="Masukkan Satuan Barang" class="form-control">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-primary">Tambah</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                  <div class="form-group">
                                    <label for="" class=" form-control-label">Jumlah Barang </label>
                                        <input type="number" id="txt_jum" name="" placeholder="Isi Jumlah Barang" class="form-control">
                                    <small class="help-block">Isi Jumlah Barang Yang Tersedia</small>                                   
                                  </div>
                                  
                                  <div class="form-group">
                                    
                                  </div>

                                  <div class="form-group">
                                    <label for="" class=" form-control-label">Jenis Barang </label>
                                    <select name="select" id="cb_jenis" class="form-control">
                                        <option value="Minuman">Minuman</option>
                                        <option value="Makanan Ringan">Makanan Ringan</option>
                                        <option value="Perawatan Diri">Perawatan Diri</option>
                                        <option value="Obatan">Obatan</option>
                                      </select>
                                      <small>Pilih Jenis Barang</small>                                      
                                  </div>

                                  <div class="form-group">
                                    <label for="" class=" form-control-label">Harga Barang Beli (Rp)</label>
                                      <input type="number" id="txt_hargabeli" name="" placeholder="Harga Barang Beli" class="form-control">
                                      <small class="help-block">Isi Harga Barang saat Beli</small>
                                  </div>

                                  <div class="form-group">
                                    <label for="" class=" form-control-label">Harga Barang Jual (Rp)</label>
                                      <input type="number" id="txt_hargajual" name="" placeholder="Harga Barang Jual" class="form-control">
                                      <small class="help-block">Isi Harga Barang saat Jual</small>
                                  </div>

                                   <div class="form-group">
                                    <label for=""class=" form-control-label">Deskripsi Barang </label>
                                    <textarea class="form-control" name="" id="txt_deskripsi" rows="3" placeholder="Deskripsi..." class="form-control"></textarea>
                                  </div>  

                                  <div class="form-group">
                                    <label for="">Masa Kadaluarsa</label>
                                    <input type="date" name="" id="txt_exp" class="form-control" placeholder="masa kadaluarsa" aria-describedby="helpId">
                                  </div>   
                                  
                                  <div class="form-group">
                                    <label for=""class=" form-control-label">Status Barang </label>
                                    <select disabled name="select" id="cb_status" class="form-control">
                                        <option value="0">Aktif</option>
                                        <option value="1">No-aktif</option>
                                        
                                      </select>
                                      <small>(Aktif - Barang belum expire)</small>   
                                      <small>(NonAktif - Barang sudah expire)</small>   
                                  </div>
                                 

                                  <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-md" onclick="tambahbarang()">
                                        <i class="fa fa-dot-circle-o"></i> Tambahkan
                                    </button>

                                    <button type="submit" class="btn btn-danger btn-md">
                                        <i class="fa fa-ban"></i> Reset
                                    </button>

                                    <button type="submit" class="btn btn-warning btn-md float-right">
                                        <i class="fa fa-ban"></i> Ubah
                                    </button>
                                  </div>

                                  
                                  <br>

                                  <div class="form-group">
                                  <small>*Pilih tombol Tambahkan untuk menambah data barang baru</small><br>
                                  <small>*Pilih tombol Reset untuk mereset isi inputan diatas</small><br>
                                  <small>*Pilih tombol Ubah untuk menambah data barang baru. Tombol Ubah dapat dipilih jika data barang pernah diinputkan</small><br>
                                  </div>



                                </form>
                                <!-- crud barang-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">List Barang</strong>
                            </div>
                            <div class="card-body">

                            <div class="form-group">
                                <small>*Pilih tombol Detail untuk melihat Detail Barang</small><br>
                                <small>*Pilih tombol Ubah untuk mengubah Barang</small>
                            </div>
                            
                            <!-- datatable barang -->
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Nama Barang </th>
                                            <th>Harga</th>

                                            <th>Satuan Barang</th>

       
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end of datatable barang -->

                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->
    <!-- Right Panel -->


    <!-- kumpulan script luar -->
        <?php      include_once('kumpulanscriptluar.php'); ?>
    <!-- end of kumpulan script -->

</body>

</html>

<script>



/*


utama id, nama, harga,rating 


detail jenis barang,deskripsi barang, kadaluarsa 






;


*/

function format ( d ) {
        // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; width:100%">'+
            '<tr>'+
                '<td>Jenis Barang</td>'+
                '<td>'+d.jenis_barang+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Deskripsi Barang</td>'+
                '<td>'+d.deskripsi_barang+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Kadaluwarsa</td>'+
                '<td>'+d.tanggal_kadaluwarsa+'</td>'+
            '</tr>'+
        '</table>';
    }


$(document).ready(function() {



    var table="";

    table = $('#example').DataTable( 
        {
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
                 "url":"datatable_barang.php",
                 "type":"POST"
             },
             "deferRender":true,
             "aLengthMenu":[[10,20,50],[10,20,50]], //combobox limit
             "columns":[
                
                 {"data":"id_barang"},
                 {"data":"nama_barang"},
                 {"data":"harga"},
                 {"data":"nama_satuan"},
                 {                   
                    "target": -1,
                    "defaultContent": "<button id=\"GetDetail\" class='btn btn-outline-success'>Detail</button>"
                },              
             ],
        } 
        
        );

        setInterval( function () {
             table.ajax.reload();
        }, 30000 );
        table.buttons().container()
             .appendTo( '#example_wrapper .col-md-6:eq(0)' );


        
         //function onclick untuk button list reseller dan details pada datatable list sales 
         var getId, data, tablelistreseller = "";
        $('#example tbody').on( 'click', 'button', function () {
            var action = this.id;
            data = table.row($(this).closest('tr')).data();
        
           
            
            //action button Detail
            if(action == 'GetDetail')
            {
                getId = data[Object.keys(data)[0]];
                var tr = $(this).closest('tr');
                var row = table.row( tr );
                
                if ( row.child.isShown() ) 
                {   // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }       
                else 
                {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            }
            //end of action button Detail
        } );
    




})
function keluar(){
    $.post("ajaxs/ajaxlogin.php",
        {
            jenis:"keluar",
        },
        function(data){
            window.location.href="../user-page/login.php";
        });

    }


    //function tambah barang
    function tambahbarang() {
        //validasi setiap inputan
        (function() {
            'use strict';
            window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
                }, false);
            });
            }, false);
            })();

            (function($){
                $.post("adminajax.php",
                {
                    jenis:"insertbarang",
                    nmbarang:$("#txt_namabarang").val(),
                    satuan:$("#cb_satuan").val(),
                    jumlah:$("#txt_jum").val(),
                    cbjenis:$("#cb_jenis").val(),
                    hargabeli:$("#txt_hargabeli").val(),
                    hargajual:$("#txt_hargajual").val(),
                    exp:$("#txt_exp").val(),
                    status:$("#cb_status").val(),
                },
                function (data) {
                    alert(data);
               
            });
            }(jQuery))

           
    }
    //end of function tambah barang




</script>
