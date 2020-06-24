<?php

session_start();


include_once "../../user-page/conn.php";

$id=$_REQUEST["id"];
$awal=$_REQUEST["tawal"];
$akhir=$_REQUEST["takhir"];

$query="

        select s.nama_sales,s.alamat,c.nama_pemilik


        from hjual h, customer c,sales s


        where h.id_cust=c.id_cust and c.id_sales=s.id_sales and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir'
        and s.id_sales='$id'

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
        <td>Nama Sales</td>
        <td>Alamat</td>
        <td>Nama pemilik</td>
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