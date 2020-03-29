<?php
include_once 'adminconn.php';
$conn = getConn();
// admin - master - sales
if ($_POST["jenis"] == "tambah_sales") {
    
    $nama_sales=$_POST["nama_sales"];
    $email=$_POST["email"];
    $no_ktp=$_POST["no_ktp"];
    $nomor_telepon=$_POST["nomor_telepon"];
    $password=$nomor_telepon;
    $provinsi=$_POST["provinsi"];
    $kota=$_POST["kota"];
    $kecamatan=$_POST["kecamatan"];
    $alamat=$_POST["alamat"];
    $status=1;
    $conn = getConn();

    $sql1 = "select * from sales";
    $result1 = $conn->query($sql1);
    $ctr=0;
    while ($row1 = $result1->fetch_assoc()) {
        if ($email == $row1["email"] || $no_ktp == $row1["no_ktp"]) {
            $ctr = 0;
        }
        else {
            $ctr++;
        }
    }

    if ($ctr > 0) {
        $ctr=$ctr+1;
        $sql2 = "insert into sales(id_sales, nama_sales, email, no_ktp, nomor_telepon, password, provinsi, kota, kecamatan, alamat, status) values ('$ctr','$nama_sales','$email',$no_ktp,$nomor_telepon,'$password','$provinsi','$kota','$kecamatan','$alamat','$status')";

        if ($conn->query($sql2)) {
            // echo "berhasil tambah sales"; 
            echo "<script> alert($email)</script>";
        }
        else {
            echo "gagal tambah sales ";
        }

    }
    
    if ($ctr == 0) {
        echo "akun telah terdaftar";
    }
    $conn->close();
}

//list table sales
if ($_POST["jenis"] == "tablesales") {
    $conn = getConn();
    $sql = "SELECT * FROM sales";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
?>	
		<tr>
			<td><?=$row['id_sales'];?></td>
            <td><?=$row['nama_sales'];?></td>
			<td><?=$row['email'];?></td>
            <td><?=$row['no_ktp'];?></td>
			<td><?=$row['nomor_telepon'];?></td>
            <td><?=$row['alamat'];?></td>
			
		</tr>
<?php	
	}
	}
	else {
		echo "0 results";
	}
	mysqli_close($conn);
}

// if ($_POST["jenis"] == "detailsales") {


if ($_POST["jenis"] == "listreseller") {
    $id_sales = $_POST["idsales"];
    $result = mysqli_query(getConn(), "select * from customer where id_sales='".$id_sales."'");
    $trans = mysqli_fetch_array($result);
    echo $id_sales;
    
}

// end of admin - master - sales
?>