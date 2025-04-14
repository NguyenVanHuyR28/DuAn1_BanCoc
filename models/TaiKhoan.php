<?php
class TaiKhoan
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function checkLogin($email, $mat_khau)
    {
        try {
            $sql = "SELECT * FROM tai_khoan WHERE email= :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            $tai_khoan = $stmt->fetch();
            // var_dump($taikhoan);
            if ($email == "" || $mat_khau == "") {
                return "Vui lòng nhập đầy đủ email và mật khẩu!";
            } elseif (($email === $tai_khoan['email']) && ($mat_khau === $tai_khoan['mat_khau'])) {
                if ($tai_khoan['role'] ==  1) {
                    return $tai_khoan['email']; // đăng nhập vào trang admin

                } else {
                    return 'Trang client'; // đăng nhập vào trang client
                }
            } else {
                return "Sai tài khoản hoặc mật khẩu!";
            }
        } catch (Exception $e) {
            echo 'Lỗi checkLogin() ' . $e->getMessage();
            return false;
        }
    }
    public function insertTaiKhoan($ho_ten, $email, $mat_khau, $so_dien_thoai, $dia_chi, $role)
    {
        try {
            $sql = 'INSERT INTO tai_khoan (ho_ten, email, mat_khau, so_dien_thoai, dia_chi) VALUES (:ho_ten, :email, :mat_khau, :so_dien_thoai, :dia_chi, : role)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':email' => $email,
                ':mat_khau' => $mat_khau,
                ':so_dien_thoai' => $so_dien_thoai,
                ':dia_chi' => $dia_chi,
                ':role' => $role
            ]);
            if ($stmt->rowCount() > 0) {
                return true;  // Thành công
            } else {
                // Nếu không có dòng nào được chèn, có thể có vấn đề với câu lệnh SQL
                throw new Exception("Không thể chèn tài khoản vào cơ sở dữ liệu.");
            }
        } catch (Exception $e) {
            // Hiển thị lỗi chi tiết
            echo "Error: " . $e->getMessage();
            return false;  // Trả về false nếu có lỗi
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
    public function getAllTaiKhoan()
    {
        try {
            $sql = "SELECT * FROM tai_khoan";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi getAllTaiKhoan() ' . $e->getMessage();
            return [];
        }
    }
    public function getTKById($id)
    {
        try {
            $sql = "SELECT * FROM tai_khoan WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo 'Lỗi getTKById() ' . $e->getMessage();
        }
    }
    public function getTaiKhoanFromEmail($email)
    {
        try {
            $sql = 'SELECT * FROM tai_khoan WHERE email = :email';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':email' => $email

            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
    public function editInfo($id, $ho_ten, $email, $mat_khau, $so_dien_thoai, $dia_chi)
    {
        try {
            $sql = "UPDATE tai_khoan SET ho_ten=:ho_ten, email=:email, mat_khau=:mat_khau, so_dien_thoai=:so_dien_thoai, dia_chi=:dia_chi
                    WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':email' => $email,
                ':mat_khau' => $mat_khau,
                ':so_dien_thoai' => $so_dien_thoai,
                ':dia_chi' => $dia_chi,

                ':id' => $id,

            ]);

            return true;
        } catch (Exception $e) {
            echo 'Lỗi editInfo() ' . $e->getMessage();
        }
    }
}
