<?php
  include "importsrc.php";
  include "header.php";
?>
    <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div
            class="banner_content d-md-flex justify-content-between align-items-center"
          >
            <div class="mb-3 mb-md-0">
              <h2>Daftar</h2>
              <p>Silahkan daftar agar anda dapat menyimpan daftar keinginan anda</p>
            </div>
            <div class="page_link">
              <a href="index.html">Home</a>
              <a href="tracking.html">Akun</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Tracking Box Area =================-->
    <section class="tracking_box_area section_gap">
        <div class="container">
          <div id="alert">

          </div>
            <div class="tracking_box_inner">
              <form >
                <div class="mt-10">
                  <input type="text" id="txt_nama" placeholder ="Masukan Nama Lengkap anda"
                    class="single-input">
                </div>
                <div class="mt-10">
                  <input type="email" id="txt_email" placeholder = "Masukan Email anda"
                    class="single-input">
                </div>
                <div class="mt-10">
                  <input type="email" id="no_telp" placeholder = "Masukan No.Telepon anda"
                    class="single-input">
                </div>
                <div class="mt-10">
                  <input type="password" id="txt_password" placeholder = "Masukan Kata sandi anda"
                    class="single-input">
                </div>
                <div class="mt-10">
                  <input type="password" id="txt_cpassword"  placeholder = "Masukan Kata sandi lagi"
                    class="single-input">
                </div>

                <div class="input-group-icon mt-10">
                    <div class="row">

                      <div class="col-md-6">  <button class="genric-btn success circle arrow" type="button"  onClick="onregister()">Daftar</button></div>
                    <div class="col-md-6 text-right"><a href="login.php" class="genric-btn success-border circle">Sudah punya akun !</a></div>
                    </div>
                </div>

              </form>
              
            </div>
        </div>
    </section>
    <!--================End Tracking Box Area =================-->

    <?php
      include "footer.php";
    ?>

<script>
      function onregister(){
        var arrdata=[];
        $.post("auth.php",
          {
            jenis:"register",
            p1:$("#txt_nama").val(),
            p2:$("#txt_email").val(),
            p3:$("#no_telp").val(),
            p4:$("#txt_password").val(),
            p5:$("#txt_cpassword").val(),

          },
          function(data){
            var str = data;
            var n = str.search("sukses");
            var notif1="<div class='alert alert-danger alert-dismissible fade show' role='alert'>Register Gagal !<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
            var notif2="<div class='alert alert-success alert-dismissible fade show' role='alert'>Register berhasil !<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
    
           if (n<0) {
             console.log("Register Gagal");
             $("#alert").html(notif1);
           }
           else{
             console.log("Register Berhasil");
             $("#alert").html(notif2);
             window.location.href="login.php";
           }
           
          //else{
          //    arrdata=data.split("-");
          //    window.location.href=arrdata[0]+".php?token="+arrdata[1];
          //}
          }
          );
      }
    </script>
</body>
</html>