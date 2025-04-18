<?php
class AdminDonHangController
{
    public $modelDonHang;

    public function __construct()
    {
        $this->modelDonHang = new AdminDonHang();
    }

    public function listDonHang()
    {
        $listDonHang = $this->modelDonHang->getAllDonHang();
        require_once('views/donhang/listDonHang.php');
    }

    public function chiTietDonHang()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $order_id = intval($_GET['id']);

            // Lấy chi tiết đơn hàng
            $detailItem = $this->modelDonHang->detailDonHang($order_id);
            // var_dump($detailItem);die;
            if (empty($detailItem)) {
                echo "Không tìm thấy chi tiết đơn hàng cho ID: " . htmlspecialchars($order_id);
                return;
            }

            // Giả sử trạng thái đơn hàng nằm ở item đầu tiên
            $order = [
                'trang_thai_don_hang' => $detailItem[0]['trang_thai_don_hang']
            ];

            // Gửi dữ liệu sang view
            require_once('views/donhang/detailDonHang.php');
        } else {
            echo "Order ID không hợp lệ.";
        }
    }


    public function editTrangThai()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $don_hang_id = $_POST['don_hang_id'] ?? null;
            $trang_thai_moi = $_POST['trang_thai'] ?? null;

            if ($don_hang_id && $trang_thai_moi) {
                // Lấy trạng thái hiện tại từ DB
                $donHang = $this->modelDonHang->getAllDonHang($don_hang_id);
                $trang_thai_hien_tai = $donHang['trang_thai_don_hang'] ?? null;

                // Nếu trạng thái hiện tại là shipped hoặc delivered thì không cho phép hủy đơn
                if (
                    in_array($trang_thai_hien_tai, ['shipped', 'delivered']) &&
                    $trang_thai_moi === 'canceled'
                ) {
                    echo "Không thể hủy đơn hàng đã giao hoặc đã hoàn tất.";
                    return;
                }

                // Đảm bảo người dùng chỉ có thể chuyển sang trạng thái tiếp theo, không quay ngược
                $thuTu = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
                $viTriHienTai = array_search($trang_thai_hien_tai, $thuTu);
                $viTriMoi = array_search($trang_thai_moi, $thuTu);

                if ($viTriMoi < $viTriHienTai && $trang_thai_moi !== 'cancelled') {
                    echo "Không thể quay về trạng thái trước đó!";
                    return;
                }

                $capNhat = $this->modelDonHang->updateTrangThai($trang_thai_moi, $don_hang_id);

                if ($capNhat) {
                    header('Location: ' . BASE_URL_ADMIN . '?act=listDonHang');
                    exit();
                } else {
                    echo "Lỗi khi cập nhật đơn hàng.";
                }
            } else {
                echo "Thiếu dữ liệu cần thiết!";
            }
        } else {
            echo "Phương thức không hợp lệ!";
        }
    }
}
