<?php
  include "importsrc.php";
  include "header.php";
?>
 <!--================Home Banner Area =================-->
 <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div
            class="banner_content d-md-flex justify-content-between align-items-center"
          >
            <div class="mb-3 mb-md-0">
              <h2>Wishlist</h2>
            </div>
            <div class="page_link">
              <a href="index.php<?php if (isset($_GET['token'])) { $token =$_GET['token'];echo "?token=".$token;}?>">Home</a>
              <a href="wishlist.php<?php if (isset($_GET['token'])) { $token =$_GET['token'];echo "?token=".$token;}?>">Wishlist</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================wishlist Area =================-->
    <section class="wishlist_area">
      <div class="container">
        <div class="wishlist_inner">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Item</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Hapus</th>
                </tr>
              </thead>
              <form>
              <tbody id="tampung_wishlist">
                <!-- //isi ajaxwishlist -->

              </tbody>
              </form>
            </table>
          </div>
        </div>
      </div>
    </section>
    <!--================End wishlist Area =================-->
<?php
   include "footer.php";
   include "gatekeeper.php";
   ?>
<script>

      refresh();
      function refresh() {
        $.post("ajaxwishlist.php",
        {
          jenis:"load_wishlist",
        },
        function(data){
          //alert(data);
          $("#tampung_wishlist").html(data);
        }
        );

      }
    
      

      function removeItem(params) {
        //alert("delete ke wishlist yang ke"+params);
        $.post("ajaxwishlist.php",
        {
          jenis:"delete_wishlist",
          idwishlist:params,
        },
        function(data){
          alert(data);
          refresh();
        }
        );
      }

</script>

