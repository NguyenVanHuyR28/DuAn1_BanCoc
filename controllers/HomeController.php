<?php
class HomeController
{
    public $modelDanhMuc;
    public $modelSanPham;
    public $modelTaiKhoan;
    public $modelBinhLuan;
    public $modelGioHang;
    public $modelDonHang;

    public function __construct()
    {
        $this->modelDanhMuc = new DanhMuc();
        $this->modelSanPham = new SanPham();
        // $this->modelTaiKhoan = new TaiKhoan();
        // // $this->modelBinhLuan = new BinhLuan();
        $this->modelGioHang = new GioHang();
        // $this->modelDonHang = new DonHang();
    }

    public function home()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once('./views/home.php');
    }
    // sản phẩm

    public function detailSanPham()
    {
        $id = $_GET['id_san_pham'];
        // var_dump($id);
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($sanPham['danh_muc_id']);

        // $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        if (isset($_SESSION['user_client'])) {
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
        }
        //binhluan
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);

        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamDanhMuc($sanPham['danh_muc_id']);

        if ($sanPham && isset($sanPham['danh_muc_id'])) {
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
    public function gioHang()
    {
        $gioHang = $this->modelGioHang->getAllCart();
        // var_dump($gioHang);die;
        require_once('views/gioHang.php');
    }

    public function addCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tai_khoan_id = 1;
            $san_pham_id = (int)$_POST['san_pham_id'];
            $so_luong = (int)$_POST['so_luong'];
            // var_dump($tai_khoan_id, $san_pham_id,  $so_luong);
            // die;
            $check = $this->modelGioHang->addGioHang($tai_khoan_id, $san_pham_id, $so_luong);
            // var_dump($check);
            // die;
            header('location: ' . BASE_URL . '?act=gioHang');
            exit;
        }
    }
}
