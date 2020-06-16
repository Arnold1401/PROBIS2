<?php
session_start();
include_once '../conn.php';
include_once '../classes/item.php';
//auto reload jika barang expire atau aktif di dataable -- stok cek juga
if ($_POST["jenis"]=="CekTglExpireSemuaBarang") {
    // tglkadaluarsa = $("#tgl_kadaluarsa").val();
    $conn=getConn();
    $kal1=""; $kal2=""; $idbrg=""; $iddetailbrg="";
      $CurrentDate = $_POST["CurrentDate"];
      $statusexp = "";
     $sqlexp = "select id_detail_barang, id_barang from detail_barang where tanggal_kadaluwarsa < '$CurrentDate' or sisa=0";
     $result=$conn->query($sqlexp);
         
     if($result->num_rows>0){
         while ($row=$result->fetch_assoc()){
             $kal1 =$row['id_detail_barang'];
             $idbrg = $row['id_barang'];
             $sql2 = "update detail_barang set status_barang=2, status_tampil=0 where id_detail_barang=$kal1";
             if ($conn->query($sql2)) {
                 
 
                 $sqlminid = "Select min(id_detail_barang) as id_detail_barang from detail_barang where  id_barang=$idbrg and status_barang=1";
                 $result2 = $conn->query($sqlminid);
 
                 if ($result2->num_rows>0) {
                     while ($row2=$result2->fetch_assoc()) {
                         $iddetailbrg=$row2["id_detail_barang"];
 
                     }
                     echo $iddetailbrg;
                     $sql3 = "update detail_barang set status_tampil=1 where id_detail_barang=$iddetailbrg and  id_barang=$idbrg and status_barang=1";
                     if ($conn->query($sql3)) {
                         echo "berhasil";
                     }
                 }
                 
 
             }
         else{
              "gagal";
         }
         }
         
     }
     
     $conn->close();
 }

?>