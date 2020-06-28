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
                        <h1>Laporan Piutang yang dibayar terlambat</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>      
                            <li><a href="#">Laporan</a></li>                            
                            <li><a href="#">Piutang</a></li>                                                  
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
                                <strong class="card-title">List Pelanggan dan Rata-rata keterlambatan</strong>
                                
                            </div>
                            <div class="card-header">
                                <strong class="card-title" id="ctk" >
                                <!--
                                <form>

                                    <input type="submit"  >
                                </form>
                               --->




                                <button id="cc2">
                                    <a id="cc" > Mencetak laporan </a>
                                </button>
                                
                                </strong>
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
                            <div class="table-responsive" id="nah">
                             
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
        var tablesales="";
        
        //datatable di list kinerja sales 
        tablesales = $('#tablesales').DataTable( 
        {
            
        } );
        //end of datatable di list kinerja sales 

        //event jika list sales dipilih/diclick 
        $('#tablesales tbody').on('click', 'tr', function () {
            $(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
        } );
        //end of event jika list sales dipilih/diclick 
        
        var today= new Date();
        var tgl= today.getDate();
        var bulan= today.getMonth()+1;

        if(bulan<10){
            bulan='0'+bulan;
        }
        var tahun= today.getFullYear();
        var full='';

        full=full.concat(tahun,'-',bulan,'-',tgl).toString()
        document.getElementById("tgl_awal").value =full;
        document.getElementById("tgl_akhir").value =full;

        var link="ajaxs/ajaxpiutang.php?"+"tgl_awal="+full+"&&tgl_akhir="+full;

        $("#nah").load(link);

        $("#cc2").click(function(){
            var linkk="exportLaporan/laporanPiutang.php?"+"tgl_awal="+document.getElementById("tgl_awal").value+"&&tgl_akhir="+document.getElementById("tgl_akhir").value;
            window.location.href = linkk;
        })




$("#tgl_akhir").change(function(){

  var awal= $("#tgl_awal").val();
var akhir=  $("#tgl_akhir").val();




var link="ajaxs/ajaxpiutang.php?"+"tgl_awal="+awal+"&&tgl_akhir="+akhir;

$("#nah").load(link);
})





$("#tgl_awal").change(function(){

var awal= $("#tgl_awal").val();
var akhir=  $("#tgl_akhir").val();

var link="ajaxs/ajaxpiutang.php?"+"tgl_awal="+awal+"&&tgl_akhir="+akhir;

$("#nah").load(link);

})




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
