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
            $sql = '';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Error' . $e->getMessage();
        }
    }
}
