<?php
spl_autoload_register(function ($class) {
    require "../class/{$class}.php";
});
require "../include/init.php";

$db = new Database();
$pdo = $db->connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($dsmagh = $_POST['magh']) {
        $giaohang = new GiaoHang();
        $giaohang->tinhtrang = true;
        foreach ($dsmagh as $magh) {
            $giaohang->magh = $magh;
            $giaohang->update($pdo);
        }
    }
}

$data = GiaoHang::getAll($pdo);
?>
<?php include 'include/header.php' ?>

<div class="col mt-3 mb-3">
    <?php if ($data) { ?>
        <h3 class="text-center">Quản trị đơn hàng</h3>
        <form method="post">
            <table class="mt-3 table table-striped align-middle overflow-hidden rounded text-center">
                <thead>
                    <tr class="bg-danger">
                        <th>STT</th>
                        <th>Mã giỏ hàng</th>
                        <th>Tên Tài khoản</th>
                        <th>Ngày lập</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Thành tiền</th>
                        <th>Tình trạng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($data as $row) {
                        $ctgh = ChiTietGH::getAll($pdo, $row->magh);
                        $total = 0;
                        foreach ($ctgh as $cart) {
                            $total += $cart->dongia * $cart->soluong;
                        }
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row->magh ?></td>
                            <td><?= $row->taikhoan ?></td>
                            <td><?= date_format(date_create($row->ngaylap), "d/m/Y") ?></td>
                            <td><?= $row->diachi ?></td>
                            <td><?= $row->sdt ?></td>
                            <td><?= number_format($total, 0, ',', '.') ?> VNĐ</td>
                            <td>
                                <?php if (!$row->tinhtrang) {
                                ?>
                                    <div>
                                        <input class="form-check-input" type="checkbox" name="magh[]" value="<?= $row->magh ?>" id="<?= $row->magh ?>">
                                        <label class="form-check-label" for="<?= $row->magh ?>">Đã giao</label>
                                    </div>
                                <?php } else { ?>
                                    <div>
                                        <input class="form-check-input" type="checkbox" checked disabled>
                                        <label class="form-check-label">Đã giao</label>
                                    </div>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
            <div class="text-center">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Lưu</button>
            </div>
        </form>
    <?php } ?>
</div>

<?php include 'include/footer.php' ?>