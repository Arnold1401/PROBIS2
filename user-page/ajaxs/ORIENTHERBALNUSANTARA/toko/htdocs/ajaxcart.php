<?php
    require 'conn.php';
    require 'classes/item.php';//idcart,idbarang,jumlah,iduser
    session_start();
    $conn=getConn();
    

    if ($_POST["jenis"]=="load_cart") {
      
        $kal="";
        $conn=getConn();
        unset($_SESSION["checkout"]);
        if (isset($_SESSION["token"])) {
          $arr=[];
          $iduser=$_SESSION["token"];
          $status=1;//1 cart ada | 0 dihapus oleh user
          $idbtn=1;
          //GET USER ID
          $sql0 = "SELECT * FROM token where id_token='$iduser'";
          $result0 = $conn->query($sql0);
          if ($result0->num_rows > 0) {
              while($row0 = $result0->fetch_assoc()) {
                  $iduser=$row0["id_user"];
              }
          }
          $idcart="";
          //GET CART FROM USER
          $sql1 = "SELECT DISTINCT* FROM cart where id_user='$iduser' and status='1'";
          $result1 = $conn->query($sql1);
           unset($_SESSION["checkout"]);
          if ($result1->num_rows > 0) {
            
              while($row1 = $result1->fetch_assoc()) {
                  $idcart=$row1["id_cart"];
                  $jumlah=$row1["jum"];
                  $idbarang=$row1["id_barang"];
                  $jum=$row1["jum"];
                  //GET BARANG FROM IDBARANG
                    $sql2 = "SELECT * FROM produk where id='$idbarang'";
                    $result2 = $conn->query($sql2);
                    if ($result2->num_rows > 0) {
                        while($row2 = $result2->fetch_assoc()) {
                          $nama=$row2["nama"];
                          $img=$row2["gambar1"];
                          $harga=$row2["harga"]+10000;
            
                          $diskon=$harga-10000;
                          $diskon=number_format($diskon);
                          $harga1=number_format($harga);

                          $subtotal=$harga*$jumlah;
                          $subtotal1=number_format($subtotal);

                          $newItem = new Item($idcart,$iduser,$idbarang,$jum,$harga,$subtotal,$nama,$img);
                          array_push($arr,$newItem);
                          $kal.="<tr>
                          <td> <input type='checkbox' onclick=\"acheck('$idcart')\" class='form-check-input cartchoosed' checked id='cart$idcart'></td>
                          <td>
                          <img src=\"$img\" style='width:80px;height:60px;' alt='' />
                        
                          </td>
                          <td>
                          <p>$nama</p>
                          </td>
                          <td>
                            <div class='product_count'>
                            <input
                              type='text'
                              name='qty'
                              id='sst$idbtn'
                              maxlength='12'
                              value='$jumlah'
                              title='Quantity:'
                              class='input-text qty'
                            />
                            <button
                              onclick=\"tambah('$idcart')\"
                              class='increase items-count'
                              type='button'
                            >
                              <i class='lnr lnr-chevron-up'></i>
                            </button>
                            <button
                              onclick=\"kurang('$idcart')\"
                              class='reduced items-count'
                              type='button'
                            >
                              <i class='lnr lnr-chevron-down'></i>
                            </button>
                            </div>
                          </td>
                          <td><h5>Rp.$harga1</h5></td>
                          <td><h5>Rp$subtotal1</h5></td>
                          <td><button class='btn btn-danger' onclick=\"removeItem('$idcart')\"><i class='far fa-trash-alt'></i></button></td>
                        
                          </tr>";
                        }
                    }
              }
              
          }
          $_SESSION["checkout"]=serialize($arr);
        }

      //patent
      $token="";
      if (isset($_SESSION["token"])) {
        $token=$_SESSION["token"];
      }
      $kal.="<tr class='out_button_area'>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <div class='checkout_btn_inner'>
                  <a class='gray_btn' href='category.php?token=$token'>Lanjutkan Berbelanja</a>
                  <a class='main_btn' onclick=\"usercheckout('$iduser')\">Checkout ke Pembayaran</a>
                </div>
              </td>
            </tr>";
  
      echo $kal;
      $conn->close();
    }

    //update cart
    if ($_POST["jenis"]=="update_cartplus") {
      $idcart=$_POST["idcart"];
      $jumlah=0;
      $data="";
      $sql1 = "SELECT * FROM cart where id_cart='$idcart'";
      $result1 = $conn->query($sql1);
      if ($result1->num_rows > 0) {
          while($row1 = $result1->fetch_assoc()) {
              $jumlah=$row1["jum"];
            }
      }
      $jumlah+=1;

      $sql2 = "UPDATE cart SET jum='$jumlah' WHERE id_cart='$idcart'";
      if ($conn->query($sql2) === TRUE) {
        $data="<div class='alert alert-success' role='alert'>
        Anda berhasil menambah jumlah item ke keranjang !
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
        </div>";
      } else {
        $data="<div class='alert alert-danger' role='alert'>
        Anda gagal menambah jumlah item ke keranjang !
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
        </div>";
      }
      echo $data;
    }

    if ($_POST["jenis"]=="update_cartmin") {
      $idcart=$_POST["idcart"];
      $jumlah=0;
      $data="";
      $sql1 = "SELECT * FROM cart where id_cart='$idcart'";
      $result1 = $conn->query($sql1);
      if ($result1->num_rows > 0) {
          while($row1 = $result1->fetch_assoc()) {
              $jumlah=$row1["jum"];
            }
      }
      $jumlah-=1;
      if ($jumlah==0) {
        $sql2 = "UPDATE cart SET status='0' WHERE id_cart='$idcart'";
        if ($conn->query($sql2) === TRUE) {
          $data="kirimtowishlist";
          //harus pindah ke wishlist
        } else {
          $data="Anda gagal mengurangi jumlah item ke keranjang !";
        }
      }else{
        $sql2 = "UPDATE cart SET jum='$jumlah' WHERE id_cart='$idcart'";
        if ($conn->query($sql2) === TRUE) {
          
          $data="<div class='alert alert-success' role='alert'>
          Anda berhasil mengurangi jumlah item ke keranjang !
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
        </div>";
        } else {
          $data="<div class='alert alert-danger' role='alert'>
          Anda gagal mengurangi jumlah item ke keranjang !
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
        </div>";
        }
      }
      
      echo $data;
    }

    //delete cart dari function removeItem js
    if ($_POST["jenis"]=="delete_cart") {
      $idcart=$_POST["idcart"];
      //kl ada di update4
      $data="";
      $sql2 = "UPDATE cart SET status='0' WHERE id_cart='$idcart'";
      if ($conn->query($sql2) === TRUE) {
        
        $data="<div class='alert alert-warning' role='alert'>
        Anda berhasil menghapus item dari Keranjang !
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
        </div>";
      } else {
        $data="<div class='alert alert-danger' role='alert'>
        Anda gagal menghapus item dari Keranjang !
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
        </div>";
      }
      echo $data;
    }

    if ($_POST["jenis"] == "deletecheck") {
      $idcart=$_POST["idcart"];
      if (isset($_SESSION['checkout'])) {
        $arr=unserialize($_SESSION["checkout"]);
        for ($i=0; $i <count($arr); $i++) { 
          if ($arr[$i]->getIdCart()==$idcart) {
            array_splice($arr,$i,1);  
            echo "<div class='alert alert-warning' role='alert'>
            Anda berhasil menghapus item dari Checkout !
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
        </div>"; 
          }
        }
        $_SESSION["checkout"]=serialize($arr);
        
      }
    }

    if ($_POST["jenis"] == "insertcheck") {
      $idcart = $_POST["idcart"];
      $arr=[];
      $idbarang="";
      $iduser = "";
      $jum = "";

      $harga="";
      $subtotal="";
      $nama="";
      $gambar="";
      //echo "test".$idcart;
      $sql1 = "SELECT p.gambar1 as GAMBAR,p.nama as NAMA,c.id_cart as IDC,p.id as IDP,c.id_user IDU,c.jum as JUM,p.harga as HARGA FROM cart c,produk p where c.id_barang=p.id and c.id_cart='$idcart'";
      $result1 = $conn->query($sql1);
      if ($result1->num_rows > 0) {
          while($row1 = $result1->fetch_assoc()) {
              $idcart=$row1["IDC"];
              $idbarang=$row1["IDP"];
              $iduser = $row1["IDU"];
              $jum = $row1["JUM"];
              $harga=$row1["HARGA"];
              $subtotal=$harga*$jum;
              $nama=$row1["NAMA"];
              $gambar=$row1["GAMBAR"];
          }
      }
      

        if (isset($_SESSION["checkout"])) {
          $arr=unserialize($_SESSION["checkout"]);
          $match=false;
          for ($i=0; $i <count($arr); $i++) { 
            if ($arr[$i]->getIdBarang()==$idbarang) {
              $match=true;
            }
          }
          if (!$match) {
            $newItem = new Item($idcart,$iduser,$idbarang,$jum,$harga,$subtotal,$nama,$gambar);
            array_push($arr,$newItem);
            echo "Berhasil menambahkan ke Checkout !";
          }else{
            echo "Barang sudah pernah diletakan di Checkout !";
          }
          $_SESSION["checkout"]=serialize($arr);
        }else{
          $arr=[];
          $newItem = new Item($idcart,$iduser,$idbarang,$jum,$harga,$subtotal,$nama,$gambar);
          array_push($arr,$newItem);
          $_SESSION["checkout"]=serialize($arr);
          echo "Barang berhasil ditambahkan ke Checkout !";
        }

        //echo json_encode($arr);
    }
    
    if ($_POST["jenis"]=="tampil_checkout") {
      $tampil=[];
      if (isset($_SESSION["checkout"])) {
        $arr=unserialize($_SESSION["checkout"]);
        for ($i=0; $i <count($arr); $i++) { 
            $idcart=$arr[$i]->getIdCart();
            $idbarang=$arr[$i]->getIdBarang();
            $iduser =$arr[$i]->getIdUser();
            $jum = $arr[$i]->getJumlah();
            $harga = $arr[$i]->getHarga();
            $subtotal = $arr[$i]->getSubtotal();
            $nama = $arr[$i]->getNama();
            $gambar = $arr[$i]->getGambar();
            $newrow0=array(
              "idcart"=>$idcart,
              "idbarang"=>$idbarang,
              "iduser"=>$iduser,
              "jum"=>$jum,
              "harga"=>$harga,
              "subtotal"=>$subtotal,
              "nama"=>$nama,
              "gambar"=>$gambar,
            );
            array_push($tampil,$newrow0);
        }
          echo json_encode($tampil); 
      }else{
        echo "kosong";
      }
    }

    //insert cart
    if ($_POST["jenis"]=="insert_cart") {
    
      if (isset($_SESSION["token"])) {
        $data="";
        $status=1;//1 cart ada | 0 dihapus oleh user
        $idbarang=$_POST["idbrg"];
        $iduser=$_SESSION["token"];
        //cari id user dari token
        $sql0 = "SELECT * FROM token where id_token='$iduser'";
        $result0 = $conn->query($sql0);
        if ($result0->num_rows > 0) {
            while($row0 = $result0->fetch_assoc()) {
                $iduser=$row0["id_user"];
            }
        }
        //cek jumlah apakah sudah ad di cart
        $sql = "SELECT * FROM cart where id_user='$iduser' and id_barang='$idbarang'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          $idcart="";
            while($row = $result->fetch_assoc()) {
                $idcart=$row["id_cart"];
                $jumlah=$row["jum"];
            }

          $jumlah=intval($jumlah)+1;
          //kl ada di update
          $sql2 = "UPDATE cart SET jum='$jumlah' WHERE id_cart='$idcart'";
          if ($conn->query($sql2) === TRUE) {
            
            $data="<div class='alert alert-success' role='alert'>
            Anda berhasil menambahkan jumlah item ke keranjang !
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
        </div>";
          } else {
            $data="<div class='alert alert-danger' role='alert'>
            Anda gagal menambahkan jumlah item ke keranjang !
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
        </div>";
          }

        }else{
          //kl belum ada
          $jumlah=1;
          $sql1 = "INSERT INTO cart VALUES ('','$iduser','$idbarang','$jumlah','$status')";
          $result1 = $conn->query($sql1);
          
          if ($result1 == true) {
            $data="<div class='alert alert-success' role='alert'>
            Anda berhasil menambahkan item ke keranjang !
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
        </div>";
          }else{
            $data="<div class='alert alert-danger' role='alert'>
            Anda gagal menambahkan item ke keranjang !
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
        </div>";
          }
        }
     
        echo $data;
      }else{
        echo "Silahkan Login dahulu agar dapat menyimpan item ke keranjang !";
      }
      
    }


    

?>