<?php
class LoaiMon
{

    public $maloai;
    public $tenloai;

    public static function getAll($pdo)
    {
        $sql = "SELECT * FROM loaimon";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'LoaiMon');
            return $stmt->fetchAll();
        }
    }
}
