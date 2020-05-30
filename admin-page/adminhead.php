<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
        <!-- Left Panel -->

        <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./">Admin</a>
                <a class="navbar-brand hidden" href="./">A</a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                    <li>
                    <a href="admin-home.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">Master</h3><!-- /.menu-title -->
                    <li>
                        <a href="admin-penjualan.php"> <i class="menu-icon fa fa-laptop"></i>Penjualan </a>
                    </li>
                    <li>
                        <a href="admin-manageuser.php"> <i class="menu-icon fa fa-laptop"></i>Pelanggan </a>
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

                    <h3 class="menu-title">Laporan</h3><!-- /.menu-title -->
                    <li>
                        <a href="admin-lappelanggan.php"> <i class="menu-icon fa fa-laptop"></i>Pelanggan</a>
                    </li>
                    <li>
                        <a href="admin-lapbarang.php"> <i class="menu-icon fa fa-laptop"></i>Barang</a>
                    </li>
                    <li>
                        <a href="admin-lapsales.php"> <i class="menu-icon fa fa-id-badge"></i>Sales</a>
                    </li>
                    <li>
                        <a href="admin-lapkeuntungan.php"> <i class="menu-icon fa fa-th"></i>keuntungan </a>
                    </li>
                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

</body>
</html>
<?php

  
  session_start();
  
  if (isset($_SESSION["email_user"])) {
    if (isset($_SESSION["role"])) {
      if ($_SESSION["role"]=="admin") {
        
      }else{
        header("location:../user-page/login.php");
      }
    }
  }else{
        header("location:../user-page/login.php");
  }

  

?>