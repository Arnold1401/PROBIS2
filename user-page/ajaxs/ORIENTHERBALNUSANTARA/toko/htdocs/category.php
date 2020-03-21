<?php
  include "importsrc.php";
  include "header.php";
?>

    <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div class="banner_content d-md-flex justify-content-between align-items-center">
            <div class="mb-3 mb-md-0">
              <h2>Kategori Produk</h2>
            </div>
            <div class="page_link">
              <a href="index.php<?php if (isset($_GET['token'])) { $token =$_GET['token'];echo "?token=".$token;}?>">Utama</a>
              <a href="category.php<?php if (isset($_GET['token'])) { $token =$_GET['token'];echo "?token=".$token;}?>">Kategori</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->
    
    <!--================Category Product Area =================-->
    <section class="cat_product_area section_gap">
    <div class="container">

    <div id="alert"></div>

        <div class="row flex-row-reverse">
          <div class="col-lg-9">
            <div class="product_top_bar">

           

              <div class="left_dorp">
                <select class="sorting" id="sort_show" onchange="showsort()">
                  <option value="a-z">Urutkan A-z</option>
                  <option value="z-a">Urutkan Z-a</option>
                  <option value="0-9">Urutkan Harga Terendah </option>
                  <option value="9-0">Urutkan Harga Tertinggi </option>
                </select>
                <select class="show" id="pk_show" onchange="showpk()">

                  <option value="6">Show 6</option>
                  <option value="9">Show 9</option>
                  <option value="12">Show 12</option>
                  <option value="15">Show 15</option>
                </select>
              </div>
            </div>
            <!--START CATEGOORY ITEMS -->

            <div class="latest_product_inner">
              
              <div class="row" id="isi_item"><!--YANG diisi ajax-->
                
              </div>


            </div>
          </div>
          <!--END CATEGORI ITEMS -->

          <div class="col-lg-3">
            <div class="left_sidebar_area">

              <aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Browse Categories</h3>
                </div>
                <div class="widgets_inner">
                  <ul class="list" id="isi_kategori"><!--List kategori-->

                  </ul>
                </div>
              </aside>

              <!--<aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Price Filter</h3>
                </div>
                <div class="widgets_inner">
                  <div class="range_item">
                    <div id="slider-range"></div>
                    <div class="">
                      <label for="amount">Price : </label>
                      <input type="text" id="amount" readonly />
                    </div>
                  </div>
                </div>
              </aside>-->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Category Product Area =================-->

    <?php
      include "footer.php";
    ?>
    
    <script>
      $.post("ajaxcategory.php",
      {
        jenis:"showlimit",
        limit:6,
      },
      function(data){
        $("#isi_item").html(data);
      }
      );


        function showpk() {
          var vlimit=$("#pk_show").val();
          $.post("ajaxcategory.php",
          {
            jenis:"showlimit",
            limit:vlimit,
          },
          function(data){
            $("#isi_item").html(data);
          }
          );

        }

        function showsort() {
          var vlimit=$("#pk_show").val();
          var vsort = $("#sort_show").val();
          $.post("ajaxcategory.php",
          {
            jenis:"sort",
            limit:vlimit,
            sort:vsort
          },
          function(data){
            $("#isi_item").html(data);
          }
          );

        }


        $.post("ajaxcategory.php",
        {
          jenis:"loadkategori"
        },
        function(data){
          $("#isi_kategori").html(data);
        }
        );
    
        function addtocart(params) {
          //alert("Tambah ke cart yang ke"+params);
          $.post("ajaxcart.php",
          {
            jenis:"insert_cart",
            idbrg:params,
          },
          function(data){
            console.log(data);
              $("#alert").html(data);
              //window.location.reload();
          }
          );
        }

        function addtowish(params) {
          //alert("Tambah ke wishlist yang ke"+params);
          $.post("ajaxwishlist.php",
          {
            jenis:"insert_wishlist",
            idbrg:params,
          },
          function(data){
            console.log(data);
            $("#alert").html(data);
            //window.location.reload();
          }
          );
        }
        function tocat(o,idkat)
        {
          $(".product_top_bar").css("display","none");
          $.post("ajaxcategory.php",
          {
            jenis:"carikatbar",
            vidkat:idkat,
            
          },
          function(data){
            $("#isi_item").html(data);
          }
          );
          var isi=o.childNodes;
          isi[0].style.backgroundColor = "lightgrey";
          //alert(isi);
        }

    </script>
   
  </body>
</html>
