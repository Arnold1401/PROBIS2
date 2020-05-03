<?php
     use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\SMTP;
     use PHPMailer\PHPMailer\Exception;
    session_start();
     include_once "../conn.php";

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
             $mail->setFrom('emosmart@gmail.com', 'EMOS');
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


        if ($_POST["jenis"]=="konfirmasiemail") {
          $email=$_POST["email"];
          $nama="";
          $token=substr(md5(time()), 0, 5);
          $kal="";
          //update user token

          $conn=getConn();
          $sql = "SELECT * FROM customer where email='$email'";
          $result = $conn->query($sql);
          
          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                $nama=$row["nama_pemilik"];
              }
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
                        <h2>Halo,$nama Token untuk konfirmasi email anda dibawah ini :</h2>
                        <h3>$token</h3>
                        <p>Keterangan : Masukan token tersebut apabila anda diarahkan ke halaman request token setelah login</p>
                    </div>
                </div>
            </body>
        </html>
        ";
  
          kirimemail($body,$email,$nama);
          } else {
              
          }

          $conn->close();
          
            
          echo $kal;
        }

    if ($_POST["jenis"]=="kirimulang") {
        $email=$_SESSION["email_user"];
        $token=substr(md5(time()), 0, 5);
        updatetoken($email,$token);
        $conn=getConn();
        $sql = "SELECT * FROM customer where email='$email'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              $nama=$row["nama_pemilik"];
            }
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
                      <h2>Halo,$nama Token untuk konfirmasi email anda dibawah ini :</h2>
                      <h3>$token</h3>
                      <p>Keterangan : Masukan token tersebut apabila anda diarahkan ke halaman request token setelah login</p>
                  </div>
              </div>
          </body>
      </html>
      ";
        kirimemail($body,$email,$nama);
    }
}


    if ($_POST["jenis"]=="verify") {
        $email=$_SESSION["email_user"];
        $token=$_POST["token"];

        $conn=getConn();
        $sql = "SELECT * FROM customer where email='$email' and token='$token'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            echo updatestatus($email);
        }else{
            echo "token salah";
        }
    }


    function updatetoken($email,$token){
        $conn=getConn();
        $sql = "update customer set token='$token' where email='$email'";
        if($conn->query($sql)){

        }else{
            echo "gagal ";
        }
        $conn->close();
    }

    function updatestatus($email){
        $conn=getConn();
        $sql = "update customer set verified='1' where email='$email'";
        if($conn->query($sql)){
            return "berhasil";
        }else{
            return "gagal ";
        }
        $conn->close();
    }









?>