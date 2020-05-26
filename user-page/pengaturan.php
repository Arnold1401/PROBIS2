<?php
require_once("head.php");
include_once "conn.php";
$email  = $_SESSION["email_user"];
$sql = "SELECT * FROM customer where email = '$email'";
$conn = getConn();
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    
</head>
<body class="goto-here">

    <!-- header paling atas -->
    <div class="py-1 bg-primary">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                            <span class="text">+ 1234 5678 9100</span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                            <span class="text">emos@gmail.com</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END header paling atas -->

     <!-- nav -->
     <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
        <a class="navbar-brand" href="home.php">EMOS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="home.php" class="nav-link">Beranda</a></li>
               
                <li class="nav-item"><a href="produk.php" class="nav-link">Produk</a></li>
                <li class="nav-item"><a href="cart.php" class="nav-link"><span class="icon-shopping_cart"></span>[<?php if (isset($_SESSION["keranjang"])) {
        $arrkeranjang=unserialize($_SESSION["keranjang"]);
        $count=count($arrkeranjang);
        echo $count;
    }else{
        echo 0;
    }
 ?>]</a></li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if(isset($_SESSION["nama_perusahaan"])){ echo $_SESSION["nama_perusahaan"];}?></a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                    <a class="dropdown-item" href="wishlist.php">Daftar Keinginan</a>
                    <a class="dropdown-item" href="status-order.php">Daftar Pesanan</a>
                    <a class="dropdown-item" href="tagihan.php">Tagihan</a>
                    <a class="dropdown-item" href="ulasan.php">Ulasan</a>
                    <hr>
                    <a class="dropdown-item active" href="pengaturan.php">Akun Saya</a>
                    <a onclick="keluar()" class="dropdown-item">Keluar</a>
                </div>
                </li>
            </ul>
        </div>
    </div>
    </nav>
    <!-- END nav -->

    <section class="ftco-section contact-section bg-light ">
        <div class="container">
            <div class="row block-9 justify-content-center">
                <div class="col-md-12 d-flex">
                    <div class="row my-2 col-12 pb-5 mx-0 px-0">

                        <!-- tabs -->
                        <div class="col-sm-12 col-12 col-lg-3 p-0 ">
                            <div class="nav nav-pills flex-column flex-sm-row nav-justified col-12 p-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">                   
                                <a class="col-lg-12 flex-sm-fill text-sm-center nav-link btn-outline-success active" id="v-pills-all-tab" data-toggle="pill" href="#v-pills-all" role="tab" aria-controls="v-pills-all" aria-selected="false">Akun</a>
                                <a class="col-lg-12 flex-sm-fill text-sm-center nav-link btn-outline-success" id="v-pills-sports-tab" data-toggle="pill" href="#v-pills-sports" role="tab" aria-controls="v-pills-sports" aria-selected="false">Profil</a>
                                <a class="col-lg-12 flex-sm-fill text-sm-center nav-link btn-outline-success" id="v-pills-address-tab" data-toggle="pill" href="#v-pills-address" role="tab" aria-controls="v-pills-address" aria-selected="false">Alamat Pengiriman</a>
                            </div>
                        </div>
                         <!-- end tabs -->

                         <!-- Pengaturan Akun dan password -->
                        <div class="tab-content col-12 col-lg-9 py-1 px-1" id="v-pills-tabContent">                                                       
                            <div class="tab-pane fade show active bg-white p-3 contact-form" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-all-tab">
                                <h4 class="mb-4">Pengaturan Akun</h4> <hr>
                                <form  method="POST" action="#" class="form-group" >
                                    <div class="alert alert-warning" role="alert">
                                        Silakan verifikasi akun Anda pada email yang telah dikirmkan
                                        Notifikasi ini muncul jika pemilik akun belum memverifikasi akun di email.
                                    </div>

                                    <div class="form-group">        
                                    <small id="helpId" class="form-text text-muted">Email Anda</small>                            
                                    <input value="<?php echo $row["email"] ?>" disabled  type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="example@gmail.com">
                                    
                                    </div>

                                    <hr>

                                    <h5 for="">Ubah Password</h5>
                                    <div class="alert alert-danger" role="alert">
                                        Isi Form dibawah ini hanya bila Anda hendak mengubah password Anda
                                    </div>

                                    <div class="form-group">                   
                                    <input type="password" class="form-control" name="pass"   id="pass" placeholder="Password Baru">                 
                                    </div>
                                    <div class="form-group">                   
                                    <input type="password" class="form-control" name="cpass" id="cpass" placeholder="Konfirmasi Password Baru">                 
                                    </div>

                                    <button type="button" onclick="gantipass()" class="btn btn-outline-success">Simpan Perubahan</button>
                                </form>
                            </div>

                            <div class="tab-pane fade bg-white p-3 contact-form" id="v-pills-sports" role="tabpanel" aria-labelledby="v-pills-sports-tab">
                                <h4 class="mb-4">Pengaturan Profil</h4> <hr>
                                <form method="POST" action="" class="form-group" >
                                    <div class="alert alert-warning" role="alert">
                                    Data anda belum diverivikasi oleh Admin. Silakan menunggu 2-3 hari kerja.
                                    Notifikasi ini hanya akan mucul jika data belum diverifikasi.
                                    </div>

                                    <div class="alert alert-success" role="alert">
                                    Anda telah terverifikasi. Notifikasi ini muncul jika admin telah memverifikasi data anda
                                </div>

                                    <div class="form-group">        
                                        <h5 for="">Profil Usaha</h5>
                                        <small id="helpId" class="form-text text-muted">Nama Perusahaan</small>                            
                                        <input value="<?php echo $row["nama_perusahaan"]?>"  type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan" aria-describedby="helpId" placeholder="emos">  
                                    </div>
                                    <hr>
                                    <!-- belum selesai -->
                                    <div class="form-group">
                                        <h5 for="">Profil Pemilik</h5>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile02">
                                            <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="upbutton" >Upload</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                <small id="helpId" class="form-text text-muted">Nama Pemilik</small>
                                <input value="<?php echo $row["nama_pemilik"]; ?>" type="text" class="form-control" name="nama_user" id="nama_user" aria-describedby="helpId" placeholder="Nama Pemilik">                               
                                </div>

                                <div class="form-group">
                                <small id="helpId"  class="form-text text-muted">Nomor KTP Anda</small>              
                                <input value="<?php echo $row["nomor_ktp"]; ?>" type="text" class="form-control" name="nomor_ktp" id="nomor_ktp" placeholder="Nomor KTP">                               
                                </div>

                                <div class="form-group">
                                <small id="helpId" class="form-text text-muted">Nomor Telpon Anda</small>              
                                <input value="<?php echo $row["notelp"]; ?>" type="number" class="form-control" name="telp_user" id="telp_user" placeholder="Nomor Telpon">                        
                                </div>

                                <div class="form-group">
                                <small id="helpId" class="form-text text-muted">Tanggal/Bulan/Tahun Lahir Anda</small>
                                <input value="<?php echo $row["tanggal_lahir"]; ?>" type="date"  class="form-control" name="lahir_user" id="lahir_user">                        
                                </div>

                                <div class="form-group">
                                <small id="helpId" class="form-text text-muted">Jenis Kelamin</small>
                                <!-- belum selesai -->
                                <select class="form-control" name="jeniskelamin_user" id="jeniskelamin_user">
                                <option value='1' <?php if($row['jenis_kelamin']=="1") echo 'selected="selected"'; ?>>Wanita</option>
                                <option value='2' <?php if($row['jenis_kelamin']=="2") echo 'selected="selected"'; ?>>Pria</option>                                     
                                </select>                               
                                </div>
                                <!-- belum selesai -->
                                <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea value="<?php echo $_SESSION["cb_prov"]; ?>" class="form-control" name="cb_prov" id="cb_prov" rows="3"></textarea>
                                </div>
                           
                                <button type="button" onclick="simpan()" class="btn btn-outline-success">Simpan Perubahan</button>                      
                                </form>
                            </div>
                            <div class="tab-pane fade bg-white p-3 contact-form" id="v-pills-address" role="tabpanel" aria-labelledby="v-pills-address-tab">
                                <h4 class="mb-4">Alamat Pengiriman</h4> <hr>
                                <form >
                                   
                                    <div class="form-group">
                                    <label for="">Alamat Pengiriman</label>
                                    <select class="form-control" name="alamat" id="alamat">
                                        <!-- diisi ajax -->
                                    </select>             
                                    </div>

                                    <div class="form-group">
                                    
                           <button type="submit" class="btn btn-warning btn-md my-2">
                               <i class="fa fa-ban"></i> Ubah Alamat
                           </button>
                           <button type="button" class="btn btn-danger btn-md">
                               <i class="fa fa-ban" onclick="hapusalamat()" ></i> Hapus Alamat
                           </button>
                                    </div>

                                    <br>
                                    

                                    <div class="form-group"> 
                                        <small>*Pilih Ubah Alamat untuk mengubah alamat pengiriman dengan memilih salah satu alamat</small> <br>
                                        <small>*Pilih Hapus Alamat untuk menghapus alamat pengiriman dengan memilih salah satu alamat</small><br>
                                    </div>
                                    
                                    <hr>
                                    
                                    <div class="form-group">
                                      <label for="">Provinsi Tujuan</label>
                                      <select class="form-control" name="cb_provinsi" id="cb_provinsi" onchange="cb_city()">
                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label for="">Kota Tujuan</label>
                                      <select class="form-control" name="cb_kota" id="cb_kota" onchange="cb_subdistrict()">
                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label for="">Kecamatan Tujuan</label>
                                      <select class="form-control" name="cb_kecamatan" id="cb_kecamatan">
                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label for="">Kode Pos</label>
                                    <input type='text' class="form-control" name="kodepos" id="kodepos" aria-describedby="helpkodepos" required>
                                    </div>


                                    <div class="form-group">
                                      <label for="">Alamat Lengkap</label>
                                        <input type="text" name="alamat_lengkap" id="alamat_lengkap" class="form-control" placeholder="" aria-describedby="helpId">
                                      
                                    </div>

                                    <button type="button" class="btn btn-outline-success" id="simpan_alamat">
                                        <i class="fa fa-ban"></i> Simpan Alamat Baru
                                    </button>
                                    
                                </form>                                         
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
    include_once "justfooter.php";
