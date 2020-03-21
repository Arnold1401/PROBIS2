<?php
    include "conn.php";
    session_start();
    $conn=getConn();

    if($_POST["jenis"]=="loadkategori"){
        $kal="";
        $sql = "SELECT DISTINCT * FROM kategori where exist='1' order by nama asc";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $idkat=$row['id'];
                $nama=$row["nama"];
                $kal.="<li onclick=\"tocat(this,'$idkat')\"><a href='#'>$nama</a></li>";
            }
           
        } else {
            echo "Kategori tidak ditemukan";
        }
        $conn->close();
        echo $kal;
    }


    if($_POST["jenis"]=="sort"){
      $token="";
      if(isset($_SESSION["token"]))
      {
        $token.="&token=".$_SESSION["token"];
      }
      $kal="";
      $limit=$_POST['limit'];
      $sort = $_POST['sort'];

      if ($sort == "a-z") {
        $field = "nama";
        $sort = "asc";
      }
      else if ($sort == "z-a") {
        $field = "nama";
        $sort = "desc";
      }
      else if ($sort == "0-9") {
        $field = "harga";
        $sort = "asc";
      }
      else if ($sort == "9-0") {
        $field = "harga";
        $sort = "desc";
      }

      $sql = "SELECT * FROM produk order by $field $sort limit $limit";
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
                <a \"addtowishlist('$id_pro')\">
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
      $conn->close();
      echo $kal;
  }

    if($_POST["jenis"]=="showlimit"){
      $token="";
      if(isset($_SESSION["token"]))
      {
        $token.="&token=".$_SESSION["token"];
      }
      $kal="";
      $limit=$_POST['limit'];
      $sql = "SELECT * FROM produk limit $limit";
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
                src=\"$img\"
                alt=''
                />
                <div class='p_icon'>
                <a href='single-product.php?id=".$id_pro.$token."'>
                  <i class='far fa-eye'></i>
                </a>
                <a onclick=\"addtowish('$id_pro')\">
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
      $conn->close();
      echo $kal;
  }
   if($_POST["jenis"] == "carikatbar")
   {
     $kal="";
     $kat = $_POST['vidkat'];
     $sql = "SELECT distinct pr.id as ip,pr.nama as np,pr.harga as hp,pr.gambar1 as gp FROM penyakit pn,kategori kt,khasiat kh,produk pr where kt.id=pn.id_kategori and pn.Id_penyakit=kh.id_penyakit and kh.id_produk=pr.id and kt.id='$kat'";
     $result = $conn->query($sql);
     if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) {
          $id_pro=$row["ip"];
          $nama=$row["np"];
          $img=$row["gp"];
          $harga=$row["hp"]+10000;

          $diskon=$harga-10000;
          $diskon=number_format($diskon);
          $harga=number_format($harga);
          $kal.="<div class='col-lg-4 col-md-6'>
          <div class='single-product'>
          <div class='product-img'>
            <img
            class='card-img'
            src=\"$img\"
            alt=''
            />
            <div class='p_icon'>
            <a href='single-product.php?id=$id_pro'>
              <i class='far fa-eye'></i>
            </a>
            <a onclick=\"addtowish('$id_pro')\">
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
      echo "<h5>produk tidak ditemukan pada kategori ini</h5>";
  }
  echo $kal;
   }
?>


