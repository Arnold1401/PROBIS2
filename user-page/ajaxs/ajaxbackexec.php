<?php
    session_start();
    include_once "../conn.php";

    //refresh pembayaran lunas
    if ($_POST["jenis"]=="refreshpembayaran") {
        $iduser=$_SESSION['idcust'];

        $kal="";

        $conn=getConn();
        $sql1="select id_hjual from hjual where id_cust='$iduser'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            $ctr=2;
            $role=0;
            while ($row1 = $result1->fetch_assoc()) {
                $idhjual=$row1["id_hjual"];
                $status=getstat($idhjual);

                if ($status=='cancel'||$status=='failure'||$status=='expire') {
                    $status="Batal";
                }else if ($status=='pending') {
                    $status="Menunggu Pembayaran";
                }else{//settlement
                    $status="Lunas";
                }

                $sql2="update hjual set status_pembayaran='$status' where id_hjual='$idhjual'";
                if ($conn->query($sql2)) {
                    $kal.="berhasil update-$idhjual \n";
                }


            }
        }

        $conn->close();

        echo $kal;

    }

    // get status 
    function getstat($orderid){
    $curl1 = curl_init();
    curl_setopt_array($curl1, array(
    CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/$orderid/status",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
     "Authorization:Basic U0ItTWlkLXNlcnZlci04Tk44ZDlaZTNKNldWcElsQWdWbC1faHY= ,: ",
     "Content-Type: application/json",
     "Accept: application/json"
    ),
    ));
  
    //dibawah ini sudah diencode dengan base64 dari server key nya merchan sendiri
    //U0ItTWlkLXNlcnZlci04Tk44ZDlaZTNKNldWcElsQWdWbC1faHY= 
  
    $response1 = curl_exec($curl1);
    curl_close($curl1);

    $arrhasil=json_decode($response1);
    $hasil=$arrhasil->transaction_status;
    return $hasil;
    //return $response1;
  }
  

?>