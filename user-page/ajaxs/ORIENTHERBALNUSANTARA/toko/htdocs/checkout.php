
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
              <h2>Product Checkout</h2>
              <p>Very us move be blessed multiply night</p>
            </div>
            <div class="page_link">
              <a href="index.php<?php if (isset($_GET['token'])) { $token =$_GET['token'];echo "?token=".$token;}?>">Home</a>
              <a href="checkout.php<?php if (isset($_GET['token'])) { $token =$_GET['token'];echo "?token=".$token;}?>">Product Checkout</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

     <!--================wishlist Area =================-->
     <section class="wishlist_area">
      <div class="container">
      <div id="alertnya">

      </div>
      <div class="single-element-widget row mt-4">
          
            <div class="single-element-widget col-lg-6">
              <h3 class="mb-10 title_color">Alamat Pengiriman</h3>
              <div class="default-select"  >
                <?php
                    function getiduser(){
                      $conn=getConn();
                      $iduser="";
                      $kal="";
                      $token="";
                      if (isset($_SESSION["token"])) {
                        $token=$_SESSION["token"];
                    }
                    if ($token=="") {
                        $kal.= "token kosong";
                    }else{
                        $sql = "SELECT * FROM token where id_token='$token'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            //cari user
                            while($row = $result->fetch_assoc()) {
                                $iduser=$row["id_user"];
                            }
                        }
                      }
                      $conn->close();
                      return $iduser;
                    }

                    $conn=getConn();
                    $kal="";
                   
                    $iduser=getiduser();
                    $sql1 = "SELECT * FROM info_pengiriman where ID_USER='$iduser' and exist='1'";
                    $result1 = $conn->query($sql1);
                    $kal.="<select id='option_alamat' onchange='alamatchoosed()'><option value='-1' selected>Pilih Alamat</option>";
                    if ($result1->num_rows > 0) {
                      while($row1 = $result1->fetch_assoc()) {
                        $idalamat=$row1["ID_ALAMAT"];
                        $namapenerima=$row1["NAMA_PENERIMA"];
                        $jalan=$row1["JALAN"];
                        $kodepos=$row1["KODEPOS"];
                        $kota=$row1["KOTA"];
                        $provinsi=$row1["PROVINSI"];
                        $notelp=$row1["NO_HP_PENERIMA"];
                        $namapenerima=strtoupper($namapenerima);
                        $kal.="<option value='$idalamat'><p><b>$namapenerima</b></p>&nbsp;&nbsp;&nbsp;&nbsp;$jalan</option>";
                      }
                    }else{
                      $kal.="<option value='0'>Tambah Alamat</option>";
                    }
                   
                    $kal.="</select>";
                    echo $kal;
                
                ?>
              </div>
            </div>

            <div class="single-element-widget col-lg-6">
              <h3 class="mb-10 title_color">Kurir Pengiriman</h3>
              <div class="default-select" >
                <select id="kurir" onchange="kurirchoosed()">
                  <option value='-1'>Pilih Kurir Pengiriman</option>
                  <option value='jne'>JNE</option>
                  <option value='pos'>POS Indonesia</option>
                  <option value='tiki'>TIKI</option>
                </select>
              </div>
            </div>

        
      </div>


      <div class="wishlist_inner">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                <th></th>
                <th></th>
                  <th scope="col">Item</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Subtotal</th>
                </tr>
              </thead>
              <tbody id="tampung_checkout">
               
              </tbody>
            </table>
          </div>
        </div>

        <div class="row">
        
          <div class="single-element-widget col-lg-4">
                  <a class='gray_btn' href="cart.php">Kembali ke Keranjang</a>
                  <button class='main_btn'onclick="metode()">Metode Pembayaran</button>
          </div>
      </div>

      <div id="tampungmodal">
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Alamat Pengiriman</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div class='col-md-12 form-group'>
        <input
        type='text'
        class='form-control'
        id='namapenerima'
        name='text'
        placeholder='Nama Penerima (cth:Elisa Nuralim)'/>
        <label class='text-danger' id='anamapenerima' >*Nama harus diisi</label>
        </div>
      
        <div class='col-md-12 form-group'>
        <input
        type='text'
        class='form-control'
        id='telppenerima'
        name='telp'
        placeholder='Nomor Penerima (cth:087xxxxxxxx)'
        />
        <label class='text-danger' id='atelppenerima' >*Telpon harus diisi</label>
        </div>
      
        <div class='col-md-12 form-group p_star'>
        <textarea
        class='form-control'
        name='message'
        id='alamat'
        rows='1'
        placeholder='Alamat Pengiriman (cth:Jl.Sejahtera 7 no 15)'
        ></textarea>
        <label class='text-danger' id='aalamat' >*Alamat harus diisi</label>
        </div>
        
        <div class='col-md-12 row'>
          <div class='col-md-6 form-group p_star'>
              <input
              type='text'
              class='form-control'
              id='kecamatan'
              name='number'
              placeholder='Masukan Kecamatan'
              />
              <label class='text-danger' id='akecamatan' >*Kecamatan harus diisi</label>
          </div>
          
          <div class='col-md-6 form-group p_star'>
              <input
              type='text'
              class='form-control'
              id='kelurahan'
              name='compemailany'
              placeholder='Masukan Kelurahan'
              />
              <label class='text-danger' id='akelurahan' >*Kelurahan harus diisi</label>
          </div>
          
        </div>
      
        <div class='col-md-12 row'>
          <div class=' form-group col-md-6 '>
            <select  class='form-control ' onchange='loadkota()' id='provinsi'>
            </select>
            <label class='text-danger' id='aprovinsi' >*Provinsi harus dipilih</label>
          </div>
          
          <div class=' form-group col-md-6 '>
            <select  class='form-control ' id='kota'>
            </select>
            <label class='text-danger' id='akota' >*Kota harus dipilih</label>
          </div>
          
        </div>
      
        
      
        <div class='col-md-12 form-group'>
          <input
          type='text'
          class='form-control'
          id='kodepos'
          name='zip'
          placeholder='Kode Pos (cth:60xxx)'
          />
          <label class='text-danger' id='akodepos' >*Kodepos harus diisi</label>
        </div>
      
        <div class='col-md-12 form-group p_star'>
        <textarea
        class='form-control'
        name='message'
        id='keterangan'
        rows='1'
        placeholder='Keterangan(cth:Patokan belakang Galaxy mall)'
        ></textarea>
        </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="tambah()">Tambah Alamat</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
          </div>
        </div>
      </div>  
               
    <div>


    </section>
    <!--================End wishlist Area =================-->
    



    <?php
      include "footer.php";
    ?>
