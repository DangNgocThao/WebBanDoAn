<?php
spl_autoload_register(function ($class) {
    require "class/{$class}.php";
});
require "include/init.php";

$noti = "";
$ten = "";
$pass = "";
$enterThePass = "";

$tenErrors = "";
$passErrors = "";
$enterThePassErrors = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten = $_POST["ten"];
    $pass = $_POST["pass"];
    $enterThePass = $_POST["enterThePass"];
    if (empty($ten)) {
        $tenErrors = "Tên tài khoản là bắt buộc";
    }
    if (empty($pass)) {
        $passErrors = "Mật khẩu là bắt buộc";
    }
    if (empty($enterThePass)) {
        $enterThePassErrors = "Nhập lại mật khẩu là bắt buộc";
    }
    if ($pass != $enterThePass) {
        $enterThePassErrors = "Mật khẩu nhập lại không khớp";
    }
    if ($tenErrors == "" && $passErrors == "" && $enterThePassErrors == "") {
        $db = new Database();
        $pdo = $db->connect();

        $nd = new NguoiDung();
        $nd->taikhoan = $ten;
        $nd->matkhau = $pass;

        if (!$nd->add($pdo)) {
            $noti = "Tên tài khoản đã tồn tại";
        } else {
            header("Location:index.php");
        }
    }
}
?>
<?php include "include/header.php" ?>

<div class="col mt-3">
    <h3 class="text-center">ĐĂNG KÝ TÀI KHOẢN</h3>
    <form method="post" class="m-auto w-50">
        <div class="mb-3">
            <label for="ten" class="form-label">Tên tài khoản (<span class="text-danger">*</span>)</label>
            <input type="text" class="form-control" id="ten" name="ten" /><span class='text-danger'><?= $tenErrors ?></span>
            <span class="text-danger"><?= $noti ?></span>
        </div>

        <div class="mb-3">
            <label for="pass" class="form-label">Mật khẩu (<span class="text-danger">*</span>)</label>
            <input type="password" class="form-control" id="pass" name="pass" /><span class='text-danger'><?= $passErrors ?></span>
        </div>

        <div class="mb-3">
            <label for="enterThePass" class="form-label">Nhập lại mật khẩu (<span class="text-danger">*</span>)</label>
            <input type="password" class="form-control" id="enterThePass" name="enterThePass" /><span class='text-danger'><?= $enterThePassErrors ?></span>
        </div>

        <div class="text-center pt-2">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-user-plus"></i> Đăng ký</button>
            <p class="mt-3">Đã có tài khoản? <a href="login.php" class="text-decoration-none">Đăng Nhập</a></p>
        </div>
    </form>
</div>

<?php include "include/footer.php" ?>