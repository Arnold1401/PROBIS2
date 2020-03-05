<!-- BIASAKAN MEMBUAT NAME PADA SETIAP INPUT ATAUPUN BUTTON SAMA DENGAN NAMA FIELD DALAM TABLENYA -->
<?php
require_once("head.php");
?>
<!DOCTYPE html>
<html>
<head>
    
</head>
<body class="goto-here">

    <!-- nav -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
        <a class="navbar-brand" href="home.php">EMOS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
            </ul>
        </div>
    </div>
    </nav>
    <!-- END nav -->



    <section class="ftco-section contact-section bg-light ">
        <div class="container">
            
        
        <div class="row block-9 justify-content-center">

        <!-- Profile Usaha beserta pemiliknya -->
        <div class="col-md-6 d-flex">
        
            <form class="bg-white p-4 contact-form was-validated">
                <div class="form-group">
                  <h5 for="">Profil Usaha</h5>
                  <input required type="text" class="form-control" id="nama_perusahaan" aria-describedby="helpnama_perusahaan" placeholder="Nama Perusahaan/Toko">
                  <small id="helpnama_perusahaan" class="invalid-feedback">Isi Nama Perusahaan/Toko</small> 
                </div>

                <hr>

                <div class="form-group">
                  <h5 for="">Profil Pemilik</h5>
                  <input required type="text" class="form-control" id="nama_user" aria-describedby="helpnama_user" placeholder="Nama Pemilik">
                  <small id="helpnama_user" class="invalid-feedback">Isi Nama Pemilik</small>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="nomor_ktp" placeholder="Nomor KTP" aria-describedby="helpnomor_ktp" required>
                    <small id="helpnomor_ktp" class="invalid-feedback">Masukkan nomor KTP Anda (Contoh: 1234-5678-9123-4567)</small>              
                </div>

                <!-- <div class="form-group">
                    <input type="file" id="myFile" id="foto_ktp">
                </div> -->

                <div class="form-group">
                  <img src="" id="img" width="200" height="100">
                 </div>
                <div >
                  <input type="file" id="file" name="file" />
                  <input type="button" class="button btn btn-primary" onclick="upload()" value="Upload" id="but_upload">
                </div>

                <br>

                <div class="form-group">
                    <input type="text" onkeydown="return numberhponly(this, event);" onkeyup="javascript:pemisahnohp(this);" class="form-control" id="telp_user" placeholder="Nomor Telpon" aria-describedby="helptelp_user" required>
                    <small id="helptelp_user" class="invalid-feedback">Isi Nomor Telpon Anda</small>              
                </div>

                <div class="form-group">
                    <input type="date" class="form-control" id="lahir_user" aria-describedby="helplahir_user" required>
                    <small id="helplahir_user" class="invalid-feedback">Isi Tanggal/Bulan/Tahun Lahir Anda</small>
                </div>
                <input type="hidden" class="form-control" id="url_user">
                <div class="form-group">
                  <select class="form-control" id="jeniskelamin_user" aria-describedby="helpjeniskelamin_user" required>
                    <option value="">Pilih</option>
                    <option value="0">Wanita</option>
                    <option value="1">Pria</option>                   
                  </select>
                  <small id="helpjeniskelamin_user" class="invalid-feedback">Pilih Jenis Kelamin</small>
                </div>

                <div class="form-group">
                  <label for="">Alamat</label>
                  <textarea class="form-control" id="alamat_user" rows="3" aria-describedby="helpalamat_user" required></textarea>
                  <small id="helpalamat_user" class="invalid-feedback">Isi Alamat Anda</small>
                </div>

                <!-- Go to fill username and pass -->
                <a name="" id="" class="btn btn-primary float-right" href="#" role="button"> <span class="icon-arrow-right"></span> </a>
                <!-- End Go to fill username and pass -->

            </form>
        </div>
        <!-- End Profile Usaha beserta pemiliknya -->
        
        <!-- Account -->
        <div class="col-md-6 order-md-last d-flex">    
            <form class="bg-white p-4 contact-form was-validated">  
                
                <div class="form-group">
                    <h5 for="">Pilih Sales</h5>          
                </div>

                <div class="form-group">
                    <label for="" class=" form-control-label">Sales Yang bertanggung jawab </label>
                    <select id="sales_pilihanuser"  class="form-control" aria-describedby="helpsales_pilihanuser" required>
                        <option value="">Pilih</option>
                        <option value="0">001 - Arnold</option>
                        <option value="1">002 - Wily</option>
                    </select>
                    <small id="helpsales_pilihanuser" class="invalid-feedback">Pilih Sales Anda</small>
                </div>


                <div class="form-group">
                    <h5 for="">Account</h5>          
                </div>


                <div class="form-group">
                  <input type="email" class="form-control" id="email_user" aria-describedby="helpemail_user" required placeholder="example@gmail.com">
                  <small id="helpemail_user" class="invalid-feedback">Isi Email anda sesuai format</small>
                </div>

                <div class="form-group">                   
                    <input aria-describedby="helppassword_user" required type="password" class="form-control" name="password_user" id="password_user" placeholder="Password">                 
                    <small id="helppassword_user" class="invalid-feedback">Isi Password Anda</small>
                </div>
                <div class="form-group">                   
                    <input aria-describedby="helpkon_password" required type="password" class="form-control" name="kon_password" id="kon_password" placeholder="Konfirmasi Password">                 
                    
                </div>

                <div class="form-group justify-content-center">
                   <button type="button" onclick="register()" id="" class="btn btn-primary py-2 px-5">Register</button>
                </div>


                <hr>

                <!-- Go to Register and verification -->
                <a href="" class="text-center">Jangan Lupa untuk memverifikasi akun melalui email anda</a>
                <!-- End Go to Register and verification -->
            </form>

        </div>
        <!--End Account -->

        </div>
      </div>
        </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/scrollax.min.js"></script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script> -->
    <!-- <script src="js/google-map.js"></script> -->
    <script src="js/main.js"></script>
