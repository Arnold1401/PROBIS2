<?php
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
        $nama= $row['nama_barang'] ;
        $harga=$row['harga_jual']; 
		$foto=$row['foto_barang']; 
		$fharga=number_format($harga);
		$brand="";
		$kal.="<div class='card col-sm-4 col-lg-3 col-md-3' >
		<img class='card-img-top' src=\"../images/$foto\" alt='Card image cap'>
		<div class='card-body'>
		<p align='center'><strong><a >$nama</a></strong></p>
		<p align='center'><a class='text-warning'>Rp.$fharga</a></p>
		<span class='icon-shopping_cart'>Cart</span>&nbsp;&nbsp;<span class='icon-eye'>Detail</span>
		</div>
	  </div>";
        
    }
    echo $kal;
    $conn->close();
}

if ($_POST["jenis"] == "filter") {
    $conn=getConn();
    $query = "SELECT * FROM barang";
	
	$minprice=$_POST["minimum_price"];
	$maxprice=$_POST["maximum_price"];

	if ($maxprice!=""&&$minprice!="") {
		//$query.= "harga_jual BETWEEN '$minprice' AND '$maxprice'";
	}

	// if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	// { ... }


	// if(isset($_POST["brand"]))
	// {
	// 	$brand_filter = implode("','", $_POST["brand"]);
	// 	$query .= "
	// 	 AND jenis_barang IN('".$brand_filter."')
	// 	";
	// }

	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->get_result();
	$total_row = $statement->num_rows();
	$kal = '';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$nama= $row['nama_barang'] ;
			$harga=$row['harga_jual']; 
			$foto=$row['foto_barang']; 

			$kal.= "<div class='col-sm-4 col-lg-3 col-md-3'>
			<div style='border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:450px;'>
				<img src=\"../images/$foto\" alt='' class='img-responsive' >
				<p align='center'><strong><a href=''>$nama</a></strong></p>
				<h4 style='text-align:center;' class='text-danger' >$harga</h4>
				Brand :$brand <br />
			</div>
			</div>";
		}
	}
	else
	{
		$kal = '<h3>No Data Found</h3>';
		$kal.="max:$maxprice&min:$minprice";
	}
	echo $kal;
}

?>