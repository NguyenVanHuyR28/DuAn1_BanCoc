<?php

class ThongKe
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function loadAll_thongke()
    {
        try {
            // Câu lệnh SQL đã được chỉnh sửa
            $sql = 'SELECT 
                        danh_muc.id AS madm, 
                        danh_muc.ten_danh_muc AS tendm, 
                        COUNT(san_pham.id) AS countsp, 
                        MIN(san_pham.gia) AS minprice, 
                        MAX(san_pham.gia) AS maxprice, 
                        AVG(san_pham.gia) AS avgprice
                    FROM san_pham 
                    LEFT JOIN danh_muc ON danh_muc.id = san_pham.danh_muc_id
                    GROUP BY danh_muc.id 
                    ORDER BY danh_muc.id DESC';

            // Chuẩn bị câu lệnh
            $stmt = $this->conn->prepare($sql);

            // Thực thi câu lệnh đã chuẩn bị
            $stmt->execute();

            // Trả về kết quả
            return $stmt->fetchAll();
        } catch (Exception $e) {
            // Hiển thị lỗi cụ thể nếu có
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function getAllDonHang30days()
{
    try {
        $sql = "SELECT don_hang.*, 
                       CASE 
                           WHEN don_hang.trang_thai_don_hang = 'pending' THEN 'Chờ xác nhận'
                           WHEN don_hang.trang_thai_don_hang = 'processing' THEN 'Đang xử lý'
                           WHEN don_hang.trang_thai_don_hang = 'shipped' THEN 'Đang giao'
                           WHEN don_hang.trang_thai_don_hang = 'delivered' THEN 'Hoàn thành'
                           WHEN don_hang.trang_thai_don_hang = 'canceled' THEN 'Đã huỷ'
                           ELSE 'Không xác định'
                       END AS ten_trang_thai
                FROM don_hang
                WHERE ngay_tao >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                ORDER BY ngay_tao DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về mảng kết hợp
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}
    public function getTop10SanPham()
    {
        try {
            $sql = 'SELECT san_pham.*, danh_muc.ten_danh_muc
                FROM san_pham 
                INNER JOIN danh_muc ON san_pham.danh_muc_id = danh_muc.id
                ORDER BY san_pham.luot_xem DESC
                LIMIT 10';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về mảng
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return []; // Trả về mảng rỗng nếu có lỗi
        }
    }
    public function getAllDonHangBom()
    {
        try {
            $sql = 'SELECT don_hang.*, trang_thai_don_hang.ten_trang_thai
                FROM don_hang
                INNER JOIN trang_thai_don_hang ON don_hang.trang_thai_id = trang_thai_don_hang.id
                WHERE don_hang.trang_thai_id = :trang_thai_id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':trang_thai_id' => 4
            ]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function getAllDonHangHoan()
    {
        try {
            $sql = 'SELECT don_hang.*, trang_thai_don_hang.ten_trang_thai
                FROM don_hang 
                INNER JOIN trang_thai_don_hang ON don_hang.trang_thai_id = trang_thai_don_hang.id
                WHERE don_hang.trang_thai_id = :trang_thai_id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':trang_thai_id' => 10  // Lọc theo id_trang_thai
            ]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
