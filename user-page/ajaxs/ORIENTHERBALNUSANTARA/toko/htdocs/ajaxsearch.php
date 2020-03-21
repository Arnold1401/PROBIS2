<?php
    include "conn.php";
    session_start();
    $conn=getConn();

    if($_POST["jenis"]=="search"){
        $kal="";
        $nama=$_POST["pcari"];
        if(isset($_SESSION['token']))
        {
            $token = $_SESSION['token'];
            $sql = "SELECT * FROM produk WHERE nama LIKE'%$nama%'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
  
                $id_pro=$row["id"];
                $nama=$row["nama"];
                $img=$row["gambar1"];
                $harga=$row["harga"]+10000;
  
                $diskon=$harga-10000;
                $diskon=number_format($diskon);
                $harga=number_format($harga);
                $kal.="<div class='col-lg-4 col-md-6'>
                <div class='single-product'>
                <div class='product-img'>
                  <img
                  class='card-img'
                  src='$img'
                  alt=''
                  />
                  <div class='p_icon'>
                  <a href='single-product.php?id=".$id_pro.$token."'>
                    <i class='far fa-eye'></i>
                  </a>
                  <a href='#'>
                    <i class='far fa-heart'></i>
                  </a>
                  <a onclick=\"addtocart('$id_pro')\">
                    <i class='fas fa-shopping-cart'></i>
                  </a>
                  </div>
                </div>
                <div class='product-btm'>
                <a class='d-block' href='single-product.php?id=".$id_pro.$token."'>
                  <h4>$nama</h4>
                  </a>
                  <div class='mt-3'>
                  <span class='mr-4'>Rp$diskon</span>
                  <del>Rp$harga</del>
                  </div>
                </div>
                </div>
              </div>";
            }
           
        } else {
            echo "produk tidak ditemukan";
            }
        }
        else
        {
            $sql = "SELECT * FROM produk WHERE nama LIKE'%$nama%'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
      
                    $id_pro=$row["id"];
                    $nama=$row["nama"];
                    $img=$row["gambar1"];
                    $harga=$row["harga"]+10000;
      
                    $diskon=$harga-10000;
                    $diskon=number_format($diskon);
                    $harga=number_format($harga);
                    $kal.="<div class='col-lg-4 col-md-6'>
                    <div class='single-product'>
                    <div class='product-img'>
                      <img
                      class='card-img'
                      src='$img'
                      alt=''
                      />
                      <div class='p_icon'>
                      <a href='single-product.php?id=$id_pro'>
                        <i class='far fa-eye'></i>
                      </a>
                      <a href='#'>
                        <i class='far fa-heart'></i>
                      </a>
                      <a onclick=\"addtocart('$id_pro')\">
                        <i class='fas fa-shopping-cart'></i>
                      </a>
                      </div>
                    </div>
                    <div class='product-btm'>
                    <a class='d-block' href='single-product.php?id=$id_pro'>
                      <h4>$nama</h4>
                      </a>
                      <div class='mt-3'>
                      <span class='mr-4'>Rp$diskon</span>
                      <del>Rp$harga</del>
                      </div>
                    </div>
                    </div>
                  </div>";
                }
               
            } else {
                echo "produk tidak ditemukan";
            }
        }
        echo $kal;
    }
?>