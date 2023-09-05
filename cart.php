<?php
spl_autoload_register(function ($class) {
    require "class/{$class}.php";
});
require 'include/init.php';

$db = new Database();
$pdo = $db->connect();

$tk = $_SESSION['log_detail'];
$magh = GioHang::getMagh($pdo, $tk, false);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($magh) {
        $c = new ChiTietGH();

        $c->magh = $magh;
        $c->mamon = $_POST['mamon'];
        $c->soluong = $_POST['soluong'];

        $c->update($pdo);
    }
}

if (isset($_GET['action'])) {
    if ($magh) {

        $action = $_GET['action'];

        if ($action == 'empty') {
            $c = new ChiTietGH();
            $c->magh = $magh;

            $c->empty($pdo);
        }

        if ($action == 'remove') {
            if (isset($_GET['id'])) {
                $c = new ChiTietGH();
                $c->magh = $magh;
                $c->mamon = $_GET['id'];

                $c->delete($pdo);
            }
        }
    }
}
?>
<?php include 'include/header.php' ?>

<div class="col mt-3 mb-3">

    <?php
    if ($magh) {
        if ($ctgh = ChiTietGH::getAll($pdo, $magh)) { ?>
            <h3 class="text-center">Giỏ hàng</h3>
            <div>
                <a href="cart.php?action=empty" class="btn btn-danger mt-2"><i class="fa-solid fa-trash-arrow-up"></i> Xóa Giỏ Hàng</a>
            </div>
            <table class="mt-3 table table-striped align-middle overflow-hidden rounded text-center">
                <thead>
                    <tr class="bg-danger">
                        <th>STT</th>
                        <th>Hình</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Đơn vị</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $total = 0;
                    foreach ($ctgh as $cart) :
                    ?>
                        <tr>
                            <form method="post">
                                <td><?= $i ?></td>
                                <td class="w-25"><img style="height: 15rem;" class="w-100 rounded border border-dark" src="images/<?= $cart->hinh ?>"></td>
                                <td><?= $cart->tenmon ?></td>
                                <td><?= $cart->donvi ?></td>
                                <td><?= number_format($cart->dongia, 0, ',', '.') ?> VNĐ</td>
                                <td>
                                    <input type="number" value="<?= $cart->soluong ?>" name="soluong" min="1" style="width: 50px" />
                                    <input type="hidden" name="mamon" value="<?= $cart->mamon ?>" />
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen"></i> Cập nhật</button>
                                    <a href="cart.php?action=remove&id=<?= $cart->mamon ?>" class="btn btn-warning"><i class="fa-solid fa-trash"></i> Xóa</a>
                                </td>
                            </form>
                        </tr>
                    <?php
                        $i++;
                        $total += $cart->dongia * $cart->soluong;
                    endforeach; ?>
                    <tr class="table-danger">
                        <td colspan="7" class="text-center">
                            <h4>Tổng: <span class="text-danger"><?= number_format($total, 0, ',', '.') ?> VNĐ</span></h4>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center">
                <a href="payment.php" class="btn btn-success"><i class="fa-solid fa-cash-register"></i> Thanh toán</a>
            </div>
        <?php
        } else {
        ?>
            <h3 class="text-center">Giỏ hàng trống</h3>
        <?php
        }
    } else {
        ?>
        <h3 class="text-center">Giỏ hàng trống</h3>
    <?php
    }
    ?>
</div>

<?php include 'include/footer.php' ?>