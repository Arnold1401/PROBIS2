<?php
include_once 'adminconn.php';
$conn = getConn();
// admin - master - sales
if ($_POST["jenis"] == "tambah_sales") {
    
    $nama_sales=$_POST["nama_sales"];
    $email=$_POST["email"];
    $no_ktp=$_POST["no_ktp"];
    $nomor_telepon=$_POST["nomor_telepon"];
    $password=$nomor_telepon;
    $provinsi=$_POST["provinsi"];
    $kota=$_POST["kota"];
    $kecamatan=$_POST["kecamatan"];
    $alamat=$_POST["alamat"];
    $status=1;
    $conn = getConn();

    $provinsi=getprovincename($provinsi);
    $kota=getcityname($kota);
    $kecamatan=getsubdistrictname($kecamatan,$_POST["kota"]);
    

    $sql1 = "select * from sales";
    $result1 = $conn->query($sql1);
    $ctr=0;
    while ($row1 = $result1->fetch_assoc()) {
        if ($email == $row1["email"] || $no_ktp == $row1["no_ktp"]) {
            $ctr = -1;
        }
    }

    if ($ctr == 0) {
       // $ctr=$ctr+1;
        $sql2 = "insert into sales(id_sales, nama_sales, email, no_ktp, nomor_telepon, password, provinsi, kota, kecamatan, alamat, status) values (null,'$nama_sales','$email',$no_ktp,$nomor_telepon,'$password','$provinsi','$kota','$kecamatan','$alamat','$status')";

        if ($conn->query($sql2)) {
            echo "Berhasil tambah sales baru $email";
        }
        else {
            echo "gagal tambah sales ";
        }

    }
    
    if ($ctr == -1) {
        echo "Maaf akun dengan email ".$email." telah terdaftar";
    }
    $conn->close();
}

if ($_POST["jenis"]=="getprovincename") {
    echo getprovincename($_POST["idprovince"]);
   }

   function getprovincename($idprovince){
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=$idprovince",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
       "key: 8ccbf31cdb56de646092992e32819d09"
    ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        return "error";
    } else 
    {  
        $arr=json_decode($response);
        $resultnya=$arr->rajaongkir->results->province;
        return $resultnya;
    }
  }

  if ($_POST["jenis"]=="getcityname") {
    echo getcityname($_POST["idcity"]);
 }

 function getcityname($idcity){
   $curl = curl_init();
   curl_setopt_array($curl, array(
     CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=$idcity",
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "GET",
     CURLOPT_HTTPHEADER => array(
       "key:8ccbf31cdb56de646092992e32819d09"
     ),
   ));
   $response = curl_exec($curl);
   $err = curl_error($curl);
   curl_close($curl);
   if ($err) {
     echo "cURL Error #:" . $err;
   } else {
       $arr=json_decode($response);
       $kota=$arr->rajaongkir->results->city_name;
       $provinsi=$arr->rajaongkir->results->province;
       return $kota;
   }
 }

 if ($_POST["jenis"]=="getsubdistrictname") {
    echo getsubdistrictname($_POST["idsub"],$_POST["idcity"]);
 }
 
 function getsubdistrictname($idsub,$idcity){
   $curl = curl_init();
   curl_setopt_array($curl, array(
     CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=$idcity&id=$idsub",
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "GET",
     CURLOPT_HTTPHEADER => array(
       "key:8ccbf31cdb56de646092992e32819d09"
     ),
   ));
   $response = curl_exec($curl);
   $err = curl_error($curl);
   curl_close($curl);
   if ($err) {
     echo "cURL Error #:" . $err;
   } else {
       $arr=json_decode($response);
       $subdistrict=$arr->rajaongkir->results->subdistrict_name;
       return $subdistrict;
   }
 }

if ($_POST["jenis"] == "data_valid") {
    $conn = getConn();
    $id_cust = $_POST['id_cust'];
    $status_id = 1;
    $sql = "update customer set status=$status_id where id_cust=$id_cust";
    if ($conn->query($sql)) {
        echo "berhasil";
    }else{
        echo "gagal validasi";
    }
    //echo $id_cust;
    $conn->close();
}

