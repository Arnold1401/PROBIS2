<?php
include_once 'adminconn.php';

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
        $sql2 = "insert into sales(nama_sales, email, no_ktp, nomor_telepon, password, provinsi, kota, kecamatan, alamat, status) values ('$nama_sales','$email',$no_ktp,$nomor_telepon,'$password','$provinsi','$kota','$kecamatan','$alamat','$status')";

        if ($conn->query($sql2)) {
            echo "berhasil tambah sales";
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

if ($_POST["jenis"] == "detailsales") {
    $email = $_POST["emailsales"];
    $result = mysqli_query(getConn(), "select * from sales where email='".$email."'");
    $trans = mysqli_fetch_array($result);

    
}

if ($_POST["jenis"] == "liatreseller") {
    $email = $_POST["emailsales"];
    $result = mysqli_query(getConn(), "select * from customer where id_sales='".$email."'");
    $trans = mysqli_fetch_array($result);

    echo "";
}

// end of admin - master - sales
?>