<?php

class HomeAdminController
{
    public function home()
    {
        $modelThongKe = new ThongKe(); // Đảm bảo bạn có model này
        $listDonHang30days = $modelThongKe->getAllDonHang30days();
        $list10top = $modelThongKe->getTop10SanPham(); // Lấy danh sách top 10 sản phẩm
        $listDonBom = $modelThongKe->getAllDonHangBom();
        $listDonHoan = $modelThongKe->getAllDonHangHoan();
        $listThongKe = $modelThongKe->loadAll_thongke();
    
        require_once 'home.php';
    }
}