if ($_POST["jenis"] == "data_tdkvalid") {
    $conn = getConn();
    $id_cust = $_POST['id_cust'];
    $status_id = 2;
    $sql = "update customer set status=$status_id where id_cust=$id_cust";
    if ($conn->query($sql)) {
        echo "berhasil";
    }else{
        echo "gagal validasi";
    }
    //echo $id_cust;
    $conn->close();
}

if ($_POST["jenis"] == "jadikan_sales_utkcustini") {
    $conn = getConn();
    $id_cust = $_POST['id_cust'];
    $id_sales = $_POST['id_sales'];
    
    $sql = "update customer set id_sales=$id_sales where id_cust=$id_cust";
    if ($conn->query($sql)) {
        echo "Berhasil";
    }else{
        echo "gagal update";
    }
    //echo $id_cust;
    $conn->close();
}

if($_POST["jenis"]=="loadbarang"){
    $kal="";
    $conn=getConn();
    
    $sql1="select * from barang";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        while ($row1 = $result1->fetch_assoc()) {
            $idbarang=$row1["id_barang"];
            $namabarang=$row1["nama_barang"];
            
            $kal.="<option value='$idbarang'>$idbarang - $namabarang</option>";
        }
    }else{
        $kal="<option value='-1'>..</option>";
    }
    echo $kal;
    $conn->close();
    
}


//ngload satuan barang
if ($_POST["jenis"]=="satuan_barang") {
    $sql = "select * from satuan";
    $result = $conn->query($sql);
    echo "<option value=''>~Pilih~</option>";
    while($data=$result->fetch_assoc()){
        echo "<option value=$data[id_satuan]>$data[nama_satuan]</option>";
    }
    
}
//end of ngload satuan barang

//tambah satuan baru
if ($_POST["jenis"]=="tambah_satuan_baru") {
    $namasatuanbaru = strtolower($_POST["namasatuan"]);
    $sql = "select * from satuan";
    $result = $conn->query($sql);
    $ctr=0;
    while ($row = $result->fetch_assoc()) {
        if (ucfirst($namasatuanbaru) == $row["nama_satuan"]) {
            $ctr = -1;
        }
    }

    if ($ctr == 0) {
        $namasatuanbaru = ucfirst($namasatuanbaru);
        $sqlinsert = "insert into satuan (id_satuan, nama_satuan) values (null,'$namasatuanbaru')";

        if ($conn->query($sqlinsert)) {
            echo "berhasil tambah baru";
        }else {
            echo "gagal";
        }

    }

    if ($ctr == -1) {
        echo "Satuan ".$namasatuanbaru ." sudah ada";
    }
    $conn->close();
}
//end of tambah satuan baru

//ajax untuk tambah barang
if ($_POST["jenis"]=="insertbarang") {
    $conn=getConn();
    $namabarang=strtoupper($_POST["namabarang"]);
    $descbarang=$_POST["descbarang"];
    $jenisbarang=$_POST["jenisbarang"];
    $satuanbarang=$_POST["satuanbarang"];
    $tanggalmasuk=$_POST["tanggalmasuk"];
    $tanggalkadaluarsa=$_POST["tanggalkadaluarsa"];
    $kuantiti=$_POST["kuantiti"];
    $hargabeli=$_POST["hargabeli"];
    $hargajual=$_POST["hargajual"];
    $beratbarang = $_POST["beratbarang"];

    $foto=$_POST["fotobarang"];
    $status="1";  //inputan pertama pasti statusnya 1 (aktif) karena udh ada pengecekan kalau tgl kadaluarsa harus lebih besar dari tgl hari ini
    //$rating="0";
    $sisa = $kuantiti;

    $sql = "insert into barang (id_barang, nama_barang, deskripsi_barang, jenis_barang, id_satuan, foto_barang) values (null,'$namabarang', '$descbarang', '$jenisbarang', '$satuanbarang','$foto')";

    if ($conn->query($sql)) {

         $sql2 = "insert into detail_barang (id_barang, tanggal_masuk, tanggal_kadaluwarsa, kuantiti, sisa, harga_beli, harga_jual, berat, status_barang, status_tampil) values (LAST_INSERT_ID(), '$tanggalmasuk', '$tanggalkadaluarsa', '$kuantiti', '$sisa', '$hargabeli', '$hargajual', $beratbarang, 1, 1)";
        
         if ($conn->query($sql2)) {
            echo "berhasil";
         }else {
             echo "gagal memasukkan detail barang";
         }
        
    }else{
        echo "gagal memasukkan barang";
    }

    $conn->close();
}
//end of untuk tambah barang

