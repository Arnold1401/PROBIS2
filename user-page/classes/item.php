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
    $sql="select upper(nama_barang) as nm from barang where id_barang='$idb'";
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
    $sql="select harga_jual as hg from barang where id_barang='$idb'";
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
    $sql="select foto_barang as gmb from barang where id_barang='$idb'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
      $gambar1="images/".$row['gmb'];
    }
    return $gambar1;
    $conn->close();
  }


  
}
