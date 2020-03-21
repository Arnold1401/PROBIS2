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
              <h2>Cart</h2>
            </div>
            <div class="page_link">
              <a href="index.php">Home</a>
              <a href="cart.php">Cart</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Cart Area =================-->
    <section class="cart_area">
      <div class="container">
        <div class="cart_inner">
          
          <div id="alert">

          </div>

          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Item</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Jumlah</th>
                  <th scope="col">Harga</th>
                  <th scope="col">SubTotal</th>
                  <th scope="col">Hapus</th>
                </tr>
              </thead>
              <form>
              <tbody id="tampung_cart">
                <!-- //isi ajaxcart -->

              </tbody>
              </form>
            </table>
          </div>
        </div>
      </div>
    </section>
    <!-- <button onclick="getchoose()">Get choosed</button> -->
    <!--================End Cart Area =================-->

    <?php
   include "footer.php";
   include "gatekeeper.php";
   ?>
  <script>
      function refresh() {
        $.post("ajaxcart.php",
        {
          jenis:"load_cart"
        },
        function(data){
          $("#tampung_cart").html(data);
        }
        );
      }
    
      refresh();


      function acheck(params)
      {
        if ($("#cart"+params).prop("checked")) {//dipilh
          //alert("cart"+params+"checked");
          $.post("ajaxcart.php",
          {
            jenis:"insertcheck",
            idcart:params,
          },
          function(data){
            // $("#tampung_cart").html(data);

            console.log(data);
          }
          );
        }else {//diunpilih
          //alert("cart"+params+"un checked");
           $.post("ajaxcart.php",
          {
            jenis:"deletecheck",
            idcart:params,
          },
          function(data){
            // $("#tampung_cart").html(data);
            console.log(data);
            $("#alert").html(data);
          }
          );
        }
      }

      tampil_checkout();

      function tampil_checkout()
      {
        $.post("ajaxcart.php",
        {
          jenis:"tampil_checkout"
        },
        function(data){
          console.log(data);
        }
        );
      }

      function removeItem(params) {
        //alert("delete ke cart yang ke"+params);
        $.post("ajaxcart.php",
        {
          jenis:"delete_cart",
          idcart:params,
        },
        function(data){
          console.log(data);
          $("#alert").html(data);
          refresh();
        }
        );
      }

      function tambah(idbrg) {
        updateItemplus(idbrg);
      }

      function kurang(idbrg) {
        updateItemmin(idbrg);
      }

      
      function updateItemplus(params) {
        $.post("ajaxcart.php",
        {
          jenis:"update_cartplus",
          idcart:params,
        },
        function(data){
          console.log(data);
          $("#alert").html(data);
          refresh();
        }
        );
      }

      function updateItemmin(params) {
        $.post("ajaxcart.php",
        {
          jenis:"update_cartmin",
          idcart:params,
        },
        function(data){
          if (data=="kirimtowishlist") {
            $("#modal").html("<div class='modal' id='myModal' tabindex='-1' role='dialog'><div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'><h5 class='modal-title'>Hapus Cart</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='modal-body'><p>Modal body text goes here.</p></div><div class='modal-footer'><button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button><button type='button' class='btn btn-primary'>Save changes</button></div></div></div></div>");
            $('#myModal').modal('show');
          }
          console.log(data);
          $("#alert").html(data);
          refresh();
        }
        );
      }

      function usercheckout(params) {
        //alert(params);
        $.post("ajaxcart.php",
        {
          jenis:"tampil_checkout",
        },
        function(data){
          if (data=="kosong"||data=="[]") {
            console.log("kosong");
            alert("Pilih dahulu barang yang ingin di checkout");
          }else{
            console.log(data);
            window.location.href="checkout.php";
          }
        }
        );
      }


  </script>
  </body>
</html>
