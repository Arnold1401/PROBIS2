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
                        <a href="index.html"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">Master</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>User</a>                        
                    </li>
                    <li class="menu-item-has-children active dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Sales</a>                      
                    </li>
                    <li class="menu-item-has-children active dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Barang</a>                      
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
                                <form action="">

                                  <div class="row form-group">
                                    <div class="col col-md-3">
                                      <label for="file-input" class=" form-control-label">File input</label>
                                    </div>
                                      
                                    <div class="col-12 col-md-9">
                                      <input type="file" id="file-input" name="file-input" class="form-control-file">
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label for="" class=" form-control-label">Nama Barang</label>
                                      <input type="text" id="" name="" placeholder="Isi Nama Barang" class="form-control">
                                      <small class="help-block">Isi Nama Barang</small>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label for="" class=" form-control-label">Jumlah Barang </label>
                                      <input type="number" id="" name="" placeholder="Isi Jumlah Barang" class="form-control">
                                      <small class="help-block">Isi Jumlah Barang Yang Tersedia</small>
                                  </div>

                                  <div class="form-group">
                                    <label for="" class=" form-control-label">Jenis Barang </label>
                                    <select name="select" id="select" class="form-control">
                                      <option value="0">Minuman</option>
                                        <option value="1">Konsumsi</option>
                                        <option value="2">Obat</option>
                                        <option value="3">Option #3</option>
                                      </select>
                                      <small>Pilih Jenis Barang</small>                                      
                                  </div>

                                  <div class="form-group">
                                    <label for="" class=" form-control-label">Harga Barang (Rp)</label>
                                      <input type="number" id="" name="" placeholder="Isi Harga Barang" class="form-control">
                                      <small class="help-block">Isi Harga Barang Anda</small>
                                  </div>

                                  <div class="form-group">
                                    <label for=""class=" form-control-label">Deskripsi Barang </label>
                                    <textarea class="form-control" name="" id="" rows="3" placeholder="Deskripsi..." class="form-control"></textarea>
                                  </div>        
                                  
                                  <div class="form-group">
                                    <label for=""class=" form-control-label">Status Barang </label>
                                    <select name="select" id="select" class="form-control">
                                        <option value="0">Aktif</option>
                                        <option value="1">No-aktif</option>
                                        
                                      </select>
                                      <small>(Aktif - Barang akan ditampilkan pada pilihan produk customer)</small>   
                                      <small>(NonAktif - Barang tidak akan ditampilkan pada pilihan produk customer)</small>   
                                  </div>
                                 

                                  

                                  <button type="submit" class="btn btn-success btn-md">
                                    <i class="fa fa-dot-circle-o"></i> Tambahkan
                                  </button>

                                  <button type="submit" class="btn btn-danger btn-md">
                                    <i class="fa fa-ban"></i> Reset
                                  </button>

                                  <button type="submit" class="btn btn-warning btn-md float-right">
                                    <i class="fa fa-ban"></i> Ubah
                                  </button>
                                  <br>
                                  <small>*Pilih tombol Tambahkan untuk menambah data barang baru</small><br>
                                  <small>*Pilih tombol Reset untuk mereset isi inputan diatas</small><br>
                                  <small>*Pilih tombol Ubah untuk menambah data barang baru. Tombol Ubah dapat dipilih jika data barang pernah diinputkan</small><br>


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
                              <small>*Pilih tombol Detail untuk melihat Detail Barang</small><br>
                              <small>*Pilih tombol Ubah untuk mengubah Barang</small>
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>Unit Barang</th>
                                            <th>Harga Barang</th>
                                            <th>Status Barang</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> 1 </td>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>$320,800</td>
                                            <td>Aktif</td>
                                            <td>
                                              <button type="button" name="" id="" class="btn btn-primary">Detail</button>                                          
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> 2 </td>
                                            <td>Rhona Davidson</td>
                                            <td>Integration Specialist</td>
                                            <td>Tokyo</td>
                                            <td>$327,900</td>
                                            <td>Aktif</td>
                                            <td>
                                              <button type="button" name="" id="" class="btn btn-primary">Detail</button>                                          
                                            </td>
                                        </tr>                                      
                                        <tr>
                                            <td> 3 </td>
                                            <td>Shou Itou</td>
                                            <td>Regional Marketing</td>
                                            <td>Tokyo</td>
                                            <td>$163,000</td>
                                            <td>Aktif</td>
                                            <td>
                                              <button type="button" name="" id="" class="btn btn-primary">Detail</button>                                          
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> 4 </td>
                                            <td>Michelle House</td>
                                            <td>Integration Specialist</td>
                                            <td>Sidney</td>
                                            <td>$95,400</td>
                                            <td>Aktif</td>
                                            <td>
                                              <button type="button" name="" id="" class="btn btn-primary">Detail</button>                                          
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> 5 </td>
                                            <td>Suki Burks</td>
                                            <td>Developer</td>
                                            <td>London</td>
                                            <td>$114,500</td>
                                            <td>Aktif</td>
                                            <td>
                                              <button type="button" name="" id="" class="btn btn-primary">Detail</button>                                          
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> 6 </td>
                                            <td>Prescott Bartlett</td>
                                            <td>Technical Author</td>
                                            <td>London</td>
                                            <td>$145,000</td>
                                            <td>Aktif</td>
                                            <td>
                                              <button type="button" name="" id="" class="btn btn-primary">Detail</button>                                          
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> 7 </td>
                                            <td>Gavin Cortez</td>
                                            <td>Team Leader</td>
                                            <td>San Francisco</td>
                                            <td>$235,500</td>
                                            <td>Aktif</td>
                                            <td>
                                              <button type="button" name="" id="" class="btn btn-primary">Detail</button>                                          
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> 8 </td>
                                            <td>Donna Snider</td>
                                            <td>Customer Support</td>
                                            <td>New York</td>
                                            <td>$112,000</td>
                                            <td>Aktif</td>
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

