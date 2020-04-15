<?php
include_once 'conn.php';
$conn = getConn();

if ($_POST["jenis"] == "show_product_catalog_semua") {
    $sql = "select * from barang";
    $result1 = $conn->query($sql);

    echo 
    $conn->close();
}
?>