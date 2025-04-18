<?php
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/GioHangController.php';
require_once './controllers/DonHangController.php';

// Require toàn bộ file Models
require_once './models/DanhMuc.php';
require_once './models/SanPham.php';
require_once './models/GioHang.php';
require_once './models/TaiKhoan.php';
require_once './models/DonHang.php';

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match


match ($act) {
    //     // Trang chủ
    '/' => (new HomeController())->home(),

    //sanpham
    'allsanpham' => (new HomeController())->allSanPham(),
    'sanphamdanhmuc' => (new HomeController())->danhSachSanPhamTheoDanhMuc(),
    'chi-tiet-san-pham' => (new HomeController())->detailSanPham(),
    // Giỏ Hàng
    'gio-hang' => (new GioHangController())->gioHang(),
    'them-gio-hang' => (new GioHangController())->addGioHang(),
    'delete-gio-hang' => (new GioHangController())->deleteCart(),
    'thanh-toan'  => (new HomeController())->thanhToan(),
    // Thanh Toán
    'dat-hang' => (new DonHangController())->datHang(),
    'lich-su' => (new DonHangController())->lichSuDonHang(),
    'chi-tiet-don-hang' => (new DonHangController())->detailDonHang(),
    'cap-nhat' => (new DonHangController())->capNhat(),
    // Đăng nhập
    'dangnhap' => (new HomeController())->formDangNhap(),
    'checkdangnhap' => (new HomeController())->dangNhap(),
    'dangky' => (new HomeController())->formDangKy(),
    'checkdangky' => (new HomeController())->dangKy(),
    'xoaghinho' => (new HomeController())->xoaCookie(),
    'dangxuat' => (new HomeController())->logout(),

//     //chinh-sua-thong-tin-nguoi-dung
    'formchinhsua' => (new HomeController())->formUser(),
    'info-Acc' => (new HomeController())-> infoAcc(),
    'thaydoithongtintaikhoan' => (new HomeController())-> editInfo(),
//     //binhluan
    'dang-binh-luan' => (new HomeController())->postBinhLuan(),
    //     //chinh-sua-thong-tin-nguoi-dung
    //     'form-chinh-sua' => (new HomeController())->formUser(),
    //     'thay-doi-thong-tin-tai-khoan' => (new HomeController())->postUser(),
    //     'sua-mat-khau-ca-nhan' => (new HomeController())->postEditMatKhauCaNhan(),
    //     //binhluan
    //     'dang-binh-luan' => (new HomeController())->postBinhLuan(),

    //     //giỏ hàng

    //     'thanh-toan' => (new HomeController())->thanhToan(),
    //     'xu-ly-thanh-toan' => (new HomeController())->postThanhToan(),

    //     'xoa-san-pham-gio-hang' => (new HomeController())->deleteSpGioHang(),

    //     'chi-tiet-don-hang-user' => (new HomeController())->show(),
    //     'huy-don' => (new HomeController())->huyDon(),
    //     'hoan-don' => (new HomeController())->hoanDon(),
};
