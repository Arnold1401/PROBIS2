<?php
require_once("head.php");
include_once("conn.php");
$conn = getConn();
//$message=$_REQUEST["type"];//jenis produk yang di pilih 


//echo "<script type='text/javascript'>alert('$message');</script>";
?>
<!-- test comit -->
<!DOCTYPE html>
<html>

<head>
  <style>
    #loading {
      text-align: center;
      background: url('loader.gif') no-repeat center;
      height: 150px;
    }
  </style>

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
          <li class="nav-item"><a href="home.php" class="nav-link">Beranda</a></li>
<!-- icon pakai icomoon.css -->
          <li class="nav-item active"><a href="produk.php" class="nav-link">Produk</a></li>
          <li class="nav-item"><a href="cart.php" class="nav-link" id='jumcart'><span class="icon-shopping_cart" ></span>[<?php if (isset($_SESSION["keranjang"])) {
        $arrkeranjang=unserialize($_SESSION["keranjang"]);
        $count=count($arrkeranjang);
        echo $count;
    }else{
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

  <div class="hero-wrap hero-bread" style="background-image: url('images/bg_2.jpg');">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
          <h1 class="mb-0 bread">PRODUK</h1>
          <div class="col-md-12 d-flex align-items-center">

            <!-- Cari Product -->
            <form action="#" class="subscribe-form">
              <div class="form-group d-flex">
                <input type="text" class="form-control" id="txt_cari" placeholder="Cari Produk">
                <input name="" id="" class="btn btn-primary" onclick="cari()" type="button" value="Cari">
              </div>
            </form>
            <!--End Cari Product -->

          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- Jenis Product -->
  <section class="ftco-section">
    <div class="container">
   
    <div class="row justify-content-center">
        <!-- <div class="col-md-10 mb-5 text-center">
          <ul class="product-category">
            <li><a href="#" class="active">Semua</a></li>
            <li><a href="#">Minuman</a></li>
            <li><a href="#">Konsumsi</a></li>
            <li><a href="#">Pribadi</a></li>
            <li><a href="#">Obat</a></li>
          </ul>
        </div> -->
      </div>

    

      <!-- row Jenis Product -->
      <div class="row">
        <!-- filter product -->
        <div class="col-md-3">

                                                                                                                                              

          <div class="list-group">
            <!-- <h3>Price</h3>
            <p id="price_fil">Rp1000 - 65000</p>
            <input type="number" id="vol1" name="vol">
            <input type="number" id="vol2" name="vol" >
            
            <button class="btn btn-success" onclick="terapkan()">Terapkan</button> -->
          </div>

          <div class="list-group">
            <h3>Kategori</h3>
            <div style="height: 250px; overflow-y: auto; overflow-x: hidden;">
              <?php

              $query = "SELECT * from kategori";
              $statement = $conn->prepare($query);
              $statement->execute();
              $result = $statement->get_result();
              foreach ($result as $row) {
              ?>
                <div class="list-group-item checkbox">
                  <label><input type="checkbox" class="common_selector brand" value="<?php echo $row['nama_kategori']; ?>"> <?php echo $row['nama_kategori']; ?></label>
                </div>
              <?php
              }

              ?>
            </div>
          </div>
          <!-- end of filter product -->

        </div>
        <div class="col-md-9">
          <br />
          <div class="row filter_data" id="disini"></div>
        </div>
        <!-- end row Jenis Product -->

        <!-- <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div> -->

      </div>

  </section>
  <!-- END Jenis Product -->




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

    // document ready
    $(document).ready(function() {
      CekTglExpireSemuaBarang();
        sisa_waktu_pelunasan();
/*
      var type = <?php// echo json_encode($_REQUEST['type']); ?>;
      var selector =".common_selector brand:".type."th-child";
     // alert(tx);
      if($(".common_selector brand:nth-child('2')").is(":checked")){
        alert('hai')
      }
    /*  if ($("input[type=checkbox]").is( 
                      ":checked")) */
     // $(".common_selector brand:nth-child(1) ").prop("checked", "true");
     // $(".el:nth-child(3) ").attr("checked", true);
          
      $.post("ajaxs/ajaxproduk.php", {
          jenis: "show_product_catalog_semua",
        },
        function(data) {
          $("#disini").html(data);
        });


      function filter_data() {
        //$('.filter_data').html('<div id="loading" style="" ></div>');
        var jenis = 'filter';
        var minimum_price = $('#vol1').val();
        var maximum_price = $('#vol2').val();
        var brand = get_filter('brand');

        if (brand.length>0) {
          $.ajax({
          url: "ajaxs/ajaxproduk.php",
          method: "POST",
          data: {
            jenis:jenis,
            minimum_price:minimum_price,
            maximum_price:maximum_price,
            brand:brand
          },
          success: function(data) {
            $('#disini').html(data);
          }
        });
        }else{
          $.ajax({
          url: "ajaxs/ajaxproduk.php",
          method: "POST",
          data: {
            jenis:'show_product_catalog_semua',
          },
          success: function(data) {
            $('#disini').html(data);
          }
        });
        }
       
      }

      function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function() {
          filter.push($(this).val());
        });
        return filter;
      }

      $('.common_selector').click(function() {
        filter_data();
      });


      $('#price_range').slider({
        range: true,
        min: 1000,
        max: 65000,
        values: [1000, 65000],
        step: 500,
        stop: function(event, ui) {
          $('#price_show').html("Rp "+ui.values[0] + ' - ' +"Rp "+ui.values[1]);
          $('#hidden_minimum_price').val(ui.values[0]);
          $('#hidden_maximum_price').val(ui.values[1]);

        }
      });

    });
    //end of document ready


    // FUNCTION BARANG

    function addcart(params) {
      $.ajax({
          url: "ajaxs/ajaxcart.php",
          method: "POST",
          data: {
            jenis: 'additem',
            idbarang:params,
          },
          success: function(data) {
            alert("Barang telah masuk di keranjang !");
            console.log(data);
            window.location.href="produk.php";

          }
        });
    }

    function addwish(params) {
      $.ajax({
          url: "ajaxs/ajaxwish.php",
          method: "POST",
          data: {
            jenis: 'additem',
            idbarang:params,
          },
          success: function(data) {
            alert("Barang telah masuk di Daftar Keinginan !");
            console.log(data);
          }
        });
    }

    function jumcart(){
      $.ajax({
          url: "ajaxs/ajaxcart.php",
          method: "POST",
          data: {
            jenis: 'jumitem',
          },
          success: function(data) {
            console.log();
          }
        });
    }

    function more(params) {
      $.ajax({
          url: "ajaxs/ajaxproduk.php",
          method: "POST",
          data: {
            jenis: 'more',
          },
          success: function(data) {
            console.log(data);
          }
        });
    }

    function formatMoney(number, decPlaces, decSep, thouSep) {
      decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
      decSep = typeof decSep === "undefined" ? "." : decSep;
      thouSep = typeof thouSep === "undefined" ? "," : thouSep;
      var sign = number < 0 ? "-" : "";
      var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
      var j = (j = i.length) > 3 ? j % 3 : 0;

      return sign +
        (j ? i.substr(0, j) + thouSep : "") +
        i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
        (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
    }

  // function terapkan() {
  //   var hatas=$("#vol1").val();
  //   var hbawah=$("#vol2").val();
  //   if (hatas!=""&&hbawah!="") {
  //     if (hatas<hbawah) {
  //       var fhatas=formatMoney(hatas);
  //       var fhbawah=formatMoney(hbawah);
  //       $("#price_fil").html("Rp "+fhatas+" sampai Rp "+fhbawah);
  //       var jenis = 'filter';
  //       var minimum_price = hatas;
  //       var maximum_price = hbawah;

  //       $.ajax({
  //         url: "ajaxs/ajaxproduk.php",
  //         method: "POST",
  //         data: {
  //           jenis:jenis,
  //           minimum_price:minimum_price,
  //           maximum_price:maximum_price,
  //         },
  //         success: function(data) {z
  //           $('#disini').html(data);
  //         }
  //       });

  //     }
  //     else{
  //       alert("Harga awal lebih besar dari harga akhir !");
  //     }
    
  //   }else{
  //     alert("Inputan filter harga tidak boleh kosong !");
  //   }
   
  // }

    function cari() {
      var dicari=$("#txt_cari").val();
      $.ajax({
          url: "ajaxs/ajaxproduk.php",
          method: "POST",
          data: {
            jenis: 'cari',
            cari:dicari
          },
          success: function(data) {
            $("#disini").html(data);
          }
        });
    }


    function unchecked() {
      var brand = get_filter('brand');
      if (brand.length>0) {
        
      }else{
        $.ajax({
          url: "ajaxs/ajaxproduk.php",
          method: "POST",
          data: {
            jenis: 'show_product_catalog_semua',
          },
          success: function(data) {
            $("#disini").html(data);
          }
        });
      }
    }

    function CekTglExpireSemuaBarang(){
        $.post("ajaxs/ajaxexpire.php",{
            jenis:"CekTglExpireSemuaBarang",
            CurrentDate:moment(new Date()).format("YYYY-MM-DD"),
            },
            function(data){
                console.log(data);
                $('#example').DataTable().ajax.reload(); //reload ajax datatable 
            })
        }
        function sisa_waktu_pelunasan() {
        $.post("ajaxreseller.php",{
            jenis:"cek_sisa_waktupelunasan",
            CurrentDate:moment(new Date()).format("YYYY-MM-DD"),
            },
            function(data){
                console.log(data);
                
            })
        }
        




  </script>
</body>

</html>