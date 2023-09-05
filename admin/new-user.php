<?php
spl_autoload_register(function ($class) {
    require "../class/{$class}.php";
});
require "../include/init.php";

$noti = "";
$ten = "";
$pass = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten = $_POST["ten"];
    $pass = $_POST["pass"];

    $db = new Database();
    $pdo = $db->connect();

    $nd = new NguoiDung();
    $nd->taikhoan = $ten;
    $nd->matkhau = $pass;

    if (!$nd->add($pdo)) {
        $noti = "Tên tài khoản đã tồn tại";
    } else {
        header("Location:users.php");
    }
}
?>
<?php include "include/header.php" ?>

<div class="col mt-3 mb-3">
    <h3 class="text-center">Tạo tài khoản</h3>
    <form method="post" class="m-auto w-50">
        <div class="mb-3">
            <label for="ten" class="form-label">Tên tài khoản (<span class="text-danger">*</span>)</label>
            <input type="text" class="form-control" id="ten" name="ten" required />
        </div>

        <div class="mb-3">
            <label for="pass" class="form-label">Mật khẩu (<span class="text-danger">*</span>)</label>
            <input type="password" class="form-control" id="pass" name="pass" required />
        </div>

        <div class="text-center pt-2">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-user-plus"></i> Tạo tài khoản</button><br />
            <span class="text-danger"><?= $noti ?></span>
        </div>
    </form>
</div>

<?php include "include/footer.php" ?>