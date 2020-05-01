<?php
      session_start();
      date_default_timezone_set("Asia/Bangkok");
      include_once "../conn.php";
  
      if ($_POST["jenis"]=="getprovince") {
        $arrprovince=getprovince();
        if ($arrprovince=="error") {
            echo "error";
        }else{
            $kal="";
            $kal.="<option value='-1'>--Pilih Provinsi--</option>";
            for ($i=0; $i <count($arrprovince); $i++) { 
                $id=$arrprovince[$i]->province_id;
                $nama=$arrprovince[$i]->province;
                $kal.="<option value='$id-$nama'>$nama</option>";
            }
            echo $kal;
        }
        
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


      function getprovince(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
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
            $resultnya=$arr->rajaongkir->results;
            return $resultnya;
        }
      }

      if ($_POST["jenis"]=="getcity") {
          $province=$_POST["province"];
          $arrcity=getcity($province);
          if ($arrcity=="error") {
              echo "error";
          }else {
              $kal="";
              $kal.="<option value='-1'>--Pilih Kota--</option>";
              for ($i=0; $i<count($arrcity); $i++) { 
                $idcity=$arrcity[$i]["city_id"];
                $city=$arrcity[$i]["city_name"];
                $kal.="<option value='$idcity-$city'>$city</option>";
              }
              echo $kal;
          }

      }

      function getcity($province){
        $curl1 = curl_init();
        curl_setopt_array($curl1, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
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
        $response1 = curl_exec($curl1);
        $err1 = curl_error($curl1);
        curl_close($curl1);
        if ($err1) {
        echo "error";
        } else 
        { 
           $arr=json_decode($response1);
           $resultnya=$arr->rajaongkir->results;
           $arrcity=array();
           for ($i=0; $i <count($resultnya); $i++) { 
             if ($resultnya[$i]->province_id==$province) {
                 $idcity=$resultnya[$i]->city_id;
                 $city=$resultnya[$i]->city_name;
                 array_push($arrcity,array( "city_id" =>$idcity, "city_name" =>$city));
             }
           }
           return $arrcity;
        }
      }

      if ($_POST["jenis"]=="getsubdistrict") {
        $city=$_POST["city"];
        $arrsubdistrict=getsubdistrict($city);
        if ($arrsubdistrict=="error") {
            echo "error";
        }else{
            $kal="";
            $kal.="<option value='-1'>--Pilih Kecamatan--</option>";
            for ($i=0; $i<count($arrsubdistrict); $i++) { 
              $idsub=$arrsubdistrict[$i]->subdistrict_id;
              $sub=$arrsubdistrict[$i]->subdistrict_name;
              $kal.="<option value='$idsub-$sub'>$sub</option>";
            }
            echo $kal;
            //echo json_encode($arrsubdistrict);
        }
      }

      function getsubdistrict($city){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=$city",
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
           echo "error";
        } else {
            $arr=json_decode($response);
            $resultnya=$arr->rajaongkir->results;
            return $resultnya;
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
     
      if ($_POST["jenis"]=="getharga") {
        $corigin=$_POST["corigin"];
        $sdestination=$_POST["sdestination"];
        $berat=$_POST["berat"];
        if ($berat=="") {
         $berat="1000";
        }
        // $hasil=getharga($corigin,$sdestination,"1000","jne:pos:tiki:rpx:esl:pcp:pandu:wahana:sicepat:jnt:pahala:cahaya:sap:jet:indah:dse:slis:first:ncs:star:ninja:lion:idl:rex");
        $hasil=getharga($corigin,$sdestination,$berat,"jne:pos:tiki:rpx:esl:pcp:pandu:wahana:sicepat:jnt:jet:ninja:lion");
        $kal="";
        
        for ($i=0; $i <count($hasil); $i++) { 
            $nama=$hasil[$i]->name;
            $code=strtoupper($hasil[$i]->code);
            $arrharga=$hasil[$i]->costs;
            for ($j=0; $j <count($arrharga); $j++) { 
                $estimasi=$arrharga[$j]->cost[0]->etd;
                $service=$arrharga[$j]->service;
                $harga=$arrharga[$j]->cost[0]->value;
                $hargaformated=number_format($harga);
                $kal.="<li class='list-group-item'><b>$code</b> ~ <b>$service</b> ~ $estimasi hari ~ Rp.$hargaformated,-</li>";
            }
           
        
        }
        echo $kal;

      }

      //buat get harga
      function getharga($corigin,$sdestination,$weight,$courier){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=$corigin&originType=city&destination=$sdestination&destinationType=subdistrict&weight=$weight&courier=$courier",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 8ccbf31cdb56de646092992e32819d09"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "error";
        } else {
          $arr=json_decode($response);
          $resultnya=$arr->rajaongkir->results;
          return $resultnya;
        }
      }


      if ($_POST['jenis'] == "register") {
        // (0 - admin) (1 - reseller)(2 - sales) -- role
        // (0 - menunggu ) (1 - valid ) (2 - tidak valid) -- status akun
        
        $nama_perusahaan = $_POST["nama_perusahaan"];
        $nama_user = $_POST["nama_user"];
        $nomor_ktp = $_POST["nomor_ktp"];
        $foto_ktp = $_POST["foto_ktp"];
        $telp_user = $_POST["telp_user"];
        $lahir_user = $_POST["lahir_user"];
        $jeniskelamin_user = $_POST["jeniskelamin_user"];
        $alamat_user = $_POST["alamat_user"];
        $sales_pilihanuser = "null";
        $email_user = $_POST["email_user"];
        $password_user = $_POST["password_user"];
        $prov = $_POST["prov"];
        $kota = $_POST["kota"];
        $camat = $_POST["camat"];
        $password_user = $_POST["password_user"];

        $status_akun = 0;//menunggu
        $ctr = 0;//untuk mengetahu kembar email

        
        $conn = getConn();
        
        $token=substr(md5(time()), 0, 5);

        $sql1 = "select * from customer";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                if ($email_user == $row1["email"]) {
                    $ctr = 1;
                }
            }
        }

        
        $conn->close();

        $conn = getConn();
        $sql2 = "select * from email";
        $result2 = $conn->query($sql2);
        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
                if ($email_user == $row2["email"]) {
                    $ctr = 1;
                }
            }
        }
    


        if ($ctr == 0) {
            $sql2 = "insert into customer (email,nama_perusahaan,nama_pemilik,foto_ktp,nomor_ktp,tanggal_lahir,jenis_kelamin,password,notelp,status,id_sales,token) values ('$email_user','$nama_perusahaan','$nama_user','$foto_ktp','$nomor_ktp','$lahir_user','$jeniskelamin_user','$password_user','$telp_user','0','$sales_pilihanuser','$token')";
            $sql3 = "insert into alamat_pengiriman (email,provinsi,kota,kecamatan,alamat_lengkap,no_prioritas) values ('$email_user','$prov','$kota','$camat','$alamat_user','1')";
    
            if ($conn->query($sql2)) {
                if($conn->query($sql3)){
                echo "berhasil register";

                
                $body="<html>
                <head>
                    <title>Send an Email on Form Submission using PHP with PHPMailer</title>
                    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
                    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' />
                    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
                </head>
                <body>
                    <br />
                    <div class='container'>
                        <div class='row'>
                            <h2>Halo,$nama_user Token untuk konfirmasi email anda dibawah ini :</h2>
                            <h3>$token</h3>
                            <p>Keterangan : Masukan token tersebut apabila anda diarahkan ke halaman request token setelah login</p>
                        </div>
                    </div>
                </body>
            </html>
            ";
                kirimemail($body,$email_user,$nama_user);

                }
                
            }else{
                echo "gagal register";
            }
        }
        else {
            echo "email telah digunakan!";
        }
        $conn->close();
    }
    

    use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\SMTP;
     use PHPMailer\PHPMailer\Exception;
    

     function kirimemail($body,$sendto,$namauser){
       
      //$body="'This is the HTML message body <b>in bold!</b>'";
      // $body=$_POST['isi'];
      // $sendto=$_POST['to'];
      // Import PHPMailer classes into the global namespace
      // These must be at the top of your script, not inside a function
 
      // Load Composer's autoloader
      require 'mailvendor/autoload.php';

      // Instantiation and passing `true` enables exceptions
      $mail = new PHPMailer(true);
      $kal="";
      $err="";
      try {
          //Server settings
          $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
          $mail->isSMTP();                                            // Send using SMTP
          $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
          $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
          $mail->Username   = 'emosmart@gmail.com';      // SMTP username
          $mail->Password   = 'probis2@';                    // SMTP password
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
          $mail->Port       = 587;                                    // TCP port to connect to

          //Recipients
          $mail->setFrom('emosmart@gmail.com', 'Emos Mart');
          $mail->addAddress($sendto,$namauser);     // Add a recipient
          //$mail->addAddress('ellen@example.com');               // Name is optional
          //$mail->addReplyTo('info@example.com', 'Information');
          //$mail->addCC('cc@example.com');
          //$mail->addBCC('bcc@example.com');

          // // Attachments
          // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
          // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

          // Content
          $mail->isHTML(true);                                  // Set email format to HTML
          $mail->Subject = 'KONFIRMASI EMAIL';
          $mail->Body    = $body;
          $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

          $mail->send();
          $kal= 'Message has been sent';
      } catch (Exception $e) {
          $err= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }


      if ($err=="") {
          echo $kal;
      }else{
          echo $err;
      }
   }

?>