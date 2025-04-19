<?php

class SanPham
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllSanPham($keyword = '')
    {
        try {
            $sql = 'SELECT san_pham.*, danh_muc.ten_danh_muc
                    FROM san_pham
                    INNER JOIN danh_muc ON san_pham.danh_muc_id = danh_muc.id
                    WHERE san_pham.trang_thai = 1 AND san_pham.so_luong > 0 ';

            if (!empty($keyword)) {
                $sql .= ' AND san_pham.ten_san_pham LIKE :keyword';
            }
            $stmt = $this->conn->prepare($sql);
            if (!empty($keyword)) {
                $stmt->bindValue(':keyword', '%' . $keyword . '%');
            }
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
    public function getAllSanPhamNoiBat()
    {
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
    public function getDetailSanPham($id)
    {
        try {
            $sql = 'SELECT san_pham.*, danh_muc.ten_danh_muc
                    FROM san_pham
                    INNER JOIN danh_muc ON danh_muc_id = danh_muc.id
                    WHERE san_pham.id = :id AND san_pham.trang_thai = 1';
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
    public function getBinhLuanFromSanPham($id)
    {
        try {
            $sql = 'SELECT binh_luan.*, tai_khoan.ho_ten
                    FROM binh_luan
                    INNER JOIN tai_khoan ON binh_luan.tai_khoan_id = tai_khoan.id
                    WHERE binh_luan.san_pham_id = :id ';
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
    public function getListSanPhamDanhMuc($danh_muc_id)
    {
        try {
            $sql = 'SELECT san_pham.*, danh_muc.ten_danh_muc
                    FROM san_pham
                    INNER JOIN danh_muc ON danh_muc_id = danh_muc.id
                    WHERE danh_muc_id = ' . $danh_muc_id;
            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
    public function getSanPhamByCategory($danh_muc_id)
    {
        try {
            $sql = 'SELECT san_pham.*, danh_muc.ten_danh_muc
                    FROM san_pham
                    INNER JOIN danh_muc ON danh_muc_id = danh_muc.id
                    WHERE danh_muc_id    = :danh_muc_id
                    AND san_pham.trang_thai = 1';
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':danh_muc_id' => $danh_muc_id
            ]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
    public function updateSoLuongSanPham($san_pham_id, $so_luong_da_ban)
    {
        try {
            $sql = "UPDATE san_pham SET so_luong = so_luong - :so_luong_da_ban WHERE id = :san_pham_id AND so_luong >= :so_luong_da_ban";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':so_luong_da_ban' => $so_luong_da_ban,
                ':san_pham_id' => $san_pham_id
            ]);
            return $stmt->rowCount() > 0; // Trả về true nếu cập nhật thành công
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
