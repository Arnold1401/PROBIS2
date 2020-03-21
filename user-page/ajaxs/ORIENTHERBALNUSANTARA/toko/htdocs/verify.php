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
              <h2>Verifikasi</h2>
              <p>Silahkan masukan kode verifikasi yang dikirim melalui email ini <b><?php if (isset($_SESSION['email'])){echo $_SESSION['email'];}?></b></p>
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

                <div class="mt-10">
                  <input type="email" id="txt_code" placeholder = "Masukan Kode Verifikasi"
                    class="single-input">
                </div>


                <div class="input-group-icon mt-10">
                  <div class="row">
                    <div class="col-md-12">  <button class="genric-btn success circle arrow" type="button"  onclick="verify()" >Verify</button>
                      <button class="genric-btn success circle arrow" type="button"  onclick="kirimulang()" >Kirim Kode lagi</button></div>
                  </div>
                </div>
              
            </div>
        </div>
    </section>
    <!--================End Tracking Box Area =================-->

    <?php
      include "footer.php";
    ?>

    <script>

      function verify(){
        var arrdata=[];
        $.post("auth.php",
          {
            jenis:"verify",
            p1:$("#txt_code").val(),

          },
          function(data){
            arrdata=data.split("-");
            if (arrdata[0]=="berhasil") {
              alert("Berhasil melakukan verifikasi email !");
              window.location.href=arrdata[1]+".php?token="+arrdata[2];
            }else if (arrdata[0]=="salah") {
              alert("Kode verifikasi yang anda masukan salah !");
            }else {
              alert(data);
            }
           
          }
          );
      }

      function kirimulang(){
        $.post("auth.php",
          {
            jenis:"kirimulang",
          },
          function(data){
            alert(data);
            var str = data;
            var n0 = str.search("Message has been sent");
            if (n0>=0) {
              alert("Berhasil mengirim ulang kode verifikasi !");
            }else {
              alert("Gagal mengirim ulang kode verifikasi !");
            }
          }
          );
      }
     
    </script>

</body>

</html>