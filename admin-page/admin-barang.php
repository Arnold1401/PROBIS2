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
                    <form class="was-validated">
                        <div class="col-sm-6" style="border=10px;">
                            <div class="form-group">
                                <label for="" class="form-control-label">Masukkan Gambar</label>
                                <input type="file" id="file-input" name="file-input" class="form-control-file">
                                <small id="helpnama_sales" class="invalid-feedback">Masukkan nama lengkap sales</small>
                            </div>

                            <div class="form-group">
                                <label for="" class="form-control-label">Nama Barang</label>
                                <input type="text" id="nama_barang" class="form-control" aria-describedby="helpnama_barang" required>
                                <small id="helpnama_barang" class="invalid-feedback">Masukkan nama barang</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="" class=" form-control-label">Desripsi barang</label>
                                <textarea class="form-control" name="" id="desk_barang" rows="3" placeholder="Deskripsi..." class="form-control" aria-describedby="helpdesk_barang" required></textarea>
                                <small id="helpdesk_barang" class="invalid-feedback">Masukkan deskripsi barang</small>
                            </div>

                            <div class="form-group">
                                <label for="" class=" form-control-label">Jenis Barang</label>
                                <select name="select" id="cb_jenisbarang" class="form-control" required aria-describedby="helpcb_jenisbarang">
                                    <option value="">~Pilih~</option>
                                    <option value="Minuman">Minuman</option>
                                    <option value="Makanan Ringan">Makanan Ringan</option>
                                    <option value="Perawatan Diri">Perawatan Diri</option>
                                    <option value="Obatan">Obatan</option>
                                </select>
                                <small id="helpcb_jenisbarang" class="invalid-feedback">Pilih Jenis kategori barang</small>                            
                            </div>

                            <div class="form-group">
                            <label for="" class=" form-control-label">Satuan Barang</label>
                                <select name="select" id="cb_satuanbarang" class="form-control" required aria-describedby="helpcb_satuanbarang">                                  
                                    <!-- select dari db -->
                                </select>
                                <small id="helpcb_satuanbarang" class="invalid-feedback">Pilih Satuan barang</small>  <br>
                            </div>

                            <div class="form-group">
                                <a href="#" style="color:blue;" data-toggle="modal" data-target="#myModal">+ Tambah Satuan Barang baru</a>
                            </div>
                        </div>
                        <!-- end col 6 -->
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="" class=" form-control-label">Tanggal Masuk</label>
                                <input type="date" name="" id="tgl_masuk" class="form-control" aria-describedby="helptgl_masuk" required>
                                <small id="helptgl_masuk" class="invalid-feedback">Tanggal Masuk Barang </small>
                            </div>

                            <div class="form-group">
                                <label for="" class=" form-control-label">Tanggal Kadaluarsa Barang</label>
                                <input type="date" name="" id="tgl_kadaluarsa" class="form-control" aria-describedby="helptgl_kadaluarsa" required>
                                <small id="helptgl_kadaluarsa" class="invalid-feedback">Tanggal Kadularsa Barang </small>
                            </div>

                            <div class="form-group">
                                <label for="" class=" form-control-label">Kuantiti/Jumlah Barang</label>
                                <input type="number" id="jumlah_barang" name="" class="form-control" aria-describedby="helpjumlah_barang" required>
                                <small id="helpjumlah_barang" class="invalid-feedback">Masukkan kuantiti/jumlah barang masuk</small>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Harga Beli Barang</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="number" id="hrgbeli_barang" name="" class="form-control" aria-describedby="helphrgbeli_barang" required>
                                        <small id="helphrgbeli_barang" class="invalid-feedback">Masukkan Harga Beli barang</small>
                                    </div>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Harga Jual Barang</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="number" id="hrgjual_barang" name="" class="form-control" aria-describedby="helphrgjual_barang" required>
                                        <small id="helphrgjual_barang" class="invalid-feedback">Masukkan Harga Jual barang</small>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <section class="card">                                   
                                        <button type="button" class="btn btn-success btn-md " onclick="tambahbarang()">
                                            <i class="fa fa-dot-circle-o"></i> Tambahkan
                                        </button>                                      
                                    </section>
                                </div>
                                <div class="col-md-4">
                                    <section class="card">
                                    <button type="submit" class="btn btn-danger btn-md">
                                            <i class="fa fa-ban"></i> Reset
                                            </button>
                                    </section>
                                </div>
                                <div class="col-lg-4">
                                    <section class="card">
                                    <button type="submit" class="btn btn-warning btn-md float-right">
                                            <i class="fa fa-ban"></i> Ubah
                                            </button>
                                    </section>
                                </div>
                            </div>
                            <div class="form-group">
                                <small>*Pilih tombol Tambahkan untuk menambah sales baru</small><br>
                                <small>*Pilih tombol Reset untuk mereset isi inputan diatas</small><br>
                               
                            </div>
                        </div>
                        <!-- end col 6 -->
                    </form>
                </div> <!-- end col 12 -->
                </div><!-- end row  -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">List Sales</strong>
                            </div>
                            <div class="card-body">
                              <small>*Tombol List Reseller - list reseller yang dibebani oleh setiap sales</small><br>
                              <small>*Tombol Detail - Detail dari setiap sales</small><br>
                              <small>*Pencarian dapat dilakukan pada textbox yang disediakan</small><br>
                              <div class="table-responsive">
                              <table id="example" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Nama </th>
                                            <th>Email</th>
                                            <th>No KTP</th>
                                            <th>Nomor Telepon</th>
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
    </div><!-- /#right-panel -->
    <!-- Right Panel -->

    <!-- Modal utk list reseller -->
    <div class="modal fade " tabindex="-1" id="myModal" role="dialog">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">List Reseller</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">               
                    <form>
                        <div class="form-group">
                            <label class="col-form-label">Nama Satuan</label>
                            <input type="text" class="form-control" id="satuan_tambahan">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" id="peringatan"></label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="tambahsatuanbaru" class="btn btn-outline-primary">Tambahkan</button> 
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--end of Modal utk list reseller -->


    <!-- kumpulan script luar -->
        <?php      include_once('kumpulanscriptluar.php'); ?>
    <!-- end of kumpulan script -->

