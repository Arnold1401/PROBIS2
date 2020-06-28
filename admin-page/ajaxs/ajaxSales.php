<?php


session_start();


include_once "../../user-page/conn.php";

$awal=$_REQUEST["tgl_awal"];
$akhir=$_REQUEST["tgl_akhir"];


$query="

        select s.nama_sales,s.alamat,count(s.id_sales),s.id_sales


        from hjual h, customer c,sales s


        where h.id_cust=c.id_cust and c.id_sales=s.id_sales and h.tanggal_order >= '$awal' and h.tanggal_order <= '$akhir'

        GROUP by s.nama_sales 
           
        order by count(s.id_sales) desc
        limit 5;
";

?>

<script src="vendors/jquery/dist/jquery.js"></script>


<script>
     $(document).ready(function() {

      $('.detilSales').click( function () {


          //console.log($(this).attr("id"));
          //alert($(this).attr("id"))
          
          var wal=$(this).attr("twal");
          var hir=$(this).attr("tkhir");
          var id=$(this).attr("id");
          var link="./detilLaporan/dLapSales.php?id="+id+"&&tawal="+wal+"&&takhir="+hir;


          $("#detil").load(link);

      });




     })
</script>

<table id="tablesales" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nama Sales</th>
            <th>Alamat</th>
            <th>Aksi</th>
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
                                            <td><button class="detilSales" id="<?php echo $row[3];  ?>"   twal="<?php echo $awal ;?>"  tkhir="<?php echo $akhir ;?>"  >Detail</button></td>
                                            </tr>
                                        <?php
                                                }
            
                                        ?>   
                               
        </tbody>
</table>


<table id="detil"> 


</table>

<script>
//event jika list pelanggan dipilih/diclick 
$('#tablesales tbody').on('click', 'tr', function () {
            $(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
        } );
        //end of event jika list pelanggan dipilih/diclick 
</script>

