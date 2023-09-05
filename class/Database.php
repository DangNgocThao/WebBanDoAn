<?php
class Database
{
    public function connect()
    {
        $host = 'localhost';
        $db = 'qlma';
        $user = 'qlma_admin';
        $pass = 'pLo8eGNm0C8)3/N8';

        $dsn = "mysql:host=$host; dbname=$db; charset=UTF8";
        try {
            $pdo = new PDO($dsn, $user, $pass);
            return $pdo;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}
