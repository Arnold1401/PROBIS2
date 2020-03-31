<?php
      session_start();
      date_default_timezone_set("Asia/Bangkok");
  
      if ($_POST["jenis"]=="getprovince") {
        $arrprovince=getprovince();
        if ($arrprovince=="error") {
            echo "error";
        }else{
            $kal="";
            $kal.="<option value='-1'>--Pilih Provinsi--</option>";
            for ($i=0; $i <count($arrprovince); $i++) { 
                $id=$arrprovince[$i]->province_id;
                $nama=$arrprovince[$i]->province;
                $kal.="<option value='$nama'>$nama</option>";
            }
            echo $kal;
        }
        
      }

      function getprovince(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
           "key: 8ccbf31cdb56de646092992e32819d09"
        ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return "error";
        } else 
        {  
            $arr=json_decode($response);
            $resultnya=$arr->rajaongkir->results;
            return $resultnya;
        }
      }

      if ($_POST["jenis"]=="getcity") {
          $province=$_POST["province"];
          $arrcity=getcity($province);
          if ($arrcity=="error") {
              echo "error";
          }else {
              $kal="";
              $kal.="<option value='-1'>--Pilih Kota--</option>";
              for ($i=0; $i<count($arrcity); $i++) { 
                $idcity=$arrcity[$i]["city_id"];
                $city=$arrcity[$i]["city_name"];
                $kal.="<option value='$city'>$city</option>";
              }
              echo $kal;
          }

      }

      function getcity($province){
        $curl1 = curl_init();
        curl_setopt_array($curl1, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
           "key: 8ccbf31cdb56de646092992e32819d09"
        ),
        ));
        $response1 = curl_exec($curl1);
        $err1 = curl_error($curl1);
        curl_close($curl1);
        if ($err1) {
        echo "error";
        } else 
        { 
           $arr=json_decode($response1);
           $resultnya=$arr->rajaongkir->results;
           $arrcity=array();
           for ($i=0; $i <count($resultnya); $i++) { 
             if ($resultnya[$i]->province_id==$province) {
                 $idcity=$resultnya[$i]->city_id;
                 $city=$resultnya[$i]->city_name;
                 array_push($arrcity,array( "city_id" =>$idcity, "city_name" =>$city));
             }
           }
           return $arrcity;
        }
      }

      if ($_POST["jenis"]=="getsubdistrict") {
        $city=$_POST["city"];
        $arrsubdistrict=getsubdistrict($city);
        if ($arrsubdistrict=="error") {
            echo "error";
        }else{
            $kal="";
            $kal.="<option value='-1'>--Pilih Kecamatan--</option>";
            for ($i=0; $i<count($arrsubdistrict); $i++) { 
              $idsub=$arrsubdistrict[$i]->subdistrict_id;
              $sub=$arrsubdistrict[$i]->subdistrict_name;
              $kal.="<option value='$sub'>$sub</option>";
            }
            echo $kal;
            //echo json_encode($arrsubdistrict);
        }
      }

      function getsubdistrict($city){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=$city",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
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

      if ($_POST["jenis"]=="getharga") {
        $corigin=$_POST["corigin"];
        $sdestination=$_POST["sdestination"];
        $berat=$_POST["berat"];
        if ($berat=="") {
         $berat="1000";
        }
        // $hasil=getharga($corigin,$sdestination,"1000","jne:pos:tiki:rpx:esl:pcp:pandu:wahana:sicepat:jnt:pahala:cahaya:sap:jet:indah:dse:slis:first:ncs:star:ninja:lion:idl:rex");
        $hasil=getharga($corigin,$sdestination,$berat,"jne:pos:tiki:rpx:esl:pcp:pandu:wahana:sicepat:jnt:jet:ninja:lion");
        $kal="";
        
        for ($i=0; $i <count($hasil); $i++) { 
            $nama=$hasil[$i]->name;
            $code=strtoupper($hasil[$i]->code);
            $arrharga=$hasil[$i]->costs;
            for ($j=0; $j <count($arrharga); $j++) { 
                $estimasi=$arrharga[$j]->cost[0]->etd;
                $service=$arrharga[$j]->service;
                $harga=$arrharga[$j]->cost[0]->value;
                $hargaformated=number_format($harga);
                $kal.="<li class='list-group-item'><b>$code</b> ~ <b>$service</b> ~ $estimasi hari ~ Rp.$hargaformated,-</li>";
            }
           
        
        }
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

?>