<?php

session_start();

include_once "../../user-page/conn.php";

$awal=$_REQUEST["tgl_awal"];
$akhir=$_REQUEST["tgl_akhir"];


     $query="
     
     select b.jenis_barang,b.nama_barang,d.subtotal,x.id_barang
     from djual d, barang b,hjual h, detail_barang x
     where x.id_barang=b.id_barang and h.id_hjual=d.id_hjual and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir' and x.id_detail_barang=d.id_detail_barang
 
     
     ";

     $query2="
     select b.jenis_barang,b.nama_barang,max(d.subtotal),x.id_barang
     from djual d, barang b,hjual h, detail_barang x
     where x.id_barang=b.id_barang and h.id_hjual=d.id_hjual and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir' and x.id_detail_barang=d.id_detail_barang
     

     ";

     $query3="
     
     select b.jenis_barang,b.nama_barang,min(d.subtotal),x.id_barang
     from djual d, barang b,hjual h, detail_barang x
     where x.id_barang=b.id_barang and h.id_hjual=d.id_hjual and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir' and x.id_detail_barang=d.id_detail_barang
    
     ";



     header("Content-type: application/vnd-ms-excel");
     header("Content-Disposition: attachment; filename=Data Pegawai.xls");
    

   




?>


<h1>Detail Perihal Laporan Barang</h1>

<table border=2 >

     <thead>
          <td>Kategori Barang</td>
          <td>Nama Barang</td>

          <td>Subtotal</td>
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



