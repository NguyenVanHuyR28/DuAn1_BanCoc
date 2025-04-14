<?php

class HomeAdminController
{
    public function home()
    {
        $modelThongKe = new ThongKe(); // Đảm bảo bạn có model này
        $listDonHang30days = $modelThongKe->getAllDonHang30days();
        require_once './home.php';
    }
}
