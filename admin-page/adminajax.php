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
            // echo "berhasil tambah sales"; 
            echo "<script> <div class='modal' tabindex='-1' role='dialog'>
            <div class='modal-dialog' role='document'>
              <div class='modal-content'>
                <div class='modal-body'>
                  <p>Berhasil tambah sales baru '.$email</p>
                </div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-primary'>Save changes</button>
                  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                </div>
              </div>
            </div>
          </div> </script>";
          //  echo "<script> alert('Berhasil tambah sales baru '.$email)</script>";
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

//ajax untuk tambah barang
if ($_POST["jenis"]=="insertbarang") {
    $conn=getConn();
    $id="ss04";
    $nama=$_POST["nmbarang"];
    $idkat=$_POST["cbjenis"];
    $harga=$_POST["hargabeli"];
    $idsatuan=$_POST["satuan"];
    $foto="testfoto";
    $desk="";
    $status="1";
    $rating="0";


    $sql="INSERT INTO `barang`(`id_barang`, `nama_barang`, `jenis_barang`, `harga`, `id_satuan`, `foto_barang`, `deskripsi_barang`, `status_barang`, `rating`) VALUES ('$id','$nama','$idkat','$harga','$idsatuan','$foto','$desk','$status','$rating')";
    if ($conn->query($sql)) {
        echo "berhasil";
    }else{
        echo "gagal";
    }

    $conn->close();
}

?>