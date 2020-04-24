<?php
session_start();
include_once '../conn.php';

if ($_POST["jenis"] == "show_product_catalog_semua") {
    $conn = getConn();

    $kal="";
    $sql = "select * from barang";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $result = $statement->get_result();
    foreach($result as $row)
    {
		$id=$row["id_barang"];
        $nama= $row['nama_barang'] ;
        $harga=$row['harga_jual']; 
		$foto=$row['foto_barang']; 
		$fharga=number_format($harga);
		$brand="";
		$kal.="
		<div class='col-md-6 col-lg-3 my-1'>
			<div class='product'>
			<a href='#' class='img-prod'><img class='img-fluid' src=\"$foto\" alt='Card image cap'></a>
			<div class='text py-3 pb-4 px-3 text-center'>
				<h3><strong><a >$nama</a></strong></h3>
				<h3><strong><a >Rp$fharga</a></strong></h3> <br>
				<div class='d-flex px-3 d-flex justify-content-center align-items-center text-center'>
					<!--<a class='btn btn-primary' href='#' role='button' onclick=\"more('$id')\">shop</a>-->
					<a onclick=\"addcart('$id')\" href='#' class='buy-now d-flex justify-content-center align-items-center mx-3'>
						<span><i class='ion-ios-cart'></i>Keranjang</span>
					</a>
				</div>
			</div>
			</div>
	  </div>";
        
	}
	
	
    echo $kal;
    $conn->close();
}

if ($_POST["jenis"] == "filter") {
    $conn=getConn();
    $query = "SELECT * FROM barang";
	$kal="";
	$minprice=$_POST["minimum_price"];
	$maxprice=$_POST["maximum_price"];

	if ($maxprice!=""&&$minprice!="") {
		//$query.= "harga_jual BETWEEN '$minprice' AND '$maxprice'";
	}

	// if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	// { ... }

	if(isset($_POST["brand"]))
	{
		$brand_filter= implode("','", $_POST["brand"]);
		$query.= " where jenis_barang IN ('$brand_filter')";
	}


	//$query.= "harga_jual BETWEEN '$minprice' AND '$maxprice'";

    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->get_result();
    foreach($result as $row)
    {
		$id=$row["id_barang"];
        $nama= $row['nama_barang'] ;
        $harga=$row['harga_jual']; 
		$foto=$row['foto_barang']; 
		$fharga=number_format($harga);
		$brand="";
		$kal.="
		<div class='col-md-6 col-lg-3 my-1'>
			<div class='product'>
			<a href='#' class='img-prod'><img class='img-fluid' src=\"$foto\" alt='Card image cap'></a>
			<div class='text py-3 pb-4 px-3 text-center'>
				<h3><strong><a >$nama</a></strong></h3>
				<h3><strong><a >Rp$fharga</a></strong></h3> <br>
				<div class='d-flex px-3 d-flex justify-content-center align-items-center text-center'>
					<!--<a class='btn btn-primary' href='#' role='button' onclick=\"more('$id')\">shop</a>-->
					<a onclick=\"addcart('$id')\" href='#' class='buy-now d-flex justify-content-center align-items-center mx-3'>
						<span><i class='ion-ios-cart'></i>Keranjang</span>
					</a>
				</div>
			</div>
			</div>
	  </div>";
        
	}
	
	echo $kal;
}

if ($_POST["jenis"]=="more") {
	$id=$_POST["idbarang"];
}


?>