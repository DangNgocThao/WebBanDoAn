<?php
class MonAn
{
    public $mamon;
    public $maloai;
    public $tenmon;
    public $hinh;
    public $donvi;
    public $dongia;
    public $mota;

    public static function getAll($pdo)
    {
        $sql = "SELECT * FROM monan";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'MonAn');
            return $stmt->fetchAll();
        }
    }

    public static function getCount($pdo, $limit)
    {
        $sql = "SELECT COUNT(*) FROM monan";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            return ceil($stmt->fetchColumn() / $limit);
        }
    }

    public static function getPage($pdo, $limit, $offset, $sapxep = "mamon DESC")
    {
        $sql = "SELECT * FROM monan ORDER by " . $sapxep . " LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'MonAn');
            return $stmt->fetchAll();
        }
    }

    public static function getCountByLoai($pdo, $limit, $maloai)
    {
        $sql = "SELECT COUNT(*) FROM monan WHERE maloai = :maloai";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':maloai', $maloai, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return ceil($stmt->fetchColumn() / $limit);
        }
    }

    public static function getPageByLoai($pdo, $limit, $offset, $maloai, $sapxep = "mamon DESC")
    {
        $sql = "SELECT * FROM monan WHERE maloai = :maloai ORDER BY " . $sapxep . " LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':maloai', $maloai, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'MonAn');
            return $stmt->fetchAll();
        }
    }

    public static function getCountSearch($pdo, $limit, $timkiem)
    {
        $tk = "%" . $timkiem . "%";
        $sql = "SELECT COUNT(*) FROM monan WHERE tenmon LIKE :timkiem OR mota LIKE :timkiem OR dongia LIKE :timkiem OR donvi LIKE :timkiem";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':timkiem', $tk, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return ceil($stmt->fetchColumn() / $limit);
        }
    }

    public static function getPageSearch($pdo, $limit, $offset, $timkiem, $sapxep = "mamon DESC")
    {
        $tk = "%" . $timkiem . "%";
        $sql = "SELECT * FROM monan WHERE tenmon LIKE :timkiem OR mota LIKE :timkiem OR dongia LIKE :timkiem OR donvi LIKE :timkiem ORDER by " . $sapxep . " LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':timkiem', $tk, PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'MonAn');
            return $stmt->fetchAll();
        }
    }

    public static function getOneByID($pdo, $mamon)
    {
        $sql = "SELECT * FROM monan WHERE mamon = :mamon";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':mamon', $mamon, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'MonAn');
            return $stmt->fetch();
        }
    }

    public function add($pdo)
    {
        $sql = "INSERT INTO monan(maloai, tenmon, hinh, donvi, dongia, mota) VALUES (:maloai, :tenmon, :hinh, :donvi, :dongia, :mota)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':maloai', $this->maloai, PDO::PARAM_INT);
        $stmt->bindParam(':tenmon', $this->tenmon, PDO::PARAM_STR);
        $stmt->bindParam(':hinh', $this->hinh, PDO::PARAM_STR);
        $stmt->bindParam(':donvi', $this->donvi, PDO::PARAM_STR);
        $stmt->bindParam(':dongia', $this->dongia, PDO::PARAM_INT);
        $stmt->bindParam(':mota', $this->mota, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $this->mamon = $pdo->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    public function delete($pdo)
    {
        $sql = "DELETE FROM monan WHERE mamon = :mamon";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":mamon", $this->mamon, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update($pdo)
    {
        $sql = "UPDATE monan SET maloai=:maloai, tenmon=:tenmon, hinh=:hinh, donvi=:donvi, dongia=:dongia, mota=:mota WHERE mamon=:mamon";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':maloai', $this->maloai, PDO::PARAM_INT);
        $stmt->bindParam(':tenmon', $this->tenmon, PDO::PARAM_STR);
        $stmt->bindParam(':hinh', $this->hinh, PDO::PARAM_STR);
        $stmt->bindParam(':donvi', $this->donvi, PDO::PARAM_STR);
        $stmt->bindParam(':dongia', $this->dongia, PDO::PARAM_INT);
        $stmt->bindParam(':mota', $this->mota, PDO::PARAM_STR);
        $stmt->bindParam(':mamon', $this->mamon, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
