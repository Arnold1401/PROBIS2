<?php


    session_start();

    include_once "../../user-page/conn.php";
  
    

    $awal=$_REQUEST["tgl_awal"];
    $akhir=$_REQUEST["tgl_akhir"];

    


    

    $query="
    select c.nama_perusahaan, avg(p.sisa_waktu_pelunasan)
    from customer c, hjual h, piutang p
    where c.id_cust= h.id_cust and p.tanggal_pelunasan >= '$awal' and p.tanggal_pelunasan <= '$akhir' and p.id_hjual=h.id_hjual and p.sisa_waktu_pelunasan < 0
  
    GROUP by c.nama_perusahaan
    order by p.sisa_waktu_pelunasan desc limit 5
    ";

?>


      
        <table id="tablepelanggan" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nama Perusahaan</th>
                    <th>Rata-rata keterlambatan</th>
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
                    <td><?php echo abs($row[1]);?> hari</td>
                </tr>
            <?php
                  }
            
            ?>                          
            </tbody>
        </table>

<?php

?>