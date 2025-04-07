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
        $sql = 'SELECT * FROM gio_hang ';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            // ':tai_khoan_id' => $tai_khoan_id
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addGioHang($tai_khoan_id, $san_pham_id, $so_luong)
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
}
