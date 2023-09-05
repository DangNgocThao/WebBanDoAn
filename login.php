<?php
spl_autoload_register(function ($class) {
    require "class/{$class}.php";
});
require "include/init.php";

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $pass = $_POST["pass"];
    $error = NguoiDung::login($name, $pass);
}
?>
<?php include "include/header.php" ?>

<div class="col mt-3">
    <h3 class="text-center">ĐĂNG NHẬP</h3>
    <form method="post" class="m-auto w-50">
        <div class="mb-3">
            <label for="name" class="form-label">Tên tài khoản</label>
            <input class="form-control" type="text" name="name" id="name" />

        </div>

        <div class="mb-3">
            <label for="pass" class="form-label">Mật khẩu</label>
            <input class="form-control" type="password" name="pass" id="pass" />
        </div>

        <div class="text-center">
            <span class="text-danger"><?= $error ?></span>
        </div>

        <div class="text-center pt-2">
            <button type="submit" class="btn btn-primary text-center"><i class="fa-solid fa-user"></i> Đăng Nhập</button>
            <p class="mt-3">Không có tài khoản? <a href="register.php" class="text-decoration-none">Đăng ký</a></p>
        </div>

    </form>
</div>

<?php include "include/footer.php" ?>