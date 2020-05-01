<?php
session_start();
include_once '../conn.php';
include_once '../classes/item.php';

function getorderid()
{
   $noinvoice="";
        $jadi=1;
        $ada="";
        $conn=getConn();
        $sql="select max(id_hjual) as NO from hjual where id_hjual like '$noinvoice%'";
        $result = $conn->query($sql);
        if ($result->num_rows>0) {
            while($row = $result->fetch_assoc()) {
                $ada=$row['NO'];
            }
            $jadi=intval(substr($ada,7,5))+1;
        }
        $noinvoice=date("ymd").str_pad($jadi,5,0,STR_PAD_LEFT);
        $conn->close();

   return $noinvoice;
}

if ($_POST["jenis"]=='getid') {
   echo getorderid();
}

function hitungsubtotalorderan()
{
   $subtotal = 0;
   if (isset($_SESSION["keranjang"])) {
      $arrkeranjang = unserialize($_SESSION["keranjang"]);
      $count = count($arrkeranjang);

      for ($i = 0; $i < $count; $i++) {
         $subtotal += $arrkeranjang[$i]->get_jum() * $arrkeranjang[$i]->get_harga();
      }
   }
   return $subtotal;
}


if ($_POST["jenis"] == "summar") {
   $orderid=getorderid();
   sessionpagepay($orderid);
   insertdatabase($orderid);
}

function insertdatabase($orderid)
{
   $stat="";
   //insert hjual
   $conn = getConn();


   $tgl=date("Y-m-d");
   $kurir = $_POST["kurir"]; //paket dan kurir
   $totalsemua=$_SESSION["totalsemua"];
   $iduser = $_SESSION["idcust"];

   $idsales="";
   $conn = getConn();
   $q0="select id_sales as sales from customer where id_cust='$iduser'";
   $result0 = $conn->query($q0);
   if ($result0->num_rows > 0) {
      while ($row0 = $result0->fetch_assoc()) {
         $idsales = $row0['sales'];
      }
   }
   $conn->close();

   $conn = getConn();
   $q1="INSERT INTO `hjual` (`id_hjual`, `tanggal_order`, `tanggal_orderselesai`, `kurir`, `id_sales`, `grandtotal`, `id_cust`, `status_order`) VALUES ('$orderid', '$tgl','', '$kurir', '$idsales', '$totalsemua', '$iduser', '1');";
   if ($conn->query($q1)) {
      $stat.="hjual-berhasil";
   }else{
      $stat.="hjual-gagal";
   }
   $conn->close();


   //insert djual
  
  
   $arr = unserialize($_SESSION["keranjang"]);
   for ($i = 0; $i < count($arr); $i++) {

      $idbarang = $arr[$i]->get_idbarang();
      $jum = $arr[$i]->get_jum();
      $harga = $arr[$i]->get_harga();
      $subtotal=$jum*$harga;
     
      $conn = getConn();
      $q2="INSERT INTO `djual`(`id_hjual`, `id_djual`, `id_barang`, `kuantiti`, `subtotal`, `id_ulasan`) VALUES ('$orderid','1','$idbarang','$jum','$subtotal','0')";
      
      if ($conn->query($q2)) {
         $stat.="djual$i-berhasil";
      }else{
         $stat.="djual$i-gagal";
      }
      $conn->close();
   }
   
   

   echo $stat;
}

function sessionpagepay($orderid)
{
   $idalamat = $_POST["idalamat"];
   $iduser = $_SESSION["idcust"];
   $biaya=$_POST["ongkir"];
  

   $totalbelanja = hitungsubtotalorderan();//total belanja
   $biayapengiriman = $biaya;//total ongkir
   $totalsemua = $biayapengiriman + $totalbelanja;//total semua
   $_SESSION["totalsemua"] = $totalsemua;
   $_SESSION["ongkir"] = $biaya;
   $_SESSION["tobelanja"] = $totalbelanja;

   
   // Required  orderid hjual
   $transaction_details = array(
      'order_id' => $orderid,
      'gross_amount' => $totalsemua, // no decimal allowed for creditcard
   );

    //-----------------------//
   //--------BARANG--------//
   //----------------------//

   //item details
   $arritem = [];

   $arr = unserialize($_SESSION["keranjang"]);
   for ($i = 0; $i < count($arr); $i++) {

      $idbarang = $arr[$i]->get_idbarang();
      $jum = $arr[$i]->get_jum();
      $harga = $arr[$i]->get_harga();
      $nama = $arr[$i]->get_nama();

      $newrow0 = array(
         "id" => $idbarang,
         "price" => $harga,
         "quantity" => $jum,
         "name" => $nama,
         //"subtotal"=>$subtotal,
      );
      array_push($arritem, $newrow0);
   }

   //biaya pengiriman
   $kirim = array(
      "id" => "000000",
      "price" => $biayapengiriman,
      "quantity" => "1",
      "name" => "Biaya Pengiriman",
   );

   array_push($arritem, $kirim);
   // Optional
   $item_details = $arritem;

   //-----------------------//
   //--------ALAMAT--------//
   //----------------------//

   $namapenerima = "";
   $alamatkirim = "";
   $kota = "";
   $kodepos = "";
   $telppenerima = "";
   $email = "";

   $conn = getConn();
   $sql1 = "SELECT c.email as email,c.nama_pemilik as nama,a.alamat_lengkap as jalan,a.kota as kota,a.kode_pos as kodepos,c.notelp as nohp  FROM alamat_pengiriman a,customer c where a.email=c.email and a.id_alamat='$idalamat'";
   $result1 = $conn->query($sql1);
   if ($result1->num_rows > 0) {
      while ($row1 = $result1->fetch_assoc()) {
         $namapenerima = $row1['nama'];
         $alamatkirim = $row1['jalan'];
         $kota = $row1["kota"];
         $kodepos = $row1["kodepos"];
         $telppenerima = $row1["nohp"];
         $email = $row1["email"];
      }
   }
   $conn->close();

   $arrkota = explode('-', $kota);
   $kota = $arrkota[0];

   $shipping_address = array(
      'Nama Penerima'    => $namapenerima,
      'Alamat Pengiriman' => $alamatkirim,
      'Kota' => $kota,
      'Kode Pos' => $kodepos,
      'Nomor Telpon' => $telppenerima,
      'Negara'  => 'IDN'
   );


   // Optional
   $customer_details = array(
      'first_name'    => $namapenerima,
      'email'         => $email,
      'phone'         => $telppenerima,
      'shipping_address' => $shipping_address
   );


   $enable_payments = array('bank_transfer', 'echannel');
   // Fill transaction details
   $transaction = array(
      'enabled_payments' => $enable_payments,
      'transaction_details' => $transaction_details,
      'customer_details' => $customer_details,
      'item_details' => $item_details,
   );

   $_SESSION["transaction"] = $transaction;
   //echo json_encode($transaction);
}

function getsummar()
{

}


