<?php
    include "conn.php";
    session_start();
    $conn=getConn();

    if($_POST["jenis"]=="load_data"){
        $kal="";
        $sql = "SELECT * FROM user ORDER BY ID_USER asc";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                    $id = $row["ID_USER"];
                    $nama = $row["NAMA_USER"];
                    $email = $row["EMAIL_USER"];
                    $status = $row["STATUS"];
                    $telp = $row["TELP_USER"];
                    $kal.="
                    <tr>
                    <td>$id</td>
                    <td>$nama</td>
                    <td>$email</td>
                    <td>$telp</td>
                    <td>$status</td>
                    <td><button type='Button' class='btn btn-success' onclick=\"edit('$id')\">Edit</button> <button type='Button' class='btn btn-primary' onclick=\"status('$id')\">Status</button></td>
                    </tr>";
            }
        } else {
            echo "Tidak Ada Data User";
        }
        $conn->close();
        echo $kal;
    }
    if($_POST["jenis"]=="load_index"){
        $id=$_POST["id"];
        $sql = "SELECT * FROM user WHERE ID_USER = '$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                    $id = $row["ID_USER"];
                    $nama = $row["NAMA_USER"];
                    $email = $row["EMAIL_USER"];
                    $telp = $row["TELP_USER"];
                    $ret=array("index"=>$id,"nama"=>$nama,"email"=>$email,"telp"=>$telp);
                    echo Json_encode($ret);
            }
        } else {
            echo "Data User Tidak Ada";
        }
        $conn->close();
    }
    if($_POST['jenis'] == "load_update")
    {
        $id = $_POST["id"];
        $nama = $_POST["nama"];
        $email = $_POST["email"];
        $telp = $_POST["telp"];
        $sql = "UPDATE user set NAMA_USER='$nama',EMAIL_USER='$email',TELP_USER='$telp' WHERE ID_USER='$id'";
        $result = $conn->query($sql);
        if($result == true)
        {
            echo "Berhasil Di Ubah" ;
        }
        else
        {
            echo "Gagal Update Data";
        }
    }

    if($_POST['jenis'] == "load_status")
    {
        $id = $_POST["id"];
        $sql1 = "SELECT * FROM user where ID_USER='$id'";
        $result1 = $conn->query($sql1);
        $status="";
        while($row = $result1->fetch_assoc()) {
            $status = $row["STATUS"];
        }
        if($status == "aktif")
        {
            $sql = "UPDATE user set STATUS='nonaktif' WHERE ID_USER='$id'";
            $result = $conn->query($sql);
            if($result == true)
            {
                echo "Berhasil Di Ubah" ;
            }
            else
            {
                echo "Gagal Update Data";
            }
        }
        else if ($status == "nonaktif") {
            $sql = "UPDATE user set STATUS='aktif' WHERE ID_USER='$id'";
            $result = $conn->query($sql);
            if($result == true)
            {
                echo "Berhasil Di Ubah" ;
            }
            else
            {
                 echo "Gagal Update Data";
            }
        }
    }
?>