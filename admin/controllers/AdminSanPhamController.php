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

    public function showSanPham()
    {
        $id = $_GET['id'];
        $sanPham = $this->modelSanPham->getShow($id);
        require_once('./views/sanpham/show.php');
    }

    public function formAddSanPham()
    {
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once('views/sanpham/addSanPham.php');
        unset($_SESSION['error']);
        unset($_SESSION['old']);
    }

    public function addSanPham()
    {
        // Kiểm tra dữ liệu
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu
            $danh_muc_id = $_POST['danh_muc_id'] ?? '';
            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia = $_POST['gia'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? null;
            $so_luong = $_POST['so_luong'] ?? '';
            $hinh_anh = $_FILES['hinh_anh'];
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
            } else {
                // Kiểm tra giá khuyến mãi có lớn hơn giá gốc không
                if (!empty($gia_khuyen_mai) && $gia_khuyen_mai > $gia) {
                    $error['gia_khuyen_mai'] = 'Giá khuyến mãi không được lớn hơn giá gốc';
                }
            }
            if (empty($so_luong)) {
                $error['so_luong'] = 'Vui lòng nhập số lượng';
            }
            if (empty($file_thumb)) {
                $error['hinh_anh'] = 'Vui lòng chọn ảnh sản phẩm';
            }
            $loi = 0;

            $_SESSION['old'] = $_POST;
            $_SESSION['error'] = $error;

            if (empty($error)) {
                // unset($_SESSION['error']);
                // unset($_SESSION['old']);

                $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
                if ($gia_khuyen_mai === '') {
                    $gia_khuyen_mai = 0; // hoặc null nếu DB cho phép
                }
                $this->modelSanPham->insertSanPham($danh_muc_id, $ten_san_pham, $gia, $gia_khuyen_mai, $so_luong, $file_thumb, $mo_ta);

                unset($_SESSION['error']);
                unset($_SESSION['old']);
                header('location: ' . BASE_URL_ADMIN . '?act=listSanPham');
                exit();
            } else {
                // var_dump(123);die;

                $_SESSION['error'] = $error;
                $_SESSION['old'] = $_POST;
                header('location: ' . BASE_URL_ADMIN . '?act=formAddSanPham');
                // unset($_SESSION['error']);
                // unset($_SESSION['old']);
                exit();
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
            header('Location:' . BASE_URL_ADMIN . '?act=formEditSanPham');
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
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? null;
            $mo_ta = $_POST['mo_ta'] ?? '';

            // Lấy ảnh cũ từ database
            $old_file = $products['hinh_anh'];
            // var_dump($old_file);die;
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
            } else {
                // Kiểm tra giá khuyến mãi có lớn hơn giá gốc không
                if (!empty($gia_khuyen_mai) && $gia_khuyen_mai > $gia) {
                    $error['gia_khuyen_mai'] = 'Giá khuyến mãi không được lớn hơn giá gốc';
                }
            }
            if (empty($so_luong)) {
                $error['so_luong'] = 'Vui lòng nhập số lượng';
            }
            if (empty($hinh_anh)) {
                $error['hinh_anh'] = 'Vui lòng chọn hình ảnh';
            }
            if (empty($mo_ta)) {
                $error['mo_ta'] = 'Nhập mô tả của sản phẩm';
            }

            // Xử lý ảnh (nếu có upload mới)
            if ($hinh_anh && $hinh_anh['error'] !== UPLOAD_ERR_NO_FILE) {
                $new_file = uploadFile($hinh_anh, 'assets/img/product/');
                if ($new_file) {
                    // Xóa ảnh cũ (nếu có)
                    if (!empty($old_file)) {
                        $path = 'assets/img/product/' . $old_file;
                        if (file_exists($path)) {
                            unlink($path); // hoặc dùng deleteFile($old_file)
                        }
                    }
                } else {
                    $error['hinh_anh'] = 'Lỗi khi tải ảnh lên';
                    $new_file = $old_file; // fallback ảnh cũ
                }
            } else {
                $new_file = $old_file;
            }

            $_SESSION['error'] = $error;

            if (empty($error)) {
                unset($_SESSION['error']); // Xóa lỗi nếu cập nhật thành công
                unset($_SESSION['old']);
                $this->modelSanPham->editSanPham($id, $danh_muc_id, $ten_san_pham, $gia, $gia_khuyen_mai, $so_luong, $trang_thai, $new_file, $mo_ta);
                header('location: ' . BASE_URL_ADMIN . '?act=listSanPham');
                exit();
            } else {
                $_SESSION['flash'] = true;
                header('location: ' . BASE_URL_ADMIN . '?act=formEditSanPham&id=' . $id);
                exit();
            }
        }
    }
}
