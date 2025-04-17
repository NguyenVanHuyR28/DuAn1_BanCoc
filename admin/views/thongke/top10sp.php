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
                    <h1>Sản phẩm nhiều lượt xem</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Ảnh sản phẩm</th>
                                        <th>Giá tiền</th>
                                        <th>Số lượng</th>
                                        <th>Danh mục</th>
                                        <th>Lượt xem</th>
                                        <th>Trạng Thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list10top as $key => $sanPham): ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $sanPham['ten_san_pham'] ?></td>
                                            <td>
                                                <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" style="width: 100px;" alt="">
                                            </td>
                                            <td><?= $sanPham['gia'] ?></td>
                                            <td><?= $sanPham['so_luong'] ?></td>
                                            <td><?= $sanPham['ten_danh_muc'] ?></td>
                                            <td><?= $sanPham['luot_xem'] ?></td>
                                            <td><?= $sanPham['trang_thai'] == 1 ? 'Còn hàng' : 'Dừng bán' ?></td>

                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên người nhận</th>
                                        <th>Số điện thoại</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng Thái</th>


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
</div>
<!-- /.content-wrapper -->
<!-- Footer -->
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
<!-- Code injected by live-server -->

</body>

</html>