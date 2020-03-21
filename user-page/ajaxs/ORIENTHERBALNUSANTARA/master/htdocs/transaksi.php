<!DOCTYPE html>
<html lang="en">

<head>

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
      <li class="nav-item active">
        <a class="nav-link" href="transaksi.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Transaksi</span></a>
      </li>
      <li class="nav-item ">
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
            Data Table Example</div>
          <div class="card-body">

            <label>Tangggal</label>
            <input type="date" class="form-control-sm" id="tgl_start">
            <label>-</label>
            <input type="date" class="form-control-sm" id="tgl_end">
            <!-- <label>User</label>
            <select class="form-control-sm" id="txt_user">
            </select> -->
            <label>Status</label>
            <select class="form-control-sm" id="status">
                <option value="">Pilih Status</option>
                <option value="Sedang di Proses">Sedang di Proses</option>
                <option value="Sedang di Kirim">Sedang di Kirim</option>
                <option value="Selesai">Selesai</option>
                <option value="Gagal">Gagal</option>
            </select>
            <label>Status Payment</label>
            <select class="form-control-sm" id="status_payment">
              <option value="">Pilih Status Payment</option>
              <option value="Pending">Pending</option>
              <option value="Selesai">Settlement</option>
              <option value="Gagal">Failure</option>
              <option value="Batal">Cancel</option>
            </select>
            <button type="button" id="terapkan" class="btn btn-primary" onclick="cari()">Terapkan</button>
            </br></br></br>
            <form> 
            <div class="form-group">
                <label id="txt_id" style="display:none">id</label>
                <label for="exampleInputPassword1">ID Transaksi</label>
                <input type="text" class="form-control" id="txt_id_trans" placeholder="ID Transaksi" readonly>
              </div>    
              <div class="form-group">
                <label for="exampleInputEmail1">Tanggal Transaksi</label>
                <input type="email" class="form-control" id="txt_tgl" value=""aria-describedby="emailHelp" placeholder="Tanggal Transaksi" readonly>
              </div>       
              <div class="form-group">
                <label for="exampleInputEmail1">Nama User</label>
                <input type="email" class="form-control" id="txt_nama" aria-describedby="emailHelp" placeholder="Nama User" readonly>
              </div>
              <!-- <div class="form-group">
                <label for="exampleInputPassword1">ID Payment</label>
                <input type="text" class="form-control" id="txt_id_payment" placeholder="ID Payment" readonly>
              </div> -->
              <div class="form-group">
                <label for="exampleInputPassword1">Status</label>
                <select class="form-control-sm" id="status_hjual" onchange="status_selected()">
                <option value="">Pilih Status</option>
                <option value="Sedang di Proses">Sedang di Proses</option>
                <option value="Sedang di Kirim">Sedang di Kirim</option>
                <option value="Selesai">Selesai</option>
                <option value="Gagal">Gagal</option>
            </select>
              </div>
              <div  id="tampung_resi">
              <div class="input-group mb-3">
                <label id="txt_id_resi" style="display:none"></label>
                <input type="text" class="form-control" placeholder="Masukkan No Resi" aria-label="Recipient's username" aria-describedby="button-addon2" id="txt_noresi">
                <div class="input-group-append">
                  <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="update()">Update</button>
                 </div>
              </div>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Status Payment</label>
                  <select class="form-control-sm" id="status_payment_hjual">
                    <option value="">Pilih Status Payment</option>
                    <option value="Pending">Pending</option>
                    <option value="Selesai">Settlement</option>
                    <option value="Gagal">Failure</option>
                    <option value="Batal">Cancel</option>
                  </select>
              </div>
              <button type="button" class="btn btn-primary" onclick="update_hjual()">Update</button>
            </form>
            </br>
            <div class="table-responsive" >
            <label id="txt_id" style="display:none">id</label>
              <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Nama User</th>
                    <th>Status</th>
                    <th>Satatus Payment</th>
                    <th>Detail</th>
                  </tr>
                </thead>
                <tbody id="isi_transaksi">

                </tbody>
              </table>
              </br>
              
              <table class="table table-bordered" id="dataTable2"  width="100%" cellspacing="0">
              <thead>
                      <th>ID Transaksi</th>
                      <th>ID Barang</th>
                      <th>Nama Barang</th>
                      <th>QTY</th>
                      <th>Harga</th>
                      <th>SubTotal</th>
                  </thead>
                <tbody id="data_detail">

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

  <?php include "logoutmodal.php"; ?>
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
      function cari()
      {
          var tgl_start = $("#tgl_start").val();
          var tgl_end = $("#tgl_end").val();
          var status=$("#status").val();
          var payment=$("#status_payment").val();
          //alert(tgl_start+"|"+tgl_end+"|"+status+"|"+payment);
          $.post("ajaxtransaksi.php", 
          {
            jenis:"load_cari",
            dari:tgl_start,
            sampai:tgl_end,
            payment:payment,
            status:status,
          },
          function(data){
            //alert(data);
            $("#isi_transaksi").html(data);
          }
          );
      }

      function detail(params)
      {
          //alert(params);
          $.post("ajaxtransaksi.php", 
          {
            jenis:"load_indek",
            id:params
          },
          function(data){
            $('#data_detail').html(data);
          }
          );

          $.post("ajaxtransaksi.php", 
          {
            jenis:"load_table",
            id:params
          },
          function(data){
            $('#data_tabel').html(data);
            //alert(data);
            console.log(data);
            var arr =  JSON.parse(data);
            //var arr = data[1];
            var id = params;
            var tgl_trans = arr['tgl'];
            var nama = arr['nama'];
            var noresi = arr['no_resi'];
            var idresi = arr['id_resi'];
            var status_payment = arr['status_payment'];
            //var id_payment = arr['id_payment'];
            var status = arr['status'];
            //alert(nama);
            $('#txt_id_trans').val(id);
            $('#txt_tgl').val(tgl_trans);
            $('#txt_nama').val(nama);
            //$('#txt_id_payment').val(id_payment);
            $('#txt_noresi').val(noresi);
            $('#txt_id_resi').html(idresi);
            $('#status_payment_hjual').val(status_payment);
            $('#status_hjual').val(status);
          }
          );
      }
    
    function update()
    {
      var noresi = $("#txt_noresi").val();
      var id_resi = $("#txt_id_resi").val();
      $.post("ajaxtransaksi.php",
      {
        jenis:"update_resi",
        resi: noresi,
        idresi : id_resi 
      },
      function(data)
      {
        alert(data);
        refresh();
      }
      );
    }
    function update_hjual()
    {
      var status_hjual = $("#status_hjual").val();
      var id =$("#txt_id_trans").val();
      $.post("ajaxtransaksi.php",
      {
        jenis:"update_hjual",
        status_h: status_hjual,
        id_trans : id
      },
      function(data)
      {
        alert(data);
        refresh();
      }
      );
    }

    function riset_resi()
    {
      $("#tampung_resi").css("display","none");
    }

    function status_selected()
    {
      var status = $("#status_hjual").val();
      if(status == "Sedang di Kirim")
      {
        $("#tampung_resi").css("display","block");
      }
      else
      {

      }
    }
    riset_resi();

    function refresh()
    {
      $.post("ajaxtransaksi.php",
        {
          jenis:"load_data"
        },
        function(data){
          $("#isi_transaksi").html(data);
          //alert(data);
        }
        );

        $.post("ajaxtransaksi.php",
        {
          jenis:"load_detail"
        },
        function(data){
          $("#data_detail").html(data);
          //alert(data);
        }
        );
    }
refresh();


</script>
</body>

</html>
