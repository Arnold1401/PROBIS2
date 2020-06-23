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
    $status=0;
    $conn = getConn();
    $sql = "update customer set nama_perusahaan = '$nama_perusahaan', nama_pemilik = '$nama_user', nomor_ktp = '$nomor_ktp', notelp = '$telp_user', tanggal_lahir = '$lahir_user', jenis_kelamin = '$jeniskelamin_user', status=$status where email = '".$_SESSION['email_user']."'";
    //$sql = "update customer set nama_pemilik='$nama_user' where email = '".$_SESSION['email_user']."'";
    //echo $nama_user;
        if ($conn->query($sql)) {   
            echo "Berhasil Ubah Data";
            $_SESSION["nama_user"] = $nama_user;
            $_SESSION["nomor_ktp"] = $nomor_ktp;
            $_SESSION["telp_user"] = $telp_user;
            $_SESSION["lahir_user"] = $lahir_user;
            $_SESSION["jeniskelamin_user"] = $jeniskelamin_user;
            $_SESSION["nama_perusahaan"] = $nama_perusahaan;
            $_SESSION["status_akun"] = $status;
        }
    $conn->close();
    }

    if ($_POST['jenis'] == "updateNama_Nomor_Perusahaan") {
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
        //$sql = "update customer set nama_pemilik='$nama_user' where email = '".$_SESSION['email_user']."'";
        //echo $nama_user;
            if ($conn->query($sql)) {   
                echo "Berhasil Ubah Data";
                $_SESSION["nama_user"] = $nama_user;
                $_SESSION["nomor_ktp"] = $nomor_ktp;
                $_SESSION["telp_user"] = $telp_user;
                $_SESSION["lahir_user"] = $lahir_user;
                $_SESSION["jeniskelamin_user"] = $jeniskelamin_user;
                $_SESSION["nama_perusahaan"] = $nama_perusahaan;
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

    if ($_POST['jenis'] == "gantipass_sales") {
        $id=$_SESSION["id_sales"];
        $pass = $_POST['password'];
        $conn = getConn();

        $sql = "update sales set password='$pass' where id_sales ='$id' ";
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
        $sql1="select * from alamat_pengiriman where email='$email' and no_prioritas != '0'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                $ida=$row1["id_alamat"];
                $alamat=$row1["alamat_lengkap"];
                $kota=$row1["kota"];
                $provinsi=$row1["provinsi"];
                $kecamatan = $row1["kecamatan"];

                $provinsi = explode('-', $provinsi);
                $kota = explode('-', $kota);
                $kecamatan = explode('-', $kecamatan);
                
               
                $kal.="<option value='$ida'>$provinsi[1], $kota[1], $kecamatan[1], $alamat</option>";
                $kal.="<option value='-1'>+ Tambah alamat</option>";
            }
        }else{
            $kal.="<option value='-1'>Anda tidak memiliki alamat</option>";
        }
        echo $kal;
        $conn->close();
        
    }

    if($_POST["jenis"]=="selectalamat"){
        $kal="";
        $conn=getConn();
        $id_alamat = $_POST["id_alamat"];
        $sql1="select * from alamat_pengiriman where id_alamat='$id_alamat' and no_prioritas != '0'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {

        }else{
            $kal="<option value='-1'>Anda tidak memiliki alamat</option>";
        }
        echo implode("!",$result1->fetch_assoc());
        $conn->close();
    }

    if ($_POST["jenis"]=="hapusalamat") {
        $conn = getConn();
        $id=$_POST["ida"];
        $sql = "delete from alamat_pengiriman where id_alamat='$id'";
       // $sql = "update alamat_pengiriman set no_prioritas='0' where id_alamat ='$id' ";
            if ($conn->query($sql)) {   
                echo "berhasil";
            }else{
                echo "gagal";
            }
        $conn->close();
    }

    if ($_POST["jenis"]=="simpanalamat") {
        $conn = getConn();
        $email_user = $_SESSION["email_user"];
        $alamat_user = $_POST["alamat_user"];
        $prov = $_POST["prov"];
        $kota = $_POST["kota"];
        $camat = $_POST["camat"];
        $kodepos = $_POST["kode"];
        $largestNumber = 0;
        $rowSQL = "SELECT MAX(no_prioritas) AS max FROM alamat_pengiriman where email ='$email_user' and no_prioritas != 0";
        $result = $conn->query($rowSQL);
        $row = $result->fetch_assoc();
        if($row > 0){
        $largestNumber = $row['max'];
        }
        //kasih pengecekan dulu dia mau ubah alamat atau mau nambah alamat
        //kalau ubah alamat dilihat juga no prioritasnya -- update biasa
        //kalau nambah alamat, no prioritas terus bertambah 1, 2,3,4
        $largestNumber = $largestNumber+1;
        $sql3 = "insert into alamat_pengiriman (email,provinsi,kota,kecamatan,alamat_lengkap,no_prioritas,kode_pos) values ('$email_user','$prov','$kota','$camat','$alamat_user',$largestNumber,'$kodepos')";
        if($conn->query($sql3)){
            echo "Anda berhasil menambah alamat pengiriman baru";
        }else{
            echo "gagal";
        }
      
    }

    if ($_POST["jenis"]=="ubahalamat") {
        $idalamat = $_POST["idalamat"];
        $conn = getConn();
        $sql = "select * from alamat_pengiriman where id_alamat=$idalamat";
        $query = mysqli_query($conn,$sql); // get the data from the db
        $result = array();
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) { // fetches a result row as an associative array
            $result [0] = $row['id_alamat'];
            $result [1] = $row['provinsi'];
            $result [2] = $row['kota'];
            $result [3] = $row['kecamatan'];
            $result [4] = $row['alamat_lengkap'];
            $result [5] = $row['kode_pos'];
        }
        
        $conn->close();
        header('Content-Type: application/json');
        echo json_encode($result); // return value of $result
    }

    

?>