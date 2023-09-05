<?php
require '../include/init.php';
spl_autoload_register(function ($class) {
    require "../class/{$class}.php";
});
NguoiDung::logout();
