<?php
include "conn.php"; // Load file koneksi.php
$connect=getConn();



$query="

select h.tanggal,h.id_hjual,s.nama_sales,o.status_order

from hjual h, orders o, sales s 

where h.id_hjual=o.id_hjual and s.id_sales=o.id_hjual 



";
$sql = mysqli_query($connect, $query); // Query untuk menghitung seluruh data siswa


$sql_count = mysqli_num_rows($sql); // Hitung data yg ada pada query $sql




$sql_data = mysqli_query($connect, $query); // Query untuk data yang akan di tampilkan





$data = mysqli_fetch_all($sql_data, MYSQLI_ASSOC); // Untuk mengambil data hasil query menjadi array
$callback = array(
    'draw'=>$_POST['draw'], // Ini dari datatablenya
    'recordsTotal'=>$sql_count,
  //  'recordsFiltered'=>$sql_filter_count,
    'data'=>$data
);

header('Content-Type: application/json');
echo json_encode($callback); // Convert array $callback ke json



?>