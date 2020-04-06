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
                        <h1>Master Customer</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>      
                            <li><a href="#">Master</a></li>                            
                            <li><a href="#">Customer</a></li>                                                  
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
                                <strong class="card-title">List Customer</strong>
                            </div>
                            <div class="card-body">

                            <div class="form-group">
                                <small>*Status Menunggu - data user belum dicek/diperiksa</small><br>
                              <small>*Status Valid - data user sesuai</small><br>
                              <small>*Status Tidak Valid - data user tidak sesuai</small><br>
                            </div>
                              
                              <div class="table-responsive">
                              <table id="tableusers" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#ID customer</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Nama Pemilik</th>
                                            <th>Asal</th>
                                            <th>Status</th>
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

    <!-- Modal utk list sales -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">List Sales Terdekat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body"> 
                    <h5> Sales yang bertanggung jawab atas Customer sekarang </h5>

                    <table id="sales_bertanggungjawab" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr class="clickable-row">
                            <th>#ID</th>
                            <th>Email</th>
                            <th>Nama Sales </th>
                            
                            <th>Provinsi</th>
                            <th>Kota</th>
                            <th>Kecamatan</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>

                    <br>


                    <table id="listSalesNear" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr class="clickable-row">
                            <th>#ID</th>
                            <th>Email</th>
                            <th>Nama Sales </th>
                            <th>Provinsi</th>
                            <th>Kota</th>
                            <th>Kecamatan</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                    <br>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" id="jadikansalescustini" class="btn btn-outline-primary">Jadikan Sales untuk customer ini</button> 
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--end of Modal utk list sales -->

    <!-- kumpulan script luar -->
    <?php      include_once('kumpulanscriptluar.php'); ?>
    <!-- end of kumpulan script -->
</body>

