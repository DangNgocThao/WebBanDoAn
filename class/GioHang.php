<?php
class GioHang
{
    public $magh;
    public $taikhoan;
    public $thanhtoan;

    public static function getMagh($pdo, $tk, $tt)
    {
        $sql = "SELECT magh FROM giohang WHERE taikhoan=:taikhoan AND thanhtoan=:thanhtoan";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':taikhoan', $tk, PDO::PARAM_STR);
        $stmt->bindValue(':thanhtoan', $tt, PDO::PARAM_BOOL);

        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
    }

    public function add($pdo)
    {
        $sql = "INSERT INTO giohang(taikhoan, thanhtoan) VALUES (:taikhoan, :thanhtoan)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':taikhoan', $this->taikhoan, PDO::PARAM_STR);
        $stmt->bindParam(':thanhtoan', $this->thanhtoan, PDO::PARAM_BOOL);

        if ($stmt->execute()) {
            $this->magh = $pdo->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    public function update($pdo)
    {
        $sql = "UPDATE giohang SET thanhtoan=:thanhtoan WHERE magh=:magh";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':thanhtoan', $this->thanhtoan, PDO::PARAM_BOOL);
        $stmt->bindValue(':magh', $this->magh, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