?>
    <script>

        //load alamat
        $.post("ajaxs/ajaxsetting.php",
            {
                jenis:"loadalamat",
            },
            function(data){
                $("#alamat").html(data);
            });

            function cb_prov(){
        $.post("ajaxs/ajaxregister.php",
        {
            jenis:"getprovince",
        },
        function(data){
            console.log(data);
            $("#cb_provinsi").html(data);
        });
        $("#cb_provinsi").val(-1);
    }

    function cb_city() {
        var arrprov=$("#cb_provinsi").val().split('-');
        $.post("ajaxs/ajaxregister.php",
        {
            jenis:"getcity",
            province:arrprov[0],
        },
        function(data){
            console.log(data);
            $("#cb_kota").html(data);
        });
        $("#cb_kota").val(-1);
    }

    function cb_subdistrict() {
        if ($("#cb_kota").val()!=null) {
            var kota=$("#cb_kota").val().split('-');
            $.post("ajaxs/ajaxregister.php",
            {
                jenis:"getsubdistrict",
                city:kota[0],
            },
            function(data){
                console.log(data);
                $("#cb_kecamatan").html(data);
            });
        }
        
    }

    cb_prov();//load prov
        
    function hapusalamat(){
        $.post("ajaxs/ajaxsetting.php",
            {
                jenis:"hapusalamat",
                ida:$("#alamat").val(),
            },
            function(data){
               alert(data);
            });
    }

    function keluar(){
        $.post("ajaxs/ajaxlogin.php",
        {
            jenis:"keluar",
        },
        function(data){
            window.location.href="login.php";
        });
    }

    function simpan() {
            $.post("ajaxs/ajaxsetting.php",
            {
                jenis:"update",
                nama_perusahaan:$("#nama_perusahaan").val(),
                nama_user:$("#nama_user").val(),
                nomor_ktp:$("#nomor_ktp").val(),
                telp_user:$("#telp_user").val(),
                lahir_user:$("#lahir_user").val(),
                jeniskelamin_user:$("#jeniskelamin_user").val(),
            },
            function(data){
                alert(data);
            });
    }

    $("#simpan_alamat").click(function(){
        var prov = $("#cb_provinsi").val();
        var kota = $("#cb_kota").val();
        var kode = $("#kodepos").val();
        var camat = $("#cb_kecamatan").val();
        var alamatuser = $("#alamat_lengkap").val();

        $.post("ajaxs/ajaxsetting.php",
            {
                jenis:"simpanalamat",
                alamat_user:alamatuser,
                prov:prov,
                kota:kota,
                camat:camat,
                kode:kode,
            },
            function(data){
                alert(data);
                $.post("ajaxs/ajaxsetting.php",
            {
                jenis:"loadalamat",
            },
            function(data){
                $("#alamat").html(data);
            });
            });
    });

    $( "#nomor_ktp" ).keyup(function() {
        var _minus = false;
        if (noktp<0) _minus = true;
        var noktp=$( "#nomor_ktp" ).val();
        noktp=noktp.replace("-","");
        noktp=noktp.replace("-","");
        noktp=noktp.replace("-","");
        noktp=noktp.replace("-","");
        alert(noktp);
        c = "";
        panjang = noktp.length;
        j = 0;
        for (i = panjang; i > 0; i--)
        {
            ;
            
            if ((((i) % 4) == 0) && (j != 1))
            {
                c = noktp.substr(i-1,1) + "-" + c;
            }else
            {   c = noktp.substr(i-1,1) + c;    }
        }
        
        if (_minus) c = "-" + c ;
        if(panjang >= 16){
            c = c.substr(0,panjang+3);
        }
        $( "#nomor_ktp" ).val(c);
    });

    $("#upbutton").click(function(){
        var fd = new FormData();
      var files = $('#inputGroupFile02')[0].files[0];
      fd.append('file',files);
      fd.append('id',$("#nomor_ktp").val());
    console.log(files);
      $.ajax({
          url: 'ajaxupload.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
              if(response != 0){
                  $("#img").attr("src",response); 
                  $(".preview img").show(); // Display image element
                  $("#url_user").val(response);
                  console.log(response);
                  alert("file berhasil di upload");
              }else{
                  alert('file not uploaded');
              }
          },
      });
    });

    function upload() {
      
    }

    function gantipass() {
        console.log("pass:"+$("#pass").val());
        console.log("cpass:"+$("#cpass").val());
        if ($("#pass").val()==$("#cpass").val()) {
            $.post("ajaxs/ajaxsetting.php",
            {
                jenis:"gantipass",
                password:$("#pass").val(),
            },
            function(data){
                alert(data);
            });
        }else{
            alert("Password dan Konfirmasi password harus sama !");
        }
    }
        
</script>
</body>
</html>