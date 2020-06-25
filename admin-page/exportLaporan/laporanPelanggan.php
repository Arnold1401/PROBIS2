<?php

session_start();

include_once "../../user-page/conn.php";

$awal=$_REQUEST["tgl_awal"];
$akhir=$_REQUEST["tgl_akhir"];


     

     $query="
     select c.nama_pemilik,c.nama_perusahaan,h.grandtotal,c.id_cust
     from customer c, hjual h 
     where c.id_cust= h.id_cust and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir'
   
 
     ";

     $query2="
     select c.nama_pemilik,c.nama_perusahaan,max(h.grandtotal),c.id_cust
     from customer c, hjual h 
     where c.id_cust= h.id_cust and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir'
     ";

     $query3="
     select c.nama_pemilik,c.nama_perusahaan,min(h.grandtotal),c.id_cust
     from customer c, hjual h 
     where c.id_cust= h.id_cust and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir'
     ";



     header("Content-type: application/vnd-ms-excel");
     header("Content-Disposition: attachment; filename=Data Pegawai.xls");
    

   




?>


<h1>Detail Perihal Laporan Pelanggan</h1>

<table border=2 >

     <thead>
          <td>Nama Pemilik</td>
          <td>Nama Perusahaan</td>

          <td>Grandtotal</td>
          
     </thead>
<?php

$data = mysqli_query(getConn(),$query);
while($row = mysqli_fetch_array($data))
{

?>

     <tr>
          <td><?php echo $row[0];?></td>

          <td><?php echo $row[1];?></td>
          <td><?php echo $row[2];?></td>
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
               <td>Maksimum:</td>
               <td colspan=2 ><?php echo $row[1];?></td>
          </tr>

          <?php
               }

               $data = mysqli_query(getConn(),$query3);
               while($row = mysqli_fetch_array($data))
                    {
          ?>



          <tr>
               <td>Minimum:</td>
               <td colspan=2 ><?php echo $row[1];?></td>
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



