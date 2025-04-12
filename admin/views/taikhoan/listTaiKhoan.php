<!-- header  -->
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
                    <h1>Quản lí tài khoản</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <a href="<?= BASE_URL_ADMIN . '?act=formAddTaiKhoan' ?>">
                                <button class="btn btn-primary">Thêm tài khoản</button>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Họ tên</th>
                                        <th>Email</th>
                                        <th>Mật Khẩu</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Ngày tạo</th>
                                        <th>Chức vụ</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listTaiKhoan as $key => $taiKhoan): ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $taiKhoan['ho_ten'] ?></td>
                                        <td><?= $taiKhoan['email'] ?></td>
                                        <td><?= $taiKhoan['mat_khau']   ?></td>
                                        <td><?= $taiKhoan['so_dien_thoai'] ?></td>
                                        <td><?= $taiKhoan['dia_chi'] ?></td>
                                        <td><?= $taiKhoan['ngay_tao'] ?></td>
                                        <td><?= $taiKhoan['role'] == 1 ? 'Quản trị viên' : 'Khách hàng' ?></td>


                                        <td>
                                            <!-- Nút Sửa -->
                                            <a
                                                href="<?= BASE_URL_ADMIN . '?act=formEditTaiKhoan&id=' . $taiKhoan['id']  ?>">
                                                <button class="btn btn-warning">Sửa</button>
                                            </a>

                                            <!-- Nút Xóa -->
                                            <a href="<?= BASE_URL_ADMIN . '?act=deleteTaiKhoan&id=' . $taiKhoan['id']?>"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không?')">
                                                <button class="btn btn-danger">Xóa</button>
                                            </a>
                                        </td>

                                    </tr>
                                    <?php endforeach; ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>Họ tên</th>
                                        <th>Email</th>
                                        <th>Mật Khẩu</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa Chỉ</th>
                                        <th>Ngày tạo</th>
                                        <th>Chức vụ</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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

</body>

</html>