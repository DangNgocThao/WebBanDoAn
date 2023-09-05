<?php
$id = $_GET["id"];

spl_autoload_register(function ($class) {
    require "../class/{$class}.php";
});
require '../include/init.php';

$db = new Database();
$pdo = $db->connect();
$monan = MonAn::getOneByID($pdo, $id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($monan->delete($pdo)) {
        $t = '../images/' . $monan->hinh;
        unlink($t);
    }
    header("Location:index.php");
}
?>
<?php require 'include/header.php'; ?>

<div class="col mt-3 mb-3">
    <form method="post" class="m-auto">
        <div class="text-center">
            <h3>Bạn có muốn xóa món <?= $monan->tenmon ?>?</h3>
            <p><img style="height: 30rem;" class="w-50 border border-dark rounded" src="../images/<?= $monan->hinh ?>"></p>
            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Xóa</button>
            <a href="product.php?id=<?= $monan->mamon ?>" class="btn btn-primary">Không</a>
        </div>
    </form>
</div>

<?php require 'include/footer.php'; ?>