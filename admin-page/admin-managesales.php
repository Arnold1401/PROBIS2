<?php
require_once("adminhead.php");
include_once('adminconn.php');


$isi = 50;
$page = isset($_GET["isi"])? (int)$_GET["isi"]:1;
$mulai = ($page>1) ? ($page*$isi) - $isi :0;
$result = mysqli_query(getConn(), "select * from sales");
$total = mysqli_num_rows($result);
$pages = ceil($total/$isi);
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html>
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
                    <a href="admin-home.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">Master</h3><!-- /.menu-title -->
                    <li>
                        <a href="admin-manageuser.php"> <i class="menu-icon fa fa-laptop"></i>User </a>
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
                        <h1>Master Sales</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>      
                            <li><a href="#">Master</a></li>                            
                            <li><a href="#">Sales</a></li>                                                  
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                <div class="col-md-12">
                    <form class="was-validated">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="" class="form-control-label">Nama Sales</label>
                                <input type="text" id="nama_sales" class="form-control" aria-describedby="helpnama_sales" required>
                                <small id="helpnama_sales" class="invalid-feedback">Masukkan nama lengkap sales</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="" class=" form-control-label">Email Sales</label>
                                <input type="email" id="email" class="form-control" placeholder="contoh@gmail.com" aria-describedby="helpemail_sales" required>
                                <!-- <small id="helpemail_sales">Masukkan email sales</small> -->
                            </div>

                            <div class="form-group">
                                <label for="" class=" form-control-label">No KTP Sales </label>
                                <!-- <input id="no_ktp" type="text" maxlength="10" min="1" class="form-control" pattern="/[^\d]/"/> DO NOT DELETE THIS-->

                                <input id="no_ktp" type="text" maxlength="16" min="16" onkeydown="return numbersonly(this, event);" onkeyup="javascript:pemisahktp(this);" class="form-control" id="nomor_ktp" placeholder="Nomor KTP" aria-describedby="helpnomor_ktp" required />
                                <small id="helpnomor_ktp" class="invalid-feedback">Masukkan nomor KTP Anda (Contoh: 1234-5678-9123-4567)</small>                            
                            </div>

                            <div class="form-group">
                            <!-- ^08[0-9]{9,}$ -->
                            <!-- /^-?\d+\.?\d*$/ -->
                                <label for="" class=" form-control-label">No Telpon </label>
                                <input id="nomor_telepon" type="number" class="form-control" aria-describedby="helpnomor_telepon_sales" required onKeyPress="if(this.value.length==12) return false;">
                                <small id="helpnomor_telepon_sales" class="invalid-feedback">Masukkan nomor telepon sales</small>
                            </div>
                        </div>
                        <!-- end col 6 -->
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="" class=" form-control-label">Provinsi</label>
                                <select class="form-control" id="provinsi" onchange="cb_city()" aria-describedby="helpprovinsi_user" required>
                                   <!-- isi ajax -->
                                </select>
                                <small id="helpprovinsi_user">Pilih Provinsi </small>
                            </div>

                            <div class="form-group">
                                <label for="" class=" form-control-label">Kota</label>                   
                                <select class="form-control" id="kota"  onchange="cb_subdistrict()" aria-describedby="helpkota_user" required>
<!--  -->
                                </select>
                                <small id="helpkota_user" class="invalid-feedback">Pilih Kota</small>
                            </div>

                            <div class="form-group"> 
                                <label for="" class=" form-control-label">Kecamatan</label>
                                <select class="form-control" id="kecamatan" aria-describedby="helpkecamatan_user" required>
                                <!--  -->
                                </select>
                                <small id="helpkecamatan_user" class="invalid-feedback">Pilih Kecamatan</small>
                            </div>

                            <div class="form-group">
                                <label for=""class=" form-control-label">Alamat</label>
                                <textarea placeholder="Alamat Anda" name="alamat" class="form-control" id="alamat_user" rows="3" aria-describedby="helpalamat_sales" required></textarea>
                                <small id="helpalamat_sales" class="invalid-feedback">Masukkan Alamat Anda</small>
                            </div>  

                            <div class="row">
                                <div class="col-md-4">
                                    <section class="card">                                   
                                        <button type="button" class="btn btn-success btn-md " onclick="tambahsales()">
                                            <i class="fa fa-dot-circle-o"></i> Tambahkan
                                        </button>                                      
                                    </section>
                                </div>
                                <div class="col-md-4">
                                    <section class="card">
                                    <button type="submit" class="btn btn-danger btn-md">
                                            <i class="fa fa-ban"></i> Reset
                                            </button>
                                    </section>
                                </div>
                                <div class="col-lg-4">
                                    <!-- <section class="card">
                                    <button type="submit" class="btn btn-warning btn-md float-right">
                                            <i class="fa fa-ban"></i> Ubah
                                            </button>
                                    </section> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <small>*Pilih tombol Tambahkan untuk menambah sales baru</small><br>
                                <small>*Pilih tombol Reset untuk mereset isi inputan diatas</small><br>
                               
                            </div>
                        </div>
                        <!-- end col 6 -->
                    </form>
                </div> <!-- end col 12 -->
                </div><!-- end row  -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">List Sales</strong>
                            </div>
                            <div class="card-body">
                              <small>*Tombol List Reseller - list reseller yang dibebani oleh setiap sales</small><br>
                              <small>*Tombol Detail - Detail dari setiap sales</small><br>
                              <small>*Pencarian dapat dilakukan pada textbox yang disediakan</small><br>
                              <div class="table-responsive">
                              <table id="example" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Nama </th>
                                            <th>Email</th>
                                            <th>No KTP</th>
                                            <th>Nomor Telepon</th>
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
            </div><!-- .animated -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Modal utk list reseller -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">List Reseller</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">               
                    <table id="fetchDataReseller" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Email</th>
                            <th>Nama Perusahaan </th>
                            <th>No Telpon</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
    <!--end of Modal utk list reseller -->

   
    <!-- kumpulan script luar -->
    <?php      include_once('kumpulanscriptluar.php'); ?>
    <!-- end of kumpulan script -->
