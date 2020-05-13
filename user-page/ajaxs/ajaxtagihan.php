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
        $idp=$_POST["id"];
        $idalamat=$_POST["ida"];

        $conn=getConn();

       
        $sql="select * from piutang where id_piutang='$idp'";
        $result = $conn->query($sql);
        if ($result->num_rows>0) {
            while($row = $result->fetch_assoc()) {
                $tanggal=$row['tanggal_jatuh_tempo'];
                $tagihan=$row['sisa_tagihan'];
                $idhjual=$row['id_hjual'];

              
            }
        }
        pelunasanfix($idalamat,$idp,$tagihan,$idhjual);
        



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
    
