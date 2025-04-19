<?php
class AdminSanPham
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getALLSanPham()
    {
        try {
            $sql = "SELECT san_pham.*, danh_muc.ten_danh_muc 
                    FROM san_pham
                    INNER JOIN danh_muc ON san_pham.danh_muc_id = danh_muc.id
                    ORDER BY san_pham.ngay_tao DESC;
                    ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }

    public function insertSanPham($danh_muc_id, $ten_san_pham, $gia, $gia_khuyen_mai, $so_luong, $file_thumb, $mo_ta)
    {
        try {
            $sql = "INSERT INTO san_pham ( danh_muc_id, ten_san_pham, gia,gia_khuyen_mai, so_luong ,hinh_anh, mo_ta) 
            VALUES(:danh_muc_id, :ten_san_pham, :gia, :gia_khuyen_mai, :so_luong, :hinh_anh, :mo_ta)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':danh_muc_id' => $danh_muc_id,
                ':ten_san_pham' => $ten_san_pham,
                ':gia' => $gia,
                ':gia_khuyen_mai' => $gia_khuyen_mai,
                ':so_luong' => $so_luong,
                ':hinh_anh' => $file_thumb,
                ':mo_ta' => $mo_ta
            ]);
            return true;
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
    public function getDetailSanPham($id)
    {
        try {
            $sql = "SELECT * FROM san_pham WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }

    public function editSanPham($id, $danh_muc_id, $ten_san_pham, $gia, $gia_khuyen_mai, $so_luong,$trang_thai, $file_thumb, $mo_ta)
    {
        try {
            $sql = "UPDATE san_pham SET danh_muc_id = :danh_muc_id, ten_san_pham = :ten_san_pham, 
            gia = :gia, gia_khuyen_mai = :gia_khuyen_mai, so_luong = :so_luong,trang_thai = :trang_thai , hinh_anh = :hinh_anh, mo_ta = :mo_ta WHERE id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
                ':danh_muc_id' => $danh_muc_id,
                ':ten_san_pham' => $ten_san_pham,
                ':gia' => $gia,
                ':gia_khuyen_mai' => $gia_khuyen_mai,
                ':so_luong' => $so_luong,
                'trang_thai' => $trang_thai,
                ':hinh_anh' => $file_thumb,
                ':mo_ta' => $mo_ta
            ]);
            return true;
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }

    public function deleteSanPham($id)
    {
        try {
            $sql = "DELETE FROM san_pham WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            return true; // Xóa thành công
        } catch (Exception $e) {
            echo 'Error ' . $e->getMessage();
        }
    }
}
