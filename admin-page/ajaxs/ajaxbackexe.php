<?php

session_start();
include_once "../conn.php";

    function keuntungan(){

        $kal="";
        $conn=getConn();
        $arrhjual=[];
        $sql="select * from hjual where status_pembayaran='Menunggu Pembayaran'";
        $result=$conn->query($sql);
        if ($result->num_rows>0) {
            while ($row=$result->fetch_assoc()) {
                $id=$row["id_hjual"];
                $kal.="id=$id";
                array_push($arrhjual,$id);

            }
        }
        $conn->close();


        for ($i=0; $i <count($arrhjual); $i++) {


            $conn=getConn();
            $idhjual=$arrhjual[$i];

            $sql1="select distinct d.id_hjual as hjual,sum(d.subtotal-(b.harga_beli*d.kuantiti)) as keuntungan
            from djual d,barang b
            where d.id_barang=b.id_barang and
            d.id_hjual in(select d.id_hjual from djual d
            where d.id_hjual='$idhjual')";
            $result1=$conn->query($sql1);
            if ($result1->num_rows>0) {
                while ($row1=$result1->fetch_assoc()) {
                    $keuntungan=$row1["keuntungan"];

                }
                $sql2="update hjual set keuntungan='$keuntungan' where id_hjual='$idhjual' ";
                if ($conn->query($sql2)) {
                    $kal.="update $i berhasil idhjual $idhjual";
                }
            }
            $conn->close();
            $keuntungan=0;

        }


        echo $kal;


      }

      if ($_POST["jenis"]=="untung") {
          keuntungan();
      }
?>
