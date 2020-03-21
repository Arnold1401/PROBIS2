<?php

function ceksesuai($token){
    include_once "conn.php";
    $conn=getConn();
    $ada=false;
    $sql0 = "SELECT * FROM token where id_token='$token'";
    $result0 = $conn->query($sql0);
    if ($result0->num_rows > 0) {
        while($row0= $result0->fetch_assoc()) {
            $ada=true;
        }
    }

    return $ada;
  }

    if (isset($_SESSION["token"])) {
        //jika ada token user akan di periksa buat request ajax dengan javascript panggil ajax di auth
        $token =$_SESSION['token'];
        //cek sesuai token
        if (ceksesuai($token)) {
        //auth sesuai
        }else{
            echo"<script>
            //alert('Test ada token');
            window.location.href='login.php';
                 </script>";
            session_destroy();
        }   
    }else{
        echo "<script>
        //alert('Test tidak ada token');
        window.location.href='login.php';
        </script>";
        session_destroy();
    }

    if (isset($_GET["logout"])) {
        echo "<script>
        //alert('Test tidak ada token');
        window.location.href='index.php';
        </script>";
        session_destroy();
    }
?>