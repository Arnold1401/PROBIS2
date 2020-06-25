<?php
    include("conn.php");
    require_once("head.php");
    $id= $_REQUEST["id"];


    $query="
    select h.tanggal_order, h.id_hjual, c.nama_perusahaan,h.status_order,h.id_cust,h.id_alamatpengiriman

                                from  hjual h, customer c, sales s


                                where  c.id_cust=h.id_cust and s.id_sales=c.id_sales and h.id_sales=$id and h.status_pembayaran != 'Menunggu Pembayaran' and h.status_order != 'Batal' and h.status_order != 'Selesai'
    ";

    $queryx="
        select totalkeselurahan


        from hjual 


        where id_hjual ='$id'
    
    ";


    $data = mysqli_query(getConn(),$query);
?>

<div class="table-responsive">
<table id="example" class="table table-striped table-bordered text-dark" >
                            <thead class="thead-primary">
                            <tr>
                                <th>No Pesanan</th>
                                    <th>Tanggal Pesan</th>                                    
                                    <th>Pelanggan</th>
                                    <th>Status Pesanan</th>
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
            <td><?php echo $row[1];?></td>
            <td><?php 
            echo date("d-M-Y", strtotime($row['0']));
            
            ?></td>

            <td><?php echo $row[2];?></td>

            <td>
            <?php
                $n=$row[1];

                    
                    if($row[3]=="Proses"){
                        echo "<label class='text-success font-weight-bold'>Proses</label> ";
                        /* echo"
                         <select class='status_pengiriman' id='$n'>
                         <option value='Proses'>Proses </option>
                         <option value='Pengiriman'>Pengiriman</option>
                     
                     
                             <option value='Sampai Tujuan'>Sampai Tujuan</option>
                      
                      
                         </select>
                         ";*/
                    }
                
                    else if($row[3]=="Pengiriman"){
                        echo "<label class='text-warning font-weight-bold'>Pengiriman</label>";
                       /* echo"
                        <select class='status_pengiriman' id='$n'>
                        <option value='Pengiriman'>Pengiriman</option>
                        <option value='Proses'>Proses </option>
                           
                            <option value='Sampai Tujuan'>Sampai Tujuan</option>
                            
                            
                        </select>
                        ";*/
                    }
                    else if($row[3]=="Sampai Tujuan"){
                        echo "<label class='text-info font-weight-bold'>Barang telah tiba</label>";

                        /*echo"
                        <select class='status_pengiriman' id='$n'>
                        <option value='Sampai Tujuan'>Sampai Tujuan</option>
                         
                            <option value='Proses'>Proses </option>
                            <option value='Pengiriman'>Pengiriman</option>
                        </select>
                        ";*/
                    }
                    

                    

                    

            ?>
            </td>
            
            <td>
                <?php
                    if($row[3]=="Pengiriman"){ ?>
                        <a id="update_status" class='btn btn-info text-dark' id_pengiriman="<?php echo $row[1];?>" >Sampai Tujuan</a>
                        
                    <?php }
                    if($row[3]!="Pengiriman"){ ?>
                        <a class='btn btn-info text-dark disabled' id_pengiriman="<?php echo $row[1];?>" >Sampai Tujuan</a>
                    <?php }
                ?>                                        
                <a class="btn_detail btn btn-info text-dark"  id_pengiriman="<?php echo $row[1];?>" id_cust="<?php echo $row[4];?>" id_alamat="<?php echo $row[5];?>"  >Detail</a>
            </td>
        </tr>
<?php
                    }

?>

</tbody>

</table>
</div>

<script>
var $id = "<?php if(isset($_SESSION["id_sales"])){ echo $_SESSION["id_sales"];}?>";
    $(document).ready(function () {
       
    });
    
//event jika list order dipilih/diclick 
$('#example tbody').on('click', 'tr', function () {
            $(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
    } );

    $(".btn_detail").click(function(){
        
        // $("#details").empty();
         var x= $(this).attr("id_pengiriman"); //no order
         console.log(x);
         var link= "tabledetail.php?id="+x;
         $("#details").load(link);
 
         var idcust= $(this).attr("id_cust"); //idcust
         var getIdAlamat = $(this).attr("id_alamat"); //id alamat
         //dapatkan data customernya
         $("#idhjual").html(x);
         //DETAIL CUSTOMERNYA -- nama notelp
         $.post("ajaxreseller.php",{
             jenis:"get_detail_customerHutang",
             idcust:idcust,
         },
         function(data){                 
             $("#namapemilik").html(data[2]);
             $("#nomorpemilik").html(data[3]);
         });
 
         //alamat customernya
         $.post("ajaxreseller.php",{
             jenis:"get_detailalamat_customerHutang",
             getIdAlamat:getIdAlamat,
         },
         function(data){                 
             var provinsi = data[0].split("-");
             var kota = data[1].split("-");
             var kec = data[2].split("-");
             var alamat = data[3] + ", <br> Kecamatan " + kec[1] + ", <br> Kota " + kota[1] + ", <br> Provinsi "+ provinsi[1] ;
             $("#alamatpemilik").html(alamat);
         });
         //end of dapatkan data customernya
 
     })
 
     $("#update_status").click(function(){
         
        alert('satu');
         var x= $(this).attr("id_pengiriman");
         
         /*var y='#'+x;
 
         var pilihan= $(y).children("option:selected").val();*/
         var pilihan = "Sampai Tujuan";
         console.log(x);
        
         
         
         $.post("ajaxs/ajaxupdate.php",
         {
             status:pilihan,id:x,
         },
         function(data){
             
             if(data){
                 alert("Berhasil Konfirmasi Status Pesanan");
                 //$('#example').refresh();
                 var link= "tabelhome.php?id="+$id;
                $("#example").load(link);
             
             }else{
 
                 alert(data)
 
             }
 
           
 
           
         });
         
 
 
     });
 
    //end of event jika list order dipilih/diclick 
</script>

