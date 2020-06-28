<?php
    session_start();
    include_once "../conn.php";

    if ($_POST["jenis"]=="keluar") {
        session_destroy();
    }

    if ($_POST["jenis"]=="login") {
        # code...
        $conn = getConn();

        $email=$_POST["user"];
        $pass=$_POST["pass"];

        
        $ctr=-1;  //-1 tidak ditemukan //0 salah pass  //1 match
        $role=0;  //0 sebagai customer //1 sales
        $status=0; //0 tidak aktif //1 aktif

        $_SESSION["role"]="";

        $sql1="select * from customer where email='$email' and password='$pass'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            $ctr=2;
            $role=0;
               
            while ($row1 = $result1->fetch_assoc()) {
                $_SESSION["role"]="reseller";
                $_SESSION["nama_perusahaan"]=$row1["nama_perusahaan"];
                $_SESSION["nama_user"]=$row1["nama_pemilik"];
                $_SESSION["email_user"]=$row1["email"];//1
                $_SESSION["status_akun"]=$row1["status"];
                $_SESSION["token"]=$row1["token"];
                $_SESSION["idcust"]=$row1["id_cust"];
                $_SESSION["verified"]=$row1["verified"];
                

                $status=$row1["verified"];
            }
        }

        $sql2="select * from sales where email='$email' and password='$pass'";
        $result2 = $conn->query($sql2);
        if ($result2->num_rows > 0) {
            $ctr=2;
            $role=1;
            while ($row2 = $result2->fetch_assoc()) {
                $_SESSION["role"]="salesman";
                $_SESSION["nama_user"]=$row2["nama_sales"];
                $_SESSION["email_user"]=$row2["email"];
                $_SESSION["id_sales"]=$row2["id_sales"];
                $status=$row2["status"];
            }
        }

        if ($_SESSION["role"]=="salesman") {
            echo "sales-home.php";
        }else if ($ctr==2) {
            if ($role==0) {//reseller
                if ($status=="0") {
                  echo "alertconfirm.php";
                }else{
                  echo "home.php";
                }
            }else{
                if ($status=="0") {
                    echo "alertconfirm.php";
                }else{

                    echo "../admin-page/admin-home.php";
                }
            }
        }else{
            if ($email=="admin") {
                if ($pass=="admin") {
                    $ctr=1;
                    $_SESSION["role"]="admin";
                    $_SESSION["email_user"]="admin";
                    echo "../admin-page/admin-home.php";
                }else{
                    echo "admin salah password";

                }
            }else{
                echo "data tidak ditemukan";
            }


        }
        $conn->close();
    }
    
   
    


?>