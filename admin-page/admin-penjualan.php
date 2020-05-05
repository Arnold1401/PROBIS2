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
                        <div class="card" id="card_header_penjualan">
                            <div class="card-header">
                                <strong class="card-title">List Penjualan</strong>
                            </div>
                            <div class="card-body">
                           
                            <ul id="filter">
                                <li class="btn"><label class="font-weight-bold"> Filter Status</label></li>
                                <li class="btn"><a class="btn btn btn-outline-dark" href="#card_header_penjualan" data-value="" active>Semua</a></li>
                                <li class="btn"><a class="btn btn btn-outline-dark" href="#card_header_penjualan" type="button" data-value="Proses">Proses</a></li>
                                <li class="btn"><a class="btn btn btn-outline-dark" href="#card_header_penjualan" data-value="Pengiriman">Pengiriman</a></li>
                                <li class="btn"><a class="btn btn btn-outline-dark" href="#card_header_penjualan" data-value="Sampai Tujuan">Sampai Tujuan</a></li>
                                <li class="btn"><a class="btn btn btn-outline-dark" href="#card_header_penjualan" data-value="Selesai">Selesai</a></li>
                                <li class="btn"><a class="btn btn btn-outline-dark" href="#card_header_penjualan" data-value="Piutang">Piutang</a></li>
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
                    
                </div>
                <!--End Header piutang-->

                <!-- Detail piutang-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <!-- <div class="card-header">
                                <strong class="card-title" id="id_resi"></strong>
                            </div> -->
                            <div class="card-body">
                                No Order : <label id="id_hjual"></label>
                                <div class="table-responsive">
                                <table id="datatableDetailOrder" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Barang</th>
                                            <th>Kuantiti</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" style="text-align:right; font-weight:bold">Total:</th>
                                            <th style="font-weight:bold"></th>
                                        </tr>
                                    </tfoot>
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

    $(document).ready(function () {
        //end of datatble list penjualan
        var table= "";
        table = $('#datatablePenjualan').DataTable( 
        {
            
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
                 {"data":"nama_perusahaan"},
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
                    "defaultContent": "<button id=\"GetDetail\" class='btn btn-outline-primary'>Detail Order</button>"
                },              
             ],
        }) 
        //end of datatble list penjualan

        //filter list penjualan berdasarkan status yang dpilih
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
        //end of filter list penjualan berdasarkan status yang dpilih

        //event jika list penjualan dipilih/diclick 
        $('#datatablePenjualan tbody').on('click', 'tr', function () {
            $(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
        } );
        //end of event jika list penjualan dipilih/diclick 

        var tabledetail, getIdhjual="";
        //action button detail order dipilih pada list penjualan - header
        $('#datatablePenjualan tbody').on( 'click', 'button', function () {
            var action = this.id;
            data = table.row($(this).closest('tr')).data();

            if(action == 'GetDetail') {
                console.log(data[Object.keys(data)[0]]); //id hjual
                getIdhjual =data[Object.keys(data)[0]];
                $("#id_hjual").html(getIdhjual);
                //document.getElementById("id_hjual").value = getIdhjual;

                //table detail order barang dibagian bawah
                tabledetail = $('#datatableDetailOrder').DataTable( {
                    // retrieve: true,
                    destroy: true, //destroy dulu biar ngerefresh pas ganti2 
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
                          "url":"datatable_detailpenjualan.php",
                          "type":"POST",
                          "data":{"get_idhjual":getIdhjual},
                      },
                      "deferRender":true,
                      "aLengthMenu":[[10,20,50],[10,20,50]], //combobox limit
                      "columns":[
                          {"data":"id_djual"},
                          {"data":"nama_barang"},
                          {"data":"kuantiti"},                         
                          {"data":"subtotal", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' )},
                                        
                      ],                      
                      "footerCallback": function ( row, data, start, end, display ) {
                            var api = this.api(), data;
                          
                            //Remove the formatting to get integer data for summation
                            var intVal = function ( i ) {
                                return typeof i === 'string' ?
                                    i.replace(/[\$,]/g, '')*1 :
                                    typeof i === 'number' ?
                                        i : 0;
                            };
            
                            // Total over all pages
                            total = api
                                .column( 3 )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
                
                            // Total over this page
                            pageTotal = api
                                .column( 3, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
            
                            // Update footer
                            $( api.column( 3 ).footer() ).html(
                                $.fn.dataTable.render.number('.','.','2','Rp').display(total)
                            );
                        }
                } );
                //end of table detail order barang dibagian bawah
            }
            

        });
        //end of action button detail order dipilih pada list penjualan - header


    });


</script>

</html>

