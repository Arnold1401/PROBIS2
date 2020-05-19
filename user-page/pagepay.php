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
      <h4>Bayar</h4>
    </div>
    <div class="card-body">
      <div class="row text-center pr-3">
        <table class="col-md-12 text-left" >
          <tr>
            <th class="text-right">Id</th>
            <th class="text-right">Nama</th>
            <th class="text-right">Qty</th>
            <th class="text-right">Harga</th>
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
                <td class='text-right'>Rp.$fharga</td>
                <td class='text-right'>Rp.$fsubtotal</td>
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
            <td class="text-right">Rp.<?php echo number_format($_SESSION["tobelanja"],2)?></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td colspan="2" class="text-right"><b>Biaya Pegiriman</b></td>
            <td class="text-right">Rp.<?php echo number_format($_SESSION["ongkir"],2);?></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td colspan="2" class="text-right"><b>Total Belanja+Biaya Pegiriman</b></td>
            <td class="text-right">Rp.<?php echo number_format($_SESSION["totalsemua"],2);?></td>
          </tr>
        </table>
      </div>

      <br>
      
      <div class="text-right">
        <a class='gray_btn' href="cart.php">Kembali ke Cart</a>
        <button  class="btn btn-primary" onclick="bayar()">Bayar</button>
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
                            window.location.href="status-order.php";
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
                            window.location.href="status-order.php";
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
                            window.location.href="status-order.php";
                      });
                    }
                });
                
            }
        </script>
  </body>
</html>