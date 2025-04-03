<?php

class SanPham
{
    public $conn;
    public function __construct() {
        $this->conn = connectDB();
    }

    public function getAllSanPham() {
        try {
            $sql = 'SELECT san_pham.*, danh_muc.ten_danh_muc
                    FROM san_pham
                    INNER JOIN danh_muc ON san_pham.danh_muc_id = danh_muc.id
                    WHERE san_pham.trang_thai = 1';  
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
    public function getAllSanPhamNoiBat(){
        try {
            $sql = 'SELECT san_pham.*, danh_muc.ten_danh_muc
                    FROM san_pham
                    INNER JOIN danh_muc ON san_pham.danh_muc_id = danh_muc.id
                    WHERE san_pham.trang_thai = 1 AND san_pham.noi_bat = 1';  
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getDetailSanPham($id) {
        try {
            $sql = 'SELECT san_pham.*, danh_muc.ten_danh_muc
                    FROM san_pham
                    INNER JOIN danh_muc ON danh_muc_id = danh_muc.id
                    WHERE san_pham.id = :id AND san_pham.trang_thai = 1';
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id'=>$id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
    public function getBinhLuanFromSanPham($id) {
        try {
            $sql = 'SELECT binh_luan.*, tai_khoan.ho_ten
                    FROM binh_luan
                    INNER JOIN tai_khoan ON binh_luan.id_tai_khoan = tai_khoan.id
                    WHERE binh_luan.san_pham_id = :id AND binh_luan.trang_thai = 1';
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
    public function getListSanPhamDanhMuc($id_dm) {
        try {
            $sql = 'SELECT san_pham.*, danh_muc.ten_danh_muc
                    FROM san_pham
                    INNER JOIN danh_muc ON danh_muc_id = danh_muc.id
                    WHERE danh_muc_id = '. $id_dm;
            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
    public function getSanPhamByCategory($id_dm) {
        try {
            $sql = 'SELECT san_pham.*, danh_muc.ten_danh_muc
                    FROM san_pham
                    INNER JOIN danh_muc ON danh_muc_id = danh_muc.id
                    WHERE danh_muc_id = :id_dm
                    AND san_pham.trang_thai = 1';
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id_dm' => $id_dm
            ]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
}
