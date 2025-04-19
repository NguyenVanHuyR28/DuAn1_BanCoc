<?php

class DonHangController
{
    public $modelGioHang;
    public $modelTaiKhoan;
    public $modelSanPham;
    public $modelDonHang;

    public function __construct()
    {
        $this->modelGioHang = new GioHang();

        $this->modelTaiKhoan = new TaiKhoan();

        $this->modelDonHang = new DonHang();

        $this->modelSanPham = new SanPham();
    }
    public function datHang()
    {
        try {
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

                foreach ($items as $item) {
                    // Lấy thông tin sản phẩm
                    $sanPham = $this->modelSanPham->getDetailSanPham($item['san_pham_id']);
                    // var_dump($sanPham);die;
                    // Kiểm tra số lượng sản phẩm có đủ không
                    if ($sanPham['so_luong'] < $item['so_luong']) {
                        echo "<script>
                        alert('Sản phẩm \"{$sanPham['ten_san_pham']}\" không đủ số lượng để đặt hàng!');
                        window.location.href='" . BASE_URL . "?act=gio-hang';
                        </script>";
                        exit();
                    }

                    // Kiểm tra số lượng tối đa
                    $soLuongMax = $sanPham['so_luong_toi_da'] ?? 20;
                    if ($item['so_luong'] > $soLuongMax) {
                        echo "<script>
                        alert('Số lượng bạn muốn đặt sản phẩm \"{$sanPham['ten_san_pham']}\" vượt quá giới hạn cho phép (tối đa $soLuongMax sản phẩm).');
                        window.location.href='" . BASE_URL . "?act=gio-hang';
                        </script>";
                        exit();
                    }
                }

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

                // Gọi model để tạo đơn hàng (Thêm $items)
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
                // var_dump($check);die;
                // Nếu thành công, xoá giỏ hàng và thông báo
                if ($check) {
                    $this->modelGioHang->deleteAllCart($tai_khoan_id);
                    echo "<script>
                    alert('Đặt hàng thành công!');
                    window.location.href='" . BASE_URL . "?act=lich-su';
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
        } catch (Exception $e) {
            error_log('Chi tiết lỗi đơn hàng: ' . $e->getMessage());
            echo 'Có lỗi xảy ra trong quá trình truy vấn.';
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


                $chiTietDonHang = $this->modelDonHang->detailOrder($order_id);

                if (!empty($chiTietDonHang)) {
                    $thongTinDonHang = $chiTietDonHang[0]; // Lấy thông tin chung của đơn hàng
                } else {
                    $thongTinDonHang = [];
                }
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


    public function capNhat()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $don_hang_id = $_POST['don_hang_id'] ?? '';

            if (!$don_hang_id) {
                echo "Thiếu ID đơn hàng!";
                exit;
            }
            var_dump($don_hang_id);
            die;
            // Lấy đơn hàng từ DB
            $thongTinDonHang = $this->modelDonHang->getTrangThai($don_hang_id);


            if (!$thongTinDonHang) {
                echo "Không tìm thấy đơn hàng!";
                exit;
            }

            $trang_thai_hien_tai = $thongTinDonHang['trang_thai_id'] ?? '';
            // var_dump($trang_thai_hien_tai);die;

            // Chỉ cho phép hủy nếu đang ở trạng thái 'pending' hoặc 'processing'
            if (!in_array($trang_thai_hien_tai, [10])) {
                echo "Không thể hủy đơn hàng vì đã được giao hoặc hoàn tất.";
                exit;
            }

            // Cập nhật trạng thái thành canceled
            $daHuy = $this->modelDonHang->updateTrangThai(1, $don_hang_id);

            if ($daHuy) {
                header("Location: " . BASE_URL . "?act=chi-tiet-don-hang&id=" . $don_hang_id);
                exit;
            } else {
                echo "Lỗi khi cập nhật trạng thái đơn hàng.";
                exit;
            }
        } else {
            echo "Phương thức gửi không hợp lệ.";
            exit;
        }
    }
}
