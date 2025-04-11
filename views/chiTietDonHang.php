<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chi Tiết Đơn Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }

        .order-status {
            font-weight: bold;
            padding: 5px 15px;
            border-radius: 20px;
        }

        .order-item-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
        }

        .card {
            border-radius: 1rem;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <h2 class="mb-4 text-primary fw-bold">Chi Tiết Đơn Hàng #<?= $chiTietDonHang['ma_don_hang'] ?></h2>

        <div class="card mb-4 p-4">
            <h5 class="mb-3 text-secondary">Thông Tin Người Nhận</h5>
            <p><strong>Họ và tên:</strong> <?= $chiTietDonHang['ten_nguoi_nhan'] ?></p>
            <p><strong>Email:</strong> <?= $chiTietDonHang['email_nguoi_nhan'] ?></p>
            <p><strong>Số điện thoại:</strong> <?= $chiTietDonHang['sdt_nguoi_nhan'] ?></p>
            <p><strong>Địa chỉ:</strong> <?= $chiTietDonHang['dia_chi_nguoi_nhan'] ?></p>
            <p><strong>Ghi chú:</strong> <?= $chiTietDonHang['ghi_chu'] ?: '(Không có)' ?></p>
            <p><strong>Trạng thái:</strong>
                <span class="order-status bg-<?= $chiTietDonHang['trang_thai'] == 'dang_xu_ly' ? 'warning' : ($chiTietDonHang['trang_thai'] == 'da_giao' ? 'success' : 'secondary') ?> text-white">
                    <?= ucfirst(str_replace('_', ' ', $chiTietDonHang['trang_thai'])) ?>
                </span>
            </p>
        </div>

        <div class="card p-4 mb-4">
            <h5 class="mb-3 text-secondary">Sản Phẩm Đặt Mua</h5>
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Ảnh</th>
                        <th>Sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $tongTien = 0 ?>
                    <?php foreach ($chiTietDonHang as $sp): ?>
                        <?php
                        $gia_ap_dung = $sp['gia_khuyen_mai'] > 0 ? $sp['gia_khuyen_mai'] : $sp['gia'];
                        $thanh_tien = $gia_ap_dung * $sp['so_luong'];
                        $tongTien += $thanh_tien;
                        ?>
                        <tr>
                            <td><img src="<?= $sp['hinh_anh'] ?>" alt="<?= $sp['ten_san_pham'] ?>" class="order-item-img"></td>
                            <td><?= $sp['ten_san_pham'] ?></td>
                            <td><?= number_format($gia_ap_dung, 0, ',', '.') ?>₫</td>
                            <td><?= $sp['so_luong'] ?></td>
                            <td><strong><?= number_format($thanh_tien, 0, ',', '.') ?>₫</strong></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="card p-4">
            <h5 class="mb-3 text-secondary">Tổng Thanh Toán</h5>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between">
                    <span>Tạm tính</span>
                    <strong><?= number_format($tongTien, 0, ',', '.') ?>₫</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Phí vận chuyển</span>
                    <strong>30.000₫</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Tổng cộng</span>
                    <strong class="text-danger"><?= number_format($tongTien + 30000, 0, ',', '.') ?>₫</strong>
                </li>
            </ul>
        </div>
    </div>

    <?php require_once 'layout/footer.php'; ?>
</body>

</html>