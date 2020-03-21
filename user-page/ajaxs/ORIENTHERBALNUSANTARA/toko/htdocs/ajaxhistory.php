<?php
   require 'conn.php';
   require 'classes/item.php';//idcart,idbarang,jumlah,iduser
   session_start();
   $conn=getConn();
   
   function getiduser(){
      $conn=getConn();
      $iduser="";
      $token="";
      if (isset($_SESSION["token"])) {
         $token=$_SESSION["token"];
     }
     if ($token=="") {
         $kal.= "token kosong";
     }else{
         $sql = "SELECT * FROM token where id_token='$token'";
         $result = $conn->query($sql);
         if ($result->num_rows > 0) {
             //cari user
             while($row = $result->fetch_assoc()) {
                 $iduser=$row["id_user"];
             }
         }
      }
      $conn->close();
      return $iduser;
   }

   if ($_POST["jenis"]=="getnama") {
    $kal="";
    $token="";
    if (isset($_SESSION["token"])) {
        $token=$_SESSION["token"];
    }
    if ($token=="") {
        $kal.= "token kosong";
    }else{
        $sql = "SELECT * FROM token where id_token='$token'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            //cari user
            while($row = $result->fetch_assoc()) {
                $iduser=$row["id_user"];
                $sql1 = "SELECT * FROM user where ID_USER='$iduser'";
                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0) {
                    while($row1 = $result1->fetch_assoc()) {
                        $nama=$row1["NAMA_USER"];
                        $kal.="Selamat Datang,".ucfirst($nama);
                    }
                }
            }
        }
    }
    echo $kal;
}



   if ($_POST["jenis"]=="filterhistory") {
      $dari = $_POST["p1"];
      $sampai = $_POST["p2"];
      echo $dari;
      $iduser=getiduser();
    $kal = "";
   $iduser=getiduser();
    $sql0 = "SELECT * FROM hjual H WHERE ID_USER ='$iduser' AND
    H.STATUS = 'Selesai' AND H.TGL_HJUAL >= '$dari' AND H.TGL_HJUAL <= '$sampai'";
    $result0 = $conn->query($sql0);
    if ($result0->num_rows > 0) {
        while ($row0 = $result0->fetch_assoc()) {

            $idhjual = $row0["ID_HJUAL"];
            $idpayment = $row0["ID_PAYMENT"];
            $status = $row0["STATUS"];
            $tgl = $row0["TGL_HJUAL"];
            $newformat = new DateTime($tgl);
            $hari=$newformat->format('d F Y');
            $kal.="<div class='card text-black bg-light mb-3 col-12' style='max-width: 100rem;'>
            <div class='card-header bg-light text-dark'>
               <div class= 'row'>
                  <div class='col-6 align-middle pt-auto'>
                     <h5 class='card-title'>$hari</h5>
                     <p class='text-dark col-md-12'>
                        H$idhjual/T$idpayment
                     </p>
                  </div>
                  <div class='col-6 text-right'>
                     <p class ='btn btn-outline-primary text-right'>$status</p>
                  </div>
               </div>
            </div>
            <div class='card-body text-dark'>
               <!-- <p class='card-text'>Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
               <Table class='table'>
                  <thead>
                     <tr>
                        <th scope='col'></th>
                        <th scope='col'>Barang</th>
                        <th class='text-right' scope='col'>Jumlah</th>
                        <th class='text-right' scope='col'>Subtotal</th>
                     </tr>
                  </thead>
                  <tbody> ";
            $sql = "SELECT DISTINCT H.STATUS AS STATUS, H.TGL_HJUAL AS TGL_HJUAL, H.ID_HJUAL AS ID_HJUAL, H.ID_PAYMENT AS ID_PAYMENT, H.STATUS_PAYMENT AS STATUS_PAYMENT, P.gambar1 AS GAMBAR, P.nama AS NAMA, D.QTY AS QTY, D.SUBTOTAL AS SUBTOTAL, P.id AS ID_BARANG,P.harga AS HARGA, p.HARGA*D.QTY AS TOTAL
            FROM produk P, hjual H, djual D, user U
            WHERE P.id = D.ID_BARANG AND
            H.ID_HJUAL = D.ID_HJUAL AND
            U.ID_USER = H.ID_USER AND
            U.ID_USER ='$iduser' AND
            H.ID_HJUAL = $idhjual";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $idbarang = $row["ID_BARANG"];
                    //$iduser = $row["ID_USER"];
                  //  $total = $row["TOTAL"];
                    $statuspayment = $row["STATUS_PAYMENT"];
                    $status =$row["STATUS"];
                    $idpayment = $row["ID_PAYMENT"];
                    $idhjual = $row["ID_HJUAL"];
                    $tgl = $row["TGL_HJUAL"];
                    $img = $row["GAMBAR"];
                    $nama = $row["NAMA"];
                    $qty = $row["QTY"];
                    $subtot = $row["SUBTOTAL"];
                    $kal.="<tr>
                     <th scope = 'row'> <img src='img/b1.jpg' style='width:80px;height:60px;' alt='' /></th>
                     <td>$nama</td>
                     <td class='text-right'>X$qty</td>
                     <td class='text-right'>Rp.$subtot</td>
                  </tr>";
                 }
             }


             $sql2 = "SELECT SUM(D.SUBTOTAL) AS TOTAL FROM djual D, hjual H WHERE H.ID_HJUAL = D.ID_HJUAL AND
             H.ID_HJUAL = '$idhjual'";
             $result2 = $conn->query($sql2);
             
             if ($result2->num_rows > 0) {
                 while ($row2 = $result2->fetch_assoc()) {
                     $total = $row2["TOTAL"];


                 }
              }


             $kal.="
                  </tbody>
               </Table>
               <p class='card-text col-md-12 text-dark text-right'>Total : Rp$total</p>
            </div>
         </div>";
     }
    }else{
      $kal= "<h5>Tidak Ada Transaksi</h5>";
   }
   echo $kal;
   }





   if($_POST["jenis"]=="gethistorypending"){
  
  
      $kal = "";
     $iduser=getiduser();
      $sql0 = "SELECT * FROM hjual H WHERE ID_USER ='$iduser' AND
      H.STATUS_PAYMENT = 'Pending'";
      $result0 = $conn->query($sql0);
      if ($result0->num_rows > 0) {
          while ($row0 = $result0->fetch_assoc()) {

              $idhjual = $row0["ID_HJUAL"];
              $status = $row0["STATUS"];
              $tgl = $row0["TGL_HJUAL"];
              $newformat = new DateTime($tgl);
              $hari=$newformat->format('d F Y');
              $kal.="<div class='card text-black bg-light mb-3 col-12' style='max-width: 100rem;'>
              <div class='card-header bg-light text-dark'>
                 <div class= 'row'>
                    <div class='col-6 align-middle pt-auto'>
                       <h5 class='card-title'>$hari</h5>
                       <p class='text-dark col-md-12'>
                          $idhjual
                       </p>
                    </div>
                    <div class='col-6 text-right'>
                       <p class ='btn btn-outline-primary text-right'>$status</p>
                    </div>
                 </div>
              </div>
              <div class='card-body text-dark'>
                 <!-- <p class='card-text'>Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                 <Table class='table'>
                    <thead>
                       <tr>
                          <th scope='col'></th>
                          <th scope='col'>Barang</th>
                          <th class='text-right' scope='col'>Jumlah</th>
                          <th class='text-right' scope='col'>Subtotal</th>
                       </tr>
                    </thead>
                    <tbody> ";
              $sql = "SELECT DISTINCT H.STATUS AS STATUS, H.TGL_HJUAL AS TGL_HJUAL, H.ID_HJUAL AS ID_HJUAL, H.STATUS_PAYMENT AS STATUS_PAYMENT, P.gambar1 AS GAMBAR, P.nama AS NAMA, D.QTY AS QTY, D.SUBTOTAL AS SUBTOTAL, P.id AS ID_BARANG,P.harga AS HARGA,D.QTY AS TOTAL FROM produk P, hjual H, djual D, user U WHERE P.id = D.ID_BARANG AND H.ID_HJUAL = D.ID_HJUAL AND U.ID_USER = H.ID_USER AND
              U.ID_USER ='$iduser' AND
              H.ID_HJUAL = '$idhjual'";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      $idbarang = $row["ID_BARANG"];
                      //$iduser = $row["ID_USER"];
                    //  $total = $row["TOTAL"];
                      $statuspayment = $row["STATUS_PAYMENT"];
                      $status =$row["STATUS"];
                      $idhjual = $row["ID_HJUAL"];
                      $tgl = $row["TGL_HJUAL"];
                      $img = $row["GAMBAR"];
                      $nama = $row["NAMA"];
                      $qty = $row["QTY"];
                      $subtot = $row["SUBTOTAL"];
                      $kal.="<tr>
                       <th scope = 'row'> <img src='$img' style='width:80px;height:60px;' alt='' /></th>
                       <td>$nama</td>
                       <td class='text-right'>X$qty</td>
                       <td class='text-right'>Rp.$subtot</td>
                    </tr>";
                   }
               }



               $total="0";
               $sql2 = "SELECT SUM(D.SUBTOTAL) AS TOTAL FROM djual D, hjual H WHERE H.ID_HJUAL = D.ID_HJUAL AND
               H.ID_HJUAL = '$idhjual'";
               $result2 = $conn->query($sql2);
               if ($result2->num_rows > 0) {
                   while ($row2 = $result2->fetch_assoc()) {
                       $total = $row2["TOTAL"];


                   }
                }


               $kal.="
                    </tbody>
                 </Table>
                 <p class='card-text col-md-12 text-dark text-right'>Total : Rp$total</p>
              </div>
           </div>";
       }
       
      }else{
         $kal= "<h5>Tidak Ada Transaksi</h5>";
      }
      echo $kal;
  }



  if($_POST["jenis"]=="gethistorygagal"){


   $kal = "";
  $iduser=getiduser();
   $sql0 = "SELECT * FROM hjual H WHERE ID_USER ='$iduser' AND
   H.STATUS = 'Gagal' AND H.STATUS_PAYMENT = 'Gagal'";
   $result0 = $conn->query($sql0);
   if ($result0->num_rows > 0) {
       while ($row0 = $result0->fetch_assoc()) {

           $idhjual = $row0["ID_HJUAL"];
           $idpayment = $row0["ID_PAYMENT"];
           $status = $row0["STATUS"];
           $tgl = $row0["TGL_HJUAL"];
           $newformat = new DateTime($tgl);
           $hari=$newformat->format('d F Y');
           $kal.="<div class='card text-black bg-light mb-3 col-12' style='max-width: 100rem;'>
           <div class='card-header bg-light text-dark'>
              <div class= 'row'>
                 <div class='col-6 align-middle pt-auto'>
                    <h5 class='card-title'>$hari</h5>
                    <p class='text-dark col-md-12'>
                       H$idhjual/T$idpayment
                    </p>
                 </div>
                 <div class='col-6 text-right'>
                    <p class ='btn btn-outline-primary text-right'>$status</p>
                 </div>
              </div>
           </div>
           <div class='card-body text-dark'>
              <!-- <p class='card-text'>Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
              <Table class='table'>
                 <thead>
                    <tr>
                       <th scope='col'></th>
                       <th scope='col'>Barang</th>
                       <th class='text-right' scope='col'>Jumlah</th>
                       <th class='text-right' scope='col'>Subtotal</th>
                    </tr>
                 </thead>
                 <tbody> ";
           $sql = "SELECT DISTINCT H.STATUS AS STATUS, H.TGL_HJUAL AS TGL_HJUAL, H.ID_HJUAL AS ID_HJUAL, H.ID_PAYMENT AS ID_PAYMENT, H.STATUS_PAYMENT AS STATUS_PAYMENT, P.gambar1 AS GAMBAR, P.nama AS NAMA, D.QTY AS QTY, D.SUBTOTAL AS SUBTOTAL, P.id AS ID_BARANG,P.harga AS HARGA, p.HARGA*D.QTY AS TOTAL
           FROM produk P, hjual H, djual D, user U
           WHERE P.id = D.ID_BARANG AND
           H.ID_HJUAL = D.ID_HJUAL AND
           U.ID_USER = H.ID_USER AND
           U.ID_USER ='$iduser' AND
           H.ID_HJUAL = $idhjual";
           $result = $conn->query($sql);
           if ($result->num_rows > 0) {
               while ($row = $result->fetch_assoc()) {
                   $idbarang = $row["ID_BARANG"];
                   //$iduser = $row["ID_USER"];
                 //  $total = $row["TOTAL"];
                   $statuspayment = $row["STATUS_PAYMENT"];
                   $status =$row["STATUS"];
                   $idpayment = $row["ID_PAYMENT"];
                   $idhjual = $row["ID_HJUAL"];
                   $tgl = $row["TGL_HJUAL"];
                   $img = $row["GAMBAR"];
                   $nama = $row["NAMA"];
                   $qty = $row["QTY"];
                   $subtot = $row["SUBTOTAL"];
                   $kal.="<tr>
                    <th scope = 'row'> <img src='img/b1.jpg' style='width:80px;height:60px;' alt='' /></th>
                    <td>$nama</td>
                    <td class='text-right'>X$qty</td>
                    <td class='text-right'>Rp.$subtot</td>
                 </tr>";
                }
            }



            $total="0";
            $sql2 = "SELECT SUM(D.SUBTOTAL) AS TOTAL FROM djual D, hjual H WHERE H.ID_HJUAL = D.ID_HJUAL AND
            H.ID_HJUAL = '$idhjual'";
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
                    $total = $row2["TOTAL"];


                }
             }


            $kal.="
                 </tbody>
              </Table>
              <p class='card-text col-md-12 text-dark text-right'>Total : Rp$total</p>
           </div>
        </div>";
    }
    
   }else{
      $kal= "<h5>Tidak Ada Transaksi</h5>";
   }
   echo $kal;
}



   
   if($_POST["jenis"]=="gethistory"){
       // mk= memeliahara kesehatan
      // $token="&token=";
   
       //if(isset($_SESSION["token"]))
       //{
       //  $token.=$_SESSION["token"];
       //}
   
   
       $kal = "";
      $iduser=getiduser();
       $sql0 = "SELECT * FROM hjual H WHERE ID_USER ='$iduser' AND
       H.STATUS = 'Sedang di Proses' AND H.STATUS_PAYMENT = 'Selesai'";
       $result0 = $conn->query($sql0);
       if ($result0->num_rows > 0) {
           while ($row0 = $result0->fetch_assoc()) {

               $idhjual = $row0["ID_HJUAL"];
               $idpayment = $row0["ID_PAYMENT"];
               $status = $row0["STATUS"];
               $tgl = $row0["TGL_HJUAL"];
               $newformat = new DateTime($tgl);
               $hari=$newformat->format('d F Y');
               $kal.="<div class='card text-black bg-light mb-3 col-12' style='max-width: 100rem;'>
               <div class='card-header bg-light text-dark'>
                  <div class= 'row'>
                     <div class='col-6 align-middle pt-auto'>
                        <h5 class='card-title'>$hari</h5>
                        <p class='text-dark col-md-12'>
                           H$idhjual/T$idpayment
                        </p>
                     </div>
                     <div class='col-6 text-right'>
                        <p class ='btn btn-outline-primary text-right'>$status</p>
                     </div>
                  </div>
               </div>
               <div class='card-body text-dark'>
                  <!-- <p class='card-text'>Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                  <Table class='table'>
                     <thead>
                        <tr>
                           <th scope='col'></th>
                           <th scope='col'>Barang</th>
                           <th class='text-right' scope='col'>Jumlah</th>
                           <th class='text-right' scope='col'>Subtotal</th>
                        </tr>
                     </thead>
                     <tbody> ";
               $sql = "SELECT DISTINCT H.STATUS AS STATUS, H.TGL_HJUAL AS TGL_HJUAL, H.ID_HJUAL AS ID_HJUAL, H.ID_PAYMENT AS ID_PAYMENT, H.STATUS_PAYMENT AS STATUS_PAYMENT, P.gambar1 AS GAMBAR, P.nama AS NAMA, D.QTY AS QTY, D.SUBTOTAL AS SUBTOTAL, P.id AS ID_BARANG,P.harga AS HARGA, p.HARGA*D.QTY AS TOTAL
               FROM produk P, hjual H, djual D, user U
               WHERE P.id = D.ID_BARANG AND
               H.ID_HJUAL = D.ID_HJUAL AND
               U.ID_USER = H.ID_USER AND
               U.ID_USER ='$iduser' AND
               H.ID_HJUAL = $idhjual";
               $result = $conn->query($sql);
               if ($result->num_rows > 0) {
                   while ($row = $result->fetch_assoc()) {
                       $idbarang = $row["ID_BARANG"];
                       //$iduser = $row["ID_USER"];
                     //  $total = $row["TOTAL"];
                       $statuspayment = $row["STATUS_PAYMENT"];
                       $status =$row["STATUS"];
                       $idpayment = $row["ID_PAYMENT"];
                       $idhjual = $row["ID_HJUAL"];
                       $tgl = $row["TGL_HJUAL"];
                       $img = $row["GAMBAR"];
                       $nama = $row["NAMA"];
                       $qty = $row["QTY"];
                       $subtot = $row["SUBTOTAL"];
                       $kal.="<tr>
                        <th scope = 'row'> <img src='img/b1.jpg' style='width:80px;height:60px;' alt='' /></th>
                        <td>$nama</td>
                        <td class='text-right'>X$qty</td>
                        <td class='text-right'>Rp.$subtot</td>
                     </tr>";
                    }
                }



                $total="0";
                $sql2 = "SELECT SUM(D.SUBTOTAL) AS TOTAL FROM djual D, hjual H WHERE H.ID_HJUAL = D.ID_HJUAL AND
                H.ID_HJUAL = '$idhjual'";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        $total = $row2["TOTAL"];


                    }
                 }


                $kal.="
                     </tbody>
                  </Table>
                  <p class='card-text col-md-12 text-dark text-right'>Total : Rp$total</p>
               </div>
            </div>";
        }
        
       }else{
          $kal= "<h5>Tidak Ada Transaksi</h5>";
       }
       echo $kal;
   }

   if($_POST["jenis"]=="gethistoryselesai"){

   $iduser=getiduser();
    $kal = "";
   $iduser=getiduser();
    $sql0 = "SELECT * FROM hjual H WHERE ID_USER ='$iduser' AND
    H.STATUS = 'Selesai'";
    $result0 = $conn->query($sql0);
    if ($result0->num_rows > 0) {
        while ($row0 = $result0->fetch_assoc()) {

            $idhjual = $row0["ID_HJUAL"];
            $idpayment = $row0["ID_PAYMENT"];
            $status = $row0["STATUS"];
            $tgl = $row0["TGL_HJUAL"];
            $newformat = new DateTime($tgl);
            $hari=$newformat->format('d F Y');
            $kal.="<div class='card text-black bg-light mb-3 col-12' style='max-width: 100rem;'>
            <div class='card-header bg-light text-dark'>
               <div class= 'row'>
                  <div class='col-6 align-middle pt-auto'>
                     <h5 class='card-title'>$hari</h5>
                     <p class='text-dark col-md-12'>
                        H$idhjual/T$idpayment
                     </p>
                  </div>
                  <div class='col-6 text-right'>
                     <p class ='btn btn-outline-primary text-right'>$status</p>
                  </div>
               </div>
            </div>
            <div class='card-body text-dark'>
               <!-- <p class='card-text'>Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
               <Table class='table'>
                  <thead>
                     <tr>
                        <th scope='col'></th>
                        <th scope='col'>Barang</th>
                        <th class='text-right' scope='col'>Jumlah</th>
                        <th class='text-right' scope='col'>Subtotal</th>
                     </tr>
                  </thead>
                  <tbody> ";
            $sql = "SELECT DISTINCT H.STATUS AS STATUS, H.TGL_HJUAL AS TGL_HJUAL, H.ID_HJUAL AS ID_HJUAL, H.ID_PAYMENT AS ID_PAYMENT, H.STATUS_PAYMENT AS STATUS_PAYMENT, P.gambar1 AS GAMBAR, P.nama AS NAMA, D.QTY AS QTY, D.SUBTOTAL AS SUBTOTAL, P.id AS ID_BARANG,P.harga AS HARGA, p.HARGA*D.QTY AS TOTAL
            FROM produk P, hjual H, djual D, user U
            WHERE P.id = D.ID_BARANG AND
            H.ID_HJUAL = D.ID_HJUAL AND
            U.ID_USER = H.ID_USER AND
            U.ID_USER ='$iduser' AND
            H.ID_HJUAL = $idhjual";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $idbarang = $row["ID_BARANG"];
                    //$iduser = $row["ID_USER"];
                  //  $total = $row["TOTAL"];
                    $statuspayment = $row["STATUS_PAYMENT"];
                    $status =$row["STATUS"];
                    $idpayment = $row["ID_PAYMENT"];
                    $idhjual = $row["ID_HJUAL"];
                    $tgl = $row["TGL_HJUAL"];
                    $img = $row["GAMBAR"];
                    $nama = $row["NAMA"];
                    $qty = $row["QTY"];
                    $subtot = $row["SUBTOTAL"];
                    $kal.="<tr>
                     <th scope = 'row'> <img src='img/b1.jpg' style='width:80px;height:60px;' alt='' /></th>
                     <td>$nama</td>
                     <td class='text-right'>X$qty</td>
                     <td class='text-right'>Rp.$subtot</td>
                  </tr>";
                 }
             }


             $sql2 = "SELECT SUM(D.SUBTOTAL) AS TOTAL FROM djual D, hjual H WHERE H.ID_HJUAL = D.ID_HJUAL AND
             H.ID_HJUAL = '$idhjual'";
             $result2 = $conn->query($sql2);
             
             if ($result2->num_rows > 0) {
                 while ($row2 = $result2->fetch_assoc()) {
                     $total = $row2["TOTAL"];


                 }
              }


             $kal.="
                  </tbody>
               </Table>
               <p class='card-text col-md-12 text-dark text-right'>Total : Rp$total</p>
            </div>
         </div>";
     }
    }else{
      $kal= "<h5>Tidak Ada Transaksi</h5>";
   }
   echo $kal;
}
   

