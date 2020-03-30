<?php
    session_start();
    include_once "../../user-page/conn.php";

    if ($_POST["jenis"]=="insertbarang") {
        $conn=getConn();
        $id="ss01";
        $nama=$_POST["nmbarang"];
        $idkat=$_POST["cbjenis"];
        $harga=$_POST["nmbarang"];
        $idsatuan=$_POST["satuan"];
        $foto=$_SESSION["foto"];
        $desk="";
        $status=$_POST["status"];
        $rating="0";


        $sql="INSERT INTO `barang`(`id_barang`, `nama_barang`, `id_kategori`, `harga`, `id_satuan`, `foto_barang`, `deskripsi_barang`, `status_barang`, `rating`) VALUES ('$id','$nama','$idkat','$harga','$idsatuan','$foto','$desk','$status','$rating')";
        if ($conn->query($sql)) {
            echo "berhasil";
        }else{
            echo "gagal";
        }

        $conn->close();
    }
