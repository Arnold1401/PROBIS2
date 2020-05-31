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
                $statorder="";
                if ($status=='cancel'||$status=='failure'||$status=='expire') {
                    $status="Batal";
                }else if ($status=='pending') {
                    $status="Menunggu Pembayaran";
                    $sql2="select * from piutang where id_hjual='$idhjual'";
                    $result2 = $conn->query($sql2);
                    if ($result2->num_rows > 0) {
                        $status="Hutang";
                    }
                    
                    $sql3="select * from piutang where id_hjual='$idhjual'";
                    $result3 = $conn->query($sql3);
                    if ($result3->num_rows > 0) {
                        while($row3=$result3->fetch_assoc()){
                            $idp=$row3["id_piutang"];
                            $statorder=$row3["status_order"];
                        }
                        $status=getstat($idp);
                        if ($status=="pending") {
                            $status="Menunggu Pembayaran Hutang";
                            $statorder="Proses";
                        }else if($status=='cancel'||$status=='failure'||$status=='expire'){
                            $status="Batal";
                            $statorder="Batal";
                            setnormal($idhjual);
                        }else{
                            $status="Hutang";
                            $statorder="Proses";
                        }
                        $sql2="update hjual set status_pembayaran='$status',status_order='$staorder' where id_hjual='$idhjual'";
                        if ($conn->query($sql2)) {
                            $kal.="berhasil update-$idhjual \n";
                        }
        
                    }
                  
                   
                }else{//settlement
                    $status="Lunas";
                  
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
  
  function setnormal($idhjual){
    $conn=getConn();
    $sql="select * from djual where id_hjual='$idhjual'";
    $result=$conn->query($sql);
    if ($result->num_rows>0) {
        while ($row=$result->fetch_assoc()) {
            $qty=$row["kuantiti"];
            $idb=$row["id_barang"];
            updatedetailbarang($idb,$qty);
        }
    }
    //id_barang
    //kuantiti
    $conn->close();
  }

  function updatedetailbarang($idb,$qty){
    $conn=getConn();
    $sql="select * from detail_barang where id_barang='$idb'";
    $result=$conn->query($sql);
    if ($result->num_rows>0) {
        while ($row=$result->fetch_assoc()) {
            $sisa=$row["sisa"];
        }
    }
    $jum=$sisa+$qty;

    $sql2="update detail_barang set sisa='$jum' where id_barang='$idb'";
    if ($conn->query($sql2)) {
        
    }
    $conn->close();
  }

  function keuntungan(){

    $kal="";
    $conn=getConn();
    $arrhjual=[];
    $sql="select * from hjual where status_pembayaran='Hutang'";
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