if($_POST["jenis"]=="gethistorykirim"){
    // mk= memeliahara kesehatan
   // $token="&token=";

    //if(isset($_SESSION["token"]))
    //{
    //  $token.=$_SESSION["token"];
    //}


    $kal = "";
    $iduser=getiduser();
    $sql0 = "SELECT * FROM hjual H WHERE ID_USER ='$iduser' AND
    H.STATUS = 'Sedang Dikirim'";
    $result0 = $conn->query($sql0);
    if ($result0->num_rows > 0) {
        while ($row0 = $result0->fetch_assoc()) {

            $idhjual = $row0["ID_HJUAL"];
            $idpayment = $row0["ID_PAYMENT"];
            $status = $row0["STATUS"];
            $tgl = $row0["TGL_HJUAL"];
            $newformat = new DateTime($tgl);
            $hari=$newformat->format('d F Y');

            $kal.="<div class='card text-black bg-light mb-3 col-12' style='max-width: 100rem;'>
            <div class='card-header bg-light text-dark'>
               <div class= 'row'>
                  <div class='col-6 align-middle pt-auto'>
                     <h5 class='card-title'>$hari</h5>
                     <p class='text-dark col-md-12'>
                        H$idhjual/T$idpayment
                     </p>
                  </div>
                  <div class='col-6 text-right'>
                     <p class ='btn btn-outline-primary text-right'>$status</p>
                  </div>
               </div>
            </div>
            <div class='card-body text-dark'>
               <!-- <p class='card-text'>Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
               <Table class='table'>
                  <thead>
                     <tr>
                        <th scope='col'></th>
                        <th scope='col'>Barang</th>
                        <th class='text-right' scope='col'>Jumlah</th>
                        <th class='text-right' scope='col'>Subtotal</th>
                     </tr>
                  </thead>
                  <tbody> ";
            $sql = "SELECT DISTINCT H.STATUS AS STATUS, H.TGL_HJUAL AS TGL_HJUAL, H.ID_HJUAL AS ID_HJUAL, H.ID_PAYMENT AS ID_PAYMENT, H.STATUS_PAYMENT AS STATUS_PAYMENT, P.gambar1 AS GAMBAR, P.nama AS NAMA, D.QTY AS QTY, D.SUBTOTAL AS SUBTOTAL, P.id AS ID_BARANG,P.harga AS HARGA, p.HARGA*D.QTY AS TOTAL
            FROM produk P, hjual H, djual D, user U
            WHERE P.id = D.ID_BARANG AND
            H.ID_HJUAL = D.ID_HJUAL AND
            U.ID_USER = H.ID_USER AND
            U.ID_USER ='$iduser' AND
            H.ID_HJUAL = $idhjual";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $idbarang = $row["ID_BARANG"];
                    //$iduser = $row["ID_USER"];
                  //  $total = $row["TOTAL"];
                    $statuspayment = $row["STATUS_PAYMENT"];
                    $status =$row["STATUS"];
                    $idpayment = $row["ID_PAYMENT"];
                    $idhjual = $row["ID_HJUAL"];
                    $tgl = $row["TGL_HJUAL"];
                    $img = $row["GAMBAR"];
                    $nama = $row["NAMA"];
                    $qty = $row["QTY"];
                    $subtot = $row["SUBTOTAL"];
                    $kal.="<tr>
                     <th scope = 'row'> <img src='img/b1.jpg' style='width:80px;height:60px;' alt='' /></th>
                     <td>$nama</td>
                     <td class='text-right'>X$qty</td>
                     <td class='text-right'>Rp.$subtot</td>
                  </tr>";
                 }
             }


             $sql2 = "SELECT SUM(D.SUBTOTAL) AS TOTAL FROM djual D, hjaul H WHERE H.ID_HJUAL = D.ID_HJUAL AND
             H.ID_HJUAL = $idhjual";
             $result2 = $conn->query($sql2);
             if ($result2->num_rows > 0) {
                 while ($row2 = $result2->fetch_assoc()) {
                     $total = $row2["TOTAL"];


                 }
              }


             $kal.="
                  </tbody>
               </Table>
               <p class='card-text col-md-12 text-dark text-right'>Total : Rp$total</p>
            </div>
         </div>";
     }
    }else{
      $kal= "<h5>Tidak Ada Transaksi</h5>";
   }
   echo $kal;
}


   ?>