<?php
namespace Midtrans;
require_once dirname(__FILE__) . '/midtrans-php/Midtrans.php';

include "head.php";
require 'classes/item.php';
require 'conn.php';
// Fill transaction details
$transaction =$_SESSION["transaction"];


//Set Your server key
Config::$serverKey = "SB-Mid-server-8NN8d9Ze3J6WVpIlAgVl-_hv";
// Uncomment for production environment
// Config::$isProduction = true;
// Enable sanitization
Config::$isSanitized = true;
// Enable 3D-Secure
Config::$is3ds = true;
// Required



$snapToken = Snap::getSnapToken($transaction);
//echo "snapToken = ".$snapToken;
?>
<?php
require_once("head.php");
?>
<html>
<body>

<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h4>Konfirmasi Pesanan Anda</h4>
    </div>
    <div class="card-body">
      <div class="row text-center pr-3">
        <table class="col-md-12 text-left" >
          <tr>
            <th class="text-right">#Id</th>
            <th class="text-right">Nama Barang</th>
            <th class="text-right">Jumlah</th>
            <th class="text-right">Harga Barang</th>
            <th class="text-right">Subtotal</th>
          </tr>
         <!--difor nanti-->
         <!-- tabel summarry -->
          <?php
          if (isset($_SESSION["keranjang"])) {
            $kal="";
             $arr=unserialize($_SESSION["keranjang"]);
             $total=0;
             for ($i=0; $i <count($arr); $i++) { 

              $idbarang=$arr[$i]->get_idbarang();
              $jum = $arr[$i]->get_jum();
              $harga = $arr[$i]->get_harga();
              $nama = $arr[$i]->get_nama();
              $subtotal=$jum*$harga;
               $total+=$subtotal;

               $fharga=number_format($harga,2);
               $fsubtotal=number_format($subtotal,2);
               $kal.="<tr>
               <td class='text-right'>$idbarang</td>
                <td class='text-right'>$nama</td>
                <td class='text-right'>$jum</td>
                <td class='text-right'>Rp $fharga</td>
                <td class='text-right'>Rp $fsubtotal</td>
              </tr>";
             }

             if (isset($_SESSION["jenisbayar"])&&$_SESSION["jenisbayar"]=="hutang") {
               $hutangnya=$_SESSION["hutangnya"];
              $kal.="<tr>
              <td class='text-right'>01</td>
               <td class='text-right'>Jumlah yang harus dibayar penagihan berikutnya</td>
               <td class='text-right'>1</td>
               <td class='text-right'>Rp $hutangnya</td>
               <td class='text-right'>Rp $hutangnya</td>
             </tr>";
             }
             
             echo $kal;
          }else{
            
          }
          
          ?>
          <tr>
            <td></td>
            <td></td>
            <td colspan="2" class="text-right"><b>Total Belanja</b></td>
            <td class="text-right">Rp <?php echo number_format($_SESSION["tobelanja"],2)?></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td colspan="2" class="text-right"><b>Biaya Pengiriman</b></td>
            <td class="text-right">Rp <?php echo number_format($_SESSION["ongkir"],2);?></td>
          </tr>

        <?php
          if (isset($_SESSION["jenisbayar"])&&$_SESSION["jenisbayar"]=="hutang") {
               $hutangnya=$_SESSION["hutangnya"];
              ?>

<tr>
            <td></td>
            <td></td>
            <td colspan="2" class="text-right"><b>Hutang</b></td>
            <td class="text-right">Rp <?php echo number_format($_SESSION["hutangnya"],2);?></td>
          </tr>

                <tr>
            <td></td>
            <td></td>
            <td colspan="2" class="text-right"><b>Grandtotal</b></td>
            <td class="text-right">Rp <?php echo number_format($_SESSION["baysek"],2);?></td>
          </tr>
              <?php
             }
             else{
               ?>
               
               <tr>
            <td></td>
            <td></td>
            <td colspan="2" class="text-right"><b>Grandtotal</b></td>
            <td class="text-right">Rp <?php echo number_format($_SESSION["totalsemua"],2);?></td>
          </tr>
               <?php
             }
            ?>

          
        </table>
      </div>

      <br>
      
      <div class="form-group text-right">
        <label for=""></label>
        <a class='gray_btn' href="cart.php">Kembali ke Cart</a>
        <button  class="btn btn-primary" onclick="bayar()">Konfirmasi</button>
      </div>
      
    </div>
  </div>
</div>

<?php
    include_once('justfooter.php')
    ?>
<!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-UcTVoNfXmb4_kYpC"></script>
        <script type="text/javascript">
            function bayar(){
              snap.pay('<?php echo $snapToken;?>', {
                    // Optional
                    onSuccess: function(result){
                        //window.location.href="status-order.php";
                      console.log(JSON.stringify(result, null, 2));
                      console.log("ini tanpa stringfy");
                      console.log(result["transaction_id"]);
                      $.post("ajaxs/ajaxcheckout.php", {
                              jenis: "deletecart",
                          },
                          function(data) {
                            console.log(data);
                            window.location.href="tagihan.php";
                      });
                    },
                    // Optional
                    onPending: function(result){
                      //window.location.href="status-order.php";
                      console.log(JSON.stringify(result, null, 2));
                      console.log("ini tanpa stringfy");
                      console.log(result["transaction_id"]);
                      $.post("ajaxs/ajaxcheckout.php", {
                              jenis: "deletecart",
                          },
                          function(data) {
                            console.log(data);
                            window.location.href="tagihan.php";
                      });
                     
                    },
                    // Optional
                    onError: function(result){
                        //window.location.href="status-order.php";
                        console.log(JSON.stringify(result, null, 2));
                        console.log("ini tanpa stringfy");
                      console.log(result["transaction_id"]);
                      $.post("ajaxs/ajaxcheckout.php", {
                              jenis: "deletecart",
                          },
                          function(data) {
                            console.log(data);
                            window.location.href="tagihan.php";
                      });
                    }
                });
                
            }
        </script>
  </body>
</html>