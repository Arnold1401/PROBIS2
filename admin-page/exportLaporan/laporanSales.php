<?php

          session_start();

          include_once "../../user-page/conn.php";

          $awal=$_REQUEST["tgl_awal"];
          $akhir=$_REQUEST["tgl_akhir"];

          $query="



               select s.nama_sales,s.alamat,count(s.id_sales),s.id_sales


               from hjual h, customer c,sales s


               where h.id_cust=c.id_cust and c.id_sales=s.id_sales and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir'

               GROUP by s.nama_sales 
   



          ";

          
          $query2="

               select s.nama_sales,s.alamat,count(s.id_sales),s.id_sales


               from hjual h, customer c,sales s


               where h.id_cust=c.id_cust and c.id_sales=s.id_sales and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir'

               GROUP by s.nama_sales 
   
               order by count(s.id_sales) desc
               limit 1
          ";

          $query3="

               select s.nama_sales,s.alamat,count(s.id_sales),s.id_sales


               from hjual h, customer c,sales s


               where h.id_cust=c.id_cust and c.id_sales=s.id_sales and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir'

               GROUP by s.nama_sales 
   
               order by count(s.id_sales) asc
               limit 1
          ";

          

          header("Content-type: application/vnd-ms-excel");
          header("Content-Disposition: attachment; filename=Laporan Sales.xls");

?>


<h1>Detail Perihal Laporan Sales</h1>

<table border=2 >

     <thead>
          <td>Nama Sales</td>
          <td>Nama Perusahaan</td>

          <td>Alamat</td>
          
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
               <td colspan=2 ><?php echo $row[0];?></td>
          </tr>

          <?php
               }

               $data = mysqli_query(getConn(),$query3);
               while($row = mysqli_fetch_array($data))
                    {
          ?>



          <tr>
               <td>Minimum:</td>
               <td colspan=2 ><?php echo $row[0];?></td>
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
