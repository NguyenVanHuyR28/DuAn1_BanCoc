<?php
class DonHang
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function createDonHang($ma_don_hang, $tai_khoan_id, $tong_tien, $ngay_tao, $ten_nguoi_nhan, $email_nguoi_nhan, $sdt_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $phuong_thuc_thanh_toan_id, $items = [])
    {
        try {
            // Bắt đầu transaction để đảm bảo toàn vẹn dữ liệu
            $this->conn->beginTransaction();

            // Insert đơn hàng
            $sql = "INSERT INTO don_hang (ma_don_hang, tai_khoan_id, tong_tien, ngay_tao, ten_nguoi_nhan, email_nguoi_nhan, sdt_nguoi_nhan, dia_chi_nguoi_nhan, ghi_chu, phuong_thuc_thanh_toan_id)
                VALUES (:ma_don_hang, :tai_khoan_id, :tong_tien, :ngay_tao, :ten_nguoi_nhan, :email_nguoi_nhan, :sdt_nguoi_nhan, :dia_chi_nguoi_nhan, :ghi_chu, :phuong_thuc_thanh_toan_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ma_don_hang'               => $ma_don_hang,
                ':tai_khoan_id'              => $tai_khoan_id,
                ':tong_tien'                 => $tong_tien,
                ':ngay_tao'                  => $ngay_tao,
                ':ten_nguoi_nhan'           => $ten_nguoi_nhan,
                ':email_nguoi_nhan'         => $email_nguoi_nhan,
                ':sdt_nguoi_nhan'           => $sdt_nguoi_nhan,
                ':dia_chi_nguoi_nhan'       => $dia_chi_nguoi_nhan,
                ':ghi_chu'                  => $ghi_chu,
                ':phuong_thuc_thanh_toan_id' => $phuong_thuc_thanh_toan_id,
            ]);
            $order_id = $this->conn->lastInsertId();
            // Thêm chi tiết đơn hàng
            if (!empty($items)) {
                foreach ($items as $item) {
                    $sanPhamId = $item['san_pham_id'];
                    $soLuong = $item['so_luong'];
                    $gia = (isset($item['gia_khuyen_mai']) && $item['gia_khuyen_mai'] > 0) ? $item['gia_khuyen_mai'] : $item['gia'];
                    $thanhTien = $gia * $soLuong;

                    $sqlDetail = "INSERT INTO chi_tiet_don_hang (
                                don_hang_id, san_pham_id, so_luong, gia, thanh_tien
                              ) VALUES (
                                :don_hang_id, :san_pham_id, :so_luong, :gia, :thanh_tien
                              )";
                    $stmtDetail = $this->conn->prepare($sqlDetail);
                    $stmtDetail->execute([
                        ':don_hang_id'  => $order_id,
                        ':san_pham_id'  => $sanPhamId,
                        ':so_luong'     => $soLuong,
                        ':gia'          => $gia,
                        ':thanh_tien'   => $thanhTien
                    ]);


                    // GỢI Ý THÊM: Nếu bạn muốn trừ hàng tồn kho
                    // $this->updateSoLuongSanPham($sanPhamId, $soLuong);
                    $sql = "UPDATE san_pham SET so_luong = so_luong - :so_luong WHERE id = :id";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute([
                        ':so_luong' => $soLuong,
                        ':id'       => $sanPhamId
                    ]);
                }
            }

            // Commit sau khi xong hết
            $this->conn->commit();
            return $order_id;
        } catch (Exception $e) {
            // Nếu lỗi thì rollback
            $this->conn->rollBack();
            echo "Lỗi tạo đơn hàng: " . $e->getMessage();
            return false;
        }
    }




    public function historyDonHang($id)
    {
        try {
            $sql = 'SELECT don_hang.*, tai_khoan.id AS tai_khoan_id
            FROM don_hang
            INNER JOIN tai_khoan ON don_hang.tai_khoan_id = tai_khoan.id
            WHERE don_hang.tai_khoan_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function detailOrder($order_id)
    {
        try {
            $sql = 'SELECT chi_tiet_don_hang.*, san_pham.*,chi_tiet_don_hang.so_luong, don_hang.*,danh_muc.ten_danh_muc
            FROM chi_tiet_don_hang
            INNER JOIN san_pham ON san_pham.id = chi_tiet_don_hang.san_pham_id
            INNER JOIN danh_muc ON san_pham.danh_muc_id = danh_muc.id
            INNER JOIN don_hang ON don_hang.id = chi_tiet_don_hang.don_hang_id 
            WHERE chi_tiet_don_hang.don_hang_id = :order_id
            ';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':order_id' => $order_id
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
