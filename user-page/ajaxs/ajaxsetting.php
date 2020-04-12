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
    $sql = "update customer set nama_pemilik='$nama_user where email = '".$_SESSION['email_user']."'";
        if ($conn->query($sql)) {   
            echo "berhasil";
        }
    $conn->close();
    }

    if ($_POST['jenis'] == "gantipass") {
        $id=$_SESSION["idcust"];
        $pass = $_POST['password'];
        $conn = getConn();

        $sql = "update customer set password='$pass' where id_cust ='$id' ";
            if ($conn->query($sql)) {   
                echo "berhasil";
            }else{
                echo "gagal";
            }
        $conn->close();
    }
    
    if($_POST["jenis"]=="loadalamat"){
        $kal="";
        $conn=getConn();
        $email=$_SESSION["email_user"];
        $sql1="select * from alamat_pengiriman where email='$email' not no_prioritas='0'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                $ida=$row1["id_alamat"];
                $alamat=$row1["alamat_lengkap"];
                $kota=$row1["kota"];
                $provinsi=$row1["provinsi"];
                $kal.="<option value='$ida'>$alamat,$kota,$provinsi</option>";
            }
        }else{
            $kal="<option value='-1'>Anda tidak memiliki alamat</option>";
        }
        echo $kal;
        $conn->close();
        
    }

    if ($_POST["jenis"]=="hapusalamat") {
        $conn = getConn();
        $id=$_POST["ida"];
        $sql = "update alamat_pengiriman set no_prioritas='0' where id_alamat ='$id' ";
            if ($conn->query($sql)) {   
                echo "berhasil";
            }else{
                echo "gagal";
            }
        $conn->close();
    }
      
    


?>