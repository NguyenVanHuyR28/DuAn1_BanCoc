<?php
class AdminDanhMuc
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllDanhMuc()
    {
        try {
            $sql = "SELECT * from danh_muc";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
    public function insertDanhMuc($ten_danh_muc, $mo_ta)
    {
        try {
            $sql = "INSERT INTO danh_muc (ten_danh_muc, mo_ta) VALUES (:ten_danh_muc, :mo_ta)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ten_danh_muc' => $ten_danh_muc,
                ':mo_ta' => $mo_ta

            ]);

            return true;
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
    public function getDetailDanhMuc($id)
    {
        try {
            $sql = 'SELECT * FROM danh_muc WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
    public function editDanhMuc($id, $ten_danh_muc, $mo_ta)
    {
        try {
            $sql = "UPDATE danh_muc SET ten_danh_muc=:ten_danh_muc, mo_ta = :mo_ta WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
                ':ten_danh_muc' => $ten_danh_muc,
                ':mo_ta' => $mo_ta

            ]);
            return true;
        } catch (Exception $e) {
            echo 'Lỗi updateCategory() ' . $e->getMessage();
        }
    }

    public function deleteDanhMuc($id)
    {
        try {
            $sql = "DELETE FROM danh_muc WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            return true;
        } catch (Exception $e) {
            echo 'Lỗi deleteCategory() ' . $e->getMessage();
        }
    }
}
