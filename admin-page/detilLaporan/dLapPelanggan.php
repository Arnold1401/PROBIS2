<?php
    session_start();


    include_once "../../user-page/conn.php";
  
    $id=$_REQUEST["id"];
    $awal=$_REQUEST["tawal"];
    $akhir=$_REQUEST["takhir"];
    

    $query="
    select c.nama_pemilik,c.nama_perusahaan,h.grandtotal, h.tanggal_order
    from customer c, hjual h 
    where c.id_cust= h.id_cust and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir'
  
    and c.id_cust='$id'
    ";



?>
<br>
<h4>Detail Laporan Pelanggan</h4> <br>
<div class="table-responsive">
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nama Pemilik</th>
            <th>Nama Perusahaan</th>
            <th>Tanggal Order</th>
            <th>Grandtotal</th>
           
        </tr>
    </thead>
    <tbody>
    <?php
            $data = mysqli_query(getConn(),$query);
                while($row = mysqli_fetch_array($data))
    {
            
    ?>   
        <tr>  
            <td><?php echo $row[0];?></td>
            <td><?php echo $row[1];?></td>
            <td><?php echo date("d-M-Y", strtotime($row[3]));?></td>
            <td><?php echo "Rp ".number_format($row[2],0,",",".");?></td>
        </tr>
    </tbody>
<?php

    }


?>



</table>
</div>
<script src="vendors/jquery/dist/jquery.js"></script>