<?php
include_once 'conn.php';

if ($_POST['jenis'] == "register") {
    // (0 - admin) (1 - reseller)(2 - sales) -- role
    // (0 - menunggu ) (1 - valid ) (2 - tidak valid) -- status akun
    
    $nama_perusahaan = $_POST["nama_perusahaan"];
    $nama_user = $_POST["nama_user"];
    $nomor_ktp = $_POST["nomor_ktp"];
    $foto_ktp = $_POST["foto_ktp"];
    $telp_user = $_POST["telp_user"];
    $lahir_user = $_POST["lahir_user"];
    $jeniskelamin_user = $_POST["jeniskelamin_user"];
    $alamat_user = $_POST["alamat_user"];
    $sales_pilihanuser = "null";
    $email_user = $_POST["email_user"];
    $password_user = $_POST["password_user"];
    $prov = $_POST["prov"];
    $kota = $_POST["kota"];
    $camat = $_POST["camat"];
    $password_user = $_POST["password_user"];
    $role_user = 1; 
    $status_akun = 0;
    $id_user = substr($nama_user,0,3);
    $conn = getConn();

    $sql1 = "select * from customer";
    $result1 = $conn->query($sql1);
    $ctr = 0;
    while ($row1 = $result1->fetch_assoc()) {
        if ($email_user == $row1["email"]) {
            $ctr = 1;
        }
    }
    if ($ctr == 0) {
        $id_user.=str_pad(($ctr+1),3,"0",STR_PAD_LEFT);
        
        $sql2 = "insert into customer (email,nama_perusahaan,nama_pemilik,foto_ktp,nomor_ktp,tanggal_lahir,jenis_kelamin,password,notelp,status,id_sales) values ('$email_user','$nama_perusahaan','$nama_user','$foto_ktp','$nomor_ktp','$lahir_user','$jeniskelamin_user','$password_user','$telp_user','0','$sales_pilihanuser')";
        $sql3 = "insert into alamat_pengiriman (email,provinsi,kota,kecamatan,alamat_lengkap,no_prioritas) values ('$email_user','$prov','$kota','$camat','$alamat_user','1')";

        if ($conn->query($sql2)) {
            if($conn->query($sql3)){
            echo "berhasil register";
            }
            
        }else{
            echo "gagal register";
        }
    }
    else {
        echo "email telah digunakan!";
    }
    $conn->close();
}





// load barang/produk di produk.php


?>