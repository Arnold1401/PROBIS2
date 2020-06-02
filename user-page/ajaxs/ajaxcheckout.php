<?php
session_start();
include_once '../conn.php';
include_once '../classes/item.php';

function getorderidLUN()//lunas
{
   $noinvoice="LNS".date("ymd");
        $jadi=1;
        $ada="";
        $conn=getConn();
        $sql="select max(id_hjual) as NO from hjual where id_hjual like '$noinvoice%'";
        $result = $conn->query($sql);
        if ($result->num_rows>0) {
            while($row = $result->fetch_assoc()) {
                $ada=$row['NO'];
            }
               $jadi=intval(substr($ada,10,5))+1;
            
        }
        $noinvoice="LNS".date("ymd").str_pad($jadi,5,0,STR_PAD_LEFT);
        $conn->close();

   return $noinvoice;
}

function getorderidPIU()//hutang
{
   $noinvoice="PIT".date("ymd");
        $jadi=1;
        $ada="";
        $conn=getConn();
        $sql="select max(id_piutang) as NO from piutang where id_piutang like '$noinvoice%'";
        $result = $conn->query($sql);
        if ($result->num_rows>0) {
            while($row = $result->fetch_assoc()) {
                $ada=$row['NO'];
            }
               $jadi=intval(substr($ada,10,5))+1;
            
            
        }
        $noinvoice="PIT".date("ymd").str_pad($jadi,5,0,STR_PAD_LEFT);
        $conn->close();

   return $noinvoice;
}

if ($_POST["jenis"]=='getid') {
   echo getorderidLUN();
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


if ($_POST["jenis"] == "summar") {//lunas

   $kal="pas";
   $alam=$_POST["idalamat"];
   if ($_SESSION["status_akun"]==1) {
      if (hitungsubtotalorderan()>=5000000&&hitungsubtotalorderan()<=100000000) {
         $orderid=getorderidLUN();
         sessionpagepayLUN($orderid);
         insertdatabaseLUN($orderid,$alam);

      }else if (hitungsubtotalorderan()>100000000) {
          $kal= "Jumlah transaksi lebih besar dari 100.000.000";
      }else{
         $kal= "Jumlah transaksi lebih kecil dari 5.000.000";
      }
   }else{
      $kal="Akun belum diverifikasi oleh admin silahkan hubungu admin";
   }

   echo $kal;
}

function insertdatabaseLUN($orderid,$alam)
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
   $q1="INSERT INTO `hjual`(`id_hjual`, `tanggal_order`, `tanggal_orderselesai`, `kurir`, `id_sales`, `id_alamatpengiriman`, `grandtotal`, `id_cust`, `status_order`, `status_pembayaran`) VALUES ('$orderid','$tgl','-','$kurir','$idsales','$alam','$totalsemua','$iduser','Proses','Hutang')";
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
      $q2="INSERT INTO `djual`(`id_hjual`, `id_djual`, `id_barang`, `kuantiti`, `subtotal`, `id_ulasan`) VALUES ('$orderid','','$idbarang','$jum','$subtotal','0')";
      $stok=0;
      $q3="select sisa as stok from detail_barang where id_barang='$idbarang'";
      $result3 = $conn->query($q3);
      if ($result3->num_rows > 0) {
         while ($row3 = $result3->fetch_assoc()) {
            $stok = $row3['stok'];
         }
         $stok-=$jum;
      }
      $q4="update detail_barang set sisa='$stok' where id_barang='$idbarang'";
      if ($conn->query($q4)) {

      }

      if ($conn->query($q2)) {
         $stat.="djual$i-berhasil";
      }else{
         $stat.="djual$i-gagal";
         $stat.=mysqli_error($conn);
      }
      echo $stat;
      $conn->close();
   }
   
}

function sessionpagepayLUN($orderid)
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


if ($_POST["jenis"]=="deletecart") {
   unset($_SESSION["keranjang"]);
}


