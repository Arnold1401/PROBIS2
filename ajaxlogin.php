<?php
    session_start();
    //terima parameter
    if ($_POST["jenis"]=="terima") {
        $user=$_POST["us"];
       // $pass=$_POST["pass"];

        if ($user=="willy") {
            echo "benar";
            $_SESSION["nama"]="ENDRI";
        }else{
            echo "salah";
        }
        
    }


    if ($_POST["jenis"]=="kirim") {
        echo "test kirim tulisan";
    }

?>