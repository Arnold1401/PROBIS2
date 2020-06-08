<?php
require_once("adminhead.php");
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
   
</head>

<body>
    <!-- Left Panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">
                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">                                                                                                     
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>    
                        <div class="user-menu dropdown-menu">
                           
                            <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a>

                            <a onclick="keluar()" class="nav-link" ><i class="fa fa-power-off"></i> Logout</a>
                        </div>                   
                    </div>                   
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->
        

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Master Barang</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>      
                            <li><a href="#">Master</a></li>                            
                            <li><a href="#">Barang</a></li>                                                  
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                <div class="col-md-12">
                    <form class="was-validated">
                        <div class="col-sm-6" style="border=10px;">

                            
                            <div class="input-group mb-3">
                                <select name="select" id="pilihbarang" class="form-control"  aria-describedby="helpcb_pilihbarang">                                  
                                </select>
                                <div class="input-group-append">
                                    <button id="tambahbarang_ini" class="btn btn-outline-secondary" type="button" onclick="tambahbarangini()">Tambah barang ini</button>
                                </div>
                            </div>

                            <div class="form-group">
                            <button type="button" id="tambahbarang_baru" class="btn btn-info btn-md" onclick="tambahbarangbaru()">
                                            <i class="fa fa-ban"></i> Tambah barang baru
                                            </button>
                                    </section>
                            </div>

                            <div class="form-group">
                            <img src="" id="img" width="200" height="100">
                            </div>
                            <div >
                            <input type="file" id="file" name="file" />
                            <input type="button" class="button btn btn-primary" onclick="upload()" value="Upload" id="but_upload">
                            </div>
                            <input type="hidden" class="form-control" id="url_user">

                            


                            <div class="form-group">
                                <label for="" class="form-control-label">Nama Barang</label>
                                <input type="text" id="nama_barang" class="form-control" aria-describedby="helpnama_barang" required>
                                
                                <small id="helpnama_barang" class="invalid-feedback">Masukkan nama barang</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="" class=" form-control-label">Desripsi barang</label>
                                <textarea class="form-control" name="" id="desk_barang" rows="3" placeholder="Deskripsi..." class="form-control" aria-describedby="helpdesk_barang" required></textarea>
                                <small id="helpdesk_barang" class="invalid-feedback">Masukkan deskripsi barang</small>
                            </div>

                            <div class="form-group">
                                <label for="" class=" form-control-label">Jenis Barang</label>
                                <select name="select" id="cb_jenisbarang" class="form-control" required aria-describedby="helpcb_jenisbarang">
                                    <option value="">~Pilih~</option>
                                    <option value="Minuman">Minuman</option>
                                    <option value="Makanan Ringan">Makanan Ringan</option>
                                    <option value="Perawatan Diri">Perawatan Diri</option>
                                    <option value="Obatan">Obatan</option>
                                </select>
                                <small id="helpcb_jenisbarang" class="invalid-feedback">Pilih Jenis kategori barang</small>                            
                            </div>

                            <div class="form-group">
                            <label for="" class=" form-control-label">Satuan Barang</label>
                                <select name="select" id="cb_satuanbarang" class="form-control" required aria-describedby="helpcb_satuanbarang">                                  
                                    <!-- select dari db -->
                                </select>
                                <small id="helpcb_satuanbarang" class="invalid-feedback">Pilih Satuan barang</small>
                            </div>

                            <div class="form-group">
                                <a href="#" style="color:blue;" data-toggle="modal" data-target="#myModal" data-toggle="tooltip" data-placement="right" title="Klik untuk menambahkan Satuan baru">+ Tambah Satuan Barang baru</a>
                            </div>
                        </div>
                        <!-- end col 6 -->
                        
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="" class=" form-control-label">Tanggal Masuk</label>
                                <input type="date" name="" id="tgl_masuk" class="form-control" aria-describedby="helptgl_masuk" required>
                                <small id="helptgl_masuk" class="invalid-feedback">Tanggal Masuk Barang </small>
                            </div>

                            <div class="form-group">
                                <label for="" class=" form-control-label">Tanggal Kadaluarsa Barang</label>
                                <input type="date" name="" id="tgl_kadaluarsa" class="form-control" aria-describedby="helptgl_kadaluarsa" required>
                                <small id="helptgl_kadaluarsa" class="invalid-feedback">Tanggal Kadularsa Barang </small>
                            </div>

                            <div class="form-group">
                                <label for="" class=" form-control-label">Kuantiti/Jumlah Barang</label>
                                <input type="number" id="jumlah_barang" name="" class="form-control" aria-describedby="helpjumlah_barang" required>
                                <small id="helpjumlah_barang" class="invalid-feedback">Masukkan kuantiti/jumlah barang masuk</small>
                            </div>

                            <div class="form-group">
                                <label for="" class=" form-control-label">Berat Barang</label>
                                <input type="number" id="berat_barang" name="" class="form-control" aria-describedby="helpjumlah_barang" required>
                                <small id="helpjumlah_barang" class="invalid-feedback">Masukkan Berat barang masuk</small>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Harga Beli Barang</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="number" id="hrgbeli_barang" name="" class="form-control" aria-describedby="helphrgbeli_barang" required>
                                        <small id="helphrgbeli_barang" class="invalid-feedback">Masukkan Harga Beli barang</small>
                                    </div>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Harga Jual Barang</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="number" id="hrgjual_barang" name="" class="form-control" aria-describedby="helphrgjual_barang" required>
                                        <small id="helphrgjual_barang" class="invalid-feedback">Masukkan Harga Jual barang</small>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <section class="card">                                   
                                    <button type="button" id="btnTambah" class="btn btn-success btn-md" onclick="tambahbarang()">
                                            <i class="fa fa-dot-circle-o"></i> Tambahkan
                                        </button>                                      
                                    </section>
                                </div>
                                <div class="col-md-4">
                                    <section class="card">
                                    <button type="button" id="btnReset" class="btn btn-danger btn-md" onclick="reset()">
                                            <i class="fa fa-ban"></i> Reset
                                            </button>
                                    </section>
                                </div>
                                <div class="col-lg-4">
                                    <section class="card">
                                    <button type="button" class="btn btn-warning btn-md float-right" onclick="Updatebarang()" disabled id="btnUbah">
                                            <i class="fa fa-ban"></i> Ubah
                                            </button>
                                    </section>
                                </div>
                            </div>
                            <div class="form-group">
                                <small>*Pilih Tombol Tambahkan untuk menambah barang baru</small><br>
                                <small>*Pilih Tombol Reset untuk mereset isi inputan diatas</small><br>
                                <small>*Pilih Tombol Ubah untuk mengubah/megupdate data yang telah dipilih</small><br>
                            </div>
                        </div>
                        <!-- end col 6 -->
                    </form>
                </div> <!-- end col 12 -->
                </div><!-- end row  -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">List Barang</strong>
                            </div>
                            <div class="card-body">                           
                              <small>*Tombol Detail - Detail dari setiap barang</small><br>
                              <small>*Pencarian dapat dilakukan pada textbox yang disediakan</small><br>
                              <div class="table-responsive">
                              <table id="example" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#ID Barang</th>
                                            <th>Nama Barang </th>
                                            <th>Jenis Barang</th>
                                            <th>Harga Jual</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->
    <!-- Right Panel -->

    <!-- Modal utk list reseller -->
    <div class="modal fade " tabindex="-1" id="myModal" role="dialog">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Tambah Satuan Barang Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">               
                    <form>
                        <div class="form-group">
                            <label class="col-form-label">Nama Satuan</label>
                            <input type="text" class="form-control" id="satuan_tambahan">
                            <label class="col-form-label text-danger" id="warning"></label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="tambahsatuanbaru" class="btn btn-outline-primary">Tambahkan</button> 
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
    <!--end of Modal utk list reseller -->


    <!-- kumpulan script luar -->
        <?php      include_once('kumpulanscriptluar.php'); ?>
    <!-- end of kumpulan script -->

