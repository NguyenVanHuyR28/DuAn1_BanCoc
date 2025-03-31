<?php

class SanPham{
    public $conn; //khai báo phương thức

    public function __construct(){
        $this->conn = connectDB();
    }

    //Viết hàm lấy toàn bộ danh sách sản phẩm

    public function getAllSanPham(){
        try{
            $sql = 'SELECT san_pham.*, danh_muc.ten_danh_muc
                    FROM san_pham
                    INNER JOIN danh_muc ON san_pham.danh_muc_id = danh_muc.id
                    WHERE san_pham.trang_thai = 1';  
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
    
            return $stmt->fetchAll();
        }catch (Exception $e){
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getAllSanPhamNoiBat(){
        try{
            $sql = 'SELECT san_pham.*, danh_muc.ten_danh_muc
                    FROM san_pham
                    INNER JOIN danh_muc ON san_pham.danh_muc_id = danh_muc.id
                    WHERE san_pham.trang_thai = 1
                    ORDER BY san_pham.luot_xem DESC
                    LIMIT 10';
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
    
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    

    public function getDetailSanPham($id){
        try {
            $sql = 'SELECT san_pham.*, danh_muc.ten_danh_muc
            FROM san_pham 
            INNER JOIN danh_muc ON san_pham.danh_muc_id = danh_muc.id
            WHERE san_pham.id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id'=>$id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }

    // public function getListAnhSanPham($id){
    //     try {
    //         $sql = 'SELECT  san_pham FROM hinh_anh WHERE san_pham_id = :id';

    //         $stmt = $this->conn->prepare($sql);

    //         $stmt->execute([':id'=>$id]);

    //         return $stmt->fetchAll();
    //     } catch (Exception $e) {
    //         echo "Error" . $e->getMessage();
    //     }
    // }

    

    public function getBinhLuanFromSanPham($id){
        try {
            $sql = 'SELECT binh_luan.*, tai_khoan.ho_ten ,tai_khoan.anh_dai_dien
            FROM binh_luans 
            INNER JOIN tai_khoan ON binh_luan.tai_khoan_id = tai_khoan.id
            WHERE binh_luan.san_pham_id = :id AND binh_luan.trang_thai = 1
            
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
            $sql = 'SELECT  san_pham.*,danh_muc.ten_danh_muc
            FROM san_pham
            
            INNER JOIN danh_muc ON san_pham.danh_muc_id = danh_muc.id
            WHERE san_pham.danh_muc_id ='. $danh_muc_id;
            


            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        }catch (Exception $e){
            echo "Lỗi" .$e->getMessage();
        }
    }

    public function getSanPhamByCategory($danh_muc_id) {
        try {
            $sql = 'SELECT san_pham.*, danh_muc.ten_danh_muc
                    FROM san_pham
                    INNER JOIN danh_muc ON san_pham.danh_muc_id = danh_muc.id
                    -- WHERE san_pham.trang_thai = 1  
                    AND san_pham.danh_muc_id = :danh_muc_id';  
    
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