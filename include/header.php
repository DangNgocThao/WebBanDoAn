<?php
if (isset($_SESSION['log_detail']) && $_SESSION['log_detail'] == "admin") {
    header("Location:admin/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="row pt-2 pb-2">
            <div class="col-4">
                <a href="index.php"><img src="images/foody.jpg" class="w-100 rounded"></a>
            </div>
            <div class="col-4">
                <b>Hà Nội:</b><br />
                Điện thoại: 024.73007.008 - 093.4647.172<br />
                Địa chỉ: Số 63/445 Lạc Long Quân, Tây Hồ, Hà Nội<br />
                Email: hn@foody.vn<br />
            </div>
            <div class="col-4">
                <b>TP.Hồ Chí Minh:</b><br />
                Điện thoại: 028.73007.008 - 094.7723.444<br />
                Địa chỉ: Số 140 Phan Đình Phùng, P.2, Q.Phú Nhuận<br />
                Email: hcm@foody.vn<br />
            </div>
        </div>
        <div class="row bg-danger">
            <div class="col-8">
                <ul class="nav navbar navbar-expand-sm">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><img class="w-75 rounded" src="images/Home.png"></a>
                    </li>
                    <?php if (!isset($_SESSION['log_detail'])) : ?>
                        <li class="nav-item">
                            <a class="btn btn-outline-dark" href="login.php"><i class="fa-solid fa-user"></i> Đăng nhập</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item me-3">
                            <a class="btn btn-outline-dark" href="cart.php"><i class="fa-solid fa-cart-shopping"></i> Giỏ hàng
                                <?php
                                $tk = $_SESSION['log_detail'];
                                if (!$magh = GioHang::getMagh($pdo, $tk, false)) {
                                    echo 0;
                                } else {
                                    echo ChiTietGH::getSLMon($pdo, $magh);
                                }
                                ?>
                            </a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="btn btn-outline-dark" href="cart-history.php"><i class="fa-solid fa-clock-rotate-left"></i> Lịch sử mua hàng</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-dark" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-4">
                <form class="d-flex mt-4" method="get" action="index.php">
                    <input placeholder="Tìm kiếm" type="search" name="search" class="form-control me-2 w-50" <?php if (isset($_GET['search'])) : ?>value="<?= $_GET['search'] ?>" <?php endif; ?> />
                    <button type="submit" class="btn btn-outline-dark"><i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm</button>
                </form>
            </div>
        </div>
        <div class="row">