<?php
class DonHang
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function addDonHang($tai_khoan_id, $ten_nguoi_nhan, $email_nguoi_nhan, $sdt_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $tong_tien, $phuong_thuc_thanh_toan_id, $ngay_dat, $ma_don_hang, $trang_thai_id)
    {
        try {
            $sql = 'INSERT INTO don_hangs (tai_khoan_id,ten_nguoi_nhan,email_nguoi_nhan,sdt_nguoi_nhan,dia_chi_nguoi_nhan,ghi_chu,tong_tien,phuong_thuc_thanh_toan_id,ngay_dat,ma_don_hang,trang_thai_id) 
            VALUE (:tai_khoan_id,:ten_nguoi_nhan,:email_nguoi_nhan,:sdt_nguoi_nhan,:dia_chi_nguoi_nhan,:ghi_chu,:tong_tien,:phuong_thuc_thanh_toan_id,:ngay_dat,:ma_don_hang,:trang_thai_id)';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':tai_khoan_id' => $tai_khoan_id,
                ':ten_nguoi_nhan' => $ten_nguoi_nhan,

                ':email_nguoi_nhan' => $email_nguoi_nhan,
                ':sdt_nguoi_nhan' => $sdt_nguoi_nhan,
                ':dia_chi_nguoi_nhan' => $dia_chi_nguoi_nhan,
                ':ghi_chu' => $ghi_chu,
                ':tong_tien' => $tong_tien,
                ':phuong_thuc_thanh_toan_id' => $phuong_thuc_thanh_toan_id,
                ':ngay_dat' => $ngay_dat,
                ':ma_don_hang' => $ma_don_hang,
                ':trang_thai_id' => $trang_thai_id,
            ]);

            $don_hang_id = $this->conn->lastInsertId();
            return $don_hang_id;
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }

    public function addChiTietDonHang($don_hang_id, $san_pham_id, $don_gia, $so_luong, $thanh_tien)
    {
        try {

            $sql = 'INSERT INTO chi_tiet_don_hangs (don_hang_id, san_pham_id, don_gia, so_luong, thanh_tien)
                VALUES (:don_hang_id, :san_pham_id, :don_gia, :so_luong, :thanh_tien)';

            $stmt = $this->conn->prepare($sql);


            $stmt->execute([
                ':don_hang_id' => $don_hang_id,
                ':san_pham_id' => $san_pham_id,
                ':don_gia' => $don_gia,
                ':so_luong' => $so_luong,
                ':thanh_tien' => $thanh_tien
            ]);


            if ($stmt->rowCount()) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getDonHangByTaiKhoanId($tai_khoan_id)
    {
        try {

            $sql = 'SELECT don_hang.*, trang_thai_don_hang.ten_trang_thai
            FROM don_hangs
            INNER JOIN trang_thai_don_hang ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
                INNER JOIN tai_khoans ON don_hangs.tai_khoan_id = tai_khoans.id 
                WHERE don_hangs.tai_khoan_id = :tai_khoan_id 
                ORDER BY don_hangs.ngay_dat DESC';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':tai_khoan_id' => $tai_khoan_id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function getChiTietDonHangByDonHangId($don_hang_id)
    {
        try {
            $sql = 'SELECT chi_tiet_don_hang.*, san_pham.ten_san_pham  , san_pham.hinh_anh
                FROM chi_tiet_don_hang 
                INNER JOIN san_pham ON chi_tiet_don_hang.san_pham_id = san_pham.id 
                WHERE chi_tiet_don_hang.don_hang_id = :id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $don_hang_id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function huyDonHang($don_hang_id)
    {
        
        $sql = "UPDATE don_hangs SET trang_thai_id = 11 WHERE id = ?";

       
        $stmt = $this->conn->prepare($sql);

        
        if ($stmt->execute([$don_hang_id])) {
            
            return true;
        } else {
            
            return false;
        }
    }

    public function hoanDonHang($don_hang_id)
    {
        
        $sql = "UPDATE don_hangs SET trang_thai_id = 10 WHERE id = ?";

       
        $stmt = $this->conn->prepare($sql);

        
        if ($stmt->execute([$don_hang_id])) {
            
            return true;
        } else {
            
            return false;
        }
    }

    public function getTrangThaiDonHang($don_hang_id)
{
    // Câu truy vấn lấy trạng thái của đơn hàng
    $sql = "SELECT trang_thai_id FROM don_hangs WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$don_hang_id]);

    // Lấy kết quả trả về
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Trả về trạng thái của đơn hàng, nếu không tồn tại thì trả về null
    return $result['trang_thai_id'] ?? null;
}



}
