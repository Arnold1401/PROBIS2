<?php
    session_start();
    include_once "../conn.php";
    include_once "../classes/item.php";

     //first load wishlist cart.php
     if ($_POST["jenis"]=="load") {
        $kal="";
        if (isset($_SESSION["wishlist"])) {
            $arrwishlist=unserialize($_SESSION["wishlist"]);
            $count=count($arrwishlist);
            for ($i=0; $i <$count ; $i++) { 
                $idb=$arrwishlist[$i]->get_idbarang();
                $nm=$arrwishlist[$i]->get_nama();
                $hg=$arrwishlist[$i]->get_harga();
                $jum=$arrwishlist[$i]->get_jum();
                $fhg=number_format($hg,0);

                $gmb1=$arrwishlist[$i]->get_gambar();
                    $kal.="<tr class='text-center'>                                                           
                    <td class='image-prod'><div class='img' style='background-image:url($gmb1);'></div></td>
                    
                    <td class='product-name'>
                        <h3>$nm</h3>
                    </td>
                    <td class='price'>Rp.$fhg</td>
                    <td class='product-remove'><a href='' onclick=\"remove('$idb')\"><span class='ion-ios-close'></span></a></td>
                </tr>";
            }
          
           //$_SESSION['berat']= hitungberat();
        }
        echo $kal;
    }

    //test apakah ada cart jika ada boleh ke cart.php 
    if ($_POST["jenis"]=="testcart") {
       if (isset($_SESSION["wishlist"])) {
            $count=count(unserialize($_SESSION["wishlist"]));    
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
        if (isset($_SESSION["wishlist"])) {
            $arrwishlist=unserialize($_SESSION["wishlist"]);
            $count=count($arrwishlist);
           
            for ($i=0; $i <$count; $i++) { 
                $subtotal+=$arrwishlist[$i]->get_jum()*$arrwishlist[$i]->get_harga();
            }
            
        }
        return $subtotal;
    }

    //update plus maupun min
    if ($_POST["jenis"]=="gantijum") {
        $idbarang=$_POST["idbarang"];
        $jum=$_POST["jumbarang"];
        $arrwishlist=unserialize($_SESSION["wishlist"]);
        $count=count($arrwishlist);
        $idarray=-1;
        for ($i=0; $i <$count; $i++) { 
            if ($arrwishlist[$i]->get_idbarang()==$idbarang) {
                $idarray=$i;
            }
        }
        if ($idarray==-1) {
            echo "barang tidak ditemukan";
        }else{
            $arrwishlist[$idarray]->set_jum($jum);
            $_SESSION["wishlist"]=serialize($arrwishlist);
            $_SESSION['berat']=hitungberat();
            echo "barang ganti jumlah";
            echo "berat".hitungberat();
        }
      
        
    }
    
    //tambah ke wishlist
    if ($_POST["jenis"]=="additem") {
        $idbarang=$_POST["idbarang"];
        $kal="";
        if (isset($_SESSION["wishlist"])) {
            $arrwishlist=unserialize($_SESSION["wishlist"]);
            $barang=new Item();
            $barang->set_idbarang($idbarang);
            $barang->set_jum(1);
            if (!cekbarangsama($idbarang)) {
                $arrwishlist[]=$barang;
                $kal="barang cart";
            }else{
                $kal="barang sama";
            }

            
        }else{
            $arrwishlist=array();
            $barang=new Item();
            $barang->set_idbarang($idbarang);
            $barang->set_jum(1);
            $arrwishlist[]=$barang;
            $kal="barang cart";
        }
        $_SESSION["wishlist"]=serialize($arrwishlist);
        echo $kal;
    }

    function cekbarangsama($idbarang){
        $arrwishlist=unserialize($_SESSION["wishlist"]);
        $count=count($arrwishlist);
        $match=false;
        for ($i=0; $i <$count; $i++) { 
            if ($arrwishlist[$i]->get_idbarang()==$idbarang) {
                $match=true;
            }
        }
        return $match;
    }

    //total berat semua barang
    if ($_POST["jenis"]=="beratwishlist") {
        $_SESSION["berat"]=hitungberat();
        echo hitungberat();
    }

    function hitungberat(){
        $berat=0;
        if (isset($_SESSION["wishlist"])) {
            $arrwishlist=unserialize($_SESSION["wishlist"]);
            $count=count($arrwishlist);
           
            for ($i=0; $i <$count; $i++) { 
                $berat+=$arrwishlist[$i]->get_jum()*$arrwishlist[$i]->get_berat();
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
        $arrwishlist=unserialize($_SESSION["wishlist"]);
        $count=count($arrwishlist);
        $match=-1;
        for ($i=0; $i<$count ; $i++) { 
            $idb=$arrwishlist[$i]->get_idbarang();
            if ($idb==$id) {
                $match=$i;
            }
            
        }
        array_splice($arrwishlist,$match,1);
        $_SESSION["wishlist"]=serialize($arrwishlist);
    }

    //jumlah item di cart item berbeda
    if ($_POST["jenis"]=="getjum")
    {
        
    }
    
    
?>