if ($_POST["jenis"]=="insertbarang_detail") {
    $conn=getConn();
    $idbarang=$_POST["idbarang"];
    $namabarang=strtoupper($_POST["namabarang"]);
    $descbarang=$_POST["descbarang"];
    $jenisbarang=$_POST["jenisbarang"];
    $satuanbarang=$_POST["satuanbarang"];
    $tanggalmasuk=$_POST["tanggalmasuk"];
    $tanggalkadaluarsa=$_POST["tanggalkadaluarsa"];
    $kuantiti=$_POST["kuantiti"];
    $hargabeli=$_POST["hargabeli"];
    $hargajual=$_POST["hargajual"];
    $beratbarang = $_POST["beratbarang"];

    $foto=$_POST["fotobarang"];
    $status="1";  //inputan pertama pasti statusnya 1 (aktif) karena udh ada pengecekan kalau tgl kadaluarsa harus lebih besar dari tgl hari ini
    //$rating="0";
    $sisa = $kuantiti;

    $sql = "insert into detail_barang (id_barang, tanggal_masuk, tanggal_kadaluwarsa, kuantiti, sisa, harga_beli, harga_jual, berat, status_barang, status_tampil) values ($idbarang, '$tanggalmasuk', '$tanggalkadaluarsa', '$kuantiti', '$sisa', '$hargabeli', '$hargajual', $beratbarang, 1, 0)";

    if ($conn->query($sql)) {

        echo "berhasil masukkan barang";
        
    }else{
        echo "gagal";
    }

    $conn->close();
}

//detail barang
if ($_POST["jenis"]=="detail_barangini") {
    $conn = getConn();
    $IdBarang=$_POST["getId"];
    $sql = "select * from barang where id_barang=$IdBarang";
   // $sql = "Select * from barang"
    $query = mysqli_query($conn,$sql); // get the data from the db
    $result = array();
    while ($row = $query->fetch_array(MYSQLI_ASSOC)) { // fetches a result row as an associative array
        $result [0] = $row['id_barang'];
        $result [1] = $row['nama_barang'];
        $result [2] = $row['deskripsi_barang'];
        $result [3] = $row['jenis_barang'];
        $result [4] = $row['id_satuan'];
        $result [5] = $row['foto_barang'];
        
        
    }
    
    $conn->close();
    header('Content-Type: application/json');
    echo json_encode($result); // return value of $result
}
//end of detail barang

//detail barang
if ($_POST["jenis"]=="detail_barang") {
    $conn = getConn();
    $IdBarang=$_POST["getId"];
    $sql = "select * from detail_barang where id_barang=$IdBarang";
   // $sql = "Select * from barang"
    $query = mysqli_query($conn,$sql); // get the data from the db
    $result = array();
    while ($row = $query->fetch_array(MYSQLI_ASSOC)) { // fetches a result row as an associative array
        $result [0] = $row['id_detail_barang'];
        $result [1] = $row['tanggal_masuk'];
        $result [2] = $row['tanggal_kadaluwarsa'];
        $result [3] = $row['kuantiti'];
        $result [4] = $row['sisa'];
        $result [5] = $row['berat'];
        $result [6] = $row['harga_beli'];
        $result [7] = $row['harga_jual'];
        
    }
    
    $conn->close();
    header('Content-Type: application/json');
    echo json_encode($result); // return value of $result
}
//end of detail barang


