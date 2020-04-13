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
        $brand="";
        $kal.= "<div class='col-sm-4 col-lg-3 col-md-3'>
        <div style='border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:450px;'>
            <img src=\"../images/$foto\" alt='' class='img-responsive' >
            <p align='center'><strong><a href=''>$nama</a></strong></p>
            <h4 style='text-align:center;' class='text-danger' >$harga</h4>
            Brand :$brand <br />
        </div>
        </div>";
    
    }
    echo $kal;
    $conn->close();
}

if ($_POST["jenis"] == "filter") {
    $conn=getConn();
    $query = "SELECT * FROM barang WHERE status_barang ='1'";
    
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND harga_jual BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
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
	$output = '';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$output .= '
			<div class="col-sm-4 col-lg-3 col-md-3">
				<div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:450px;">
					<img src="image/'. $row['foto_barang'] .'" alt="" class="img-responsive" >
					<p align="center"><strong><a href="#">'. $row['nama_barang'] .'</a></strong></p>
					<h4 style="text-align:center;" class="text-danger" >'. $row['harga'] .'</h4>
					
					Brand : '. $row['jenis_barang'] .' <br />

				</div>

			</div>
			';
		}
	}
	else
	{
		$output = '<h3>No Data Found</h3>';
	}
	echo $output;
}

?>