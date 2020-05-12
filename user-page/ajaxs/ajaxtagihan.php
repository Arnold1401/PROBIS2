<?php
    session_start();
    include_once '../conn.php';
    include_once '../classes/item.php';

    if ($_POST["jenis"]=="getinfo") {
        $idhjual=$_POST["id"];

        $conn=getConn();
        $kal="";
        $sql="select * from piutang where id_hjual='$idhjual'";
        $result = $conn->query($sql);
        if ($result->num_rows>0) {
            while($row = $result->fetch_assoc()) {
                $ada=$row['NO'];
            }
        }
        $conn->close();
        echo $kal;
    }

?>