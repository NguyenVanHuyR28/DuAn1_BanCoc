<?php
class AdminTaiKhoan {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getAllTaiKhoan() {
        try {
            $sql = 'SELECT * FROM tai_khoan';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll() ?: [];
        } catch (Exception $e) {
            $this->handleError($e);
            return [];
        }
    }
    
    public function getDetailTaiKhoan($id)
    {
        try {
            $sql = 'SELECT * FROM tai_khoan WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id

            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
    
    // Thêm tài khoản mới
    public function insertTaiKhoan($ho_ten, $email, $mat_khau, $so_dien_thoai, $dia_chi, $role) {
        try {
            $sql = "INSERT INTO tai_khoan 
                    (ho_ten, email, mat_khau, so_dien_thoai, dia_chi, role) 
                    VALUES 
                    (:ho_ten, :email, :mat_khau, :so_dien_thoai, :dia_chi, :role)";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':email' => $email,
                ':mat_khau' => $mat_khau,
                ':so_dien_thoai' => $so_dien_thoai,
                ':dia_chi' => $dia_chi,
                ':role' => (int)$role
            ]);
        } catch (PDOException $e) {
            echo "Lỗi thêm tài khoản: " . $e->getMessage();
            exit;
        }
    }
    
    

    // Lấy chi tiết tài khoản theo ID
    public function detailTaiKhoan($id) {
        try {
            $sql = 'SELECT * FROM tai_khoan WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([ ':id' => $id ]);
            $result = $stmt->fetch();
            return $result ?: null;
        } catch (Exception $e) {
            $this->handleError($e);
            return null;
        }
    }

    // Cập nhật thông tin tài khoản
    public function updateTaiKhoan($id, $ho_ten, $email, $so_dien_thoai, $dia_chi,$role) {
        try {
            $sql = 'UPDATE tai_khoan 
                    SET ho_ten = :ho_ten, 
                        email = :email,
                        so_dien_thoai = :so_dien_thoai,
                        dia_chi = :dia_chi,
                        role = :role
                        
                    WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':email' => $email,
                ':so_dien_thoai' => $so_dien_thoai,
                ':dia_chi' => $dia_chi,
                ':role' => (int)$role,
                ':id' => $id
            ]);
            return true;
        } catch (Exception $e) {
            $this->handleError($e);
            return false;
        }
    }

    // Xóa tài khoản
    public function deleteTaiKhoan($id) {
        try {
            $sql = 'DELETE FROM tai_khoan WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([ ':id' => $id ]);
            return true;
        } catch (Exception $e) {
            $this->handleError($e);
            return false;
        }
    }


    // Hàm xử lý lỗi
    private function handleError($e) {
        error_log("Database error: " . $e->getMessage());
    }
}
?>