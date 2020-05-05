<?php
require_once("adminhead.php");
include_once("adminconn.php");
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
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>                            
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
            <div class="row">
                    <div class="card" style="margin-left:20px; width: 600px;">
                        <h5 class="card-header" style="text-align:center;">Total Pengguna</h5>
                        <canvas  id="UserChart"> </canvas>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data Pembelian</strong>
                            </div>
                            <div class="card-body">
                            <ul id="filter">
                                <li class="btn"> <label class="font-weight-bold"> Filter Status > </label> </li>
                                <li class="btn"><a href="#datatablePenjualan" data-value="" active>Semua</a></li>
                                <li class="btn"><a href="#datatablePenjualan" data-value="Proses">Proses</a></li>
                                <li class="btn"><a href="#datatablePenjualan" data-value="Pengiriman">Pengiriman</a></li>
                                <li class="btn"><a href="#datatablePenjualan" data-value="Sampai Tujuan">Sampai Tujuan</a></li>
                                <li class="btn"><a href="#datatablePenjualan" data-value="Selesai">Selesai</a></li>
                                <li class="btn"><a href="#datatablePenjualan" data-value="Piutang">Piutang</a></li>
                            </ul>

                            <div class="table-responsive">
                              <table id="datatablePenjualan" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Tanggal Order</th>
                                            <th>Customer</th>
                                            <th>Status Order</th>
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
                </div><!-- .row -->
                

            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->


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


    var ctx3 = document.getElementById("UserChart").getContext('2d');
		var myChart = new Chart(ctx3, {
			type: 'pie',
			data: {
				labels: ["Customer", "Sales"],
				datasets: [{
					label: '',
					data: [
					<?php 
					$jumlah_teknik = mysqli_query(getConn(),"select * from customer");
					echo mysqli_num_rows($jumlah_teknik);
					?>, 
					<?php 
					$jumlah_teknik = mysqli_query(getConn(),"select * from sales");
					echo mysqli_num_rows($jumlah_teknik);
					?>
					],
					backgroundColor: [
					'rgba(250, 99, 71, 0.5)',
					'rgba(26, 128, 127, 0.5)'
					],
					borderColor: [
                    'rgba(250, 99, 71, 1)',
					'rgba(26, 128, 127, 1)'
					],
					borderWidth: 1
				}]
			},
		});

    $(document).ready(function () {
        var table= "";
        table = $('#datatablePenjualan').DataTable( 
        {
            dom: 'Bfrtip',
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
                 "url":"datatable_penjualan.php",
                 "type":"POST"
             },
             "deferRender":true,
             "aLengthMenu":[[10,20,50],[10,20,50]], //combobox limit
             "columns":[
                
                 {"data":"id_hjual"},
                 {"data":"tanggal_order"},
                 {"data":"id_cust"},
                 {"data":"status_order",
                    "searchable": false,
                    "orderable":false,
                    "render": function (data, type, row) {  
                        if (row.status_order == 'Proses') //proses
                        {
                            return "<label class='text-success font-weight-bold'>Proses</label> ";
                        }
                        else if (row.status_order == 'Pengiriman') //pengriman
                        {
                            return "<label class='text-warning font-weight-bold'>Pengiriman</label>";
                        }
                        else if (row.status_order == 'Sampai Tujuan') //piutang
                        {
                            return "<label class='text-info font-weight-bold'>Barang telah tiba</label>";
                        }
                        else if (row.status_order == 'Selesai') //selesai
                        {
                            return "<label class='text-info font-weight-bold'>Selesai</label> <br>"+
                            "<small> Diterima : " + row.tanggal_orderselesai + " </small>";
                        }
                        else if (row.status_order == 'Piutang') //piutang
                        {
                            return "<label class='text-danger font-weight-bold'>Piutang</label>";
                        }                       
                    }
                },
                 {                   
                    "target": -1,
                    "defaultContent": "<button id=\"GetDetail\" class='btn btn-outline-primary'>Detail</button>"
                },              
             ],
        }) 
        //end of datatble list barang

        //filter list order berdasarkan status yang dpilih
        var table = $('#datatablePenjualan').DataTable();
        $('#filter').on( 'click', 'a', function () {
            console.log($(this).data("value"));
            table.search( $(this).data("value")).draw();
           // 
            if ($(this).data("value") == "") {
                $('#datatablePenjualan').DataTable().ajax.reload(); //reload ajax datatable 
               
            }
            //$('#tabledetailorder').empty();
        } );
        //end of filter list order berdasarkan status yang dpilih
    });
</script>
</html>

