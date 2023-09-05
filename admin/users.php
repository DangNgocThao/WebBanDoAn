<?php
spl_autoload_register(function ($class) {
    require "../class/{$class}.php";
});
require "../include/init.php";

$db = new Database();
$pdo = $db->connect();
$datauser = NguoiDung::getAll($pdo);

?>
<?php require 'include/header.php'; ?>

<div class="col mt-3 mb-3">
    <h3 class="text-center">Quản lý người dùng</h3>
    <div class="w-75 m-auto">
        <a href="new-user.php" class="btn btn-primary"><i class="fa-solid fa-user-plus"></i> Thêm tài khoản</a>
        <table class="mt-3 table table-striped table-bordered overflow-hidden rounded">
            <tr class="bg-danger">
                <th>Tên tài khoản</th>
                <th>Thao tác</th>
            </tr>
            <?php foreach ($datauser as $user) : ?>
                <tr>
                    <td class="align-middle"><?= $user->taikhoan ?></td>
                    <td><a href="edit-user.php?id=<?= $user->taikhoan ?>" class="btn btn-warning"><i class="fa-solid fa-user-pen"></i> Đổi mật khẩu</a><?php if ($user->taikhoan != "admin") : ?> | <a href="delete-user.php?id=<?= $user->taikhoan ?>" class="btn btn-danger"><i class="fa-solid fa-user-xmark"></i> Xóa tài khoản</a><?php endif; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<?php require 'include/footer.php'; ?>