if ($_POST["jenis"] == "piutang") {//piu

   $kal="pas";
   $alam=$_POST["idalamat"];
   if ($_SESSION["status_akun"]==1) {
      if (hitungsubtotalorderan()>=5000000&&hitungsubtotalorderan()<=100000000) {
         $orderid=getorderidLUN();
         $piu=getorderidPIU();
         echo $piu;
         sessionpagepayPIU($orderid,$piu);
         insertdatabasePIU($orderid,$piu,$alam);
      }else if (hitungsubtotalorderan()>100000000) {
         $kal="Jumlah transaksi lebih besar dari 100.000.000";
      }else{
         $kal= "Jumlah transaksi lebih kecil dari 5.000.000";
      }
   }else{
      $kal= "Akun belum diverifikasi oleh admin silahkan hubungu admin";
   }
   echo $kal;
}

function insertdatabasePIU($orderid,$piu,$alam)
{
   $stat="";
   //insert hjual
   $conn = getConn();


   $tgl=date("Y-m-d");
   $tgl = new DateTime($tgl);
   $interval = new DateInterval('P1M');//plus 1 bulan
   $tgl->add($interval);
   
   $tgljth=$tgl->format('Y-m-d'); //tanggal jatuh tempo
   $kurir = $_POST["kurir"]; //paket dan kurir
   $totalsemua=$_SESSION["totalsemua"];
   $iduser = $_SESSION["idcust"];

   $sisa=intval($totalsemua*0.85); //sisa
   $bayar=intval($totalsemua*0.15); //bayar

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

   $tglord=date("Y-m-d");
   //insert piutang
   $conn = getConn();
   $q2="INSERT INTO `piutang`(`id_piutang`, `id_hjual`, `tanggal_jatuh_tempo`, `sisa_tagihan`,`tanggal_order`) VALUES ('$piu','$orderid','$tgljth','$sisa','$tglord')";
   if ($conn->query($q2)) {
      $stat.="piutang-berhasil";
   }else{
      $stat.="piutang-gagal";
   }
   $conn->close();

   $conn = getConn();
   $tgl=date("Y-m-d");

   $q1="INSERT INTO `hjual`(`id_hjual`, `tanggal_order`, `tanggal_orderselesai`, `kurir`, `id_sales`, `id_alamatpengiriman`, `grandtotal`, `id_cust`, `status_order`, `status_pembayaran`) VALUES ('$orderid','$tgl','-','$kurir','$idsales','$alam','$bayar','$iduser','Proses','Hutang')";
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


      $stok=0;
      $q3="select sisa as stok from detail_barang where id_barang='$idbarang'";
      $result3 = $conn->query($q3);
      if ($result3->num_rows > 0) {
         while ($row3 = $result3->fetch_assoc()) {
            $stok = $row3['stok'];
         }
         $stok-=$jum;
      }
      $q4="update detail_barang set sisa='$stok' where id_barang='$idbarang'";
      if ($conn->query($q4)) {

      }

      $q2="INSERT INTO `djual`(`id_hjual`, `id_djual`, `id_barang`, `kuantiti`, `subtotal`, `id_ulasan`) VALUES ('$orderid','','$idbarang','$jum','$subtotal','0')";
      
      if ($conn->query($q2)) {
         $stat.="djual$i-berhasil";
      }else{
         $stat.="djual$i-gagal";
         $stat.=mysqli_error($conn);
      }
      $conn->close();
   }

   echo $stat;
   
}

function sessionpagepayPIU($orderid,$piu)
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


   $jumutang=-intval($totalsemua*0.85);//utang
   $totalsemua=$totalsemua*0.15;//bayar
   
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

   //hutang
   $hutang = array(
      "id" => $piu,
      "price" => $jumutang,
      "quantity" => 1,
      "name" => "-85% dari jumlah grossamount",
      //"subtotal"=>$subtotal,
   );
   array_push($arritem, $hutang);

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

// get status 
function getstat($orderid){
  $curl1 = curl_init();
  curl_setopt_array($curl1, array(
  CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/$orderid/cancel",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_HTTPHEADER => array(
   "Authorization:Basic U0ItTWlkLXNlcnZlci04Tk44ZDlaZTNKNldWcElsQWdWbC1faHY= ,: ",
   "Content-Type: application/json",
   "Accept: application/json"
  ),
  ));

  //dibawah ini sudah diencode dengan base64 dari server key nya merchan sendiri
  //U0ItTWlkLXNlcnZlci04Tk44ZDlaZTNKNldWcElsQWdWbC1faHY= 

  $response1 = curl_exec($curl1);
  return $response1;
}

if ($_POST["jenis"]=="getnotif") {
   echo getstat("LUN20050200001");
}

?>



