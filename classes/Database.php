<?php
class Database {
    private static $instance = null;
    private $pdo;

    // Private constructor to prevent direct instantiation
    private function __construct($dsn, $username, $password) {
        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log("Database connection error: " . $e->getMessage());
            throw new Exception("Database connection failed.");
        }
    }

    // Method to get the singleton instance of the database
    public static function getInstance($dsn = null, $username = null, $password = null) {
        if (self::$instance === null) {
            $dsn = $dsn ?? 'mysql:host=localhost;dbname=Youdemy'; // Replace with your database name
            $username = $username ?? 'root'; // Use 'root' as the default username
            $password = $password ?? ''; // Use an empty string or your root password if set
            self::$instance = new Database($dsn, $username, $password);
        }
        return self::$instance;
    }

    // Method to get the PDO connection
    public function getConnection() {
        return $this->pdo;
    }
}
?>