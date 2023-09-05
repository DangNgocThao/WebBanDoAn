<?php
if (!isset($_GET["id"])) {
    die("Cần cung cấp mã món");
}

$id = $_GET["id"];

spl_autoload_register(function ($class) {
    require "class/{$class}.php";
});
require "include/init.php";

$db = new Database();
$pdo = $db->connect();
$product = MonAn::getOneByID($pdo, $id);

if (!$product) {
    die("Mã món không hợp lệ");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tk = $_SESSION['log_detail'];
    $soluong = $_POST['soluong'];
    if (!$magh = GioHang::getMagh($pdo, $tk, false)) {
        $gh = new GioHang();

        $gh->taikhoan = $tk;
        $gh->thanhtoan = false;

        if ($gh->add($pdo)) {
            $ctgh = new ChiTietGH();

            $ctgh->magh = $gh->magh;
            $ctgh->mamon = $id;
            $ctgh->soluong = $soluong;

            $ctgh->add($pdo);
        }
    } else {
        if (!$sl = ChiTietGH::getSoLuong($pdo, $magh, $id)) {
            $ctgh = new ChiTietGH();

            $ctgh->magh = $magh;
            $ctgh->mamon = $id;
            $ctgh->soluong = $soluong;

            $ctgh->add($pdo);
        } else {
            $ctgh = new ChiTietGH();

            $ctgh->magh = $magh;
            $ctgh->mamon = $id;
            $ctgh->soluong = $sl + $soluong;

            $ctgh->update($pdo);
        }
    }
}
?>
<?php require 'include/header.php'; ?>

<div class="col-5 mt-3 mb-3">
    <img style="height: 30rem;" class="w-100 border border-dark rounded" src="images/<?= $product->hinh ?>">
</div>
<div class="col-7 mt-3 mb-3">
    <h1 class="text-center"><?= $product->tenmon ?></h1>
    <p>Giá: <span class="text-danger"><?= number_format($product->dongia, 0, ',', '.') ?> đ</span></p>
    <p>Đơn vị: <?= $product->donvi ?></p>
    <p>Mô tả: <?= $product->mota ?></p>
    <?php if (isset($_SESSION['log_detail'])) : ?>
        <form method="post" class="d-flex">
            <input class="form-control me-3 text-center" style="width: 8%;" type="number" min="1" name="soluong" value="1" />
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-cart-plus"></i> Thêm giỏ hàng</button>
        </form>
    <?php endif; ?>
</div>

<?php require 'include/footer.php'; ?>