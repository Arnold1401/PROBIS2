<?php

session_start();

include_once "../../user-page/conn.php";

$awal=$_REQUEST["tgl_awal"];
$akhir=$_REQUEST["tgl_akhir"];


     $query="
     
     select c.nama_perusahaan, p.tanggal_order, p.tanggal_pelunasan, p.sisa_waktu_pelunasan, p.tanggal_jatuh_tempo
     from customer c, hjual h, piutang p
     where c.id_cust= h.id_cust and p.tanggal_pelunasan >= '$awal' and p.tanggal_pelunasan <= '$akhir' and p.id_hjual=h.id_hjual and p.sisa_waktu_pelunasan < 0

     ";

     $query2="
     select c.nama_perusahaan, p.tanggal_order, p.tanggal_pelunasan, max(p.sisa_waktu_pelunasan), p.tanggal_jatuh_tempo
     from customer c, hjual h, piutang p
     where c.id_cust= h.id_cust and p.tanggal_pelunasan >= '$awal' and p.tanggal_pelunasan <= '$akhir' and p.id_hjual=h.id_hjual and p.sisa_waktu_pelunasan < 0

     ";

     $query3="
     
     select c.nama_perusahaan, p.tanggal_order, p.tanggal_pelunasan, min(p.sisa_waktu_pelunasan), p.tanggal_jatuh_tempo
     from customer c, hjual h, piutang p
     where c.id_cust= h.id_cust and p.tanggal_pelunasan >= '$awal' and p.tanggal_pelunasan <= '$akhir' and p.id_hjual=h.id_hjual and p.sisa_waktu_pelunasan < 0
     ";



     header("Content-type: application/vnd-ms-excel");
     header("Content-Disposition: attachment; filename=Laporan Piutang Keterlambatan.xls");
    

   




?>


<h1>Detail Laporan Piutang Keterlambatan</h1>

<table border=2 >

     <thead>
        <th>Nama Perusahaan</th>
        <th>Tanggal Order</th>
        <th>Tanggal Jatuh Tempo </th>
        <th>Tanggal Pelunasan</th>
        <th>Keterlambatan</th>
     </thead>
<?php

$data = mysqli_query(getConn(),$query);
while($row = mysqli_fetch_array($data))
{

?>

     <tr>
        <td><?php echo $row[0];?></td>
        <td><?php echo date("d-M-Y", strtotime($row[1]));?></td>
        <td><?php echo date("d-M-Y", strtotime($row[4]));?></td>
        <td><?php echo date("d-M-Y", strtotime($row[2]));?></td>
        <td><?php echo abs($row[3]);?> hari</td>
     </tr>


<?php

}
?>
     <tfoot>

          <?php
               $data = mysqli_query(getConn(),$query2);
               while($row = mysqli_fetch_array($data))
               {
          ?>
          <tr>
               <td>Perusahaan dengan Keterlambatan Tertinggi:</td>
               <td colspan=4 ><?php echo $row[0];?></td>
          </tr>

          <?php
               }

              
          ?>



         
          <!--
          <tr>
               <td>Rata-rata:</td>
               <td></td>
          </tr>
          --->
     </tfoot>

</table>



