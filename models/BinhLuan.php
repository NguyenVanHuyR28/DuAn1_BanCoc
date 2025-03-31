<?php 

class BinhLuan{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function inserBinhLuan($san_pham_id, $tai_khoan_id, $noi_dung, $ngay_dang, $trang_thai) {
        try {
            // Truy vấn SQL để thêm bình luận
            $sql = 'INSERT INTO binh_luans (san_pham_id, tai_khoan_id, noi_dung, ngay_dang, trang_thai)
                    VALUES (:san_pham_id, :tai_khoan_id, :noi_dung, :ngay_dang, :trang_thai)';
    
            // Chuẩn bị truy vấn
            $stmt = $this->conn->prepare($sql);
    
            // Thực thi truy vấn với các giá trị truyền vào
            $stmt->execute([
                ':san_pham_id' => $san_pham_id,
                ':tai_khoan_id' => $tai_khoan_id,
                ':noi_dung' => $noi_dung,
                ':ngay_dang' => $ngay_dang,
                ':trang_thai' => $trang_thai
            ]);
            
            return true; // Trả về true nếu thành công
        } catch (Exception $e) {
            // Bắt lỗi và hiển thị thông báo lỗi
            echo "Error: " . $e->getMessage();
            return false; // Trả về false nếu có lỗi
        }
    }
    

}