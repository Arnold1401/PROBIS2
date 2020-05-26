<?php
    include("conn.php");
    require_once("head.php");
    $id= $_REQUEST["id"];


    $query="
    select  b.nama_barang, d.kuantiti,b.harga_jual, d.subtotal


    from djual d,  barang b


    where  d.id_hjual='$id'
    and b.id_barang =d.id_barang 

    ";

    $queryx="
        select grandtotal


        from hjual 


        where id_hjual ='$id'
    
    ";


    $grandtotal = mysqli_query(getConn(),$queryx);
  
    $resultarr = mysqli_fetch_assoc($grandtotal);
?>


<table id="example" class="table table-striped table-bordered" >
                            <thead class="thead-primary">
                                <tr>
                                    <th>Nama Barang</th>                                    
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
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

                                    <td><?php echo $row[2];?></td>
                                    <td><?php echo $row[3];?></td>
</tr>

<?php

    }

?>
    <tr>
        <td colspan=2></td>
        <td>Grand total</td>
        <td><?php echo $resultarr["grandtotal"];?></td>
    </tr>
</tbody>

</table>