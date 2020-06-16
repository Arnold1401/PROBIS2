<?php
include "../conn.php"; // Load file koneksi.php
$connect=getConn();

$search = $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
$limit = $_POST['length']; // Ambil data limit per page
$start = $_POST['start']; // Ambil data start
$getId = $_POST['get_id'];

$sql = mysqli_query($connect, "SELECT id_djual FROM djual where id_hjual='$getId'"); // Query untuk menghitung seluruh data siswa
$sql_count = mysqli_num_rows($sql); // Hitung data yg ada pada query $sql


$query = "SELECT d.id_djual, b.nama_barang, d.kuantiti, x.harga_jual, d.subtotal, h.status_order FROM djual d, barang b, hjual h, detail_barang x WHERE (d.id_djual LIKE '%".$search."%' OR d.kuantiti LIKE '%".$search."%' OR d.id_detail_barang LIKE '%".$search."%' OR b.nama_barang LIKE '%".$search."%' OR d.id_ulasan LIKE '%".$search."%') and d.id_detail_barang=x.id_detail_barang and x.id_barang=b.id_barang and h.id_hjual=d.id_hjual and d.id_hjual='$getId'";

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
