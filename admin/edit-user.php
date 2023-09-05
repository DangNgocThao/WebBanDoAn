<?php
spl_autoload_register(function ($class) {
    require "../class/{$class}.php";
});
require "../include/init.php";
$tk = $_GET['id'];

$db = new Database();
$pdo = $db->connect();

if (!NguoiDung::ktTaikhoan($pdo, $tk)) {
    die("Tài khoản không tồn tại");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nd = new NguoiDung();
    $nd->taikhoan = $tk;
    $nd->matkhau = $_POST["pass"];

    if ($nd->update($pdo)) {
        header("Location:users.php");
    }
}
?>

<?php include "include/header.php" ?>

<div class="col mt-3 mb-3">
    <h3 class="text-center">Đổi mật khẩu tài khoản <?= $tk ?></h3>
    <form method="post" class="m-auto w-50">
        <div class="mb-3">
            <label for="pass" class="form-label">Mật khẩu mới(<span class="text-danger">*</span>)</label>
            <input type="password" class="form-control" id="pass" name="pass" required />
        </div>

        <div class="text-center pt-2">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-user-pen"></i> Đổi mật khẩu</button>
        </div>
    </form>
</div>

<?php include "include/footer.php" ?>