<?php
include_once 'conn.php';
$conn = getConn();

if ($_POST["jenis"] == "show_product_catalog_semua") {
    $sql = "select * from barang";
    $result1 = $conn->query($sql);

    echo 
    $conn->close();
}

if ($_POST["jenis"] == "konfirmasi_orderan_selesai") {
    $conn = getConn();
    $id_hjual = $_POST['getId'];
    $status = "Selesai";
    $sql = "update hjual set status_order='$status' where id_hjual=$id_hjual";
    if ($conn->query($sql)) {
        echo "Orderan Telah Selesai";
    }else{
        echo "gagal validasi";
    }
    //echo $id_cust;
    $conn->close();
}

if ($_POST["jenis"] == "get_nama_barang") {
    $conn=getConn();
    $idbarang = $_POST['getIdBarang'];
    $temp="";
    $sql = "select * from barang where id_barang=$idbarang";
    $result=$conn->query($sql);
		
    if($result->num_rows>0){
        while ($row=$result->fetch_assoc()){
            $temp =$row['nama_barang'];
        }
        echo $temp;
    }else{
        echo "salah";
    }

    $conn->close();
}

if ($_POST["jenis"] == "kirim_ulasan") {
    $conn=getConn();
    $idbarang = $_POST['idbarang'];
    $idcust = $_POST['idcust'];
    $rating = $_POST['rating'];
    $isiulasan = $_POST['isiulasan'];
    $iddjualulas = $_POST['iddjualulas'];

    $temp="";
    $sql = "insert into ulasan(id_barang, id_cust, rating, isi_review) values($idbarang,$idcust,$rating,'$isiulasan')";
    if ($conn->query($sql)) {
        echo "berhasil beri ulasan";

        $sql2 = "update djual set id_ulasan=LAST_INSERT_ID() where id_djual=$iddjualulas";

        if ($conn->query($sql2)) {
            echo "berhasil";
         }else {
             echo "gagal update detail";
         }
   }else{
       echo "gagal";
   }

   $conn->close();
}

// dipage tagihan.php
if ($_POST["jenis"] == "get_detail_tagihan") {
    $conn = getConn();
    $IdHjual=$_POST["getId"];
    $sql = "select * from piutang where id_hjual='$IdHjual'";
    $query = mysqli_query($conn,$sql); // get the data from the db
    $result = array();
    while ($row = $query->fetch_array(MYSQLI_ASSOC)) { // fetches a result row as an associative array
        $result [0] = $row['id_piutang'];
        $result [1] = $row['id_hjual'];
        $result [2] = $row['tanggal_order'];
        $result [3] = $row['tanggal_jatuh_tempo'];
        $result [4] = $row['sisa_tagihan'];
    }
    
    $conn->close();
    header('Content-Type: application/json');
    echo json_encode($result); // return value of $result
}

if ($_POST["jenis"] == "get_detail_customerHutang") {
    $conn = getConn();
    $idcust=$_POST["idcust"];
    $sql = "select id_cust, email, nama_pemilik, notelp from customer where id_cust=$idcust";
    $query = mysqli_query($conn,$sql); // get the data from the db
    $result = array();
    while ($row = $query->fetch_array(MYSQLI_ASSOC)) { // fetches a result row as an associative array
        $result [0] = $row['id_cust'];
        $result [1] = $row['email'];
        $result [2] = $row['nama_pemilik'];
        $result [3] = $row['notelp'];
    }
    
    $conn->close();
    header('Content-Type: application/json');
    echo json_encode($result); // return value of $result
}

if ($_POST["jenis"] == "get_detailalamat_customerHutang") {
    $conn = getConn();
    //$emailcust=$_POST["emailcust"];
    $getIdAlamat = $_POST["getIdAlamat"];
    $sql = "select provinsi, kota, kecamatan, alamat_lengkap from alamat_pengiriman where id_alamat=$getIdAlamat";
    $query = mysqli_query($conn,$sql); // get the data from the db
    $result = array();
    while ($row = $query->fetch_array(MYSQLI_ASSOC)) { // fetches a result row as an associative array
        $result [0] = $row['provinsi'];
        $result [1] = $row['kota'];
        $result [2] = $row['kecamatan'];
        $result [3] = $row['alamat_lengkap'];
    }
    
    $conn->close();
    header('Content-Type: application/json');
    echo json_encode($result); // return value of $result
}

//getTotal tagihan - cek ongkirnya
if ($_POST["jenis"] == "getTotal") {
    $conn = getConn();
    $getId = $_POST["getId"];
    $sql = "select * from hjual where id_hjual='$getId'";
    $query = mysqli_query($conn,$sql); // get the data from the db
    $result = array();
    while ($row = $query->fetch_array(MYSQLI_ASSOC)) { // fetches a result row as an associative array
        $result [0] = $row['id_hjual'];
        $result [1] = $row['grandtotal'];
    }
    
    $conn->close();
    header('Content-Type: application/json');
    echo json_encode($result); // return value of $result
}

//cek sisa waktu pelunasan untuk sales
if ($_POST["jenis"] == "cek_sisa_waktupelunasan") {
    $conn = getConn();
    $CurrentDate = $_POST["CurrentDate"];
    $res = 0;
   
    $kalid="";
    $kaltgl="";
    $sql1 = "select id_piutang, tanggal_jatuh_tempo from piutang";
    $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) 
        {
            while ($row1 = $result1->fetch_assoc()) 
            {
                $id=$row1["id_piutang"];
                $tgl=$row1["tanggal_jatuh_tempo"];
                $kalid =$id;
                $kaltgl=$tgl;
                $date1=new DateTime($CurrentDate);
                $date2=new DateTime($kaltgl);
                $diff=date_diff($date1,$date2);

               // echo $diff->format("%R%a days");
                $res = $diff->format("%r%a");

                 $sql2 = "update piutang set sisa_waktu_pelunasan='$res' where id_piutang='$id'";
                 if ($conn->query($sql2)) 
                 {
                     echo "berhasil";
                 }
        
                 else{
                      echo $res;
                 }
            }
        }
        else{
            $kal="no id";
        }
        //echo $kalid;
    $conn->close();
}
?>