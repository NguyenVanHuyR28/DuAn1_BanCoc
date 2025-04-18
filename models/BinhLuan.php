<?php

class BinhLuan{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function insertBinhLuan($san_pham_id, $tai_khoan_id, $noi_dung, $ngay_tao, $an_hien) {
        try {
            $sql = 'INSERT INTO binh_luan (san_pham_id, tai_khoan_id, noi_dung, ngay_tao, an_hien)
                    VALUES (:san_pham_id, :tai_khoan_id, :noi_dung, :ngay_tao, :an_hien)';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':san_pham_id' => $san_pham_id,
                ':tai_khoan_id' => $tai_khoan_id,
                ':noi_dung' => $noi_dung,
                ':ngay_tao' => $ngay_tao,
                ':an_hien' => $an_hien
            ]);
            return true;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function getBinhLuanBySanPhamId($san_pham_id) {
        $sql = "SELECT binh_luan.*, tai_khoan.ho_ten
                FROM binh_luan 
                JOIN tai_khoan ON binh_luan.tai_khoan_id = tai_khoan.id 
                WHERE binh_luan.san_pham_id = :san_pham_id
                  AND binh_luan.an_hien = 1
                ORDER BY binh_luan.ngay_tao DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':san_pham_id' => $san_pham_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}