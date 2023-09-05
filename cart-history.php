<?php
spl_autoload_register(function ($class) {
    require "class/{$class}.php";
});
require 'include/init.php';

$db = new Database();
$pdo = $db->connect();

$tk = $_SESSION['log_detail'];
$data = GiaoHang::getByTaiKhoan($pdo, $tk);
?>
<?php include 'include/header.php'; ?>

<div class="col mt-3 mb-3">
    <?php
    if ($data) {
        $i = count($data);
        foreach ($data as $row) {
            $ctgh = ChiTietGH::getAll($pdo, $row->magh); ?>
            <table class="mb-5 table table-striped align-middle overflow-hidden rounded text-center w-75 m-auto">
                <tr class="table-danger">
                    <th>Hóa đơn: <?= $i ?></th>
                    <th colspan="2">Ngày lập: <?= date_format(date_create($row->ngaylap), "d/m/Y H:i:s") ?></th>
                    <th colspan="2">Giao hàng: <?php if ($row->tinhtrang) {
                                                    echo 'Đã giao';
                                                } else {
                                                    echo 'Đang giao';
                                                } ?></th>
                </tr>
                <?php
                $total = 0;
                foreach ($ctgh as $cart) :
                ?>
                    <tr>
                        <form method="post">
                            <td class="w-25"><img style="height: 10rem;" class="w-100 rounded border border-dark" src="images/<?= $cart->hinh ?>"></td>
                            <td><?= $cart->tenmon ?></td>
                            <td><?= $cart->donvi ?></td>
                            <td><?= number_format($cart->dongia, 0, ',', '.') ?> VNĐ</td>
                            <td><?= $cart->soluong ?></td>
                        </form>
                    </tr>
                <?php
                    $total += $cart->dongia * $cart->soluong;
                endforeach; ?>
                <tr class="table-danger">
                    <td colspan="5" class="text-end">
                        <h5>Thành tiền: <span class="text-danger"><?= number_format($total, 0, ',', '.') ?> VNĐ</span></h5>
                    </td>
                </tr>
            </table>
        <?php $i--;
        }
    } else { ?>
        <h3 class="text-center">Không có lịch sử mua hàng</h3>
    <?php } ?>
</div>

<?php include 'include/footer.php' ?>