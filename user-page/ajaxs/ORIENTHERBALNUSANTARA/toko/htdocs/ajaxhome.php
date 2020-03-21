<?php
    include "conn.php";
    session_start();
    $conn=getConn();
    function getiduser(){
      $conn=getConn();
      $iduser="";
      $kal="";
      $token="";
      if (isset($_SESSION["token"])) {
         $token=$_SESSION["token"];
     }
     if ($token=="") {
         $kal.= "token kosong";
     }else{
         $sql = "SELECT * FROM token where id_token='$token'";
         $result = $conn->query($sql);
         if ($result->num_rows > 0) {
             //cari user
             while($row = $result->fetch_assoc()) {
                 $iduser=$row["id_user"];
             }
         }
      }
      $conn->close();
      return $iduser;
   }

   if($_POST["jenis"] == "load_feed")
   {
     $kal="";
     $kat_id="";
     $iduser=getiduser();
     if($iduser=="")
     {
       //echo "Belum Login";
     }
     else
     {
       //echo "Sudah Login".$iduser;
       $arr_idp=[];
       $sql = "SELECT DISTINCT KT.ID AS KATID
       FROM HJUAL H, DJUAL D, PRODUK PR, PENYAKIT PN, KATEGORI KT, KHASIAT KH
       WHERE
       KT.ID = PN.ID_KATEGORI AND
       PN.ID_PENYAKIT = KH.ID_PENYAKIT AND
       KH.ID_PRODUK = PR.ID AND 
       PR.ID = D.ID_BARANG AND
       D.ID_HJUAL = H.ID_HJUAL AND
       H.ID_USER ='$iduser'";
       $result = $conn->query($sql);
       if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()) {
               $kat_id=$row["KATID"];
           }
           $sql0="SELECT DISTINCT PR.ID AS ID
           FROM KATEGORI KT, PENYAKIT PN, KHASIAT KH, PRODUK PR
           WHERE
           PR.ID = KH.ID_PRODUK AND
           KH.ID_PENYAKIT = PN.ID_PENYAKIT AND
           PN.ID_KATEGORI = KT.ID AND
           KT.ID='$kat_id'";
           $result0 = $conn->query($sql0);
            if ($result0->num_rows > 0) {
            while($row0 = $result0->fetch_assoc()) {
              $IDP=$row0["ID"];
              array_push($arr_idp,$IDP);
            }
          }
           for ($i=0; $i < count($arr_idp); $i++) { 
                $IDP = $arr_idp[$i];
                $sql1="SELECT * FROM PRODUK WHERE ID='$IDP'";
                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0) {
                  while($row1 = $result1->fetch_assoc()) {
                    $id_pro=$row1["id"];
                    $nama = $row1["nama"];
                    $harga = $row1["harga"];
                    $image = $row1["gambar1"];
                    $diskon=$harga-1000;
                    $kal.="
                    <div class='col-lg-3 col-md-6'>
                    <div class='single-product'>
                      <div class='product-img'>
                        <img class='img-fluid w-100' src=\"$image\" />
                        <div class='p_icon'>
                          <a href='single-product.php?id=$id_pro'>
                            <i class='ti-eye'></i>
                          </a>
                          <a onclick=\"addtowish('$id_pro')\">
                            <i class='ti-heart'></i>
                          </a>
                          <a onclick=\"addtocart('$id_pro')\" href='#'>
                            <i class='ti-shopping-cart'></i>
                          </a>
                        </div>
                      </div>
                      <div class='product-btm'>
                        <a href='single-product.php?id=$id_pro' class='d-block'>
                          <h4>$nama</h4>
                        </a>
                        <div class='mt-3'>
                          <span class='mr-4'>Rp. $harga</span>
                          <del>$diskon</del>
                        </div>
                      </div>
                    </div>
                  </div>";
                  }
                }
          }
       }
       echo $kal;
     }
   }

   function relevansiwishlist($idmerek){
    $conn=getConn();
    $iduser=getiduser();
    $kal="";


    $conn->close();
    return $kal;
    }


    function relevansitrans($idkat){
      $conn=getConn();
      $iduser=getiduser();
      $kal="";
  
  
      $conn->close();
      return $kal;
    }

    if($_POST["jenis"]=="load_mk"){
        // mk= memeliahara kesehatan
        $token="&token=";

        if(isset($_SESSION["token"]))
        {
          $token.=$_SESSION["token"];
        }
        $kal="";
        $sql = "SELECT DISTINCT P.ID AS IDP,P.NAMA AS NAMA,P.HARGA AS HARGA,P.GAMBAR1 AS GAMBAR1
FROM produk P,penyakit PN,khasiat KH,kategori KT
WHERE P.ID=KH.ID_PRODUK AND KH.ID_PENYAKIT=PN.ID_PENYAKIT AND PN.ID_KATEGORI=KT.ID AND KT.ID='15' limit 10";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row1 = $result->fetch_assoc()) {
              $id_pro=$row1["IDP"];
              $nama = $row1["NAMA"];
              $harga = $row1["HARGA"];
              $image = $row1["GAMBAR1"];
              $diskon=$harga-1000;
              $kal.="
              <div class='col-lg-3 col-md-6'>
              <div class='single-product'>
                <div class='product-img'>
                  <img class='img-fluid w-100' src=\"$image\" />
                  <div class='p_icon'>
                    <a href='single-product.php?id=$id_pro'>
                      <i class='ti-eye'></i>
                    </a>
                    <a onclick=\"addtowish('$id_pro')\">
                      <i class='ti-heart'></i>
                    </a>
                    <a onclick=\"addtocart('$id_pro')\" href='#'>
                      <i class='ti-shopping-cart'></i>
                    </a>
                  </div>
                </div>
                <div class='product-btm'>
                  <a href='single-product.php?id=$id_pro' class='d-block'>
                    <h4>$nama</h4>
                  </a>
                  <div class='mt-3'>
                    <span class='mr-4'>Rp. $harga</span>
                    <del>$diskon</del>
                  </div>
                </div>
              </div>
            </div>";
            }
        } else {
            echo "Kategori tidak ditemukan";
        }
        $conn->close();
        echo $kal;
    }
