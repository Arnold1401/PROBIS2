<?php
    session_start();


    include_once "../../user-page/conn.php";
  
    $id=$_REQUEST["id"];
    $awal=$_REQUEST["tawal"];
    $akhir=$_REQUEST["takhir"];
    

    $query="
    select c.nama_pemilik,c.nama_perusahaan,h.grandtotal
    from customer c, hjual h 
    where c.id_cust= h.id_cust and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir'
  
    and c.id_cust='$id'
    ";



?>
<style>
table, th, td {
  border: 1px solid black;
}
</style>
<table border=1 >
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



</table>