</body>

</html>

<script>
    $(document).ready(function() {
        getdataSatuan();

        $('#tambahsatuanbaru').click( function () {
            tambahsatuanbaru();
            getdataSatuan();
        });
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

    function getdataSatuan(){
        $.post("adminajax.php",{
            jenis:"satuan_barang",
        },
        function(data){
            $("#cb_satuanbarang").html(data);
        });
    }

    // function getsatuan() {
    //     var getsatuan = document.getElementById('cb_satuanbarang').value;
    //     if (getsatuan == 0) {
    //         document.getElementById("satuan_tambahan").disabled = false;
    //         document.getElementById("tambah_satuan").disabled = false;
    //     }else{
    //         document.getElementById("satuan_tambahan").disabled = true;
    //         document.getElementById("tambah_satuan").disabled = true;
    //     }
    // }

    function tambahsatuanbaru() {
        $.post("adminajax.php",{
            jenis:"tambah_satuan_baru",
            namasatuan : document.getElementById("satuan_tambahan").value
            },
            function(data){
                alert(data);
            })
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
                    namabarang:$("#nama_barang").val(),
                    descbarang:$("#desk_barang").val(),
                    jenisbarang:$("#cb_jenisbarang").val(),
                    satuanbarang:$("#cb_satuanbarang").val(),
                    tanggalmasuk:$("#tgl_masuk").val(),
                    tanggalkadaluarsa:$("#tgl_kadaluarsa").val(),
                    kuantiti:$("#jumlah_barang").val(),
                    hargabeli:$("#hrgbeli_barang").val(),
                    hargajual:$("#hrgjual_barang").val()
                    
                },
                function (data) {
                    alert(data);
               
            });
            }(jQuery))

           
    }
    //end of function tambah barang



</script>
