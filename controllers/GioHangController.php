<?php
class GioHangController
{
    public $modelGioHang;

    public $modelTaiKhoan;

    public function __construct()
    {
        $this->modelGioHang = new GioHang();

        $this->modelTaiKhoan = new TaiKhoan();
    }
    public function gioHang()
    {
        $listTK = $this->modelTaiKhoan->getAllTaiKhoan();

        // Kiểm tra nếu không có session người dùng hoặc admin
        if (!isset($_SESSION['tai_khoan']) && !isset($_SESSION['tai_khoan_admin'])) {
            $_SESSION['error'] = "Vui lòng đăng nhập để xem giỏ hàng!";
            header('location:' . BASE_URL . '?act=dangnhap');
            exit;
        }

        // Xác định tài khoản hiện tại
        $email = isset($_SESSION['tai_khoan']) ? $_SESSION['tai_khoan'] : $_SESSION['tai_khoan_admin'];

        // Tìm `tai_khoan_id` dựa trên email
        foreach ($listTK as $value) {
            if ($email === $value['email']) {
                $tai_khoan_id = $value['id'];
                break;
            }
        }

        // Kiểm tra nếu không tìm thấy tài khoản
        if (!isset($tai_khoan_id)) {
            $_SESSION['error'] = "Tài khoản không hợp lệ!";
            header('location:' . BASE_URL . '?act=dangnhap');
            exit;
        }

        // Lấy danh sách giỏ hàng
        $cartItems = $this->modelGioHang->getAllCart($tai_khoan_id);
        require_once('views/gioHang.php');
    }

    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ POST
            $san_pham_id = isset($_POST['san_pham_id']) ? (int)$_POST['san_pham_id'] : 0;
            $so_luong = isset($_POST['so_luong']) ? (int)$_POST['so_luong'] : 1;

            // Kiểm tra nếu không có session người dùng hoặc admin
            if (!isset($_SESSION['tai_khoan']) && !isset($_SESSION['tai_khoan_admin'])) {
                $_SESSION['error'] = "Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng!";
                header('Location: ' . BASE_URL . '?act=dangnhap');
                exit;
            }

            // Xác định tài khoản hiện tại
            $email = isset($_SESSION['tai_khoan']) ? $_SESSION['tai_khoan'] : $_SESSION['tai_khoan_admin'];

            // Lấy danh sách tài khoản
            $listTK = $this->modelTaiKhoan->getAllTaiKhoan();

            // Tìm `tai_khoan_id` dựa trên email
            foreach ($listTK as $value) {
                if ($email === $value['email']) {
                    $tai_khoan_id = $value['id'];
                    break;
                }
            }

            // Kiểm tra nếu không tìm thấy tài khoản
            if (!isset($tai_khoan_id)) {
                $_SESSION['error'] = "Tài khoản không hợp lệ!";
                header('Location: ' . BASE_URL . '?act=dangnhap');
                exit;
            }

            // Thêm sản phẩm vào giỏ hàng
            $check = $this->modelGioHang->addCart($tai_khoan_id, $san_pham_id, $so_luong);

            if ($check) {
                echo "<script>
                    alert('Thêm sản phẩm vào giỏ hàng thành công!');
                    window.location.href='" . BASE_URL . "?act=gio-hang';
                </script>";
            } else {
                echo "<script>
                    alert('Thêm sản phẩm vào giỏ hàng thất bại!');
                    window.location.href='" . BASE_URL . "?act=gio-hang';
                </script>";
            }
        }
    }

    public function deleteCart()
    {
        $id = $_GET['id'];
        $item = $this->modelGioHang->detailCart($id);
        if ($id) {
            $this->modelGioHang->deleteCart($id);
            deleteFile($item['hinh_anh']);
            echo "<script>
                alert('Xóa sản phẩm hàng thành công!');
                window.location.href='" . BASE_URL . "?act=gio-hang" . "';
                </script>";
        } else {
            header('location:' . BASE_URL . '?act=gioHang');
        }
    }
}