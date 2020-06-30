<?php

session_start();

include_once "../../user-page/conn.php";



$awal=$_REQUEST["tgl_awal"];
$akhir=$_REQUEST["tgl_akhir"];


$query="

select keuntungan,tanggal_order,id_hjual

from  hjual 


where tanggal_order >= '$awal' and tanggal_order <= '$akhir' and status_order != 'Batal' and status_pembayaran != 'Menunggu Pelunasan'


";




$t="

select sum(keuntungan),tanggal_order

from  hjual 


where tanggal_order >= '$awal' and tanggal_order <= '$akhir' and status_order != 'Batal' and status_pembayaran != 'Menunggu Pelunasan'

";



header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Keuntungan.xls");



?>
<h1>Laporan keuntungan</h1>
  <table border=1>
        <thead>
            <tr>
                <th>Nomor Pesanan </th>
                <th>Tanggal</th>
                <th>Keuntungan</th>
            </tr>
        </thead>

        <tbody>

        <?php
               $data = mysqli_query(getConn(),$query);
               while($row = mysqli_fetch_array($data))
               {
        ?>
            <tr>
                <td><?php echo $row[2]; ?>
                <td><?php echo date("d-M-Y", strtotime($row[1]));?></td>
                <td><?php echo "Rp ".number_format($row[0],0,",",".");?></td>
            </tr>

        <?php
               }
        
        ?>
        </tbody>

        <tfoot>
            <?php
                 $data = mysqli_query(getConn(),$t);
                 while($row = mysqli_fetch_array($data))
                 {
            ?>
            <tr>
                <td> <b>Total Keuntungan</b></td>
                <td> <b> <?php echo "Rp ".number_format($row[0],0,",",".");?></b></td>
            <tr>

            <?php
                 }
            ?>
        </tfoot>
        
    </table>



