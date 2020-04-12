<?php
    session_start();    
    include_once "../conn.php";
    if ($_POST['jenis'] == "update") {
    // (0 - admin) (1 - reseller)(2 - sales) -- role
    // (0 - menunggu ) (1 - valid ) (2 - tidak valid) -- status akun
    $nama_user = $_POST['nama_user'];
    $nama_perusahaan = $_POST['nama_perusahaan'];
    $nomor_ktp = $_POST['nomor_ktp'];
    $telp_user = $_POST['telp_user'];
    $lahir_user = $_POST['lahir_user'];
    $jeniskelamin_user = $_POST['jeniskelamin_user'];
    $conn = getConn();
    $sql = "update customer set nama_perusahaan = '$nama_perusahaan', nama_pemilik = '$nama_user', nomor_ktp = '$nomor_ktp', notelp = '$telp_user', tanggal_lahir = '$lahir_user', jenis_kelamin = '$jeniskelamin_user' where email = '".$_SESSION['email_user']."'";
        if ($conn->query($sql)) {   
            echo "update berhasil";
        }
    }
      
    


?>