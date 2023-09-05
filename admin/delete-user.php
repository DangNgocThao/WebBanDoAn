<?php
spl_autoload_register(function ($class) {
    require "../class/{$class}.php";
});
require "../include/init.php";
$tk = $_GET['id'];

$db = new Database();
$pdo = $db->connect();

if ($tk == "admin") {
    header("Location:users.php");
}

if (!NguoiDung::ktTaikhoan($pdo, $tk)) {
    die("Tài khoản không tồn tại");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nd = new NguoiDung();
    $nd->taikhoan = $tk;

    if ($nd->delete($pdo)) {
        header("Location:users.php");
    }
}
?>

<?php include "include/header.php" ?>

<div class="col mt-3 mb-3">
    <form method="post" class="m-auto">
        <div class="text-center">
            <h3>Bạn có muốn xóa tài khoản <?= $tk ?>?</h3>
            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-user-xmark"></i> Xóa</button>
            <a href="users.php" class="btn btn-primary">Không</a>
        </div>
    </form>
</div>

<?php include "include/footer.php" ?>