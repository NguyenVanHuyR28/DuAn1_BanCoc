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
}
