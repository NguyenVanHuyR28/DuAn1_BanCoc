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

        if(!$_SESSION['tai_khoan']){
            header('location:' .BASE_URL.'?act=dangnhap');
            $_SESSION['error'] = "Đăng nhập để thêm sản phẩm giỏ hàng";
        }else{
            foreach($listTK as $value){
                if($_SESSION['tai_khoan'] == $value['email']){
                    $tai_khoan_id = $value['id'];
                }
            }
        }
        if(!$tai_khoan_id){
            $_SESSION['error'] = "Vui lòng đăng nhập để xem giỏ hàng!";
            header('location:' .BASE_URL.'?act=dangnhap');
            exit;
        }

        $cartItems = $this->modelGioHang->getAllCart($tai_khoan_id);
        // var_dump($cartItems);
        require_once('views/gioHang.php');
    }


    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ POST
            $san_pham_id = isset($_POST['san_pham_id']) ? (int)$_POST['san_pham_id'] : 0;
            $so_luong = isset($_POST['so_luong']) ? (int)$_POST['so_luong'] : 1;

            // Kiểm tra đăng nhập
            if (!isset($_SESSION['tai_khoan']) || empty($_SESSION['tai_khoan'])) {
                $_SESSION['error'] = "Đăng nhập để thêm giỏ hàng";
                header('Location: ' . BASE_URL . '?act=dangnhap');
                exit;
            }

            // Lấy danh sách tài khoản
            $listTk = $this->modelTaiKhoan->getAllTaiKhoan();

            // Tìm tai_khoan_id dựa trên email trong session
            foreach ($listTk as $value) {
                if ($_SESSION['tai_khoan'] === $value['email']) { // So sánh chính xác
                    $tai_khoan_id = (int)$value['id'];
                    break;
                }
            }

            // Kiểm tra nếu không tìm thấy tai_khoan_id
            if ($tai_khoan_id === null) {
                $_SESSION['error'] = "Tài khoản không hợp lệ hoặc không tồn tại";
                header('Location: ' . BASE_URL . '?act=dangnhap');
                exit;
            }
            // Thêm vào giỏ hàng
            $check = $this->modelGioHang->addCart($tai_khoan_id, $san_pham_id, $so_luong);

            if ($check) {
                echo "<script>
                alert('Thêm giỏ hàng thành công!');
                window.location.href='" . BASE_URL . "?act=gio-hang" . "';
                </script>";
            } else {
                echo "<script>
                alert('Thêm giỏ hàng thất bại!');
                window.location.href='" . BASE_URL . "?act=gio-hang" . "';
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