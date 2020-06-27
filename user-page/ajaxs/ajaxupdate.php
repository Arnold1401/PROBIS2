<?php

session_start();
include_once "../conn.php";

$conn=getConn();
$status=$_POST["status"];

$id=$_POST["id"];





$sql="update hjual set status_order='$status', notifikasi='3' where id_hjual='$id';";




if($conn->query($sql)){

    echo "Berhasil konfirmasi bahwa barang telah sampai tujuan";

}



?>