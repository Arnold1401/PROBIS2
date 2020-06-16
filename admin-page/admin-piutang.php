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
                        <h1>Master Piutang</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>      
                            <li><a href="#">Master</a></li>                            
                            <li><a href="#">Piutang</a></li>                                                  
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
                            <table id="piutangtabel" class="table table-striped table-bordered" width="100%" >
                                <thead>
                                    <tr class="clickable-row">
                                        <th>Id Hutang</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Tanggal Jatuh Tempo</th>
                                        <th>Total Hutang</th>
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
                            <div class="card-header">
                                <strong class="card-title" id="ket">#</strong>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                <table id="detailpiutangtabel" class="table table-striped table-bordered" width="100%" >
                                <thead>
                                    <tr class="clickable-row">
                                        <th>#ID detail</th>
                                        <th>Barang</th>
                                        <th>Kuantiti</th>
                                        <th>Subtotal</th>
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
    var piutangtabel="";
    //datatable di list user
    piutangtabel = $('#piutangtabel').DataTable( 
    {
        destroy: true, //destroy dulu biar ngerefresh pas ganti2 
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
                "url":"datatable_piutang.php",
                "type":"POST"
            },
            "deferRender":true,
            "aLengthMenu":[[10,20,50],[10,20,50]], //combobox limit
            "columns":[ 
            {"data":"id_piutang"},               
            {"data":"nama_perusahaan"},                         
            {"data":"tanggal_jatuh_tempo", render: $.fn.dataTable.render.moment('DD-MMMM-YYYY')},
            {"data":"sisa_tagihan", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' )},
            {"data":"id_piutang",
                    "searchable": true,
                    "orderable":true,
                    "render": function (data, type, row) {
                          return "<button id=\"GetDetail\" class='btn btn-outline-primary'>Detail Pesanan</button>";
                    },
                    "target":-1,
                },
            ],
    } );

    //event jika list barang dipilih/diclick 
    $('#piutangtabel tbody').on('click', 'tr', function () {
            $(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
        } );
        //end of event jika list barang dipilih/diclick 

    var tabledetail, getIdhjual, getTotal="";
    $('#piutangtabel tbody').on( 'click', 'button', function () {
            var action = this.id;
            data = piutangtabel.row($(this).closest('tr')).data();

            if(action == 'GetDetail') {
                
                getIdhjual =data[Object.keys(data)[1]];
                getTotal = data[Object.keys(data)[6]]; //ongkir
                $("#ket").html(getIdhjual);
                

                //table detail order barang dibagian bawah
                tabledetail = $('#detailpiutangtabel').DataTable( {
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
                            var ongkir = getTotal - total;
                            $("#Ongkir").html(
                                $.fn.dataTable.render.number('.','.','2','Rp').display(ongkir)
                            );
                            $("#totalsemua").html(
                                $.fn.dataTable.render.number('.','.','2','Rp').display(getTotal)
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

