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

// if ($_POST["jenis"] == "lihat_ulasan_sayadiBarangini") {
//     $conn=getConn();
//     $iddjualulas = $_POST['iddjualulas'];
//     $temp=""; $rating="";$review="";
//     $temp2= array();
//     $sql = "select * from djual where id_djual=$iddjualulas";
//     $result=$conn->query($sql);
		
//     if($result->num_rows>0){
//         while ($row=$result->fetch_assoc()){
//             $temp =$row['id_ulasan'];
//         }

//         $sql2 = "select * from ulasan where id_ulasan=$temp";
//         $query = mysqli_query($conn,$sql2); // get the data from the db
//         $result2 = array();
//         while ($row1 = $query->fetch_array(MYSQLI_ASSOC)) { // fetches a result row as an associative array
//             $result2 [0] = $row1['id_ulasan'];
//             $result2 [1] = $row1['rating'];
//             $result2 [2] = $row1['isi_review'];
//         }
//     }else{
//         echo "salah";
//     }

    
    
//     $conn->close();
//     header('Content-Type: application/json');
//     echo json_encode($result2); // return value of $result
// }
?>