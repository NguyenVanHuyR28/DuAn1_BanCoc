<?php
class AdminSanPhamController
{
    public $modelSanPham;
    public $modelDanhMuc;

    public function __construct()
    {
        $this->modelSanPham = new AdminSanPham();
        $this->modelDanhMuc = new AdminDanhMuc();
    }

    public function listSanPham()
    {
        $listSanPham = $this->modelSanPham->getALLSanPham();
        require_once('views/sanpham/listSanPham.php');
    }

    public function formAddSanPham()
    {
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once('views/sanpham/addSanPham.php');
    }

    public function addSanPham()
    {
        // Kiểm tra dữ liệu
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu
            $danh_muc_id = $_POST['danh_muc_id'] ?? '';
            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia = $_POST['gia'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $hinh_anh = $_FILES['hinh_anh'] ?? null;
            $mo_ta = $_POST['mo_ta'] ?? '';
            $file_thumb = uploadFile($hinh_anh, 'assets/img/product/');
            // var_dump($file_thumb);
            // die;

            // Tạo 1 mảng để chứa sữ liệu
            $error = [];
            if (empty($danh_muc_id)) {
                $error['danh_muc_id'] = 'Bắt buộc chọn tên danh mục';
            }
            if (empty($ten_san_pham)) {
                $error['ten_san_pham'] = 'Bắt buộc chọn nhập tên sản phẩm';
            }
            if (empty($gia)) {
                $error['gia'] = 'Bắt buộc nhập giá sản phẩm';
            }
            if (empty($so_luong)) {
                $error['so_luong'] = 'Vui lòng nhập số lượng';
            }
            if (empty($hinh_anh)) {
                $error['hinh_anh'] = 'Vui lòng chọn ảnh sản phẩm';
            }
            if (empty($mo_ta)) {
                $error['mo_ta'] = 'Nhập mô tả của sản phẩm';
            }


            $_SESSION['error'] = $error;
            if (empty($error)) {
                // var_dump(123);
                // die;
                $this->modelSanPham->insertSanPham($danh_muc_id, $ten_san_pham, $gia, $so_luong, $file_thumb, $mo_ta);
                header('location: ' . BASE_URL_ADMIN . 'listSanPham');
                exit();
            } else {
                // var_dump('sai');
                // die;
                require_once('views/sanpham/addSanPham.php');
            }
        }
    }
    public function formEditSanPham()
    {
        $id = $_GET['id'];
        $categories = $this->modelDanhMuc->getAllDanhMuc();
        // var_dump($categories);
        $products = $this->modelSanPham->getDetailSanPham($id);
        if ($products) {
            require_once('views/sanpham/editSanPham.php');
        } else {
            echo 'Sản Phẩm không tồn tại';
            header('Location:' . BASE_URL_ADMIN . 'formEditSanPham');
            exit();
        }
    }

    public function editSanPham()
    {
        $id = $_GET['id'];
        $products = $this->modelSanPham->getDetailSanPham($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $danh_muc_id = $_POST['danh_muc_id'] ?? '';
            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia = $_POST['gia'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';

            // Lấy ảnh cũ từ database
            $old_file = $products['hinh_anh'];

            // Lấy ảnh mới từ form (nếu có)
            $hinh_anh = $_FILES['hinh_anh'] ?? null;

            // Mảng chứa lỗi
            $error = [];

            if (empty($danh_muc_id)) {
                $error['danh_muc_id'] = 'Bắt buộc chọn tên danh mục';
            }
            if (empty($ten_san_pham)) {
                $error['ten_san_pham'] = 'Bắt buộc nhập tên sản phẩm';
            }
            if (empty($gia)) {
                $error['gia'] = 'Bắt buộc nhập giá sản phẩm';
            }
            if (empty($so_luong)) {
                $error['so_luong'] = 'Vui lòng nhập số lượng';
            }
            if (empty($mo_ta)) {
                $error['mo_ta'] = 'Nhập mô tả của sản phẩm';
            }

            // Xử lý ảnh (nếu có upload mới)
            if ($hinh_anh && $hinh_anh['error'] !== UPLOAD_ERR_NO_FILE) {
                $new_file = uploadFile($hinh_anh, 'assets/img/product/');
                if ($new_file) {
                    if (!empty($old_file)) {
                        deleteFile($old_file);
                    }
                } else {
                    $error['hinh_anh'] = 'Lỗi khi tải ảnh lên';
                }
            } else {
                $new_file = $old_file; // Nếu không có ảnh mới, giữ nguyên ảnh cũ
            }

            $_SESSION['error'] = $error;

            if (empty($error)) {
                unset($_SESSION['error']); // Xóa lỗi nếu cập nhật thành công
                $this->modelSanPham->editSanPham($id, $danh_muc_id, $ten_san_pham, $gia, $so_luong, $new_file, $mo_ta);
                header('location: ' . BASE_URL_ADMIN . 'listSanPham');
                exit();
            } else {
                $_SESSION['flash'] = true;
                require_once('views/sanpham/editSanPham.php');
            }
        }
    }


    public function deleteSanPham()
    {
        $id = $_GET['id'];
        $products = $this->modelSanPham->getDetailSanPham($id);
        if ($id) {
            $this->modelSanPham->deleteSanPham($id);
            deleteFile($products['hinh_anh']);
            header('location:' . BASE_URL_ADMIN . 'listSanPham');
        } else {
            header('location:' . BASE_URL_ADMIN . 'listSanPham');
        }
    }
}
