<?php
include_once 'conn.php';
$conn = getConn();

if ($_POST["jenis"] == "show_product_catalog_semua") {
    $sql = "select * from barang";
    $result1 = $conn->query($sql);

    echo 
    $conn->close();
}

if ($_POST["jenis"] == "konfirmasi_orderan_selesai") {
    $conn = getConn();
    $id_hjual = $_POST['getId'];
    $status = "Selesai";
    $sql = "update hjual set status_order='$status' where id_hjual=$id_hjual";
    if ($conn->query($sql)) {
        echo "Orderan Telah Selesai";
    }else{
        echo "gagal validasi";
    }
    //echo $id_cust;
    $conn->close();
}

if ($_POST["jenis"] == "get_nama_barang") {
    $conn=getConn();
    $idbarang = $_POST['getIdBarang'];
    $temp="";
    $sql = "select * from barang where id_barang=$idbarang";
    $result=$conn->query($sql);
		
    if($result->num_rows>0){
        while ($row=$result->fetch_assoc()){
            $temp =$row['nama_barang'];
        }
        echo $temp;
    }else{
        echo "salah";
    }

    $conn->close();
}

if ($_POST["jenis"] == "kirim_ulasan") {
    $conn=getConn();
    $idbarang = $_POST['idbarang'];
    $idcust = $_POST['idcust'];
    $rating = $_POST['rating'];
    $isiulasan = $_POST['isiulasan'];
    $iddjualulas = $_POST['iddjualulas'];

    $temp="";
    $sql = "insert into ulasan(id_barang, id_cust, rating, isi_review) values($idbarang,$idcust,$rating,'$isiulasan')";
    if ($conn->query($sql)) {
        echo "berhasil beri ulasan";

        $sql2 = "update djual set id_ulasan=LAST_INSERT_ID() where id_djual=$iddjualulas";

        if ($conn->query($sql2)) {
            echo "berhasil";
         }else {
             echo "gagal update detail";
         }
   }else{
       echo "gagal";
   }

   $conn->close();
}

?>