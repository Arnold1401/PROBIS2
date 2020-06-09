<?php
session_start();
include_once '../conn.php';

if ($_POST["jenis"] == "show_product_catalog_semua") {
    $conn = getConn();

    $kal="";
    $sql = "select b.id_barang as id_barang,b.nama_barang as nama_barang,d.harga_jual as harga_jual,b.foto_barang as foto_barang from barang b,detail_barang d where d.id_barang=b.id_barang and d.status_tampil='1' group by b.id_barang";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $result = $statement->get_result();
    foreach($result as $row)
    {
		$id=$row["id_barang"];
        $nama= $row['nama_barang'] ;
        $harga=$row['harga_jual']; 
		$foto="../admin-page/".$row['foto_barang']; 
		$fharga=number_format($harga,2);
		$brand="";
		$kal.="
		<div class='col-md-6 col-lg-4 my-1'>
			<div class='product'>
			<a href='#' class='img-prod'><img class='img-fluid' src=\"$foto\" alt='Card image cap'></a>
			<div class='text py-3 pb-4 px-2 text-center'>
				<h3><strong><a href=\"detailproduk.php?pid=$id\">$nama</a></strong></h3>
				<h3><strong><a >Rp$fharga</a></strong></h3> <br>
				<div class='d-flex px-3 d-flex justify-content-center align-items-center text-center'>
					<!--<a class='btn btn-primary' href='#' role='button' onclick=\"more('$id')\">shop</a>-->
					<a onclick=\"addcart('$id')\" href='#' class='buy-now d-flex justify-content-center align-items-center mx-3'>
						<span><i class='ion-ios-cart'></i></span>
					</a>
					<a onclick=\"addwish('$id')\" href='#' class='buy-now d-flex justify-content-center align-items-center mx-3'>
					<span><i class='ion-ios-heart'></i></span>
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
    $query = "SELECT b.id_barang as id_barang,b.nama_barang as nama_barang,d.harga_jual as harga_jual,b.foto_barang as foto_barang from barang b,detail_barang d where d.id_barang=b.id_barang and d.status_tampil='1'";
	$kal="";
	$minprice=0;


	if(isset($_POST["minimum_price"])){
		$minprice=$_POST["minimum_price"];
	}

	if (isset($_POST["maximum_price"])) {
		$maxprice=$_POST["maximum_price"];
		if ($maxprice!=""&&$minprice!="") {
			$filterharga="boleh";
			$query.= " and d.harga_jual BETWEEN '$minprice' AND '$maxprice'";
		}
	}

	if(isset($_POST["brand"]))
	{
		$brand_filter= implode("','", $_POST["brand"]);

		if (count($_POST["brand"])>0) {
			$query.= " and b.jenis_barang IN ('$brand_filter')";
		}else{
			$query .= "SELECT b.id_barang as id_barang,b.nama_barang as nama_barang,d.harga_jual as harga_jual,b.foto_barang as foto_barang from detail_barang d,barang b where d.id_barang=b.id_barang";
		}
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
		<div class='col-md-6 col-lg-4 my-1'>
			<div class='product'>
			<a href='#' class='img-prod'><img class='img-fluid' src=\"$foto\" alt='Card image cap'></a>
			<div class='text py-3 pb-4 px-2 text-center'>
				<h3><strong><a href=\"detailproduk.php?pid=$id\">$nama</a></strong></h3>
				<h3><strong><a >Rp$fharga</a></strong></h3> <br>
				<div class='d-flex px-3 d-flex justify-content-center align-items-center text-center'>
					<!--<a class='btn btn-primary' href='#' role='button' onclick=\"more('$id')\">shop</a>-->
					<a onclick=\"addcart('$id')\" href='#' class='buy-now d-flex justify-content-center align-items-center mx-3'>
						<span><i class='ion-ios-cart'></i></span>
					</a>
					<a onclick=\"addwish('$id')\" href='#' class='buy-now d-flex justify-content-center align-items-center mx-3'>
					<span><i class='ion-ios-heart'></i></span>
					</a>
				</div>
			</div>
			</div>
	  </div>";
        
	
		}
		}else{
			$kal = '<h3>No Data Found</h3>';
		}

	// }else if($filterharga=="boleh"){
	// 	$query= "select * from barang where harga_jual BETWEEN '$minprice' AND '$maxprice'";
	// 	$statement = $conn->prepare($query);
	// 	$statement->execute();
	// 	$result = $statement->get_result();
	// 	if ($result->num_rows>0) {
	// 		foreach($result as $row)
	// 	{
	// 		$id=$row["id_barang"];
	// 		$nama= $row['nama_barang'] ;
	// 		$harga=$row['harga_jual']; 
	// 		$foto="../admin-page/".$row['foto_barang']; 
	// 		$fharga=number_format($harga,2);
	// 		$brand="";
	// 		$kal.="
	// 		<div class='col-md-6 col-lg-3 my-1'>
	// 			<div class='product'>
	// 			<a href='#' class='img-prod'><img class='img-fluid' src=\"$foto\" alt='Card image cap'></a>
	// 			<div class='text py-3 pb-4 px-3 text-center'>
	// 				<h3><strong><a href=\"detailproduk.php?pid=$id\">$nama</a></strong></h3>
	// 				<h3><strong><a >Rp $fharga</a></strong></h3> <br>
	// 				<div class='d-flex px-3 d-flex justify-content-center align-items-center text-center'>
	// 					<!--<a class='btn btn-primary' href='#' role='button' onclick=\"more('$id')\">shop</a>-->
	// 					<a onclick=\"addcart('$id')\" href='#' class='buy-now d-flex justify-content-center align-items-center mx-3'>
	// 						<span><i class='ion-ios-cart'></i>Keranjang</span>
	// 					</a>
	// 					<a onclick=\"addwish('$id')\"  class='buy-now d-flex justify-content-center align-items-center mx-3'>
	// 						<span><i class='ion-ios-heart'></i>Wishlist</span>
	// 					</a>
	// 				</div>
	// 			</div>
	// 			</div>
	// 		</div>";
	// 	}

	// 	}else{
	// 		$kal = '<h3>No Data Found</h3>';
	// 	}
	 }
	else{
		$kal = '<h3>No Data Found</h3>';
	}
    
	
	echo $kal;
}




