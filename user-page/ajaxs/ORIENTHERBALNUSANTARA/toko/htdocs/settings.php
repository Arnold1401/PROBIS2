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
               <a href="settings.php<?php if (isset($_GET['token'])) { $token =$_GET['token'];echo "?token=".$token;}?>">Pengaturan</a>
            </div>
         </div>
      </div>
   </div>
</section>
<!--================End Home Banner Area =================-->
<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
   <div class="container">
      <div id="alertnya"></div>
      <div class="col-md-12 form-group p_star">
         <h3>Edit Profil</h3>
      </div>
      <div id="tampung_profile" class="row col-md-12">
         <!-- //ajax profile -->
      </div>
      <div class="col-md-12 form-group p_star">
         <h3>Detail Pengiriman</h3>
         <br>
      </div>
      <div id="alertnya2"></div>

      <div class='col-md-12 row form-group p_star' >
         <a
            href='#'
            class='nav-link dropdown-toggle text-dark form-control'
            data-toggle='dropdown'
            role='button'
            aria-haspopup='true'
            aria-expanded='false'
            >Pilih Alamat</a>
         <ul class='dropdown-menu' id='option_alamat'>
            <!-- ajax alamat -->
         </ul>
      </div>
      
      <div id="tampungform" class='row col-md-12'>
         <!-- ajax form -->
      </div>
      <br>
      
      <!-- <div class="col-md-12 form-group p_star">
         <h3>Detail Pembayaran</h3>
         <br>
      </div>
      <div id="alertnya3"></div>

      <div id="tampungformbayar" class='row col-md-12'>
       
      </div> -->

      
   </div>

</section>
<div id="modal"></div>
<!--================End Checkout Area =================-->
<?php
   include "footer.php";
   include "gatekeeper.php";
   ?>
