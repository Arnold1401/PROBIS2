<?php
class Item {
  // Properties
  public $idbarang="";
  public $jum="";

  public $nama="";
  public $harga=0;
  
  //getter
  function get_jum() {
    return $this->jum;
  }

  function get_idbarang() {
    return $this->idbarang;
  }

//setter
function set_jum($jum) {
    $this->jum = $jum;
    }

  function set_idbarang($idb) {
    $this->idbarang = $idb;
  }

  function get_nama(){
    $conn=getConn();
    $idb=$this->idbarang;
    $sql="select upper(nama_barang) as nm from detail_barang db ,barang b where db.id_barang=b.id_barang and db.id_detail_barang='$idb'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
      $nama=$row['nm'];
    }
    return $nama;
    $conn->close();
  }

  function get_harga(){
    $conn=getConn();
    $idb=$this->idbarang;
    $sql="select harga_jual as hg from barang b,detail_barang db where db.id_barang=b.id_barang and db.id_detail_barang='$idb'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
      $harga=$row['hg'];
    }
    return $harga;
    $conn->close();
  }


  function get_gambar(){
    $conn=getConn();
    $idb=$this->idbarang;
    $sql="select b.foto_barang as gmb from barang b,detail_barang db where db.id_barang=b.id_barang and db.id_detail_barang='$idb' ";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
      $gambar1=$row['gmb'];
    }
    return $gambar1;
    $conn->close();
  }

  function get_berat(){
    $conn=getConn();
    $idb=$this->idbarang;
    $sql="select db.berat as w from barang b,detail_barang db where db.id_barang=b.id_barang and db.id_detail_barang='$idb' ";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
      $weight=$row['w'];
    }
    return $weight;
    $conn->close();
  }


  
}
