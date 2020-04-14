<?php
    session_start();
    include_once "../conn.php";
    include_once "../classes/item.php";

    if ($_POST["jenis"]=="add") {
        $id=$_POST["idbarang"];
        
    }
    
?>