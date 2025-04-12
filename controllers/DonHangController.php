<?php

class DonHangController
{
    public $modelGioHang;
    public $modelTaiKhoan;

    public $modelDonHang;

    public function __construct()
    {
        $this->modelGioHang = new GioHang();

        $this->modelTaiKhoan = new TaiKhoan();

        $this->modelDonHang = new DonHang();
    }
    public function datHang()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra đăng nhập
            if (!isset($_SESSION['tai_khoan']) || empty($_SESSION['tai_khoan'])) {
                $_SESSION['error'] = "Vui lòng đăng nhập để đặt hàng";
                header('Location: ' . BASE_URL . '?act=dangnhap');
                exit;
            }

            // Lấy thông tin tài khoản
            $listTk = $this->modelTaiKhoan->getAllTaiKhoan();
            foreach ($listTk as $value) {
                if ($_SESSION['tai_khoan'] === $value['email']) {
                    $tai_khoan_id = $value['id'];
                    break;
                }
            }

            // Lấy danh sách sản phẩm trong giỏ hàng theo tài khoản
            $items = $this->modelGioHang->getAllCart($tai_khoan_id);
            // var_dump($items);die;
            // Tạo mã đơn hàng ngẫu nhiên
            function randomChuoi($length = 8)
            {
                $chars = '0123456789ABCDEFGHIKLM';
                return substr(str_shuffle(str_repeat($chars, ceil($length / strlen($chars)))), 0, $length);
            }

            // Lấy dữ liệu từ form
            $tong_tien = $_POST['tong_tien'] ?? '';
            $ma_don_hang = randomChuoi();
            $ngay_tao = date('Y-m-d H:i:s');
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'] ?? '';
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'] ?? '';
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'] ?? '';
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'] ?? '';
            $ghi_chu = $_POST['ghi_chu'] ?? '';
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'] ?? 1;

            // Gọi model để tạo đơn hàng (THÊM $items)
            $check = $this->modelDonHang->createDonHang(
                $ma_don_hang,
                $tai_khoan_id,
                $tong_tien,
                $ngay_tao,
                $ten_nguoi_nhan,
                $email_nguoi_nhan,
                $sdt_nguoi_nhan,
                $dia_chi_nguoi_nhan,
                $ghi_chu,
                $phuong_thuc_thanh_toan_id,
                $items // <== thêm dòng này
            );
            // var_dump($check);
            // die;
            // Nếu thành công, xoá giỏ hàng và thông báo
            if ($check) {
                $this->modelGioHang->deleteAllCart($tai_khoan_id);
                echo "<script>
                alert('Đặt hàng thành công!');
                window.location.href='" . BASE_URL . "?act=/';
                </script>";
                exit;
            } else {
                echo "<script>
                alert('Đặt hàng thất bại!');
                window.location.href='" . BASE_URL . "?act=gio-hang';
                </script>";
                exit;
            }
        } else {
            // Hiển thị form đặt hàng (nếu cần)
            require_once('views/home.php');
        }
    }


    public function lichSuDonHang()
    {
        // var_dump($_SESSION['tai_khoan']);die;
        $listTK = $this->modelTaiKhoan->getAllTaiKhoan();
        if (!$_SESSION['tai_khoan']) {
            header('location:' . BASE_URL . '?act=dangnhap');
            $_SESSION['error'] = "Đăng nhập để thêm sản phẩm giỏ hàng";
        } else {
            foreach ($listTK as $value) {
                if ($_SESSION['tai_khoan'] == $value['email']) {
                    $tai_khoan_id = $value['id'];
                    // var_dump($value['id']);die;
                    break;
                }
            }
        }
        // var_dump($tai_khoan_id);die;
        $historyItem = $this->modelDonHang->historyDonHang($tai_khoan_id);
        // var_dump($historyItem);die;

        require_once('views/lichSuDon.php');
    }

    public function detailDonHang()
    {
        try {
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $order_id = $_GET['id'];
                // var_dump($order_id);die;
                // Lấy thông tin đơn hàng (người nhận, email, SDT, trạng thái, ghi chú...)
                $chiTietDonHang = $this->modelDonHang->detailOrder($order_id);
                $thongTinDonHang = $chiTietDonHang[0];
                // var_dump($chiTietDonHang);die;

                // Gửi dữ liệu sang view
                require_once('views/chiTietDonHang.php');
            } else {
                echo "ID đơn hàng không hợp lệ.";
            }
        } catch (Exception $e) {
            error_log('Chi tiết lỗi đơn hàng: ' . $e->getMessage());
            echo 'Có lỗi xảy ra trong quá trình truy vấn.';
        }
    }
}
