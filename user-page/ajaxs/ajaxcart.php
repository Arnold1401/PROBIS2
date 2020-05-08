<?php
    session_start();
    include_once "../conn.php";
    include_once "../classes/item.php";

     //first load keranjang cart.php
     if ($_POST["jenis"]=="load") {
        $kal="";
        if (isset($_SESSION["keranjang"])) {
            $arrkeranjang=unserialize($_SESSION["keranjang"]);
            $count=count($arrkeranjang);
            if ($count==0) {
                $kal="<tr class='text-center'>                                                           
                  
                    
                    <td class='product-name' colspan=4>
                        <h3>Keranjang Kosong</h3>
                    </td>
                    
                   
                </tr>";
            }else{
                for ($i=0; $i <$count ; $i++) { 
                    $idb=$arrkeranjang[$i]->get_idbarang();
                    $nm=$arrkeranjang[$i]->get_nama();
                    $hg=$arrkeranjang[$i]->get_harga();
                    $jum=$arrkeranjang[$i]->get_jum();
                    $fhg=number_format($hg,2);
    
                    $stotal=$hg*$jum;
                    $fstotal=number_format($stotal,2);
                    $gmb1=$arrkeranjang[$i]->get_gambar();
                        $kal.="<tr class='text-center'>                                                           
                        <td class='image-prod'><div class='img' style='background-image:url($gmb1);'></div></td>
                        
                        <td class='product-name'>
                            <h3>$nm</h3>
                        </td>
                        
                        <td class='price'>IDR $fhg</td>
                        
                        <td class='quantity'>
                            <div class='input-group mb-3'>
                            <input type='text' name='quantity' class='quantity form-control input-number' id=\"jum$idb\" onchange=\"gtjum('$idb')\" value='$jum' min='1' max='100'>
                        </div>
                        </td>
                    
                        <td class='total'>IDR $fstotal</td>
                        <td class='product-remove'><a href='' onclick=\"remove('$idb')\"><span class='ion-ios-close'></span></a></td>
                    </tr>";
                }
            }
            
          
           $_SESSION['berat']= hitungberat();
        }else{
                    $kal="<tr class='text-center'>                                                           
                  
                    
                    <td class='product-name' colspan=4>
                        <h3>Keranjang Kosong</h3>
                    </td>
                    
                   
                </tr>";
        }
        echo $kal;
    }

    //test apakah ada cart jika ada boleh ke cart.php 
    if ($_POST["jenis"]=="testcart") {
       if (isset($_SESSION["keranjang"])) {
            $count=count(unserialize($_SESSION["keranjang"]));    
        if ($count>0) {
                echo "ada";
            }else{
                echo "kosong";
            }
            
       }else{
           echo "kosong";
       }
    }

    //total harga semua barang
    if ($_POST["jenis"]=="subtotalorderan") {
        $_SESSION["subtotal"]=hitungsubtotalorderan();
        echo number_format(hitungsubtotalorderan(),2);
    }

    function hitungsubtotalorderan(){
        $subtotal=0;
        if (isset($_SESSION["keranjang"])) {
            $arrkeranjang=unserialize($_SESSION["keranjang"]);
            $count=count($arrkeranjang);
           
            for ($i=0; $i <$count; $i++) { 
                $subtotal+=$arrkeranjang[$i]->get_jum()*$arrkeranjang[$i]->get_harga();
            }
            
        }
        return $subtotal;
    }

    //update plus maupun min
    if ($_POST["jenis"]=="gantijum") {
        $idbarang=$_POST["idbarang"];
        $jum=$_POST["jumbarang"];
        $arrkeranjang=unserialize($_SESSION["keranjang"]);
        $count=count($arrkeranjang);
        $idarray=-1;
        for ($i=0; $i <$count; $i++) { 
            if ($arrkeranjang[$i]->get_idbarang()==$idbarang) {
                $idarray=$i;
            }
        }
        if ($idarray==-1) {
            echo "barang tidak ditemukan";
        }else{
            $arrkeranjang[$idarray]->set_jum($jum);
            $_SESSION["keranjang"]=serialize($arrkeranjang);
            $_SESSION['berat']=hitungberat();
            echo "barang ganti jumlah";
            echo "berat".hitungberat();
        }
        
    }
    
    //tambah ke keranjang
    if ($_POST["jenis"]=="additem") {
        $idbarang=$_POST["idbarang"];
        $kal="";
        if (isset($_SESSION["keranjang"])) {
            $arrkeranjang=unserialize($_SESSION["keranjang"]);
            $barang=new Item();
            $barang->set_idbarang($idbarang);
            $barang->set_jum(1);
            if (!cekbarangsama($idbarang)) {
                $arrkeranjang[]=$barang;
                $kal="barang cart";
            }else{
                $kal="barang sama";
            }

            
        }else{
            $arrkeranjang=array();
            $barang=new Item();
            $barang->set_idbarang($idbarang);
            $barang->set_jum(1);
            $arrkeranjang[]=$barang;
            $kal="barang cart";
        }
        $_SESSION["keranjang"]=serialize($arrkeranjang);
        echo $kal;
    }

    function cekbarangsama($idbarang){
        $arrkeranjang=unserialize($_SESSION["keranjang"]);
        $count=count($arrkeranjang);
        $match=false;
        for ($i=0; $i <$count; $i++) { 
            if ($arrkeranjang[$i]->get_idbarang()==$idbarang) {
                $match=true;
            }
        }
        return $match;
    }

    //total berat semua barang
    if ($_POST["jenis"]=="beratkeranjang") {
        $_SESSION["berat"]=hitungberat();
        echo hitungberat();
    }

    function hitungberat(){
        $berat=0;
        if (isset($_SESSION["keranjang"])) {
            $arrkeranjang=unserialize($_SESSION["keranjang"]);
            $count=count($arrkeranjang);
           for ($i=0; $i <$count; $i++) { 
                $berat+=$arrkeranjang[$i]->get_jum()*$arrkeranjang[$i]->get_berat();
            }
        }
        return $berat;
    }
  
    if ($_POST["jenis"]=="gotoshipping") {
        $berat=hitungberat();
        if ($berat>0) {
            echo "ada";
            $_SESSION["subtotal"]=hitungsubtotalorderan();
        }else{
            echo "null";
        }
    }
    
    if ($_POST["jenis"]=="removeitem") {
        $id=$_POST["idb"];
        $arrkeranjang=unserialize($_SESSION["keranjang"]);
        $count=count($arrkeranjang);
        $match=-1;
        for ($i=0; $i<$count ; $i++) { 
            $idb=$arrkeranjang[$i]->get_idbarang();
            if ($idb==$id) {
                $match=$i;
            }
            
        }
        array_splice($arrkeranjang,$match,1);
        $_SESSION["keranjang"]=serialize($arrkeranjang);
    }

    //jumlah item di cart item berbeda
    if ($_POST["jenis"]=="getjum")
    {
        $arrkeranjang=unserialize($_SESSION["keranjang"]);
        $count=count($arrkeranjang);
        echo $count;
    }

    if ($_POST["jenis"]=="getharga") {
        $conn=getConn();

        if (isset($_POST["idalamat"])) {
            $ida=$_POST["idalamat"];
            $query="select kecamatan from alamat_pengiriman where id_alamat='$ida'";
            $statement = $conn->prepare($query);
            $statement->execute();
            $result = $statement->get_result();
            foreach($result as $row)
            {
                $sdestination=$row["kecamatan"];
            }
            $arr=explode('-',$sdestination);
            $sdestination=$arr[0];
        }
        $corigin="444";//surabaya
        

        

        if (isset($_SESSION["berat"])) {
          if ($_SESSION["berat"]>0) {
            // $hasil=getharga($corigin,$sdestination,"1000","jne:pos:tiki:rpx:esl:pcp:pandu:wahana:sicepat:jnt:pahala:cahaya:sap:jet:indah:dse:slis:first:ncs:star:ninja:lion:idl:rex");
            $berat=$_SESSION["berat"];
            $hasil=getharga($corigin,$sdestination,$berat,"jne:pos:tiki:jnt");
            $kal="";
            $kal.="<option value='-1'>~Pilih Harga Paket~</option>";
            for ($i=0; $i <count($hasil); $i++) { 
                $nama=$hasil[$i]->name;
                $code=strtoupper($hasil[$i]->code);
                $arrharga=$hasil[$i]->costs;
              
                for ($j=0; $j <count($arrharga); $j++) { 
                    $estimasi=$arrharga[$j]->cost[0]->etd;
                    $service=$arrharga[$j]->service;
                    $harga=$arrharga[$j]->cost[0]->value;
                    $hargaformated=number_format($harga);
                    $kal.="<option value='$code*$service*$estimasi*$harga'><b>$code</b> | <b>$service</b> | $estimasi hari | IDR $hargaformated,-</option>";
                }
            }
          }else{
            $kal.="<option value='null'>Tidak ada barang yang dikirim</option>";
          }
          
        }
        $_SESSION["bongkir"]=0;
       
        echo $kal;
        
    }

    function getharga($corigin,$sdestination,$weight,$courier){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=$corigin&originType=city&destination=$sdestination&destinationType=subdistrict&weight=$weight&courier=$courier",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 8ccbf31cdb56de646092992e32819d09"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "error";
        } else {
          $arr=json_decode($response);
          $resultnya=$arr->rajaongkir->results;
          return $resultnya;
        }
      }

      if ($_POST["jenis"]=="setongkir") {
          $_SESSION["bongkir"]=$_POST["ongkir"];
      }

      if ($_POST["jenis"]=="total") {
        $ongkir=0;
        $subtot=0;
        if (isset($_SESSION["bongkir"])) {
            $ongkir=$_SESSION["bongkir"];
        }
        $subtot=hitungsubtotalorderan();
        $tot=$subtot+$ongkir;
        echo number_format($tot,2);
    }
  
?>