
<?php

class GioHang
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllCart($tai_khoan_id)
    {
        try {
            $sql = 'SELECT gio_hang.*, san_pham.ten_san_pham, san_pham.hinh_anh, san_pham.gia, san_pham.gia_khuyen_mai
                FROM gio_hang
                INNER JOIN san_pham ON san_pham.id = gio_hang.san_pham_id 
                WHERE gio_hang.tai_khoan_id = :tai_khoan_id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':tai_khoan_id' => $tai_khoan_id
            ]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi khi lấy giỏ hàng: " . $e->getMessage();
            return [];
        }
    }



    public function addCart($tai_khoan_id, $san_pham_id, $so_luong)
    {
        try {
            // 1. Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
            $checkSql = 'SELECT so_luong FROM gio_hang WHERE tai_khoan_id = :tai_khoan_id AND san_pham_id = :san_pham_id';
            $stmt = $this->conn->prepare($checkSql);
            $stmt->execute([
                ':tai_khoan_id' => $tai_khoan_id,
                ':san_pham_id' => $san_pham_id,
            ]);

            if ($stmt->rowCount() > 0) {
                // 2. Nếu tồn tại, cập nhật số lượng
                $row = $stmt->fetch();
                $new_quantity = $row['so_luong'] + $so_luong;

                $updateSql = 'UPDATE gio_hang SET so_luong = :so_luong WHERE tai_khoan_id = :tai_khoan_id AND san_pham_id = :san_pham_id';
                $updateStmt = $this->conn->prepare($updateSql);
                $updateStmt->execute([
                    ':so_luong' => $new_quantity,
                    ':tai_khoan_id' => $tai_khoan_id,
                    ':san_pham_id' => $san_pham_id,
                ]);
            } else {
                // 3. Nếu chưa có, thêm mới
                $sql = 'INSERT INTO gio_hang (tai_khoan_id, san_pham_id, so_luong) VALUES (:tai_khoan_id, :san_pham_id, :so_luong)';
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    ':tai_khoan_id' => $tai_khoan_id,
                    ':san_pham_id' => $san_pham_id,
                    ':so_luong' => $so_luong,
                ]);
            }

            return true;
        } catch (Exception $e) {
            error_log("Error in addCart: " . $e->getMessage());
            return false;
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

    public function deleteAllCart($id)
    {
        try {
            $sql = "DELETE FROM gio_hang WHERE tai_khoan_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            return true; // Xóa thành công
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
}
