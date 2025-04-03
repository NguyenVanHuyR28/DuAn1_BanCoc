<?php
class HomeController
{
    public $modelDanhMuc;
    public $modelSanPham;

    public function __construct()
    {
        $this->modelDanhMuc = new DanhMuc();
        $this->modelSanPham = new SanPham();
    }

    public function home()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once('./views/home.php');
    }

}
