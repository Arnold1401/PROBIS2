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

if ($_POST['jenis']=="getid") {
   echo getorderid();
}

function hitungsubtotalorderan(){
   $subtotal=0;
   if (isset($_SESSION["keranjang"])) {
       $arrkeranjang=unserialize($_SESSION["keranjang"]);
       $count=count($arrkeranjang);
      
       for ($i=0; $i <$count; $i++) { 
           $subtotal+=$arrkeranjang[$i]->get_jum()*$arrkeranjang[$i]->get_harga();
       }
       
   }
   return $subtotal;
}

if ($_POST['jenis']=="bayarlunas") {
    $conn=getConn();

    //total belanja
    //total ongkir
    //total semua


    $biayapengiriman= $_SESSION["shippingcost"];
    $totalbelanja=$_SESSION["grossamount"];

    $totalsemua=$biayapengiriman+$totalbelanja;
    $_SESSION["totalsemua"]=$totalsemua;
    ///////////////////
 


    $iduser=$_SESSION["idcust"];
    $idalamat=$_POST["idalamat"];

    //BUAT ID ORDER untuk user
    $orderid=getorderid();

    //insert hjual
    
    $conn=getConn();
    $tgl=date("Y-m-d");
    $kurir=$_POST["kurir"];//paket dan kurir
    $idsales='99';//pelayan customer
    

    $querystat="";

    $sql1="INSERT INTO `hjual`(`id_hjual`, `tanggal_order`, `tanggal_orderselesai`, `kurir`, `id_sales`, `grandtotal`, `id_cust`, `status_order`) VALUES ('$orderid','$tgl','','$kurir','$idsales','$totalsemua','$iduser','1')";
    if ($conn->query($sql1)) {
      $querystat="hjual-berhasil";
    }

    $conn->close();
   //insert djual
   $arrkeranjang=unserialize($_SESSION["keranjang"]);
   $count=count($arrkeranjang);
   $totalbar=0;
   for ($i=0; $i <$count ; $i++) { 
       $idb=$arrkeranjang[$i]->get_idbarang();
       $nm=$arrkeranjang[$i]->get_nama();
       $hg=$arrkeranjang[$i]->get_harga();
       $jum=$arrkeranjang[$i]->get_jum();
       $fhg=number_format($hg,0);

       $conn=getConn();
       $subtotal=$hg*$jum;
       $statbarang="Belum Kirim";
       $sql2="INSERT INTO `detail_order`(`NomerOrder`,`id_barang`, `nama_barang`, `harga_barang`, `jum`, `subtotal`, `status`) VALUES ('$noinvoice','$idb','$nm','$hg','$jum','$subtotal','$statbarang')";
       if ($conn->query($sql2)) {
           $querystat.="djual-$i success";
       }else{
           $querystat.="djual-$i error";
       }
      $conn->close();
   }






    // Required  orderid hjual
    $transaction_details = array(
       'order_id' => $orderid,
       'gross_amount' => $totalsemua, // no decimal allowed for creditcard
    );

    //item details
    $arritem=[];
    $total=0;

    $arr=unserialize($_SESSION["keranjang"]);
    for ($i=0; $i <count($arr); $i++) { 

       $idbarang=$arr[$i]->get_idbarang();
       $jum = $arr[$i]->get_jum();
       $harga = $arr[$i]->get_harga();
       $nama = $arr[$i]->get_nama();

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

    $sql1 = "SELECT c.nama_pemilik as nama,a.alamat_lengkap as jalan,a.kota as kota,a.kode_pos as kodepos,c.notelp as nohp  FROM alamat_pengiriman a,customer c where a.email=c.email and a.id_alamat='$idalamat'";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
       while($row1 = $result1->fetch_assoc()) {
          $namapenerima=$row1['nama'];
          $alamatkirim=$row1['jalan'];
          $kota=$row1["kota"];
          $kodepos=$row1["kodepos"];
          $telppenerima=$row1["nohp"];
       }
    }
  
    $arrkota=explode('-',$kota);
    $kota=$arrkota[0];

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
    $sql0 = "SELECT * FROM customer where id_cust='$iduser'";
    $result0 = $conn->query($sql0);
    if ($result0->num_rows > 0) {
       while($row0 = $result0->fetch_assoc()) {
          $namauser=$row0["nama_pemilik"];
          $telpuser=$row0["notelp"];
          $emailuser=$row0["email"];
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
