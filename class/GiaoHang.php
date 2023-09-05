<?php
class GiaoHang
{
    public $magh;
    public $ngaylap;
    public $diachi;
    public $sdt;
    public $tinhtrang;

    public static function getAll($pdo)
    {
        $sql = "SELECT * FROM giaohang, giohang WHERE giaohang.magh=giohang.magh ORDER BY ngaylap DESC";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'GiaoHang');
            return $stmt->fetchAll();
        }
    }

    public static function getByTaiKhoan($pdo, $taikhoan)
    {
        $sql = "SELECT * FROM giaohang, giohang WHERE giaohang.magh=giohang.magh AND taikhoan=:taikhoan ORDER BY ngaylap DESC";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':taikhoan', $taikhoan, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'GiaoHang');
            return $stmt->fetchAll();
        }
    }

    public function add($pdo)
    {
        $sql = "INSERT INTO giaohang VALUES (:magh, :date, :diachi, :sdt, :tinhtrang)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':magh', $this->magh, PDO::PARAM_INT);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $stmt->bindParam(':date', date("Y-m-d H:i:s", time()), PDO::PARAM_STR);
        $stmt->bindParam(':diachi', $this->diachi, PDO::PARAM_STR);
        $stmt->bindParam(':sdt', $this->sdt, PDO::PARAM_STR);
        $stmt->bindParam(':tinhtrang', $this->tinhtrang, PDO::PARAM_BOOL);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update($pdo)
    {
        $sql = "UPDATE giaohang SET tinhtrang=:tinhtrang WHERE magh=:magh";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':tinhtrang', $this->tinhtrang, PDO::PARAM_BOOL);
        $stmt->bindValue(':magh', $this->magh, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
