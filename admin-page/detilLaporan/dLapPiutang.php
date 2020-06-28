
<?php
  session_start();


  include_once "../../user-page/conn.php";

  $id=$_REQUEST["id"];
  $awal=$_REQUEST["tawal"];
  $akhir=$_REQUEST["takhir"];

 

  $query="
  select c.nama_perusahaan, p.tanggal_order, p.tanggal_pelunasan, p.sisa_waktu_pelunasan, p.tanggal_jatuh_tempo
  from customer c, hjual h, piutang p
  where c.id_cust= h.id_cust and p.tanggal_pelunasan >= '$awal' and p.tanggal_pelunasan <= '$akhir' and p.id_hjual=h.id_hjual and p.sisa_waktu_pelunasan < 0 and h.id_cust='$id'

  ";
    
?>
<br>
<h4>Detail Laporan Barang</h4> <br>
<div class="table-responsive">
<table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Nama Perusahaan</th>
        <th>Tanggal Order</th>
        <th>Tanggal Jatuh Tempo </th>
        <th>Tanggal Pelunasan</th>
        <th>Keterlambatan</th>
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
                                            <td><?php echo date("d-M-Y", strtotime($row[1]));?></td>
                                            <td><?php echo date("d-M-Y", strtotime($row[4]));?></td>
                                            <td><?php echo date("d-M-Y", strtotime($row[2]));?></td>
                                            <td><?php echo abs($row[3]);?> hari</td>
                                            </tr>
                                            </tbody>
<?php

    }


?>

</table>
</div>
<script src="vendors/jquery/dist/jquery.js"></script>