<script>
 function tambah() {
        var result = $('#sst');
        var sst = result.val(); 
        sst=parseInt(sst)+1;
        $('#sst').val(sst);
      }

      function kurang(idbtn) {
        var result = $('#sst');
        var sst = result.val(); 
        if (sst-1>=0) {
          sst=parseInt(sst)-1;
          $('#sst').val(sst);
        }
      }

      function tampil() {
        $.post("ajaxcheckout.php",
        {
          jenis:"load_checkout",
        },
        function(data){
          // alert(data);
          // console.log(data);
          $('#tampung_checkout').html(data);
          
        }
        );
      }
      tampil();

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
       //$(".nice-select").css("display","none");
     }
     );
   }

   loadprovinsi();
   resetvalidate();
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
   
   function tambah() {
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
       $.post("ajaxcheckout.php",
       {
         jenis:"insertalamat",
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
        $("#alertnya").html(data);
        window.location.reload();
       }
       );
     }
   
     
   }

   function alamatchoosed(){
    var alamat=$("#option_alamat").val();
    var kurir=$('#kurir').val();
    if (alamat==-1) {//pilih alamat kosong
      //alert("Silahkan Pilih alamat dahulu");
    }else if (alamat==0){//tambah alamat munculkan modal
      $("#exampleModal").modal("show");
    }else{
      if (kurir!="-1") {
        //alert("hitung biaya !");
        hitungbiaya();
      }
    }
  }

   function kurirchoosed() {
    var kurir=$('#kurir').val();
    var alamat=$('#option_alamat').val();
    if (alamat!="-1"||alamat!="0") {
      if (kurir!="-1") {
        //alert("hitung biaya !");
        hitungbiaya();
      }
    }
   }

   function hitungbiaya(){
     //hitung biaya nanti muncukkan disini
     
     var kurir=$('#kurir').val();
     var alamat=$('#option_alamat').val();
     $.post("ajaxcheckout.php",
       {
         jenis:"hitungbiayakirim",
         kurir:kurir,
         alamat:alamat,
       },
       function(data){
         console.log(data);
        //var arr=JSON.parse(data);
        //var harga=arr.rajaongkir.results[0].costs[0].cost[0].value;
        // console.log(harga);
        $('#hargakirim').html(data);
      
       }
       );
   }


   function metode() {
     var kurir=$('#kurir').val();
     var alamat=$('#option_alamat').val();
      var data1="<div class='alert alert-danger' role='alert'>Pilih kurir pengiriman dahulu !<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";//kurir
     var data2="<div class='alert alert-danger' role='alert'>Pilih alamat pengiriman dahulu!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";//alamat
    if (kurir=="-1") {
      $("#alertnya").html(data1);
    }else if (alamat=="-1") {
      $("#alertnya").html(data2);
    }else{
      $.post("ajaxcheckout.php",
       {
         jenis:"bayar",
         idalamat:alamat,
       },
       function(data){
        console.log(data);
        window.location.href="pagepay.php";
       }
       );
    }
   }

</script>

