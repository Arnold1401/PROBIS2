<?php
namespace Midtrans;
require_once dirname(__FILE__) . '/midtrans-php/Midtrans.php';
include "importsrc.php";
include "header.php";
require 'classes/item.php';
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
          <?php
          $kal="";
             $arr=unserialize($_SESSION["checkout"]);
             $total=0;
             for ($i=0; $i <count($arr); $i++) { 
               $idbarang=$arr[$i]->getIdBarang();
               $jum = $arr[$i]->getJumlah();
               $harga = $arr[$i]->getHarga();
               $subtotal = $arr[$i]->getSubtotal();
               $nama = $arr[$i]->getNama();
               $total+=$subtotal;
               $kal.="<tr>
               <td class='text-right'>$idbarang</td>
            <td class='text-right'>$nama</td>
            <td class='text-right'>$jum</td>
            <td class='text-right'>Rp.$harga</td>
            <td class='text-right'>Rp.$subtotal</td>
            </tr>
           ";
             }
             echo $kal;
          ?>
          <tr>
            <td></td>
            <td></td>
            <td colspan="2" class="text-right"><b>Total Belanja</b></td>
            <td class="text-right">Rp.<?php echo $_SESSION["grossamount"]?></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td colspan="2" class="text-right"><b>Biaya Pegiriman</b></td>
            <td class="text-right">Rp.<?php echo $_SESSION["shippingcost"]?></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td colspan="2" class="text-right"><b>Total Belanja+Biaya Pegiriman</b></td>
            <td class="text-right">Rp.<?php echo $_SESSION["totalsemua"]?></td>
          </tr>
        </table>
      </div>

      <br>
      
      <div class="text-right">
        <a class='gray_btn' href="checkout.php">Kembali ke Checkout</a>
        <button href="#" class="btn btn-primary" onclick="bayar()">Bayar</button>
      </div>

    </div>
  </div>
</div>


<!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-UcTVoNfXmb4_kYpC"></script>
        <script type="text/javascript">
            function bayar(){
              snap.pay('<?php echo $snapToken;?>', {
                    // Optional
                    onSuccess: function(result){
                      $.post("ajaxcheckout.php",
                      {
                        jenis:"inserttrans",
                      },
                      function(data){
                        console.log(data);
                        window.location.href="historytransaksi.php";
                      }
                      );
                      console.log(JSON.stringify(result, null, 2));
                    },
                    // Optional
                    onPending: function(result){
                      $.post("ajaxcheckout.php",
                      {
                        jenis:"inserttrans",
                      },
                      function(data){
                        console.log(data);
                        window.location.href="historytransaksi.php";
                      }
                      );
                      console.log(JSON.stringify(result, null, 2));
                    },
                    // Optional
                    onError: function(result){
                      $.post("ajaxcheckout.php",
                      {
                        jenis:"inserttrans",
                      },
                      function(data){
                        console.log(data);
                        window.location.href="historytransaksi.php";

                      }
                      );
                      console.log(JSON.stringify(result, null, 2));
                    }
                });
            }
        </script>
  </body>
</html>
<?php
  include "gatekeeper.php";
?>