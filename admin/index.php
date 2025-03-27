<?php
session_start();
require_once '../commons/env.php';
require_once '../commons/function.php';

require_once './controllers/AdminDanhMucController.php';
require_once './controllers/HomeAdminController.php';

require_once './models/AdminDanhMuc.php';


//route 
$act = $_GET['act'] ?? '/';
//checklogin admin
// if ($act !== 'login-admin' && $act !== 'logout-admin') {
//   checkLoginAdmin();
//  }
match($act) {
    //router danh mục
    '/' => (new HomeAdminController())->home(),
    'danh-muc' => (new AdminDanhMucController())->danhSachDanhMuc(),
    'form-them-danh-muc' => (new AdminDanhMucController())->formAddDanhMuc(),
    // 'them-danh-muc' => (new AdminDanhMucController())->postAddDanhMuc(),
    'form-sua-danh-muc' => (new AdminDanhMucController())->formEditDanhMuc(),
    // 'sua-danh-muc' => (new AdminDanhMucController())->postEditDanhMuc(),
    // 'xoa-danh-muc' => (new AdminDanhMucController())->deleteDanhMuc(),
};