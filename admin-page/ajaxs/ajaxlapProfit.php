<?php

session_start();


include_once "../../user-page/conn.php";

$awal=$_REQUEST["tgl_awal"];
$akhir=$_REQUEST["tgl_akhir"];


    $query="

        select keuntungan,tanggal_order

        from  hjual 


        where tanggal_order >= '$awal' and tanggal_order <= '$akhir' and status_order != 'Batal' and status_pembayaran != 'Menunggu Pelunasan'


    ";

    /*
    $n=0;
    function total($x){
        $n+=$x;

    }

    function ttl(){
        return $n;
    }
    */


    $t="
	 select sum(keuntungan),tanggal_order

        from  hjual 


        where tanggal_order >= '$awal' and tanggal_order <= '$akhir' and status_order != 'Batal' and status_pembayaran != 'Menunggu Pelunasan'
           
    ";


?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>Tanggal</td>
                <td>Keuntungan</td>
            </tr>
        </thead>

        <tbody>

        <?php
               $data = mysqli_query(getConn(),$query);
               while($row = mysqli_fetch_array($data))
               {
        ?>
            <tr>
                <td><?php echo date("d-M-Y", strtotime($row[1]));?></td>
                <td><?php echo "Rp ".number_format($row[0],0,",",".");?></td>
            </tr>

        <?php
               }
        
        ?>
        </tbody>

        <tfoot>
            <?php
                 $data = mysqli_query(getConn(),$t);
                 while($row = mysqli_fetch_array($data))
                 {
            ?>
            <tr>
                <td> <b>Total Keuntungan</b></td>
                <td> <b> <?php echo "Rp ".number_format($row[0],0,",",".");?></b></td>
            <tr>

            <?php
                 }
            ?>
        </tfoot>
        
    </table>



<?php

    
            
?>