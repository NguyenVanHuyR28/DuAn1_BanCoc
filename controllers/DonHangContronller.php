<?php

class DonHangContronller{
    public $modelGioHang;

    public function __construct(){
        $this->modelGioHang = new GioHang();
    }
    public function thanhToan(){
        $sanPham = $this->modelGioHang->getAllCart();
        require_once('views/thanhToan.php');
    }
}