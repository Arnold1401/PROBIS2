<?php
    session_start();
    include "conn.php";
    $conn=getConn();
    if ($_POST["jenis"]=="login") {
       $user=$_POST["p1"];
       $pass=$_POST["p2"];

        $iduser="";
        $token="";
        
        $status="";
        $match=false;
        $benar=false;
        $kal="";
        $sql = "SELECT * FROM user where EMAIL_USER='$user'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                if ($pass==$row["PASSWORD"]) {
                    $benar=true;
                    $iduser=$row["ID_USER"];
                    $status=$row["STATUS"];
                    $_SESSION["email"]=$user;
                }
            }
            if (!$benar) {
                $kal="gagal";
            }
            $match=true;
        } else {
            $kal="gagal";
        }

        if ($match) //jika user ketemu
        {
            //cari tokenya 
            $sql = "SELECT * FROM token where id_user='$iduser' and status!='admin'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                //jika token ada maka diupdate
                $newtoken = substr(md5(uniqid(mt_rand(), true)) , 0, 10);
                $tanggal=date("d-m-Y");
                $sql = "UPDATE token SET id_token='$newtoken',tanggal='$tanggal' WHERE id_user='$iduser'";
                if ($conn->query($sql) === TRUE) {
                    //berhasil update token
                    $token=$newtoken;
                    $_SESSION["token"]=$token;
                } else {
                    $kal="gagal";
                }

            } else //jika token tidak ada
            {
                $newtoken = substr(md5(uniqid(mt_rand(), true)) , 0, 10);
                $token=$newtoken;
                $tanggal=date("d-m-Y");
                $sql1 = "INSERT INTO token (id_token,id_user,tanggal)VALUES ('$token', '$iduser', '$tanggal')";
                if ($conn->query($sql1) === TRUE) {
                    //berhasil insert token
                    $_SESSION["token"]=$token;
                } else {
                    $kal="gagal";
                }
            }

            if ($benar) {
                if ($status!="aktif") {
                    $kal="verify-".$token;
                }else{
                    $kal="index-".$token;
                }
                
            }else{
                $kal="index-salahpass";
            }
        }else{
            $kal="index-salahuser";
        }

        
        
       


        $conn->close();
        echo $kal;
    }

    if ($_POST["jenis"]=="verify") {
        $kal="";
        $kode=$_POST["p1"];
        $email=$_SESSION["email"];
        $match=false;
        $acak="";

        $sql0 = "SELECT * FROM user where EMAIL_USER='$email'";
        $result0 = $conn->query($sql0);
        if ($result0->num_rows > 0) {
            while($row0= $result0->fetch_assoc()) {
                $acak=$row0['STATUS'];
            }
        }

        if ($acak==$kode) {
            $match=true;
        }

        
        if ($match) {
           //update status menjadi aktif
            $sql = "UPDATE user SET STATUS='aktif' WHERE EMAIL_USER='$email'";
            if ($conn->query($sql) === TRUE) {
                $kal="berhasil-index-".$_SESSION["token"];
            } else {
                $kal="gagal-";
            }
        }else{
            $kal="salah-";
        }
        $conn->close();
        echo $kal;
    }

    if ($_POST['jenis']=="kirimulang") {
        $status="";
        $newtoken = substr(md5(uniqid(mt_rand(), true)) , 0, 5);
        if (isset($_SESSION['email'])) {
            $sendto=$_SESSION['email'];
        }else{
            $status="hilang";
        }

        //get nama
        $sql0 = "SELECT * FROM user where EMAIL_USER='$sendto'";
        $result0 = $conn->query($sql0);
        if ($result0->num_rows > 0) {
            while($row0= $result0->fetch_assoc()) {
                $namauser=$row0['NAMA_USER'];
            }
        }

        //update status/kode verify
        $sql = "UPDATE user SET STATUS='$newtoken' WHERE EMAIL_USER='$sendto'";
        if ($conn->query($sql) === TRUE) {
            $kal="berhasil";
        } else {
            $kal="gagal";
        }
        
        $body="kode verifikasi anda adalah <b>".$newtoken."</b>";
        $namauser="";
        kirimemail($body,$sendto,$namauser);
        
        echo $status;
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
            $mail->Username   = 'orientherbalnusantara@gmail.com';      // SMTP username
            $mail->Password   = 'Orientnusantara88';                    // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('orientherbalnusantara@gmail.com', 'Orient Herbal');
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
            $mail->Subject = 'Here is the subject';
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

     if ($_POST["jenis"]=="register") {
        $data="kosong";
        $nama=$_POST["p1"];
        $email=$_POST["p2"];
        $no=$_POST["p3"];
        $pass=$_POST["p4"];
        $cpass=$_POST["p5"];
        $kodeacak=substr(md5(uniqid(mt_rand(), true)) , 0, 8);;
        //kode acak
        $status="kode anda adalah <b>".$kodeacak."</b>";
        $tulis="";
        $tulis=kirimemail($status,$email,$nama);
        $status=$kodeacak;
       
        $sql = "SELECT * FROM user where EMAIL_USER='$email'";
         $result = $conn->query($sql);
         if ($result->num_rows > 0) {
             $data="gagal";
         } 
         else if ($result->num_rows == 0) {
            $sql1 = "INSERT INTO user (NAMA_USER,TELP_USER,EMAIL_USER,PASSWORD,STATUS)VALUES ('$nama','$no','$email','$pass','$status')";
            $result1 = $conn->query($sql1);
            $data="sukses";
            if ($result1 == true) {
                $data="sukses";
            }
            else if ($result1 == false) {
               $data="gagal";
            }
         }
        echo $data;
     }

     
    
?>