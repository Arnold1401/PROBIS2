<?php
require_once("adminhead.php");
include_once('adminconn.php');

$isi = 10;
$page = isset($_GET["isi"])? (int)$_GET["isi"]:1;
$mulai = ($page>1) ? ($page*$isi) - $isi :0;
$result = mysqli_query(getConn(), "select * from sales");
$total = mysqli_num_rows($result);
$pages = ceil($total/$isi);
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html>
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

                            <a class="nav-link" href="#"><i class="fa fa-power-off"></i> Logout</a>
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
                            <li><a href="#">Sales</a></li>                                                  
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
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="" class=" form-control-label">Nama Sales</label>
                                <input type="text" id="nama_sales" class="form-control" aria-describedby="helpnama_sales" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="" class=" form-control-label">Email Sales</label>
                                <input type="email" id="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="" class=" form-control-label">No KTP Sales </label>
                                <input id="no_ktp" type="text" onkeydown="return numbersonly(this, event);" onkeyup="javascript:pemisahktp(this);" class="form-control" id="nomor_ktp" placeholder="Nomor KTP" aria-describedby="helpnomor_ktp" required>
                                <small id="helpnomor_ktp">Masukkan nomor KTP Anda (Contoh: 1234-5678-9123-4567)</small>                            
                            </div>

                            <div class="form-group">
                                <label for="" class=" form-control-label">No Telpon </label>
                                <input id="nomor_telepon" type="number" class="form-control">
                            </div>
                        </div>
                        <!-- end col 6 -->
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="" class=" form-control-label">Provinsi</label>
                                <select class="form-control" id="provinsi" onchange="cb_city()" aria-describedby="helpprovinsi_user" required>
                                   <!-- isi ajax -->
                                </select>
                                <small id="helpprovinsi_user" class="invalid-feedback">Isi Alamat Anda</small>
                            </div>

                            <div class="form-group">
                                <label for="" class=" form-control-label">Kota</label>                   
                                <select class="form-control" id="kota"  onchange="cb_subdistrict()" aria-describedby="helpkota_user" required>
<!--  -->
                                </select>
                                <small id="helpkota_user" class="invalid-feedback">Isi Alamat Anda</small>
                            </div>

                            <div class="form-group"> 
                                <label for="" class=" form-control-label">Kecamatan</label>
                                <select class="form-control" id="kecamatan" aria-describedby="helpkecamatan_user" required>
                                <!--  -->
                                </select>
                                <small id="helpkecamatan_user" class="invalid-feedback">Isi Alamat Anda</small>
                            </div>

                            <div class="form-group">
                                <label for=""class=" form-control-label">Alamat</label>
                                <textarea class="form-control" id="alamat" rows="3" class="form-control"></textarea>
                            </div>  
                            <div class="row">
                                <div class="col-md-4">
                                    <section class="card">                                   
                                        <button type="button" class="btn btn-success btn-md " onclick="tambahsales()">
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
                                <small>*Pilih tombol Tambahkan untuk menambah data barang baru</small><br>
                                <small>*Pilih tombol Reset untuk mereset isi inputan diatas</small><br>
                                <small>*Pilih tombol Ubah untuk menambah data barang baru. Tombol Ubah dapat dipilih jika data barang pernah diinputkan</small><br>
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
                              <small>*Status Menunggu - data user belum dicek/diperiksa</small><br>
                              <small>*Status Valid - data user sesuai</small><br>
                              <small>*Status Tidak Valid - data user tidak sesuai</small><br>
                              <div class="table-responsive">
                              <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama </th>
                                            <th>Email</th>
                                            <th>Nomor Telepon</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php
                                            $urutan = 1;
                                            $res = mysqli_query(getConn(), "select * from sales LIMIT $mulai, $isi");
                                            if (mysqli_num_rows($res)>0) {
                                                while ($data = mysqli_fetch_assoc($res)) { ?>
                                                    <tr> 
                                                        <td> <?php echo $urutan++; ?> </td>
                                                        <td> <?php echo $data["nama_sales"]; ?> </td>
                                                        <td> <?php echo $data["email"]; ?> </td>
                                                        <td> <?php echo $data["nomor_telepon"]; ?> </td>
                                                        <td>
                                                            <button type="button" name="" id="" class="btn btn-primary">Detail</button>         
                                                            <button type="button" name="" id="" class="btn btn-primary">List Reseller</button>                                                                           
                                                        </td>
                                                    </tr>
                                        <?php     }
                                            }
                                        ?>
                                        
                                    </tbody>
                                </table>

                                <!-- pagging -->
                                
                              </div>
                               
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>

    
</body>

