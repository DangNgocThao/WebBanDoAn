<?php
class NguoiDung
{
    public $taikhoan;
    public $matkhau;

    public static function login($name, $pass)
    {
        $db = new Database();
        $pdo = $db->connect();

        $sql = "SELECT * from nguoidung where taikhoan= :taikhoan";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":taikhoan", $name, PDO::PARAM_STR);

        if ($stmt->execute()) {
            if (!$data = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                return "Tài khoản hoặc mật khẩu không đúng";
            }
            $passDB = $data[0]['matkhau'];

            if (password_verify($pass, $passDB)) {
                if ($name == "admin") {
                    $_SESSION['log_detail'] = $name;
                    header("Location:admin/index.php");
                    exit();
                } else {
                    $_SESSION['log_detail'] = $name;
                    header("Location:index.php");
                    exit();
                }
            } else {
                return "Tài khoản hoặc mật khẩu không đúng";
            }
        } else {
            return "Tài khoản hoặc mật khẩu không đúng";
        }
    }

    public static function logout()
    {
        if ($_SESSION['log_detail'] == "admin") {
            unset($_SESSION['log_detail']);
            header("Location:../index.php");
            exit();
        } else {
            unset($_SESSION['log_detail']);
            header("Location:index.php");
            exit();
        }
    }

    public static function getAll($pdo)
    {
        $sql = "SELECT * FROM nguoidung";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'NguoiDung');
            return $stmt->fetchAll();
        }
    }

    public static function ktTaikhoan($pdo, $name)
    {
        $sql = "SELECT * from nguoidung where taikhoan= :taikhoan";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":taikhoan", $name, PDO::PARAM_STR);

        if ($stmt->execute()) {
            if (!$stmt->fetchAll(PDO::FETCH_ASSOC)) {
                return false;
            }
            return true;
        }
        return false;
    }

    public function add($pdo)
    {
        $this->matkhau = password_hash($this->matkhau, PASSWORD_DEFAULT);

        $sql = "INSERT INTO nguoidung VALUES (:taikhoan, :matkhau)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':taikhoan', $this->taikhoan, PDO::PARAM_STR);
        $stmt->bindParam(':matkhau', $this->matkhau, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($pdo)
    {
        $sql = "DELETE FROM nguoidung WHERE taikhoan = :taikhoan";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":taikhoan", $this->taikhoan, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update($pdo)
    {
        $this->matkhau = password_hash($this->matkhau, PASSWORD_DEFAULT);

        $sql = "UPDATE nguoidung SET matkhau=:matkhau WHERE taikhoan=:taikhoan";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':taikhoan', $this->taikhoan, PDO::PARAM_STR);
        $stmt->bindParam(':matkhau', $this->matkhau, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
