<?php

session_start();
include_once "../conn.php";

$conn=getConn();
$status=$_POST["status"];

$id=$_POST["id"];





$sql="update hjual set status_order='$status' where id_hjual='$id';";




if($conn->query($sql)){

    echo true;

}



?>