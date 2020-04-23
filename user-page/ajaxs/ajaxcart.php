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
            for ($i=0; $i <$count ; $i++) { 
                $idb=$arrkeranjang[$i]->get_idbarang();
                $nm=$arrkeranjang[$i]->get_nama();
                $hg=$arrkeranjang[$i]->get_harga();
                $jum=$arrkeranjang[$i]->get_jum();
                $fhg=number_format($hg,0);

                $stotal=$hg*$jum;
                $fstotal=number_format($stotal,0);
                $gmb1=$arrkeranjang[$i]->get_gambar();
                    $kal.="<tr class='text-center'>                                                           
                    <td class='image-prod'><div class='img' style='background-image:url(upload/$gmb1);'></div></td>
                    
                    <td class='product-name'>
                        <h3>$nm</h3>
                    </td>
                    
                    <td class='price'>Rp.$fhg</td>
                    
                    <td class='quantity'>
                        <div class='input-group mb-3'>
                        <input type='text' name='quantity' class='quantity form-control input-number' id=\"jum$idb\" onchange=\"gtjum('$idb')\" value='$jum' min='1' max='100'>
                    </div>
                    </td>
                
                    <td class='total'>Rp.$fstotal</td>
                    <td class='product-remove'><a href='' onclick=\"remove('$idb')\"><span class='ion-ios-close'></span></a></td>
                </tr>";
            }
          
           //$_SESSION['berat']= hitungberat();
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
        echo number_format(hitungsubtotalorderan());
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
        
    }
    
    
?>