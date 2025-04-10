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
                    <h1>Chi tiết đơn hàng</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-4 mb-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="m-0">
                    Đơn hàng #<?= isset($detailItem[0]['ma_don_hang']) ? htmlspecialchars($detailItem[0]['ma_don_hang']) : 'Không rõ' ?>
                </h3>
            </div>

            <div class="card-body">
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

                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-hover text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Ảnh</th>
                                <th>Sản phẩm</th>
                                <th>Tên người nhận</th>
                                <th>Số điện thoại</th>
                                <th>Danh mục</th>
                                <th>Số lượng</th>
                                <th>Ghi chú</th>
                                <th>Giá (₫)</th>
                                <th>Thành tiền (₫)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tongTien = 0;
                            if (!empty($detailItem)):
                                foreach ($detailItem as $item):
                                    $gia = ($item['gia_khuyen_mai'] > 0) ? $item['gia_khuyen_mai'] : $item['gia'];
                                    $thanhTien = $gia * $item['so_luong'];
                                    $tongTien += $thanhTien;
                                    $hinhAnh = $item['hinh_anh'] ?? 'default.jpg';
                            ?>
                                    <tr>
                                        <td>
                                            <img src="<?= BASE_URL . $hinhAnh ?>" alt="Ảnh" width="70" height="70" style="object-fit: cover; border-radius: 6px;">
                                        </td>
                                        <td><?= htmlspecialchars($item['ten_san_pham'] ?? 'Không rõ') ?></td>
                                        <td><?= htmlspecialchars($item['ten_nguoi_nhan'] ?? 'Không rõ') ?></td>
                                        <td><?= $item['sdt_nguoi_nhan'] ?? 'Không rõ' ?></td>
                                        <td><?= htmlspecialchars($item['ten_danh_muc'] ?? 'Không rõ') ?></td>
                                        <td><?= $item['so_luong'] ?></td>
                                        <td><?= $item['ghi_chu'] ?></td>
                                        <td><?= number_format($gia, 0, ',', '.') ?>₫</td>
                                        <td><?= number_format($thanhTien, 0, ',', '.') ?>₫</td>
                                    </tr>
                                <?php
                                endforeach;
                            else:
                                ?>
                                <tr>
                                    <td colspan="6">Không có sản phẩm trong đơn hàng.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-end fw-bold">Tổng tiền:</td>
                                <td class="text-danger fw-bold"><?= number_format($tongTien, 0, ',', '.') ?>₫</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="card-footer text-end">
                <a href="<?= BASE_URL_ADMIN . '?act=listDonHang' ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
    </div>
</div>

<?php include './views/layouts/footer.php'; ?>