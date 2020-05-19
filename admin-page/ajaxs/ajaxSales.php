<?php


session_start();


include_once "../../user-page/conn.php";

$awal=$_REQUEST["tgl_awal"];
$akhir=$_REQUEST["tgl_akhir"];


$query="

        select s.nama_sales,s.alamat,count(s.id_sales)


        from hjual h, customer c,sales s


        where h.id_cust=c.id_cust and c.id_sales=s.id_sales and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir'

        GROUP by s.nama_sales 
           
        order by count(s.id_sales) desc
        limit 5;
";

?>

<table id="tablesales" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nama Sales</th>
            <th>Alamat</th>
           <!-- <th>Tingkat Kinerja</th>-->
        </tr>
    </thead>
        <tbody>    
        <?php
                                                $data = mysqli_query(getConn(),$query);
                                                while($row = mysqli_fetch_array($data))
                                                {
            
                                        ?>   
                                            <tr>  
                                            <td><?php echo $row[0];?></td>
                                            <td><?php echo $row[1];?></td>
                                            </tr>
                                        <?php
                                                }
            
                                        ?>   
                               
        </tbody>
</table>
