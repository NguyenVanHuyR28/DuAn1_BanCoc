<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>

<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lịch sử đơn hàng</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<head>
    <meta charset="UTF-8">
    <title>Lịch sử đơn hàng</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4 fw-bold"><i class="fas fa-box"></i> Lịch sử đơn hàng</h2>

        <?php
        // Kiểm tra session của người dùng hoặc admin
        if (isset($_SESSION['tai_khoan'])) {
            $email = $_SESSION['tai_khoan'];
        } elseif (isset($_SESSION['tai_khoan_admin'])) {
            $email = $_SESSION['tai_khoan_admin'];
        } else {
            $_SESSION['error'] = "Vui lòng đăng nhập để xem lịch sử đơn hàng!";
            header('location:' . BASE_URL . '?act=dangnhap');
            exit();
        }

        // Lấy thông tin tài khoản
        $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($email);
        $tai_khoan_id = $user['id'];
        ?>

        <?php if (!empty($historyItem)) : ?>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Mã Đơn</th>
                            <th>Người Nhận</th>
                            <th>Số điện thoại</th>
                            <th>Tổng Tiền</th>
                            <th>Ngày Tạo</th>
                            <th>Trạng Thái</th>
                            <th>Chi Tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($historyItem as $item) : ?>
                            <tr>
                                <td><?= $item['ma_don_hang'] ?></td>
                                <td><?= $item['ten_nguoi_nhan'] ?></td>
                                <td><?= $item['sdt_nguoi_nhan'] ?></td>
                                <td><?= number_format($item['tong_tien'], 0, ',', '.') ?>đ</td>
                                <td><?= date('d/m/Y H:i', strtotime($item['ngay_tao'])) ?></td>
                                <td>
                                    <?php
                                    switch ($item['trang_thai_don_hang']) {
                                        case 'pending':
                                            echo '<span class="badge bg-warning">Chờ xác nhận</span>';
                                            break;
                                        case 'processing':
                                            echo '<span class="badge bg-primary">Đang xử lý</span>';
                                            break;
                                        case 'shipped':
                                            echo '<span class="badge bg-info">Đang giao</span>';
                                            break;
                                        case 'delivered':
                                            echo '<span class="badge bg-success">Hoàn thành</span>';
                                            break;
                                        case 'canceled':
                                            echo '<span class="badge bg-danger">Đã hủy</span>';
                                            break;
                                        default:
                                            echo '<span class="badge bg-secondary">Không rõ</span>';
                                            break;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="<?= BASE_URL . '?act=chi-tiet-don-hang&id=' . $item['id'] ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle"></i> Bạn chưa có đơn hàng nào.
            </div>
            <a href="<?= BASE_URL . '?act=allsanpham' ?>" class="btn btn-outline-primary">
                <i class="fas fa-shopping-bag"></i> Mua sắm ngay
            </a>
        <?php endif; ?>
    </div>

    <?php require_once 'layout/footer.php'; ?>
    <?php require_once 'layout/miniCart.php'; ?>

</body>

</html>