if ($_POST["jenis"]=="more") {
	$id=$_POST["idbarang"];
}

if ($_POST["jenis"] == "cari") {
    $conn = getConn();

	$kal="";
	$cari=$_POST["cari"];
    $sql = "select b.id_barang as id_barang,b.nama_barang as nama_barang,d.harga_jual as harga_jual,b.foto_barang as foto_barang from barang b,detail_barang d where d.id_barang=b.id_barang and b.nama_barang like '%$cari%'";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $result = $statement->get_result();
    foreach($result as $row)
    {
		$brand="";
		$id=$row["id_barang"];
        $nama= $row['nama_barang'] ;
        $harga=$row['harga_jual']; 
		$foto="../admin-page/".$row['foto_barang']; 
		$fharga=number_format($harga,2);
		$brand="";
		$kal.="
		<div class='col-md-6 col-lg-4 my-1'>
			<div class='product'>
			<a href='#' class='img-prod'><img class='img-fluid' src=\"$foto\" alt='Card image cap'></a>
			<div class='text py-3 pb-4 px-2 text-center'>
				<h3><strong><a href=\"detailproduk.php?pid=$id\">$nama</a></strong></h3>
				<h3><strong><a >Rp$fharga</a></strong></h3> <br>
				<div class='d-flex px-3 d-flex justify-content-center align-items-center text-center'>
					<!--<a class='btn btn-primary' href='#' role='button' onclick=\"more('$id')\">shop</a>-->
					<a onclick=\"addcart('$id')\" href='#' class='buy-now d-flex justify-content-center align-items-center mx-3'>
						<span><i class='ion-ios-cart'></i></span>
					</a>
					<a onclick=\"addwish('$id')\" href='#' class='buy-now d-flex justify-content-center align-items-center mx-3'>
					<span><i class='ion-ios-heart'></i></span>
					</a>
				</div>
			</div>
			</div>
	  </div>";
        
	}
	
	
    echo $kal;
    $conn->close();
}