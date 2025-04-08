<?php 
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';

// Require toàn bộ file Models
require_once './models/DanhMuc.php';
require_once './models/SanPham.php';
require_once './models/TaiKhoan.php';
// require_once './models/BinhLuan.php';
// require_once './models/GioHang.php';
// require_once './models/DonHang.php';

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
match ($act) {
//     // Trang chủ
    '/' => (new HomeController())->home(),

//     //sanpham
    'allsanpham' => (new HomeController())->allSanPham(),
    'sanphamdanhmuc' => (new HomeController())->danhSachSanPhamTheoDanhMuc(),
    'chitietsanpham' => (new HomeController())->chiTietSanPham(),


//     //authen
    'dangnhap' => (new HomeController())->formDangNhap(),
    'dangxuat' => (new HomeController())->logout(),
    'checkdangnhap' => (new HomeController())->dangNhap(),
    'dangky' => (new HomeController())->formDangKy(),
    'checkdangky' => (new HomeController())->dangKy(),
    'xoaghinho' => (new HomeController())->xoaCookie(),

//     //chinh-sua-thong-tin-nguoi-dung
    'formchinhsua' => (new HomeController())->formUser(),
    'info-Acc' => (new HomeController())-> infoAcc(),
    'thaydoithongtintaikhoan' => (new HomeController())-> editInfo(),
//     //binhluan
//     'dang-binh-luan' => (new HomeController())->postBinhLuan(),

//     //giỏ hàng
//     'them-gio-hang' => (new HomeController())->addGioHang(),
//     'gio-hang' => (new HomeController())->gioHang(),

//     'thanh-toan' => (new HomeController())->thanhToan(),
//     'xu-ly-thanh-toan' => (new HomeController())->postThanhToan(),

//     'xoa-san-pham-gio-hang' => (new HomeController())->deleteSpGioHang(),

//     'chi-tiet-don-hang-user' => (new HomeController())->show(),
//     'huy-don' => (new HomeController())->huyDon(),
//     'hoan-don' => (new HomeController())->hoanDon(),
};
