<?php

session_start();
include_once "../conn.php";

$conn=getConn();
$status=$_POST["status"];

$id=$_POST["id"];
$sql="update orders set status_order=$status where id_hjual=$id";

if($conn->query($sql) === TRUE){

    echo"true";

}


?>