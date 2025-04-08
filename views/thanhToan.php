<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trang Thanh Toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row">
            <!-- Form thanh toán bên trái -->
            <div class="col-md-7">
                <div class="card p-4 mb-4">
                    <h2 class="mb-4 text-start">Thông Tin Thanh Toán</h2>
                    <form>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Họ và Tên</label>
                            <input type="text" class="form-control" id="fullname" placeholder="Nguyễn Văn A" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="email@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="tel" class="form-control" id="phone" placeholder="0123456789" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ giao hàng</label>
                            <textarea class="form-control" id="address" rows="3" required></textarea>
                        </div>

                        <h5 class="mt-4 mb-3">Chọn phương thức thanh toán:</h5>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="cod" value="cod" checked>
                            <label class="form-check-label" for="cod">
                                Thanh toán khi nhận hàng (COD)
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="bank" value="bank">
                            <label class="form-check-label" for="bank">
                                Chuyển khoản ngân hàng
                            </label>
                        </div>
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="wallet" value="wallet">
                            <label class="form-check-label" for="wallet">
                                Ví điện tử (Momo, ZaloPay...)
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Xác Nhận Thanh Toán</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Phần bên phải: Tóm tắt đơn hàng -->
           <?php foreach ($sanPham as $item) : ?>
            <div class="col-md-5">
                <div class="card p-4 bg-light">
                    <h4 class="mb-3">Tóm Tắt Đơn Hàng</h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                <h6 class="my-0"><?= $item['ten_san_pham'] ?></h6>
                                <small class="text-muted">Mã: SP001</small>
                            </div>
                            <span class="text-muted">350.000đ</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                <h6 class="my-0"></h6>
                                <small class="text-muted">Mã: SP002</small>
                            </div>
                            <span class="text-muted">550.000đ</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Tạm tính</span>
                            <strong>900.000đ</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Phí vận chuyển</span>
                            <strong>30.000đ</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Tổng cộng</span>
                            <strong>930.000đ</strong>
                        </li>
                    </ul>
                    <p class="text-muted">Bạn có thể kiểm tra lại đơn hàng trước khi xác nhận thanh toán.</p>
                </div>
            </div>
            <?php endforeach ; ?>
        </div>
    </div>
    <?php require_once 'layout/footer.php'; ?>
</body>

</html>