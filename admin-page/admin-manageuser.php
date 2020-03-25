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
                            <li><a href="#">User</a></li>                                                  
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
                                <strong class="card-title">User</strong>
                            </div>
                            <div class="card-body card-block">

                                <!-- crud barang-->
                                <form action="">

                                  <div class="row form-group">
                                    <div class="col col-md-3">
                                      <label for="file-input" class=" form-control-label">Gambar KTP</label>
                                    </div>
                                      
                                    <div class="col-12 col-md-9">
                                      <input type="file" id="file-input" name="file-input" class="form-control-file">
                                    </div>
                                  </div>

                                  <h4>Profil Usaha </h4><hr>

                                  <div class="form-group">
                                    <label for="" class=" form-control-label">Nama Perusahaan/Toko</label>
                                      <input type="text" id="" name="" value="EMOS" class="form-control" readonly>
                                  </div>
                                  
                                  <h4>Profil Pemilik </h4><hr>

                                  <div class="form-group">
                                    <label for="" class=" form-control-label">No KTP </label>
                                    <input id="no_ktp" type="text" onkeydown="return numbersonly(this, event);" onkeyup="javascript:pemisahktp(this);" class="form-control" value="1234567890123456" id="nomor_ktp" placeholder="Nomor KTP" aria-describedby="helpnomor_ktp" required>
                                  </div>

                                  <div class="form-group">
                                    <label for="" class=" form-control-label">Nama Pemilik </label>
                                      <input readonly type="text" id="" name="" value="Alfira Jessica" class="form-control">
                                  </div>

                                  <div class="form-group">
                                    <label for="" class=" form-control-label">Email</label>
                                      <input readonly type="text" id="" name="" value="alfirajessica@gmail.com" class="form-control">
                                  </div>
                                  
                                  <div class="form-group">
                                    <label for="" class=" form-control-label">No Telpon </label>
                                      <input readonly type="number" id="" name="" value="082288569879" class="form-control">
                                  </div>

                                  <div class="form-group">
                                    <label for="" class=" form-control-label">Tanggal/Bulan/Tahun Lahir </label>
                                      <input readonly type="date" id="" name="" value="01/04/1999" class="form-control">
                                  </div>

                                  <div class="form-group">
                                    <label for="" class=" form-control-label">Jenis Kelamin </label>
                                    <select readonly name="select" id="select" class="form-control">
                                        <option value="0">Wanita</option>
                                        <option value="1">Pria</option>
                                      </select>
                                  </div>

                                  <div class="form-group">
                                    <label for=""class=" form-control-label">Alamat</label>
                                    <textarea readonly class="form-control" name="" id="" rows="3" placeholder="Jl Bratang Binangun I no 73" class="form-control"></textarea>
                                  </div>        
                                  
                                  <div class="form-group">
                                    <label for="" class=" form-control-label">Sales Yang bertanggung jawab </label>
                                    <select readonly name="select" id="select" class="form-control">
                                        <option value="0">001 - Arnold</option>
                                        <option value="1">002 - Wily</option>
                                      </select>
                                  </div>

                                <div class="form-group">
                                <button type="submit" class="btn btn-success btn-md">
                                    <i class="fa fa-dot-circle-o"></i> Valid
                                  </button>

                                  <button type="submit" class="btn btn-danger btn-md">
                                    <i class="fa fa-ban"></i> Tidak Valid
                                  </button>

                                  <button type="submit" class="btn btn-warning btn-md float-right">
                                    <i class="fa fa-ban"></i> Ubah Sales
                                  </button>
                                </div>
                                 

                                  <br>

                                  <div class="form-group">
                                  <small>*Pilih tombol Valid untuk mengubah status user jika data yang diinputkan sesuai KTP</small><br>
                                  <small>*Pilih tombol Tidak Valid jika data yang diinputkan user tidak sesuai KTP</small><br>
                                  <small>*Pilih tombol Ubah Sales jika user meminta pergantian sales</small><br>
                                  </div>
                                 
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

                            <div class="form-group">
                                <small>*Status Menunggu - data user belum dicek/diperiksa</small><br>
                              <small>*Status Valid - data user sesuai</small><br>
                              <small>*Status Tidak Valid - data user tidak sesuai</small><br>
                            </div>
                              
                              <div class="table-responsive">
                              <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No Pelanggan</th>
                                            <th>Nama </th>
                                            <th>Email</th>
                                            <th>Nomor KTP</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $urutan = 1;
                                            $res = mysqli_query(getConn(), "select * from customer");
                                            if (mysqli_num_rows($res)>0) {
                                                while($data = mysqli_fetch_assoc($res)){ ?>
                                                    <tr>
                                                        <td> <?php echo $urutan++; ?> </td>
                                                        <td> <?php echo $data["nama_perusahaan"] ?> </td>
                                                        <td> <?php echo $data["nama_pemilik"] ?> </td>
                                                        <td> <?php echo $data["email"] ?> </td>
                                                    </tr>
                                            <?php    }
                                            }
                                        ?>
                                

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

    <!-- Right Panel -->


    <!-- kumpulan script luar -->
    <?php      include_once('kumpulanscriptluar.php'); ?>
    <!-- end of kumpulan script -->
</body>

</html>
<script>
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

    function keluar(){
    $.post("ajaxs/ajaxlogin.php",
        {
            jenis:"keluar",
        },
        function(data){
            window.location.href="../user-page/login.php";
        });

}

//list table
</script>
