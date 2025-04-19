<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chi Tiết Đơn Hàng</title>
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
    <?php
    // var_dump($thongTinDonHang);
    ?>
    <div class="container py-5">
        <h2 class="mb-4 text-primary fw-bold">Chi Tiết Đơn Hàng #<?= $thongTinDonHang['ma_don_hang'] ?></h2>

        <div class="card mb-4 p-4">
            <h5 class="mb-3 text-secondary">Thông Tin Người Nhận</h5>
            <p><strong>Họ và tên:</strong> <?= $thongTinDonHang['ten_nguoi_nhan'] ?></p>
            <p><strong>Email:</strong> <?= $thongTinDonHang['email_nguoi_nhan'] ?></p>
            <p><strong>Số điện thoại:</strong> <?= $thongTinDonHang['sdt_nguoi_nhan'] ?></p>
            <p><strong>Địa chỉ:</strong> <?= $thongTinDonHang['dia_chi_nguoi_nhan'] ?></p>
            <p><strong>Ghi chú:</strong> <?= $thongTinDonHang['ghi_chu'] ?: '(Không có)' ?></p>
            <p><strong>Trạng thái:</strong>
                <?php
                switch ($thongTinDonHang['trang_thai_id']) {
                    case '1':
                        echo '<span class="badge bg-warning">Chờ xác nhận</span>';
                        break;
                    case '2':
                        echo '<span class="badge bg-primary">Đã xác nhận</span>';
                        break;
                    case '3':
                        echo '<span class="badge bg-info">Chưa thanh toán</span>';
                        break;
                    case '4':
                        echo '<span class="badge bg-success">Đã thanh toán </span>';
                        break;
                    case '5':
                        echo '<span class="badge bg-danger">Đang chuẩn bị hàng</span>';
                        break;

                    case '6':
                        echo '<span class="badge bg-danger">Đang giao hàng</span>';
                        break;
                    case '7':
                        echo '<span class="badge bg-danger">Đã giao</span>';
                        break;
                    case '8':
                        echo '<span class="badge bg-danger">Giao hàng thành công</span>';
                        break;
                    case '9':
                        echo '<span class="badge bg-danger">Hoàn Đơn</span>';
                        break;
                    case '10':
                        echo '<span class="badge bg-danger">Hủy đơn</span>';
                        break;
                    default:
                        echo '<span class="badge bg-secondary">Không rõ</span>';
                        break;
                }
                ?>

                <?php if (in_array($thongTinDonHang['trang_thai_id'], [1, 2 ,3])): ?>
            <form action="<?= BASE_URL . '?act=cap-nhat' ?>" method="POST" onsubmit="return confirm('Bạn có chắc muốn hủy đơn hàng này không?');" class="d-inline">
                <input type="hidden" name="don_hang_id" value="<?= $thongTinDonHang['don_hang_id'] ?>">
                <button type="submit" class="btn btn-danger ms-3">Hủy hàng</button>
            </form>
        <?php endif; ?>

        </p>

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
    <?php require_once 'layout/miniCart.php'; ?>

    <?php require_once 'layout/footer.php'; ?>
</body>

</html>