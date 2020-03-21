<?php
    require 'conn.php';
    require 'classes/item.php';//idwishlist,idbarang,jumlah,iduser
    session_start();
    $conn=getConn();
    

    if ($_POST["jenis"]=="load_wishlist") {
        $kal="";
        $conn=getConn();
        if (isset($_SESSION["token"])) {
          $iduser=$_SESSION["token"];
          $status=1;//1 wishlist ada | 0 dihapus oleh user
          $idbtn=1;
          //GET USER ID
          $sql0 = "SELECT * FROM token where id_token='$iduser'";
          $result0 = $conn->query($sql0);
          if ($result0->num_rows > 0) {
              while($row0 = $result0->fetch_assoc()) {
                  $iduser=$row0["id_user"];
              }
          }
          $idwishlist="";
          //GET wishlist FROM USER
          $sql1 = "SELECT * FROM wishlist where status='1' and id_user='$iduser'";
          $result1 = $conn->query($sql1);
          if ($result1->num_rows > 0) {
            
              while($row1 = $result1->fetch_assoc()) {
                  $idwishlist=$row1["id_wishlist"];
                  $idbarang=$row1["id_barang"];
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
                          $harga=number_format($harga);
                          
                          $kal.="<tr>iduser$iduser
                            <td>
                              <img src=\"$img\" style='width:80px;height:60px;' alt='' />
                            </td>
                            <td><div class='product_count'><h5>$nama</h5></div></td>
                            <td><div class='product_count'><h5>RP.$diskon</h5></div></td>
                            
                            <td><button class='btn btn-danger' onclick=\"removeItem('$idwishlist')\"><i class='far fa-trash-alt'></i></button></td>
                          </tr>";
                        }
                    }
              }
          }
        
      }
  
      echo $kal;
      $conn->close();
    }

    //delete wishlist dari function removeItem js
    if ($_POST["jenis"]=="delete_wishlist") {
      $idwishlist=$_POST["idwishlist"];
      //kl ada di update4

      if (isset($_SESSION['token'])) {
        $data="";
        $sql2 = "UPDATE wishlist SET status='0' WHERE id_wishlist='$idwishlist'";
        if ($conn->query($sql2) === TRUE) {
          $data="Anda berhasil menghapus item dari wishlist !";
        } else {
          $data="Anda gagal menghapus item dari wishlist !";
        }
        echo $data;
      }else{
        echo "Anda tidak dapat menghapus wishlist";
      }
     
    }


    //insert wishlist
    if ($_POST["jenis"]=="insert_wishlist") {
    
      if (isset($_SESSION["token"])) {
        $data="";
        $status=1;//1 wishlist ada | 0 dihapus oleh user
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

        $match=false;
        
        $sql = "SELECT * FROM wishlist where id_user='$iduser' and id_barang='$idbarang'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $match=true;
          }
        }

        if (!$match) {
          $sql1 = "INSERT INTO wishlist VALUES ('','$idbarang','$iduser','$status')";
          $result1 = $conn->query($sql1);
          
          if ($result1 == true) {
            
              $data="<div class='alert alert-success' role='alert'>
              Anda berhasil menambahkan item ke wishlist !
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
          </div>";
          }else{
              $data="<div class='alert alert-danger' role='alert'>
              Anda gagal menambahkan item ke wishlist !
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
          </div>";
          }
        }else{
          $data="<div class='alert alert-success' role='alert'>
          Barang sudah pernah masuk di wishlist !
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
        </div>";
        }



       

        echo $data;
      }else{
        echo "Silahkan Login dahulu agar dapat menyimpan item ke wishlist !";
      }
      
    }


?>