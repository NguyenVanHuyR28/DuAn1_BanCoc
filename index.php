<?php
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/GioHangController.php';
require_once './controllers/DonHangContronller.php';

// Require toàn bộ file Models
require_once './models/DanhMuc.php';
require_once './models/SanPham.php';
require_once './models/GioHang.php';
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
    'chi-tiet-san-pham' => (new HomeController())->detailSanPham(),
    // Giỏ Hàng
    'gioHang' => (new GioHangController())->gioHang(),
    'them-gio-hang' => (new GioHangController())->addGioHang(),
    'delete-gio-hang' => (new GioHangController())->deleteCart(),
    'thanh-toan'  => (new DonHangContronller) ->thanhToan(),
};
