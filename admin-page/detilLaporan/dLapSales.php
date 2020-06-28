<?php

session_start();


include_once "../../user-page/conn.php";

$id=$_REQUEST["id"];
$awal=$_REQUEST["tawal"];
$akhir=$_REQUEST["takhir"];

$query="

        select s.nama_sales,s.alamat,c.nama_perusahaan, h.tanggal_order


        from hjual h, customer c,sales s


        where h.id_cust=c.id_cust and c.id_sales=s.id_sales and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir'
        and s.id_sales='$id'

";

?>
<br>
<h4>Detail Laporan Sales</h4> <br>
<div class="table-responsive">
<table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Nama Sales</th>
        <th>Bertanggung Jawab atas Pelanggan</th>
        <th>Tanggal Pesanan</th>
      </tr>
    </thead>
    <?php
            $data = mysqli_query(getConn(),$query);
                while($row = mysqli_fetch_array($data))
    {
            
    ?>   
    <tbody>
     <tr>  
                                            <td><?php echo $row[0];?></td>
                                            
                                            <td><?php echo $row[2];?></td>
                                            <td><?php echo date("d-M-Y", strtotime($row[3]));?></td>
                                            </tr></tbody>
<?php

    }


?>

</table>
</div>
<script src="vendors/jquery/dist/jquery.js"></script>