</body>

</html>
<script type="text/javascript">

    //function detail di fetchDataReseller
    function format ( d ) {
        // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; width:100%">'+
            '<tr>'+
                '<td>Provinsi</td>'+
                '<td>'+d.provinsi+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Kota</td>'+
                '<td>'+d.kota+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Kecamatan</td>'+
                '<td>'+d.kecamatan+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Alamat</td>'+
                '<td>'+d.alamat+'</td>'+
            '</tr>'+
        '</table>';
    }
    //function detail di fetchDataReseller

    $(document).ready(function() {
        var table= "";
        
        //datatable di list sales
        table = $('#example').DataTable( 
        {
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
                 "url":"datatable_sales.php",
                 "type":"POST"
             },
             "deferRender":true,
             "aLengthMenu":[[10,20,50],[10,20,50]], //combobox limit
             "columns":[
                
                 {"data":"id_sales"},
                 {"data":"nama_sales"},
                 {"data":"email"},
                 {"data":"no_ktp"},
                 {"data":"nomor_telepon"},
                 {                   
                    "target": -1,
                    "defaultContent": "<button id=\"GetDetail\" class='btn btn-outline-success'>Detail</button> <button id=\"GetListReseller\" class='btn btn-outline-primary' data-toggle='modal' data-target='#myModal'>List Reseller</button>"
                },              
             ],
        } 
        
        );


        setInterval( function () {
             table.ajax.reload();
        }, 30000 );

        
        table.buttons().container()
             .appendTo( '#example_wrapper .col-md-6:eq(0)' );
       
    


        //end of datatble di list sales
        

        //function onclick untuk button list reseller dan details pada datatable list sales 
        var getId, data, tablelistreseller = "";
        $('#example tbody').on( 'click', 'button', function () {
            var action = this.id;
            data = table.row($(this).closest('tr')).data();
        
            //action button List Reseller
            if (action=='GetListReseller')
            {   
                getId = data[Object.keys(data)[0]];
                console.log(getId); //alert(getId);  utk dapatkan id salesnya
                        
                //datatable di list reseler -- show modal
                tablelistreseller = $('#fetchDataReseller').DataTable( {
                    // retrieve: true,
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
                          "url":"datatable_listreseller.php",
                          "type":"POST",
                          "data":{"get_id":getId},
                      },
                      "deferRender":true,
                      "aLengthMenu":[[10,20,50],[10,20,50]], //combobox limit
                      "columns":[
                          {"data":"id_cust"},
                          {"data":"email"},
                          {"data":"nama_perusahaan"},                         
                          {"data":"notelp"},
                          {"data":"alamat_lengkap"},
                      ],
                  } );
                //end of datatable di list reseler -- show modal                
            }
            //end of action button List Reseller
            
            //action button Detail
            if(action == 'GetDetail')
            {
                getId = data[Object.keys(data)[0]];
                var tr = $(this).closest('tr');
                var row = table.row( tr );
                
                if ( row.child.isShown() ) 
                {   // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }       
                else 
                {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            }
            //end of action button Detail
        } );
        //end of function onclick untuk button list reseller dan details pada datatable list sales 
       
       //event jika sales dipilih/diclick 
       $('#example tbody').on('click', 'tr', function () {
            
            $(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
        } );
        //end of event jika sales dipilih/diclick 

        //event jika list reseller dipilih/diclick 
        $('#fetchDataReseller tbody').on('click', 'tr', function () {
            $(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
        } );
        //end of event jika list reseller dipilih/diclick 
    }); 
    // end of document ready


    // API
    function cb_prov(){
        $.post("ajaxs/ajaxregister.php",
        {
            jenis:"getprovince",
        },
        function(data){
            console.log(data);
            $("#provinsi").html(data);
        });
    }

    cb_prov();

    function cb_city() {
        $.post("ajaxs/ajaxregister.php",
        {
            jenis:"getcity",
            province:$("#provinsi").val(),
        },
        function(data){
            console.log(data);
            $("#kota").html(data);
        });
        $("#kota").val(-1);
    }

    function cb_subdistrict() {
        if ($("#kota").val()!=null) {
            $.post("ajaxs/ajaxregister.php",
            {
                jenis:"getsubdistrict",
                city:$("#kota").val(),
            },
            function(data){
                console.log(data);
                $("#kecamatan").html(data);
            });
        }
        
    }
    //end of API


    // pemisah ktp
    function pemisahktp(noktp)
    {
        var _minus = false;
        if (noktp<0) _minus = true;
        noktp=noktp.toString();
        noktp=noktp.replace(".","");
        noktp=noktp.replace("-","");
        
        c = "";
        panjang = noktp.length;
        j = 0;
        for (i = panjang; i > 0; i--)
        {
            j = j + 1;
            
            if (((j % 4) == 1) && (j != 1))
            {
                c = noktp.substr(i-1,1) + "-" + c;
            }else
            {   c = noktp.substr(i-1,1) + c;    }
        }
        
        if (_minus) c = "-" + c ;
        return c;
          
    }
    
    function numbersonly(ini, e)
    {
        
        if (e.keyCode>=49)
        {
        if(e.keyCode<=57)
        {
        a = ini.value.toString().replace(".","");
        noktp = a.replace(/[^\d]/g,"");
        noktp = (noktp=="0")?String.fromCharCode(e.keyCode):noktp + String.fromCharCode(e.keyCode);
        ini.value = pemisahktp(noktp);

        return false;
        }

        else if(e.keyCode<=105){
        if(e.keyCode>=96){
        //e.keycode = e.keycode - 47;
        a = ini.value.toString().replace(".","");
        noktp = a.replace(/[^\d]/g,"");
        noktp = (noktp=="0")?String.fromCharCode(e.keyCode-48):noktp + String.fromCharCode(e.keyCode-48);
        ini.value = pemisahktp(noktp);
        //alert(e.keycode);
        return false;
        }
        else {return false;}
        }else {
        return false; }
        }else if (e.keyCode==48){
        a = ini.value.replace(".","") + String.fromCharCode(e.keyCode);
        noktp = a.replace(/[^\d]/g,"");
        if (parseFloat(noktp)!=0){
        ini.value = pemisahktp(noktp);
        return false;
        } else {return false;}
        }else if (e.keyCode==95){
        a = ini.value.replace(".","") + String.fromCharCode(e.keyCode-48);
        noktp = a.replace(/[^\d]/g,"");
        if (parseFloat(noktp)!=0){
            ini.value = pemisahktp(noktp);
            return false;
            } else {return false;}
        }else if (e.keyCode==8 || e.keycode==46){
            a = ini.value.replace(".","");
            noktp = a.replace(/[^\d]/g,"");
            noktp = noktp.substr(0,noktp.length -1);
            
            if (pemisahktp(noktp)!=""){
                ini.value = pemisahktp(noktp);
            } else {ini.value = "";}
            
            return false;
            } else if (e.keyCode==9){
            return true;
            } else if (e.keyCode==17){
            return true;
            } else {
            //alert (e.keyCode);
            return false;
            }
    }
    // end pemisah ktp

    //function button onclick TAMBAHSALES
    function tambahsales() 
    {
        //validasi setiap inputan
        (function() {
        'use strict';
        window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            form.classList.add('was-validated');
            }, false);
        });
        }, false);
        })();


        (function($){
            $.post("adminajax.php",
            {
                jenis: "tambah_sales",
                nama_sales:document.getElementById('nama_sales').value,
                email:document.getElementById('email').value,
                no_ktp:noktp,
                nomor_telepon:document.getElementById('nomor_telepon').value,
                provinsi:document.getElementById('provinsi').value,
                kota:document.getElementById('kota').value,
                kecamatan:document.getElementById('kecamatan').value,
                alamat:document.getElementById('alamat_user').value,

            },
            function (data) {
                alert(data);
                $('#example').DataTable().ajax.reload(); //reload ajax datatable list sales after inserted data
        });
            
        }(jQuery))

        // reset inputan
        document.getElementById('nama_sales').value="";
        document.getElementById('email').value = "";
        document.getElementById('no_ktp').value = "";
        document.getElementById('nomor_telepon').value="";
        document.getElementById('provinsi').value = "";
        document.getElementById('kota').value = "";
        document.getElementById('kecamatan').value = "";
        document.getElementById('alamat_user').value = "";

    }
    //END OF function button onclick TAMBAHSALES

</script>