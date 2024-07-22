<?php
class Database {
    private static $pdo;

    public static function getConnection() {
        if (self::$pdo === null) {
            $dsn = 'mysql:host=localhost;dbname=sistema_celular_2024';
            $username = 'root';
            $password = '';

            try {
                self::$pdo = new PDO($dsn, $username, $password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
                exit;
            }
        }
        return self::$pdo;
    }
}
?>
