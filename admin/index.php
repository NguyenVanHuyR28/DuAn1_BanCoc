<?php
session_start();
require_once '../commons/env.php';
require_once '../commons/function.php';

// Controllers
require_once './controllers/AdminDanhMucController.php';
require_once './controllers/HomeAdminController.php';
require_once './controllers/AdminSanPhamController.php';
require_once './controllers/AdminDonHangController.php';
require_once './controllers/AdminTaiKhoanController.php';
require_once './controllers/AdminBinhLuanController.php';
require_once './controllers/AdminBaoCaoThongKeController.php';

// Models
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanPham.php';
require_once './models/AdminDonHang.php';
require_once './models/AdminTaiKhoan.php';
require_once './models/AdminBinhLuan.php';
require_once './models/ThongKe.php';

//route 
$act = $_GET['act'] ?? '/';
//checklogin admin
// if ($act !== 'login-admin' && $act !== 'logout-admin') {
//   checkLoginAdmin();
//  }
match ($act) {

    '/' => (new HomeAdminController())->home(),
    //Router Danh Mục
    'listDanhMuc' => (new AdminDanhMucController())->listDanhMuc(),
    'formAddDanhMuc' => (new AdminDanhMucController())->formAddDanhMuc(),
    'addDanhMuc' => (new AdminDanhMucController())->addDanhMuc(),
    'formEditDanhMuc' => (new AdminDanhMucController())->formEditDanhMuc(),
    'editDanhMuc' => (new AdminDanhMucController())->editDanhMuc(),
    'deleteDanhMuc' => (new AdminDanhMucController())->deleteDanhMuc(),


    // Router Sản Phẩm
    'listSanPham' => (new AdminSanPhamController())->listSanPham(),
    'formAddSanPham' => (new AdminSanPhamController())->formAddSanPham(),
    'addSanPham' => (new AdminSanPhamController())->addSanPham(),
    'formEditSanPham' => (new AdminSanPhamController())->formEditSanPham(),
    'editSanPham' => (new AdminSanPhamController())->editSanPham(),
    'deleteSanPham' => (new AdminSanPhamController())->deleteSanPham(),

    // Router Đơn Hàng
    'listDonHang' => (new AdminDonHangController())->listDonHang(),
    'detailDonHang' => (new AdminDonHangController())->chiTietDonHang(),
    'capNhat' => (new AdminDonHangController())->editTrangThai(),


    //Router Tài Khoản
    'listTaiKhoan' => (new AdminTaiKhoanController())->listTaiKhoan(),
    'formAddTaiKhoan' => (new AdminTaiKhoanController())->formAddTaiKhoan(),
    'postAddTaiKhoan' => (new AdminTaiKhoanController())->postAddtaikhoan(),
    'formEditTaiKhoan' => (new AdminTaiKhoanController())->formEditTaiKhoan(),
    'postEditTaiKhoan' => (new AdminTaiKhoanController())->postEditTaiKhoan(),
    'detailTaiKhoan' => (new AdminTaiKhoanController())->detailTaiKhoan(),
    'deleteTaiKhoan' => (new AdminTaiKhoanController())->deleteTaiKhoan(),

    //Router bình luận
    'listBinhLuan' => (new AdminBinhLuanController())->listBinhLuan(),
    'showBinhLuan' => (new AdminBinhLuanController())->showBinhLuan(),
    'hideBinhLuan' => (new AdminBinhLuanController())->hideBinhLuan(),

    // route báo cáo thống kê - trang chủ
    '/' => (new AdminBaoCaoThongKeController())->home(),
    'top10' => (new AdminBaoCaoThongKeController())->top10sanpham(),
    'don-hang-moi' => (new AdminBaoCaoThongKeController())->donHangMoi(),
    'don-bom' => (new AdminBaoCaoThongKeController())->donBom(),
    'don-hoan' => (new AdminBaoCaoThongKeController())->donHoan(),
};
