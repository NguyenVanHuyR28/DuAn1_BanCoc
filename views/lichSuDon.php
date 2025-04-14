<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Lịch sử đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4 fw-bold"><i class="fas fa-box"></i> Lịch sử đơn hàng</h2>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>