<?php
require_once("head.php");
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
          <li class="nav-item active"><a href="home.php" class="nav-link">Home</a></li>

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
              <a class="dropdown-item" href="status-order.php">Daftar Order</a>
              <!-- <a class="dropdown-item" href="riwayat-trans.php">Riwayat Order</a> -->
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
          <a class="nav-item nav-link" id="nav-ulasan-tab" data-toggle="tab" href="#nav-ulasan" role="tab" aria-controls="nav-ulasan" aria-selected="false">Ulasan</a>
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
              $foto = $row['foto_barang'];
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

              <p class="price"><span><?php echo $harga; ?></span></p>
              <p><?php echo $desk; ?></p>
              <div class="row mt-4">
                <div class="col-md-6">
                  <div class="form-group d-flex">
                    <div class="select-wrap">
                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                     
                      <select name="" id="satuan" class="form-control">

                        <option value="">Small Box</option>
                        <option value="">Medium Box</option>
                        <option value="">Large Box</option>
                        <option value="">Extra Large Box</option>

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
                <div class="table-responsive">
                  <table class="table">

                    <tbody>
                      <tr>
                        <td>[nama reviewer]</td>
                        <td>
                          <p>[ratingya berapa]</p>
                          <p>[isi reviewnya apa]</p>
                          <p>[foto yg diupload]</p>
                        </td>

                      </tr>
                    </tbody>
                  </table>
                </div>
              </form>
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