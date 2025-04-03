<?php
class HomeController
{
    public $modelDanhMuc;
    public $modelSanPham;

    public function __construct()
    {
        $this->modelDanhMuc = new DanhMuc();
        $this->modelSanPham = new SanPham();
        // $this->modelTaiKhoan = new TaiKhoan();
        // // $this->modelBinhLuan = new BinhLuan();
        // $this->modelGioHang = new GioHang();
        // $this->modelDonHang = new DonHang();
    }

    public function home()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once('./views/home.php');
    }
    // sản phẩm

    public function chiTietSanPham()
    {
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        // $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        if (isset($_SESSION['user_client'])) {
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
        }
        //binhluan
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);

        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamDanhMuc($sanPham['id_dm']);

        if ($sanPham) {
            require_once './views/detailSanPham.php';
        } else {
            header('Location: ' . BASE_URL);
            exit();
        }
    }


    public function allSanPham()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/sanpham.php';
    }

    public function danhSachSanPhamTheoDanhMuc()
    {

        $id_dm = isset($_GET['id_dm']) ? $_GET['id_dm'] : null;




        if ($id_dm) {
            $listSanPham = $this->modelSanPham->getSanPhamByCategory($id_dm);
        } else {

            $listSanPham = $this->modelSanPham->getAllSanPham();
        }

        // Truyền danh sách sản phẩm và danh mục vào view
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/sanphamdanhmuc.php';
    }
}
