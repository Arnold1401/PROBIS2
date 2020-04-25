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
                        <h1>Master Penjualan</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>      
                            <li><a href="#">Master</a></li>                            
                            <li><a href="#">Penjualan</a></li>                                                  
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">

                <!-- Header piutang-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Perusahaan yang memiliki piutang</strong>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No Resi</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Tanggal Jatuh Tempo</th>
                                            <th>Total Piutang</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01012020001 </td>
                                            <td>Tiger Nixon</td>
                                            <td>20/Maret/2010</td>
                                            <td>Rp20.000,-</td>
                                            <td>
                                              <button type="button" name="" id="" class="btn btn-primary">Detail</button>                                          
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>01012020001 </td>
                                            <td>Tiger Nixon</td>
                                            <td>20/Maret/2010</td>
                                            <td>Rp20.000,-</td>
                                            <td>
                                              <button type="button" name="" id="" class="btn btn-primary">Detail</button>                                          
                                            </td>
                                        </tr>                                      
                                        <tr>
                                            <td>01012020001 </td>
                                            <td>Tiger Nixon</td>
                                            <td>20/Maret/2010</td>
                                            <td>Rp20.000,-</td>
                                            <td>
                                              <button type="button" name="" id="" class="btn btn-primary">Detail</button>                                          
                                            </td>
                                        </tr>                                        
                                    </tbody>
                                </table>
                            </div>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!--End Header piutang-->

                <!-- Detail piutang-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">[no resi]/[Nama Perusahaan]</strong>
                            </div>
                            <div class="card-body">
                                <div class="row form-group">
                                <div class="col-sm-8">[Pembeli atas nama]</div>
                                <div class="col-sm-4">[tanggal jatuh tempo]</div>
                                    <div class="col col-md-2">
                                        <label for="email-input" class=" form-control-label float-right">No Resi</label>
                                    </div>
                                    <div class="col col-md-4">
                                        <input readonly type="number" id="" name="" value="010120100001" class="form-control">
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="email-input" class=" form-control-label float-right">Jatuh Tempo</label>
                                    </div>
                                    <div class="col col-md-4">
                                        <input readonly type="date" placeholder=".col-md-4" class="form-control">
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-2">
                                        <label for="email-input" class=" form-control-label float-right">Nama Perusahaan</label>
                                    </div>
                                    <div class="col col-md-4">
                                        <input readonly type="number" id="" name="" value="010120100001" class="form-control">
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="email-input" class=" form-control-label float-right">Sales</label>
                                    </div>
                                    <div class="col col-md-4">
                                        <input readonly type="text" placeholder=".col-md-4" class="form-control">
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-2">
                                        <label for="email-input" class=" form-control-label float-right">Pembeli</label>
                                    </div>
                                    <div class="col col-md-4">
                                        <input readonly type="number" id="" name="" value="010120100001" class="form-control">
                                    </div>
                                    
                                </div>

                                <div class="table-responsive">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Id Barang </th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Barang</th>                                          
                                            <th>Harga Satuan</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> 1 </td>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>Rp10000</td>
                                            <td>Rp10000</td>
                                        </tr>
                                        <tr>
                                            <td> 2 </td>
                                            <td>Rhona Davidson</td>
                                            <td>Integration Specialist</td>
                                            <td>Tokyo</td>
                                            <td>Rp10000</td>
                                            <td>Rp10000</td>
                                        </tr>                                      
                                        <tr>
                                            <td> 3 </td>
                                            <td>Shou Itou</td>
                                            <td>Regional Marketing</td>
                                            <td>Tokyo</td>                                           
                                            <td>Rp10000</td>
                                            <td>Rp10000</td>
                                        </tr>                                        
                                    </tbody>
                                </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Detail piutang-->
            </div>
        </div>
                    

        <!-- kumpulan script luar -->
        <?php      include_once('kumpulanscriptluar.php'); ?>
    <!-- end of kumpulan script -->

</body>
<script>
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

</html>

