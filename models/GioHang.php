<?php

class GioHang
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllCart()
    {
        try {
            $sql =
                'SELECT gio_hang.*, san_pham.ten_san_pham, san_pham.hinh_anh, san_pham.gia
                FROM gio_hang
                INNER JOIN san_pham ON san_pham.id = gio_hang.san_pham_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }


    public function addCart($tai_khoan_id, $san_pham_id, $so_luong)
    {
        try {
            $sql = 'INSERT INTO gio_hang( tai_khoan_id, san_pham_id, so_luong) VALUES (:tai_khoan_id, :san_pham_id, :so_luong)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':tai_khoan_id' => $tai_khoan_id,
                ':san_pham_id' => $san_pham_id,
                ':so_luong' => $so_luong,
            ]);
            return true;
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }

    public function detailCart($id)
    {
        try {
            $sql = "SELECT * FROM gio_hang WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }

    public function deleteCart($id)
    {
        try {
            try {
                $sql = "DELETE FROM gio_hang WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([':id' => $id]);

                return true; // Xóa thành công
            } catch (Exception $e) {
                echo 'Error ' . $e->getMessage();
            }
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
}
