<!--================Header Menu Area =================-->
    <header class="header_area"> 
      <div class="main_menu">
        <div class="container" id="containerheader">
          <nav class="navbar navbar-expand-lg navbar-light w-100">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand logo_h" href="index.php">
              <img src="img/brand.jpg" style="height:4rem" alt="" />
            </a>
            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="icon-bar" style="background-color:#71cd14;"></span>
              <span class="icon-bar" style="background-color:#71cd14;"></span>
              <span class="icon-bar" style="background-color:#71cd14;"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div
              class="collapse navbar-collapse offset w-100"
              id="navbarSupportedContent"
            >
              <div class="row w-100 mr-0">
                <div class="col-lg-7 pr-0">
                  <ul class="nav navbar-nav center_nav pull-left">

                    <!--INDEX/HOME-->
                    <li class="nav-item">
                      <a class="nav-link" href="index.php<?php if (isset($_GET['token'])) { $token =$_GET['token'];echo "?token=".$token;}?>">Utama</a>
                    </li>
                    <!--SHOP -->
                    <li class="nav-item submenu dropdown">
                      <a
                        href="category.php<?php if (isset($_GET['token'])) { $token =$_GET['token'];echo "?token=".$token;}?>"
                        class="nav-link">Kategori</a>
                    </li>

                    <!--USER -->
                    <?php

                    if (isset($_SESSION['token'])&&!isset($_GET['logout'])) {
                    $token =$_SESSION['token'];
                    echo "<li class='nav-item submenu dropdown icons'>
                    <a
                    href='#'
                    class='nav-link dropdown-toggle'
                    data-toggle='dropdown'
                    role='button'
                    aria-haspopup='true'
                    aria-expanded='false'
                    ><i class='ti-user' aria-hidden='true'></i> User</a
                    >
                    <ul class='dropdown-menu'>
                    <li class='nav-item'>
                    <a class='nav-link' href='historytransaksi.php?token=$token'
                    ><i class='fas fa-history'></i>Riwayat Pembelian</a>
                    </li>
                    <li class='nav-item'>
                    <a class='nav-link' href='settings.php?token=$token'
                    ><i class='fas fa-cog'></i>Pengaturan</a>
                    </li>
                    <li class='nav-item'>
                    <a class='nav-link' href='index.php?logout=1' ><i class='fas fa-sign-out-alt'></i>
                    Logout</a>
                    </li>
                    </ul>
                  </li>";
                      
                    }else{
                      echo "<li class='nav-item submenu dropdown icons'>
                      <a
                      href='#'
                      class='nav-link dropdown-toggle'
                      data-toggle='dropdown'
                      role='button'
                      aria-haspopup='true'
                      aria-expanded='false'
                      ><i class='ti-user' aria-hidden='true'></i> User</a>
                      <ul class='dropdown-menu'>
                      <li class='nav-item'>
                      <a class='nav-link' href='login.php'>Masuk</a>
                      </li>
                      <li class='nav-item'>
                      <a class='nav-link' href='register.php'>Daftar</a>
                      </li>
                      </ul>
                    </li>";
                    

                    }

                    ?>

<?php
  if (isset($_GET['logout'])) {
    if ($_GET['logout']=="1") {
      session_destroy();
    }
  }
  
