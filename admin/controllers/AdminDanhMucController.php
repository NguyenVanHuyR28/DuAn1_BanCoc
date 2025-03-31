<?php
class AdminDanhMucController
{
    public $modelDanhMuc;

    public function __construct()
    {
        $this->modelDanhMuc = new AdminDanhMuc();
    }

    public function listDanhMuc()
    {
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once('views/danhmuc/listDanhMuc.php');
    }
    public function formAddDanhMuc()
    {
        require_once('views/danhmuc/addDanhMuc.php');
    }
    public function addDanhMuc()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            $error = [];
            if (empty($ten_danh_muc)) {
                $error['ten_danh_muc'] = 'Vui lòng nhập tên danh mục';
            }
            $_SESSION['error'] = $error;

            if (empty($error)) {
                $this->modelDanhMuc->insertDanhMuc($ten_danh_muc, $mo_ta);
                header('Location: ' . BASE_URL_ADMIN . 'listDanhMuc');
                exit();
            } else {
                require_once('views/danhmuc/addDanhMuc.php');
            }
        }
    }
    public function formEditDanhMuc()
    {
        $id = $_GET['id'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        if ($danhMuc) {
            require_once('views/danhmuc/editDanhMuc.php');
        } else {
            echo 'Danh mục không tồn tại';
            header('Location:' . BASE_URL_ADMIN . 'formEditDanhMuc');
            exit();
        }
    }
    public function editDanhMuc()
    {
        // Dùng để thêm dữ liệu


        // kiểm tra xem dữ liệu có submit vào không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu
            $id = $_POST['id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            // Tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = 'Tên danh mục không được để trống!';
            }
            // Nếu không lỗi thì tiến hành Sửa danh mục
            if (empty($errors)) {
                // Nếu errors rỗng thì tiến hành Sửa
                $this->modelDanhMuc->editDanhMuc($id, $ten_danh_muc, $mo_ta);
                header('location: ' . BASE_URL_ADMIN . 'listDanhMuc');
                exit();
            } else {
                // Trả về form và lỗi
                $danhMuc = ['id' => $id, 'ten_danh_muc' => $ten_danh_muc];
                require_once "./views/DanhMuc/editDanhMuc.php";
            }
        }
    }

    public function deleteDanhMuc()
    {
        // Lấy ra thông tin danh mục cần xóa
        $id = $_GET['id'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        if ($id) {
            $this->modelDanhMuc->deleteDanhMuc($id);
            header('location: ' . BASE_URL_ADMIN . 'listDanhMuc');
            exit();
        } else {
            header('location: ' . BASE_URL_ADMIN . 'listDanhMuc');
        }
    }
}