</body>

</html>

<script>

    var ket=0;
    function pilihbarang() {
        $.post("adminajax.php",
        {
            jenis:"loadbarang",
        },
        function(data){
            $("#pilihbarang").html(data);
            });
    }

    function tambahbarangini() {
        $("#btnUbah").attr("disabled", true); 
        $("#btnTambah").attr("disabled", false); 
        $("#btnReset").attr("disabled", false); 

        
        var get= $("#pilihbarang").val();
        console.log(get);

        $.post("adminajax.php",{
                    jenis:"detail_barang",
                    getId : get, //id barang
        },
        function(data){
            var res = $.parseJSON(data[0]);
            var masuk = moment(data[1]).format("YYYY-MM-DD");
            var kadaluarsa = moment(data[2]).format("YYYY-MM-DD");
        
            //document.getElementById("tgl_masuk").value = masuk;
            //document.getElementById("tgl_kadaluarsa").value = kadaluarsa;
            //document.getElementById("jumlah_barang").value =  $.parseJSON(data[3]);
            document.getElementById("berat_barang").value =  $.parseJSON(data[5]);
            document.getElementById("hrgbeli_barang").value = $.parseJSON(data[6]);
            document.getElementById("hrgjual_barang").value = $.parseJSON(data[7]);
             
        });

        $.post("adminajax.php",{
                    jenis:"detail_barangini",
                    getId : get, //id barang
        },
        function(data){
            
            document.getElementById("nama_barang").value = data[1];
            document.getElementById("desk_barang").value =data[2];
            document.getElementById("cb_jenisbarang").value = data[3];
            document.getElementById("cb_satuanbarang").value = data[4];
            document.getElementById("img").src = data[5];
        });

        $("#tambahbarang_baru").attr("disabled", true); 
        ket=1; //tambah barang yg sudah ada 
       
    }

    function tambahbarangbaru() {
        $("#pilihbarang").attr("disabled", true); 
        $("#tambahbarang_ini").attr("disabled", true); 
        
        $("#btnUbah").attr("disabled", true); 
        $("#btnTambah").attr("disabled", false); 
        $("#btnReset").attr("disabled", false); 

        ket=0; //tambah barang baru
    }


    var getId, getNamaBarang,  getDeskBarang, getJenisBarang, getIdSatuan,getHargaBeli,getHargaJual,getFotoBarang, getStatusBarang, getRatingBarang, getBeratBarang, data, tablelistreseller = "";
    var saveIdbarangUpdate, saveIddetailBarang = "";

    $(document).ready(function() {
        
        $("#btnUbah").attr("disabled", true); 
        $("#btnTambah").attr("disabled", true); 
        $("#btnReset").attr("disabled", true); 

        getdataSatuan();
        pilihbarang();

        $('#tambahsatuanbaru').click( function () {
            tambahsatuanbaru();
            getdataSatuan();
        });

        //otomatis ajax menghitung muncul barang jika sudah mau expire atau telah expire
        CekTglExpireSemuaBarang();
        CekTglAvailableSemuaBarang();
        //end of otomatis ajax menghitung muncul barang jika sudah mau expire atau telah expire

        //datatable list barang
        var table= "";
        table = $('#example').DataTable( 
        {
            dom: 'Bfrtip',
             "buttons": [ 'copy', 'excel', 'pdf' ],
             "processing":true,
             "language": {
                "lengthMenu": "Tampilkan _MENU_ data per Halaman",
                "zeroRecords": "Maaf Data yang dicari tidak ada",
                "info": "Tampilkan data _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search":"Cari",
                "paginate": {
                    "first":      "Pertama",
                    "last":       "terakhir",
                    "next":       "Selanjutnya",
                    "previous":   "Sebelumnya"
                    },
                },
             "serverSide":true,
             "ordering":true, //set true agar bisa di sorting
             "order":[[0, 'asc']], //default sortingnya berdasarkan kolom, field ke 0 paling pertama
             "ajax":{
                 "url":"datatable_barang.php",
                 "type":"POST"
             },
             "deferRender":true,
             "aLengthMenu":[[10,20,50],[10,20,50]], //combobox limit
             "columns":[
                
                 {"data":"id_detail_barang"},
                 {"data":"id_barang"},
                 {"data":"nama_barang"},
                 {"data":"harga_jual", render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' )},
                 {"data":"status_barang",
                    "searchable": false,
                    "orderable":false,
                    "render": function (data, type, row) {  
                        if (row.status_barang == '1') //aktif blm expire
                        {
                            return "<button type='button' class='btn btn-success btn-sm'>Aktif</button>";
                        }
                        else if (row.status_barang == '2') //expire
                        {
                            return "<button type='button' class='btn btn-warning btn-sm'>Expire</button>";
                        }
                       
                    }
                },
                 {                   
                    "target": -1,
                    "defaultContent": "<button id=\"GetDetail\" class='btn btn-outline-primary'>Detail</button>"
                },              
             ],
        }) 
        //end of datatble list barang

        //function onclick untuk button list reseller dan details pada datatable list sales 

        $('#example tbody').on( 'click', 'button', function () {
            var action = this.id;
            data = table.row($(this).closest('tr')).data();
            
            //action button Detail
            if(action == 'GetDetail')
            {
                //enabled button ubah
                const btnUbah = document.getElementById("btnUbah");
                const btnTambah = document.getElementById("btnTambah");
                btnUbah.disabled =false;
                btnTambah.disabled=true;
                //ed of enabled button ubah

                saveIddetailBarang = data[Object.keys(data)[0]], //id barang
                saveIdbarangUpdate = data[Object.keys(data)[1]], //id barang
                
                $.post("adminajax.php",{
                    jenis:"detail_barang",
                    getId : data[Object.keys(data)[1]], //id barang
                },
                function(data){
                    var res = $.parseJSON(data[0]);
                    var masuk = moment(data[1]).format("YYYY-MM-DD");
                    var kadaluarsa = moment(data[2]).format("YYYY-MM-DD");
                    
                    document.getElementById("tgl_masuk").value = masuk;
                    document.getElementById("tgl_kadaluarsa").value = kadaluarsa;
                    document.getElementById("jumlah_barang").value =  $.parseJSON(data[3]);
                    document.getElementById("berat_barang").value =  $.parseJSON(data[5]);
                    document.getElementById("hrgbeli_barang").value = $.parseJSON(data[6]);
                    document.getElementById("hrgjual_barang").value = $.parseJSON(data[7]);

                });

                $.post("adminajax.php",{
                    jenis:"detail_barangini",
                    getId : data[Object.keys(data)[1]], //id barang
                },
                function(data){

                    document.getElementById("nama_barang").value = data[1];
                    document.getElementById("desk_barang").value =data[2];
                    document.getElementById("cb_jenisbarang").value = data[3];
                    document.getElementById("cb_satuanbarang").value = data[4];
                    document.getElementById("img").src = data[5];
                });


                const btnReset = document.getElementById("btnReset");
                btnReset.disabled=true;
                $("#pilihbarang").attr("disabled", true); 
                $("#tambahbarang_baru").attr("disabled", true); 
                $("#tambahbarang_ini").attr("disabled", true); 
           
            }
            //end of action button Detail
        } );
        //end of function onclick untuk button list reseller dan details pada datatable list sales 

        //event jika list barang dipilih/diclick 
        $('#example tbody').on('click', 'tr', function () {
            $(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
        } );
        //end of event jika list barang dipilih/diclick 
    })
    
    function keluar(){
    $.post("ajaxs/ajaxlogin.php",
        {
            jenis:"keluar",
        },
        function(data){
            window.location.href="../user-page/login.php";
        });
    }

    function getdataSatuan(){
        $.post("adminajax.php",{
            jenis:"satuan_barang",
        },
        function(data){
            $("#cb_satuanbarang").html(data);
        });
    }

    function upload() {

        var fd = new FormData();
      var files = $('#file')[0].files[0];
      fd.append('file',files);
      fd.append('id',$("#nama_barang").val());

        if (files == null) {
            alert("pilih gambar terlebih dahulu")
        }
        else if (files != null){
            
        console.log(files);
        $.ajax({
          url: 'ajaxupload.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
              if(response != 0){
                  $("#img").attr("src",response); 
                  $(".preview img").show(); // Display image element
                  $("#url_user").val(response);
                  console.log(response);
                  alert("file berhasil di upload");
              }else{
                  alert('file not uploaded');
              }
          },
      });
        }
      
    }

    function CekTglExpireSemuaBarang(){
        $.post("adminajax.php",{
            jenis:"CekTglExpireSemuaBarang",
            CurrentDate:moment(new Date()).format("YYYY-MM-DD"),
            },
            function(data){
                console.log(data);
                $('#example').DataTable().ajax.reload(); //reload ajax datatable 
            })
    }

    function CekTglAvailableSemuaBarang(){
        $.post("adminajax.php",{
            jenis:"CekTglAvailableSemuaBarang",
            CurrentDate:moment(new Date()).format("YYYY-MM-DD"),
            },
            function(data){
                console.log(data);
                $('#example').DataTable().ajax.reload(); //reload ajax datatable 
            })
    }



    function tambahsatuanbaru() {

        
        var inputan = document.getElementById("satuan_tambahan").value;
        if (inputan == "") {
            $('#warning').html("Masukkan satuan baru!");
        }
        else if (inputan != ""){
            $('#warning').html("");
            $.post("adminajax.php",{
            jenis:"tambah_satuan_baru",
            namasatuan : inputan,
            },
            function(data){
                alert(data);
                $('#example').DataTable().ajax.reload(); //reload ajax datatable 
            })
        }
        
    }

    //function tambah barang
    function tambahbarang() {
        //validasi setiap inputan
        (function() {
            'use strict';
            window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
                }, false);
            });
            }, false);
            })();

            //pengecekan tanggal kadaluarsa > tgl hari ini
            var tglkadaluarsa = $("#tgl_kadaluarsa").val();
            var CurrentDate = new Date();
            tglkadaluarsa = new Date(tglkadaluarsa);
            var files = $('#file')[0].files[0];

            const btntambahbarang_baru = document.getElementById("tambahbarang_baru");
            //btntambahbarang_baru.disabled=true;
            
            //tambah barang baru
            if (ket == 0) {
                if(tglkadaluarsa > CurrentDate && files != null)
                {
                    (function($){

                        $.post("adminajax.php",
                        {
                            jenis:"insertbarang",
                            namabarang:$("#nama_barang").val(),
                            descbarang:$("#desk_barang").val(),
                            jenisbarang:$("#cb_jenisbarang").val(),
                            satuanbarang:$("#cb_satuanbarang").val(),
                            tanggalmasuk:$("#tgl_masuk").val(),
                            tanggalkadaluarsa:$("#tgl_kadaluarsa").val(),
                            kuantiti:$("#jumlah_barang").val(),
                            hargabeli:$("#hrgbeli_barang").val(),
                            hargajual:$("#hrgjual_barang").val(),
                            fotobarang:$("#url_user").val(),
                            beratbarang:$("#berat_barang").val(),
                    
                        },
                        function (data) {
                            alert(data); 
                            $('#example').DataTable().ajax.reload(); //reload ajax datatable 
                            reset();
                        });
                    }(jQuery))
                }else if(files == null){
                    alert('foto barang belum diupload');
                }
                    else{
                    alert('Tanggal kadaluarsa lebih kecil dari hari ini');
                }
            }
            //tambah barang yg udah ada
            else if (ket == 1) {
                var get= $("#pilihbarang").val();
                if(tglkadaluarsa > CurrentDate){
                (function($){

                    $.post("adminajax.php",
                    {
                        jenis:"insertbarang_detail",
                        idbarang:get,
                        namabarang:$("#nama_barang").val(),
                        descbarang:$("#desk_barang").val(),
                        jenisbarang:$("#cb_jenisbarang").val(),
                        satuanbarang:$("#cb_satuanbarang").val(),
                        tanggalmasuk:$("#tgl_masuk").val(),
                        tanggalkadaluarsa:$("#tgl_kadaluarsa").val(),
                        kuantiti:$("#jumlah_barang").val(),
                        hargabeli:$("#hrgbeli_barang").val(),
                        hargajual:$("#hrgjual_barang").val(),
                        fotobarang:$("#url_user").val(),
                        beratbarang:$("#berat_barang").val(),
                
                    },
                    function (data) {
                        alert(data); 
                        $('#example').DataTable().ajax.reload(); //reload ajax datatable 
                        reset();
                    });
                }(jQuery))
            }
            else if(tglkadaluarsa < CurrentDate){
                alert('Tanggal kadaluarsa lebih kecil dari hari ini');
            }
            }
            

            
    }
    //end of function tambah barang

    //function reset
    function reset() {

       
        
        document.getElementById("nama_barang").value = null;
        document.getElementById("desk_barang").value = null;
        document.getElementById("cb_jenisbarang").value = 0;
        document.getElementById("cb_satuanbarang").value = 0;
        document.getElementById("tgl_masuk").value = null;
        document.getElementById("tgl_kadaluarsa").value = null;
        document.getElementById("jumlah_barang").value = null;
        document.getElementById("hrgbeli_barang").value = null;
        document.getElementById("hrgjual_barang").value = null;
        document.getElementById("url_user").value = null;
        document.getElementById("berat_barang").value = null;
        $("#pilihbarang").attr("disabled", false); 
        $("#tambahbarang_baru").attr("disabled", false); 
        $("#tambahbarang_ini").attr("disabled", false); 
        
    }
    //end of function reset

    //function update barang
    function Updatebarang() {
        $.post("adminajax.php",
        {
            jenis:"UpdateBarang",
            idbarang :saveIdbarangUpdate,
            namabarang:$("#nama_barang").val(),
            descbarang:$("#desk_barang").val(),
            jenisbarang:$("#cb_jenisbarang").val(),
            satuanbarang:$("#cb_satuanbarang").val(),
            tanggalmasuk:$("#tgl_masuk").val(),
            tanggalkadaluarsa:$("#tgl_kadaluarsa").val(),
            kuantiti:$("#jumlah_barang").val(),
            hargabeli:$("#hrgbeli_barang").val(),
            hargajual:$("#hrgjual_barang").val(),
            fotobarang:$("#url_user").val(),
            beratbarang:$("#berat_barang").val(),
            iddetailbarang:saveIddetailBarang,
    
        },
        function (data) {
            alert(data); 
            $('#example').DataTable().ajax.reload(); //reload ajax datatable 
            reset();
        });
        //enabled button ubah
        const btnUbah = document.getElementById("btnUbah");
        const btnTambah = document.getElementById("btnTambah");
        const btnReset = document.getElementById("btnReset");
        btnReset.disabled=false;
        btnUbah.disabled =true;
        btnTambah.disabled=false;
        
        //ed of enabled button ubah
    }
    //end of function update barang

    

</script>
