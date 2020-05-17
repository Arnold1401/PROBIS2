<?php
require_once("adminhead.php");
include_once('adminconn.php');


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

                            <a onclick="keluar()" class="nav-link" href="#"><i class="fa fa-power-off"></i> Logout</a>
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
                        <h1>Laporan Pelanggan Menguntungkan</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>      
                            <li><a href="#">Laporan</a></li>                            
                            <li><a href="#">Pelanggan</a></li>                                                  
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

                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">List Pelanggan</strong>
                            </div>
                            <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class=" form-control-label">Tanggal Awal</label>
                                        <input type="date" name="" id="tgl_awal" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class=" form-control-label">Tanggal Akhir</label>
                                        <input type="date" name="" id="tgl_akhir" class="form-control">
                                    </div>
                                </div>
                            </div>
                                                          
                              <div class="table-responsive">
                              <table id="tablepelanggan" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama customer</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Alamat</th>
                                            <th>Tingkat Keuntungan</th>
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

    

    <!-- kumpulan script luar -->
    <?php      include_once('kumpulanscriptluar.php'); ?>
    <!-- end of kumpulan script -->
</body>

</html>
<script>

    //document ready
    $(document).ready(function () {
        var tablepelanggan="";
        
        //datatable di list pelanggan yang menguntungkan
        tablepelanggan = $('#tablepelanggan').DataTable( 
        {
            
        } );
        //end of datatable di list pelanggan yang menguntungkan

        //event jika list pelanggan dipilih/diclick 
        $('#tablepelanggan tbody').on('click', 'tr', function () {
            $(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
        } );
        //end of event jika list pelanggan dipilih/diclick 
        
    });
    //end of document ready

    function keluar(){
    $.post("ajaxs/ajaxlogin.php",
        {
            jenis:"keluar",
        },
        function(data){
            window.location.href="../user-page/login.php";
        });

}

</script>