</html>
<script>

    //function detail di list customer
    function format ( d ) {
        // `d` is the original data object for the row
        var jenis_kelamin = "";
        var lahir = moment(d.tanggal_lahir).format("DD MMMM Y");          

        if(d.jenis_kelamin == "0"){
            jenis_kelamin = "Wanita";
        }else{
            jenis_kelamin = "Pria";
        }
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px; width:100%;">'+
            '<tr>'+
                '<td>Foto KTP</td>'+
                '<td> <img src="../user-page/'+d.foto_ktp+'" width:"100px" ></img></td>'+
            '</tr>'+
            '<tr>'+
                '<td>Tanggal Lahir</td>'+
                '<td>'+d.nomor_ktp+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Tanggal Lahir</td>'+
                '<td>'+lahir +'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Jenis Kelamin</td>'+
                '<td>'+ jenis_kelamin+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>No Telepon</td>'+
                '<td>'+d.notelp+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Email</td>'+
                '<td>'+d.email+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Alamat</td>'+
                '<td>'+d.provinsi + ', ' + d.kota + ', ' + d.kecamatan + ', ' + d.alamat_lengkap +'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Apakah Data Valid?</td>'+
                '<td>'+
                    '<button onclick="datavalid('+d.id_cust+')" type="submit" class="btn btn-success btn-md"><i class="fa fa-dot-circle-o"></i> Valid </button>' + '  ' +
                    '<button onclick="datatdkvalid('+d.id_cust+')" type="submit" class="btn btn-danger btn-md"><i class="fa fa fa-ban"></i> Tidak Valid </button> <br>' +
                    '<small>*Pilih tombol Valid untuk mengubah status user jika data yang diinputkan sesuai KTP</small><br>'+
                    '<small>*Pilih tombol Tidak Valid jika data yang diinputkan user tidak sesuai KTP</small><br>' +
                '</td>'+
            
            '</tr>'+
        '</table>';
    }
    //end of function detail di list customer

    function datavalid(id_cust) {
        
        $.post("adminajax.php",
        {
            jenis:"data_valid", 
            id_cust :id_cust,
        },
        function(data){
            alert(data);
            $('#tableusers').DataTable().ajax.reload(); //reload ajax datatable list sales after inserted data
        });
    }

    function datatdkvalid(id_cust) {
        
        $.post("adminajax.php",
        {
            jenis:"data_tdkvalid", 
            id_cust :id_cust,
        },
        function(data){
            alert(data);
            $('#tableusers').DataTable().ajax.reload(); //reload ajax datatable list sales after inserted data
        });
    }

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

    //document ready
    $(document).ready(function () {
        var tableuser="";

        //datatable di list user
        tableuser = $('#tableusers').DataTable( 
        {
             "buttons": [ 'copy', 'excel', 'pdf' ],
             "processing":true,
             "serverSide":true,
             "ordering":true, //set true agar bisa di sorting
             "order":[[0, 'asc']], //default sortingnya berdasarkan kolom, field ke 0 paling pertama
             "ajax":{
                 "url":"datatable_users.php",
                 "type":"POST"
             },
             "deferRender":true,
             "aLengthMenu":[[10,20,50],[10,20,50]], //combobox limit
             "columns":[ 
                {"data":"id_cust"},               
                {"data":"nama_perusahaan"},                         
                {"data":"nama_pemilik"},
                {"data":"provinsi"},
                {"data":"status",
                    "searchable": false,
                    "orderable":false,
                    "render": function (data, type, row) {  
                        if (row.status == '0') {
                            return "<button type='button' class='btn btn-warning btn-sm'>Menunggu</button>";
                        }
                        else if (row.status == '1') {
                            return "<button type='button' class='btn btn-success btn-sm'>Valid</button>";
                        }
                        else if (row.status == '2') {
                            return "<button type='button' class='btn btn-danger btn-sm'>Tidak Valid</button>";
                        }
                        
                    }
                },
                {"data":"status",
                    "searchable": false,
                    "orderable":false,
                    "render": function (data, type, row) {  
                        if (row.status == '1') {
                            return "<button type='button' id=\"Atur_Sales\" data-toggle='modal' data-target='#myModal' class='btn btn-outline-primary btn-sm'>Atur Sales</button>";
                                
                            
                        }
                        else if (row.status == '0' || row.status == '2') {
                            return "<button type='button' id=\"GetDetail\" class='btn btn-outline-info btn-sm'>Detail</button>";
                        }
                        
                    },
                    "target":-1,
                },
                          
             ],
        } );

        //function onclick untuk button atur sales dan detail pada datatable list customer 
        var getId, data, listSalesNear,datal, salesbertanggungjwb, getsaltId, getCustId = "";
        $('#tableusers tbody').on( 'click', 'button', function () {
            var action = this.id;
            data = tableuser.row($(this).closest('tr')).data();
        
            //action button List sales dimana hanya menunjukkan sales yang provinsinya sama dengan customer tersebut
            if (action=='Atur_Sales')
            {
                getId = data[Object.keys(data)[15]]; //utk dapatkan id provinsi customer
                getCustId = data[Object.keys(data)[0]]; //utk dapatkan id customer
                getsaltId = data[Object.keys(data)[11]]; //utk dapatkan id salesnya

                console.log(getsaltId); 
                        
                //datatable di list reseler -- show modal
                    //datable di list sales sesuai provinsi customer
                    listSalesNear = $('#listSalesNear').DataTable( {
                        // retrieve: true,
                        destroy: true, //destroy dulu biar ngerefresh pas ganti2 
                        "buttons": [ 'copy', 'excel', 'pdf' ],
                        "select":true,
                        "processing":true,
                        "serverSide":true,
                        "ordering":true, //set true agar bisa di sorting
                        "order":[[0, 'asc']], //default sortingnya berdasarkan kolom, field ke 0 paling pertama
                        "ajax":{
                            "url":"datatable_listSalesNear.php",
                            "type":"POST",
                            "data":{"get_provinsi":getId},
                        },
                        "deferRender":true,
                        "aLengthMenu":[[10,20,50],[10,20,50]], //combobox limit
                        "columns":[
                            {"data":"id_sales"},
                            {"data":"email"},
                            {"data":"nama_sales"},                         
                            {"data":"provinsi"},
                            {"data":"kota"},
                            {"data":"kecamatan"},
                        ],
                    } );
                    //end of datable di list sales sesuai provinsi customer

                    //event jika sales dipilih/diclick -- utk mendapatkan id sales
                    var gt = "";
                    $('#listSalesNear tbody').on('click', 'tr', function () {
                        var action = this.id;
                        
                        datal = listSalesNear.row($(this).closest('tr')).data();
                        gt = datal[Object.keys(datal)[0]];  //utk dapatkan id sales yang ada di listsalesnear

                        $(this).addClass('bg-info').siblings().removeClass('bg-info');
                        
                    // alert( 'You clicked on '+gt+'\'s row' );
                    } );
                    //end of event jika sales dipilih/diclick -- utk mendapatkan id sales

                    //datatable di sales yang bertanggung jawab aas customer sekarang
                    salesbertanggungjwb = $('#sales_bertanggungjawab').DataTable( {
                        // retrieve: true,
                        destroy: true, //destroy dulu biar ngerefresh pas ganti2 
                        "select":true,
                        "processing":true,
                        "serverSide":true,
                        "ordering":true, //set true agar bisa di 
                        "info":false,
                        "order":[[0, 'asc']], //default sortingnya berdasarkan kolom, field ke 0 paling pertama
                        "ajax":{
                            "url":"datatable_salestanggungjwb.php",
                            "type":"POST",
                            "data":{"get_idsal":getsaltId},
                        },
                        "deferRender":true,
                        "lengthChange": false,
                        "sDom": 't', //hanya menampilkan table, menghilangkan search, paging, and filter row
                        "columns":[
                            {"data":"id_sales"},
                            {"data":"email"},
                            {"data":"nama_sales"},                         
                            {"data":"provinsi"},
                            {"data":"kota"},
                            {"data":"kecamatan"},
                        ],
                    } );
                    //end of datatable di sales yang bertanggung jawab aas customer sekarang

                    $('#jadikansalescustini').click( function () {
                        // table.row('.selected').remove().draw( false );
                        console.log(gt);
                        console.log(getCustId);
                        $.post("adminajax.php",
                        {
                            jenis:"jadikan_sales_utkcustini", 
                            id_cust : getCustId,
                            id_sales : gt,
                        },
                        function(data){
                            alert(data);
                           // $("#myModal").load();
                            $('#tableusers').DataTable().ajax.reload(); //reload ajax datatable list sales after inserted data
                            $('#sales_bertanggungjawab').DataTable().ajax.reload(); //reload ajax datatable sales yang bertanggung jawab di customer ini
                        });
                    } );

                    


                //end of datatable di list sales -- show modal                
                
            }
            //end of action button List Reseller
            
            //action button Detail
            if(action == 'GetDetail')
            {
                getId = data[Object.keys(data)[0]];
                console.log(getId); //alert(getId);  utk dapatkan id customer

                var tr = $(this).closest('tr');
                var row = tableuser.row( tr );
                
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
        //end of function onclick untuk button atur sales dan detail pada datatable list customer 


//  $('#listSalesNear tbody').on( 'click', 'tr', function () {
//  if ( $(this).hasClass('selected') ) {
//  $(this).removeClass('selected');
//  }
//  else {
//  listSalesNear.$('tr.selected').removeClass('selected');
//  $(this).addClass('selected');
//  }
//  } );

 

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
