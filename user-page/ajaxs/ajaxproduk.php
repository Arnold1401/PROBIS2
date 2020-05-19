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
		$foto="../admin-page/".$row['foto_barang']; 
		$fharga=number_format($harga);
		$brand="";
		$kal.="
		<div class='col-md-6 col-lg-3 my-1'>
			<div class='product'>
			<a href='#' class='img-prod'><img class='img-fluid' src=\"$foto\" alt='Card image cap'></a>
			<div class='text py-3 pb-4 px-2 text-center'>
				<h3><strong><a href=\"detailproduk.php?pid=$id\">$nama</a></strong></h3>
				<h3><strong><a >Rp$fharga</a></strong></h3> <br>
				<div class='d-flex px-3 d-flex justify-content-center align-items-center text-center'>
					<!--<a class='btn btn-primary' href='#' role='button' onclick=\"more('$id')\">shop</a>-->
					<a onclick=\"addcart('$id')\" href='#' class='buy-now d-flex justify-content-center align-items-center mx-3'>
						<span><i class='ion-ios-cart'></i>Keranjang</span>
					</a>
					<a onclick=\"addwish('$id')\"  class='buy-now d-flex justify-content-center align-items-center mx-3'>
					<span><i class='ion-ios-heart'></i>Wishlist</span>
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
	
	$bolehfilter=false;
    $query = "SELECT * FROM barang";
	$kal="";
	$minprice=0;
	$maxprice=$_POST["maximum_price"];

	if(isset($_POST["minimum_price"])){
		$minprice=$_POST["minimum_price"];
	}

	if (isset($_POST["maximum_price"])) {
		$maxprice=$_POST["maximum_price"];
	}

	if(isset($_POST["brand"]))
	{
		
		$brand_filter= implode("','", $_POST["brand"]);
		$query.= " where jenis_barang IN ('$brand_filter')";
	}

	if ($maxprice!=""&&$minprice!="") {
		$filterharga="boleh";
		$query.= " and harga_jual BETWEEN '$minprice' AND '$maxprice'";
	}

	if (isset($_POST["brand"])) {
		$bolehfilter=true;
	}

	//$query.= "harga_jual BETWEEN '$minprice' AND '$maxprice'";
	if ($bolehfilter) {
		$statement = $conn->prepare($query);
		$statement->execute();
		$result = $statement->get_result();
		if ($result->num_rows>0) {
			foreach($result as $row)
		{
			$id=$row["id_barang"];
			$nama= $row['nama_barang'] ;
			$harga=$row['harga_jual']; 
			$foto="../admin-page/".$row['foto_barang']; 
			$fharga=number_format($harga,2);
			$brand="";
			$kal.="
			<div class='col-md-6 col-lg-3 my-1'>
				<div class='product'>
				<a href='#' class='img-prod'><img class='img-fluid' src=\"$foto\" alt='Card image cap'></a>
				<div class='text py-3 pb-4 px-3 text-center'>
					<h3><strong><a href=\"detailproduk.php?pid=$id\">$nama</a></strong></h3>
					<h3><strong><a >Rp. $fharga</a></strong></h3> <br>
					<div class='d-flex px-3 d-flex justify-content-center align-items-center text-center'>
						<!--<a class='btn btn-primary' href='#' role='button' onclick=\"more('$id')\">shop</a>-->
						<a onclick=\"addcart('$id')\" href='#' class='buy-now d-flex justify-content-center align-items-center mx-3'>
							<span><i class='ion-ios-cart'></i>Keranjang</span>
						</a>
						<a onclick=\"addwish('$id')\"  class='buy-now d-flex justify-content-center align-items-center mx-3'>
							<span><i class='ion-ios-heart'></i>Wishlist</span>
						</a>
					</div>
				</div>
				</div>
			</div>";
		}

		}else{
			$kal = '<h3>No Data Found</h3>';
		}
		

	}else if($filterharga=="boleh"){
		$query= "select * from barang where harga_jual BETWEEN '$minprice' AND '$maxprice'";
		$statement = $conn->prepare($query);
		$statement->execute();
		$result = $statement->get_result();
		if ($result->num_rows>0) {
			foreach($result as $row)
		{
			$id=$row["id_barang"];
			$nama= $row['nama_barang'] ;
			$harga=$row['harga_jual']; 
			$foto="../admin-page/".$row['foto_barang']; 
			$fharga=number_format($harga,2);
			$brand="";
			$kal.="
			<div class='col-md-6 col-lg-3 my-1'>
				<div class='product'>
				<a href='#' class='img-prod'><img class='img-fluid' src=\"$foto\" alt='Card image cap'></a>
				<div class='text py-3 pb-4 px-3 text-center'>
					<h3><strong><a href=\"detailproduk.php?pid=$id\">$nama</a></strong></h3>
					<h3><strong><a >Rp. $fharga</a></strong></h3> <br>
					<div class='d-flex px-3 d-flex justify-content-center align-items-center text-center'>
						<!--<a class='btn btn-primary' href='#' role='button' onclick=\"more('$id')\">shop</a>-->
						<a onclick=\"addcart('$id')\" href='#' class='buy-now d-flex justify-content-center align-items-center mx-3'>
							<span><i class='ion-ios-cart'></i>Keranjang</span>
						</a>
						<a onclick=\"addwish('$id')\"  class='buy-now d-flex justify-content-center align-items-center mx-3'>
							<span><i class='ion-ios-heart'></i>Wishlist</span>
						</a>
					</div>
				</div>
				</div>
			</div>";
		}

		}else{
			$kal = '<h3>No Data Found</h3>';
		}
	}else{
		$kal = '<h3>No Data Found</h3>';
	}
    
	
	echo $kal;
}




if ($_POST["jenis"]=="more") {
	$id=$_POST["idbarang"];
}


?>