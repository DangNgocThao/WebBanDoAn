<?php
spl_autoload_register(function ($class) {
    require "class/{$class}.php";
});
require 'include/init.php';

$db = new Database();
$pdo = $db->connect();

$tk = $_SESSION['log_detail'];
$magh = GioHang::getMagh($pdo, $tk, false);

if ($magh) {
    if ($ctgh = ChiTietGH::getAll($pdo, $magh)) {
        $total = 0;
        $tongslg = 0;
        foreach ($ctgh as $cart) {
            $tongslg += $cart->soluong;
            $total += $cart->dongia * $cart->soluong;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gh = new GioHang();
    $gh->magh = $magh;
    $gh->thanhtoan = true;
    if ($gh->update($pdo)) {

        $giaohang = new GiaoHang();
        $giaohang->magh = $magh;
        $giaohang->diachi = $_POST['diachi'];
        $giaohang->sdt = $_POST['sdt'];
        $giaohang->tinhtrang = false;
        if ($giaohang->add($pdo)) {
            header("Location:index.php");
        }
    }
}
?>
<?php include 'include/header.php'; ?>

<div class="col mt-3 mb-3">
    <h3 class="text-center">Thanh toán</h3>
    <form method="post" class="m-auto w-50">
        <div class="row mt-3 mb-3">
            <div class="col-6 form-outline">
                <label class="form-label text-danger fw-bold">Tổng tiền</label>
                <input class="form-control" type="number" value="<?= $total ?>" disabled />
            </div>
            <div class="col-6 form-outline">
                <label class="form-label text-danger fw-bold">Tổng số lượng</label>
                <input class="form-control" type="number" value="<?= $tongslg ?>" disabled />
            </div>
        </div>

        <div class="mb-3">
            <label for="diachi" class="form-label">Địa chỉ (<span class="text-danger">*</span>)</label>
            <input class="form-control" type="text" name="diachi" id="diachi" required />
        </div>

        <div class="mb-3">
            <label for="sdt" class="form-label">Số điện thoại (<span class="text-danger">*</span>)</label>
            <input type="tel" id="sdt" name="sdt" maxlength="10" pattern="[0-9]{10}" class="form-control" required>
        </div>

        <div class="text-center pt-2">
            <button type="submit" class="btn btn-success text-center"><i class="fa-solid fa-cash-register"></i> Thanh toán</button>
        </div>
    </form>
</div>

<?php include 'include/footer.php' ?>