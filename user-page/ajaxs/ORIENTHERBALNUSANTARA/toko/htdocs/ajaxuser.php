<?php
    session_start();
    include "conn.php";
    $conn=getConn();
    if ($_POST["jenis"]=="getnama") {
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
                    $sql1 = "SELECT * FROM user where ID_USER='$iduser'";
                    $result1 = $conn->query($sql1);
                    if ($result1->num_rows > 0) {
                        while($row1 = $result1->fetch_assoc()) {
                            $nama=$row1["NAMA_USER"];
                            $kal.="Selamat Datang,".ucfirst($nama);
                        }
                    }
                }
            }
        }
        echo $kal;
    }

    if ($_POST["jenis"]=="load_data") {
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
                    $sql1 = "SELECT * FROM user where ID_USER='$iduser'";
                    $result1 = $conn->query($sql1);
                    if ($result1->num_rows > 0) {
                        while($row1 = $result1->fetch_assoc()) {
                            $nama=$row1["NAMA_USER"];
                            //$notelp=$row1["TELP_USER"];
                            $email=$row1["EMAIL_USER"];
                            $no = $row1["TELP_USER"];
                            $kal.="
                            <div class='col-md-6 form-group p_star'>
                                <input
                                readonly
                                type='text'
                                class='form-control'
                                id='email'
                                name='compemailany'
                                placeholder='Masukan alamat email'
                                value=\"$email\"
                                />
                            </div>
                            
                            <div class='col-md-6 form-group p_star'>
                                <input
                                type='text'
                                class='form-control'
                                name='name'
                                id='txt_nama'
                                placeholder='Masukan nama Lengkap'
                                value=\"$nama\"/>
                            </div>

                            <div class='col-md-6 form-group p_star'>
                                <input
                                type='number'
                                class='form-control'
                                name='name'
                                id='txt_telp'
                                placeholder='Masukan No.Telp'
                                value=\"$no\"/>
                            </div>
                            
                            <div class='col-md-12 form-group p_star'>
                                <button type='button' onclick=\"simpanprofile('$iduser')\" class='btn btn-success'>Simpan Profil</button>
                            </div>
                            ";
                        }
                    }
                }
            }
        }
        echo $kal;
    }
    if ($_POST["jenis"]=="optionalamat") {
        $kal="";
        $token="";
        $iduser="";
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
                    $sql1 = "SELECT * FROM info_pengiriman where ID_USER='$iduser' and exist='1'";
                    $result1 = $conn->query($sql1);
                    if ($result1->num_rows > 0) {
                        while($row1 = $result1->fetch_assoc()) {
                            $idalamat=$row1["ID_ALAMAT"];
                            $namapenerima=$row1["NAMA_PENERIMA"];
                            $jalan=$row1["JALAN"];
                            $kodepos=$row1["KODEPOS"];
                            $kota=$row1["KOTA"];
                            $provinsi=$row1["PROVINSI"];
                            $notelp=$row1["NO_HP_PENERIMA"];

                         $kal.="<li class='nav-item' onclick=\"choosedalamat('$idalamat')\" >
                         <div style='padding:8px;border-bottom:1px dashed grey' >
                         <div class='row'>
                         <div class='col-md-11 '>
                         <h5><b>$jalan</b></h5> - $namapenerima
                         $jalan,$kota,$provinsi,$notelp    
                         </div>
                         <div class='col-md-1'>
                         <button type='button' class='close btn btn-danger' onclick=\"modalremovealamat('$idalamat')\" data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                        </div>
                         </div>
                         </div>
                         </li>";
                        }
                    }
                }
            }
        }
        $kal.="<li class='nav-item text-center'>
                    <button type='button' onclick=\"formtambah('$iduser')\" class='btn btn-primary'><i class='fas fa-plus'></i>Tambah Alamat</button>
              </li>";
        
        echo $kal;
    }
 
  


    if ($_POST["jenis"]=="update_profile") {
        $p1 = $_POST['iduser'];
        $p2 = $_POST['nmuser'];
        $p3= $_POST['telpuser'];
        $sql = mysqli_query($conn, "select * from USER where ID_USER = '$p1'");
        if(mysqli_num_rows($sql) == 0){
            echo "nothing";
        }
        else{
            mysqli_query($conn, "update USER set NAMA_USER='$p2',TELP_USER='$p3' where ID_USER = '$p1'");
            echo "<div class='alert alert-success' role='alert'>
                Berhasil melakukan update profile
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
          </div>";
        }
    }

    if ($_POST["jenis"]=="choosedalamat") {
        $idalamat=$_POST["idalamat"];
        $jalan="";
        $namapenerima="";
        $notelp="";
        $provinsi="";
        $kota="";

        $token="";
        $iduser="";
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
                    $sql1 = "SELECT * FROM info_pengiriman where ID_ALAMAT='$idalamat'";
                    $result1 = $conn->query($sql1);
                    if ($result1->num_rows > 0) {
                        while($row1 = $result1->fetch_assoc()) {
                            $idalamat=$row1["ID_ALAMAT"];
                            $namapenerima=$row1["NAMA_PENERIMA"];
                            $jalan=$row1["JALAN"];
                            $kodepos=$row1["KODEPOS"];
                            $kota=$row1["KOTA"];
                            $kecamatan=$row1["kecamatan"];
                            $kelurahan=$row1["kelurahan"];
                            $provinsi=$row1["PROVINSI"];
                            $notelp=$row1["NO_HP_PENERIMA"];
                            $keterangan=$row1["keterangan_alamat"];

                            $kal="
                            <div class='col-md-12 form-group'>
                            <input
                            type='text'
                            class='form-control'
                            id='namapenerima'
                            name='text'
                            value='$namapenerima'
                            placeholder='Nama Penerima (cth:Elisa Nuralim)'/>
                            
                            </div>
                        
                            <div class='col-md-12 form-group'>
                            <input
                            type='text'
                            class='form-control'
                            id='telppenerima'
                            name='telp'
                            value='$notelp'
                            placeholder='Nomor Penerima (cth:087xxxxxxxx)'
                            />
                            
                            </div>
                        
                            <div class='col-md-12 form-group p_star'>
                            <textarea
                            class='form-control'
                            name='message'
                            id='alamat'
                            rows='1'
                            placeholder='Alamat Pengiriman (cth:Jl.Sejahtera 7 no 15)'
                            >$jalan</textarea>
                            </div>
                            
                            <div class='col-md-12 row'>
                            <div class='col-md-6 form-group p_star'>
                                <input
                                type='text'
                                class='form-control'
                                id='kecamatan'
                                value='$kecamatan'
                                name='number'
                                placeholder='Masukan Kecamatan'
                                />
                            </div>
                        
                            <div class='col-md-6 form-group p_star'>
                                <input
                                type='text'
                                class='form-control'
                                id='kelurahan'
                                value='$kelurahan'
                                name='compemailany'
                                placeholder='Masukan Kelurahan'
                                />
                            </div>
                            </div>
                        
                            <div class='col-md-12 row'>
                                <div class=' form-group col-md-6 '>
                                    <select  class='form-control ' onchange='loadkota()' id='provinsi' alt='$provinsi'>
                                    </select>
                                </div>
                                
                                <div class=' form-group col-md-6 '>
                                    <select  class='form-control ' id='kota' alt='$kota'>
                                    </select>
                                </div>
                            </div>
                        
                            
                        
                            <div class='col-md-12 form-group'>
                            <input
                            type='text'
                            class='form-control'
                            id='kodepos'
                            name='zip'
                            value='$kodepos'
                            placeholder='Kode Pos (cth:60xxx)'
                            />
                            </div>
                        
                            <div class='col-md-12 form-group p_star'>
                            <textarea
                            class='form-control'
                            name='message'
                            id='keterangan'
                            rows='1'
                            placeholder='Keterangan(cth:Patokan belakang Galaxy mall)'
                            >$keterangan</textarea>
                            </div>
                        
                            <div class='col-md-12'>
                                <button type='button' onclick=\"simpanalamat('$idalamat')\" class='btn btn-success'>Simpan</button>
                                <button type='button' onclick=\"cancelsimpan()\" class='btn btn-danger'>Batal</button>
                            </div>
                        </div>
                        
                        ";

                        }
                    }
                }
            }
        }

        echo $kal;
    }

    if ($_POST["jenis"]=="loadprovinsi") {
        $kal="";
        $kal.="<option value='-1'>Pilih Provinsi</option>";
        $sql1 = "SELECT * FROM provinsi";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while($row1 = $result1->fetch_assoc()) {
                $idpro=$row1["id_provinsi"];
                $namapro=$row1["nama_provinsi"];
                $kal.="<option value='$idpro'>$namapro</option>";
            }
        }
        echo $kal;
    }

    if ($_POST["jenis"]=="loadkota") {
        $kal="";
        $idpro=$_POST["idpro"];
        $kal.="<option value='-1'>Pilih Kota</option>";
        $sql1 = "SELECT * FROM kota where id_provinsi='$idpro'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while($row1 = $result1->fetch_assoc()) {
                $idkota=$row1["id_kota"];
                $nmkota=$row1["nama_kota"];
                $kal.="<option value='$idkota'>$nmkota</option>";
            }
        }
        echo $kal;
    }

    if ($_POST['jenis']=="showformtambah") {
        $iduser=$_POST['idu'];
        $kal="
        <div class='col-md-12 form-group'>
        <input
        type='text'
        class='form-control'
        id='namapenerima'
        name='text'
        placeholder='Nama Penerima (cth:Elisa Nuralim)'/>
        <label class='text-danger' id='anamapenerima' >*Nama harus diisi</label>
        </div>
      
        <div class='col-md-12 form-group'>
        <input
        type='text'
        class='form-control'
        id='telppenerima'
        name='telp'
        placeholder='Nomor Penerima (cth:087xxxxxxxx)'
        />
        <label class='text-danger' id='atelppenerima' >*Telpon harus diisi</label>
        </div>
      
        <div class='col-md-12 form-group p_star'>
        <textarea
        class='form-control'
        name='message'
        id='alamat'
        rows='1'
        placeholder='Alamat Pengiriman (cth:Jl.Sejahtera 7 no 15)'
        ></textarea>
        <label class='text-danger' id='aalamat' >*Alamat harus diisi</label>
        </div>
        
        <div class='col-md-12 row'>
          <div class='col-md-6 form-group p_star'>
              <input
              type='text'
              class='form-control'
              id='kecamatan'
              name='number'
              placeholder='Masukan Kecamatan'
              />
              <label class='text-danger' id='akecamatan' >*Kecamatan harus diisi</label>
          </div>
          
          <div class='col-md-6 form-group p_star'>
              <input
              type='text'
              class='form-control'
              id='kelurahan'
              name='compemailany'
              placeholder='Masukan Kelurahan'
              />
              <label class='text-danger' id='akelurahan' >*Kelurahan harus diisi</label>
          </div>
          
        </div>
      
        <div class='col-md-12 row'>
          <div class=' form-group col-md-6 '>
            <select  class='form-control ' onchange='loadkota()' id='provinsi'>
            </select>
            <label class='text-danger' id='aprovinsi' >*Provinsi harus dipilih</label>
          </div>
          
          <div class=' form-group col-md-6 '>
            <select  class='form-control ' id='kota'>
            </select>
            <label class='text-danger' id='akota' >*Kota harus dipilih</label>
          </div>
          
        </div>
      
        
      
        <div class='col-md-12 form-group'>
          <input
          type='text'
          class='form-control'
          id='kodepos'
          name='zip'
          placeholder='Kode Pos (cth:60xxx)'
          />
          <label class='text-danger' id='akodepos' >*Kodepos harus diisi</label>
        </div>
      
        <div class='col-md-12 form-group p_star'>
        <textarea
        class='form-control'
        name='message'
        id='keterangan'
        rows='1'
        placeholder='Keterangan(cth:Patokan belakang Galaxy mall)'
        ></textarea>
        </div>
       
      
      
        <div class='col-md-12'>
          <button type='button' onclick=\"tambahalamat('$iduser')\" class='btn btn-primary'>Tambah Alamat</button>
          <button type='button' onclick=\"canceltambah()\" class='btn btn-danger'>Batal Tambah</button>
        </div>
      </div>
      ";
      echo $kal;
    }

    if ($_POST["jenis"]=="insertalamat") {
        $data="";
        $iduser=$_POST['idu'];
        $nama=$_POST['nm'];
        $telp=$_POST['telp'];
        $alamat=$_POST['alamat'];
        $kec=$_POST['kec'];
        $kel=$_POST['kel'];
        $pro=$_POST['pro'];
        $kot=$_POST['kot'];
        $kod=$_POST['kod'];
        $ket=$_POST['ket'];

        $sql1 = "INSERT INTO info_pengiriman VALUES ('','$alamat','$kod','$kot','$pro','$nama','$telp','$iduser','$kec','$kel','$ket','1')";
          $result1 = $conn->query($sql1);
          
          if ($result1 == true) {
              $data="<div class='alert alert-success' role='alert'>
              Anda berhasil menambahkan alamat pengiriman
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
        </div>";
          }else{
              $data="<div class='alert alert-danger' role='alert'>
              Anda gagal menambahkan alamat pengiriman
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
        </div>";
          }
        echo $data;
    }

    


    if ($_POST["jenis"]=="optionbayar") {
        $kal="";
        $token="";
        $iduser="";
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
                    $sql1 = "SELECT * FROM info_pembayaran where ID_USER='$iduser' and exist='1'";
                    $result1 = $conn->query($sql1);
                    if ($result1->num_rows > 0) {
                        while($row1 = $result1->fetch_assoc()) {
                            $idbayar=$row1['ID_INFOPEMBAYARAN'];
                            $anbank=$row1['AN_REKENING'];
                            $norek=$row1['NO_REKENING'];
                            $nmbank=$row1['NAMA_BANK'];
                            $gmb="";
                            if ($nmbank=="014") {
                                $gmb="https://www.bca.co.id/assets/images/logobcasvg.svg";
                            }else if ($nmbank=="008") {
                                $gmb="https://www.bankmandiri.co.id/image/layout_set_logo?img_id=31567&t=1564908593501";
                            }else if ($nmbank=="013") {
                                $gmb="https://new.permatanet.com/permatanet/retail/css/rev/images/logo.png;wac7cdd624347925c8";
                            }
                            

                            $kal.="<li class='nav-item' onclick=\"choosedbayar('$idbayar')\" >
                            <div style='padding:8px;border-bottom:1px dashed grey' >
                            <div class='row'>
                            <div class='col-md-4 '>
                            <img style='height:30px' src='$gmb'><img>
                            </div>
                            <div class='col-md-7'>
                            <h5><b>$anbank-$norek</b>
                            </div>
                            <div class='col-md-1'>
                            <button type='button' onclick=\"modalremovebayar('$idbayar')\"class='close btn btn-danger' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
  </div>
                            </div>
                            </div>
                            </li>";
                        }
                    }
                }
            }
        }
        $kal.="<li class='nav-item text-center'>
                    <button type='button' onclick=\"formtambahbayar('$iduser')\" class='btn btn-primary'><i class='fas fa-plus'></i>Tambah Bayar</button>
              </li>";
        
        echo $kal;
    }
    
   if ($_POST["jenis"]=="showformbayar") {
            $iduser=$_POST['idu'];
            $kal="<div class='col-md-12 form-group'>
            <div class='row'>
            <div class='col-md-12'>
            <select id='bank' class='form-control col-md-12'>
                <option value='-1'>Pilih Bank...</option>
                <option value='014'>BCA</option>
                <option value='008'>Mandiri</option>
                <option value='013'>Permata</option>
            </select>
            </div>
            <div class='col-md-12'>
            <label class='text-danger' id='abank' >*Bank harus dipilih</label>
            </div>
            </div>
            
        </div>
        
        <div class='col-md-12 form-group'>
            <input
                type='text'
                class='form-control'
                id='anrekening'
                name='text'
                placeholder='Atas Nama Rekening (cth:Elisa Nuralim)'/>
            <label class='text-danger' id='aanrekening' >*Atas Nama Rekening harus diisi</label>
        </div>

        <div class='col-md-12 form-group'>
            <input
                type='number'
                class='form-control'
                id='norekening'
                name='text'
                placeholder='Nomor Rekening (cth:18805XXXXX)'/>
            <label class='text-danger' id='anorekening' >*Nomor Rekening harus diisi</label>
        </div>

        <div class='col-md-12'>
        <button type='button' onclick=\"tambahbank('$iduser')\" class='btn btn-primary'>Tambah Metode Pembayaran</button>
        <button type='button' onclick=\"canceltambahbank('$iduser')\" class='btn btn-danger'>Batal Tambah Metode</button>
        </div>";

        echo $kal;
   }

   if ($_POST["jenis"]=="choosedbayar") {
       $kal="";
        $idinfobayar=$_POST["idb"];
        $sql1 = "SELECT * FROM info_pembayaran where ID_INFOPEMBAYARAN='$idinfobayar'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while($row1 = $result1->fetch_assoc()) {

                $idbayar=$row1['ID_INFOPEMBAYARAN'];
                $anbank=$row1['AN_REKENING'];
                $norek=$row1['NO_REKENING'];
                $nmbank=$row1['NAMA_BANK'];
                $gmb="";
                
                if ($nmbank=="014") {
                    $gmb="https://www.bca.co.id/assets/images/logobcasvg.svg";
                }else if ($nmbank=="008") {
                    $gmb="https://www.bankmandiri.co.id/image/layout_set_logo?img_id=31567&t=1564908593501";
                }else if ($nmbank=="013") {
                    $gmb="https://www.permatabank.com/themes/permataweb/logo.svg";
                }
                

                $kal="<div class='col-md-12 form-group'>
                    <div class='row'>
                    <div class='col-md-12'>
                    <select id='bank' class='form-control col-md-12' alt='$nmbank'>
                        <option value='-1'>Pilih Bank...</option>
                        <option value='014'>BCA</option>
                        <option value='008'>Mandiri</option>
                        <option value='013'>Permata</option>
                    </select>
                    </div>
                    <div class='col-md-12'>
                    <label class='text-danger' id='abank' >*Bank harus dipilih</label>
                    </div>
                    </div>
                    
                </div>
                
                <div class='col-md-12 form-group'>
                    <input
                        type='text'
                        class='form-control'
                        id='anrekening'
                        name='text'
                        value='$anbank'
                        placeholder='Atas Nama Rekening (cth:Elisa Nuralim)'/>
                    <label class='text-danger' id='aanrekening' >*Atas Nama Rekening harus diisi</label>
                </div>

                <div class='col-md-12 form-group'>
                    <input
                        type='number'
                        class='form-control'
                        id='norekening'
                        name='text'
                        value='$norek'
                        placeholder='Nomor Rekening (cth:18805XXXXX)'/>
                    <label class='text-danger' id='anorekening' >*Nomor Rekening harus diisi</label>
                </div>

                <div class='col-md-12'>
                <button type='button' onclick=\"simpanbank('$idbayar')\" class='btn btn-success'>Simpan</button>
                <button type='button' onclick=\"cancelsimpanbank('$idbayar')\" class='btn btn-danger'>Batal</button>
                </div>";

            }
        }
        echo $kal;
    }

    if ($_POST["jenis"]=="insertbayar") {
        $kal="";
        $iduser=$_POST['idu'];
        $idbank=$_POST['idbank'];
        $norekening=$_POST['norek'];
        $anrekening=$_POST['anrek'];

        $sql1 = "INSERT INTO info_pembayaran VALUES ('','$anrekening','$norekening','$idbank','$iduser','1')";
          $result1 = $conn->query($sql1);
          
          if ($result1 == true) {
              $kal="<div class='alert alert-success' role='alert'>
                Anda berhasil menambahkan detail pembayaran 
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div>";
            }else{
                $kal="<div class='alert alert-danger' role='alert'>
                Anda gagal menambahkan detail pembayaran
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div>";
          }

        echo $kal;
    }

    if ($_POST["jenis"]=="updatealamat") {
        $kal="updatealamat";
        $idalamat=$_POST['ida'];
        $nama=$_POST['nm'];
        $telp=$_POST['telp'];
        $alamat=$_POST['alamat'];
        $kec=$_POST['kec'];
        $kel=$_POST['kel'];
        $pro=$_POST['pro'];
        $kot=$_POST['kot'];
        $kod=$_POST['kod'];
        $keterangan=$_POST['ket'];
        
        $sql1 = "UPDATE info_pengiriman SET JALAN='$alamat',KODEPOS='$kod',KOTA='$kot',PROVINSI='$pro',NAMA_PENERIMA='$nama',NO_HP_PENERIMA='$telp',kecamatan='$kec',kelurahan='$kel',keterangan_alamat='$keterangan'  WHERE ID_ALAMAT='$idalamat'";
        $result1 = $conn->query($sql1);
        
        if ($result1 == true) {
            $kal="<div class='alert alert-success' role='alert'>
            Anda berhasil mengubah alamat pengiriman
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button>
      </div>";
        }else{
            $kal="<div class='alert alert-danger' role='alert'>
            Anda gagal mengubah alamat pengiriman
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button>
      </div>";
        }
        
        echo $kal;
    }

    if ($_POST["jenis"]=="updatebayar") {
        $kal="updatebayar";
        $idbayar=$_POST['idb'];
        $idbank=$_POST['idbank'];
        $norekening=$_POST['norek'];
        $anrekening=$_POST['anrek'];
        
        $sql1 = "UPDATE user SET AN_REKENING='$newtoken',NO_REKENING='$norekening',NAMA_BANK='$idbank' WHERE ID_INFOPEMBAYARAN='$idbayar'";
        $result1 = $conn->query($sql1);
        
        if ($result1 == true) {
            $kal="<div class='alert alert-success' role='alert'>
            Anda berhasil mengubah detail pembayaran
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button>
      </div>";
        }else{
            $kal="<div class='alert alert-danger' role='alert'>
            Anda gagal mengubah detail pembayaran
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button>
      </div>";
        }
        
        echo $kal;
    }


    if($_POST["jenis"]=="deletealamat"){
        $kal="";
        $idalamat=$_POST['ida'];
        $sql1 = "UPDATE info_pengiriman SET exist='0'  WHERE ID_ALAMAT='$idalamat'";
        $result1 = $conn->query($sql1);
        
        if ($result1 == true) {
            $kal="<div class='alert alert-warning' role='alert'>
            Anda berhasil menghapus alamat pengiriman !
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        }else{
            $kal="<div class='alert alert-danger' role='alert'>
            Anda gagal menghapus alamat pengiriman !
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        }

        echo $kal;
    }

    if($_POST["jenis"]=="deletebayar"){
        $kal="";
        $idbayar=$_POST['idb'];
        $sql1 = "UPDATE info_pembayaran SET exist='0'  WHERE ID_INFOPEMBAYARAN='$idbayar'";
        $result1 = $conn->query($sql1);
        
        if ($result1 == true) {
            $kal="<div class='alert alert-warning' role='alert'>
            Anda berhasil menghapus detail pembayaran !
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        }else{
            $kal="<div class='alert alert-danger' role='alert'>
            Anda gagal menghapus detail pembayaran !
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        }

        echo $kal;
    }


     
?>