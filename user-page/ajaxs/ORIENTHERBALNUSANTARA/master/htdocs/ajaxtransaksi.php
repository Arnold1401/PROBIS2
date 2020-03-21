<?php
    include "conn.php";
    session_start();
    $conn=getConn();

    if($_POST["jenis"]=="load_data"){
        $kal="";
        $sql = "SELECT h.ID_HJUAL as ID_HJUAL,h.TGL_HJUAL as TGL_HJUAL,u.NAMA_USER as NAMA_USER,h.STATUS_PAYMENT as STATUS_PAYMENT,h.status as status FROM hjual h, user u WHERE h.ID_USER = u.ID_USER ORDER BY h.ID_HJUAL ASC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                    $id = $row["ID_HJUAL"];
                    $date= $row["TGL_HJUAL"];
                    $nama = $row["NAMA_USER"];
                    $status_payment = $row["STATUS_PAYMENT"];
                    $status=$row["status"];

                    $kal.="
                    <tr>
                    <td>$id</td>
                    <td>$date</td>
                    <td>$nama</td>
                    <td>$status</td>
                    <td>$status_payment</td>
                    <td><button type='Button' class='btn btn-warning' onclick=\"detail('$id')\">Detail</button></td>
                    </tr>";
            }
        } else {
            echo "Tidak Ada Data Transaksi";
        }
        $conn->close();
        echo $kal;
    }
    if($_POST["jenis"]=="load_indek"){
        $id=$_POST["id"];
        $kal="";
        $sql = "SELECT DISTINCT h.ID_HJUAL as IDH,u.NAMA_USER as nama_user, p.id as id_barang, p.nama as produk,d.QTY as qty,d.HARGA as harga,d.SUBTOTAL as subtotal 
        FROM hjual h,djual d,user u, produk p 
        WHERE 
        h.ID_HJUAL = '$id' AND 
        h.ID_HJUAL = d.ID_HJUAL AND 
        u.ID_USER = h.ID_USER AND 
        d.ID_BARANG = p.id  GROUP BY d.ID_BARANG";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                    $idtrans = $row["IDH"];
                    $id_barang = $row["id_barang"];
                    $nama_barang = $row["produk"];
                    $qty = $row["qty"];
                    $harga = $row["harga"];
                    $subtotal = $row["subtotal"];
                    $kal.="
                    <tr>
                      <td>$idtrans</td>
                      <td>$id_barang</td>
                      <td>$nama_barang</td>
                      <td>$qty</td>
                      <td>$harga</td>
                      <td>$subtotal</td>
                    </tr>";
            }
            echo $kal;
        } else {
            echo "Data Transaksi Tidak Ada";
        }
        $conn->close();
    }

    if($_POST["jenis"]=="load_table"){
        $id=$_POST["id"];
        $kal="";
        $sql = "SELECT R.ID_RESI AS RID, R.NO_RESI AS NORIS ,H.ID_HJUAL AS HID, H.TGL_HJUAL AS TGL, U.NAMA_USER AS NAMA , R.NO_RESI AS NORESI, H.STATUS AS STAT, H.STATUS_PAYMENT AS STATPAY
                FROM hjual H, user U, resi_pengiriman R
                WHERE
                R.ID_HJUAL = H.ID_HJUAL AND
                U.ID_USER = H.ID_USER AND H.ID_HJUAL = '$id'
                ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                    $idtrans = $row["HID"];
                    $nama_user = $row["NAMA"];
                    $tgl = $row["TGL"];
                    $status = $row["STAT"];
                    $status_payment = $row["STATPAY"];
                    $resi = $row["RID"];
                    $no_resi = $row["NORIS"];
                    $ret=array("index"=>$idtrans,"nama"=>$nama_user,"tgl"=>$tgl,"status"=>$status,"status_payment"=>$status_payment,"id_resi"=>$resi,"no_resi"=>$no_resi);
                    echo Json_encode($ret);
            }
        } else {
            $sql0 = "SELECT H.ID_HJUAL AS HID, H.TGL_HJUAL AS TGL, U.NAMA_USER AS NAMA , H.STATUS AS STAT, H.STATUS_PAYMENT AS STATPAY
            FROM hjual H, user U
            WHERE
            U.ID_USER = H.ID_USER AND H.ID_HJUAL = '$id'
            ";
            $result0 = $conn->query($sql0);
                if ($result0->num_rows > 0) {
                    while($row0 = $result0->fetch_assoc()) {
                    $idtrans = $row0["HID"];
                    $nama_user = $row0["NAMA"];
                    $tgl = $row0["TGL"];
                    $status = $row0["STAT"];
                    $status_payment = $row0["STATPAY"];
                    $ret=array("index"=>$idtrans,"nama"=>$nama_user,"tgl"=>$tgl,"status"=>$status,"status_payment"=>$status_payment);
                    echo Json_encode($ret);
                    }
                }
            }
        $conn->close();
    }

    if($_POST["jenis"]=="load_cari"){
        $kal="";
        $dari=$_POST["dari"];
        $sampai=$_POST["sampai"];
        $status = $_POST["status"];
        $payment = $_POST["payment"];
        $mstatus = "";
        $mpayment = "";
        if($status == "")
        {
            $mstatus.="";
        }
        else if($status == "Sedang di Proses")
        {
            $mstatus.="H.status='$status'";
        }
        else if($status == "Sedang di Kirim")
        {
            $mstatus.="H.status='$status'";
        }
        else if($status == "Selesai")
        {
            $mstatus.="H.status='$status'";
        }
        else if($status == "Gagal")
        {
            $mstatus.="H.status='$status'";
        }


        if($payment=="")
        {
            $mpayment.="";
        }
        else if($payment=="Pending")
        {
            $mpayment.="H.status_payment='$payment'";
        }
        else if($payment=="Selesai")
        {
            $mpayment.="H.status_payment='$payment'";
        }
        else if($payment=="Gagal")
        {
            $mpayment.="H.status_payment='$payment'";
        }






        if($dari=="" && $sampai=="" && $status=="" && $payment=="")
        {
            $sql = "SELECT H.ID_HJUAL,H.TGL_HJUAL,U.NAMA_USER,H.ID_PAYMENT,H.STATUS_PAYMENT,H.status FROM hjual H, user U WHERE H.ID_USER = U.ID_USER ORDER BY H.ID_HJUAL ASC";
        }
        else if($dari=="" && $sampai=="" && $status!="" && $payment=="")
        {
            $sql = "SELECT H.ID_HJUAL,H.TGL_HJUAL,U.NAMA_USER,H.ID_PAYMENT,H.STATUS_PAYMENT,H.status FROM hjual H, user U WHERE H.ID_USER = U.ID_USER AND $mstatus ORDER BY H.ID_HJUAL ASC";
        }
        else if($dari=="" && $sampai=="" && $status=="" && $payment!="")
        {
            $sql = "SELECT H.ID_HJUAL,H.TGL_HJUAL,U.NAMA_USER,H.ID_PAYMENT,H.STATUS_PAYMENT,H.status FROM hjual H, user U WHERE H.ID_USER = U.ID_USER AND $mpayment ORDER BY H.ID_HJUAL ASC";
        }
        else if($dari=="" && $sampai=="" && $status!="" && $payment!="")
        {
            $sql = "SELECT H.ID_HJUAL,H.TGL_HJUAL,U.NAMA_USER,H.ID_PAYMENT,H.STATUS_PAYMENT,H.status FROM hjual H, user U WHERE H.ID_USER = U.ID_USER AND $mpayment AND $mstatus ORDER BY H.ID_HJUAL ASC";
        }
        else if($dari!="" && $sampai!="" && $status=="" && $payment=="")
        {
            $sql = "SELECT H.ID_HJUAL,H.TGL_HJUAL,U.NAMA_USER,H.ID_PAYMENT,H.STATUS_PAYMENT,H.status FROM hjual H, user U WHERE H.ID_USER = U.ID_USER AND  H.TGL_HJUAL >= '$dari' AND H.TGL_HJUAL <= '$sampai' ORDER BY H.ID_HJUAL ASC";
        }
        else if($dari!="" && $sampai=="" && $status=="" && $payment=="")
        {
            $sql = "SELECT H.ID_HJUAL,H.TGL_HJUAL,U.NAMA_USER,H.ID_PAYMENT,H.STATUS_PAYMENT,H.status FROM hjual H, user U WHERE H.ID_USER = U.ID_USER AND  H.TGL_HJUAL >= '$dari' ORDER BY H.ID_HJUAL ASC";
        }
        else if($dari=="" && $sampai!="" && $status=="" && $payment=="")
        {
            $sql = "SELECT H.ID_HJUAL,H.TGL_HJUAL,U.NAMA_USER,H.ID_PAYMENT,H.STATUS_PAYMENT,H.status FROM hjual H, user U WHERE H.ID_USER = U.ID_USER AND  H.TGL_HJUAL <= '$sampai' ORDER BY H.ID_HJUAL ASC";
        }
        else
        {
            $sql = "SELECT H.ID_HJUAL,H.TGL_HJUAL,U.NAMA_USER,H.ID_PAYMENT,H.STATUS_PAYMENT,H.status FROM hjual H, user U WHERE H.ID_USER = U.ID_USER AND
            H.TGL_HJUAL >= '$dari' AND H.TGL_HJUAL <= '$sampai' ORDER BY H.ID_HJUAL ASC";
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $id = $row["ID_HJUAL"];
                $date= $row["TGL_HJUAL"];
                $nama = $row["NAMA_USER"];
                $id_payment = $row["ID_PAYMENT"];
                $status_payment = $row["STATUS_PAYMENT"];
                $status=$row["status"];
                $kal.="
                <tr>
                <td>$id</td>
                <td>$date</td>
                <td>$nama</td>
                <td>$status</td>
                <td>$id_payment</td>
                <td>$status_payment</td>
                <td><button type='Button' class='btn btn-warning' onclick=\"detail('$id')\">Detail</button></td>
                </tr>";
            }
            echo $kal;
        } else {
            echo "Data Transaksi Tidak Ada";
        }
        $conn->close();
    }
    if($_POST["jenis"] == "update_resi")
    {
        $idresi =$_POST["idresi"];
        $no_resi=$_POST["resi"];
        $sql="UPDATE resi_pengiriman SET NO_RESI='$no_resi' WHERE ID_RESI='$idresi'";
        $result=$conn->query($sql);
        if($result == true)
        {
            echo "Berhasil Upadate Resi";
        }
        else
        {
            echo "Gagal Upadate Resi";
        }
    }
    if($_POST["jenis"] == "update_hjual")
    {
        $id = $_POST["id_trans"];
        $status=$_POST["status_h"];
        $sql="UPDATE hjual SET STATUS = '$status' WHERE ID_HJUAL='$id'";
        $result=$conn->query($sql);
        if($result == true)
        {
            echo "Berhasil Upadate STATUS";
        }
        else
        {
            echo "Gagal Upadate STATUS";
        }
    }
?>