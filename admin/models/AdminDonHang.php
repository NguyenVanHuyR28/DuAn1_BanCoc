<?php

class AdminDonHang
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllDonHang()
    {
        try {
            $sql = 'SELECT don_hang.*, tai_khoan.ho_ten, tai_khoan.so_dien_thoai, tai_khoan.dia_chi
            FROM don_hang
            INNER JOIN tai_khoan ON  tai_khoan.id = don_hang.tai_khoan_id
            ORDER BY don_hang.ngay_tao DESC;
            ';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Error' . $e->getMessage();
        }
    }

    public function detailDonHang($order_id)
    {
        try {
            $sql = 'SELECT chi_tiet_don_hang.*, san_pham.*,chi_tiet_don_hang.so_luong, don_hang.*,  danh_muc.ten_danh_muc
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
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function updateTrangThai($trang_thai, $don_hang_id)
    {
        try {
            $sql = "UPDATE don_hang SET trang_thai_don_hang = :trang_thai WHERE id = :don_hang_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':trang_thai'    => $trang_thai,
                ':don_hang_id'   => $don_hang_id,
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi cập nhật trạng thái: " . $e->getMessage();
            return false;
        }
    }
}
