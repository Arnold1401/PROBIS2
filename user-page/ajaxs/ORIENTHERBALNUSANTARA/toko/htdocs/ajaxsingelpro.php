<?php
    include "conn.php";
    session_start();
    $conn=getConn();

    function getkategori($idpro){
      $namakatnya="";
      $conn=getConn();
      $sql="SELECT kt.nama as nama FROM penyakit pn,kategori kt,khasiat kh,produk pr where kt.id=pn.id_kategori and pn.Id_penyakit=kh.id_penyakit and kh.id_produk=pr.id and pr.id='$idpro'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $namakatnya.= $row["nama"].",";
        }
      }
      $conn->close();
      return $namakatnya;
    }

    if($_POST["jenis"]=="load_detail"){
        // mk= memeliahara kesehatan
        $token="";
        if(isset($_SESSION["token"]))
        {
          $token="&token=".$_SESSION["token"];
        }
        $id=$_POST["id"];
        $kal="";
        $sql = "SELECT * FROM produk where id='$id'";
        $kategori = getkategori($id);
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $nama = $row["nama"];
              $harga = $row["harga"];
              $stok = $row["stok"];
              $gambar1 = $row["gambar1"];
              $gambar2 = $row["gambar2"];
              $gambar3 = $row["gambar3"];
              $namakat="";

              $sql1 = "SELECT kt.nama as namakat
              FROM penyakit pn,kategori kt,khasiat kh,produk pr 
              where kt.id=pn.id_kategori and pn.Id_penyakit=kh.id_penyakit and kh.id_produk=pr.id and pr.id='$id'";
              $result1 = $conn->query($sql1);
              if ($result1->num_rows > 0) {
                  while($row1 = $result->fetch_assoc()) {
                $namakat.=$row1['namakat'].",";
                }
                    
                } else {
                    //echo "Kategori tidak ditemukan";
                    $namakat="kosong";
                }
        



              $kal.="
              <div class='row s_product_inner'>
              <div class='col-lg-6'>
                <div class='s_product_img'>
                  <div
                    id='carouselExampleIndicators'
                    class='carousel slide'
                    data-ride='carousel'
                  >
                    <ol class='carousel-indicators'>
                      <li
                        data-target='#carouselExampleIndicators'
                        data-slide-to='0'
                        class='active'
                      >
                        <img
                          src=\"$gambar1\"
                          style='width:60px; height: 60px;'
                          alt=''
                        />
                      </li>
                      <li
                        data-target='#carouselExampleIndicators'
                        data-slide-to='1'
                      >
                        <img
                          src=\"$gambar2\"
                          style='width:60px; height: 60px;'
                          alt=''
                        />
                      </li>
                      <li
                        data-target='#carouselExampleIndicators'
                        data-slide-to='2'
                      >
                        <img
                          src=\"$gambar3\"
                          style='width:60px; height: 60px;'
                          alt=''
                        />
                      </li>
                    </ol>
                    <div class='carousel-inner'>
                      <div class='carousel-item active'>
                        <img
                          class='d-block w-100'
                          src=\"$gambar1\"
                          alt='First slide'
                        />
                      </div>
                      <div class='carousel-item'>
                        <img
                          class='d-block w-100'
                          src=\"$gambar2\"
                          alt='Second slide'
                        />
                      </div>
                      <div class='carousel-item'>
                        <img
                          class='d-block w-100'
                          src=\"$gambar3\"
                          alt='Third slide'
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class='col-lg-5 offset-lg-1'>
                <div class='s_product_text'>
                  <h3>$nama</h3>
                  <h2>Rp.145000</h2>
                  <ul class='list'>
                    <li>
                      <a class='active' href='#'>
                        <span>Kategori</span> : $namakat</a
                      >
                    </li>
                    <li>
                      <a href='#'> <span>Stok</span> : $stok</a>
                    </li>
                  </ul>
                  <div class='product_count'>
                    <label for='qty'>Qty:</label>
                    <input
                      type='text'
                      name='qty'
                      id='sst'
                      maxlength='12'
                      value='1'
                      title='Quantity:'
                      class='input-text qty'
                    />
                    <button
                      onclick=\"var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;\"
                      class='increase items-count'
                      type='button'
                    >
                      <i class='lnr lnr-chevron-up'></i>
                    </button>
                    <button
                      onclick=\"var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;\"
                      class='reduced items-count'
                      type='button'
                    >
                      <i class='lnr lnr-chevron-down'></i>
                    </button>
                  </div>
                  <div class='card_area'>
                    <a class='main_btn' onclick=\"addtocart('$id')\">Tambah ke Keranjang</a>
                    <!--<a class='icon_btn' href='#'>
                      <i class='fas fa-heart'></i>
                    </a>-->
                    <a onclick=\"addtowish('$id')\">
                        <i class='far fa-heart'></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>";
            }
           
        } else {
            echo "Barang ditemukan";
        }
        $conn->close();
        echo $kal;
    }
    if($_POST["jenis"]=="tampung_des"){
      // mk= memeliahara kesehatan
      $token="";
      if(isset($_SESSION["token"]))
      {
        $token="&token=".$_SESSION["token"];
      }
      $id=$_POST["id"];
      $kal="";
      $sql = "SELECT * FROM produk where id='$id'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $detail = $row["detail"];
            $kal.=$detail;
          }
         
      } else {
          echo "Barang tidak ditemukan";
      }
      $conn->close();
      echo $kal;
  }
  if($_POST["jenis"]=="tampung_spek"){
    // mk= memeliahara kesehatan
    $token="";
    if(isset($_SESSION["token"]))
    {
      $token="&token=".$_SESSION["token"];
    }
    $id=$_POST["id"];
    $kal="";
    $sql = "SELECT * FROM produk where id='$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $berat = $row["berat"];
          $kal.=" <tbody>
          <tr>
            <td>
              <h5>Width</h5>
            </td>
            <td>
              <h5>128mm</h5>
            </td>
          </tr>
          <tr>
            <td>
              <h5>Height</h5>
            </td>
            <td>
              <h5>508mm</h5>
            </td>
          </tr>
          <tr>
            <td>
              <h5>Depth</h5>
            </td>
            <td>
              <h5>85mm</h5>
            </td>
          </tr>
          <tr>
            <td>
              <h5>Berat</h5>
            </td>
            <td>
              <h5>$berat Gr</h5>
            </td>
          </tr>
        </tbody>";
        }
       
    } else {
        echo "Barang tidak ditemukan";
    }
    $conn->close();
    echo $kal;
}
?>