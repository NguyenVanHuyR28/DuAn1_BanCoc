<?php
class GioHangController{
    public $modelGioHang;

    public function __construct(){
        $this->modelGioHang = new GioHang();
    }
    public function gioHang()
    {
        $gioHang = $this->modelGioHang->getAllCart();
        // var_dump($gioHang);die;
        require_once('views/gioHang.php');
    }

    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tai_khoan_id = 1;
            $san_pham_id = (int)$_POST['san_pham_id'];
            $so_luong = (int)$_POST['so_luong'];
            // var_dump($tai_khoan_id, $san_pham_id,  $so_luong);
            // die;
            $check = $this->modelGioHang->addCart($tai_khoan_id, $san_pham_id, $so_luong);
            // var_dump($check);
            // die;
            header('location: ' . BASE_URL . '?act=gioHang');
            exit;
        }
    }

    public function deleteCart(){
        $id = $_GET['id'];
        $item = $this->modelGioHang->detailCart($id);
        if ($id) {
            $this->modelGioHang->deleteCart($id);
            deleteFile($item['hinh_anh']);
            header('location:' . BASE_URL .'?act=gioHang');
        } else {
            header('location:' . BASE_URL .'?act=gioHang');
        }
    }

}