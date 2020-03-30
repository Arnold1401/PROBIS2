<tbody>
                                        
                                        <?php
                                            $urutan = 1;
                                            $res = mysqli_query(getConn(), "select * from sales LIMIT $mulai, $isi");
                                            if (mysqli_num_rows($res)>0) {
                                                while ($data = mysqli_fetch_assoc($res)) { ?>
                                                    <tr> 
                                                        <td> <?php echo $data["id_sales"] ?> </td>
                                                        <td> <?php echo $data["nama_sales"]; ?> </td>
                                                        <td> <?php echo $data["email"]; ?> </td>
                                                        <td> <?php echo $data["no_ktp"]?></td>
                                                        <td> <?php echo $data["provinsi"].", ".$data["kota"].", ".$data["kecamatan"].", ".$data["alamat"] ?></td>
                                                        <td> <?php echo $data["nomor_telepon"]; ?> </td>
                                                        <td>
                                                        <?php echo "<a href='#myModal' class='btn btn-default btn-small' id='id_sales' data-toggle='modal' data-id=".$data['id_sales'].">Detail</a>"; ?>

                                                            <button type="button" id="listreseller" class="btn btn-primary" data-toggle="modal" data-target="#myModal" value="<?php echo $data['id_sales']?>" onclick="listreseller(this,event)">List Reseller</button>                                                                           
                                                        </td>
                                                    </tr>
                                        <?php     }
                                            }
                                        ?>
                                        
                                    </tbody>


                                    if($_POST['rowid']) {
    $id = $_POST['rowid'];
    $conn = getConn();
    // mengambil data berdasarkan id
    echo "xx";
    $sql = "select * from customer where id_sales='$id'";
    $result = $conn->query($sql);
    foreach ($result as $baris) { ?>
    <table id="example" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>kode barang</th>
                <th>Nama barang</th>
                <th>Deskripsi barang</th>
            </tr>

        </thead>
        <tbody>
            <tr>
               
                <td><?php echo $baris['email']; ?></td>
            </tr>
            <tr>
               
                <td><?php echo $baris['nama_perusahaan']; ?></td>
            </tr>
            <tr>
               
                <td><?php echo $baris['id_sales']; ?></td>
            </tr>
        </tbody>

        </table>
    <?php 

    }
    $conn->close();
}
