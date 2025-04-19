<?php
include './views/layouts/header.php';
include './views/layouts/navbar.php';
include './views/layouts/slidebar.php';
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>QUẢN LÍ ĐƠN HÀNG</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        <table id="" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Mã Đơn</th>
                                    <th>Tài Khoản</th>
                                    <th>Tổng tiền</th>
                                    <th>Ngày Tạo</th>
                                    <th>Trạng Thái Đơn Hàng</th>
                                    <th>Phuong thức thanh toán</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listDonHang as $order) : ?>
                                    <tr>
                                        <td><?= $order['id'] ?></td>
                                        <td><?= $order['ma_don_hang'] ?></td>
                                        <td><?= htmlspecialchars($order['email']) ?></td>
                                        <td><?= number_format($order['tong_tien']) ?></td>
                                        <td><?= $order['ngay_tao'] ?></td>
                                        <td>
                                            <?php
                                            $trangThaiHienTai = $order['trang_thai_don_hang'];
                                            $dsTrangThai = [
                                                'pending' => 'Chờ xác nhận',
                                                'processing' => 'Đang xử lý',
                                                'shipped' => 'Đang giao',
                                                'delivered' => 'Hoàn thành',
                                                'canceled' => 'Đã huỷ'
                                            ];
                                            $thuTu = array_keys($dsTrangThai);
                                            $viTriHienTai = array_search($trangThaiHienTai, $thuTu);
                                            $khongChoHuy = in_array($trangThaiHienTai, ['shipped', 'delivered']);

                                            switch ($trangThaiHienTai) {
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
                                                    echo '<span class="badge bg-danger">Đã huỷ</span>';
                                                    break;
                                                default:
                                                    echo '<span class="badge bg-secondary">Không rõ</span>';
                                                    break;
                                            }
                                            ?>
                                            <form action="<?= BASE_URL_ADMIN . '?act=capNhat' ?>" method="POST" class="d-flex gap-2 align-items-center mt-3">
                                                <input type="hidden" name="don_hang_id" value="<?= $order['id'] ?>">
                                                <select name="trang_thai" class="form-control w-auto transition">
                                                    <?php foreach ($thuTu as $index => $trangThai): ?>
                                                        <?php
                                                        if ($trangThai === 'canceled' && $khongChoHuy) continue;
                                                        if ($index >= $viTriHienTai): ?>
                                                            <option value="<?= $trangThai ?>" <?= $trangThaiHienTai === $trangThai ? 'selected' : '' ?>>
                                                                <?= $dsTrangThai[$trangThai] ?>
                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                            </form>
                                        </td>
                                        <td>
                                            <?php if ($order['phuong_thuc_thanh_toan_id'] == 1): ?>
                                                <span>Thanh toán khi nhận hàng (COD)</span>
                                            <?php elseif ($order['phuong_thuc_thanh_toan_id'] == 2): ?>
                                                <span>Chuyển khoản ngân hàng (Momo)</span>
                                            <?php elseif ($order['phuong_thuc_thanh_toan_id'] == 3): ?>
                                                <span>Ví điện tử (Online)</span>
                                            <?php else: ?>
                                                <span>Không xác định</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?= BASE_URL_ADMIN . '?act=detailDonHang&id=' . $order['id'] ?>" class="btn btn-success">Xem Đơn</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include './views/layouts/footer.php'; ?>

<script>
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
        localStorage.setItem('mode', document.body.classList.contains('dark-mode') ? 'dark' : 'light');
    }

    document.addEventListener("DOMContentLoaded", function() {
        if (localStorage.getItem('mode') === 'dark') {
            document.body.classList.add('dark-mode');
        }
    });

    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>