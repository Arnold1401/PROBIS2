<?php
    include "conn.php";
    session_start();
    $conn=getConn();

    if($_POST["jenis"]=="load_merek"){
        $kal="";
        $sql = "SELECT * FROM merek ORDER BY id_merek asc";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                    $id= $row["id_merek"];
                    $nama = $row["nama_merek"];
                    $kal.="
                    <tr>
                    <td>$id</td>
                    <td>$nama</td>
                    <td><button type='Button' class='btn btn-warning' onclick=\"edit('$id')\">Edit</button></td>
                    </tr>";
            }
        } else {
            echo "Data Merek Tidak Ada";
        }
        $conn->close();
        echo $kal;
    }
    if($_POST["jenis"]=="load_index"){
        $id=$_POST["id"];
        $sql = "SELECT * FROM merek WHERE id_merek = '$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                    $id = $row["id_merek"];
                    $nama = $row["nama_merek"];;
                    $ret=array("index"=>$id,"nama"=>$nama);
                    echo Json_encode($ret);
            }
        } else {
            echo "Data Merek Tidak Ada";
        }
        $conn->close();
    }
    if($_POST['jenis'] == "load_update")
    {
        $id = $_POST["id"];
        $nama = $_POST["nama"];
        $sql = "UPDATE merek set nama_merek='$nama' WHERE id_merek='$id'";
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
?>