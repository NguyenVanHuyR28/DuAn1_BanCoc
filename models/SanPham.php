<?php 

class SanPham{
    public $conn;

    public function __construct()
    {
        $this->conn= connectDB();
    }

    public function getAllSanPham() {
        try {
            $sql = 'SELECT sanp_ham.*,danh_muc.ten_danh_muc
            FROM san_pham
            INNER JOIN danh_muc ON san_pham.danh_muc_id = danh_muc.id
            WHERE san_pham.trang_thai = 1
            ORDER BY san_pham.ngay_tao DESC LIMIT 12';
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi getAllProduct() '.$e->getMessage();
        }
    }
    public function getAllSanPhamNoiBat(){
        try{
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc
                    FROM san_phams
                    INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                    WHERE san_phams.trang_thai = 1
                    ORDER BY san_phams.luot_xem DESC
                    LIMIT 10';
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
    
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function getBinhLuanFromSanPham($id){
        try {
            $sql = 'SELECT binh_luans.*, tai_khoans.ho_ten ,tai_khoans.anh_dai_dien
            FROM binh_luans 
            INNER JOIN tai_khoans ON binh_luans.tai_khoan_id = tai_khoans.id
            WHERE binh_luans.san_pham_id = :id AND binh_luans.trang_thai = 1
            
            ';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
    public function getListSanPhamDanhMuc($danh_muc_id){
        try{
            $sql = 'SELECT  san_phams.*,danh_mucs.ten_danh_muc
            FROM san_phams
            
            INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
            WHERE san_phams.danh_muc_id ='. $danh_muc_id;
            


            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        }catch (Exception $e){
            echo "Lỗi" .$e->getMessage();
        }
    }
    public function getSanPhamByCategory($danh_muc_id) {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc
                    FROM san_phams
                    INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                    WHERE san_phams.trang_thai = 1  
                    AND san_phams.danh_muc_id = :danh_muc_id';  
    
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':danh_muc_id' => $danh_muc_id
            ]); 

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {    

            echo "Lỗi: " . $e->getMessage();
        }
    }

}