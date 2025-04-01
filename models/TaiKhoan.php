<?php 

class TaiKhoan{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function checkLogin($email, $mat_khau){
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email]);
            $user = $stmt->fetch();
            if ($user && password_verify($mat_khau, $user['mat_khau'])) {
                    return $user['email'];
            } else {
                return "Bạn nhập sai thông tin";
            }
        } catch (\Exception $e) {
            echo "Lỗi" . $e-> getMessage();
            return false;
        }
   }

   public function insertTaiKhoan($ho_ten, $email, $password, $so_dien_thoai, $dia_chi, $chuc_vu_id)
{
    try {
        $sql = 'INSERT INTO tai_khoans (ho_ten, email, mat_khau, so_dien_thoai, dia_chi, chuc_vu_id)
                VALUES (:ho_ten, :email, :password, :so_dien_thoai, :dia_chi, :chuc_vu_id)';
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':ho_ten' => $ho_ten,
            ':email' => $email,
            ':password' => $password,
            ':so_dien_thoai' => $so_dien_thoai,
            ':dia_chi' => $dia_chi,
            ':chuc_vu_id' => $chuc_vu_id
        ]);

        // Kiểm tra xem có dòng nào được chèn không
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
            $sql = 'SELECT * FROM tai_khoans WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id

            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }

    public function getTaiKhoanFromEmail($email)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':email' => $email

            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }

    public function updateTaiKhoan($id, $ho_ten,$anh_dai_dien, $email, $so_dien_thoai,$dia_chi ,$ngay_sinh,$gioi_tinh,$chuc_vu_id)
    {
        try {

            $sql = 'UPDATE tai_khoans 
                    SET
                    ho_ten = :ho_ten,
                    anh_dai_dien = :anh_dai_dien,
                    email = :email,
                    so_dien_thoai = :so_dien_thoai,
                    dia_chi = :dia_chi,
                    ngay_sinh = :ngay_sinh,
                    gioi_tinh = :gioi_tinh,

                    
                    chuc_vu_id=:chuc_vu_id


                    
                    
                WHERE id = :id ';

            $stmt = $this->conn->prepare($sql);

            // var_dump($stmt);die;
            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':anh_dai_dien' => $anh_dai_dien,
                ':email' => $email,

                ':so_dien_thoai' => $so_dien_thoai,

                ':dia_chi' => $dia_chi,
                ':ngay_sinh' => $ngay_sinh,
                ':gioi_tinh' => $gioi_tinh,
                

                ':chuc_vu_id' => $chuc_vu_id,




                ':id' => $id

            ]);


            return true;
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }

    public function resetPassword($id, $mat_khau)
    {
        try {

            $sql = 'UPDATE tai_khoans 
                    SET
                    mat_khau = :mat_khau
                    
                    
                   
                WHERE id = :id ';

            $stmt = $this->conn->prepare($sql);

            // var_dump($stmt);die;
            $stmt->execute([
                ':mat_khau' => $mat_khau,

                ':id' => $id

            ]);


            return true;
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }

}