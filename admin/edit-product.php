<?php
spl_autoload_register(function ($class) {
    require "../class/{$class}.php";
});
require '../include/init.php';

$id = $_GET['id'];

$db = new Database();
$pdo = $db->connect();
$monan = MonAn::getOneByID($pdo, $id);
$dataCat = LoaiMon::getAll($pdo);

$maloai = $monan->maloai;
$tenmon = $monan->tenmon;
$donvi = $monan->donvi;
$dongia = $monan->dongia;
$mota = $monan->mota;
$file = $monan->hinh;

$dongiaErrors = "";
$fileErrors = "";
$noti = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $maloai = $_POST['maloai'];
    $tenmon = $_POST['tenmon'];
    $donvi = $_POST['donvi'];
    $dongia = $_POST['dongia'];
    $mota = $_POST['mota'];

    if ($dongia % 1000 != 0) {
        $dongiaErrors = "Đơn giá không hợp lệ!";
    }

    try {
        if (!empty($_FILES['file'])) {

            switch ($_FILES['file']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new Exception('Không có tệp nào được tải lên!');
                default:
                    throw new Exception('Đã xảy ra lỗi!');
            }

            if ($_FILES['file']['size'] > 1000000) {
                throw new Exception('Tệp quá lớn!');
            }

            $mime_types = ['image/png', 'image/jpeg', 'image/gif'];
            $file_info = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($file_info, $_FILES['file']['tmp_name']);
            if (!in_array($mime_type, $mime_types)) {
                throw new Exception('Loại tệp không hợp lệ!');
            }

            $pathinfo = pathinfo($_FILES['file']['name']);
            $fname = 'Hinh';
            $extension = $pathinfo['extension'];

            $file = $fname . '.' . $extension;
            $dest = '../images/' . $file;
            $i = 1;
            while (file_exists($dest)) {
                $file = $fname . $i . '.' . $extension;
                $dest = '../images/' . $file;
                $i++;
            }

            if (move_uploaded_file($_FILES['file']['tmp_name'], $dest)) {
                $t = '../images/' . $monan->hinh;
                unlink($t);
            } else {
                throw new Exception('Không thể di chuyển tệp!');
            }
        }
    } catch (Exception $e) {
        $fileErrors = $e->getMessage();
    }

    if ($dongiaErrors == "") {
        $monan->maloai = $maloai;
        $monan->tenmon = $tenmon;
        $monan->hinh = $file;
        $monan->donvi = $donvi;
        $monan->dongia = $dongia;
        $monan->mota = $mota;

        if ($monan->update($pdo)) {
            header("Location: product.php?id={$monan->mamon}");
            exit;
        }
    }
}
?>
<?php include 'include/header.php' ?>

<div class="col mt-3 mb-3">
    <h2 class="text-center">Sửa món</h2>
    <form method="post" enctype='multipart/form-data' class="w-50 m-auto">
        <div class="mb-3">
            <label class="form-label">Loại món (<span class="text-danger">*</span>)</label>
            <select class="form-select" name="maloai">
                <?php foreach ($dataCat as $row) : ?>
                    <option value="<?= $row->maloai ?>" <?php if ($maloai == $row->maloai) : ?> selected <?php endif; ?>><?= $row->tenloai ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="tenmon" class="form-label">Tên món (<span class="text-danger">*</span>)</label>
            <input class="form-control" id="tenmon" name="tenmon" value="<?= $tenmon ?>" required />
        </div>
        <div class="mb-3">
            <label for="donvi" class="form-label">Đơn vị (<span class="text-danger">*</span>)</label>
            <input class="form-control" id="donvi" name="donvi" value="<?= $donvi ?>" required />
        </div>
        <div class="mb-3">
            <label for="dongia" class="form-label">Đơn giá (<span class="text-danger">*</span>)</label>
            <input class="form-control" type="number" id="dongia" name="dongia" value="<?= $dongia ?>" min="1000" required />
            <span class='text-danger'><?= $dongiaErrors ?></span>
        </div>
        <div class="mb-3">
            <label for="mota" class="form-label">Mô tả (<span class="text-danger">*</span>)</label>
            <textarea style="height: 7rem;" class="form-control" id="mota" name="mota" required><?= $mota ?></textarea>
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Hình</label>
            <input class="form-control" type="file" name="file" id="file" />
            <span class='text-danger'><?= $fileErrors ?></span>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-warning"><i class="fa-solid fa-pen"></i> Sửa món</button>
            <span class="text-success"><?= $noti ?></span>
        </div>
    </form>
</div>

<?php include 'include/footer.php' ?>