<!DOCTYPE html>
<html lang="en">

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Tables</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

<?php include "header.php"?>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <!--<li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>-->
      <li class="nav-item">
        <a class="nav-link" href="barang.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Barang</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="user.php">
          <i class="fas fa-fw fa-table"></i>
          <span>User</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="transaksi.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Transaksi</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="merek.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Merek</span></a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li> -->
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Tables</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Table Merek</div>
          <div class="card-body">
            <div class="table-responsive">
            <form>            
                <div class="form-group">
                    <label id="txt_id" style="display:none">id</label>
                    <label for="exampleInputEmail1">Masukkan Nama Merek</label>
                    <input type="email" class="form-control" id="txt_merek" aria-describedby="emailHelp" placeholder="Masukkan Nama Merek">
                </div>
                <button type="button" class="btn btn-primary" onclick="simpan()">Submit</button>
              </form>
              </br>
              <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Id Merek</th>
                    <th>Nama Merek</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tbody id="isi_merek">

                </tbody>
              </table>

            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

        <p class="small text-center text-muted my-5">
          <em>More table examples coming soon...</em>
        </p>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <?php include "logoutmodal.php"?>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script>
      function simpan()
      {
        $.post("ajaxmerek.php",
        {
          jenis:"load_update",
          id : $("#txt_id").html(),
          nama : $("#txt_merek").val(),
        },
        function(data){
          //alert(data);
          $.post("ajaxmerek.php",
          {
            jenis:"load_merek"
          },
          function(data){
            $("#isi_merek").html(data);
          }
        );
        }
        );
      }
      function edit(params)
      {
          //alert(params);
          $.post("ajaxmerek.php", 
          {
            jenis:"load_index",
            id:params
          },
          function(data){
            //$("#cons").html(data);
            console.log(data);
            var arr =  JSON.parse(data);
            var id= params;
            var nama = arr['nama'];
            //alert(nama);
            $('#txt_id').html(id);
            $('#txt_merek').val(nama);

          }
          );
      }
      $.post("ajaxmerek.php",
        {
          jenis:"load_merek"
        },
        function(data){
          $("#isi_merek").html(data);
        }
        );

  </script>
</body>

</html>
