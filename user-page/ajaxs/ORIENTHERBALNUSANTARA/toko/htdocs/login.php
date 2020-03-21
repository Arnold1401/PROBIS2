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
              <h2>Masuk</h2>
              <p>Silahkan masuk ke akun anda agar dapat menyimpan daftar keinginan anda</p>
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
            <div class="tracking_box_inner">
              <form action="#">
                <div class="mt-10">
                  <input type="email" id="txt_email" placeholder = "Masukan Alamat Email anda"
                    class="single-input">
                </div>
                <div class="mt-10">
                  <input type="password" id="txt_password" placeholder = "Masukan Kata sandi anda"
                    class="single-input">
                </div>


                <div class="input-group-icon mt-10">
                  <div class="row">
                    <div class="col-md-6">  <button class="genric-btn success circle arrow" type="button"  onClick="onlogin()">Masuk</button></div>
                    <div class="col-md-6 text-right"><a href="register.php" class="genric-btn success-border circle">Belum punya akun !</a></div>
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
      function onlogin(){
        
        var arrdata=[];
        $.post("auth.php",
          {
            jenis:"login",
            p1:$("#txt_email").val(),
            p2:$("#txt_password").val(),

          },
          function(data){
            //alert(data);
            arrdata=data.split("-");
            if (arrdata[0]=="index") {
              if (arrdata[1]=="salahuser") {
                alert("Username tidak ditemukan !");
              }else if (arrdata[1]=="salahpass") {
                alert("Password yang anda masukan salah !");
              }else {
                window.location.href=arrdata[0]+".php?token="+arrdata[1];
              }
            }else if (arrdata[0]=="verify"){
                  window.location.href=arrdata[0]+".php?token="+arrdata[1];
            }
          }
          );
      }
     
    </script>

</body>

</html>