
<?php
  session_start();


  include_once "../../user-page/conn.php";

  $id=$_REQUEST["id"];
  $awal=$_REQUEST["tawal"];
  $akhir=$_REQUEST["takhir"];

 

  $query="
    select b.jenis_barang,b.nama_barang,d.subtotal


    from djual d, barang b,hjual h, detail_barang x



    where x.id_barang=b.id_barang and h.id_hjual=d.id_hjual and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir' and x.id_detail_barang=d.id_detail_barang
    and x.id_barang='$id'


    
     
    

    
  
  
  
  ";
    
?>
<style>
table, th, td {
  border: 1px solid black;
}
</style>


<table border=2 >
    <thead>
      <tr>
        <td>Nama Barang</td>
        <td>Jenis Barang</td>
        <td>Subtotal</td>
      </tr>
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

</table>