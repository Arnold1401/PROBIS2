<?php
    require 'conn.php';
    require 'classes/item.php';//idwishlist,idbarang,jumlah
    session_start();
    // $h = new Item( "Calvin", 15 );
    // echo "Hello, " . $h->getName(). "! You are ". $h->isAdult();
    

    if ($_POST["jenis"]=="load_wishlist") {
        $kal="";
        if (isset($_SESSION["wishlist"])) {//jika ada session
          $arr=$_SESSION["wishlist"];
          $idbtn=1;//id wishlist juga bisa untuk akses
          foreach ($arr as $i) {
            $vidbrg=$i->getIdBarang();
            $vidwishlist=$i->getIdCart();
            $vjum=$i->getJumlah();

            $conn=getConn();
            $sql = "SELECT * FROM produk where id='$vidbrg'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
      
                    $id_pro=$row["id"];
                    $nama=$row["nama"];
                    $img=$row["gambar1"];
                    $harga=$row["harga"]+10000;
      
                    $diskon=$harga-10000;
                    $diskon=number_format($diskon);
                    $harga1=number_format($harga);

                    $subtotal=$harga*$vjum;
                    $subtotal1=number_format($subtotal);
          
                    $kal.="<tr>
                        <td><input type='checkbox' name='check'/></td>
                          <td>
                            <img src=\"$img\" style='width:80px;height:60px;' alt='' />
                          </td>
                          <td><div class='product_count'>$nama</div></td>
                          <td><h5>Rp.$harga1</h5></td>
                          <td><button class='btn btn-danger' onclick=\"removeItem('$id_pro')\"><i class='far fa-trash-alt'></i></button></td>
                        </tr>";
                          
                    $idbtn+=1;
                
              }
               
            } else {
                echo "produk tidak ditemukan";
            }
            $conn->close();

            
          }
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
                  <a class='gray_btn' href='#'>Lanjutkan Berbelanja</a>
                  <a class='main_btn' href='checkout.php$token'>Checkout ke  Pembayaran</a>
                </div>
              </td>
            </tr>";

  
      echo $kal;
    }

    //delete wishlist dari function removeItem js
    if ($_POST["jenis"]=="delete_wishlist") {
      $idwishlist=$_POST["idwishlist"];
      $arr=$_SESSION["wishlist"];
      for ($i=0; $i <count($arr); $i++) { 
        if ($arr[$i]->getIdBarang()==$idwishlist) {
          unset($arr[$i]);  
        }
      }
      $_SESSION["wishlist"]=$arr;
      echo " hapus"; 
    }


    //insert wishlist
    if ($_POST["jenis"]=="insert_wishlist") {
      $idbarang=$_POST["idbrg"];
      if (isset($_SESSION["wishlist"])) {
        $arr=$_SESSION["wishlist"];
        $match=false;
        for ($i=0; $i <count($arr); $i++) { 
          if ($arr[$i]->getIdBarang()==$idbarang) {
            $match=true;
          }
        }
        if (!$match) {
          $idwishlist=count($arr)+1;
          $newItem = new Item($idwishlist,$idbarang,1);
          array_push($arr,$newItem);
          echo "Berhasil menambahkan ke wishlist !";
        }else{
          echo "Barang sudah pernah diletakan di wishlist !";
        }
        $_SESSION["wishlist"]=$arr;
      }else{
        $arr=array();
        $newItem = new Item(1,$idbarang,1);
        array_push($arr,$newItem);
        $_SESSION["wishlist"]=$arr;
        echo "Berhasil menambahkan ke wishlist !";
      }
      
      
    }


?>