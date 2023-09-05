<?php
class ChiTietGH
{
    public $magh;
    public $mamon;
    public $soluong;

    public static function getAll($pdo, $magh)
    {
        $sql = "SELECT * FROM chitietgh, monan WHERE chitietgh.mamon=monan.mamon AND magh=:magh";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':magh', $magh, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'ChiTietGH');
            return $stmt->fetchAll();
        }
    }

    public static function getSoLuong($pdo, $magh, $mamon)
    {
        $sql = "SELECT soluong FROM chitietgh WHERE magh=:magh AND mamon=:mamon";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':magh', $magh, PDO::PARAM_INT);
        $stmt->bindParam(':mamon', $mamon, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
    }

    public static function getSLMon($pdo, $magh)
    {
        $sql = "SELECT COUNT(*) FROM chitietgh WHERE magh=:magh";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':magh', $magh, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
    }

    public function add($pdo)
    {
        $sql = "INSERT INTO chitietgh VALUES (:magh, :mamon, :soluong)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':magh', $this->magh, PDO::PARAM_INT);
        $stmt->bindParam(':mamon', $this->mamon, PDO::PARAM_INT);
        $stmt->bindParam(':soluong', $this->soluong, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $this->mamon = $pdo->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    public function update($pdo)
    {
        $sql = "UPDATE chitietgh SET soluong=:soluong WHERE magh=:magh AND mamon=:mamon";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':magh', $this->magh, PDO::PARAM_INT);
        $stmt->bindParam(':mamon', $this->mamon, PDO::PARAM_INT);
        $stmt->bindParam(':soluong', $this->soluong, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($pdo)
    {
        $sql = "DELETE FROM chitietgh WHERE magh=:magh AND mamon=:mamon";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':magh', $this->magh, PDO::PARAM_INT);
        $stmt->bindParam(':mamon', $this->mamon, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function empty($pdo)
    {
        $sql = "DELETE FROM chitietgh WHERE magh=:magh";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':magh', $this->magh, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
