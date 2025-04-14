<?php

class AdminBinhLuan
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function hideBinhLuan($bl_id) 
    {
        try {
            $sql = 'UPDATE binh_luan SET an_hien = 0 WHERE id = :bl_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':bl_id' => $bl_id]);
            return true;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function showBinhLuan($bl_id) 
    {
        try {
            $sql = 'UPDATE binh_luan SET an_hien = 1 WHERE id = :bl_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':bl_id' => $bl_id]);
            return true;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function getAllComment()
    {
        try {
            // Truy vấn lấy bình luận kèm tên sản phẩm
            $sql = 'SELECT binh_luan.*,san_pham.ten_san_pham, tai_khoan.ho_ten 
                    FROM binh_luan 
                    JOIN san_pham ON binh_luan.san_pham_id = san_pham.id 
                    JOIN tai_khoan ON binh_luan.tai_khoan_id = tai_khoan.id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về mảng kết hợp
        } catch (Exception $e) {
            echo 'Lỗi getAllComments(): ' . $e->getMessage();
        }
    }
}