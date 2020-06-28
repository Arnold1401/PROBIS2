<?php


    session_start();


    include_once "../../user-page/conn.php";

    $awal=$_REQUEST["tgl_awal"];
    $akhir=$_REQUEST["tgl_akhir"];

    $query="
           select b.jenis_barang,b.nama_barang,avg(d.subtotal),x.id_barang
           from djual d, barang b,hjual h, detail_barang x
           where x.id_barang=b.id_barang and h.id_hjual=d.id_hjual and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir' and x.id_detail_barang=d.id_detail_barang
           GROUP by b.nama_barang 
           
           order by avg(d.subtotal) desc
           limit 5;
    ";

?>
  <script src="vendors/jquery/dist/jquery.js"></script>


  <script>
       $(document).ready(function() {

        $('.detilBarang').click( function () {


            //console.log($(this).attr("id"));
            //alert($(this).attr("id"))
            
            var wal=$(this).attr("twal");
            var hir=$(this).attr("tkhir");
            var id=$(this).attr("id");
            var link="./detilLaporan/dLapBarang.php?id="+id+"&&tawal="+wal+"&&takhir="+hir;


            $("#detil").load(link);

        });




       })
  </script>
                        <table id="tablebarang" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kategori Barang</th>
                                            <th>Nama Barang</th>
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
                                            <td><?php echo $row[1];?></td>
                                            <td><button class="detilBarang" id="<?php echo $row[3];  ?>"   twal="<?php echo $awal ;?>"  tkhir="<?php echo $akhir ;?>"  >Detail</button></td>
                                            </tr>
                                        <?php
                                                }
            
                                        ?>   

                                    </tbody>
                            </table>

                            <table id="detil" >

                            </table>


                            
    <?php
    
    ?>

<script>
//event jika list pelanggan dipilih/diclick 
$('#tablebarang tbody').on('click', 'tr', function () {
            $(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
        } );
        //end of event jika list pelanggan dipilih/diclick 
</script>

