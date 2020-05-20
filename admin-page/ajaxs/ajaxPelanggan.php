<?php


    session_start();

    include_once "../../user-page/conn.php";
  
    

    $awal=$_REQUEST["tgl_awal"];
    $akhir=$_REQUEST["tgl_akhir"];

    


    

    $query="
    select c.nama_pemilik,c.nama_perusahaan,avg(h.grandtotal)
    from customer c, hjual h 
    where c.id_cust= h.id_cust and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir'
  
    GROUP by c.nama_pemilik 
    order by avg(h.grandtotal) desc limit 5
    ";

?>


      
        <table id="tablepelanggan" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nama customer</th>
                    <th>Nama Perusahaan</th>
                    <!--<th>Alamat</th>-->
                    <!---<th>Tingkat Keuntungan</th>-->
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