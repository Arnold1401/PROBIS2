<?php
    class Item {
 
        private $idcart;
        private $iduser;
        private $idbarang;
        private $jumlah;
        private $harga;
        private $subtotal;
        private $nama;
        private $gambar;
     
        function __construct($idcart,$iduser,$idbarang,$jumlah,$harga,$subtotal,$nama,$gambar) {
            $this->idcart = $idcart;
            $this->iduser= $iduser;
            $this->idbarang = $idbarang;
            $this->jumlah = $jumlah;
            $this->harga = $harga;
            $this->subtotal = $subtotal;
            $this->nama = $nama; 
            $this->gambar = $gambar; 

        }
     
        function getJumlah() {
            return $this->jumlah;
        }
     
        public function tambah(){
            $jum= $this->jumlah;
            $this->jumlah = $jum+1;
        }

        public function kurang(){
            $jum= $this->jumlah;
            $this->jumlah = $jum-1;
        }

        function getIdCart() {
            return $this->idcart;
        }

        function getIdUser() {
            return $this->iduser;
        }

        function getIdBarang() {
            return $this->idbarang;
        }

        function getHarga() {
            return $this->harga;
        }

        function getSubtotal() {
            return $this->subtotal;
        }

        function getNama() {
            return $this->nama;
        }

        function getGambar() {
            return $this->gambar;
        }
        // function isAdult() {
        //     return $this->age >= 18?"an Adult":"Not an Adult";
        // }
     
    }
?>