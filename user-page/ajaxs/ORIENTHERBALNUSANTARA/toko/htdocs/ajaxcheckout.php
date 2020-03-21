<?php
session_start();
require 'classes/item.php';//idcart,iduser,idbarang,jumlah,harga,subtotal,nama
require 'conn.php';
if ($_POST["jenis"]=="load_checkout") {
    $kal="";
    $iduser="";
    if (isset($_SESSION["checkout"])) {
      $arr=unserialize($_SESSION["checkout"]);
      $total=0;
      for ($i=0; $i <count($arr); $i++) { 
        $idcart=$arr[$i]->getIdCart();
        $idbarang=$arr[$i]->getIdBarang();
        $iduser =$arr[$i]->getIdUser();
        $jum = $arr[$i]->getJumlah();
        $harga = $arr[$i]->getHarga();
        $subtotal = $arr[$i]->getSubtotal();
        $nama = $arr[$i]->getNama();
        $img = $arr[$i]->getGambar();
        $total+=$subtotal;
        $kal.="<tr>
        <td></td>
        <td>
           <img src='$img' style='width:80px;height:60px;' alt='' />
        </td>
        <td>
           <h5>$nama</h5>
        </td>
        <td>
           <div class='product_count'>
              <h5>$jum</h5>
           </div>
        </td>
        <td>
           <h5>Rp.$harga</h5>
        </td>
        <td>
           <h5>Rp.$subtotal</h5>
        </td>
     </tr>
    ";
      }

      $_SESSION["grossamount"]=$total;
      $_SESSION["iduser"]=$iduser;
      

      $kal.="<tr>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td><h5><b>Subtotal Pembelian</b></h5></td>
         <td><h5>Rp.$total</h5></td>
      </tr>
      <tr>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td><h5><b>Biaya Pengiriman</b></h5><b></td>
         <td><h5>Rp.<strong id='hargakirim'>0<strong></h5></td>
      </tr>";
      
      
  
      $kal.="";
    }else{
      echo "kosong";
    }
    echo $kal;
  }

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

   if ($_POST["jenis"]=="insertalamat") {
      $conn=getConn();
      $data="";
      $iduser=getiduser();
      $nama=$_POST['nm'];
      $telp=$_POST['telp'];
      $alamat=$_POST['alamat'];
      $kec=$_POST['kec'];
      $kel=$_POST['kel'];
      $pro=$_POST['pro'];
      $kot=$_POST['kot'];
      $kod=$_POST['kod'];
      $ket=$_POST['ket'];

      $sql1 = "INSERT INTO info_pengiriman VALUES ('','$alamat','$kod','$kot','$pro','$nama','$telp','$iduser','$kec','$kel','$ket','1')";
        $result1 = $conn->query($sql1);
        
        if ($result1 == true) {
            $data="<div class='alert alert-success' role='alert'>
            Anda berhasil menambahkan alamat pengiriman
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button>
      </div>";
        }else{
            $data="<div class='alert alert-danger' role='alert'>
            Anda gagal menambahkan alamat pengiriman
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button>
      </div>";
        }
      echo $data;
  }

  if ($_POST['jenis']=="hitungbiayakirim") {
   $courier=$_POST["kurir"];
   $alamat=$_POST["alamat"];

   $origin="444";//444 id kota surabaya
   $tujuan="43";//id kota tujuan di info pengiriman field KOTA hrs diganti !!!
   $berat="1700";//berat barang total

   $curl = curl_init();
   curl_setopt_array($curl, array(
   CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => "",
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 30,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => "POST",
   CURLOPT_POSTFIELDS => "origin=$origin&destination=$tujuan&weight=$berat&courier=$courier",
   CURLOPT_HTTPHEADER => array(
      "content-type: application/x-www-form-urlencoded",
      //"key:8ccbf31cdb56de646092992e32819d09"
      "key:f6f75c48479eab3c1f7ef267738ccc8b"
   ),
   ));

   $response = curl_exec($curl);
   $err = curl_error($curl);

   curl_close($curl);

   if ($err) {
   echo "cURL Error #:" . $err;
   } else {
   //echo $response;
   }

   $biayapengiriman="";
   $arr=json_decode ( $response);
   $biayapengiriman=$arr->rajaongkir->results[0]->costs[0]->cost[0]->value;
   $_SESSION["shippingcost"]=$biayapengiriman;
   $_SESSION["kurir"]=$courier;
   echo $biayapengiriman;
 
  }

  function getorderid(){
     $orderid="";
     $iduser=getiduser();

     $conn=getConn();
     $sql = "SELECT count(id_hjual)+1 as hid FROM hjual where id_user='$iduser'";
     $result = $conn->query($sql);
     if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
           $orderid=$row['hid'];
         }
     }
     $orderid="U$iduser|P$orderid"; 

     return $orderid;
  }

  if ($_POST['jenis']=="bayar") {
      $conn=getConn();
      $biayapengiriman= $_SESSION["shippingcost"];
      $totalbelanja=$_SESSION["grossamount"];
      $iduser=$_SESSION["iduser"];
      $idalamat=$_POST["idalamat"];

      $totalsemua=$biayapengiriman+$totalbelanja;
      $_SESSION["totalsemua"]=$totalsemua;
      //BUAT ID ORDER untuk user
      $orderid=getorderid();
    
      // Required  orderid hjual
      $transaction_details = array(
         'order_id' => $orderid,
         'gross_amount' => $totalsemua, // no decimal allowed for creditcard
      );

      //item details
      $arritem=[];
      $total=0;
      $arr=unserialize($_SESSION["checkout"]);
      for ($i=0; $i <count($arr); $i++) { 
         $idcart=$arr[$i]->getIdCart();
         $idbarang=$arr[$i]->getIdBarang();
         $iduser =$arr[$i]->getIdUser();
         $jum = $arr[$i]->getJumlah();
         $harga = $arr[$i]->getHarga();
         $subtotal = $arr[$i]->getSubtotal();
         $nama = $arr[$i]->getNama();
         $total+=$subtotal;
         $newrow0=array(
            "id"=>$idbarang,
            "price"=>$harga,
            "quantity"=>$jum,
            "name"=>$nama,
            //"subtotal"=>$subtotal,
          );
         array_push($arritem,$newrow0);
      }

      //biaya pengiriman
      $kirim=array(
         "id"=>"000000",
         "price"=>$biayapengiriman,
         "quantity"=>"1",
         "name"=>"Biaya Pengiriman",
       );

      array_push($arritem,$kirim);
      // Optional
      $item_details = $arritem;

      $namapenerima="";
      $alamatkirim="";
      $kota="";
      $kodepos="";
      $telppenerima="";

      $sql1 = "SELECT * FROM info_pengiriman where id_alamat='$idalamat'";
      $result1 = $conn->query($sql1);
      if ($result1->num_rows > 0) {
         while($row1 = $result1->fetch_assoc()) {
            $namapenerima=$row1['NAMA_PENERIMA'];
            $alamatkirim=$row1['JALAN'];
            $kota=$row1["KOTA"];
            $kodepos=$row1["KODEPOS"];
            $telppenerima=$row1["NO_HP_PENERIMA"];
         }
      }
    
      $shipping_address = array(
         'Nama Penerima'    => $namapenerima,
         'Alamat Pengiriman' => $alamatkirim,
         'Kota' => $kota,
         'Kode Pos' => $kodepos,
         'Nomor Telpon' => $telppenerima,
         'Negara'  => 'IDN'
      );
      
      $namauser="";
      $telpuser="";
      $emailuser="";
      $sql0 = "SELECT * FROM user where id_user='$iduser'";
      $result0 = $conn->query($sql0);
      if ($result0->num_rows > 0) {
         while($row0 = $result0->fetch_assoc()) {
            $namauser=$row0["NAMA_USER"];
            $telpuser=$row0["TELP_USER"];
            $emailuser=$row0["EMAIL_USER"];
         }
      }

      // Optional
      $customer_details = array(
         'first_name'    => $namauser,
         'email'         => $emailuser,
         'phone'         => $telpuser,
         'shipping_address' => $shipping_address
      );
      

      $enable_payments = array('bank_transfer','echannel');
      // Fill transaction details
      $transaction = array(
         'enabled_payments' => $enable_payments,
         'transaction_details' => $transaction_details,
         'customer_details' => $customer_details,
         'item_details' => $item_details,
      );
      $_SESSION["orderid"]=$orderid;
      $_SESSION["idalamat"]=$idalamat;
      $_SESSION["transaction"]=$transaction;
      echo json_encode($transaction);
  }


  if ($_POST["jenis"]=="inserttrans") {
      $conn=getConn();
      $idhjual=$_SESSION["orderid"];
      $tglhjual= date("Y-m-d");
      $iduser=getiduser();
      $status="Sedang di Proses";//Sedang di Proses,Sedang di Kirim,Selesai,Gagal
      $statuspayment="Pending";//Pending,Selesai,Gagal
      $idalamat=$_SESSION["idalamat"];
      $kurir=$_SESSION["kurir"];
      $noresi="";

      $kal="";
      //insert hjual
      $sql1="insert into hjual values ('$idhjual','$tglhjual','$iduser','$status','$statuspayment','$idalamat')";
      $result1 = $conn->query($sql1);
      if ($result1) {
        $kal.="Hjual berhasil|";
      }else{
         $kal.="Hjual gagal|";
      }

      //insert djual
       $total=0;
       $arr=unserialize($_SESSION["checkout"]);
       for ($i=0; $i <count($arr); $i++) { 
          $idcart=$arr[$i]->getIdCart();
          $idbarang=$arr[$i]->getIdBarang();
          $qty = $arr[$i]->getJumlah();
          $harga = $arr[$i]->getHarga();
          $subtotal = $arr[$i]->getSubtotal();
          $nama = $arr[$i]->getNama();
          $total+=$subtotal;

          $sql2a = "UPDATE cart SET status='0' WHERE id_cart='$idcart'";
          if ($conn->query($sql2a) === TRUE) {
            $kal.="Cart $i berhasil|";
          }else{
            $kal.="Cart $i gagal|";
          }

          $sql2="insert into djual values ('$idhjual','$idbarang','$qty','$subtotal','$harga')";
          $result2 = $conn->query($sql2);
          if ($result2) {
            $kal.="Djual $i berhasil|";
          }else{
            $kal.="Djual $i gagal|";
          }
       }

      //insert resi pengiriman
      $sql3="insert into resi_pengiriman values('','$kurir','$noresi','$idhjual')";
      $result3 = $conn->query($sql3);
      if ($result3) {
        $kal.="resi berhasil|";
      }else{
        $kal.="resi gagal|";
      }

      echo $kal;
  }


?>