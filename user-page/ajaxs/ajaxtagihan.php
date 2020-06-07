<?php
    session_start();
    include_once '../conn.php';
    include_once '../classes/item.php';

    if ($_POST["jenis"]=="getinfo") {
        $idhjual=$_POST["id"];

        $conn=getConn();
        $kal="";
        $sql="select * from piutang where id_hjual='$idhjual'";
        $result = $conn->query($sql);
        if ($result->num_rows>0) {
            while($row = $result->fetch_assoc()) {
                $id=$row['id_piutang'];
                $tanggal=$row['tanggal_jatuh_tempo'];
                $tagihan=$row['sisa_tagihan'];
                $fxtagihan="IDR ".number_format($tagihan,2);
                $arr=array(
                    "idp"=>$id,
                    "tgl"=>$tanggal,
                    "amount"=>$fxtagihan
                );
            }
        }


        echo json_encode($arr);

        $conn->close();
        echo $kal;
    }

    if ($_POST["jenis"]=="bayartagihan") {
        $idh=$_POST["idh"];

        $conn=getConn();

       
        $sql="select * from piutang where id_hjual='$idh'";
        $result = $conn->query($sql);
        if ($result->num_rows>0) {
            while($row = $result->fetch_assoc()) {
                $tanggal=$row['tanggal_jatuh_tempo'];
                $tagihan=$row['sisa_tagihan'];
                $idp=$row['id_piutang'];

              
            }
        }
        pelunasanfix($idalamat,$idp,$tagihan,$idhjual);
        $sql1="update hjual set status_pembayaran='Menunggu Pelunasan' where id_hjual='$idh'";
        if ($conn->query($sql1)) {
            
            
        }

        $tgl=date("Y-m-d");
        $sql2="update piutang set tanggal_pelunasan='$tgl' where id_hjual='$idh'";
        if ($conn->query($sql2)) {
            
        }


        $conn->close();
    }



    function  pelunasanfix($idalamat,$idp,$tagihan,$idh)
    {
       $idalamat = $_POST["idalamat"];
       $biaya=0;
      
    
       $biayapengiriman = $biaya;//total ongkir
       $_SESSION["totalsemua"] = $tagihan;
       $_SESSION["ongkir"] = 0;
       $_SESSION["tobelanja"] = 0;
    
       
       // Required  orderid hjual
       $transaction_details = array(
          'order_id' => $idp,
          'gross_amount' => $tagihan, // no decimal allowed for creditcard
       );
    
        //-----------------------//
       //--------BARANG--------//
       //----------------------//
    
       //item details
       $arritem = [];
    
       $newrow0 = array(
            "id" => $idp,
            "price" => $tagihan,
            "quantity" => 1,
            "name" => "Pelunasan 85% dari jumlah pembelian",
            //"subtotal"=>$subtotal,
        );
     array_push($arritem, $newrow0);
       
    
       //biaya pengiriman
       $kirim = array(
          "id" => "####",
          "price" => 0,
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
          'email'         => "emosmart@gmail.com",
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
   function selesaikan($orderid){
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

 if ($_POST["jenis"]=="selesaikan") {
    $idhjual=$_POST["idhjual"];
    selesaikan($idhjual);
    $conn=getConn();
    $sql2="update hjual set status_pembayaran='Lunas' where id_hjual='$idhjual' ";
   if ($conn->query($sql2)) {

   }    
   $conn->close();
   keuntungan();
 }

 
 if ($_POST["jenis"]=="selesaikanhutang") {
   $idhjual=$_POST["idhjual"];

   $conn=getConn();
   $sql="select * from piutang where id_hjual='$idhjual'";
   $result = $conn->query($sql);
   if ($result->num_rows>0) {
       while($row = $result->fetch_assoc()) {
           $id=$row['id_piutang'];
           selesaikan($id);
       }
   }
   $sql2="update hjual set status_pembayaran='Lunas' where id_hjual='$idhjual' ";
   if ($conn->query($sql2)) {

   }    
   $conn->close();

   keuntungan();
}

function keuntungan(){
    $idcust=$_SESSION["idcust"];
    $kal="";
    $conn=getConn();
    $arrhjual=[];
    $sql="select * from hjual where status_pembayaran='Lunas' and id_cust='$idcust' ";
    $result=$conn->query($sql);
    if ($result->num_rows>0) {
        while ($row=$result->fetch_assoc()) {
            $id=$row["id_hjual"];
            $kal.="id=$id";
            array_push($arrhjual,$id);
           
        }
    }
    $conn->close();
    
 
    for ($i=0; $i <count($arrhjual); $i++) { 

           
        $conn=getConn();
        $idhjual=$arrhjual[$i];
        
        $sql1="select distinct d.id_hjual as hjual,sum(d.subtotal-(b.harga_beli*d.kuantiti)) as keuntungan
        from djual d,barang b
        where d.id_barang=b.id_barang and
        d.id_hjual in(select d.id_hjual from djual d
        where d.id_hjual='$idhjual')";
        $result1=$conn->query($sql1);
        if ($result1->num_rows>0) {
            while ($row1=$result1->fetch_assoc()) {
                $keuntungan=$row1["keuntungan"];
                
            }
            if ($keuntungan<0) {
                $keuntungan*=-1;
            }
            $sql2="update hjual set keuntungan='$keuntungan' where id_hjual='$idhjual' ";
            if ($conn->query($sql2)) {
                $kal.="update $i berhasil idhjual $idhjual";
            }
        }
        $conn->close();
        $keuntungan=0;
       
    }
    

    echo $kal;
    
 
  }
 



?>