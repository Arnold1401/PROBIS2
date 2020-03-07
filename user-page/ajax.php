<?php
include_once 'conn.php';

if ($_POST['jenis'] == "register") {
    // (0 - admin) (1 - reseller)(2 - sales) -- role
    // (0 - menunggu ) (1 - valid ) (2 - tidak valid) -- status akun
    
    $nama_perusahaan = $_POST["nama_perusahaan"];
    $nama_user = $_POST["nama_user"];
    $nomor_ktp = $_POST["nomor_ktp"];
    $foto_ktp = 0;
    $telp_user = $_POST["telp_user"];
    $lahir_user = $_POST["lahir_user"];
    $jeniskelamin_user = $_POST["jeniskelamin_user"];
    $alamat_user = $_POST["alamat_user"];
    $sales_pilihanuser = "null";
    $email_user = $_POST["email_user"];
    $password_user = $_POST["password_user"];
    $role_user = 1; 
    $status_akun = 0;
    $id_user = substr($nama_user,0,3);
    $conn = getConn();

    $sql1 = "select * from users";
    $result1 = $conn->query($sql1);
    $ctr = 0;
    while ($row1 = $result1->fetch_assoc()) {
        if ($email_user == $row1["email_users"]) {
            $ctr = 0;
        }
        else{
            $ctr++;
        }
    }
    if ($ctr > 0) {
        $id_user.=str_pad(($ctr+1),3,"0",STR_PAD_LEFT);
        
        $sql2 = "insert into users (id_user,nama_perusahaan,nama_user,nomor_ktp,foto_ktp,telp_user,lahir_user,jeniskelamin_user,alamat_user,pilih_sales,email_users,password_user,role_user,status_akun) values ('$id_user','$nama_perusahaan','$nama_user','$nomor_ktp','$foto_ktp','$telp_user','$lahir_user',$jeniskelamin_user,'$alamat_user','$sales_pilihanuser','$email_user','$password_user',$role_user,$status_akun)";

        if ($conn->query($sql2)) {
            echo "berhasil register";
        }else{
            echo "gagal register";
        }
    }
    if ($ctr == 0) {
        echo "email telah digunakan!";
    }
    $conn->close();
}





// load barang/produk di produk.php


?>