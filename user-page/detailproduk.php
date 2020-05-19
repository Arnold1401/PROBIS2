<?php
require_once("head.php");
include_once "conn.php";

$boleh = false;
          $pid = "";
          $nama = "";
          $harga = "";
          $foto = "";
          $desk = "";
          if (isset($_GET["pid"])) {
            if ($_GET["pid"] != "") {
              $boleh = true;
              $pid = $_GET["pid"];
            } else {
              //header("location:produk.php");
            }
          } else {
            //header("location:produk.php");
          }
         
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
          <li class="nav-item active"><a href="home.php" class="nav-link">Beranda</a></li>

          <li class="nav-item"><a href="produk.php" class="nav-link">Produk</a></li>
          <li class="nav-item cta cta-colored"><a href="cart.php" class="nav-link"><span class="icon-shopping_cart"></span>[<?php if (isset($_SESSION["keranjang"])) {
                                                                                                                              $arrkeranjang = unserialize($_SESSION["keranjang"]);
                                                                                                                              $count = count($arrkeranjang);
                                                                                                                              echo $count;
                                                                                                                            } else {
                                                                                                                              echo 0;
                                                                                                                            }
                                                                                                                            ?>]</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if (isset($_SESSION["nama_perusahaan"])) {
                                                                                                                                              echo $_SESSION["nama_perusahaan"];
                                                                                                                                            } ?></a>
            <div class="dropdown-menu" aria-labelledby="dropdown04">
                <a class="dropdown-item" href="wishlist.php">Daftar Keinginan</a>
                <a class="dropdown-item" href="status-order.php">Daftar Pesanan</a>
                <a class="dropdown-item" href="tagihan.php">Tagihan</a>
                <a class="dropdown-item" href="ulasan.php">Ulasan</a>
                <hr>
                <a class="dropdown-item" href="pengaturan.php">Akun Saya</a>
                <a onclick="keluar()" class="dropdown-item">Keluar</a>
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
          <h1 class="mb-0 bread">DETAIL PRODUK</h1>

        </div>
      </div>
    </div>
  </div>


  <!-- DETAIL PRODUK -->
  <section class="ftco-section">
    <div class="container">
      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-detail-tab" data-toggle="tab" href="#nav-detail" role="tab" aria-controls="nav-detail" aria-selected="true">Detail</a>
          <a class="nav-item nav-link" id="nav-ulasan-tab" data-toggle="tab" href="#nav-ulasan" role="tab" aria-controls="nav-ulasan" aria-selected="false">Ulasan
          <!-- byk ulasan -->
          <?php
            $kal="";
            $conn=getConn();
            $sql2 = "select count(id_ulasan) as ulasan from ulasan where id_barang='$pid'";
              $statement2 = $conn->prepare($sql2);
              $statement2->execute();
              $result2 = $statement2->get_result();
              foreach ($result2 as $row2) {
                $ulasan = $row2["ulasan"];
                $kal.=" ($ulasan)";
            }
            $conn->close();
            echo $kal;
          ?>
          <!-- end of byk ulasan -->
          </a>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-detail" role="tabpanel" aria-labelledby="nav-detail-tab">
          <!-- isi detail produk -->
          <?php
          $boleh = false;
          $pid = "";
          $nama = "";
          $harga = "";
          $foto = "";
          $desk = "";
          if (isset($_GET["pid"])) {
            if ($_GET["pid"] != "") {
              $boleh = true;
              $pid = $_GET["pid"];
            } else {
              //header("location:produk.php");
            }
          } else {
            //header("location:produk.php");
          }
          include_once "conn.php";
          $conn = getConn();
          if ($boleh) {
            $sql = "select * from barang where id_barang='$pid'";
            $statement = $conn->prepare($sql);
            $statement->execute();
            $result = $statement->get_result();
            foreach ($result as $row) {
              $id = $row["id_barang"];
              $nama = $row['nama_barang'];
              $harga = $row['harga_jual'];
              $foto = "../admin-page/".$row['foto_barang'];
              $desk = $row['deskripsi_barang'];
              $fharga = number_format($harga);
            }
            $conn->close();
          }

          ?>
          <div class="row py-2">
            <div class="col-lg-6 mb-5 ftco-animate">
              <a href="images/product-1.jpg" class="image-popup"><img src="<?php echo $foto; ?>" class="img-fluid" alt="Colorlib Template"></a>
            </div>
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
              <h3><?php echo $nama; ?></h3>

              <p class="price"><span><?php echo "Rp.".number_format($harga,2); ?></span></p>
              <p><?php echo $desk; ?></p>
              <div class="row mt-4">
                <div class="col-md-6">
                  <div class="form-group d-flex">
                    <div class="select-wrap">
                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                     

                    
                      <select name="" id="satuan" class="form-control">

                        <?php
                          $kal="";
                          $conn=getConn();
                        $sql1 = "select s.id_satuan as idsat,s.nama_satuan as sat from barang b,satuan s where b.id_satuan=s.id_satuan and b.id_barang='$pid'";
                         $statement1 = $conn->prepare($sql1);
                         $statement1->execute();
                         $result1 = $statement1->get_result();
                         foreach ($result1 as $row1) {
                           $idsat = $row1["idsat"];
                           $sat = $row1["sat"];
                           $kal.="<option value='$idsat'>$sat</option>";
                        }
                        $conn->close();
                        echo $kal;
                     ?>
                      </select>

                    </div>
                  </div>
                </div>
                <div class="w-100"></div>
                <div class="input-group col-md-6 d-flex mb-3">
                  <span class="input-group-btn mr-2">
                    <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                      <i class="ion-ios-remove"></i>
                    </button>
                  </span>
                  <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                  <span class="input-group-btn ml-2">
                    <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                      <i class="ion-ios-add"></i>
                    </button>
                  </span>
                </div>
                <div class="w-100"></div>
                <div class="col-md-12">
                  <p style="color: #000;">Stok tersedia</p>
                </div>
              </div>
              <p><a href="cart.php" onclick=<?php echo "\"addtocart('$pid')\""; ?> class="btn btn-black py-3 px-5">Tambah Ke Keranjang</a></p>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="nav-ulasan" role="tabpanel" aria-labelledby="nav-ulasan-tab">
          <div class="row py-4">
            <div class="col-md-12 ftco-animate">
            <form>
            <h6> <?php echo $nama; ?> </h6>
                        <?php
                        
                        $kal="";
                        $conn=getConn();
                        $sql2 = "select avg(rating) as rate, count(id_ulasan) as ulasan from ulasan where id_barang='$pid'";
                         $statement2 = $conn->prepare($sql2);
                         $statement2->execute();
                         $result2 = $statement2->get_result();
                         foreach ($result2 as $row2) {
                           $ulasan = $row2["ulasan"];
                           $rate = $row2["rate"];
                          // $isi = $row2["isi"];
                           $bintang="";
                           $pad=5-$rate;
                           if ($rate == 0) {
                             $kal.="Belum ada ulasan";
                           }
                           else if ($rate != 0) {
                            for ($i=0; $i <$rate; $i++) { 
                              $bintang.="<span><i class='ion-ios-star' style='color: goldenrod;font-size: 2.0rem;padding: 0 0rem;'></i></span>";
                            }
                            for ($i=0; $i <$pad ; $i++) { 
                              $bintang.="<span><i class='ion-ios-star-outline' style='font-size: 2.0rem;padding: 0 0rem;'></i></span>";
                            }
                            $kal.="
                               <h1>$rate <span style='font-size:18pt;'> /5 </span></h1>
                              <p>$bintang </p>
                              <p>($ulasan) ulasan</p>
                          ";
                           }
                           
                        }
                        $conn->close();
                        echo $kal;
                     ?>
                        
            </form>

            <!-- rating dan ulasan dari customer -->
              <form>
                <div class="table-responsive">
                  <table class="table table-sm">
                    <tbody>
                    <?php
                        $kal="";
                        $conn=getConn();
                        $sql2 = "select c.nama_pemilik as nama ,u.rating as rate ,u.isi_review as isi from ulasan u,customer c where c.id_cust=u.id_cust and u.id_barang='$pid'";
                         $statement2 = $conn->prepare($sql2);
                         $statement2->execute();
                         $result2 = $statement2->get_result();
                         foreach ($result2 as $row2) {
                           $nama = $row2["nama"];
                           $rate = $row2["rate"];
                           $isi = $row2["isi"];
                           $bintang="";
                           $pad=5-$rate;
                           for ($i=0; $i <$rate; $i++) { 
                            $bintang.="<span><i class='ion-ios-star' style='color: goldenrod;font-size: 1.8rem;padding: 0 0rem;'></i></span>";
                           }
                           for ($i=0; $i <$pad ; $i++) { 
                            $bintang.="<span><i class='ion-ios-star-outline' style='font-size: 1.8rem;padding: 0 0rem;'></i></span>";
                           }
                           $kal.="       <tr>
                           <td><img src='images/smile.png' alt='' width='50px' height='45px' style='margin-right:10px'>   $nama</td>
                           <td>
                             <p>$bintang $rate/5</p>
                             <p>$isi</p>
                           </td>
   
                         </tr>";
                        }
                        $conn->close();
                        echo $kal;
                     ?>
                    </tbody>
                  </table>
                </div>
              </form>
              <!--end of  rating dan ulasan dari customer -->
            </div>
          </div>
        </div>
      </div>


    </div>
  </section>

  <?php
  include_once('justfooter.php')
  ?>



  <script>
    function keluar() {
      $.post("ajaxs/ajaxlogin.php", {
          jenis: "keluar",
        },
        function(data) {
          window.location.href = "login.php";
        });
    }

    function addcart(params) {
      $.ajax({
        url: "ajaxs/ajaxcart.php",
        method: "POST",
        data: {
          jenis: 'additem',
          idbarang: params,
        },
        success: function(data) {
          console.log(data);
        }
      });
    }

  </script>
</body>

</html>