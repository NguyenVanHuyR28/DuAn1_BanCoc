<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>

<!-- views/gioHang.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng của bạn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4 fw-bold">🛒 Giỏ hàng của bạn</h2>

        <?php if (!empty($gioHang)) : ?>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Tên Sản Phẩm</th>
                            <th>Hình Ảnh</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $tongTien = 0; ?>
                        <?php foreach ($gioHang as $item) :  ?>
                            <?php
                            $thanhTien = $item['gia'] * $item['so_luong'];
                            $tongTien += $thanhTien;
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($item['ten_san_pham']) ?></td>
                                <td><img src="<?= BASE_URL . $item['hinh_anh'] ?>" width="80" class="img-thumbnail" alt="<?= $item['ten_san_pham'] ?>"></td>
                                <td><?= number_format($item['gia'], 0, ',', '.') ?>.VNĐ</td>
                                <td style="width: 120px;">
                                    <form action="cap-nhat-gio-hang.php" method="post" class="d-flex">
                                        <input type="hidden" name="id_gio_hang" value="<?= $item['id'] ?>">
                                        <input type="number" name="so_luong" value="<?= $item['so_luong'] ?>" class="form-control form-control-sm me-2" min="1">
                                    </form>
                                </td>
                                <td><?= number_format($thanhTien, 0, ',', '.') ?>đ</td>
                                <td>
                                    <a href="<?= BASE_URL . '?act=delete-gio-hang&id=' . $item['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa sản phẩm này khỏi giỏ?')">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

            <div class="text-end">
                <h4 class="fw-bold">Tổng tiền: <span class="text-danger"><?= number_format($tongTien, 0, ',', '.') ?>đ</span></h4>
                <a href="thanh-toan.php" class="btn btn-primary btn-lg mt-3">Tiến hành thanh toán</a>
            </div>
        <?php else : ?>
            <div class="alert alert-warning">Giỏ hàng của bạn đang trống.</div>
            <a href="<?= BASE_URL . '?act=allsanpham' ?>" class="btn btn-outline-primary">🛍️ Mua sắm ngay</a>
        <?php endif; ?>
    </div>
    <?php require_once 'layout/footer.php'; ?>
</body>

</html>