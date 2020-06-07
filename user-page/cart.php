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
                    <li class="nav-item "><a href="home.php" class="nav-link">Beranda</a></li>

                    <li class="nav-item"><a href="produk.php" class="nav-link">Produk</a></li>
                    <li class="nav-item cta cta-colored active"><a href="cart.php" class="nav-link"><span class="icon-shopping_cart"></span>[<?php if (isset($_SESSION["keranjang"])) {
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

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-0 bread">KERANJANG SAYA</h1>

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
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>&nbsp;</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody id="isicart">
                                <!-- isi dengan ajax cart -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="row justify-content-end">
                <div class="col-lg-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Tujuan Pengiriman</h3>
                        <p>Pilih Alamat Pengiriman Anda</p>
                        <form action="#" class="info">

                            <div class="form-group">
                                <select class="form-control" onclick="ongkir()" name="" id="alamat">
                                   <?php
                                   include_once "conn.php";
                                   $conn=getConn();
                                   $email=$_SESSION["email_user"];
                                   $query="select a.id_alamat as id,a.alamat_lengkap as alamat,a.no_prioritas as def  from alamat_pengiriman a where a.email='$email'";
                                    $statement = $conn->prepare($query);
                                    $statement->execute();
                                    $result = $statement->get_result();
                                    $kal="";
                                    if ($result->num_rows>0) {
                                        foreach($result as $row)
                                        {
                                            $id=$row["id"];
                                            $default=$row["def"];
                                            $alamat=$row["alamat"];
                                            if ($default=="1") {
                                                $kal.=" <option value='$id'>$alamat.....[default]</option>";
                                            }else{
                                                $kal.=" <option value='$id'>$alamat</option>";
                                            }
                                            
                                            
                                        } 
                                    }
                                    echo $kal;
                                   ?>

                                </select>
                            </div>

                            <div class="form-group">
                                <select class="form-control" name="" onchange="setongkir()" id="isipaket">
                               <!-- isi paket -->
                                </select>
                            </div>

                        </form>
                    </div>
                    <p><a  onclick="hitungtotal()" class="text-light btn btn-primary py-3 px-4">Cek</a></p>
                </div>
                <div class="col-lg-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Total Keranjang</h3>
                        <p class="d-flex">
                            <span>Subtotal</span>
                            <span id="totorder">Rp. 0</span>
                        </p>
                        <p class="d-flex">
                            <span>Ongkir</span>
                            <span id="ongkir">Rp. 0</span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span id="totalsemua">Rp. 0</span>
                        </p>
                    </div>
                    <p><a data-toggle="modal" data-target="#mycheckout" class="text-light btn btn-primary py-3 px-4">Bayar Sekarang</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- end cart -->

    <!-- modal untuk checkout -->
    <div class="modal fade" id="mycheckout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Metode Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                </div>
                <div class="modal-body ">
                    <div class="form-group">
                        <div class="alert alert-warning" role="alert">
                            Syarat dan Ketentuan untuk cicilan<br>
                            <ul>
                                <li>Uang muka 15% dari total bayar</li>
                                <li>Jatuh tempo pelunasan yaitu satu bulan dari tanggal pembelian</li>
                                <li>Pelunasan dilakukan secara transfer dibayar lunas </li>
                            </ul>
                        </div>
                        <a href="#" onclick="hutang()">Cicilan <span class="text-left"> > </span></a> <hr>
                        <a data-toggle="modal" data-target="#mySummary" onclick="lunas()" href="#">Transfer <span class="text-left"> > </span> </a>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- end of modal untuk checkout -->

    

    
    <?php
    include_once('justfooter.php')
    ?>
    <script>

                                    
        function load() {
            $.post("ajaxs/ajaxcart.php", {
                    jenis: "load",
                },
                function(data) {
                    $("#isicart").html(data);
                });

                $.post("ajaxs/ajaxcheckout.php", {
                    jenis: "getid",
                },
                function(data) {
                    console.log(data);
                });
            stot();
            ongkir();
        }

        load();


        function keluar() {
            $.post("ajaxs/ajaxlogin.php", {
                    jenis: "keluar",
                },
                function(data) {
                    window.location.href = "login.php";
                });
        }

        function remove(idb) {
            $.post("ajaxs/ajaxcart.php", {
                    jenis: "removeitem",
                    idb: idb
                },
                function(data) {
                    alert("Berhasil mencabut barang dari keranjang !");
                    console.log(data);
                    load();
                });
        }

        function gtjum(idb) {
            $.post("ajaxs/ajaxcart.php", {
                    jenis: "gantijum",
                    idbarang: idb,
                    jumbarang: $("#jum" + idb).val()
                },
                function(data) {
                    alert(data);
                    load();
                });
            setongkir();
        }

        function stot() {
            $.post("ajaxs/ajaxcart.php", {
                    jenis: "subtotalorderan",
                },
                function(data) {
                    $("#totorder").html("Rp " + data);
                });
        }

        function ongkir() {
            $.post("ajaxs/ajaxcart.php", {
                    jenis: "getharga",
                    idalamat:$("#alamat").val()
                },
                function(data) {
                    $("#isipaket").html(data);
                    $("#ongkir").html("Rp "+0.00);
                });
            setongkir();
        }
        
        function setongkir() {
            var formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'IDR',
            });
            if ($("#isipaket").val()!=-1) {
                var arrongkir=$("#isipaket").val().split('*');
                var ongk= formatter.format(arrongkir[3]);
                    
                    $("#ongkir").html(ongk);
                    $.post("ajaxs/ajaxcart.php", {
                            jenis: "setongkir",
                            ongkir:arrongkir[3]
                        },
                        function(data) {

                    });
            }else{
                    $.post("ajaxs/ajaxcart.php", {
                            jenis: "setongkir",
                            ongkir:0
                        },
                        function(data) {
                            $("#ongkir").html("Rp. "+0.00);
                    });
            }
          
            hitungtotal();
        }



        function hitungtotal(){
            $.post("ajaxs/ajaxcart.php", {
                    jenis: "total",
                },
                function(data) {
                    $("#totalsemua").html("Rp. "+data);
            });
        }
        hitungtotal();


        function lunas(){
            if ($("#isipaket").val()!='-1') {
                var arrongkir=$("#isipaket").val().split('*');
                if (cekkredit()) {
                    alert("Anda belum membayar tagihan sebelumnya !");
                }else{
                   
                    var arrongkir=$("#isipaket").val().split('*');
                    $.post("ajaxs/ajaxcheckout.php", {
                            jenis: "summar",
                            idalamat:$("#alamat").val(),
                            ongkir:arrongkir[3],
                            kurir:$("#isipaket").val(),
                        },
                        function(data) {
                            console.log(data);
                            if (data.search("pas")>0) {
                                window.location.href="pagepay.php";
                            }else{
                                alert(data);
                            }
                    });
                }
            }else{
                alert("Harus pilih kurir");
            }
            
        }

        function hutang(){
            if ($("#isipaket").val()!='-1') {
                if (cekkredit()) {
                    alert("Anda belum membayar tagihan sebelumnya !");
                }else{
                    var arrongkir=$("#isipaket").val().split('*');
                    $.post("ajaxs/ajaxcheckout.php", {
                            jenis: "piutang",
                            idalamat:$("#alamat").val(),
                            ongkir:arrongkir[3],
                            kurir:$("#isipaket").val(),
                        },
                        function(data) {
                            console.log(data);
                            if (data.search("pas")>0) {
                                window.location.href="pagepay.php";
                            }else{
                                alert(data);
                            }
                    });
                   
                }

               
            }else{
                alert("Harus piih kurir !");
            }
                
           
        }


        function cekkredit() {
            $.post("ajaxs/ajaxcheckout.php", {
                jenis: "cekkredit",
            },
            function(data) {
                console.log(data);
                if (data.indexOf("masih")) {
                    return true;
                }else{
                    return false;
                }
            });
        }

    </script>
</body>

</html>