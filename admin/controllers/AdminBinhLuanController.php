<?php
class AdminBinhLuanController
{
    public $modelBinhLuan;
    public function __construct()
    {
        $this->modelBinhLuan = new AdminBinhLuan();
    }

    public function hideBinhLuan()
    {
        $bl_id = $_GET['id'];
        if ($bl_id !== null) {
            $this->modelBinhLuan->hideBinhLuan($bl_id);
            header('Location: ' . BASE_URL_ADMIN . '?act=listBinhLuan');
            exit();
        } else {
            die("ID bình luận không hợp lệ.");
        }
    }

    public function showBinhLuan()
    {
        $bl_id = $_GET['id'];
        if ($bl_id !== null) {
            $this->modelBinhLuan->showBinhLuan($bl_id);
            header('Location: ' . BASE_URL_ADMIN . '?act=listBinhLuan');
            exit();
        } else {
            die("ID bình luận không hợp lệ.");
        }
    }
    public function listBinhLuan()
    {
        // Lấy tất cả bình luận
        $sp_id = $_GET['sp_id'] ?? null; // Lấy ID sản phẩm từ URL (nếu có)
        $listBinhLuan = $this->modelBinhLuan->getAllComment($sp_id); // Truyền ID sản phẩm để lọc

        // Gọi view hiển thị danh sách bình luận
        require_once "./views/binhluan/listBinhLuan.php";
    }
}