?>
                    <!--BLOG -->
                    <!-- <li class="nav-item submenu dropdown">
                      <a
                        href="#"
                        class="nav-link dropdown-toggle"
                        data-toggle="dropdown"
                        role="button"
                        aria-haspopup="true"
                        aria-expanded="false"
                        >Blog</a
                      >
                      <ul class="dropdown-menu">
                        <li class="nav-item">
                          <a class="nav-link" href="blog.php<?php// if (isset($_GET['token'])) { $token =$_GET['token'];echo "?token=".$token;}?>">Blog</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="single-blog.php<?php //if (isset($_GET['token'])) { $token =$_GET['token'];echo "?token=".$token;}?>"
                            >Blog Details</a
                          >
                        </li>
                      </ul>
                    </li> -->

                    <!--PAGES-->
                    <!-- <li class="nav-item submenu dropdown">
                      <a
                        href="#"
                        class="nav-link dropdown-toggle"
                        data-toggle="dropdown"
                        role="button"
                        aria-haspopup="true"
                        aria-expanded="false"
                        >Pages</a
                      >
                      <ul class="dropdown-menu">
                        <li class="nav-item">
                          <a class="nav-link" href="tracking.php<?php //if (isset($_GET['token'])) { $token =$_GET['token'];echo "?token=".$token;}?>">Tracking</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="elements.php<?php// if (isset($_GET['token'])) { $token =$_GET['token'];echo "?token=".$token;}?>">Elements</a>
                        </li>
                      </ul>

                    </li> -->

                    <!-- CONTACT -->
                    <!-- <li class="nav-item">
                      <a class="nav-link" href="contact.php<?php //if (isset($_GET['token'])) { $token =$_GET['token'];echo "?token=".$token;}?>">Contact</a>
                    </li> -->
                      
                  </ul>

                </div>

                <!--USER-->
                <div class="col-lg-5 pr-0">
                  <ul class="nav navbar-nav navbar-right right_nav pull-right">

                    <!-- search -->
                    <li class="nav-item">
                      <a href="#" class="icons">
                        <i class="ti-search" onclick="searchsomething()" aria-hidden="true"></i>
                      </a>
                    </li>
                    
                    <?php
                      $jumcart=0;
                      $jumwish=0;
                      // if (isset($_SESSION["cart"])) {//jika ada session
                      //   $arr=$_SESSION["cart"];
                      //   foreach ($arr as $i) {
                      //     $jumcart+=1;
                      //   }
                      // }

                     
                      // if (isset($_SESSION["wishlist"])) {//jika ada session
                      //   $arr=$_SESSION["wishlist"];
                      //   foreach ($arr as $i) {
                      //     $jumwish+=1;
                      //   }
                      // }
                      if (isset($_SESSION['token'])) {
                        include "conn.php";
                        $conn=getConn();
                        $iduser=$_SESSION["token"];
                            $sql0 = "SELECT * FROM token where id_token='$iduser'";
                            $result0 = $conn->query($sql0);
                            if ($result0->num_rows > 0) {
                                while($row0 = $result0->fetch_assoc()) {
                                    $iduser=$row0["id_user"];
                                }
                            }
                            //cek jumlah apakah sudah ad di cart
                            $sql = "SELECT * FROM cart where id_user='$iduser' and status='1'";
                            $result = $conn->query($sql);
                            $jumcart=$result->num_rows;

                             //cek jumlah apakah sudah ad di cart
                             $sql2 = "SELECT * FROM wishlist where id_user='$iduser' and status='1'";
                             $result2 = $conn->query($sql2);
                             $jumwish=$result2->num_rows;
                      }

                      


                    ?>

                    <li class="nav-item">
                      <a href="cart.php<?php if (isset($_GET['token'])) { $token =$_GET['token'];echo "?token=".$token;}?>" class="icons">
                        <i class="ti-shopping-cart"></i><span class="badge badge-light" id="notifjumcart"><?php echo $jumcart?></span>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="wishlist.php<?php if (isset($_GET['token'])) { $token =$_GET['token'];echo "?token=".$token;}?>" class="icons">
                        <i class="ti-heart" aria-hidden="true"></i><span class="badge badge-light" id="notifjumheart" ><?php echo $jumwish?></span>
                      </a>
                    </li>

                  </ul>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!--================Header Menu Area =================-->
  <script>
    function searchsomething() {
      $("#containerheader").html("<div class='input-group p-2 m-auto' ><input type='text' class='form-control' onKeyup='search()' placeholder='Ketik apa yang anda cari' id='cari_some'><div id='containercarisome'></div><div class='input-group-append'><span class='input-group-text bg-light' onclick='closecari()'><i class='fas fa-times'></i></span></div></div>");
      $("#containerheader").attr("class","container bg-light mb-2");
    
      }

    function closecari() {
      location.reload();
    }
    function search()
    {
      var cari =$("#cari_some").val();
      //alert(cari);
      $.post("ajaxsearch.php",
          {
            jenis:"search",
            pcari:cari
          },
          function(data){
            //alert(data);
            $("#isi_item").html(data);
            $(".product_top_bar").css("display","none");
          }
          );
    }


  </script>