</html>
<script>

    // API

    
    function cb_prov(){
        $.post("ajaxs/ajaxregister.php",
        {
            jenis:"getprovince",
        },
        function(data){
            console.log(data);
            $("#provinsi").html(data);
        });
    }

    cb_prov();

    function cb_city() {
        $.post("ajaxs/ajaxregister.php",
        {
            jenis:"getcity",
            province:$("#provinsi").val(),
        },
        function(data){
            console.log(data);
            $("#kota").html(data);
        });
        $("#kota").val(-1);
    }

    function cb_subdistrict() {
        if ($("#cb_kota").val()!=null) {
            $.post("ajaxs/ajaxregister.php",
            {
                jenis:"getsubdistrict",
                city:$("#kota").val(),
            },
            function(data){
                console.log(data);
                $("#kecamatan").html(data);
            });
        }
        
    }


    // pemisah ktp
    function pemisahktp(noktp)
    {
        var _minus = false;
        if (noktp<0) _minus = true;
        noktp=noktp.toString();
        noktp=noktp.replace(".","");
        noktp=noktp.replace("-","");
        
        c = "";
        panjang = noktp.length;
        j = 0;
        for (i = panjang; i > 0; i--)
        {
            j = j + 1;
            
            if (((j % 4) == 1) && (j != 1))
            {
                c = noktp.substr(i-1,1) + "-" + c;
            }else
            {   c = noktp.substr(i-1,1) + c;    }
        }
        
        if (_minus) c = "-" + c ;
        return c;
        
    }
    
    function numbersonly(ini, e)
    {
    if (e.keyCode>=49)
    {
    if(e.keyCode<=57)
    {
    a = ini.value.toString().replace(".","");
    noktp = a.replace(/[^\d]/g,"");
    noktp = (noktp=="0")?String.fromCharCode(e.keyCode):noktp + String.fromCharCode(e.keyCode);
    ini.value = pemisahktp(noktp);

    return false;
    }

    else if(e.keyCode<=105){
    if(e.keyCode>=96){
    //e.keycode = e.keycode - 47;
    a = ini.value.toString().replace(".","");
    noktp = a.replace(/[^\d]/g,"");
    noktp = (noktp=="0")?String.fromCharCode(e.keyCode-48):noktp + String.fromCharCode(e.keyCode-48);
    ini.value = pemisahktp(noktp);
    //alert(e.keycode);
    return false;
    }
    else {return false;}
    }else {
    return false; }
    }else if (e.keyCode==48){
    a = ini.value.replace(".","") + String.fromCharCode(e.keyCode);
    noktp = a.replace(/[^\d]/g,"");
    if (parseFloat(noktp)!=0){
    ini.value = pemisahktp(noktp);
    return false;
    } else {return false;}
    }else if (e.keyCode==95){
    a = ini.value.replace(".","") + String.fromCharCode(e.keyCode-48);
    noktp = a.replace(/[^\d]/g,"");
    if (parseFloat(noktp)!=0){
        ini.value = pemisahktp(noktp);
        return false;
        } else {return false;}
    }else if (e.keyCode==8 || e.keycode==46){
        a = ini.value.replace(".","");
        noktp = a.replace(/[^\d]/g,"");
        noktp = noktp.substr(0,noktp.length -1);
        
        if (pemisahktp(noktp)!=""){
            ini.value = pemisahktp(noktp);
        } else {ini.value = "";}
        
        return false;
        } else if (e.keyCode==9){
        return true;
        } else if (e.keyCode==17){
        return true;
        } else {
        //alert (e.keyCode);
        return false;
        }

    }
    // end pemisah ktp

    function tambahsales() {

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

        //button tambah
        
        // var namasales = 
        // var emailsales = 
        // var noktpsales = 
        // var notelpsales = document.getElementById('nomor_telepon').value;
        // var provinsisales= document.getElementById('provinsi').value;
        // var kotasales = document.getElementById('kota').value;
        // var kecamatansales= document.getElementById('kecamatan').value;
        // var alamatsales = document.getElementById('alamat').value;
        // var statussales = $("#status").val();

        // alert(noktp);

        (function($){
            $.post("adminajax.php",
        {
            jenis: "tambah_sales",
            nama_sales:document.getElementById('nama_sales').value,
            email:document.getElementById('email').value,
            no_ktp:noktp,
            nomor_telepon:document.getElementById('nomor_telepon').value,
            provinsi:document.getElementById('provinsi').value,
            kota:document.getElementById('kota').value,
            kecamatan:document.getElementById('kecamatan').value,
            alamat:document.getElementById('alamat').value,

        },
        function (data) {
            alert(data);
        });
            
        }(jQuery))

        // reset inputan
        document.getElementById('nama_sales').value="";
        document.getElementById('email').value = "";
        document.getElementById('no_ktp').value = "";
        document.getElementById('nomor_telepon').value="";
        document.getElementById('provinsi').value = "";
        document.getElementById('kota').value = "";
        document.getElementById('kecamatan').value = "";
        document.getElementById('alamat').value = "";


    }




    
</script>