</body>
</html>
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
   
   function getuserprofile() {
      //get user profile
       $.post("ajaxuser.php",
       {
         jenis:"load_data"
       },
       function(data){
         $("#tampung_profile").html(data);
       }
       );
   }
   getuserprofile();
   
   //get user pembayaran
   function getuserpembayaran() {
      
       $.post("ajaxuser.php",
       {
         jenis:"optionbayar"
       },
       function(data){
         //alert(data);
         $("#option_pembayaran").html(data);
       }
       );
   }
   getuserpembayaran();
   
   
   //get user contact
   $.post("ajaxuser.php",
   {
     jenis:"optionalamat"
   },
   function(data){
     $("#option_alamat").html(data);
   }
   );
   
   //sembunyikan form
   function formtambah(params) {
    
     $.post("ajaxuser.php",
     {
       jenis:"showformtambah",
       idu:params,
     },
     function(data){
       //alert(data);
       $("#tampungform").html(data);
       loadprovinsi();
       resetvalidate() ;
     }
     );
   }
   
   
   function choosedalamat(params) {
     $("#formtambah").css("display","block");
     $.post("ajaxuser.php",
     {
       jenis:"choosedalamat",
       idalamat:params
     },
     function(data){
       //alert(data);
       $("#tampungform").html(data);
       loadprovinsi();
   
       
       setprovinsi();
       setkota();
     }
     );
     
   }
   
   function reset() {
     $("#alamat").val("");
     //$("#idalamat").val("");
     $("#kodepos").val("");
     //$("#kota").val("");
     //$("#provinsi").val("");
     $("#telppenerima").val("");
     $("#namapenerima").val("");
   }
   
   function loadprovinsi(){
     $.post("ajaxuser.php",
     {
       jenis:"loadprovinsi"
     },
     function(data){
       $("#provinsi").css("display","block");
       $("#provinsi").html( data);
       //$(".nice-select").css("display","none");
     }
     );
   }
   
   function loadkota(){
     var idpro=$("#provinsi").val();
     $.post("ajaxuser.php",
     {
       jenis:"loadkota",
       idpro:idpro,
     },
     function(data){
       $("#kota").css("display","block");
       $("#kota").html(data);
       $(".nice-select").css("display","none");
     }
     );
   }
   
   
     
   function simpanprofile(params) {
     //alert(params);
     var nm=$("#txt_nama").val();
     var telp=$("#txt_telp").val();
     $.post("ajaxuser.php",
     {
       jenis:"update_profile",
       iduser:params,
       nmuser:nm,
       telpuser:telp,
     },
     function(data){
       //alert(data);
       $("#alertnya").html(data);
     }
     );
   }
   
   function setprovinsi(){
     setTimeout(() => {
       var idpro=$("#provinsi").attr("alt");
     //alert(idpro);
     $('#provinsi').val(idpro);
     loadkota();
     }, 1000);
     
   }
   
   function setkota(){
     setTimeout(() => {
       var idpro=$("#kota").attr("alt");
     //alert(idpro);
     $('#kota').val(idpro);
     }, 1500);
     
   }
   
   function resetvalidate() {
     $('#anamapenerima').css("display","none");
     $('#atelppenerima').css("display","none");
     $('#aalamat').css("display","none");
     $('#akecamatan').css("display","none");
     $('#akelurahan').css("display","none");
     $('#aprovinsi').css("display","none");
     $('#akota').css("display","none");
     $('#akodepos').css("display","none");
   }
   
   function simpanalamat(params) {
     var nm=$('#namapenerima').val();
     var telp=$('#telppenerima').val();
     var alamat=$('#alamat').val();
     var kec=$('#kecamatan').val();
     var kel=$('#kelurahan').val();
     var pro=$('#provinsi').val();
     var kot=$('#kota').val();
     var kod=$('#kodepos').val();
     var ket=$('#keterangan').val();
   
     resetvalidate();
     if (nm=="") {
       $('#anamapenerima').css("display","block");
     }else if(telp==""){
       $('#atelppenerima').css("display","block");
     }else if(alamat==""){
       $('#aalamat').css("display","block");
     }else if(kec==""){
       $('#akecamatan').css("display","block");
     }else if(kel==""){
       $('#akelurahan').css("display","block");
     }else if(pro=="-1"||pro==""||pro==null){
       $('#aprovinsi').css("display","block");
     }else if(kot=="-1"||kot==""||kot==null){
       $('#akota').css("display","block");
     }else if(kod==""){
       $('#akodepos').css("display","block");
     }else{
       $.post("ajaxuser.php",
       {
         jenis:"updatealamat",
         ida:params,
         nm:nm,
         telp:telp,
         alamat:alamat,
         kec:kec,
         kel:kel,
         pro:pro,
         kot:kot,
         kod:kod,
         ket:ket,
       },
       function(data){
        //alert(data);
        $("#alertnya2").html(data);
       }
       );
     }
   
     
   }
   
   function tambahalamat(params) {
     var nm=$('#namapenerima').val();
     var telp=$('#telppenerima').val();
     var alamat=$('#alamat').val();
     var kec=$('#kecamatan').val();
     var kel=$('#kelurahan').val();
     var pro=$('#provinsi').val();
     var kot=$('#kota').val();
     var kod=$('#kodepos').val();
     var ket=$('#keterangan').val();
   
     resetvalidate();
     if (nm=="") {
       $('#anamapenerima').css("display","block");
     }else if(telp==""){
       $('#atelppenerima').css("display","block");
     }else if(alamat==""){
       $('#aalamat').css("display","block");
     }else if(kec==""){
       $('#akecamatan').css("display","block");
     }else if(kel==""){
       $('#akelurahan').css("display","block");
     }else if(pro=="-1"||pro==""||pro==null){
       $('#aprovinsi').css("display","block");
     }else if(kot=="-1"||kot==""||kot==null){
       $('#akota').css("display","block");
     }else if(kod==""){
       $('#akodepos').css("display","block");
     }else{
       $.post("ajaxuser.php",
       {
         jenis:"insertalamat",
         idu:params,
         nm:nm,
         telp:telp,
         alamat:alamat,
         kec:kec,
         kel:kel,
         pro:pro,
         kot:kot,
         kod:kod,
         ket:ket,
       },
       function(data){
         $("#alertnya2").html(data);
         setInterval(() => {
           $("#tampungform").html("");
           
         }, 300);
       }
       );
     }
   }
   
   function cancelsimpan() {
     $("#tampungform").html("");
   }
   
   function canceltambah() {
     $("#tampungform").html("");
   }


   

   function formtambahbayar(params) {
      $.post("ajaxuser.php",
      {
        jenis:"showformbayar",
        idu:params,
      },
      function(data){
        //alert(data);
        $("#tampungformbayar").html(data);
        resetvalidate2();
      }
      );

      
  }

  function choosedbayar(params) {
      $.post("ajaxuser.php",
      {
        jenis:"choosedbayar",
        idb:params,
      },
      function(data){
        //alert(data);
        $("#tampungformbayar").html(data);
        resetvalidate2();
        setbank();
      }
      );
  }

  function setbank() {
    setTimeout(() => {
       var idbank=$("#bank").attr("alt");
     //alert(idpro);
     $('#bank').val(idbank);
     }, 100);
  }

  function simpanbank(params) {
     var idbank=$('#bank').val();
     var anrek=$('#anrekening').val();
     var norek=$('#norekening').val();
     if (idbank=="-1"||idbank==""||idbank==null) {
      $('#abank').css("display","block");
     }else if(anrek==""){
        $('#aanrekening').css("display","block");
     }else if(norek==""){
       $('#anorekening').css("display","block");
     }else{
      $.post("ajaxuser.php",
      {
        jenis:"updatebayar",
        idb:params,
        idbank:idbank,
        anrek:anrek,
        norek:norek,
      },
      function(data){
        //alert(data);
        $("#alertnya3").html(data);
        $("#tampungformbayar").html("");
      }
      );
     }
    
  }

  function tambahbank(params) {
     var idbank=$('#bank').val();
     var anrek=$('#anrekening').val();
     var norek=$('#norekening').val();
    resetvalidate2();
     if (idbank=="-1") {
      $('#abank').css("display","block");
     }else if(anrek==""){
        $('#aanrekening').css("display","block");
     }else if(norek==""){
       $('#anorekening').css("display","block");
     }else{
      $.post("ajaxuser.php",
      {
        jenis:"insertbayar",
        idu:params,
        idbank:idbank,
        anrek:anrek,
        norek:norek,
      },
      function(data){
        //alert(data);
        $("#alertnya3").html(data);
        $("#tampungformbayar").html("");
      }
      );
     }
    
  }

  function cancelsimpanbank(params) {
    $("#tampungformbayar").html("");
  }

  function resetvalidate2() {
     $('#abank').css("display","none");
     $('#aanrekening').css("display","none");
     $('#anorekening').css("display","none");
   }

   function modalremovebayar(params) {
    $("#modal").html("<div class='modal' id='modalnya' tabindex='-1' role='dialog'><div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'><h5 class='modal-title'>Hapus Pembayaran ini</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='modal-body'><p>Apakah anda yakin menghapus detail pembayaran ini ?</p></div><div class='modal-footer'><button type='button' class='btn btn-danger' onclick=\"removebayar('"+params+"')\">Yakin,Hapus</button><button type='button' class='btn btn-secondary' data-dismiss='modal'>Batal</button></div></div></div></div>");
    $("#modalnya").modal("show");

    }

    function modalremovealamat(params) {
      $("#modal").html("<div class='modal' id='modalnya' tabindex='-1' role='dialog'><div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'><h5 class='modal-title'>Hapus Pembayaran ini</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='modal-body'><p>Apakah anda yakin menghapus detail pengiriman ini ?</p></div><div class='modal-footer'><button type='button' class='btn btn-danger' onclick=\"removealamat('"+params+"')\">Yakin,Hapus</button><button type='button' class='btn btn-secondary' data-dismiss='modal'>Batal</button></div></div></div></div>");
      $("#modalnya").modal("show");
    }

   function removebayar(params) {
     //alert("bayar :"+params);
     $.post("ajaxuser.php",
      {
        jenis:"deletebayar",
        idb:params,
      },
      function(data){
        //alert(data);
        $("#alertnya3").html(data);
        $("#modalnya").modal("hide");
        setTimeout(() => {
          $("#tampungformbayar").html("");
        }, 300);
      }
      );

   }

   function removealamat(params) {
     //alert("alamat :"+params);
     $.post("ajaxuser.php",
      {
        jenis:"deletealamat",
        ida:params,
      },
      function(data){
        //alert(data);
        $("#alertnya2").html(data);
        $("#modalnya").modal("hide");
        setTimeout(() => {
          $("#tampungformalamat").html("");
        }, 300);
        
        
      }
      );
   }

</script>