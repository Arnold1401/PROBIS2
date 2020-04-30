<?php
session_start();
include_once '../conn.php';


function getorderid(){
   $noinvoice=date("ymd");
   $jadi=1;
   $ada="";
   $conn=getConn();
   $sql="select max(id_hjual) as NO from hjual where id_hjual like '$noinvoice%'";
   $result = $conn->query($sql);
   if ($result->num_rows>0) {
       while($row = $result->fetch_assoc()) {
           $ada=$row['NO'];
       }
       $jadi=intval(substr($ada,6,5))+1;
   }
   $noinvoice=date("ymd").str_pad($jadi,5,0,STR_PAD_LEFT);
   $conn->close();
   return $noinvoice;
}

if ($_POST['jenis']=="bayarlunas") {
    $conn=getConn();
    $biayapengiriman= $_SESSION["shippingcost"];
    $totalbelanja=$_SESSION["grossamount"];
    
    $totalsemua=$biayapengiriman+$totalbelanja;
    $_SESSION["totalsemua"]=$totalsemua;

    $iduser=$_SESSION["idcust"];
    $idalamat=$_POST["idalamat"];

 
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

?>