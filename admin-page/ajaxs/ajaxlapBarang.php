<?php


    session_start();


    include_once "../../user-page/conn.php";

    $awal=$_REQUEST["tgl_awal"];
    $akhir=$_REQUEST["tgl_akhir"];

    $query="
           select b.jenis_barang,b.nama_barang,avg(d.subtotal)
           from djual d, barang b,hjual h, detail_barang x
           where x.id_barang=b.id_barang and h.id_hjual=d.id_hjual and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir' and x.id_detail_barang=d.id_detail_barang
           GROUP by b.nama_barang 
           
           order by avg(d.subtotal) desc
           limit 5;
    ";

?>
                        <table id="tablebarang" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kategori Barang</th>
                                            <th>Nama Barang</th>
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


    <?php
    
    ?>

