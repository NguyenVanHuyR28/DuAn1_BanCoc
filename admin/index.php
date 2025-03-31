<?php
session_start();
require_once '../commons/env.php';
require_once '../commons/function.php';

// Controllers
require_once './controllers/AdminDanhMucController.php';
require_once './controllers/HomeAdminController.php';
require_once './controllers/AdminSanPhamController.php';

// Models
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanPham.php';


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
};