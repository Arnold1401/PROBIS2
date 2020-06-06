<?php
include "../conn.php"; // Load file koneksi.php
$connect=getConn();

$search = $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
$limit = $_POST['length']; // Ambil data limit per page
$start = $_POST['start']; // Ambil data start
$idsales = $_POST['idsales'];

$sql = mysqli_query($connect, "SELECT id_hjual FROM hjual where id_sales=$idsales"); // Query untuk menghitung seluruh data siswa
$sql_count = mysqli_num_rows($sql); // Hitung data yg ada pada query $sql

$query = "SELECT * from piutang p, hjual h WHERE (p.id_hjual LIKE '%".$search."%' OR h.id_hjual LIKE '%".$search."%' OR h.tanggal_order LIKE '%".$search."%' OR p.tanggal_jatuh_tempo LIKE '%".$search."%' OR p.sisa_tagihan LIKE '%".$search."%' OR h.status_order LIKE '%".$search."%' OR h.status_pembayaran) and p.id_hjual=h.id_hjual and h.id_sales=$idsales and h.status_pembayaran='Lunas'";

$order_field = $_POST['order'][0]['column']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
$order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
$order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

$sql_data = mysqli_query($connect, $query.$order." LIMIT ".$limit." OFFSET ".$start); // Query untuk data yang akan di tampilkan
$sql_filter = mysqli_query($connect, $query); // Query untuk count jumlah data sesuai dengan filter pada textbox pencarian
$sql_filter_count = mysqli_num_rows($sql_filter); // Hitung data yg ada pada query $sql_filter

$data = mysqli_fetch_all($sql_data, MYSQLI_ASSOC); // Untuk mengambil data hasil query menjadi array
$callback = array(
    'draw'=>$_POST['draw'], // Ini dari datatablenya
    'recordsTotal'=>$sql_count,
    'recordsFiltered'=>$sql_filter_count,
    'data'=>$data
);

header('Content-Type: application/json');
echo json_encode($callback); // Convert array $callback ke json
?>
