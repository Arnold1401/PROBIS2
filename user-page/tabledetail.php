<?php
    include("conn.php");
    require_once("head.php");
    $id= $_REQUEST["id"];


    $query="
    select  b.nama_barang, d.kuantiti,x.harga_jual, d.subtotal


    from djual d,  barang b, detail_barang x


    where  d.id_hjual='$id'
    and b.id_barang =x.id_barang
    and x.id_detail_barang=d.id_detail_barang
    ";

    $queryx="
        select totalkeselurahan, grandtotal


        from hjual 


        where id_hjual ='$id'
    
    ";


    $grandtotal = mysqli_query(getConn(),$queryx);
  
    $resultarr = mysqli_fetch_assoc($grandtotal);
?>


<table id="exampless" class="table table-striped table-bordered text-dark" >
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

                                    <td><?php echo "Rp ".number_format($row[2],0,",",".") ;?></td>
                                    <td><?php echo "Rp ".number_format($row[3],0,",",".") ;?></td>
</tr>

<?php

    }

?>
    
</tbody>
<tfoot>
    <tr>
        <th colspan="3" style="text-align:right; font-weight:bold">Grandtotal :</th>
        <th style="font-weight:bold"><?php echo "Rp ".number_format($resultarr["totalkeselurahan"],0,",",".") ;?></th>
    </tr>
    <tr>
        <th colspan="3" style="text-align:right; font-weight:bold">Sisa Tagihan (Jika pembayaran cicilan) :</th>
        <th style="font-weight:bold"><?php 
                if ($resultarr["grandtotal"] == $resultarr["totalkeselurahan"]) {
                    echo "-";
                }
                elseif ($resultarr["grandtotal"] < $resultarr["totalkeselurahan"]) {
                    $sisatag = $resultarr["totalkeselurahan"] - $resultarr["grandtotal"];
                    echo "Rp ".number_format($sisatag,0,",",".") ;
                }
        ?></th>
    </tr>
</tfoot>

</table>