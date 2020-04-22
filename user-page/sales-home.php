<?php
require_once("head.php");
include("conn.php");

$id=1;
?>

<!DOCTYPE html>
<html>
<head>
   
</head>
<body class="goto-here">
   
    <!-- header paling atas -->
    <div class="py-1 bg-primary">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                            <span class="text">+ 1234 5678 9100</span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                            <span class="text">emos@gmail.com</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END header paling atas -->

    <!-- nav -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
        <a class="navbar-brand" href="home.php">EMOS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="sales-home.php" class="nav-link">Home</a></li>
               
                <li class="nav-item"><a href="sales-listcustomer.php" class="nav-link">List CustomerKu</a></li>
                <li class="nav-item cta cta-colored"><a href="cart.php" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if(isset($_SESSION["nama_perusahaan"])){ echo $_SESSION["nama_perusahaan"];}?></a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                    <a class="dropdown-item" href="wishlist.php">Daftar Keinginan</a>
                    <a class="dropdown-item" href="status-order.php">Status Order</a>
                    <a class="dropdown-item" href="riwayat-trans.php">Riwayat Order</a>
                    <a class="dropdown-item" href="piutang.php">Piutang</a>
                    <a class="dropdown-item" href="ulasan.php">Ulasan</a>
                    <hr>
                    <a class="dropdown-item" href="pengaturan.php">Akun Saya</a>
                    <a class="dropdown-item" onclick="keluar()">Keluar</a>
                </div>
                </li>
            </ul>
        </div>
    </div>
    </nav>
    <!-- END nav -->

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">         	
            <h1 class="mb-0 bread">ORDER SAYA</h1>

          </div>
        </div>
      </div>
    </div>

    <!-- cart -->
    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                    <div class="form-group">                    
                      <small id="helpId" class="text-muted">*Pilih No order untuk melihat detail order Anda</small>
                    </div>
                    <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" >
                            <thead class="thead-primary">
                                <tr>
                                    <th>Tanggal Order</th>                                    
                                    <th>No Order</th>
                                  <!--  <th>Kurir Pengiriman</th>--->
                                    <th>Sales</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>


                            <?php
                                $query="
                                select h.tanggal, h.id_hjual, s.nama_sales,h.status_order
                                from hjual h ,sales s
                                where h.id_sales = s.id_sales and s.id_sales='$id'";
                                            $data = mysqli_query(getConn(),$query);
                                            while($row = mysqli_fetch_array($data))
                                            {
                            ?>
                                <tr>
                                    <td><?php echo $row[0];?></td>
                                    <td><?php echo $row[1];?></td>

                                    <td><?php echo $row[2];?></td>

                                    <td>
                                    <?php
                                        $n=$row[1];

                                  
                                            if($row[3]=="Proses"){
                                                echo"
                                                <select class='status_pengiriman' id=$n>
                                                <option value='Proses'>Proses </option>
                                                <option value='Pengiriman'>Pengiriman</option>
                                                   
                                                   
                                                    <option value='Selesai'>Selesai</option>
                                                    
                                                    
                                                </select>
                                                ";
                                            }else if($row[3]=="Pengiriman"){
                                                echo"
                                                <select class='status_pengiriman' id=$n>
                                                <option value='Pengiriman'>Pengiriman</option>
                                                    <option value='Proses'>Proses </option>
                                                   
                                                    <option value='Selesai'>Selesai</option>
                                                    
                                                    
                                                </select>
                                                ";
                                            }else if($row[3]=="Selesai"){

                                                echo"
                                                <select class='status_pengiriman' id=$n>
                                                    <option value='Selesai'>Selesai</option>
                                                    <option value='Proses'>Proses</option>
                                                    <option value='Pengiriman'>Pengiriman</option>
                                                </select>
                                                ";
                                            }

                                            

                                            

                                    ?>
                                  




                                    </td>

                                    <td>
                                        <button class="update_status"  id_pengiriman="<?php echo $row[1];?>" > Update</button>

                                    </td>
                                </tr>
                        <?php
                                            }
                        
                        ?>


                                    
                                    
                            </tbody>
                        </table>
                    </div>
                        
                    </div>
                </div>
            </div>


            
        </div>
    </section>
    <!-- end cart -->

    <!-- Modal untuk detail order -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">[No Order]</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    <!--end Modal -->

    <?php
    include_once('justfooter.php');
     ?>
     
   <script>


    $(".update_status").click(function(){


        var x= $(this).attr("id_pengiriman");
        
        var y='#'+x;

        var pilihan= $(y).children("option:selected").val();
        
       
        
        
        $.post("ajaxs/ajaxupdate.php",
        {
            status:pilihan,id:x,
        },
        function(data){
            
            if(data){

            window.location.href="#";
            }else{

                alert(data)
            }

          

          
        });
        


    });
 



    function keluar(){
        $.post("ajaxs/ajaxlogin.php",
        {
            jenis:"keluar",
        },
        function(data){
            window.location.href="login.php";
        });
    }
</script>
</body>
</html>