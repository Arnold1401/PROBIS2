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
               <h2 id="tampung_namauser"></h2>
            </div>
            <div class="page_link">
               <a href="index.php<?php if (isset($_GET['token'])) { $token =$_GET['token'];echo "?token=".$token;}?>">Home</a>
               <a href="historytransaksi.php<?php if (isset($_GET['token'])) { $token =$_GET['token'];echo "?token=".$token;}?>">Riwayat Pembelian</a>
            </div>
         </div>
      </div>
   </div>
</section>
<!--================End Home Banner Area =================-->
<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
   <div class="container">
   <div class="col-md-12 form-group p_star">
         <h3>Pembayaran diproses</h3>
      </div>
      <div id="alertnya2"></div>
      <div id="tampung_pending" class="row col-md-12">
         <!-- //ajax loadproses -->
      </div>
      <div class="col-md-12 form-group p_star">
         <h3>Barang sedang dikemas</h3>
      </div>
      <div id="alertnya2"></div>
      <div id="tampung_proses" class="row col-md-12">
         <!-- //ajax loadproses -->
      </div>
      <div class="col-md-12 form-group p_star">
         <h3>Sedang Dikirim</h3>
      </div>
      <div id="alertnya"></div>
      <div id="tampung_kirim" class="row col-md-12">
         <!-- //ajax loadkonfirmasi -->
      </div>
      <div class="col-md-12 form-group p_star">
         <h3>Gagal</h3>
      </div>
      <div id="alertnya"></div>
      <div id="tampung_gagal" class="row col-md-12">
         <!-- //ajax loadkonfirmasi -->
      </div>
      <br>
      <div class="col-md-12 form-group p_star">
         <h3>Selesai</h3>
         <form>
            <div class="form-row">
               <div class="form-group col-md-5">
                  <label for="inputEmail4">Dari</label>
                  <input type="date" class="form-control" id="inputdari" placeholder="Email">
               </div>
               <div class="form-group col-md-5">
                  <label for="inputPassword4">Sampai</label>
                  <input type="date" class="form-control" id="inputsampai" placeholder="Password">
               </div>
               <div class="form-group col-md-2 pt-4">
                  <button type="button" class="btn btn-outline-primary mt-2" onclick="filter_history()">Terapkan</button>
               </div>
            </div>
         </form>
      </div>
      <div id="alertnya3"></div>
      <div id="tampung_selesai" class="row col-md-12">
         <!-- //ajax loadproses -->
      </div>
   </div>
</section>
<?php
   include "gatekeeper.php";
   ?>
<script>
   //get nama user
   $.post("ajaxuser.php",
   {
     jenis:"getnama"
   },
   function(data){
     $("#tampung_namauser").html(data);
   }
   );
   
   
   
   function tampil_history()
      {
        $.post("ajaxhistory.php",
        {
          jenis:"gethistory"
        },
        function(data){
          //alert(data);
          $("#tampung_proses").html(data);
        }
        );
      }
      tampil_history();



      function tampil_pending()
      {
        $.post("ajaxhistory.php",
        {
          jenis:"gethistorypending"
        },
        function(data){
          //alert(data);
          $("#tampung_pending").html(data);
        }
        );
      }
      tampil_pending();




      function tampil_gagal()
      {
        $.post("ajaxhistory.php",
        {
          jenis:"gethistorygagal"
        },
        function(data){
          //alert(data);
          $("#tampung_gagal").html(data);
        }
        );
      }
      tampil_gagal();
   










   
      function tampil_history_selesai()
      {
        $.post("ajaxhistory.php",
        {
          jenis:"gethistoryselesai"
        },
        function(data){
          //alert(data);
          $("#tampung_selesai").html(data);
        }
        );
      }
      tampil_history_selesai();
   
      function tampil_history_kirim()
      {
        $.post("ajaxhistory.php",
        {
          jenis:"gethistorykirim"
        },
        function(data){
          //alert(data);
          $("#tampung_kirim").html(data);
        }
        );
      }
      tampil_history_kirim();
   
   
      function filter_history()
      {
         // var dari = $("#inputdari").val();
         // var sampai = $("#inputsampai").val();
         // alert ("|"+dari+"|");
         // alert (sampai);
        $.post("ajaxhistory.php",
        {
          jenis:"filterhistory",
          p1:$("#inputdari").val(),
          p2:$("#inputsampai").val(),
        },
        function(data){
          alert(data);
          $("#tampung_selesai").html(data);
        }
        );
      }
   
   
   
   
</script>