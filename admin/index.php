<?php
spl_autoload_register(function ($class) {
    require "../class/{$class}.php";
});
require "../include/init.php";

$db = new Database();
$pdo = $db->connect();

$product_per_page = 6;
$limit = $product_per_page;

$page = $_GET['page'] ?? 1;
$page = $page < 1 ? 1 : $page;
$max = MonAn::getCount($pdo, $limit);
$page = $page > $max ? $max : $page;

$offset = ($page - 1) * $product_per_page;

$data = MonAn::getPage($pdo, $limit, $offset);
$dataloai = LoaiMon::getAll($pdo);

if (isset($_GET['category']) && isset($_GET['arrange'])) {

    $ks = $_GET['arrange'];
    $data = MonAn::getPageByLoai($pdo, $limit, $offset, $_GET['category'], $ks);
    $max = MonAn::getCountByLoai($pdo, $limit, $_GET['category']);
} elseif (isset($_GET['search'])) {

    $tk = $_GET['search'];

    if (isset($_GET['arrange'])) {

        $ks = $_GET['arrange'];
        $data = MonAn::getPageSearch($pdo, $limit, $offset, $tk, $ks);
    } else {

        $data = MonAn::getPageSearch($pdo, $limit, $offset, $tk);
    }

    $max = MonAn::getCountSearch($pdo, $limit, $tk);
} elseif (isset($_GET['arrange'])) {

    $ks = $_GET['arrange'];
    $data = MonAn::getPage($pdo, $limit, $offset, $ks);
    $max = MonAn::getCount($pdo, $limit);
} elseif (isset($_GET['category'])) {

    $data = MonAn::getPageByLoai($pdo, $limit, $offset, $_GET['category']);
    $max = MonAn::getCountByLoai($pdo, $limit, $_GET['category']);
}
?>
<?php include 'include/header.php' ?>
<div class="col-3 pt-3">
    <ul class="nav flex-column">
        <li class="nav-item border-bottom bg-danger rounded-top">
            <a class="nav-link h3 text-light mt-2">THỂ LOẠI</a>
        </li>
        <?php foreach ($dataloai as $loai) : ?>
            <li class="nav-ite border-bottom border-start border-end rounded-bottom">
                <a class="nav-link" href="index.php?category=<?= $loai->maloai ?>"><?= $loai->tenloai ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="m-auto mt-3 rounded border p-3">
        <h3 class="mb-3">Sắp xếp theo</h3>
        <div class="form-check mb-3">
            <input class="form-check-input" type="radio" name="sapxep" id="sx1" <?php if (isset($_GET['arrange']) && $_GET['arrange'] == "dongia ASC") : ?> checked <?php endif ?> onclick="location.href='index.php?<?php if (isset($_GET['category'])) : ?>&category=<?= $_GET['category'] ?>&<?php endif; ?><?php if (isset($_GET['search'])) : ?>&search=<?= $_GET['search'] ?>&<?php endif; ?>arrange=dongia ASC'">
            <label class="form-check-label" for="sx1">Giá tăng dần</label>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="radio" name="sapxep" id="sx2" <?php if (isset($_GET['arrange']) && $_GET['arrange'] == "dongia DESC") : ?>checked<?php endif ?> onclick="location.href='index.php?<?php if (isset($_GET['category'])) : ?>&category=<?= $_GET['category'] ?>&<?php endif; ?><?php if (isset($_GET['search'])) : ?>&search=<?= $_GET['search'] ?>&<?php endif; ?>arrange=dongia DESC'">
            <label class="form-check-label" for="sx2">Giá giảm dần</label>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="radio" name="sapxep" id="sx3" <?php if (isset($_GET['arrange']) && $_GET['arrange'] == "tenmon ASC") : ?>checked<?php endif ?> onclick="location.href='index.php?<?php if (isset($_GET['category'])) : ?>&category=<?= $_GET['category'] ?>&<?php endif; ?><?php if (isset($_GET['search'])) : ?>&search=<?= $_GET['search'] ?>&<?php endif; ?>arrange=tenmon ASC'">
            <label class="form-check-label" for="sx3">Tên tăng dần</label>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="radio" name="sapxep" id="sx4" <?php if (isset($_GET['arrange']) && $_GET['arrange'] == "tenmon DESC") : ?>checked<?php endif ?> onclick="location.href='index.php?<?php if (isset($_GET['category'])) : ?>&category=<?= $_GET['category'] ?>&<?php endif; ?><?php if (isset($_GET['search'])) : ?>&search=<?= $_GET['search'] ?>&<?php endif; ?>arrange=tenmon DESC'">
            <label class="form-check-label" for="sx4">Tên giảm dần</label>
        </div>
    </div>
</div>
<div class="col-9 p-3">
    <h3>DANH SÁCH MÓN</h3>
    <div class="row">
        <?php foreach ($data as $row) : ?>
            <div class="col-4 mt-3">
                <div class="card" style="height: 100%;">
                    <a href="product.php?id=<?= $row->mamon ?>"><img style="height: 16rem;" class="card-img-top border-bottom" src="../images/<?= $row->hinh ?>"></a>
                    <div class="card-body d-flex flex-column">
                        <a href="product.php?id=<?= $row->mamon ?>" class="card-title h5 text-dark text-decoration-none"> <?= $row->tenmon ?></a>
                        <p class="card-text">Giá: <span class="text-danger"><?= number_format($row->dongia, 0, ',', '.') ?> VNĐ </span></p>
                        <div class="text-center">
                            <a href="edit-product.php?id=<?= $row->mamon ?>" class="btn btn-warning"><i class="fa-solid fa-pen"></i> Sửa</a>
                            <a href="delete-product.php?id=<?= $row->mamon ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Xóa</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row mt-3">
        <div class="text-center col">
            <?php if ($page != 1 && $max != 0) : ?>
                <a class="btn btn-primary" href="index.php?page=<?= $page - 1 ?><?php if (isset($_GET['category'])) : ?>&category=<?= $_GET['category'] ?><?php endif; ?><?php if (isset($_GET['search'])) : ?>&search=<?= $_GET['search'] ?><?php endif; ?><?php if (isset($_GET['arrange'])) : ?>&arrange=<?= $_GET['arrange'] ?><?php endif; ?>">‹</a>&nbsp;
            <?php endif; ?>
            <?php for ($i = 1; $i <= $max; $i++) : ?>
                <a class="btn btn-primary" href="index.php?page=<?= $i ?><?php if (isset($_GET['category'])) : ?>&category=<?= $_GET['category'] ?><?php endif; ?><?php if (isset($_GET['search'])) : ?>&search=<?= $_GET['search'] ?><?php endif; ?><?php if (isset($_GET['arrange'])) : ?>&arrange=<?= $_GET['arrange'] ?><?php endif; ?>"><?= $i ?></a>&nbsp;
            <?php endfor; ?>
            <?php if ($page != $max && $max != 0) : ?>
                <a class="btn btn-primary" href="index.php?page=<?= $page + 1 ?><?php if (isset($_GET['category'])) : ?>&category=<?= $_GET['category'] ?><?php endif; ?><?php if (isset($_GET['search'])) : ?>&search=<?= $_GET['search'] ?><?php endif; ?><?php if (isset($_GET['arrange'])) : ?>&arrange=<?= $_GET['arrange'] ?><?php endif; ?>">›</a>&nbsp;
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'include/footer.php' ?>