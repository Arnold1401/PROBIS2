<?php
include_once 'adminconn.php';
$conn = getConn();
// admin - master - sales
if ($_POST["jenis"] == "tambah_sales") {
    
    $nama_sales=$_POST["nama_sales"];
    $email=$_POST["email"];
    $no_ktp=$_POST["no_ktp"];
    $nomor_telepon=$_POST["nomor_telepon"];
    $password=$nomor_telepon;
    $provinsi=$_POST["provinsi"];
    $kota=$_POST["kota"];
    $kecamatan=$_POST["kecamatan"];
    $alamat=$_POST["alamat"];
    $status=1;
    $conn = getConn();

    $sql1 = "select * from sales";
    $result1 = $conn->query($sql1);
    $ctr=0;
    while ($row1 = $result1->fetch_assoc()) {
        if ($email == $row1["email"] || $no_ktp == $row1["no_ktp"]) {
            $ctr = 0;
        }
        else {
            $ctr++;
        }
    }

    if ($ctr > 0) {
        $ctr=$ctr+1;
        $sql2 = "insert into sales(id_sales, nama_sales, email, no_ktp, nomor_telepon, password, provinsi, kota, kecamatan, alamat, status) values ('$ctr','$nama_sales','$email',$no_ktp,$nomor_telepon,'$password','$provinsi','$kota','$kecamatan','$alamat','$status')";

        if ($conn->query($sql2)) {
            // echo "berhasil tambah sales"; 
            echo "<script> alert($email)</script>";
        }
        else {
            echo "gagal tambah sales ";
        }

    }
    
    if ($ctr == 0) {
        echo "akun telah terdaftar";
    }
    $conn->close();
}

if ($_POST["jenis"] == "data_valid") {
    $conn = getConn();
    $id_cust = $_POST['id_cust'];
    $status_id = 1;
    $sql = "update customer set status=$status_id where id_cust='$id_cust'";
    if ($conn->query($sql)) {
        echo "berhasil";
    }else{
        echo "gagal validasi";
    }
    //echo $id_cust;
    $conn->close();
}

if ($_POST["jenis"] == "data_tdkvalid") {
    $conn = getConn();
    $id_cust = $_POST['id_cust'];
    $status_id = 2;
    $sql = "update customer set status=$status_id where id_cust='$id_cust'";
    if ($conn->query($sql)) {
        echo "berhasil";
    }else{
        echo "gagal validasi";
    }
    //echo $id_cust;
    $conn->close();
}
?>