if($_POST["jenis"] == "load_wishlist")
{
  $arr_katid=[];
  $iduser=getiduser();
  $kal="";
  $sql="SELECT DISTINCT KT.ID AS KATID
  FROM WISHLIST W, PRODUK PR, KHASIAT KH, PENYAKIT PN, KATEGORI KT,USER U
  WHERE
  W.ID_BARANG = PR.ID AND
  KH.ID_PRODUK = PR.ID AND
  KH.ID_PENYAKIT = PN.ID_PENYAKIT AND
  PN.ID_KATEGORI = KT.ID AND
  PR.ID = W.ID_BARANG AND
  U.ID_USER ='$iduser'
  ;";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $idkat = $row["KATID"];
        array_push($arr_katid,$idkat);
    }
    for ($i=0; $i < count($arr_katid); $i++) { 
        $IDP = $arr_katid[$i];
        $sql1="SELECT * FROM PRODUK WHERE ID='$IDP'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
          while($row1 = $result1->fetch_assoc()) {
            $id_pro=$row1["id"];
            $nama = $row1["nama"];
            $harga = $row1["harga"];
            $image = $row1["gambar1"];
            $diskon=$harga-1000;
            $kal.="
            <div class='col-lg-3 col-md-6'>
            <div class='single-product'>
              <div class='product-img'>
                <img class='img-fluid w-100' src=\"$image\" />
                <div class='p_icon'>
                  <a href='single-product.php?id=$id_pro'>
                    <i class='ti-eye'></i>
                  </a>
                  <a onclick=\"addtowish('$id_pro')\">
                    <i class='ti-heart'></i>
                  </a>
                  <a onclick=\"addtocart('$id_pro')\" href='#'>
                    <i class='ti-shopping-cart'></i>
                  </a>
                </div>
              </div>
              <div class='product-btm'>
                <a href='single-product.php?id=$id_pro' class='d-block'>
                  <h4>$nama</h4>
                </a>
                <div class='mt-3'>
                  <span class='mr-4'>Rp. $harga</span>
                  <del>$diskon</del>
                </div>
              </div>
            </div>
          </div>";
          }
        }
    }
  }
  echo $kal;
}
?>