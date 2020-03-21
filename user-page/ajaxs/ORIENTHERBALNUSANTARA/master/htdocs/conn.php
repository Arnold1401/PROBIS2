<?php
      function getConn(){
        $conn=new mysqli("sql201.epizy.com","epiz_24892750","Apc817988","epiz_24892750_masterbtt");
        if($conn->connect_error){
            die("Connection failed : ").$conn->connect_error;
        }
        return $conn;
    }
?>