<?php


    session_start();

    include_once "../../user-page/conn.php";
  
    

    $awal=$_REQUEST["tgl_awal"];
    $akhir=$_REQUEST["tgl_akhir"];

    $query="
    select c.nama_perusahaan, avg(p.sisa_waktu_pelunasan), h.id_cust
    from customer c, hjual h, piutang p
    where c.id_cust= h.id_cust and p.tanggal_pelunasan >= '$awal' and p.tanggal_pelunasan <= '$akhir' and p.id_hjual=h.id_hjual and p.sisa_waktu_pelunasan < 0
  
    GROUP by c.nama_perusahaan
    order by p.sisa_waktu_pelunasan desc limit 5
    ";

?>
<script src="vendors/jquery/dist/jquery.js"></script>


<script>
     $(document).ready(function() {

      $('.detilPiutang').click( function () {
          console.log("a");

          //console.log($(this).attr("id"));
          //alert($(this).attr("id"))
          
          var wal=$(this).attr("twal");
          var hir=$(this).attr("tkhir");
          var id=$(this).attr("id");
          var link="./detilLaporan/dLapPiutang.php?id="+id+"&&tawal="+wal+"&&takhir="+hir;


          $("#detil").load(link);

      });




     })
</script>


      
        <table id="tablepiutang" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nama Perusahaan</th>
                    <th>Rata-rata keterlambatan</th>
                    <th>Aksi</th>
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
                    <td><button class="detilPiutang" id="<?php echo $row[2];  ?>"   twal="<?php echo $awal ;?>"  tkhir="<?php echo $akhir ;?>"  >Detail</button></td>
                </tr>
            <?php
                  }
            
            ?>                          
            </tbody>
        </table>

<?php

?>

<table id="detil"> 


</table>

<script>
//event jika list pelanggan dipilih/diclick 
$('#tablepiutang tbody').on('click', 'tr', function () {
            $(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
        } );
        //end of event jika list pelanggan dipilih/diclick 
</script>