</body>
</html>

<script>

    // pemisah no hp
    function pemisahnohp(b)
    {
        var _minus = false;
        if (b<0) _minus = true;
        b = b.toString();
        b=b.replace(".","");
        b=b.replace("-","");
        
        c = "";
        panjang = b.length;
        j = 0;
        for (i = panjang; i > 0; i--)
        {
            j = j + 1;
            
            if (((j % 3) == 1) && (j != 1))
            {
                c = b.substr(i-1,1) + "-" + c;
            }else
            {   c = b.substr(i-1,1) + c;    }
        }
        
        if (_minus) c = "-" + c ;
        return c;
        
    }

    function numberhponly(ini, e)
    {
    if (e.keyCode>=49)
    {
    if(e.keyCode<=57)
    {
    a = ini.value.toString().replace(".","");
    b = a.replace(/[^\d]/g,"");
    b = (b=="0")?String.fromCharCode(e.keyCode):b + String.fromCharCode(e.keyCode);
    ini.value = pemisahnohp(b);

    return false;
    }

    else if(e.keyCode<=105){
    if(e.keyCode>=96){
    //e.keycode = e.keycode - 47;
    a = ini.value.toString().replace(".","");
    b = a.replace(/[^\d]/g,"");
    b = (b=="0")?String.fromCharCode(e.keyCode-48):b + String.fromCharCode(e.keyCode-48);
    ini.value = pemisahnohp(b);
    //alert(e.keycode);
    return false;
    }
    else {return false;}
    }else {
    return false; }
    }else if (e.keyCode==48){
    a = ini.value.replace(".","") + String.fromCharCode(e.keyCode);
    b = a.replace(/[^\d]/g,"");
    if (parseFloat(b)!=0){
    ini.value = pemisahnohp(b);
    return false;
    } else {return false;}
    }else if (e.keyCode==95){
    a = ini.value.replace(".","") + String.fromCharCode(e.keyCode-48);
    b = a.replace(/[^\d]/g,"");
    if (parseFloat(b)!=0){
        ini.value = pemisahnohp(b);
        return false;
        } else {return false;}
    }else if (e.keyCode==8 || e.keycode==46){
        a = ini.value.replace(".","");
        b = a.replace(/[^\d]/g,"");
        b = b.substr(0,b.length -1);
        
        if (pemisahnohp(b)!=""){
            ini.value = pemisahnohp(b);
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

    // end pemisah no hp
    
    // pemisah ktp
    function pemisahktp(b)
    {
        var _minus = false;
        if (b<0) _minus = true;
        b = b.toString();
        b=b.replace(".","");
        b=b.replace("-","");
        
        c = "";
        panjang = b.length;
        j = 0;
        for (i = panjang; i > 0; i--)
        {
            j = j + 1;
            
            if (((j % 4) == 1) && (j != 1))
            {
                c = b.substr(i-1,1) + "-" + c;
            }else
            {   c = b.substr(i-1,1) + c;    }
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
    b = a.replace(/[^\d]/g,"");
    b = (b=="0")?String.fromCharCode(e.keyCode):b + String.fromCharCode(e.keyCode);
    ini.value = pemisahktp(b);

    return false;
    }

    else if(e.keyCode<=105){
    if(e.keyCode>=96){
    //e.keycode = e.keycode - 47;
    a = ini.value.toString().replace(".","");
    b = a.replace(/[^\d]/g,"");
    b = (b=="0")?String.fromCharCode(e.keyCode-48):b + String.fromCharCode(e.keyCode-48);
    ini.value = pemisahktp(b);
    //alert(e.keycode);
    return false;
    }
    else {return false;}
    }else {
    return false; }
    }else if (e.keyCode==48){
    a = ini.value.replace(".","") + String.fromCharCode(e.keyCode);
    b = a.replace(/[^\d]/g,"");
    if (parseFloat(b)!=0){
    ini.value = pemisahktp(b);
    return false;
    } else {return false;}
    }else if (e.keyCode==95){
    a = ini.value.replace(".","") + String.fromCharCode(e.keyCode-48);
    b = a.replace(/[^\d]/g,"");
    if (parseFloat(b)!=0){
        ini.value = pemisahktp(b);
        return false;
        } else {return false;}
    }else if (e.keyCode==8 || e.keycode==46){
        a = ini.value.replace(".","");
        b = a.replace(/[^\d]/g,"");
        b = b.substr(0,b.length -1);
        
        if (pemisahktp(b)!=""){
            ini.value = pemisahktp(b);
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

function register() {
    var namaperusahaan = $("#nama_perusahaan").val();
    var namauser = $("#nama_user").val();
    var nomorktp = $("#nomor_ktp").val();
    var fotoktp = $("#foto_ktp").val();
    var telpuser = $("#telp_user").val();
    var lahiruser = $("#lahir_user").val();
    var jeniskelaminuser = $("#jeniskelamin_user").val();
    var alamatuser = $("#alamat_user").val();
    var salespilihanuser = $("#sales_pilihanuser").val();

    var emailuser = $("#email_user").val();
    var passworduser = $("#password_user").val();
    var konpassword = $("#kon_password").val();
    //alert(telpuser);
    //test
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


    var namaperusahaan = $("#nama_perusahaan").val();
    var namauser = $("#nama_user").val();
    var nomorktp = $("#nomor_ktp").val();
    var fotoktp = $("#file").val();
    var telpuser = $("#telp_user").val();
    var lahiruser = $("#lahir_user").val();
    var jeniskelaminuser = $("#jeniskelamin_user").val();
    var alamatuser = $("#alamat_user").val();
    var salespilihanuser = $("#sales_pilihanuser").val();

    var emailuser = $("#email_user").val();
    var passworduser = $("#password_user").val();
    var konpassword = $("#kon_password").val();
    var url = $("#url_user").val();
    //alert(emailuser);
    alert(lahiruser);
    //alert(fotoktp);

    if (namaperusahaan == "" || namauser == "" || nomorktp == "" || fotoktp == "" || telpuser == "" || 
    lahiruser == "" || jeniskelaminuser == "" || alamatuser == "" || salespilihanuser == "" || emailuser == ""||
    passworduser == "") {
        return false;
    }
    if(namaperusahaan != "" && namauser != "" && nomorktp != "" || fotoktp != "" || telpuser != "" || 
    lahiruser != "" && jeniskelaminuser != "" && alamatuser != "" || salespilihanuser != "" || emailuser != ""||
    passworduser != ""){

        if (konpassword == passworduser) {
        $.post("ajax.php",
        {
            jenis: "register",
            nama_perusahaan:namaperusahaan,
            nama_user:namauser,
            nomor_ktp:nomorktp,
            foto_ktp:fotoktp,
            telp_user:telpuser,
            lahir_user:lahiruser,
            jeniskelamin_user:jeniskelaminuser,
            alamat_user:alamatuser,
            sales_pilihanuser:salespilihanuser,
            email_user:emailuser,
            password_user:passworduser,
            url:url
        },
        function (data) {
            alert(data);
        });

        }

        else{
        alert('tidak sama');
        }

    }

    
    
}


function upload() {
      var fd = new FormData();
      var files = $('#file')[0].files[0];
      fd.append('file',files);
      fd.append('id',$("#nomor_ktp").val());
    alert(files);
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
                  alert(response);
              }else{
                  alert('file not uploaded');
              }
          },
      });
    }
    var ctr_1 = 0;
    $("#nomor_ktp").on('input',function(){
        
        //ctr_1 = $("#nomor_ktp").val().length;
        ctr_1 = ctr_1 + 1;
        if(ctr_1 == 5){
        ctr_1 = 1;
        len = $("#nomor_ktp").val().length -1;
        var isi = $("#nomor_ktp").val().substr(0,len) + '-' + $("#nomor_ktp").val().substr(len,1);
        $("#nomor_ktp").val(isi);
        }
    });


</script>