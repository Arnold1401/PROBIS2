<?php
    session_start();    
    include_once "../conn.php";
    if ($_POST['jenis'] == "update") {
    // (0 - admin) (1 - reseller)(2 - sales) -- role
    // (0 - menunggu ) (1 - valid ) (2 - tidak valid) -- status akun
    $nama_user = $_POST['nama_user'];
    $conn = getConn();
    $sql = "update customer set nama_pemilik = '$nama_user' where email = '".$_SESSION['email_user']."'";
        if ($conn->query($sql)) {   
            echo "update berhasil";
        }
    }
      
    


?>