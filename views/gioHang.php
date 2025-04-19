<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>

<style>
    a {
        text-decoration: none !important;
    }
</style>

<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng của bạn</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<?php if (isset($_SESSION['error'])) : ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error'];
        unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>

                            <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<body>
    <form action="<?= BASE_URL . '?act=dat-hang' ?>" method="post">
        <div class="container mt-5">
            <h2 class="mb-4 fw-bold"><i class="fas fa-shopping-cart"></i> Giỏ hàng của bạn</h2>

            <?php if (!empty($cartItems)) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Tên Sản Phẩm</th>
                                <th>Hình Ảnh</th>
                                <th>Giá</th>
                                <th>Số Lượng</th>
                                <th>Thành Tiền</th>
                                <th>Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $tongTien = 0; ?>
                            <?php foreach ($cartItems as $item) : ?>
                                <?php
                                $gia_ap_dung = (!empty($item['gia_khuyen_mai']) && $item['gia_khuyen_mai'] > 0)
                                    ? $item['gia_khuyen_mai']
                                    : $item['gia'];

                                $thanhTien = $gia_ap_dung * $item['so_luong'];
                                $tongTien += $thanhTien;
                                ?>

                                <tr>
                                    <td><?= htmlspecialchars($item['ten_san_pham']) ?></td>
                                    <td><img src="<?= BASE_URL . $item['hinh_anh'] ?>" width="80" class="img-thumbnail" alt="<?= htmlspecialchars($item['ten_san_pham']) ?>"></td>
                                    <td>
                                        <?= number_format(
                                            (!empty($item['gia_khuyen_mai']) && $item['gia_khuyen_mai'] > 0)
                                                ? $item['gia_khuyen_mai']
                                                : $item['gia'],
                                            0,
                                            ',',
                                            '.'
                                        ) ?> VNĐ
                                    </td>
                                    <td style="width: 150px;">
                                        <input type="hidden" name="id_gio_hang" value="<?= $item['id'] ?>">
                                        <input type="number" name="so_luong" value="<?= $item['so_luong'] ?>" class="form-control form-control-sm me-2" min="1" style="width: 70px;" readonly>
                                    </td>
                                    <td><?= number_format($thanhTien, 0, ',', '.') ?>đ</td>
                                    <td>
                                        <a href="<?= BASE_URL . '?act=delete-gio-hang&id=' . $item['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa sản phẩm này khỏi giỏ?')"><i class="fas fa-trash"></i> Xóa</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="text-end mt-4">
                    <h4 class="fw-bold">Tổng tiền: <span class="text-danger"><?= number_format($tongTien, 0, ',', '.') ?>đ</span></h4>
                    <a href="<?= BASE_URL . '?act=thanh-toan&id=' . $item['tai_khoan_id'] ?>" class="btn btn-primary btn-lg mt-3"><i class="fas fa-credit-card"></i> Tiến hành thanh toán</a>
                </div>

                <div>
                    <a href="<?= BASE_URL . '?act=lich-su&id=' . $item['tai_khoan_id'] ?>" class="btn btn-outline-primary"><i class="fas fa-shopping-bag"></i>Lịch sử đơn hàng</a>
                </div>
            <?php else : ?>
                <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> Giỏ hàng của bạn đang trống.
                </div>
                <a href="<?= BASE_URL . '?act=allsanpham' ?>" class="btn btn-outline-primary"><i class="fas fa-shopping-bag"></i> Mua sắm ngay</a>
            <?php endif; ?>
        </div>
    </form>

    <?php require_once 'layout/footer.php'; ?>
    <?php require_once 'layout/miniCart.php'; ?>

</body>

</html>