<?php
    include "conn.php";
    session_start();
    $conn=getConn();

    if($_POST["jenis"]=="load_data"){
        $kal="";
        $sql = "SELECT * FROM produk ORDER BY id asc";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                    $id= $row["id"];
                    $nama = $row["nama"];
                    $harga = $row["harga"];
                    $image = $row["gambar1"];
                    $stok = $row["stok"];
                    $kal.="
                    <tr>
                    <td>$id</td>
                    <td>$nama</td>
                    <td class='text-right'>Rp.$harga</td>
                    <td>$image</td>
                    <td class='text-right'>$stok</td>
                    <td><button type='Button' class='btn btn-warning' onclick=\"edit('$id')\">Edit</button></td>
                    </tr>";
            }
        } else {
            echo "Data Barang Tidak Ada";
        }
        $conn->close();
        echo $kal;
    }
    if($_POST["jenis"]=="load_index"){
        $id=$_POST["id"];
        $sql = "SELECT * FROM produk WHERE id = '$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                    $id= $row["id"];
                    $nama = $row["nama"];
                    $harga = $row["harga"];
                    $stok = $row["stok"];
                    $ret=array("index"=>$id,"nama"=>$nama,"harga"=>$harga,"stok"=>$stok);
                    echo Json_encode($ret);
            }
        } else {
            echo "Data Barang Tidak Ada";
        }
        $conn->close();
    }
    if($_POST['jenis'] == "load_update")
    {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $sql = "UPDATE produk set nama='$nama',harga='$harga',stok='$stok' WHERE id='$id'";
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