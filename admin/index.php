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
    'listDanhMuc' => (new AdminDanhMucController())->listDanhMuc(),
    'formAddDanhMuc' => (new AdminDanhMucController())->formAddDanhMuc(),
    'addDanhMuc' => (new AdminDanhMucController())->addDanhMuc(),
    'formEditDanhMuc' => (new AdminDanhMucController())->formEditDanhMuc(),
    'editDanhMuc' => (new AdminDanhMucController())->editDanhMuc(),
    'deleteDanhMuc' => (new AdminDanhMucController())->deleteDanhMuc(),
    

};