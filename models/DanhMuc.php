<?php
class DanhMuc {
    public $conn;
    public function __construct() {
        $this->conn = connectDB();
    }
    public function getAllDanhMuc() {
    try{
        $sql = "SELECT * FROM danh_muc";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result ? $result : [];
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
}
