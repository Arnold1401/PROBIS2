
<?php
  session_start();


  include_once "../../user-page/conn.php";

  $id=$_REQUEST["id"];
  $awal=$_REQUEST["tawal"];
  $akhir=$_REQUEST["takhir"];

 

  $query="
    select b.jenis_barang,b.nama_barang,d.subtotal, c.nama_perusahaan, d.kuantiti


    from djual d, barang b,hjual h, detail_barang x, customer c



    where x.id_barang=b.id_barang and h.id_hjual=d.id_hjual and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir' and x.id_detail_barang=d.id_detail_barang
    and x.id_barang='$id' and h.id_cust=c.id_cust


    
     
    

    
  
  
  
  ";
    
?>
<br>
<h4>Detail Laporan Barang</h4> <br>
<div class="table-responsive">
<table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Kategori Barang</th>
        <th>Nama Barang</th>
        <th>Pembeli</th>
        <th>Kuantiti</th>
        <th>Subtotal</th>
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
                                            <td><?php echo $row[1];?></td>
                                            <td><?php echo $row[3];?></td>
                                            <td><?php echo $row[4];?></td>
                                            <td><?php echo "Rp ".number_format($row[2],0,",",".");?></td>
                                            </tr>
                                            </tbody>
<?php

    }


?>

</table>
</div>
<script src="vendors/jquery/dist/jquery.js"></script>