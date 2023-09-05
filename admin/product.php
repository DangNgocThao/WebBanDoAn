<?php
if (!isset($_GET["id"])) {
    die("Cần cung cấp mã món");
}

$id = $_GET["id"];

spl_autoload_register(function ($class) {
    require "../class/{$class}.php";
});
require "../include/init.php";

$db = new Database();
$pdo = $db->connect();
$product = MonAn::getOneByID($pdo, $id);

if (!$product) {
    die("Mã món không hợp lệ");
}
?>
<?php require 'include/header.php'; ?>

<div class="col-5 mt-3 mb-3">
    <img style="height: 30rem;" class="w-100 border border-dark rounded" src="../images/<?= $product->hinh ?>">
</div>
<div class="col-7 mt-3 mb-3">
    <h1 class="text-center"><?= $product->tenmon ?></h1>
    <p>Giá: <span class="text-danger"><?= number_format($product->dongia, 0, ',', '.') ?> đ</span></p>
    <p>Đơn vị: <?= $product->donvi ?></p>
    <p>Mô tả: <?= $product->mota ?></p>
    <div class="text-center">
        <a href="edit-product.php?id=<?= $product->mamon ?>" class="btn btn-warning"><i class="fa-solid fa-pen"></i> Sửa</a>
        <a href="delete-product.php?id=<?= $product->mamon ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Xóa</a>
    </div>
</div>

<?php require 'include/footer.php'; ?>