
<?php
    function getConn(){
        $conn=new mysqli("localhost","root","","dbprobis_dua");
        if($conn->connect_error){
            die("Connection failed : ").$conn->connect_error;
        }
        return $conn;
    }
?>