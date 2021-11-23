<?php


    session_start();

    include_once "../../user-page/conn.php";
  
    

    $awal=$_REQUEST["tgl_awal"];
    $akhir=$_REQUEST["tgl_akhir"];

    


    

    $query="
    select c.nama_pemilik,c.nama_perusahaan,avg(h.totalkeselurahan),c.id_cust
    from customer c, hjual h 
    where c.id_cust= h.id_cust and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir'
  
    GROUP by c.nama_pemilik 
    order by avg(h.totalkeselurahan) desc limit 5
    ";

?>

<script src="vendors/jquery/dist/jquery.js"></script>


<script>
     $(document).ready(function() {

      $('.detilPelanggan').click( function () {


          //console.log($(this).attr("id"));
          //alert($(this).attr("id"))
          
          var wal=$(this).attr("twal");
          var hir=$(this).attr("tkhir");
          var id=$(this).attr("id");
          var link="./detilLaporan/dLapPelanggan.php?id="+id+"&&tawal="+wal+"&&takhir="+hir;


          $("#detil").load(link);

      });




     })
</script>
      
        <table id="tablepelanggan" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nama customer</th>
                    <th>Nama Perusahaan</th>
                    <th>Aksi</th>
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
                    <td><button class="detilPelanggan" id="<?php echo $row[3];  ?>"   twal="<?php echo $awal ;?>"  tkhir="<?php echo $akhir ;?>"  >Detail</button></td>
                </tr>
            <?php
                  }
            
            ?>                          
            </tbody>
        </table>

        <table id="detil"  >

        </table>


<?php

?>

<script>
//event jika list pelanggan dipilih/diclick 
$('#tablepelanggan tbody').on('click', 'tr', function () {
            $(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
        } );
        //end of event jika list pelanggan dipilih/diclick 
</script>