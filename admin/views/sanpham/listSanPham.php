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
                    <h1>QUẢN LÍ SẢN PHẨM</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <a href="<?= BASE_URL_ADMIN . 'formAddSanPham' ?>">
                            <button class="btn btn-primary">Thêm Sản Phẩm</button>
                        </a>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Danh Mục</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Giá</th>
                                    <th>Giá khuyến mãi</th>
                                    <th>Số Lượng</th>
                                    <th>Hình Ảnh</th>
                                    <th>Mô tả</th>
                                    <th>Ngày Tạo</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($listSanPham as $products) : ?>
                                    <tr>
                                        <td><?= $products['id'] ?></td>
                                        <td><?= $products['ten_danh_muc'] ?></td>
                                        <td><?= $products['ten_san_pham'] ?></td>
                                        <td><?= $products['gia'] ?></td>
                                        <td><?= $products['gia_khuyen_mai'] ?></td>
                                        <td><?= $products['so_luong'] ?></td>
                                        <td><img
                                                src="<?= BASE_URL . $products["hinh_anh"] ?>"
                                                width="120px" alt="Ảnh sản phẩm"></td>
                                        <td><?= $products['mo_ta']?></td>
                                        <td><?= $products['ngay_tao'] ?></td>
                                        <td>
                                            <a href="<?= BASE_URL_ADMIN . 'formEditSanPham&id=' . $products['id'] ?>">
                                                <button class="btn btn-warning">Sửa</button>
                                            </a>
                                            <a href="<?= BASE_URL_ADMIN . 'deleteSanPham&id=' . $products['id'] ?>"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                <button class="btn btn-danger">Xóa</button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
include './views/layouts/footer.php';
?>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>