if ($_POST["jenis"]=="UpdateBarang") {

    $conn=getConn();
    $idbarang = $_POST["idbarang"];
    $namabarang=$_POST["namabarang"];
    $descbarang=$_POST["descbarang"];
    $jenisbarang=$_POST["jenisbarang"];
    $satuanbarang=$_POST["satuanbarang"];
    $tanggalmasuk=$_POST["tanggalmasuk"];
    $tanggalkadaluarsa=$_POST["tanggalkadaluarsa"];
    $kuantiti=$_POST["kuantiti"];
    $hargabeli=$_POST["hargabeli"];
    $hargajual=$_POST["hargajual"];
    $beratbarang=$_POST["beratbarang"];
    $iddetailbarang = $_POST["iddetailbarang"];

    $foto=$_POST["fotobarang"];
    $status="1";
    $rating="0";
    $sisa = $kuantiti;

    $sql = "update barang set nama_barang='$namabarang', deskripsi_barang='$descbarang', jenis_barang='$jenisbarang', id_satuan='$satuanbarang' where id_barang=$idbarang";

    if ($conn->query($sql)) {

       // $sql2 = "insert into detail_barang (id_barang, tanggal_masuk, tanggal_kadaluwarsa, kuantiti, sisa, harga_beli, harga_jual) values (LAST_INSERT_ID(), '$tanggalmasuk', '$tanggalkadaluarsa', '$kuantiti', '$sisa', '$hargabeli', '$hargajual')";

         $sql2 = "update detail_barang set tanggal_masuk='$tanggalmasuk', tanggal_kadaluwarsa='$tanggalkadaluarsa', kuantiti='$kuantiti', harga_beli='$hargabeli', harga_jual='$hargajual', berat='$beratbarang' where id_detail_barang=$iddetailbarang";
        
         if ($conn->query($sql2)) {
            echo "berhasil update barang";
         }else {
             echo "gagal update detail";
         }
        
    }else{
        echo "gagal";
    }

    $conn->close();

}

//auto reload jika barang expire atau aktif di dataable
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

if ($_POST["jenis"]=="CekTglAvailableSemuaBarang") {
    // tglkadaluarsa = $("#tgl_kadaluarsa").val();
    $conn=getConn();
    $kal1=""; $kal2="";
      $CurrentDate = $_POST["CurrentDate"];
      $statusexp = "";
     $sqlexp = "select id_detail_barang from detail_barang where tanggal_kadaluwarsa > '$CurrentDate'";
     $result=$conn->query($sqlexp);
         
     if($result->num_rows>0){
         while ($row=$result->fetch_assoc()){
             $kal1 =$row['id_detail_barang'];
             $sql2 = "update detail_barang set status_barang=1 where id_detail_barang=$kal1";
         if ($conn->query($sql2)) {
             echo $kal1.$CurrentDate;
         }
         else{
              "gagal";
         }
         }
         
     }
 
     $conn->close();
 }
//end of auto reload jika barang expire atau aktif di dataable



//admin-penjualan = ubah status proses ke pengiriman
if ($_POST["jenis"]=="kirimkan_barang") {
    $conn=getConn();
    $getIdhjual = $_POST['getIdhjual'];
    $status = "Pengiriman";

    $sql = "update hjual set status_order='$status', notifikasi='2' where id_hjual='$getIdhjual'";
    if ($conn->query($sql)) {
        echo "Barang berhasil dikirim";
    }
    else{
        echo "gagal";
    }
}


//notifikasi
if ($_POST["jenis"]=="ubah_statusnotif") {
    $conn=getConn();
    $getstatus = $_POST['getstatus'];
    $sql = "update hjual set notifikasi='0' where status_order='$getstatus'";
    if ($conn->query($sql)) {
        echo "berhasil";
    }
    else{
        echo "gagal";
    }
}
?>